-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Out-2019 às 22:21
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serve_sisped`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosauxiliar`
--

CREATE TABLE `dadosauxiliar` (
  `idaux` int(11) NOT NULL,
  `crm` varchar(10) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dadosauxiliar`
--

INSERT INTO `dadosauxiliar` (`idaux`, `crm`, `nome`, `cpf`) VALUES
(1, '2423-MG', 'Pediatra Geral', '842349328');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosconsulta`
--

CREATE TABLE `dadosconsulta` (
  `idcon` int(11) NOT NULL,
  `perimetroCefalico` double(6,2) DEFAULT NULL,
  `peso` float(6,2) DEFAULT NULL,
  `altura` float(6,2) DEFAULT NULL,
  `obs` varchar(255) NOT NULL,
  `dataConsulta` date DEFAULT NULL,
  `idInstituicao` int(11) NOT NULL,
  `idCrianca` int(11) NOT NULL,
  `idAuxiliar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dadosconsulta`
--

INSERT INTO `dadosconsulta` (`idcon`, `perimetroCefalico`, `peso`, `altura`, `obs`, `dataConsulta`, `idInstituicao`, `idCrianca`, `idAuxiliar`) VALUES
(61, 5.00, 7.00, 5.00, 'Sem ObservaÃ§Ãµes', '2019-10-07', 1, 12, 1),
(62, 7.00, 4.00, 7.00, 'Sem ObservaÃ§Ãµes', '2019-10-08', 1, 12, 1),
(65, NULL, NULL, NULL, 'nd', '2019-10-17', 1, 16, 1),
(66, NULL, NULL, NULL, 'nd', '2019-10-17', 1, 16, 1),
(68, NULL, NULL, NULL, 'Sem ObservaÃ§Ãµes', '2019-10-07', 1, 12, 1),
(69, NULL, 10.00, NULL, 'Sem ObservaÃ§Ãµes', '2019-10-30', 1, 12, 1),
(71, NULL, NULL, NULL, 'Sem ObservaÃ§Ãµes', '2020-01-24', 1, 12, 1),
(86, NULL, 10.00, 50.00, 'Sem ObservaÃ§Ãµes', '2020-10-14', 1, 12, 1),
(87, NULL, NULL, NULL, 'Sem ObservaÃ§Ãµes', '2019-10-06', 1, 12, 1),
(88, NULL, NULL, NULL, 'Sem ObservaÃ§Ãµes', '2019-10-04', 1, 12, 1),
(89, NULL, 11.00, NULL, 'Sem ObservaÃ§Ãµes', '2020-03-20', 1, 12, 1),
(90, 22.00, 4.00, 2.00, 'Sem ObservaÃ§Ãµes', '2019-10-24', 1, 13, 1),
(91, 33.00, 5.00, 100.00, 'Sem ObservaÃ§Ãµes', '2019-11-28', 1, 13, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadoscrianca`
--

CREATE TABLE `dadoscrianca` (
  `idcrian` int(11) NOT NULL,
  `nome` varchar(225) NOT NULL,
  `nascimento` date NOT NULL,
  `diasPrematuro` int(11) NOT NULL,
  `sexo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dadoscrianca`
--

INSERT INTO `dadoscrianca` (`idcrian`, `nome`, `nascimento`, `diasPrematuro`, `sexo`) VALUES
(12, 'Afonso Silva', '2019-07-23', 3, 'm'),
(13, 'Teste', '2019-10-02', 1, 'm'),
(16, 'Douglas', '2019-10-15', 0, 'm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosresponsavel`
--

CREATE TABLE `dadosresponsavel` (
  `idres` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(225) NOT NULL,
  `idCrianca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `idinst` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `ativo` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`idinst`, `nome`, `endereco`, `cnpj`, `ativo`) VALUES
(1, 'APAE', 'Rua XV de Novembro', '4243234-322', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sispeduser`
--

CREATE TABLE `sispeduser` (
  `iduse` int(11) NOT NULL,
  `nameuser` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sispeduser`
--

INSERT INTO `sispeduser` (`iduse`, `nameuser`, `password`) VALUES
(1, 'sisped', 'd32129481a7f1fc4cb052f698e8792ca96477fc1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dadosauxiliar`
--
ALTER TABLE `dadosauxiliar`
  ADD PRIMARY KEY (`idaux`);

--
-- Indexes for table `dadosconsulta`
--
ALTER TABLE `dadosconsulta`
  ADD PRIMARY KEY (`idcon`),
  ADD KEY `fk_CriancaConsulta` (`idCrianca`),
  ADD KEY `fk_AuxiliarConsulta` (`idAuxiliar`),
  ADD KEY `fk_InstituicaoConsulta` (`idInstituicao`);

--
-- Indexes for table `dadoscrianca`
--
ALTER TABLE `dadoscrianca`
  ADD PRIMARY KEY (`idcrian`);

--
-- Indexes for table `dadosresponsavel`
--
ALTER TABLE `dadosresponsavel`
  ADD PRIMARY KEY (`idres`),
  ADD KEY `fk_ResponsavelCrianca` (`idCrianca`);

--
-- Indexes for table `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`idinst`);

--
-- Indexes for table `sispeduser`
--
ALTER TABLE `sispeduser`
  ADD PRIMARY KEY (`iduse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dadosauxiliar`
--
ALTER TABLE `dadosauxiliar`
  MODIFY `idaux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dadosconsulta`
--
ALTER TABLE `dadosconsulta`
  MODIFY `idcon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `dadoscrianca`
--
ALTER TABLE `dadoscrianca`
  MODIFY `idcrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dadosresponsavel`
--
ALTER TABLE `dadosresponsavel`
  MODIFY `idres` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `idinst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sispeduser`
--
ALTER TABLE `sispeduser`
  MODIFY `iduse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `dadosconsulta`
--
ALTER TABLE `dadosconsulta`
  ADD CONSTRAINT `fk_AuxiliarConsulta` FOREIGN KEY (`idAuxiliar`) REFERENCES `dadosauxiliar` (`idaux`),
  ADD CONSTRAINT `fk_CriancaConsulta` FOREIGN KEY (`idCrianca`) REFERENCES `dadoscrianca` (`idcrian`),
  ADD CONSTRAINT `fk_InstituicaoConsulta` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idinst`);

--
-- Limitadores para a tabela `dadosresponsavel`
--
ALTER TABLE `dadosresponsavel`
  ADD CONSTRAINT `fk_ResponsavelCrianca` FOREIGN KEY (`idCrianca`) REFERENCES `dadoscrianca` (`idcrian`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
