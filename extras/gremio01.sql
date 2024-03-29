-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2022 às 12:55
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
-- Banco de dados: `gremio01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_address`
--

CREATE TABLE `tb_address` (
  `address_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `address_uniquetag` varchar(255) NOT NULL,
  `address_road` varchar(255) NOT NULL,
  `address_number` varchar(255) NOT NULL,
  `address_complement` varchar(255) NOT NULL,
  `address_district` varchar(255) NOT NULL,
  `address_cep` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `address_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_address`
--

INSERT INTO `tb_address` (`address_id`, `partner_id`, `address_uniquetag`, `address_road`, `address_number`, `address_complement`, `address_district`, `address_cep`, `address_city`, `address_state`, `address_dtregister`, `address_lastupdate`) VALUES
(1, 8, 'URU-2231464AD', 'xv de novembro', '1426', 'ap301', 'centro', '97501570', 'uruguaiana', 'RS', '2022-04-06 19:12:46', '2022-05-02 00:48:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_dependent`
--

CREATE TABLE `tb_dependent` (
  `dependent_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `dependent_uniquetag` varchar(255) NOT NULL,
  `dependent_fullname` varchar(255) NOT NULL,
  `dependent_cpf` varchar(255) NOT NULL,
  `dependent_dtnasc` varchar(255) NOT NULL,
  `dependent_age` int(11) NOT NULL,
  `dependent_identity` varchar(255) NOT NULL,
  `dependent_mobphone` varchar(255) NOT NULL,
  `dependent_resphone` varchar(255) NOT NULL,
  `dependent_email` varchar(255) NOT NULL,
  `dependent_familiarity` varchar(255) NOT NULL,
  `dependent_dtregister` date NOT NULL DEFAULT current_timestamp(),
  `dependent_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_dependent`
--

INSERT INTO `tb_dependent` (`dependent_id`, `partner_id`, `dependent_uniquetag`, `dependent_fullname`, `dependent_cpf`, `dependent_dtnasc`, `dependent_age`, `dependent_identity`, `dependent_mobphone`, `dependent_resphone`, `dependent_email`, `dependent_familiarity`, `dependent_dtregister`, `dependent_lastupdate`) VALUES
(1, 8, 'GRE-2282041DEP', 'dasdasd', '231.241.241-24', '1996-12-07', 41, 'kjbkjjnbjkbkj', '(23) 12412-1551', '(55) 5599-6562', 'ga2briel.chaus@gmail.com', 'filho/filha', '0000-00-00', '2022-05-02 01:01:35'),
(2, 7, 'GRE-2235108DEP', 'GABRIEL PEREIRA BELLAGAMBA', '123.124.124-12', '1957-08-01', 64, 'dasd', '(55) 55996-5625', '(55) 5599-6562', 'gabriel.chaus@gmail.com', '', '2022-04-25', '2022-04-25 19:22:20'),
(3, 7, 'GRE-2265625DEP', 'GABRIEL PEREIRA BELLAGAMBA2', '', '', 0, '', '', '(55) 5599-6562', 'gabriel.chaus@gmail.com', '', '2022-04-25', '2022-04-25 19:28:51'),
(4, 7, 'GRE-2219044DEP', 'GABRIEL PEREIRA BELLAGAMBA3', '', '', 0, '', '', '(55) 5599-6562', 'gabriel.chaus@gmail.com', '', '2022-04-25', '2022-04-25 19:29:29'),
(5, 8, 'GRE-2211195DEP', '123123ELLAGAMBA3', '', '', 0, '', '', '(55) 5599-6562', 'gabriel.chaus@gmail.com', '', '2022-04-25', '2022-05-02 00:48:27'),
(6, 8, 'GRE-2246046DEP', '123132131LAGAMBA3', '', '', 0, '', '', '(55) 5599-6562', 'gabriel.chaus@gmail.com', 'FILHO/FILHA', '2022-04-25', '2022-05-02 00:48:24'),
(7, 8, 'GRE-2224047DEP', '12313213321LAGAMBA3', '', '', 0, '', '', '(55) 5599-6562', 'gabriel.chaus@gmail.com', 'CÔNJUGE', '2022-04-25', '2022-05-02 00:48:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log`
--

CREATE TABLE `tb_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `log_target` varchar(255) NOT NULL,
  `log_targetid` int(11) NOT NULL,
  `log_targetobject` varchar(255) NOT NULL,
  `log_uniquetag` varchar(255) NOT NULL,
  `log_operation` varchar(255) NOT NULL,
  `log_beforedescription` mediumtext NOT NULL,
  `log_afterdescription` mediumtext NOT NULL,
  `log_dtregister` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_partner`
--

CREATE TABLE `tb_partner` (
  `partner_id` int(11) NOT NULL,
  `partner_uniquetag` varchar(255) NOT NULL,
  `partner_fullname` varchar(255) NOT NULL,
  `partner_cpf` varchar(255) NOT NULL,
  `partner_identity` varchar(255) NOT NULL,
  `partner_dtnasc` date NOT NULL,
  `partner_resphone` varchar(255) NOT NULL,
  `partner_mobphone` varchar(255) NOT NULL,
  `partner_age` int(11) NOT NULL,
  `partner_email` varchar(255) NOT NULL,
  `partner_milorganization` varchar(255) NOT NULL,
  `partner_assoctype` varchar(255) NOT NULL,
  `partner_dtregister` date NOT NULL DEFAULT current_timestamp(),
  `partner_dtlastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `partner_status` varchar(255) NOT NULL,
  `partner_dtassoc` date NOT NULL DEFAULT current_timestamp(),
  `partner_paymentday` date NOT NULL,
  `partner_monthlypayment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_partner`
--

INSERT INTO `tb_partner` (`partner_id`, `partner_uniquetag`, `partner_fullname`, `partner_cpf`, `partner_identity`, `partner_dtnasc`, `partner_resphone`, `partner_mobphone`, `partner_age`, `partner_email`, `partner_milorganization`, `partner_assoctype`, `partner_dtregister`, `partner_dtlastupdate`, `partner_status`, `partner_dtassoc`, `partner_paymentday`, `partner_monthlypayment`) VALUES
(8, 'GRE-229137SOC', 'GABRIEL PEREIRA BELLAGAMBA', '', '', '1970-01-01', '(55) 5599-6562', '', 0, 'gabriel.chaus@gmail.com', '', 'REMIDOMILITAR SEM DESCONTO EM FOLHA', '2022-04-26', '2022-05-17 06:40:39', 'EM DIA', '1970-01-01', '2021-01-30', '60,00'),
(9, 'GRE-227821SOC', 'GERVASIO BELLAGAMBA', '013.263.160-10', '5105231232', '1995-12-07', '(55) 5599-6562', '(55) 55996-5625', 26, 'gabriel.chaus@gmail.com', '13', 'MILITAR SEM DESCONTO EM FOLHA', '2022-05-02', '2022-05-17 06:40:39', 'EM DIA', '1957-12-07', '2021-01-30', '60,00'),
(10, 'GRE-221997SOC', 'GABRIEL BELLAGAMBA', '013.263.160-10', '5105231232', '1995-12-07', '(55) 5599-6562', '(55) 55996-5625', 26, 'gabriel.chaus@gmail.com', '13', 'MILITAR SEM DESCONTO EM FOLHA', '2022-05-02', '2022-05-17 06:40:39', 'EM DIA', '1957-12-07', '2021-01-30', '60,00'),
(11, 'GRE-228244SOC', 'gere', '013.263.160-10', '5105231232', '1970-01-01', '', '', 0, '', '', 'REMIDO', '2022-05-03', '2022-05-17 07:44:48', 'EM DÉBITO', '1970-01-01', '2021-01-30', 'ISENTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_payment`
--

CREATE TABLE `tb_payment` (
  `payment_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `partner_fullname` varchar(255) NOT NULL,
  `payment_uniquetag` varchar(255) NOT NULL,
  `payment_payer` varchar(255) NOT NULL,
  `payment_note` varchar(255) NOT NULL,
  `payment_dtregister` date NOT NULL DEFAULT current_timestamp(),
  `payment_dtlastupdate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_duedate` date NOT NULL DEFAULT current_timestamp(),
  `payment_value` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_payment`
--

INSERT INTO `tb_payment` (`payment_id`, `partner_id`, `partner_fullname`, `payment_uniquetag`, `payment_payer`, `payment_note`, `payment_dtregister`, `payment_dtlastupdate`, `payment_duedate`, `payment_value`, `payment_method`, `payment_status`) VALUES
(47, 8, 'GABRIEL PEREIRA BELLAGAMBA', 'GRE-2277938000PG', 'Nenhum', 'Pagamento em aberto', '2022-05-17', '2022-05-17 03:30:55', '2022-06-01', '0,00', 'Não pago', 'PAGO'),
(48, 9, 'GERVASIO BELLAGAMBA', 'GRE-223120845PG', 'Nenhum', 'Pagamento em aberto', '2022-05-17', '2022-05-17 02:56:39', '2022-06-01', '0,00', 'Não pago', 'ABERTO'),
(49, 10, 'GABRIEL BELLAGAMBA', 'GRE-2238831299PG', 'Nenhum', 'Pagamento em aberto', '2022-05-17', '2022-05-17 02:56:39', '2022-06-01', '0,00', 'Não pago', 'ABERTO'),
(69, 11, 'gere', 'GRE-2297712280PG', 'Nenhum', 'Pagamento em aberto', '2022-05-17', '2022-05-17 04:48:33', '2022-04-01', '0,00', 'Não pago', 'ATRASADO'),
(76, 11, 'gere', 'GRE-2266372367PG', 'Nenhum', 'Pagamento em aberto', '2022-05-17', '2022-05-17 04:48:33', '2022-06-01', '0,00', 'Não pago', 'ABERTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recovery`
--

CREATE TABLE `tb_recovery` (
  `recovery_id` int(11) NOT NULL,
  `recovery_ip` varchar(255) NOT NULL,
  `recovery_key` varchar(255) NOT NULL,
  `recovery_email` varchar(255) NOT NULL,
  `recovery_valid_key` tinyint(1) NOT NULL DEFAULT 1,
  `recovery_dtregister` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `recovery_dtrecovery` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_uniquetag` varchar(255) NOT NULL,
  `user_isadmin` varchar(5) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_sector` varchar(255) NOT NULL,
  `user_office` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_profilepicture` varchar(255) NOT NULL,
  `user_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_uniquetag`, `user_isadmin`, `user_name`, `user_sector`, `user_office`, `user_email`, `user_login`, `user_password`, `user_profilepicture`, `user_dtregister`, `user_lastupdate`) VALUES
(12, 'teste', '1', 'gabriel bellagamba', 'TI', 'Tecnico', 'gabriel.chaus@gmail.com', 'tecnico', '123456', '', '2022-04-04 05:55:13', '2022-04-04 05:55:13'),
(13, 'URU-22606US', 'SIM', 'Gabriel Bellagamba2', 'A', 'nenhum', 'gabriel.chaus@gmail.com', 'pedro', '$2y$12$43bO.hmRMNoS9mQ.NoYExu2ffVo3Wn7UEEP8a2CXBHyMjAzKBp2Va', '', '2022-04-25 21:02:42', '2022-04-25 21:16:25');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_address`
--
ALTER TABLE `tb_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Índices para tabela `tb_dependent`
--
ALTER TABLE `tb_dependent`
  ADD PRIMARY KEY (`dependent_id`);

--
-- Índices para tabela `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Índices para tabela `tb_partner`
--
ALTER TABLE `tb_partner`
  ADD PRIMARY KEY (`partner_id`);

--
-- Índices para tabela `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Índices para tabela `tb_recovery`
--
ALTER TABLE `tb_recovery`
  ADD PRIMARY KEY (`recovery_id`);

--
-- Índices para tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_address`
--
ALTER TABLE `tb_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_dependent`
--
ALTER TABLE `tb_dependent`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_partner`
--
ALTER TABLE `tb_partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `tb_recovery`
--
ALTER TABLE `tb_recovery`
  MODIFY `recovery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
