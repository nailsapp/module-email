<?php

/**
 * This class allows users to subscribe and unsubscribe from individual email types
 *
 * @package     Nails
 * @subpackage  module-email
 * @category    Controller
 * @author      Nails Dev Team
 * @link
 */

use Nails\Auth\Model\User;
use Nails\Common\Service\Encrypt;
use Nails\Common\Service\Input;
use Nails\Email\Controller\Base;
use Nails\Email\Service\Emailer;
use Nails\Factory;

class Unsubscribe extends Base
{
    /**
     * Renders the subscribe/unsubscribe page
     *
     * @return void
     */
    public function index()
    {
        /** @var Input $oInput */
        $oInput = Factory::service('Input');
        /** @var Encrypt $oEncrypt */
        $oEncrypt = Factory::service('Encrypt');
        /** @var Emailer $oEmailer */
        $oEmailer = Factory::service('Emailer', 'nails/module-email');
        /** @var User $oUserModel */
        $oUserModel = Factory::model('User', 'nails/module-auth');

        $sToken = $oInput->get('token');
        $aToken = $oEncrypt->decode($sToken, APP_PRIVATE_KEY);
        $aToken = explode('|', $aToken);

        if (count($aToken) != 3) {
            show404();
        }

        list($sType, $sRef, $iUserId) = $aToken;

        $oUser = $oUserModel->getById($iUserId);
        if (empty($oUser)) {
            show404();
        }

        $oEmail = $oEmailer->getByRef($sRef);
        if (!$oEmail || empty($oEmail->type->isUnsubscribable)) {
            show404();
        }

        // --------------------------------------------------------------------------

        //  All seems above board, action the request
        if ($oInput->get('undo')) {
            if ($oEmailer->userHasUnsubscribed($oUser->id, $sType)) {
                $oEmailer->subscribeUser($oUser->id, $sType);
            }
        } else {
            if (!$oEmailer->userHasUnsubscribed($oUser->id, $sType)) {
                $oEmailer->unsubscribeUser($oUser->id, $sType);
            }
        }

        // --------------------------------------------------------------------------

        $this->loadStyles(NAILS_APP_PATH . 'application/modules/email/views/utilities/unsubscribe.php');

        Factory::service('View')
            ->load([
                'structure/header/blank',
                'email/utilities/unsubscribe',
                'structure/footer/blank',
            ]);
    }

    // --------------------------------------------------------------------------

    /**
     * Map all requests to index
     *
     * @return  void
     **/
    public function _remap()
    {
        $this->index();
    }
}
