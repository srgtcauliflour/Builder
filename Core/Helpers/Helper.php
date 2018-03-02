<?php

namespace Core\Helpers;

class Helper
{

    public static function arrayToObject($array)
    {
        return json_decode(json_encode($array));
    }

    public static function objectToArray($object)
    {
        return json_decode(json_encode($object), true);
    }

}
