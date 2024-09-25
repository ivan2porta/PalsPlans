-- Creación de la base de datos

CREATE DATABASE PalsPlans;

-- Cambiar a la base de datos recién creada
USE PalsPlans;

-- Definición de tablas (igual que en la respuesta anterior)

CREATE TABLE Usuario (
  IdUsuario INT PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Email VARCHAR(255) UNIQUE NOT NULL,
  Contrasena VARCHAR(255) NOT NULL,
  Descripcion VARCHAR(255),
  FechaNacimiento VARCHAR(255) NOT NULL,
  FotoPerfil VARCHAR(255),
  Nivel TINYINT,
  Activo BOOLEAN
);

CREATE TABLE Grupo (
  IdGrupo INT PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Descripcion VARCHAR(255),
  FechaCreacion VARCHAR(255) NOT NULL,
  Creador INT NOT NULL,
  FotoGrupo VARCHAR(255),
  FOREIGN KEY (Creador) REFERENCES Usuario(IdUsuario)
);

CREATE TABLE Participacion_Grupo (
  IdUsuario INT NOT NULL,
  IdGrupo INT NOT NULL,
  FechaRegistro VARCHAR(255) NOT NULL,
  Confirmacion BOOLEAN NOT NULL,
  PRIMARY KEY (IdUsuario, IdGrupo),
  FOREIGN KEY (IdUsuario) REFERENCES Usuario(IdUsuario),
  FOREIGN KEY (IdGrupo) REFERENCES Grupo(IdGrupo)
  ON DELETE CASCADE
);

CREATE TABLE Plan (
  IdActividad INT PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  FechaFin VARCHAR(255) NOT NULL,
  PresupuestoEstimado DECIMAL(10,2) NOT NULL,
  Ubicacion VARCHAR(255),
  Descripcion VARCHAR(255),
  FechaLimiteConfirmacion VARCHAR(255) NOT NULL,
  FechaRealizacion VARCHAR(255),
  Creador INT NOT NULL,
  FotoActividad VARCHAR(255),
  IdGrupo INT NOT NULL,
  FOREIGN KEY (Creador) REFERENCES Usuario(IdUsuario),
  FOREIGN KEY (IdGrupo) REFERENCES Grupo(IdGrupo)
  ON DELETE CASCADE
);

CREATE TABLE Participacion_Plan (
  IdActividad INT,
  IdUsuario INT NOT NULL,
  IdGrupo INT NOT NULL,
  Confirmacion BOOLEAN NOT NULL,
  PRIMARY KEY (IdActividad, IdUsuario, IdGrupo),
  FOREIGN KEY (IdUsuario) REFERENCES Usuario(IdUsuario),
  FOREIGN KEY (IdGrupo) REFERENCES Grupo(IdGrupo)
  ON DELETE CASCADE,
  FOREIGN KEY (IdActividad) REFERENCES Plan(IdActividad)
  ON DELETE CASCADE
);

CREATE TABLE Token (
    token VARCHAR(15),
    validez INT,
    id_user INT PRIMARY KEY,
    FOREIGN KEY (id_user) REFERENCES Usuario(IdUsuario) ON DELETE CASCADE
);

-- Definición de restricciones de referencia en cascada

ALTER TABLE Grupo
  ADD CONSTRAINT fk_grupo_creador
  FOREIGN KEY (Creador)
  REFERENCES Usuario(IdUsuario)
  ON DELETE CASCADE;

ALTER TABLE Participacion_Grupo
  ADD CONSTRAINT fk_participacion_grupo_usuario
  FOREIGN KEY (IdUsuario)
  REFERENCES Usuario(IdUsuario)
  ON DELETE CASCADE;

ALTER TABLE Participacion_Grupo
  ADD CONSTRAINT fk_participacion_grupo_grupo
  FOREIGN KEY (IdGrupo)
  REFERENCES Grupo(IdGrupo)
  ON DELETE CASCADE;

ALTER TABLE Participacion_Plan
  ADD CONSTRAINT fk_participacion_plan_usuario
  FOREIGN KEY (IdUsuario)
  REFERENCES Usuario(IdUsuario)
  ON DELETE CASCADE;

ALTER TABLE Participacion_Plan
  ADD CONSTRAINT fk_participacion_plan_grupo
  FOREIGN KEY (IdGrupo)
  REFERENCES Grupo(IdGrupo)
  ON DELETE CASCADE;

ALTER TABLE Participacion_Plan
  ADD CONSTRAINT fk_participacion_plan_actividad
  FOREIGN KEY (IdActividad)
  REFERENCES Plan(IdActividad)
  ON DELETE CASCADE;
