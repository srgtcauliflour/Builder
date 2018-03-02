<?php

namespace Core\Helpers;

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

}
