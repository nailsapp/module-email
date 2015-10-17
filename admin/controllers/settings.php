<?php

/**
 * This class registers some handlers for email settings
 *
 * @package     Nails
 * @subpackage  module-email
 * @category    AdminController
 * @author      Nails Dev Team
 * @link
 */

namespace Nails\Admin\Email;

use Nails\Admin\Helper;
use Nails\Email\Controller\BaseAdmin;

class Settings extends BaseAdmin
{
    /**
     * Announces this controller's navGroups
     * @return stdClass
     */
    public static function announce()
    {
        $navGroup = new \Nails\Admin\Nav('Settings', 'fa-wrench');

        if (userHasPermission('admin:email:settings:update')) {

            $navGroup->addAction('Email');
        }

        return $navGroup;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns an array of permissions which can be configured for the user
     * @return array
     */
    public static function permissions()
    {
        $permissions = parent::permissions();

        $permissions['update:sender'] = 'Can update sender settings';

        return $permissions;
    }

    // --------------------------------------------------------------------------

    /**
     * Manage Email settings
     * @return void
     */
    public function index()
    {
        if (!userHasPermission('admin:email:settings:update:.*')) {

            unauthorised();
        }

        // --------------------------------------------------------------------------

        if ($this->input->post()) {

            $settings = array();

            if (userHasPermission('admin:email:settings:update:sender')) {

                $settings['from_name']  = $this->input->post('from_name');
                $settings['from_email'] = $this->input->post('from_email');
            }

            if (!empty($settings)) {

                if ($this->app_setting_model->set($settings, 'email')) {

                    $this->data['success'] = 'Email settings have been saved.';

                } else {

                    $this->data['error'] = 'There was a problem saving email settings.';
                }

            } else {

                $this->data['message'] = 'No settings to save.';
            }
        }

        // --------------------------------------------------------------------------

        //  Get data
        $this->data['settings'] = app_setting(null, 'email', true);

        // --------------------------------------------------------------------------

        //  Assets
        $this->asset->load('nails.admin.settings.min.js', 'NAILS');

        // --------------------------------------------------------------------------

        //  Set page title
        $this->data['page']->title = 'Settings &rsaquo; Email';

        // --------------------------------------------------------------------------

        //  Load views
        Helper::loadView('index');
    }
}
