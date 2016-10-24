<?php

namespace TobyMaxham\Logger;

use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer as RapViewer;

/**
 * Class LaravelLogViewer
 * @package TobyMaxham\Logger
 * @author Tobias Maxham <git2016@maxham.de>
 */
class LaravelLogViewer extends RapViewer
{
    /**
     * @var string
     */
    protected static $orgFile;

    /**
     * @param bool $basename
     * @return array
     */
    public static function getFiles($basename = false)
    {
        $files = glob(storage_path() . '/logs/*');
        $files = array_reverse($files);
        $files = array_merge(
            array_filter($files, 'is_file'),
            self::recursiveFiles(array_filter($files, 'is_dir'))
        );

        if ($basename && is_array($files)) {
            foreach ($files as $k => $file) {
                $files[$k] = [basename($file), $file];
            }
        }
        $allFiles = array_values($files);
        if (!empty($allFiles)) return $allFiles;
        return parent::getFiles($basename);
    }

    /**
     * @param $directories
     * @return array
     */
    private static function recursiveFiles($directories)
    {
        $files = [];

        foreach ($directories as $dir) {
            $gFiles = glob($dir . '/*');
            $gFiles = array_reverse($gFiles);
            $files = array_merge(
                $files,
                array_filter($gFiles, 'is_file'),
                self::recursiveFiles(array_filter($gFiles, 'is_dir'))
            );
        }
        $files = array_filter($files, function ($file) {
            return (pathinfo($file)['extension'] == 'log');
        });

        return $files;
    }

    /**
     * @return string
     */
    public static function getFileName()
    {
        if (is_null(self::$orgFile))
            return storage_path() . '/logs/' . parent::getFileName();
        return self::$orgFile;
    }

    /**
     * @param string $sFile
     */
    public static function setFile($sFile)
    {
        self::$orgFile = $sFile;
        parent::setFile(str_replace(storage_path() . '/logs/', '', $sFile));
    }
}