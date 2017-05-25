<?php

/**
 * This class allows users to verify their email address
 *
 * @package     Nails
 * @subpackage  module-email
 * @category    Controller
 * @author      Nails Dev Team
 * @link
 */

use Nails\Email\Controller\Base;
use Nails\Factory;

class Verify extends Base
{
    /**
     * Attempt to validate the user's activation code
     */
    public function index()
    {
        $oUri       = Factory::service('Uri');
        $oInput     = Factory::service('Input');
        $oSession   = Factory::service('Session', 'nailsapp/module-auth');
        $oUserModel = Factory::model('User', 'nailsapp/module-auth');

        $iId      = $oUri->segment(3);
        $sCode    = $oUri->segment(4);
        $sStatus  = '';
        $sMessage = '';
        $oUser    = $oUserModel->getById($iId);

        if ($oUser && !$oUser->email_is_verified && $sCode) {

            try {

                if (!$oUserModel->emailVerify($oUser->id, $sCode)) {
                    throw new \Exception($oUserModel->lastError());
                }

                //  Reward referrer (if any)
                if (!empty($oUser->referred_by)) {
                    $oUserModel->rewardReferral($oUser->id, $oUser->referred_by);
                }

                $sStatus  = 'success';
                $sMessage = lang('email_verify_ok');

            } catch (\Exception $e) {
                $sStatus  = 'error';
                $sMessage = lang('email_verify_fail_error') . ' ' . $e->getMessage();
            }
        }

        // --------------------------------------------------------------------------

        if ($oInput->get('return_to')) {
            $sRedirect = $oInput->get('return_to');
        } elseif (!isLoggedIn() && $oUser) {
            if ($oUser->temp_pw) {
                $sRedirect = 'auth/reset_password/' . $oUser->id . '/' . md5($oUser->salt);
            } else {
                $oUserModel->setLoginData($oUser->id);
                $sRedirect = $oUser->group_homepage;
            }
        } elseif ($oUser) {
            $sRedirect = $oUser->group_homepage;
        } else {
            $sRedirect = '/';
        }

        if (!empty($sStatus)) {
            $oSession->set_flashdata(
                $sStatus,
                $sMessage
            );
        }
        redirect($sRedirect);
    }

    // --------------------------------------------------------------------------

    /**
     *  Map the class so that index() does all the work
     */
    public function _remap()
    {
        $this->index();
    }
}
