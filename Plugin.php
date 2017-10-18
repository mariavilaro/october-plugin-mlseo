<?php namespace Fw\Seo;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Translate'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
	{
		return [
			'name'			=> 'fw.seo::lang.plugin.name',
			'description'	=> 'fw.seo::lang.plugin.description',
			'author'		=> 'Maria Vilaró',
			'icon'			=> 'icon-line-chart'
		];
	}

	public function registerComponents()
	{
		return [
			'\Fw\Seo\Components\Seo' => 'seo',
    	];
	}

    public function registerPermissions()
    {
        return [
            'fw.seo.manage'  => [
                'tab'   => 'fw.seo::lang.plugin.name',
                'label' => 'fw.seo::lang.plugin.manage'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'seo' => [
                'label'       => 'fw.seo::lang.plugin.name',
                'description' => 'fw.seo::lang.plugin.description',
                'icon'        => 'icon-line-chart',
                'url'         => Backend::url('fw/seo/seo'),
                'category'    => SettingsManager::CATEGORY_CMS,
                'permissions' => ['fw.seo.manage'],
            ]
        ];
    }

}