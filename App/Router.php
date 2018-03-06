<?php

function routes($collection)
{
    $collection->get('/user', 'UserController.index');
    $collection->get('/user/{id}', 'UserController.detail');
} 
