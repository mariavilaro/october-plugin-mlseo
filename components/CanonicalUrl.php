<?php namespace Fw\Seo\Components;

use Cms\Classes\ComponentBase;
use \RainLab\Translate\Classes\Translator;

class CanonicalUrl extends ComponentBase
{
    public $user;

    public function componentDetails()
    {
        return [
            'name' => 'fw.seo::lang.component_canonical_url.name',
            'description' => 'fw.seo::lang.component_canonical_url.description'
        ];
    }

    public function onRun()
    {
        $translator = Translator::instance();
        $currentLocale = $translator->getLocale(true);
        $baseUrl = url('/');
        $baseUrlLocale = $baseUrl . '/' . $currentLocale;
        $currentUrl = $this->currentPageUrl();

        $regex = '/(' . str_replace('/', '\/', $baseUrlLocale) . ')/';
        if (preg_match($regex, $currentUrl)) {
            $this->page['canonicalUrl'] = $currentUrl;
        } else {
            $this->page['canonicalUrl'] = str_replace($baseUrl, $baseUrlLocale, $currentUrl);
        }
    }
}
