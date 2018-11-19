<?php namespace Fw\Seo\Models;

use \Backend\Models\ExportModel;

class SeoExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $seo = \Fw\Seo\Models\Seo::all();
        $exportdata = [];
        $alternateLocales = array_keys(\RainLab\Translate\Models\Locale::listEnabled());

        foreach ($alternateLocales as $locale) {
            $seo->each(function($page) use ($columns, $locale, &$exportdata) {
                $page->addVisible($columns);
                $page->locale = $locale;
                $page->type = 'cms-page';
                $page->translateContext($locale);
                $exportdata[] = $page->toArray();
            });
        }

        return $exportdata;
    }

}
