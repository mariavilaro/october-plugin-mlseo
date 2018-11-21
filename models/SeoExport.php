<?php namespace Fw\Seo\Models;

use \Backend\Models\ExportModel;
use October\Rain\Filesystem\Zip;
use File;
use Lang;
use Response;
use ApplicationException;

class SeoExport extends ExportModel
{
    protected $files = [];

    public function exportData($columns, $sessionKey = null)
    {
        $seo = \Fw\Seo\Models\Seo::all();
        $exportdata = [];
        $defaultLocale = \RainLab\Translate\Models\Locale::getDefault()->code;
        $alternateLocales = array_keys(\RainLab\Translate\Models\Locale::listEnabled());

        foreach ($seo as $page) {
            foreach ($alternateLocales as $locale) {
                if ($locale == $defaultLocale) {
                    if ($page->image) {
                        $page->image_file = 'images/' . $page->image->disk_name;
                        $this->files[] = $page->image->getLocalPath();
                    }
                }
                $page->addVisible($columns);
                $page->locale = $locale;
                $page->type = 'cms-page';
                $page->translateContext($locale);
                $exportdata[] = $page->toArray();
            }
        }

        return $exportdata;
    }

    protected function processExportData($columns, $results, $options)
    {
        $name = parent::processExportData($columns, $results, $options);

        if (!$this->files) {
            return $name;
        }

        try {
            $csvPath = temp_path() . '/' . $name;
            if (!file_exists($csvPath)) {
                throw new ApplicationException(Lang::get('backend::lang.import_export.file_not_found_error'));
            }

            $tempPath = temp_path() . '/'.uniqid('oc');
            $zipName = uniqid('oc') . '.zip';
            $zipPath = temp_path().'/'.$zipName;

            if (!File::makeDirectory($tempPath)) {
                throw new ApplicationException('Unable to create directory '.$tempPath);
            }

            if (!File::makeDirectory($imagesPath = $tempPath . '/images')) {
                throw new ApplicationException('Unable to create directory '.$imagesPath);
            }

            File::copy(temp_path() . '/' . $name, $tempPath.'/seo.csv');

            foreach ($this->files as $file) {
                File::copy($file, $tempPath . '/images/' . basename($file));
            }

            Zip::make($zipPath, $tempPath);
            File::deleteDirectory($tempPath);

            return $zipName;
        }
        catch (Exception $ex) {

            if (strlen($tempPath) && File::isDirectory($tempPath)) {
                File::deleteDirectory($tempPath);
            }

            if (strlen($zipPath) && File::isFile($zipPath)) {
                File::delete($zipPath);
            }

            throw $ex;
        }
    }

    public function download($name, $outputName = null)
    {
        if (!preg_match('/^oc[0-9a-z]*.*$/i', $name)) {
            throw new ApplicationException(Lang::get('backend::lang.import_export.file_not_found_error'));
        }

        $csvPath = temp_path() . '/' . $name;
        if (!file_exists($csvPath)) {
            throw new ApplicationException(Lang::get('backend::lang.import_export.file_not_found_error'));
        }

        if ($outputName) {
            $outputNameExtension = pathinfo($outputName, PATHINFO_EXTENSION);
            $realExtension = pathinfo($csvPath, PATHINFO_EXTENSION);
            if ($realExtension && $realExtension != $outputNameExtension) {
                $outputName = str_replace($outputNameExtension, $realExtension, $outputName);
            }
        }

        $result = Response::download($csvPath, $outputName)->deleteFileAfterSend(true);

        return $result;
    }

}
