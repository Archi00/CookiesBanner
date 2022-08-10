<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class CookiesBanner extends Module
{
    public function __construct()
    {
        $this->name = 'cookiesbanner';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Archi00';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '8.2.0',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cookies banner');
        $this->description = $this->l('Simple notice banner to tell customers that this site uses cookies');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('COOKIESBANNER_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return (
            parent::install() 
            && $this->registerHook('actionFrontControllerSetMedia')
            && $this->registerHook('displayHeader')
            && Configuration::updateValue('COOKIESBANNER_NAME', 'Cookies Banner')
        ); 
    }

    public function uninstall()
    {
        return (
            parent::uninstall() 
            && Configuration::deleteByName('COOKIESBANNER_NAME')
        );
    }
    
    public function isUsingNewTranslationSystem()
    {
        return true;
    }
    
    public function hookDisplayHeader()
    {
        $cookies_banner_cookies_accepted = isset($_COOKIE["cookies_banner_accepted"]);
        $this->context->smarty->assign([
            'cookies_banner_name' => Configuration::get('COOKIESBANNER_NAME'),
            'cookies_banner_message_main' => $this->trans('This site uses cookies to give you the best, most relevant experience.', [], 'Modules.Cookiesbanner.Mainbody'),
            'cookies_banner_message_sub' => $this-> trans('Using this website means you\'re OK with this', [], 'Modules.Cookiesbanner.Subbody'),
            'cookies_banner_button' => $this->trans('Accept', [], 'Modules.Cookiesbanner.Button'),
            'cookies_banner_cookies_accepted' => $cookies_banner_cookies_accepted
        ]);

        return $this->display(__FILE__, 'cookiesbanner.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->addCSS($this->_path.'views/css/cookiesbanner.css');
        $this->context->controller->addJS($this->_path.'views/js/cookiesbanner.js'); 
    }

}