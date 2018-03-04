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
        return json_decode(json_encode($array));
    }

    /**
     * Transform object into array
     * @param object
     * @return array
     */
    public static function objectToArray($object)
    {
        return json_decode(json_encode($object), true);
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

}
