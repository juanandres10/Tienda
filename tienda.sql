create database tienda;
use tienda;

create table tblUsuarios(
id int not null auto_increment,
correo varchar(250) not null,
contraseña varchar(100) not null,
nombre varchar(100) not null,
apellidos varchar(100) not null,
sexo enum("Hombre","Mujer") not null,
primary key (correo),
key (id)
);
insert into tblUsuarios values (null, "juan1@iliberis.com", "atarfe", "juan", "ruiz campos", "Hombre");

create table tblproductos(
id int not null auto_increment,
nombre varchar(255) not null,
precio decimal(20,2) NOT NULL,
descripcion text not null,
imagen varchar(255) NOT NULL,
primary key (id)
);
INSERT INTO tblproductos (id, nombre, precio, descripcion, imagen) VALUES
(1, 'Camiseta Primera Equipación', '90.00', 'Camiseta del Futbol Club Barcelona de la Priemra Equipación temporada 2019/2020', 'Imagenes/cam_1_eq.jpg'),
(2, 'Pantalon Primera Equipación', '50.00', 'Pantalon del Futbol Club Barcelona de la Priemra Equipación temporada 2019/2020', 'Imagenes/pan_1_eq.jpg'),
(3, 'Medias Primera Equipación', '25.00', 'Medias del Futbol Club Barcelona de la Priemra Equipación temporada 2019/2020', 'Imagenes/med_1_eq.jpg'),
(4, 'Camiseta Segunda Equipación', '90.00', 'Camiseta del Futbol Club Barcelona de la Segunda Equipación temporada 2019/2020', 'Imagenes/cam_2_eq.jpg'),
(5, 'Pantalon Segunda Equipación', '50.00', 'Camiseta del Futbol Club Barcelona de la Segunda Equipación temporada 2019/2020', 'Imagenes/pan_2_eq.jpg'),
(6, 'Medias Segunda Equipación', '25.00', 'Medias del Futbol Club Barcelona de la Segunda Equipación temporada 2019/2020', 'Imagenes/med_2_eq.jpg'),
(7, 'Camiseta Tercera Equipación', '90.00', 'Camiseta del Futbol Club Barcelona de la Tercera Equipación temporada 2019/2020', 'Imagenes/cam_3_eq.jpg'),
(8, 'Pantalon Tercera Equipación', '50.00', 'Camiseta del Futbol Club Barcelona de la Tercera Equipación temporada 2019/2020', 'Imagenes/pan_3_eq.jpg'),
(9, 'Medias Tercera Equipación', '25.00', 'Medias del Futbol Club Barcelona de la Tercera Equipación temporada 2019/2020', 'Imagenes/med_3_eq.jpg'),
(10, 'Camiseta Cuarta Equipación', '90.00', 'Camiseta del Futbol Club Barcelona de la Cuarta Equipación temporada 2019/2020', 'Imagenes/cam_4_eq.jpg');

create table tblventas(
id int not null auto_increment,
claveTransaccion varchar(250) not null,
paypalDatos text not null,
fecha datetime not null,
total decimal(60,2) not null,
status varchar(50),
primary key (id)
);

create table tblDetalleVenta(
id int not null auto_increment,
idVenta int not null,
idProducto int not null,
precio decimal(20,2) not null,
cantidad int not null,
descargado int not null,
primary key (id),
FOREIGN KEY (idVenta) REFERENCES tblventas(id) on delete cascade on update cascade,
FOREIGN KEY (idProducto) REFERENCES tblproductos(id) on delete cascade on update cascade
);
/*insert into tblventas (id, claveTransaccion, paypalDatos, fecha, correo, total, status) values (NULL, '1234567890', '', '2020-10-1 14:09:55', 'jarh@gmail.es', '700', 'pendiente');
insert into tblDetalleVenta (id, idVenta, idProducto, precio, cantidad, descargado) values (NULL, '1', '10', '100', '1', '0');*/