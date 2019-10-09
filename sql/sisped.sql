drop database serve_sisped;
create database serve_sisped;
use serve_sisped;

create table instituicao(
  idinst int not null auto_increment primary key,
  nome varchar(255) not null,
  cnpj varchar(18) not null,
  endereco varchar(255) not null,
  ativo tinyint(1) default 0
);

create table sispeduser(
  iduse int not null primary key auto_increment,
  nameuser varchar(100),
  nome varchar(255) not null,
  `password` varchar(255) not null,
  idinst int not null,
  constraint fk_UserInstituicao foreign key (idinst) references instituicao(idinst)
);

create table dadoscrianca(
  idcrian int not null auto_increment primary key,
  nome varchar(225) not null,
  endereco varchar(255) not null,
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
  cpf varchar(11) not null,
  iduser int not null,
  constraint fk_AuxiliarUser foreign key(iduser) references sispeduser(iduse)
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

INSERT INTO `instituicao` (`idinst`, `nome`, `cnpj`, `ativo`) VALUES (NULL, 'Local', '00000-0', '0');
INSERT INTO `sispeduser` (`iduse`, `nameuser`, `nome`, `endereco`, `password`, `idinst`) VALUES (NULL, 'admin', 'Admistrador', 'localhost', 'd32129481a7f1fc4cb052f698e8792ca96477fc1', '1'); /*md5 for sha1*/





