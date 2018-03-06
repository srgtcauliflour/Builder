<?php

function routes($collection)
{
    $collection->get('/user', 'UserController.index');
    $collection->get('/user/{id}', 'UserController.detail');
    $collection->post('/user', 'UserController.store');
    $collection->put('/user/{id}', 'UserController.update');
} 
