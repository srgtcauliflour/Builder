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
    public static function create($type, $id, $content)
    {
        $path = CACHE . "/{$type}/{$id}.json";
        
        if (!file_exists($typePath))
        {
            mkdir(CACHE . "/{$type}");
        }

        \file_put_contents($path, json_encode($content));
        return json_encode($content);
    }

    /**
     * Get cache item
     * @param string content type
     * @param string content id
     * @return object
     */
    public static function get($type, $id)
    {
        return \file_get_contents(CACHE . "/{$type}/{$id}.json");
    }

    /**
     * Update cache item
     * @param string content type
     * @param string content id
     * @param array content
     * @return void
     */
    public static function update($type, $id, $content)
    {
        self::create($type, $id, $content);
    }

    /**
     * Get cache item or create new cache item
     * @param string content type
     * @param string content id
     * @param array content
     */
    public static function getOrCreate($type, $id, $content)
    {
        if (self::exists($type, $id))
        {
            return self::get($type, $id);
        }

        return self::create($type, $id, $content);
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

        return file_exists(CACHE . "/{$type}/{$id}");
    }

}
