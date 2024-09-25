<?php
require_once __DIR__ . '/../app/modelo/classModelo.php';
require_once __DIR__ . '/../app/modelo/classConsultas.php';
require_once __DIR__ . '/../app/libs/config.php';
require_once __DIR__ . '/../app/libs/bGeneral.php';
require_once __DIR__ . '/../app/controlador/controller.php';

session_start(); // Se inicia la sesion
//Este logueado o no el usuario, siempre tendra un nivel_usuario

if (!isset($_SESSION['nivel'])) {
    $_SESSION['nivel'] = 0;
}


/**
 * Enrutamiento
 * Le añadimos el nivel mínimo que tiene que tener el usuario para ejecutar la acción
 *
 * controller se refiere a controller.php
 * Controller.php se refiere a la clase Controller dentro de controller.php
 * action lo que va a hacer
 * home la función home dentro de la clase controller
 * nivel el nivel del usuario
 **/

$map = array(
    'iniciarSesion' => array('controller' => 'Controller', 'action' => 'iniciarSesion', 'nivel' => 0),
    'crearPlan' => array('controller' => 'Controller', 'action' => 'crearPlan', 'nivel' => 1),
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel' => 1),
    'crearCirculo' => array('controller' => 'Controller', 'action' => 'crearCirculo', 'nivel' => 1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'nivel' => 1),
    'buscarUsuario' => array('controller' => 'Controller', 'action' => 'buscarUsuario', 'nivel' => 1),
    'buscarCirculo' => array('controller' => 'Controller', 'action' => 'buscarCirculo', 'nivel' => 1),
    'circulo' => array('controller' => 'Controller', 'action' => 'circulo', 'nivel' => 1),
    'cerrarSesion' => array('controller' => 'Controller', 'action' => 'cerrarSesion', 'nivel' => 1),
    'plan' => array('controller' => 'Controller', 'action' => 'plan', 'nivel' => 1),
    'perfil' => array('controller' => 'Controller', 'action' => 'perfil', 'nivel' => 1),
    'panelAdmin' => array('controller' => 'Controller', 'action' => 'panelAdmin', 'nivel' => 2),
    'solicitudes' => array('controller' => 'Controller', 'action' => 'solicitudes', 'nivel' => 1)

);


// Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {

        $ruta = "error";
    }
} else {
    $ruta = 'inicio';
}
$controlador = $map[$ruta];
/*
Comprobamos si el metodo correspondiente a la acción relacionada con el valor de ctl existe,
si es así ejecutamos el método correspondiente.
En caso de no existir cabecera de error.
En caso de estar utilizando sesiones y permisos en las diferentes acciones comprobariamos tambien
si el usuario tiene permiso suficiente para ejecutar esa acción
*/

if (method_exists($controlador['controller'], $controlador['action'])) {

    if ($controlador['nivel'] <= $_SESSION['nivel']) {
        call_user_func(
            array(
                new $controlador['controller'],
                $controlador['action']
            )
        );
    } else {
        call_user_func(
            array(
                new $controlador['controller'],
                'inicio'
            )
        );
    }
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
    //console_log("entrarErrorInicio");
}
