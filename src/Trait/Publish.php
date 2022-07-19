<?php

namespace Ssgroup\Language\Trait;

use Ssgroup\Language\Models\Language;

trait Publish
{
    public function isDirectory($directory)
    {
        return is_dir($directory);
    }

    public function makeDirectorys($path, $mode = 0755, $recursive = false, $force = false)
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }

        return mkdir($path, $mode, $recursive);
    }

    protected function makeDirectory($path)
    {
        if (! $this->isDirectory(dirname($path))) {
            $this->makeDirectorys(dirname($path), 0777, true, true);
        }

        return $path;
    }

    public function filesPut($path, $contents, $lock = false)
    {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    public function public()
    {

        $languages = Language::get();

        $stub = base_path('vendor/ssgroup/language/src/config/language.stub');
        $file = file_get_contents($stub);

        $strs = [];
        $locale = [];

        $arr = [
            'np' => [
                'key' => 'val',
            ],
            'en' => [
                'key' => 'val',
            ],
        ];

        foreach ($languages as $language) {
            if (! in_array($language->locale, $locale)) {
                array_push($locale, $language->locale);
                $str[$language->locale] = [];
            }
        }

        foreach ($languages as $language) {
            foreach ($locale as $item) {
                if ($language->locale == $item) {
                    $key = $language->key;
                    $value = $language->value;

                    $key = str_replace("'", "\'", $key);
                    $key = str_replace('"', '"', $key);
                    $key = str_replace('\\', '\\', $key);

                    $value = str_replace("'", "\'", $value);
                    $value = str_replace('"', '"', $value);
                    $value = str_replace('\\', '\\', $value);

                    array_push($str[$item], "'".$key."' => '".$value."',
            ");
                }
            }
        }

        $return = '';
        foreach ($str as $key => $item) {
            $return = $return."'".$key."' => [
            ";
            foreach ($item as $last) {
                $return = $return."\t".$last;
            }
            $return = $return.'],
            ';
        }

        $str = $return;

        $file = str_replace('array', $str, $file);

        $path = config_path('language.php');
        $this->makeDirectory($path);
        file_put_contents($path, $file, 0);
        $this->filesPut($path, $file);

        return redirect("ssgroup-language/admin/language")->with('success', 'Language Backup Successful.');
    }
}
