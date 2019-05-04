create database serve_sisped;
use serve_sisped;

create table instituicao(
  idinst int not null auto_increment primary key,
  nome varchar(255) not null,
  endereco varchar(255) not null,
  cnpj varchar(18) not null
);

create table dadoscrianca(
  idcrian int not null auto_increment primary key,
  nome varchar(225) not null,
  nascimento date not null,
  prematuro boolean not null,
  diasPrematuro int not null,
  sexo char(1) not null,
  idInstituicao int not null,
  constraint fk_InstituicaoAuxiliar foreign key (idInstituicao) references instituicao(idinst)
);

create table dadosresponsavel(
  idres int not null auto_increment primary key,
  cpf int not null,
  nome varchar(225) not null,
  idCrianca int not null,
  idInstituicao int not null,
  constraint fk_InstituicaoAuxiliar foreign key (idInstituicao) references instituicao(idinst),
  constraint fk_ResponsavelCrianca foreign key (idCrianca) references dadoscrianca(idcrian)
);

create table dadosauxiliar(
  idaux int not null auto_increment primary key,
  crm int,
  nome int not null,
  idInstituicao int not null,
  constraint fk_InstituicaoAuxiliar foreign key (idInstituicao) references instituicao(idinst)
);

create table dadosconsulta(
  id_consultas int not null primary key auto_increment,
  perimetroCefalico double(6,2),
  peso float(6,2),
  altura float(6,2),
  dataConsulta date,
  idInstituicao int not null,
  idCrianca int not null,
  idAuxiliar int not null,
  constraint fk_CriancaConsulta foreign key (idCrianca) references dadoscrianca(idcrian),
  constraint fk_AuxiliarConsulta foreign key (idAuxiliar) references dadosauxiliar(idaux),
  constraint fk_InstituicaoConsulta foreign key (idInstituicao) references instituicao(idinst)
);
