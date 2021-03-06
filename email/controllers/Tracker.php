<?php

/**
 * This class allows Nails to track email opens and link clicks
 *
 * @package     Nails
 * @subpackage  module-email
 * @category    Controller
 * @author      Nails Dev Team
 * @link
 */

use Nails\Common\Service\Uri;
use Nails\Email\Constants;
use Nails\Email\Controller\Base;
use Nails\Email\Service\Emailer;
use Nails\Factory;

/**
 * Class Tracker
 */
class Tracker extends Base
{
    /**
     * Track an email open.
     */
    public function track_open()
    {
        /** @var Uri $oUri */
        $oUri = Factory::service('Uri');
        /** @var Emailer $oEmailer */
        $oEmailer = Factory::service('Emailer', Constants::MODULE_SLUG);

        $sRef  = $oUri->segment(3);
        $sGuid = $oUri->segment(4);
        $sHash = $oUri->segment(5);

        // --------------------------------------------------------------------------

        if (!$sRef || !$oEmailer->validateHash($sRef, $sGuid, $sHash)) {
            show404();
        }

        // --------------------------------------------------------------------------

        //  Fetch the email
        $oEmailer->trackOpen($sRef);

        // --------------------------------------------------------------------------

        /**
         * Render out a tiny, tiny image
         * Thanks http://probablyprogramming.com/2009/03/15/the-tiniest-gif-ever
         */

        header('Content-Type: image/gif');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');

        // --------------------------------------------------------------------------

        /**
         * Kill script, th, th, that's all folks. Stop the output class from hijacking
         * our headers and setting an incorrect Content-Type
         */

        exit(0);
    }

    // --------------------------------------------------------------------------

    /**
     * Track a link click and forward through
     */
    public function track_link()
    {
        /** @var Uri $oUri */
        $oUri = Factory::service('Uri');
        /** @var Emailer $oEmailer */
        $oEmailer = Factory::service('Emailer', Constants::MODULE_SLUG);

        $sRef    = $oUri->segment(4);
        $sGuid   = $oUri->segment(5);
        $sHash   = $oUri->segment(6);
        $iLinkId = (int) $oUri->segment(7) ?: null;

        // --------------------------------------------------------------------------

        if (!$sRef || !$oEmailer->validateHash($sRef, $sGuid, $sHash)) {
            show404();
        }

        // --------------------------------------------------------------------------

        $sUrl = $oEmailer->trackLink($sRef, $iLinkId);
        if ($sUrl === false) {
            show404();
        }

        redirect($sUrl);
    }

    // --------------------------------------------------------------------------

    /**
     * Maps requests to the correct method
     *
     * @param $sMethod
     */
    public function _remap($sMethod)
    {
        if ($sMethod == 'link') {
            $this->track_link();
        } else {
            $this->track_open();
        }
    }
}
