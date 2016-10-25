create database  if not exists web2;

USE web2;

CREATE TABLE Usuarios ( nombre varchar (15) , clave varchar (55), tipo varchar(5), habilitado varchar(2),
						PRIMARY KEY (nombre) );

CREATE TABLE Usuarios ( 
idUsuario smallint,
Nombre varchar (15) , 
Contraseña varchar (55), 
email varchar(20),
Ubicacion varchar(20),
Administrador varchar (5), 
Habilitado varchar(5),
Fecha datetime,
PRIMARY KEY (nombre) );
