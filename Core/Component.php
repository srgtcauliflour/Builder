<?php

function Component($path)
{
    return \Core\View::getComponent($path);
}

function View($path)
{
    return \Core\View::serve($path);
}
