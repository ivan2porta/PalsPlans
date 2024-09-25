<?php
include ('../libs/config.php');
try {

    $pdo = new PDO('mysql:host='.Config::$db_hostname, Config::$db_usuario, Config::$db_clave);

    $pdo->exec("set names utf8");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlBD = file_get_contents("../../web/BDPalsPlans.sql");

    $pdo->exec($sqlBD);

    $pdo = null;
} catch (PDOException $e) {

    error_log($e->getMessage() . "## Fichero: " . $e->getFile() . "## Línea: " . $e->getLine() . "##Código: " . $e->getCode() . "##Instante: " . microtime() . PHP_EOL, 3, "logBD.txt");

    $errores['datos'] = "Ha habido un error <br>";

    echo($errores['datos']);
}