<?php namespace Fw\Seo\Controllers;

use BackendMenu;
use System\Classes\SettingsManager;

class Seo extends \Backend\Classes\Controller {

    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['fw.seo.manage'];

	public function __construct()
	{
	    parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Fw.Seo', 'seo');
	}
    
}