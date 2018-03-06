<?php

function Component($path)
{
    return \Core\View::getComponent($path);
}

function View($path, $layout)
{
    return \Core\View::serve($path, $layout);
}
