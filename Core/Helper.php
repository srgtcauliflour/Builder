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

}
