create database servidorbd;
use servidorbd;

create table usuario(
    id int not null primary key auto_increment,
    login varchar(255) not null,
    senha varchar(100) not null
);

create table dadoscrianca(
    id int not null primary key auto_increment,
    nome varchar(255) not null,
    nascimento date not null,
    prematuro boolean not null,
    diasPrematuro int not null,
    sexo char(1)
);

create table dadosconsultas(
    id_consultas int not null primary key auto_increment,
    perimetroCefalico double(6,2),
    peso float(6,2),
    altura float(6,2),
    dataConsulta date,
    codCrianca int not null,
    obs varchar(255)
);

ALTER TABLE `dadosconsultas` ADD CONSTRAINT `fk_consulta` FOREIGN KEY ( `codCrianca` ) REFERENCES `dadoscrianca` ( `id` );
