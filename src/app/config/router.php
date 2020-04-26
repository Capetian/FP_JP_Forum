<?php

$router = $di->getRouter();

// $router->add('/', [

//     'controller' => 'Index',
//     'action' => 'index'
// ]);

$router->add('/:controller/:action', array(
    'controller' => 1,
    'action' => 2
));

$router->add('/:controller/:action/:params', array(
    'controller' => 1,
    'action' => 2,
    'params' => 3
));	

// $router->addGet('/register', [

//     'controller' => 'Index',
//     'action' => 'register'
// ]);

// $router->addPost('/post_register', [

//     'controller' => 'Index',
//     'action' => 'store'
// ]);

// $router->addGet('/login', [


//     'controller' => 'Index',
//     'action' => 'login'
// ]);

// $router->addPost('/post_login', [


//     'controller' => 'Index',
//     'action' => 'signin'
// ]);

// $router->addGet('/logout', [


//     'controller' => 'Index',
//     'action' => 'logout'
// ]);




// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);
