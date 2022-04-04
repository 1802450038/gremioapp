-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Jan-2022 às 08:34
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pref_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `logregister`
--

CREATE TABLE `logregister` (
  `log_id` int(11) NOT NULL,
  `log_operation` varchar(255) NOT NULL,
  `log_description` varchar(255) NOT NULL,
  `log_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_address`
--

CREATE TABLE `tb_address` (
  `address_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `address_road` varchar(255) NOT NULL,
  `address_number` int(11) NOT NULL,
  `address_complement` varchar(255) NOT NULL,
  `address_district` varchar(255) NOT NULL,
  `address_cep` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `address_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_animal`
--

CREATE TABLE `tb_animal` (
  `animal_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `animal_uniquetag` varchar(255) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `animal_species` varchar(255) NOT NULL,
  `animal_coat` varchar(255) NOT NULL,
  `animal_age` int(11) NOT NULL,
  `animal_markings` varchar(255) NOT NULL,
  `animal_note` mediumtext NOT NULL,
  `animal_leftpicture` varchar(255) NOT NULL,
  `amimal_frontalpicture` varchar(255) NOT NULL,
  `animal_rightpicture` varchar(255) NOT NULL,
  `animal_backpicture` varchar(255) NOT NULL,
  `animal_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `animal_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_carriage`
--

CREATE TABLE `tb_carriage` (
  `carriage_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `carriage_uniquetag` varchar(255) NOT NULL,
  `carriage_type` varchar(255) NOT NULL,
  `carriage_color` varchar(255) NOT NULL,
  `carriage_numberofaxes` varchar(255) NOT NULL,
  `carriage_width` varchar(255) NOT NULL,
  `carriage_length` varchar(255) NOT NULL,
  `carriage_height` varchar(255) NOT NULL,
  `carriage_note` mediumtext NOT NULL,
  `carriage_leftpicture` varchar(255) NOT NULL,
  `carriage_frontalpicture` varchar(255) NOT NULL,
  `carriage_rightpicture` varchar(255) NOT NULL,
  `carriage_backpicture` varchar(255) NOT NULL,
  `carriage_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `carriage_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conductor`
--

CREATE TABLE `tb_conductor` (
  `conductor_id` int(11) NOT NULL,
  `conductor_name` varchar(255) NOT NULL,
  `conductor_observation` mediumtext NOT NULL,
  `conductor_identity` varchar(255) NOT NULL,
  `conductor_phone` varchar(255) NOT NULL,
  `conductor_cpf` varchar(255) NOT NULL,
  `conductor_age` varchar(255) NOT NULL,
  `conductor_scooling` varchar(255) NOT NULL,
  `conductor_socialbenefit` varchar(255) NOT NULL,
  `conductor_familyincome` varchar(255) NOT NULL,
  `conductor_profilepicture` varchar(255) NOT NULL,
  `conductor_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `conductor_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dependent`
--

CREATE TABLE `tb_dependent` (
  `dependent_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `dependent_name` varchar(255) NOT NULL,
  `dependent_identity` varchar(255) NOT NULL,
  `dependent_cpf` varchar(255) NOT NULL,
  `dependent_note` mediumtext NOT NULL,
  `dependent_age` int(11) NOT NULL,
  `dependent_schooling` varchar(255) NOT NULL,
  `dependent_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `dependent_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_isadmin` tinyint(1) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_cpf` varchar(255) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_profilepicture` varchar(255) NOT NULL,
  `user_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_carriage`
--
ALTER TABLE `tb_carriage`
  ADD PRIMARY KEY (`carriage_id`);

--
-- Índices para tabela `tb_conductor`
--
ALTER TABLE `tb_conductor`
  ADD PRIMARY KEY (`conductor_id`);

--
-- Índices para tabela `tb_dependent`
--
ALTER TABLE `tb_dependent`
  ADD PRIMARY KEY (`dependent_id`);

--
-- Índices para tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carriage`
--
ALTER TABLE `tb_carriage`
  MODIFY `carriage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_conductor`
--
ALTER TABLE `tb_conductor`
  MODIFY `conductor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_dependent`
--
ALTER TABLE `tb_dependent`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
