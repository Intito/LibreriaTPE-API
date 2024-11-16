<?php
    require_once 'libs/router.php';
    require_once 'app/controllers/bookApiController.php';
    require_once 'app/controllers/authorApiController.php';
    
    $router = new Router();

    #                 endpoint        verbo      controller              metodo
    $router->addRoute('libros'      , 'GET',     'BookApiController',   'getAll');
    $router->addRoute('libros/:id'  , 'GET',     'BookApiController',   'get'   );
    $router->addRoute('libros/:id'  , 'DELETE',  'BookApiController',   'delete');
    $router->addRoute('libros'  ,     'POST',    'BookApiController',   'create');
    $router->addRoute('libros/:id'  , 'PUT',     'BookApiController',   'update');

    $router->addRoute('autores'     , 'GET',     'AuthorApiController', 'getAll');
    $router->addRoute('autores/:id' , 'GET',     'AuthorApiController', 'get');
    $router->addRoute('autores/:id' , 'DELETE',  'AuthorApiController', 'delete');
    $router->addRoute('autores'     , 'POST',    'AuthorApiController', 'create');
    $router->addRoute('autores/:id' , 'PUT',     'AuthorApiController', 'update');
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);