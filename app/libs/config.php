<?php

class Config {
    //incluimos datos a la conexión de la BD
public static $db_hostname = "localhost";
public static $db_nombre = "PalsPlans"; //nombre de la base de datos

public static $db_usuario = "ivan";
public static $db_clave = "25121998";

//incluimos informacion para el guardado de imagenes
public static $extensionesValidas=["jpeg","jpg","png"];
public static $dir_usuario=__DIR__.DIRECTORY_SEPARATOR."../archivos/img/perfil".DIRECTORY_SEPARATOR;
public static $dir_circulo=__DIR__.DIRECTORY_SEPARATOR."../archivos/img/circulo".DIRECTORY_SEPARATOR;
public static $max_file_size=2000000;

//formato fecha
public static $formatoF="Y-m-d";




}
