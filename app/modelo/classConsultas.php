<?php
class Consultas extends Modelo
{

    /*Buscar en la linea de una tabla, con un campo*/
    function buscar($input, $tabla, $columna, $campoWhere)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere = ?");
        $stmt->execute([$input]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($resultado) ? $resultado[$columna] : null;
    }

    function buscar2Campos($input1, $input2, $tabla, $columna, $campoWhere1, $campoWhere2)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere1 = ? AND $campoWhere2 = ?");
        $stmt->execute([$input1, $input2]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($resultado) ? $resultado[$columna] : null;
    }

    function buscarFila($input, $tabla, $campoWhere)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM $tabla WHERE $campoWhere = ?");
        $stmt->execute([$input]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($fila) ? $fila : null;
    }

    function buscarColumna($input, $tabla, $columna, $campoWhere)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere = ?");
        $stmt->execute([$input]);
        $columna = $stmt->fetch(PDO::FETCH_COLUMN);
        return ($columna !== false) ? $columna : null;
    }

    function buscarTablaCompleta($tabla)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($resultados !== false) ? $resultados : null;
    }

    function buscarTablaCompletaOrdenada($tabla)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM $tabla ORDER BY libro.valoracion DESC ");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($resultados !== false) ? array_slice($resultados, 0, 3) : null;
    }

    function buscarColumnaArray($input, $tabla, $columna, $campoWhere)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere = ?");
        $stmt->execute([$input]);
        $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $resultados;
    }


    function buscarColumnaEnteraArray($tabla, $columna)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $resultados;
    }

    function buscarFila2Campos($input1, $input2, $tabla, $campoWhere1, $campoWhere2)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM $tabla WHERE $campoWhere1 = ? AND $campoWhere2 = ?");
        $stmt->execute([$input1, $input2]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($fila) ? $fila : null;
    }

    function buscarTodos($input, $tabla, $columna, $campoWhere)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere = ?");
        $stmt->execute([$input]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    function buscarTodos2Campos($input1, $input2, $tabla, $columna, $campoWhere1, $campoWhere2)
    {
        $stmt = $this->conexion->prepare("SELECT $columna FROM $tabla WHERE $campoWhere1 = ? AND $campoWhere2 = ?");
        $stmt->execute([$input1, $input2]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    /*Comprueba que el email está en la base de datos*/
    function verificarEmail($email)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    /*Comprueba que la contraseña es correcta*/
    function verificarPass($email, $pass)
    {
        $stmt = $this->conexion->prepare("SELECT Contrasena FROM Usuario WHERE Email = ?");
        $stmt->execute([$email]);
        $hashAlmacenado = $stmt->fetchColumn();
        return password_verify($pass, $hashAlmacenado);
    }

    function agregarNuevoUsuario($nombre, $email, $pass, $descripcion, $f_nacimiento, $foto_perfil, $nivel, $activo)
    {
        $query = "INSERT INTO usuario (Nombre, Email, Contrasena, Descripcion, FechaNacimiento, FotoPerfil, Nivel, Activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $descripcion);
        $stmt->bindParam(5, $f_nacimiento);
        $stmt->bindParam(6, $foto_perfil);
        $stmt->bindParam(7, $nivel);
        $stmt->bindParam(8, $activo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function crearCirculo($nombre, $descripcion, $fechaCreacion, $creador, $fotoCirculo)
    {
        $query = "INSERT INTO grupo (Nombre, Descripcion, FechaCreacion, Creador, FotoGrupo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $fechaCreacion);
        $stmt->bindParam(4, $creador);
        $stmt->bindParam(5, $fotoCirculo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function actualizarCirculo($idCirculo, $nombre, $descripcion, $fotoCirculo)
    {
        $query = "UPDATE grupo SET Nombre = ?, Descripcion = ?, FotoGrupo = ? WHERE IdGrupo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $fotoCirculo);
        $stmt->bindParam(4, $idCirculo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function actualizarUsuario($id, $pass, $fecha, $descripcion, $fotoPerfil)
    {
        $query = "UPDATE usuario SET Contrasena = ?, Descripcion = ?, FechaNacimiento = ?, FotoPerfil = ? WHERE IdUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $pass);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $fecha);
        $stmt->bindParam(4, $fotoPerfil);
        $stmt->bindParam(5, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminarCirculo($idCirculo)
    {
        $query = "DELETE FROM grupo WHERE IdGrupo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idCirculo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function crearPlan($nombre, $fechaFin, $presupuesto, $ubi, $desc, $fechaConfirmacion, $fechaRealizacion, $creador, $fotoActividad, $grupo)
    {
        $query = "INSERT INTO plan (Nombre, FechaFin, PresupuestoEstimado, Ubicacion, Descripcion, FechaLimiteConfirmacion, FechaRealizacion, Creador, FotoActividad, IdGrupo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $fechaFin);
        $stmt->bindParam(3, $presupuesto);
        $stmt->bindParam(4, $ubi);
        $stmt->bindParam(5, $desc);
        $stmt->bindParam(6, $fechaConfirmacion);
        $stmt->bindParam(7, $fechaRealizacion);
        $stmt->bindParam(8, $creador);
        $stmt->bindParam(9, $fotoActividad);
        $stmt->bindParam(10, $grupo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function actualizarPlan($idPlan, $nombre, $fechaFin, $presupuesto, $ubi, $desc, $fechaConfirmacion, $fechaRealizacion, $fotoActividad)
    {
        $query = "UPDATE plan SET Nombre = ?, FechaFin = ?, PresupuestoEstimado = ?, Ubicacion = ?, Descripcion = ?, FechaLimiteConfirmacion = ?, FechaRealizacion = ?, FotoActividad = ? WHERE IdActividad = ?";

        $stmt = $this->conexion->prepare($query);

        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $fechaFin);
        $stmt->bindParam(3, $presupuesto);
        $stmt->bindParam(4, $ubi);
        $stmt->bindParam(5, $desc);
        $stmt->bindParam(6, $fechaConfirmacion);
        $stmt->bindParam(7, $fechaRealizacion);
        $stmt->bindParam(8, $fotoActividad);
        $stmt->bindParam(9, $idPlan);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function agregarToken($token, $validez, $id)
    {
        $query = "INSERT INTO token (token, validez, id_user) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $token);
        $stmt->bindParam(2, $validez);
        $stmt->bindParam(3, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function agregarParticipacionGrupo($usuario, $grupo, $fechaRegistro, $confirmacion)
    {
        $query = "INSERT INTO participacion_grupo (IdUsuario, IdGrupo, FechaRegistro, Confirmacion) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $usuario);
        $stmt->bindParam(2, $grupo);
        $stmt->bindParam(3, $fechaRegistro);
        $stmt->bindParam(4, $confirmacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function eliminarPlan($idPlan)
    {
        $query = "DELETE FROM plan WHERE IdActividad = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idPlan);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminarParticipacionPlan($idUsuario, $idPlan)
    {
        $query = "DELETE FROM Participacion_plan WHERE IdUsuario = ? AND IdActividad = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idPlan);
        $stmt->execute();
    }

    function eliminarParticipacionGrupo($idUsuario, $idGrupo)
    {
        $query = "DELETE FROM participacion_grupo WHERE IdUsuario = ? AND IdGrupo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idGrupo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminarParticipacionesPlan($idUsuario, $idGrupo)
    {
        $query = "DELETE FROM Participacion_Plan WHERE IdUsuario = ? AND IdGrupo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idGrupo);
        $stmt->execute();
    }

    function agregarParticipacionPlan($plan, $usuario, $idgrupo, $confirmacion)
    {
        $query = "INSERT INTO participacion_plan (IdActividad, IdUsuario, IdGrupo, Confirmacion) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $plan);
        $stmt->bindParam(2, $usuario);
        $stmt->bindParam(3, $idgrupo);
        $stmt->bindParam(4, $confirmacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    function obtenerGruposUsuario($idUsuario)
    {
        $query = "SELECT Grupo.* 
                  FROM Usuario 
                  JOIN Participacion_Grupo ON Usuario.IdUsuario = Participacion_Grupo.IdUsuario 
                  JOIN Grupo ON Participacion_Grupo.IdGrupo = Grupo.IdGrupo 
                  WHERE Usuario.IdUsuario = ?";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerGruposUsuarioConfirmado($idUsuario)
    {
        $query = "SELECT Grupo.* 
                  FROM Usuario 
                  JOIN Participacion_Grupo ON Usuario.IdUsuario = Participacion_Grupo.IdUsuario 
                  JOIN Grupo ON Participacion_Grupo.IdGrupo = Grupo.IdGrupo 
                  WHERE Usuario.IdUsuario = ? AND Participacion_Grupo.Confirmacion = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerUsuariosPorGrupo($idGrupo)
    {
        $query = "SELECT Usuario.* 
                  FROM Usuario 
                  JOIN Participacion_Grupo ON Usuario.IdUsuario = Participacion_Grupo.IdUsuario 
                  WHERE Participacion_Grupo.IdGrupo = ? AND Participacion_Grupo.Confirmacion = 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idGrupo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerPlanesUsuario($idUsuario)
    {
        $fechaActual = date("Y-m-d");
        $query = "SELECT Plan.* 
                  FROM Usuario 
                  JOIN Participacion_Plan ON Usuario.IdUsuario = Participacion_Plan.IdUsuario 
                  JOIN Plan ON Participacion_Plan.IdActividad = Plan.IdActividad 
                  WHERE Usuario.IdUsuario = ? AND Plan.FechaFin >= ?
                  ORDER BY Plan.FechaRealizacion";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $fechaActual);
        $stmt->execute();
        $planes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $planes;
    }



    function obtenerMiembrosGrupo($idGrupo)
    {
        $query = "SELECT Usuario.*
                  FROM Usuario
                  JOIN Participacion_Grupo ON Usuario.IdUsuario = Participacion_Grupo.IdUsuario
                  WHERE Participacion_Grupo.IdGrupo = ? AND Participacion_Grupo.Confirmacion = TRUE";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idGrupo);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerPlanesGrupo($idGrupo)
    {
        $fechaActual = date("Y-m-d");
        $query = "SELECT Plan.*
                  FROM Plan
                  JOIN Grupo ON Plan.IdGrupo = Grupo.IdGrupo
                  WHERE Grupo.IdGrupo = ? AND Plan.FechaFin >= ?
                  ORDER BY Plan.FechaRealizacion";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idGrupo);
        $stmt->bindParam(2, $fechaActual);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerPlanesGrupoParaConfirmar($idGrupo, $fecha)
    {
        $query = "SELECT Plan.*
                  FROM Plan
                  JOIN Grupo ON Plan.IdGrupo = Grupo.IdGrupo
                  WHERE Grupo.IdGrupo = ? AND Plan.FechaLimiteConfirmacion >= ?
                  ORDER BY Plan.FechaRealizacion";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idGrupo);
        $stmt->bindParam(2, $fecha);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function obtenerUsuariosDePlan($idPlan)
    {
        $query = "SELECT DISTINCT Usuario.*
                  FROM Usuario
                  JOIN Participacion_Plan ON Usuario.IdUsuario = Participacion_Plan.IdUsuario
                  JOIN Plan ON Participacion_Plan.IdActividad = Plan.IdActividad
                  WHERE Plan.IdActividad = ? AND Participacion_Plan.Confirmacion";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idPlan);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }

    function obtenerUsuariosPorNombreOrdenados($inputNombre)
    {
        $query = "SELECT * FROM Usuario WHERE Nombre LIKE ? ORDER BY Nombre";
        $inputNombre = $inputNombre . '%';

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $inputNombre);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerGruposPorNombreOrdenados($inputNombre)
    {
        $query = "SELECT * FROM grupo WHERE Nombre LIKE ? ORDER BY Nombre";
        $inputNombre = $inputNombre . '%';

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $inputNombre);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerGruposDeUsuario($usuarioId)
    {
        $query = "SELECT * FROM Grupo WHERE Creador = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $usuarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerGruposUsuarioSinConfirmar($idUsuario)
    {
        $query = "SELECT *
                  FROM Grupo g
                  JOIN Participacion_Grupo pg ON g.IdGrupo = pg.IdGrupo
                  WHERE pg.IdUsuario = ? AND pg.Confirmacion = FALSE;";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    function obtenerPlanesUsuarioSinConfirmar($idUsuario)
    {
        $query = "SELECT p.*, g.Nombre AS NombreGrupo, g.FotoGrupo 
                  FROM Plan p
                  JOIN Participacion_Plan pp ON p.IdActividad = pp.IdActividad
                  JOIN Grupo g ON p.IdGrupo = g.IdGrupo
                  WHERE pp.IdUsuario = :idUsuario AND pp.Confirmacion = FALSE";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerPlanesUsuarioConfirmado($idUsuario)
    {
        $fechaActual = date("Y-m-d");
        $query = "SELECT Plan.* 
                  FROM Usuario 
                  JOIN Participacion_Plan ON Usuario.IdUsuario = Participacion_Plan.IdUsuario 
                  JOIN Plan ON Participacion_Plan.IdActividad = Plan.IdActividad 
                  WHERE Usuario.IdUsuario = ? AND Plan.FechaFin >= ? AND Participacion_Plan.Confirmacion = TRUE
                  ORDER BY Plan.FechaRealizacion";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $fechaActual);
        $stmt->execute();
        $planes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $planes;
    }



    function confirmarParticipacionGrupo($idUsuario, $idGrupo)
    {
        $stmt = $this->conexion->prepare("UPDATE Participacion_Grupo SET Confirmacion = TRUE WHERE IdUsuario = ? AND IdGrupo = ?");
        $stmt->execute([$idUsuario, $idGrupo]);
    }


    function confirmarParticipacionPlan($idUsuario, $idPlan)
    {
        $stmt = $this->conexion->prepare("UPDATE Participacion_Plan SET Confirmacion = TRUE WHERE IdUsuario = ? AND IdActividad = ?");
        $stmt->execute([$idUsuario, $idPlan]);
    }

    function obtenerGrupoActividad($idActividad)
    {
        $query = "SELECT * FROM Plan p JOIN Grupo g ON p.IdGrupo = g.IdGrupo WHERE p.IdActividad = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idActividad);
        if ($stmt->execute()) {
            $result = $stmt->fetch();
            if ($result) {
                return $result;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }



    function participaEnPlan($idUsuario, $idActividad)
    {
        $query = "SELECT Confirmacion FROM Participacion_Plan WHERE IdUsuario = :idUsuario AND IdActividad = :idActividad";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':idActividad', $idActividad, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function eliminarUsuario($idUsuario)
    {
        $query = "DELETE FROM Usuario WHERE IdUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function verificarToken($token) {
        $stmt =$this->conexion->prepare("SELECT COUNT(*) AS count FROM token WHERE token = ? AND validez > UNIX_TIMESTAMP(NOW())");
        $stmt->execute([$token]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($resultado['count'] > 0);
    }

    function validarFechaValidezPorToken($token) {
        $stmt =$this->conexion->prepare("SELECT validez FROM token WHERE token = ?");
        $stmt->execute([$token]);
        $fechaValidez = $stmt->fetchColumn();

            $fechaActual = time();
            return ($fechaValidez > $fechaActual);
    }

    /*Activa la cuenta del usuario*/
    function activarUsuarioPorToken($token) {
        $stmt =$this->conexion->prepare("UPDATE usuario SET activo = 1 WHERE id_user = (SELECT id_user FROM token WHERE token = ?)");
        return $stmt->execute([$token]);
    }

    /*Borra el token de la base de datos*/
    function borrarToken($token) {
        $stmt =$this->conexion->prepare("DELETE FROM token WHERE token = ?");
        return $stmt->execute([$token]);
    }


}
