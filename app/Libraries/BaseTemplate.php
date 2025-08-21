<?php

namespace App\Libraries;

/**
 * Path for website template design.
 * Layout and design a specifically to set as hardcoded to ease the performance. As we speak this is suppose to change using memcache technologies.
 * Need to store the design as cookies or something like thats.
 * 
 */
class BaseTemplate
{

    const TEMPLATE_BODY_PATH                        = 'templates/member';
    const TEMPLATE_BODY_SIDE_BAR_PATH               = 'templates/member_sidebar';
    const TEMPLATE_BODY_LANDING_PAGE_PATH           = 'templates/landing_page';
    const TEMPLATE_BODY_LANDING_LOGIN_PAGE_PATH     = 'templates/login_page';


    protected function set_body_template($body_path, $content)
    {
        echo view($body_path, $content);
    }
}
