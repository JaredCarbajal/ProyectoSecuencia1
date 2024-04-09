create table if not exists  productos(
    id integer primary key autoincrement,
    nombre varchar(50),
    tipo varchar(10),
    stock varchar(10),
    stockmax varchar(20),
);
insert into productos (nombre, tipo, stock, stockmax) values('Manzana','Fruta', '30'. '50');
insert into productos (nombre, tipo, stock, stockmax) values('Pera','Fruta', '40'. '60');
insert into productos (nombre, tipo, stock, stockmax) values('Cereza','Fruta', '30'. '50');
