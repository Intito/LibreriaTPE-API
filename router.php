<?php
    require_once 'libs/router.php';
    require_once 'app/controllers/bookApiController.php';
    
    $router = new Router();

    #                 endpoint        verbo      controller              metodo
    $router->addRoute('libros'      , 'GET',     'BookApiController',   'getAll');
    $router->addRoute('libros/:id'  , 'GET',     'BookApiController',   'get'   );
    $router->addRoute('libros/:id'  , 'DELETE',  'BookApiController',   'delete');
    $router->addRoute('libros'  ,     'POST',    'BookApiController',   'create');
    $router->addRoute('libros/:id'  , 'PUT',     'BookApiController',   'update');
    
    $router->addRoute('usuarios/token', 'GET',     'UserApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);