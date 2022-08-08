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
        $this->author = 'Archi';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '8.2.0',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cookies banner');
        $this->description = $this->l('Simple banner to display cookies banner compliant with GDPR');

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
            && $this->registerHook('leftColumn')
            && $this->registerHook('actionFrontControllerSetMedia')
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

    public function hookDisplayLeftColumn($params)
    {
        $this->context->smarty->assign([
            'cookies_banner_name' => Configuration::get('COOKIESBANNER_NAME'),
            'cookies_banner_link' => $this->context->link->getModuleLink('cookiesbanner', 'display'),
            'cookies_banner_message' => $this->l('This is a simple text message')
        ]);

        return $this->display(__FILE__, 'cookiesbanner.tpl');
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->hookDisplayLeftColumn($params);
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'cookiesbanner-style',
            $this->_path.'views/css/cookiesbanner.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'cookiesbanner-javascript',
            $this->_path.'views/js/cookiesbanner.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }

}