<?php

namespace Core;

use Core\Cache;
use Core\Helper;

class View
{
    /**
     * View path
     * @var string
     */
    public static $views;

    /**
     * Component path
     * @var string
     */
    public static $components;

    /**
     * Layout path
     * @param string
     */
    public static $layouts;

    /**
     * Set up instance for first time
     * @param string view path
     * @param string component path
     * @return void
     */
    public static function setup($views = null, $layouts = null, $components = null)
    {
        if (!self::$views)
        {
            if ($views === null)
            {
                self::$views = VIEWS;
            }
            else
            {
                self::$views = $views;
            }
        }

        if (!self::$layouts)
        {
            if ($layouts === null)
            {
                self::$layouts = VIEWS . DIRECTORY_SEPARATOR . 'Layouts';
            }
            else
            {
                self::$layouts = $layouts;
            }
        }

        if (!self::$components)
        {
            if ($components === null)
            {
                self::$components = VIEWS . DIRECTORY_SEPARATOR . 'Components';
            }
            else
            {
                self::$components = $components;
            }
        }
    }

    /**
     * Get contents layout
     * @param string layout path
     * @return string contents
     */
    public static function getLayout($path)
    {
        return Helper::getContents(self::$layouts . DIRECTORY_SEPARATOR . $path);
    }

    /**
     * Get contents view
     * @param string view path
     * @return string contents
     */
    public static function getView($path)
    {
        return Helper::getContents(self::$views . DIRECTORY_SEPARATOR . $path);
    }

    /**
     * Get contents component
     * @param string component path
     * @return string contents
     */
    public static function getComponent($path)
    {
        return Helper::getContents(self::$components . DIRECTORY_SEPARATOR . $path);
    }

    /**
     * Set content for layout
     * @param string layout path
     * @param string content
     * @return string full content
     */
    public static function setLayoutContent($path, $content)
    {
        return \preg_replace("/\{\{\s*(?:content)\s*\}\}/", $content, self::getLayout($path));
    }

    /**
     * Serve view
     * @param string path
     * @param string layout
     * @return string content
     */
    public static function serve($path, $layout = null)
    {
        include CORE . '/Component.php';

        $view = self::getView($path);

        if ($layout !== null)
        {
            return self::setLayoutContent($layout, $view);
        }
        else
        {
            return $template;
        }
    }

}
