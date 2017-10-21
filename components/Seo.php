<?php namespace Fw\Seo\Components;

use Cms\Classes\ComponentBase;
use Fw\Seo\Models\Seo as SeoModel;
use \RainLab\Translate\Classes\Translator;

class Seo extends ComponentBase
{
	public function componentDetails()
	{
		return [
			'name'			=> 'fw.seo::lang.component_seo.name',
			'description'	=> 'fw.seo::lang.component_seo.description'
		];
	}

    public function defineProperties()
    {
        return [
            'append' => [
                'title' => 'fw.seo::lang.component_seo.property_append.title',
                'description' => 'fw.seo::lang.component_seo.property_append.description',
                'default' => ''
            ]
        ];
    }

	public function onRun()
	{
		$seo = SeoModel::where('page', $this->page->baseFileName)->first();
		if ($seo) {
			$this->page->title = $seo->title . ($this->property('append') ? (' ' . $this->property('append')) : '');
			$this->page->description = $seo->description;            
			$this->page->seo_image = $seo->image;
		}
	}

}
