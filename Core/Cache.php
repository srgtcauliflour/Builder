<?php

namespace Core;

use Core\Helper;

class Cache
{
    /**
     * Create cache item
     * @param string content type
     * @param string content id
     * @param array content
     * @return object
     */
    public static function set($type, $id, $content)
    {
        $path = CACHE . "/{$type}/{$id}.cache";
        
        if (!file_exists(CACHE . "/{$type}"))
        {
            mkdir(CACHE . "/{$type}");
        }

        \file_put_contents($path, json_encode($content));
        return json_decode(json_encode($content));
    }

    /**
     * Get cache item
     * @param string content type
     * @param string content id
     * @return object
     */
    public static function get($type, $id)
    {
        return json_decode(\file_get_contents(CACHE . "/{$type}/{$id}.cache"));
    }

    /**
     * Check cache type or cache item exists
     * @param string content type
     * @param int content id
     * @return bool
     */
    public static function exists($type, $id = null)
    {
        if ($id === null)
        {
            return file_exists(CACHE . "/{$type}");
        }

        return file_exists(CACHE . "/{$type}/{$id}.cache");
    }

    /**
     * Clear Cache
     * @param string content type
     * @param string content id
     * @return bool
     */
    public static function clear($type = null, $id = null)
    {
        if ($type !== null && $id !== null)
        {
            return @unlink(CACHE . "/{$type}/{$id}.cache");
        }
        else if ($type !== null)
        {
            return Helper::deleteContent(CACHE . "/$type");
        }

        return Helper::deleteContent(CACHE);
    }

}
