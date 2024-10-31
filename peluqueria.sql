CREATE DATABASE Peluqueria_Ahicito;

CREATE TABLE peluqueria(
	id_peluqueria INT NOT NULL AUTO_INCREMENT,
	logo VARCHAR(30), 
	nombre VARCHAR(25) NOT NULL,
	telefono VARCHAR(25) NOT NULL,
	direccion VARCHAR(30) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_peluqueria)
)ENGINE=INNODB;

CREATE TABLE propietario(
	id_propietario INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	nombre VARCHAR(25) NOT NULL,
	apellido VARCHAR(25) NOT NULL,
	telefono VARCHAR(25) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_propietario),
		FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria)
)ENGINE=INNODB;

CREATE TABLE tipos_clientes(
	id_tipo_cliente INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(30) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_tipo_cliente)
)ENGINE=INNODB;


CREATE TABLE clientes(
	id_cliente INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	id_tipo_cliente INT NOT NULL,
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	telefono VARCHAR(25) NOT NULL,
	genero CHAR(1) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_cliente),
	FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria),
	FOREIGN KEY(id_tipo_cliente) REFERENCES tipos_clientes(id_tipo_cliente)
)ENGINE=INNODB;

CREATE TABLE empleados(
	id_empleado INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	nombre VARCHAR(30) NOT NULL,
	ap VARCHAR(15),
	am VARCHAR(15),
	ci VARCHAR(25) NOT NULL,
	fecha_inicio DATE NOT NULL,
	fecha_fin DATE,
	telefono VARCHAR(25) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_empleado),
	FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria)
)ENGINE=INNODB;

CREATE TABLE horarios(
	id_horario INT NOT NULL AUTO_INCREMENT,
	id_empleado INT NOT NULL,
	turno VARCHAR(20) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_horario),
	FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
)ENGINE=INNODB;

CREATE TABLE categorias_servicios(
	id_categoria_servicio INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	nombre VARCHAR(30) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_categoria_servicio),
	FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria)
)ENGINE=INNODB;

CREATE TABLE citas(
	id_cita INT NOT NULL AUTO_INCREMENT,
	id_cliente INT NOT NULL,
	id_empleado INT NOT NULL,
	fecha DATE NOT NULL,
	hora TIME NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_cita),
	FOREIGN KEY(id_cliente) REFERENCES clientes(id_cliente),
	FOREIGN KEY(id_empleado) REFERENCES empleados(id_empleado)
)ENGINE=INNODB;

CREATE TABLE detalles_servicios(
	id_detalle_servicio INT NOT NULL AUTO_INCREMENT,
	id_categoria_servicio INT NOT NULL,
	id_cita INT NOT NULL,
	precio FLOAT NOT NULL,
	descripcion VARCHAR(30) NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_detalle_servicio),
	FOREIGN KEY(id_categoria_servicio) REFERENCES categorias_servicios(id_categoria_servicio),
	FOREIGN KEY(id_cita) REFERENCES citas(id_cita)
)ENGINE=INNODB;

CREATE TABLE promociones(
	id_promocion INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	descuento VARCHAR(30) NOT NULL,
	descripcion VARCHAR(30) NOT NULL,
	fecha_inicio DATE NOT NULL,
	fecha_fin DATE NOT NULL,
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_promocion),
	FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria)
)ENGINE=INNODB;








-- //////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE personas(
	id_persona INT NOT NULL AUTO_INCREMENT,
	id_peluqueria INT NOT NULL,
	nombres VARCHAR(25) NOT NULL,
	ap VARCHAR(15),
	am VARCHAR(15),
	ci VARCHAR(25) NOT NULL,
	telefono VARCHAR(25),
	direccion VARCHAR(40), 
	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
	PRIMARY KEY(id_persona),
	FOREIGN KEY(id_peluqueria) REFERENCES peluqueria(id_peluqueria)
)ENGINE=INNODB;

