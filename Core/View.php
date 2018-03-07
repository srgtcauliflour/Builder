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
     * Extend the view
     * @param string view path
     * @return string view
     */
    public static function extend($view)
    {
        $pattern = self::matchFunc('extends', 2);
        $viewContent = self::getView($view);

        preg_match($pattern, $viewContent, $matches);
        array_shift($matches);

        if (count($matches) === 0)
        {
            return $viewContent;
        }

        $viewContent = preg_replace($pattern, "", $viewContent);

        $layoutContent = self::getLayout($matches[0]);
        $placePattern = self::matchBrackets($matches[1]);

        return preg_replace($placePattern, $viewContent, $layoutContent);
    }

    /**
     * Serve view
     * @param string path
     * @param string layout
     * @return string content
     */
    public static function serve($path)
    {
        include CORE . '/Component.php';

        return self::extend($path);
    }

    private static function matchBrackets($name)
    {
        return "/\{\{\s*(".$name.")\s*\}\}/";
    }

    private static function matchFunc($name, $numArguments)
    {
        $quotation = "(?:\\\"|\')";

        $pattern = "";
        $pattern .= "@{$name}\s*\(\s*";
        for ($i = 0; $i < $numArguments; $i++)
        {
            $pattern .= $quotation;
            $pattern .= "\s*(.*)\s*";
            $pattern .= $quotation;
            $pattern .= "\s*\,\s*";
        }
        $pattern = rtrim($pattern, "\,\s*");
        $pattern .= "\s*\)\s*\;";

        return "/{$pattern}/";
    }

}
