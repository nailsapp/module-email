<?php

/**
 * This is a convenience class for generating emails
 *
 * @package     Nails
 * @subpackage  module-email
 * @category    Factory
 * @author      Nails Dev Team
 */

namespace Nails\Email\Factory;

use Nails\Email\Exception\EmailerException;
use Nails\Factory;

class Email
{
    /**
     * The email's type
     * @var string
     */
    protected $sType = '';

    /**
     * The email's recipients
     * @var array
     */
    protected $aTo = [];

    /**
     * The email's CC recipients
     * @var array
     */
    protected $aCc = [];

    /**
     * The email's BCC recipients
     * @var array
     */
    protected $aBcc = [];

    /**
     * The name of the sender
     * @var string
     */
    protected $sFromName = '';

    /**
     * The email address of the sender (the reply-to value)
     * @var string
     */
    protected $sFromEmail = '';

    /**
     * The email's subject
     * @var string
     */
    protected $sSubject = '';

    /**
     * The email's data payload
     * @var array
     */
    protected $aData = [];

    /**
     * Whether the last email was sent successfully or not
     * @var null
     */
    protected $bLastEmailDidSend = null;

    // --------------------------------------------------------------------------

    /**
     * Email constructor.
     */
    public function __construct()
    {
        Factory::helper('email');
    }

    // --------------------------------------------------------------------------

    /**
     * Set the email's type
     *
     * @param string $sType The type of email to send
     *
     * @return $this
     */
    public function type($sType)
    {
        $this->sType = $sType;
        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Add a recipient
     *
     * @param integer|string $mUserIdOrEmail The user ID to send to, or an email address
     * @param bool           $bAppend        Whether to add to the list of recipients or not
     *
     * @return $this
     */
    public function to($mUserIdOrEmail, $bAppend = false)
    {
        return $this->addRecipient($mUserIdOrEmail, $bAppend, $this->aTo);
    }

    // --------------------------------------------------------------------------

    /**
     * Add a recipient (on CC)
     *
     * @param integer|string $mUserIdOrEmail The user ID to send to, or an email address
     * @param bool           $bAppend        Whether to add to the list of recipients or not
     *
     * @return $this
     */
    public function cc($mUserIdOrEmail, $bAppend = false)
    {
        return $this->addRecipient($mUserIdOrEmail, $bAppend, $this->aCc);
    }

    // --------------------------------------------------------------------------

    /**
     * Add a recipient (on BCC)
     *
     * @param integer|string $mUserIdOrEmail The user ID to send to, or an email address
     * @param bool           $bAppend        Whether to add to the list of recipients or not
     *
     * @return $this
     */
    public function bcc($mUserIdOrEmail, $bAppend = false)
    {
        return $this->addRecipient($mUserIdOrEmail, $bAppend, $this->aBcc);
    }

    // --------------------------------------------------------------------------

    /**
     * Adds a recipient
     *
     * @param integer|string $mUserIdOrEmail The user ID to send to, or an email address
     * @param bool           $bAppend        Whether to add to the list of recipients or not
     * @param array          $aArray         The array to add the recipient to
     *
     * @return $this
     */
    protected function addRecipient($mUserIdOrEmail, $bAppend, &$aArray)
    {
        if (!$bAppend) {
            $aArray = [];
        }

        if (is_array($mUserIdOrEmail)) {
            foreach ($mUserIdOrEmail as $sUserIdOrEmail) {
                $this->addRecipient($sUserIdOrEmail, true, $aArray);
            }
        } else {
            $aArray[] = $mUserIdOrEmail;
        }

        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Set email payload data
     *
     * @param array|string $mKey   An array of key value pairs, or the key if supplying the second parameter
     * @param mixed        $mValue The value
     *
     * @return $this
     */
    public function data($mKey, $mValue = null)
    {
        if (is_array($mKey)) {
            foreach ($mKey as $sKey => $mValue) {
                $this->data($sKey, $mValue);
            }
        } else {
            $this->aData[$mKey] = $mValue;
        }

        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Send the email
     *
     * @param bool $bGraceful Whether to fail gracefully or not
     *
     * @throws EmailerException
     * @return $this
     */
    public function send($bGraceful = false)
    {
        $aEmail = $this->toArray();
        $aData  = [
            'type'     => $aEmail['sType'],
            'to_id'    => null,
            'to_email' => null,
            'data'     => (object) $aEmail['aData'],
        ];

        if (!empty($aEmail['sSubject']) & empty($aData['data']->email_subject)) {
            $aData['data']->email_subject = $aEmail['sSubject'];
        }

        if (!empty($aEmail['sFromName']) & empty($aData['data']->email_from_name)) {
            $aData['data']->email_from_name = $aEmail['sFromName'];
        }

        if (!empty($aEmail['sFromEmail']) & empty($aData['data']->email_from_email)) {
            $aData['data']->email_from_email = $aEmail['sFromEmail'];
        }

        if (!empty($aEmail['aCc']) & empty($aData['data']->cc)) {
            $aData['data']->cc = $aEmail['aCc'];
        }

        if (!empty($aEmail['aBcc']) & empty($aData['data']->bcc)) {
            $aData['data']->bcc = $aEmail['aBcc'];
        }

        // --------------------------------------------------------------------------

        $oEmailer = Factory::service('Emailer', 'nailsapp/module-email');

        foreach ($aEmail['aTo'] as $mUserIdOrEmail) {

            if (is_numeric($mUserIdOrEmail)) {
                $aData['to_id'] = $mUserIdOrEmail;
            } elseif (valid_email($mUserIdOrEmail)) {
                $aData['to_email'] = $mUserIdOrEmail;
            }

            $this->bLastEmailDidSend = $oEmailer->send($aData, $bGraceful);
        }

        return $this;
    }

    // --------------------------------------------------------------------------

    /**
     * Whether the last email was sent successfully
     * @return bool
     */
    public function didSend()
    {
        return (bool) $this->bLastEmailDidSend;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns the item as an array
     * @return array
     */
    public function toArray()
    {
        return [
            'sType'      => $this->sType,
            'aTo'        => array_filter(array_unique($this->aTo)),
            'aCc'        => array_filter(array_unique($this->aCc)),
            'aBcc'       => array_filter(array_unique($this->aBcc)),
            'sFromName'  => $this->sFromName,
            'sFromEmail' => $this->sFromEmail,
            'sSubject'   => $this->sSubject,
            'aData'      => $this->aData,
        ];
    }
}