CREATE TABLE usuarios(
	id_usuario INT NOT NULL AUTO_INCREMENT,
	id_persona INT NOT NULL,
    usuario VARCHAR(20) NOT NULL,
    clave VARCHAR(100)NOT NULL,
    fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario1 INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_usuario),
    FOREIGN KEY(id_persona)REFERENCES personas(id_persona)
)ENGINE=INNODB;

CREATE TABLE roles(
    id_rol INT NOT NULL AUTO_INCREMENT,
    rol VARCHAR(15)NOT NULL,
   	fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_rol)
)ENGINE=INNODB;

CREATE TABLE usuarios_roles(
    id_usuario_rol INT NOT NULL AUTO_INCREMENT,
    id_rol INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_usuario_rol)
)ENGINE=INNODB;

CREATE TABLE grupos(
    id_grupo INT NOT NULL AUTO_INCREMENT,
    grupo VARCHAR(25) NOT NULL,
    fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_grupo)
)ENGINE=INNODB;

CREATE TABLE opciones(
    id_opcion INT NOT NULL AUTO_INCREMENT,
    id_grupo INT NOT NULL,
    opcion VARCHAR(50)NOT NULL,
    contenido VARCHAR(100)NOT NULL,
    orden INT NOT NULL,
    fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_opcion),
    FOREIGN KEY(id_grupo)REFERENCES grupos(id_grupo)
)ENGINE=INNODB;

CREATE TABLE accesos(
    id_acceso INT NOT NULL AUTO_INCREMENT,
    id_opcion INT NOT NULL,
    id_rol INT NOT NULL,
    fecha_insercion TIMESTAMP NOT NULL,
	fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	usuario INT NOT NULL,
	estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_acceso),
    FOREIGN KEY(id_opcion)REFERENCES opciones(id_opcion),
    FOREIGN KEY(id_rol)REFERENCES roles(id_rol)
)ENGINE=INNODB;


CREATE TABLE visitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contador INT NOT NULL DEFAULT 0
);

INSERT INTO visitas (contador) VALUES (0);






-- //////////////////////////////////////////////////////////////////////////////////////////////////////

-- insercion peluqueria
INSERT INTO peluqueria VALUES(1,'img1','PELUQUERIA AHICITO','75607713','barrio juan XXIII',now(),now(),1,'A');

-- insercion propietario
INSERT INTO propietario VALUES(1,1,'juan', 'Colque','56789768',now(),now(),1,'A');


-- Insercion tipos clientes
INSERT INTO tipos_clientes VALUE(1, 'niños',NOW(),NOW(),1,'A');
INSERT INTO tipos_clientes VALUE(2, 'adolescentes',NOW(),NOW(),1,'A');
INSERT INTO tipos_clientes VALUE(3, 'adultos',NOW(),NOW(),1,'A');

