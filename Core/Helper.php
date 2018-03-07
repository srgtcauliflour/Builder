<?php

namespace Core;

class Helper
{

    /**
     * Transform array into object
     * @param array
     * @return object
     */
    public static function arrayToObject($array)
    {
        return (object) $array;
    }

    /**
     * Transform object into array
     * @param object
     * @return array
     */
    public static function objectToArray($object)
    {
        return (array) $object;
    }

    /**
     * Generate a simple slug
     * @param string content
     * @param string divider
     * @return string slug
     */
    public static function generateSlug($content, $divider = "_")
    {
        return trim(preg_replace("/[^a-zA-Z0-9]{1,}/", $divider, trim($content)), $divider);
    }

    /**
     * Delete all content from folder
     * @param string folder path
     * @return bool
     */
    public static function deleteContent($path)
    {
        try
        {
            $iterator = new \DirectoryIterator($path);
            foreach ( $iterator as $fileinfo )
            {
                if($fileinfo->isDot())
                {
                    continue;
                }

                if($fileinfo->isDir())
                {
                    if(self::deleteContent($fileinfo->getPathname()))
                    {
                        @rmdir($fileinfo->getPathname());
                    }
                }
                if($fileinfo->isFile())
                {
                    @unlink($fileinfo->getPathname());
                }
            }
        }
        catch ( Exception $e )
        {
        
         return false;
        }
        return true;
    }

    /**
     * file_get_contents but executes the php
     * @param string file path
     * @return string file content
     */
    public static function getContents($path)
    {
        ob_start();
        include $path;
        return ob_get_clean();
    }

    /**
     * Generate a random string
     * @param int string length
     * @return string random string
     */
    public static function randomString($length)
    {
        $possibilities = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        $chars = str_split($possibilities);

        $token = '';
        for ($i = 0; $i < $length - 1; $i++)
        {
            $token .= $chars[rand(0, count($chars) - 1)];
        }

        return $token;
    }

    /**
     * Generalize the date function
     * @return string date
     */
    public static function getCurrentDate($time = true)
    {
        if ($time)
        {
            return date('Y-m-d H:i:s', strtotime('now'));
        }

        return date('Y-m-d', strtotime('now'));
    }

}
