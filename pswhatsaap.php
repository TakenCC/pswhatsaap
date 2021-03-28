<?php 
if (!defined('_PS_VERSION_')) {
    exit;
}

class Pswhatsaap extends Module{

	public function __construct()
    {
        $this->name = 'pswhatsaap';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Delvis Tovar';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Modulo de Whatsapp');
        $this->description = $this->l('Modulo de Whatsapp desarrollado para prestashop 1.7');

        $this->confirmUninstall = $this->l('Esta seguro de desinstalar el modulo?');

        if (!Configuration::get('pswhatsaap')) {
            $this->warning = $this->l('no tiene nombre');
        }
    }

	public function install(){
		if (!parent::install())
			return false;

		configuration::updateValue("pswhatsaap_NumWhat", '04121567173');
		Configuration::updateValue('pswhatsaap_What', 1);
        Configuration::updateValue('pswhatsaap_animation', 1);
        Configuration::updateValue('pswhatsaap_Whatsapp_IMG', 'whatsapp.png');
		$this->registerHook('displayHeader');
		$this->registerHook('displayFooter');

		return true;
	}

	public function uninstall()
	{
	    return parent::uninstall();
	}

	public function getContent(){
		if (Tools::isSubmit("pswhatsaap_env")) {
			$pswhatsaap_NumWhat = Tools::getValue("pswhatsaap_NumWhat");
			configuration::updateValue("pswhatsaap_NumWhat", $pswhatsaap_NumWhat);

			$pswhatsaap_What = Tools::getValue("pswhatsaap_What");
			configuration::updateValue("pswhatsaap_What", $pswhatsaap_What);

			$pswhatsaap_animation = Tools::getValue("pswhatsaap_animation");
			configuration::updateValue("pswhatsaap_animation", $pswhatsaap_animation);

			$update_images_values = false;
			$values = array();

			if (isset($_FILES['Whatsapp_IMG'])
                    && isset($_FILES['Whatsapp_IMG']['tmp_name'])
                    && !empty($_FILES['Whatsapp_IMG']['tmp_name'])) {
                    if ($error = ImageManager::validateUpload($_FILES['Whatsapp_IMG'], 4000000)) {
                        return $error;
                    } else {
                        $ext = substr($_FILES['Whatsapp_IMG']['name'], strrpos($_FILES['Whatsapp_IMG']['name'], '.') + 1);
                        $file_name = md5($_FILES['Whatsapp_IMG']['name']).'.'.$ext;

                        if (!move_uploaded_file($_FILES['Whatsapp_IMG']['tmp_name'], dirname(__FILE__).DIRECTORY_SEPARATOR.'views/img'.DIRECTORY_SEPARATOR.$file_name)) {
                            return $this->displayError($this->trans('An error occurred while attempting to upload the file.', array(), 'Admin.Notifications.Error'));
                        } else {
                            if (Configuration::hasContext('Whatsapp_IMG',1, Shop::getContext())
                                && Configuration::get('Whatsapp_IMG',1) != $file_name) {
                                @unlink(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . Configuration::get('Whatsapp_IMG'));
                            }

                            $values['Whatsapp_IMG'] = $file_name;
                        }
                    }

                $update_images_values = true;
            }
            if ($update_images_values) {
                Configuration::updateValue('pswhatsaap_Whatsapp_IMG', $values['Whatsapp_IMG']);
        	}
		}


		$pswhatsaap_NumWhat = configuration::get("pswhatsaap_NumWhat");
		$pswhatsaap_What = configuration::get("pswhatsaap_What");
		$pswhatsaap_animation = configuration::get("pswhatsaap_animation");
		$img_whatsapp = configuration::get("pswhatsaap_Whatsapp_IMG");
		
		$this->context->smarty->assign("pswhatsaap_NumWhat", $pswhatsaap_NumWhat);
		$this->context->smarty->assign("pswhatsaap_What", $pswhatsaap_What);
		$this->context->smarty->assign("pswhatsaap_animation", $pswhatsaap_animation);
		$this->context->smarty->assign("img_whatsapp", $img_whatsapp);
		$this->context->smarty->assign("uri", $this->getPathUri());

        return $this->display(__FILE__,"views/templates/admin/getContent.tpl");
    }

    public function hookDisplayHeader($params)
	{
	    $this->context->controller->registerStylesheet('modules-whatsapp', 'modules/'.$this->name.'/views/css/whatsapp.css', ['media' => 'all', 'priority' => 150]);
	}

	public function hookDisplayFooter($params)
	{
		$pswhatsaap_NumWhat = configuration::get("pswhatsaap_NumWhat");
		$pswhatsaap_What = configuration::get("pswhatsaap_What");
		$pswhatsaap_animation = configuration::get("pswhatsaap_animation");
		$img_whatsapp = configuration::get("pswhatsaap_Whatsapp_IMG");
		
		$this->context->smarty->assign("pswhatsaap_NumWhat", $pswhatsaap_NumWhat);
		$this->context->smarty->assign("pswhatsaap_animation", $pswhatsaap_animation);
		$this->context->smarty->assign("img_whatsapp", $img_whatsapp);

		if ($pswhatsaap_What != 1) {
			return false;
		} else{
			return $this->display(__FILE__,"views/templates/hook/hookDisplayFooter.tpl");
		}
	}

}