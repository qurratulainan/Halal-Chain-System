<?php

namespace App\Libraries;

class Template extends BaseTemplate
{
    function member(String $path, array $data)
    {
        $data['sidebar']    = view(BaseTemplate::TEMPLATE_BODY_SIDE_BAR_PATH, $data);
        $data['contents']   = view($path, $data);

        $this->set_body_template(BaseTemplate::TEMPLATE_BODY_PATH, $data);
    }

    function landing_page(String $path, array $data)
    {
        $data['contents']   = view($path, $data);

        $this->set_body_template(BaseTemplate::TEMPLATE_BODY_LANDING_PAGE_PATH, $data);
    }

    public function login_page(){
        $data['contens'] = null;
        $this->set_body_template(BaseTemplate::TEMPLATE_BODY_LANDING_LOGIN_PAGE_PATH, $data);
    }
}
