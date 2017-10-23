<?php namespace Fw\Seo\Models;

use Model;
use ValidationException;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Rainlab\Pages\Classes\Page as StaticPage;

class Seo extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fw_seo_pages';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'page' => 'required|unique:fw_seo_pages',
        'title' => 'required|max:70',
        'description' => 'required|max:155',
        'keywords' => 'max:255',
    ];

    public $translatable = [
    	'title',
    	'description',
        'keywords'
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public $timestamps = false;

    public function getPageOptions($keyValue = null)
    {
        $theme = Theme::getActiveTheme();

        $pages = Page::listInTheme($theme, true);
        $cmsPages = [];
        foreach ($pages as $page) {
            $cmsPages[$page->baseFileName] = $page->title;
        }

        /*$staticPages = StaticPage::listInTheme($theme, true);
        foreach ($staticPages as $page) {
            $cmsPages[$page->baseFileName] = $page->title;
        }*/

        return $cmsPages;


    }

    public function getPageTitleAttribute()
    {
        $theme = Theme::getActiveTheme();
        $page = Page::loadCached($theme, $this->page . '.htm');
        //if (!$page) $page = StaticPage::loadCached($theme, $this->page . '.htm');

        return $page->title;
    }
}
