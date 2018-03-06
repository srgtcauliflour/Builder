<?php

function middleware($collection)
{
    $collection->add('UserController.detail', 'User.denyDetails');
}
