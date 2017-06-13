<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */

use Phalcon\Mvc\Router;

// Create the router
$router = new Router();



/*
-- -----------------------------------------------------
-- Routes for brothers
-- -----------------------------------------------------
*/

$router->addPost('/brothers', [
    'controller' => 'brothers',
    'action'     => 'create'
]);

$router->addGet('/brothers', [
    'controller' => 'brothers',
    'action'     => 'readAll'
]);

$router->addGet('/brothers/{id}', [
    'controller' => 'brothers',
    'action'     => 'read'
]);

$router->addPut('/brothers/{id:[0-9]+}', [
    'controller' => 'brothers',
    'action' => 'update'
]);

$router->addDelete('/brothers/{id:[0-9]+}', [
    'controller' => 'brothers',
    'action' => 'delete'
]);



/*
-- -----------------------------------------------------
-- Routes for allocations
-- -----------------------------------------------------
*/



$router->addPost('/allocations', [
    'controller' => 'allocations',
    'action' => 'create'
]);

$router->addGet('/allocations', [
    'controller' => 'allocations',
    'action'     => 'readAll'
]);

$router->addGet('/allocations/{id:[0-9]+}', [
    'controller' => 'allocations',
    'action' => 'read'
]);

$router->addPut('/allocations/{id:[0-9]+}', [
    'controller' => 'allocations',
    'action' => 'update'
]);

$router->addDelete('/allocations/{id:[0-9]+}', [
    'controller' => 'allocations',
    'action' => 'delete'
]);




/*
-- -----------------------------------------------------
-- Routes for items
-- -----------------------------------------------------
*/

$router->addPost('/items', [
    'controller' => 'items',
    'action' => 'create'
]);

$router->addGet('/items/{id:[0-9]+}', [
    'controller' => 'items',
    'action' => 'read'
]);

$router->addPut('/items/{id:[0-9]+}', [
    'controller' => 'items',
    'action' => 'update'
]);

$router->addDelete('/items/{id:[0-9]+}', [
    'controller' => 'items',
    'action' => 'delete'
]);







return $router;