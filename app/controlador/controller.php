<?php

require __DIR__ . '/../composer/vendor/autoload.php';

require __DIR__ . '/../composer/vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../composer/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Controller
{
    public function solicitudes()
    {


        try {
            $cts = new Consultas();
            if ((isset($_POST["bAceptarSolCirculo"]))) {
                $params["IdGrupo"] = recoge("bAceptarSolCirculo");
                $cts->confirmarParticipacionGrupo($_SESSION["id_user"], $params["IdGrupo"]);

                $planesGrupoSinConfirmar = $cts->obtenerPlanesGrupoParaConfirmar($params["IdGrupo"], date("Y-m-d"));

                for ($i = 0; $i < count($planesGrupoSinConfirmar); $i++) {
                    $plan = $planesGrupoSinConfirmar[$i];
                    $cts->agregarParticipacionPlan($plan["IdActividad"], $_SESSION["id_user"], $plan["IdGrupo"], false);
                }

                header("Refresh:0");

            }

            if ((isset($_POST["bRechazarSolCirculo"]))) {
                $params["IdGrupo"] = recoge("bRechazarSolCirculo");
                $cts->eliminarParticipacionGrupo($_SESSION["id_user"], $params["IdGrupo"]);
                header("Refresh:0");

            }

            if ((isset($_POST["bAceptarSolPlan"]))) {
                $params["IdPlan"] = recoge("bAceptarSolPlan");
                $cts->confirmarParticipacionPlan($_SESSION["id_user"], $params["IdPlan"]);
                header("Refresh:0");
            }

            if ((isset($_POST["bRechazarSolPlan"]))) {
                $params["IdPlan"] = recoge("bRechazarSolPlan");
                $cts->eliminarParticipacionPlan($_SESSION["id_user"], $params["IdPlan"]);
                header("Refresh:0");
            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/solicitudes.php';
    }

    public function panelAdmin()
    {

        $params = array(
            "busqueda" => ''
        );

        if (isset($_POST["bBuscarUsuario"])) {
            $params = array(
                "busqueda" => '',
                "user" => '',
                "mensaje" => []
            );
            $params["busqueda"] = recoge("buscar_usuario");
            header('Location: index.php?ctl=buscarUsuario&busqueda=' . $params["busqueda"] . '');
            exit();
        }

        if (isset($_POST["bBuscarCirculo"])) {
            $params = array(
                "busqueda" => '',
                "circulo" => '',
                "mensaje" => []
            );
            $params["busqueda"] = recoge("buscar_circulo");
            header('Location: index.php?ctl=buscarCirculo&busqueda=' . $params["busqueda"] . '');
            exit();
        }

        require __DIR__ . '/../../web/templates/panelAdmin.php';
    }

    public function iniciarSesion()
    {
        try {

            if ($_SESSION['nivel'] > 0) {
                header("location:index.php?ctl=inicio");
            }

            if (isset($_POST["bLogin"])) {

                $params = array(
                    'mail' => '',
                    'pass' => '',
                );

                $params["mail"] = recoge("mail");
                $params["pass"] = recoge("pass");
                $cs = new Consultas();
                if (!$usuario = $cs->verificarEmail($params["mail"])) {
                    $params['mensaje'] = "El correo no existe";
                } else {
                    if ($cs->verificarPass($params["mail"], $params["pass"])) {
                        $usuario = $cs->buscarFila($params["mail"], "usuario", "Email");
                        session_unset();
                        session_destroy();
                        session_start();
                        if ($usuario['Activo'] == 1) {
                            $_SESSION['id_user'] = $usuario['IdUsuario'];
                            $_SESSION['nombre'] = $usuario['Nombre'];
                            $_SESSION['email'] = $usuario['Email'];
                            $_SESSION["pass"] = $usuario['Contrasena'];
                            $_SESSION['f_nacimiento'] = $usuario['FechaNacimiento'];
                            $_SESSION['foto_perfil'] = $usuario['FotoPerfil'];
                            $_SESSION['nivel'] = $usuario['Nivel'];
                            $_SESSION['descripcion'] = $usuario['descripcion'];
                            $_SESSION['mensaje'] = "";
                            header('Location: index.php?ctl=inicio');
                        } else {
                            $params["mensaje"] = "No se ha completado la autentificación por correo";
                            header('Location: index.php?ctl=error');
                        }
                    } else {
                        $params["mensaje"] = "La contraseña es incorrecta";
                    }
                }
            }

            if ((isset($_POST["bReg2"]))) {

                $params = array(
                    'nombre' => '',
                    'mail' => '',
                    'pass' => '',
                    'pass2' => '',
                    'fecha' => '',
                    'descripcion' => '',
                    'archivo' => '',
                    'nivel' => 1,
                    'activo' => false,
                    'mensaje' => []
                );

                //recogemos datos de los inputs
                $params["nombre"] = recoge("nombre");
                $params["mail"] = recoge("mail");
                $params["pass"] = recoge("pass");
                $params["pass2"] = recoge("pass2");
                $params["fecha"] = recoge("fecha");
                $params["descripcion"] = recoge("descripcion");

                //comenzamos las validaciones
                if (empty($params["nombre"])) {
                    $params["mensaje"] = "Por favor ingrese un nombre";
                } else {
                    $params["nombre"] = sinEspacios($params["nombre"]);
                }

                cEmail($params["mail"], $params, "mensaje", 30, 8);

                if (!cPassword($params["pass"], $params["mensaje"]) && $params["pass"] !== $params["pass2"]) {
                    $params["mensaje"] = "Las contraseñas no coinciden";
                }

                cFecha($params["fecha"], $params);

                if (empty($params["mensaje"] && $params["archivo"])) {
                    $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/perfil/', Config::$max_file_size);

                    if (empty($params["archivo"])) {
                        $params["archivo"] = "default.jpg";
                    }
                    try {
                        $cs = new Consultas();
                        $hash = password_hash($params["pass"], PASSWORD_BCRYPT);
                        if ($usuario = $cs->agregarNuevoUsuario($params["nombre"], $params["mail"], $hash, $params["descripcion"], $params["fecha"], $params["archivo"], $params["nivel"], $params["activo"])) {

                            $idUsuario = $cs->buscar($params["mail"], "usuario", "IdUsuario", "Email");

                            $fechaRegistro = time() + 86400;

                            $token = uniqid();

                            $cs->agregarToken($token, $fechaRegistro, $idUsuario);

                            $mailer = new PHPMailer(true);

                            try {
                                // Configura el servidor SMTP
                                $mailer->isSMTP();
                                $mailer->Host = 'smtp.gmail.com';
                                $mailer->SMTPAuth = true;
                                $mailer->Username = 'carmen33ivan@gmail.com';
                                $mailer->Password = 'emvq uypi bakh wjuj ';
                                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mailer->Port = "465";

                                // Configura los destinatarios
                                $mailer->setFrom('carmen33ivan@gmail.com', 'Carmen_Ivan');
                                $mailer->addAddress($params["mail"], $params["nombre"]);

                                // Contenido del correo
                                $mailer->isHTML(true);
                                $mailer->Subject = 'Activa tu cuenta de PalsPlans';
                                $mailer->Body = 'Activa tu cuenta con este enlace: http://localhost/DWES/GitRepos/InkByte/web/index.php?ctl=activarCuenta&token=' . $token;

                                // Enviar el correo
                                $mailer->send();
                                echo 'El correo se ha enviado con éxito.';
                            } catch (Exception $e) {
                                echo "El correo no se pudo enviar. Error: {$mailer->ErrorInfo}";
                            }
                            header('Location: index.php?ctl=iniciarSesion');
                        } else {
                            $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario.';
                        }
                    } catch (Exception $e) {
                        // En este caso guardamos los errores en un archivo de errores log
                        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logs/logBD.txt");
                        // guardamos en ·errores el error que queremos mostrar a los usuarios
                        header('Location: index.php?ctl=error');
                    } catch (Error $e) {
                        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                        header('Location: index.php?ctl=error');
                    }
                }

            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/inicioSesion.php';
    }




    public function inicio()
    {
        if ($_SESSION['nivel'] < 1) {
            header("location:index.php?ctl=iniciarSesion");
        } else if ($_SESSION['nivel'] > 1) {
            header("location:index.php?ctl=panelAdmin");
        }

        if ((isset($_POST["verGrupo"]))) {
            $params["IdGrupo"] = recoge("id_grupo");
            header("'Location: index.php?ctl=circulo&id=" . $params["IdGrupo"]);
        }



        try {



            $cs = new Consultas();
            $planesUsuario = $cs->obtenerPlanesUsuarioConfirmado($_SESSION["id_user"]);
            $MisGrupos = $cs->obtenerGruposUsuarioConfirmado($_SESSION["id_user"]);
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);




        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/inicio.php';
    }



    public function activarCuenta()
    {
        $token = $_GET['token'];
        try {
            $cs = new Consultas();

            if ($cs->verificarToken($token)) {
                if ($cs->validarFechaValidezPorToken($token)) {
                    $cs->activarUsuarioPorToken($token);
                    $cs->borrarToken($token);
                    header("location:index.php?ctl=inicio");
                }
            }

        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }
    }

    public function cerrarSesion()
    {
        session_unset();
        session_destroy();
        header("location:index.php?ctl=inicio");
        exit();
    }


    public function error()
    {
        require __DIR__ . '/../../web/templates/error.php';
    }

    public function perfil()
    {


        try {
            $cs = new Consultas();
            $usuario = $cs->buscarFila($_GET["user"], "usuario", "IdUsuario");
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);
            $planesUsuario = $cs->obtenerPlanesUsuarioConfirmado($_GET["user"]);
            $grupos = $cs->obtenerGruposUsuarioConfirmado($_GET["user"]);

            if (isset($_POST["bEliminarUsuario"])) {
                $cs->eliminarUsuario($_GET["user"]);
                header('Location: index.php?ctl=inicio');
            }

            if (isset($_POST["bEditarPerfil2"])) {
                $params = array(
                    'pass' => '',
                    'pass2' => '',
                    'fecha' => '',
                    'descripcion' => '',
                    'archivo' => '',
                    'mensaje' => []
                );

                //recogemos datos de los inputs


                $params["pass"] = recoge("pass");
                $params["pass2"] = recoge("pass2");
                $params["fecha"] = recoge("fecha");
                $params["descripcion"] = recoge("descripcion");
                $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/perfil/', Config::$max_file_size);

                if (!empty($params["pass"])) {
                    if (!cPassword($params["pass"], $params["mensaje"]) && $params["pass"] !== $params["pass2"]) {
                        $params["mensaje"] = "Las contraseñas no coinciden";
                    }
                } else {
                    $params["pass"] = $_SESSION["pass"];
                    $params["pass"] = password_hash($params["pass"], PASSWORD_BCRYPT);
                }

                if (!empty($params["fecha"])) {
                    cFecha($params["fecha"], $params);
                } else {
                    $params["fecha"] = $_SESSION["f_nacimiento"];
                }

                if (empty($params["descripcion"])) {
                    $params["descripcion"] = $_SESSION["descripcion"];
                }

                if (empty($params["archivo"])) {
                    $params["archivo"] = $_SESSION["foto_perfil"];
                }

                $cs->actualizarUsuario($_SESSION["id_user"], $params["pass"], $params["fecha"], $params["descripcion"], $params["archivo"]);

                $_SESSION["pass"] = $params["pass"];
                $_SESSION["f_nacimiento"] = $params["fecha"];
                $_SESSION["descripcion"] = $params["descripcion"];
                $_SESSION["foto_perfil"] = $params["archivo"];
            }

            if (isset($_POST["btnInvitar"])) {
                $params = array(
                    "grupo" => '',
                    "user" => '',
                    "mensaje" => []
                );
                $params["grupo"] = recoge("grupoInvitar");
                $params["user"] = recoge("idUsuarioInvitar");



                try {

                    $cs = new Consultas();

                    $cs->agregarParticipacionGrupo($params["user"], $params["grupo"], date("Y-m-d"), false);
                    $gruposUsuario = $cs->obtenerGruposUsuario($params["user"]);

                } catch (Exception $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                    header('Location: index.php?ctl=error');
                }


            }

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/perfil.php';
    }

    public function circulo()
    {


        if (isset($_REQUEST["bCrearPlan"])) {
            $params = array(
                "nombre" => "",
                "desc" => "",
                "pres" => "",
                "ubi" => "",
                "fi" => "",
                "ff" => "",
                "fc" => "",
                "archivo" => "",
                "mensaje" => []
            );
            $params["nombre"] = recoge("nombrePlan");
            if (empty($params["nombre"])) {
                $params["mensaje"] = "El campo nombrePlan está vacío";
            }

            $params["desc"] = recoge("descripcion");
            if (empty($params["desc"])) {
                $params["mensaje"] = "El campo descripcion está vacío";
            }

            $params["pres"] = recoge("presupuestoEstimado");
            if (!isset($params["pres"]) || $params["pres"] === "") {
                $params["mensaje"] = "El campo presupuestoEstimado está vacío";
            }

            $params["ubi"] = recoge("ubi");
            if (empty($params["ubi"])) {
                $params["mensaje"] = "El campo ubi está vacío";
            }

            $params["fi"] = recoge("fechaInicio");
            if (empty($params["fi"])) {
                $params["mensaje"] = "El campo fechaInicio está vacío";
            }

            $params["ff"] = recoge("fechaFinalizacion");
            if (empty($params["ff"])) {
                $params["mensaje"] = "El campo fechaFinalizacion está vacío";
            }

            $params["fc"] = recoge("fechaConfirmacion");
            if (empty($params["fc"])) {
                $params["mensaje"] = "El campo FechaConfirmacion está vacío";
            }


            if (empty($params["mensaje"])) {
                $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/planes/', Config::$max_file_size);

                if (empty($params["archivo"])) {
                    $params["archivo"] = "logo-color.png";
                }

                try {
                    $cs = new Consultas();
                    $cs->crearPlan($params["nombre"], $params["ff"], $params["pres"], $params["ubi"], $params["desc"], $params["fc"], $params["fi"], $_SESSION["id_user"], $params["archivo"], $_GET["id"]);
                    $plan = $cs->buscar2Campos($params["nombre"], $_GET["id"], "plan", "IdActividad", "Nombre", "IdGrupo");
                    $cs->agregarParticipacionPlan($plan, $_SESSION["id_user"], $_GET["id"], true);
                    $usuariosDelGrupo = $cs->obtenerUsuariosPorGrupo($_GET["id"]);
                    for ($i = 0; $i < count($usuariosDelGrupo); $i++) {
                        $usuario = $usuariosDelGrupo[$i];
                        if ($_SESSION["id_user"] != $usuario["IdUsuario"]) {
                            $cs->agregarParticipacionPlan($plan, $usuario["IdUsuario"], $_GET["id"], false);
                        }
                    }
                    header("'Location: index.php?ctl=circulo&id=" . $_GET["id"]);



                } catch (Exception $e) {
                    //error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");

                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    //error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");

                    header('Location: index.php?ctl=error');
                }
            }

        }

        if ((isset($_POST["bVerPlan"]))) {
            $idPlan = recoge("idPlan");
            $ubi = recoge("ubi");
            header("'Location: index.php?ctl=plan&idPlan=" . $idPlan . '&u=' . $params["ubi"]);
        }

        if ((isset($_POST["bExpulsarGrupo"]))) {
            $idGrupoEl = recoge("idGrupoEl");
            $idUsuarioEl = recoge("idUsuarioEl");

            try {

                $cs = new Consultas();
                $cs->eliminarParticipacionGrupo($idUsuarioEl, $idGrupoEl);
                $cs->eliminarParticipacionesPlan($idUsuarioEl, $idGrupoEl);

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        if ((isset($_POST["bSalirCirculo"]) || isset($_POST["bSalirCirculoMovil"]))) {
            $idGrupoSal = $_GET["id"];
            $idUsuarioSal = $_SESSION["id_user"];

            try {

                $cs = new Consultas();
                $cs->eliminarParticipacionGrupo($idUsuarioSal, $idGrupoSal);
                $cs->eliminarParticipacionesPlan($idUsuarioSal, $idGrupoSal);
                header('Location: index.php?ctl=inicio');

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        if (isset($_POST["bEliminarCirculo"]) || isset($_POST["bEliminarCirculoMovil"])) {
            $idGrupoEl = $_GET["id"];

            try {

                $cs = new Consultas();
                $cs->eliminarCirculo($idGrupoEl);
                header('Location: index.php?ctl=inicio');

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        if (isset($_POST["bEditarCirculo2"])) {

            try {

                $cs = new Consultas();
                $grupoActual = $cs->buscarFila($_GET["id"], "grupo", "IdGrupo");

                $params = array(
                    'nombreg' => '',
                    'descripcion' => '',
                    'archivo' => '',
                    'mensaje' => []
                );

                $params["nombreg"] = recoge("nombreg");
                $params["descripcion"] = recoge("descripcion");

                if (empty($params["nombreg"])) {
                    $params["nombreg"] = $grupoActual["Nombre"];
                }

                if (empty($params["descripcion"])) {
                    $params["descripcion"] = $grupoActual["Descripcion"];
                }

                $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/circulos/', Config::$max_file_size);

                if (empty($params["archivo"])) {
                    $params["archivo"] = $grupoActual["FotoGrupo"];
                }

                $cs->actualizarCirculo($grupoActual["IdGrupo"], $params["nombreg"], $params["descripcion"], $params["archivo"]);

                //header('Location: index.php?ctl=inicio');

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }



        try {

            $cs = new Consultas();
            $planesDeGrupo = $cs->obtenerPlanesGrupo($_GET["id"]);
            $datosCirculo = $cs->buscarFila($_GET['id'], "grupo", "IdGrupo");
            $miembrosCirculo = $cs->obtenerMiembrosGrupo($_GET['id']);
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../../web/templates/circulo.php';
    }

    public function plan()
    {


        try {

            $cs = new Consultas();
            $plan = $cs->buscarFila($_GET["idPlan"], "plan", "IdActividad");
            $usuarios = $cs->obtenerUsuariosDePlan($_GET["idPlan"]);
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);
            $grupo = $cs->obtenerGrupoActividad($plan["IdActividad"]);
            $participacion = $cs->participaEnPlan($_SESSION["id_user"], $plan["IdActividad"]);

        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }

        if (isset($_REQUEST["bePlan"])) {
            $params = array(
                "nombre" => "",
                "desc" => "",
                "pres" => "",
                "ubi" => "",
                "fi" => "",
                "ff" => "",
                "fc" => "",
                "archivo" => "",
                "mensaje" => []
            );
            $params["nombre"] = recoge("nombrePlan");
            if (empty($params["nombre"])) {
                $params["nombre"] = $plan["Nombre"];
            }

            $params["desc"] = recoge("descripcion");
            if (empty($params["desc"])) {
                $params["desc"] = $plan["Descripcion"];
            }

            $params["pres"] = recoge("presupuestoEstimado");
            if (!isset($params["pres"]) || $params["pres"] === "") {
                $params["pres"] = $plan["PresupuestoEstimado"];
            }

            $params["ubi"] = recoge("ubi");
            if (empty($params["ubi"])) {
                $params["ubi"] = $plan["Ubicacion"];
            }

            $params["fi"] = recoge("fechaInicio");
            if (empty($params["fi"])) {
                $params["fi"] = $plan["FechaRealizacion"];
            }

            $params["ff"] = recoge("fechaFinalizacion");
            if (empty($params["ff"])) {
                $params["ff"] = $plan["FechaFin"];
            }

            $params["fc"] = recoge("fechaConfirmacion");
            if (empty($params["fc"])) {
                $params["fc"] = $plan["FechaLimiteConfirmacion"];
            }


            if (empty($params["mensaje"])) {
                $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/planes/', Config::$max_file_size);

                if (empty($params["archivo"])) {
                    $params["archivo"] = $plan["FotoActividad"];
                }

                try {
                    $cs = new Consultas();
                    $cs->actualizarPlan($_GET["idPlan"], $params["nombre"], $params["ff"], $params["pres"], $params["ubi"], $params["desc"], $params["fc"], $params["fi"], $params["archivo"]);
                    header("Refresh:0");
                    exit();


                } catch (Exception $e) {
                    //error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");

                    header('Location: index.php?ctl=error');
                } catch (Error $e) {
                    //error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");

                    header('Location: index.php?ctl=error');
                }
            }

        }

        if ((isset($_POST["bExpulsarPlan"]))) {
            $idPlanEl = recoge("idPlanEl");
            $idUsuarioEl = recoge("idUsuarioEl");

            try {

                $cs = new Consultas();
                $cs->eliminarParticipacionPlan($idUsuarioEl, $idPlanEl);
                header("Refresh:0");
                exit();

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        if ((isset($_POST["bUnirmePlan"]))) {

            try {

                $cs = new Consultas();
                $cs->confirmarParticipacionPlan($_SESSION["id_user"], $_GET["idPlan"]);
                $grupo = $cs->obtenerGrupoActividad($_GET["idPlan"]);
                $cs->agregarParticipacionPlan($_GET["idPlan"], $_SESSION["id_user"], $grupo["IdGrupo"], true);
                header("Refresh:0");
                exit();

            } catch (Exception $e) {
                $cs->confirmarParticipacionPlan($_SESSION["id_user"], $_GET["idPlan"]);
                header("Refresh:0");
            } catch (Error $e) {
                $cs->confirmarParticipacionPlan($_SESSION["id_user"], $_GET["idPlan"]);
                header("Refresh:0");
            }
        }

        if ((isset($_POST["bEliminarPlan"]))) {

            try {

                $cs = new Consultas();
                $cs->eliminarPlan($_GET["idPlan"]);
                header("Refresh:0");
                exit();

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        if ((isset($_POST["bSalirPlan"]))) {
            $idPlanEl = $_GET["idPlan"];
            $idUsuarioEl = $_SESSION["id_user"];

            try {

                $cs = new Consultas();
                $grupo = $cs->obtenerGrupoActividad($_GET["idPlan"]);
                $cs->eliminarParticipacionPlan($idUsuarioEl, $idPlanEl);
                header("Location: index.php?ctl=circulo&id=" . $grupo["IdGrupo"]);
                exit();

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }
        }

        require __DIR__ . '/../../web/templates/plan.php';
    }

    public function buscarUsuario()
    {

        $params = array(
            "busqueda" => ''
        );

        if (isset($_POST["bBuscar"])) {
            $params = array(
                "busqueda" => '',
                "user" => '',
                "mensaje" => []
            );
            $params["busqueda"] = recoge("buscar_usuario");
            $params["user"] = recoge("idUsuarioInvitar");
            header('Location: index.php?ctl=buscarUsuario&busqueda=' . $params["busqueda"] . '');
            exit();
        }

        if (isset($_POST["btnInvitar"])) {
            $params = array(
                "grupo" => '',
                "user" => '',
                "mensaje" => []
            );
            $params["grupo"] = recoge("grupoInvitar");
            $params["user"] = recoge("idUsuarioInvitar");



            try {

                $cs = new Consultas();

                $cs->agregarParticipacionGrupo($params["user"], $params["grupo"], date("Y-m-d"), false);
                $gruposUsuario = $cs->obtenerGruposUsuario($params["user"]);

            } catch (Exception $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                header('Location: index.php?ctl=error');
            } catch (Error $e) {
                error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                header('Location: index.php?ctl=error');
            }


        }

        try {

            $cs = new Consultas();

            $usuarios = $cs->obtenerUsuariosPorNombreOrdenados($_GET['busqueda']);
            $gruposDeUsuario = $cs->obtenerGruposDeUsuario($_SESSION["id_user"]);
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);



        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/buscarUsuario.php';
    }

    public function buscarCirculo()
    {

        $params = array(
            "busqueda" => ''
        );

        if (isset($_POST["bBuscar"])) {
            $params = array(
                "busqueda" => '',
                "circulo" => '',
                "mensaje" => []
            );
            $params["busqueda"] = recoge("buscar_circulo");
            header('Location: index.php?ctl=buscarCirculo&busqueda=' . $params["busqueda"] . '');
            exit();
        }



        try {

            $cs = new Consultas();

            $grupos = $cs->obtenerGruposPorNombreOrdenados($_GET['busqueda']);



        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/buscarCirculo.php';
    }

    public function crearCirculo()
    {

        try {

            $cs = new Consultas();
            $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
            $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);

            if (isset($_POST["ccirculo"])) {

                $params = array(
                    'nombreg' => '',
                    'descripcion' => '',
                    'archivo' => '',
                    'mensaje' => []
                );

                $params["nombreg"] = recoge("nombreg");
                $params["descripcion"] = recoge("descripcion");

                if (empty($params["nombreg"])) {
                    $params["mensaje"] = "No hay nombre del grupo";
                }

                if (empty($params["descripcion"])) {
                    $params["mensaje"] = "No hay descripcion";
                }

                if (empty($params["mensaje"])) {
                    $params["archivo"] = cFile("foto", $params["mensaje"], Config::$extensionesValidas, __DIR__ . '/../archivos/img/circulos/', Config::$max_file_size);
                }

                if (empty($params["archivo"])) {
                    $params["archivo"] = "circulo.png";
                }

                $cs = new Consultas();
                $cs->crearCirculo($params["nombreg"], $params["descripcion"], date("Y-m-d"), $_SESSION["id_user"], $params["archivo"]);
                $idNuevoGrupo = $cs->buscar2Campos($params["nombreg"], $_SESSION["id_user"], "grupo", "IdGrupo", "Nombre", "Creador");
                $cs->agregarParticipacionGrupo($_SESSION["id_user"], $idNuevoGrupo, date("Y-m-d"), true);


                header('Location: index.php?ctl=inicio');

            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../../web/templates/crearCirculo.php';
    }
}


