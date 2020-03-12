<?php
date_default_timezone_set('America/Lima');

// Requiere una sola vez de las librerias necesarias
require_once 'lib/db/database.php';
require_once 'lib/auth/auth.factory.php';
require_once 'lib/mis_helpers.php';
require_once 'vendor/autoload.php';

// Se define metodo de autenticacion de 3 opciones posibles: session|db|token
define('__AUTH__', 'token');
define('__SECRET_KEY__', 'asdawdsd8ws.6@');

// Definicion de controlador por defecto - Auth para validar datos de Login
$controller = 'auth';

// Todo esta lógica hara el papel de un FrontController
// Validamos si existe se ha llamado un controlador
if(!isset($_REQUEST['c']))
{
    // No se ha llamado un controlador por ello se carga el definido por defecto
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    // Se hace un llamado al metodo index del controlador por defecto para cargar la vista inicial
    $controller->Index();
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}