create table vehiculo (
	id  int AUTO_INCREMENT PRIMARY KEY,
    placa varchar(7) NOT null UNIQUE,
    modelo varchar(20) not null,
    marca varchar(20)
); 