-- Insercion de clientes
INSERT INTO clientes VALUE(1, 1, 1, 'Ariel','Ontiveros','56789012','M',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(2, 1, 1, 'Pedro','Cuellar','34567890','M',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(3, 1, 1, 'Eduardo','Vilte','45678901','M',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(4, 1, 2, 'Mariela','Almazan','23456789','F',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(5, 1, 2, 'Delma','Montes','98765432','F',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(6, 1, 2, 'Daniela','Maraz','67895432','F',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(7, 1, 3,'mayeli','Farfan','78986745','F',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(8, 1, 3, 'Cesar','Gamarra','89786545','M',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(9, 1, 3, 'Cristian','Velasco','89678965','M',NOW(),NOW(),1,'A');
INSERT INTO clientes VALUE(10,1, 3, 'Alvaro','Flores ','56754568','M',NOW(),NOW(),1,'A');

-- Insercion de empleados 
INSERT INTO empleados VALUE(1, 1, 'Leandro', 'Gamarra', 'Alarcon', '42987615', '2023-03-04', '', '67894596',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(2, 1, 'Rolando', 'Velasco', 'Colque', '35790124', '2023-03-04', '', '78459486',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(3, 1, 'Beto', 'Mendieta', 'Pallarez', '80127345', '2023-03-04', '', '94857945',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(4, 1, 'Mariela', 'Gomez', 'Sandobal', '56248137', '2023-03-04', '', '12345687',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(5, 1, 'Gilda', 'sanchez', 'Muños', '13589264', '2023-03-04', '', '54721453',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(6, 1, 'Katalina', 'Jimenes', 'Garnica', '29876451', '2023-03-04', '', '41879103',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(7, 1, 'Valeria', 'Moreno', 'Mamani', '64138927', '2023-03-04', '', '41207835',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(8, 1, 'Fabiola', 'Espindola', 'Murillo', '70259361', '2023-03-04', '', '14141027',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(9, 1, 'Pedro', 'Garcia', 'Flores', '95362814', '2023-03-04', '', '78540314',NOW(),NOW(),1,'A');
INSERT INTO empleados VALUE(10, 1, 'Carlos', 'Ruiz', 'Farfan', '14357679', '2023-03-04', '', '11245489',NOW(),NOW(),1,'A');


-- Insercion de horario
INSERT INTO horarios VALUE(1,1, 'Mañana',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(2,2, 'Tarde',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(3,3, 'Noche',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(4,4, 'todo el dia',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(5,5, 'tiempo completo',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(6,6, 'Mañana',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(7,7, 'Tarde',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(8,8, 'Noche',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(9,9, 'todo el dia',NOW(),NOW(),1,'A');
INSERT INTO horarios VALUE(10,10, 'tiempo completo',NOW(),NOW(),1,'A');

-- Insercion de categorias servicios
INSERT INTO categorias_servicios VALUE(1,1, 'Corte',NOW(),NOW(),1,'A');
INSERT INTO categorias_servicios VALUE(2,1, 'barberia',NOW(),NOW(),1,'A');
INSERT INTO categorias_servicios VALUE(3,1, 'peinado',NOW(),NOW(),1,'A');
INSERT INTO categorias_servicios VALUE(4,1, 'Tinte',NOW(),NOW(),1,'A');
INSERT INTO categorias_servicios VALUE(5,1, 'Alisado',NOW(),NOW(),1,'A');
INSERT INTO categorias_servicios VALUE(6,1, 'Tratamiento',NOW(),NOW(),1,'A');


-- insercion de citas
INSERT INTO citas VALUE(1, 1, 1, '2022-01-01', '10:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(2, 2, 2,'2022-01-05', '14:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(3, 3, 3,'2022-01-10', '09:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(4, 4, 4,'2022-01-12', '11:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(5, 5, 5,'2022-01-15', '16:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(6, 6, 6,'2022-01-18', '13:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(7, 7, 7,'2022-01-20', '10:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(8, 8, 8,'2022-01-22', '15:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(9, 9, 9,'2022-01-25', '09:00:00',NOW(),NOW(),1,'A');
INSERT INTO citas VALUE(10, 10, 10,'2022-01-28', '14:00:00',NOW(),NOW(),1,'A');

-- insercion detalles servicios
INSERT INTO detalles_servicios VALUE(1, 1, 1, 20.00, 'Corte de cabello basico',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(2, 1, 2, 30.00, 'Corte de cabello palermo',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(3, 3, 3, 40.00, 'Peinado',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(4, 4, 4, 25.00, 'Tinte de cabello',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(5, 5, 5, 35.00, 'Alisado de cabello',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(6, 1, 6, 20.00, 'Corte de cabello',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(7, 6, 7, 50.00, 'Tratamiento de hidratación',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(8, 2, 8, 30.00, 'Corte de barba',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(9, 3, 9, 40.00, 'Peinado para eventos',NOW(),NOW(),1,'A');
INSERT INTO detalles_servicios VALUE(10, 5, 10, 35.00, 'Corte de cabello basico',NOW(),NOW(),1,'A');

-- Insercion de promociones
INSERT INTO promociones VALUE(1,1, '10', 'Promoción de inauguración', '2022-01-01', '2022-01-31',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(2,1, '20', 'Promoción de verano', '2022-06-01', '2022-08-31',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(3,1, '5', 'Promoción de cumpleaños', '2022-03-01', '2022-03-31',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(4,1, '15', 'Promoción de fin de semana', '2022-02-01', '2022-02-28',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(5,1, '30', 'Promoción de Black Friday', '2022-11-25', '2022-11-28',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(6,1,'12', 'Promoción de Navidad', '2022-12-01', '2022-12-24',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(7,1, '8', 'Promoción de estudiantes', '2022-09-01', '2022-09-30',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(8,1, '18', 'Promoción de aniversario', '2022-04-01', '2022-04-30',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(9,1, '50', 'Promoción de 2X1', '2022-11-28', '2022-11-30',NOW(),NOW(),1,'A');
INSERT INTO promociones VALUE(10,1, '10', 'Promoción de tiktok', '2022-05-01', '2022-05-31',NOW(),NOW(),1,'A');


-- //////////////////////////////////////////////////////////////////////////////////////////////////////

-- insercion personas
INSERT INTO personas VALUES(1,1,'Joel','Mendieta','Ontiveros','7172175','68731230','Calle delfin pino & general sossa',NOW(),NOW(),1,'A');

-- insercion usuario
INSERT INTO usuarios VALUES(1,1,'Admin','$2y$10$HxB1sZ3p/ok/Aa3cyATcsuGZoUrZzW5.TtmaiYh61S38axFgKVmXK',NOW(),NOW(),1,'A');

-- insercion grupos
INSERT INTO grupos VALUES(1,'HERRAMIENTAS',NOW(),NOW(),1,'A');
INSERT INTO grupos VALUES(2,'PELUQUERIA',NOW(),NOW(),1,'A');
INSERT INTO grupos VALUES(3,'REPORTES',NOW(),NOW(),1,'A');
INSERT INTO grupos VALUES(4,'CUARTO BIMESTRE',NOW(),NOW(),1,'A');

-- insercion roles
INSERT INTO roles VALUES(1,'administrador',NOW(),NOW(),1,'A');

-- insercion usuarios_roles
INSERT INTO usuarios_roles VALUES(1,1,1 ,NOW(),NOW(),1,'A');

-- insercion opciones
INSERT INTO opciones VALUES(1 ,1,'PERSONAS','../privada/personas/personas.php',10,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(2 ,1,'USUARIOS','../privada/usuarios/usuarios.php',20,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(3 ,1,'GRUPOS','../privada/grupos/grupos.php',30,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(4 ,1,'ROLES','../privada/roles/roles.php',40,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(5 ,1,'USUARIO ROL','../privada/usuarios_roles/usuarios_roles.php',50,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(6 ,1,'OPCIONES','../privada/opciones/opciones.php',60,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(7 ,1,'ACCESOS','../privada/accesos/accesos.php',70,NOW(),NOW(),1,'A');

INSERT INTO opciones VALUES(8 ,2,'PELUQUERIA','../privada/peluqueria/peluqueria.php',20,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(9,2,'PROPIETARIOS','../privada/propietario/propietario.php',40,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(10,2,'EMPLEADOS','../privada/empleados/empleados.php',30,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(11,2,'CLIENTES','../privada/clientes/clientes.php',100,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(12,2,'SERVICIOS','../privada/categorias_servicios/categorias_servicios.php',10,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(13,2,'DETALLES','../privada/detalles_servicios/detalles_servicios.php',60,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(14,2,'CITAS','../privada/citas/citas.php',70,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(15,2,'HORARIOS','../privada/horarios/horarios.php',80,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(16,2,'TIPO DE CLIENTES','../privada/tipos_clientes/tipos_clientes.php',90,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(17,2,'PROMOCIONES','../privada/promociones/promociones.php',80,NOW(),NOW(),1,'A');

INSERT INTO opciones VALUES(18,3,'REPORTES','../privada/reportes/reporte.php', 10,NOW(),NOW(),1,'A');

INSERT INTO opciones VALUES(19,4,'NEWS API','../privada/api/api.php', 10,NOW(),NOW(),1,'A');
INSERT INTO opciones VALUES(20,4,'FORMULARIO DINAMICO','../privada/formulario/formulario.php', 10,NOW(),NOW(),1,'A');

-- insercion accesos
INSERT INTO accesos VALUES(1,1,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(2,2,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(3,3,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(4,4,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(5,5,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(6,6,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(7,7,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(8,8,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(9,9,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(10,10,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(11,11,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(12,12,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(13,13,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(14,14,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(15,15,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(16,16,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(17,17,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(18,18,1,NOW(),NOW(),1,'A');
INSERT INTO accesos VALUES(19,19,1,NOW(),NOW(),1,'A');

INSERT INTO accesos VALUES(20,20,1,NOW(),NOW(),1,'A');


CREATE VIEW vista_peluqueria AS
SELECT nombre,logo
FROM peluqueria
WHERE estado='A';

CREATE TABLE rubros(
    id_rubro INT NOT NULL AUTO_INCREMENT,
    rubro VARCHAR(30)NOT NULL,
    vida_util INT NOT NULL,
    porcen_depreciacion FLOAT NOT NULL,
    depreciacion VARCHAR(10)NOT NULL,
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_rubro)
)ENGINE=INNODB;

INSERT INTO rubros VALUES (1, 'Terrenos', 10, 10.00, 'NO', NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (2, 'Edificaciones', 40, 2.5, 'SI', NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (3, 'Muebles y Enseres de oficina', 10, 10.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (4, 'Equipos de Computacion', 4, 25.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (5, 'Vehiculo Automotores', 5, 20.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (6, 'Herramientas en Generales', 4, 25.00, 'SI', NOW(), NOW(), 1, 'A');

CREATE TABLE categorias(
    id_categoria INT NOT NULL AUTO_INCREMENT,
    id_rubro INT NOT NULL,
    categoria_rubro VARCHAR(30)NOT NULL,
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_categoria),
    FOREIGN KEY(id_rubro)REFERENCES rubros(id_rubro)
)ENGINE=INNODB;

INSERT INTO categorias VALUES (1, 1,'Terreno', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (2, 2,'Edificacion',  NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (3, 2,'Vivienda',  NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (4, 3,'Pupitre', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (5, 3,'Silla', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (6, 3,'Mesa de Escritorio', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (7, 3,'Casillero Metalico', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (8, 3,'Casillero Madera', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (9, 3,'Ventilador', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (11, 4,'Computadora', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (12, 4,'Impresora', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (13, 4,'Proyector', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (14, 5,'Vehiculo', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (15, 6,'Taladro', NOW(), NOW(), 1, 'A');

CREATE TABLE activos_fijos(
    id_activo_fijo INT NOT NULL AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha_adquisicion DATE NOT NULL, 
    fecha_activacion DATE, 
    fotografia VARCHAR(30),
    nro_documento VARCHAR(50),
    valor FLOAT,
    valor_residual FLOAT,
    responsable VARCHAR(50),
    depreciacion VARCHAR(50), /*del id_categoria 4 al 15*/
    marca_del_activo VARCHAR(25),  /*del id_categoria 9 al 15*/
    nro_serie_placa VARCHAR(20),  /*solo id_categoria 14*/
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_activo_fijo),
    FOREIGN KEY(id_categoria) REFERENCES categorias(id_categoria)
)ENGINE=INNODB;