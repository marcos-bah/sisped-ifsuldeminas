create database serve_sisped;
use serve_sisped;

create table sispeduser(
  iduse int not null primary key auto_increment,
  nameuser varchar(100),
  nome varchar(255) not null,
  endereco varchar(255) not null,
  `password` varchar(255) not null
);

create table instituicao(
  idinst int not null auto_increment primary key,
  cnpj varchar(18) not null,
  ativo tinyint(1) default 0,
  iduser int not null,
  constraint fk_InstituicaoUser foreign key (iduser) references sispeduser(iduse)
);

create table dadoscrianca(
  idcrian int not null auto_increment primary key,
  nome varchar(225) not null,
  nascimento date not null,
  prematuro boolean not null,
  diasPrematuro int not null,
  sexo char(1) not null
);

create table dadosresponsavel(
  idres int not null auto_increment primary key,
  cpf varchar(11) not null,
  idCrianca int not null,
  iduser int not null,
  constraint fk_ResponsavelUser foreign key (iduser) references sispeduser(iduse),
  constraint fk_ResponsavelCrianca foreign key (idCrianca) references dadoscrianca(idcrian)
);

create table dadosauxiliar(
  idaux int not null auto_increment primary key,
  crm varchar(10),
<<<<<<< HEAD
  nome varchar(255) not null,
  cpf varchar(11) not null
=======
  cpf varchar(11) not null,
  iduser int not null,
  constraint fk_AuxiliarUser foreign key(iduser) references sispeduser(iduse)
>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84
);

create table dadosconsulta(
  idcon int not null primary key auto_increment,
  perimetroCefalico double(6,2),
  peso float(6,2),
  altura float(6,2),
  obs varchar(255),
  dataConsulta date,
  idInstituicao int not null,
  idCrianca int not null,
  idAuxiliar int not null,
  constraint fk_CriancaConsulta foreign key (idCrianca) references dadoscrianca(idcrian),
  constraint fk_AuxiliarConsulta foreign key (idAuxiliar) references dadosauxiliar(idaux),
  constraint fk_InstituicaoConsulta foreign key (idInstituicao) references instituicao(idinst)
);

<<<<<<< HEAD
create table sispeduser(
  iduse int not null primary key auto_increment,
  nameuser varchar(100),
  password varchar(255)
);

ALTER TABLE `dadosconsulta` ADD `obs` VARCHAR(255) NOT NULL AFTER `altura`;

INSERT INTO `instituicao` (`idinst`, `nome`, `endereco`, `cnpj`, `ativo`) VALUES (NULL, 'APAE', 'Rua XV de Novembro', '4243234-322', '1');
INSERT INTO `dadosauxiliar` (`idaux`, `crm`, `nome`, `cpf`) VALUES (NULL, '2423-MG', 'Usuario Teste', '842349328');
=======
INSERT INTO `instituicao` (`idinst`, `nome`, `endereco`, `cnpj`, `ativo`) VALUES (NULL, 'APAE', 'Rua XV de Novembro', '4243234-322', '1');
INSERT INTO `dadosauxiliar` (`idaux`, `crm`, `nome`, `cpf`) VALUES (NULL, '2423-MG', 'Médico Atual', '842349328');
INSERT INTO `dadoscrianca` (`idcrian`, `nome`, `nascimento`, `prematuro`, `diasPrematuro`, `sexo`) VALUES (NULL, 'Crianca Zero', '2010-02-02', false, 0, 'm');
INSERT INTO `sispeduser` (`iduse`, `nameuser`, `password`) VALUES (NULL, 'sisped', 'd32129481a7f1fc4cb052f698e8792ca96477fc1');
>>>>>>> 5f5e8e24dce5b8b41df94e5ce3bf76302edaeb84
