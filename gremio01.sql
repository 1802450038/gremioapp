-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Abr-2022 às 00:52
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.25

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
(1, 6, 'URU-2231464AD', 'xv de novembro', '1426', 'ap301', 'centro', '97501570', 'uruguaiana', 'RS', '2022-04-06 19:12:46', '2022-04-06 19:12:46');

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
(1, 6, 'GRE-2282041DEP', 'dasdasd', '231.241.241-24', '1996-12-07', 41, 'kjbkjjnbjkbkj', '(23) 12412-1551', '(55) 5599-6562', 'ga2briel.chaus@gmail.com', '', '0000-00-00', '2022-04-06 19:50:55');

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
  `partner_profilepicture` varchar(255) NOT NULL,
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
  `partner_paymentday` date NOT NULL,
  `partner_monthlypayment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_partner`
--

INSERT INTO `tb_partner` (`partner_id`, `partner_uniquetag`, `partner_fullname`, `partner_profilepicture`, `partner_cpf`, `partner_identity`, `partner_dtnasc`, `partner_resphone`, `partner_mobphone`, `partner_age`, `partner_email`, `partner_milorganization`, `partner_assoctype`, `partner_dtregister`, `partner_dtlastupdate`, `partner_status`, `partner_paymentday`, `partner_monthlypayment`) VALUES
(1, 'teste', 'gervasio giovnna', '', '01326316010', '5105298169', '1996-12-07', '55340134', '55996562541', 22, 'gabriel.unipampa@hotmail.com', 'nenhuma', 'nenhuma', '2022-04-01', '2022-04-04 05:58:27', 'em di', '2022-04-01', '34,00'),
(2, 'GRE-22966SOC', 'GABRIEL PEREIRA BELLAGAMBA', '', '', '', '0000-00-00', '', '', 0, '', '', '', '0000-00-00', '2022-04-05 15:27:21', '', '0000-00-00', ''),
(3, 'GRE-226608SOC', 'GABRIEL PEREIRA BELLAGAMBA', '', '', '', '1996-12-07', '', '', 0, '', '', '', '0000-00-00', '2022-04-05 15:28:30', '', '0000-00-00', ''),
(4, 'GRE-223931SOC', 'Gervasio giovanna', '', '123.124.124-12', '312241241241', '1996-12-07', '(55) 9965-6312', '(55) 99831-2831', 23, 'garbie@gmail.com', '', 'Remido', '0000-00-00', '2022-04-05 15:54:02', '', '2022-06-05', 'R$ 35,00'),
(5, 'GRE-222133SOC', 'Gervasio giovanna', '', '123.124.124-12', '312241241241', '1996-12-07', '(55) 9965-6312', '(55) 99831-2831', 23, 'garbie@gmail.com', '', 'Remido', '0000-00-00', '2022-04-05 16:01:29', '', '2022-06-05', 'R$ 35,00'),
(6, 'GRE-226456SOC', 'Gervasio giovanna', '', '123.124.124-12', '312241241241', '1996-12-07', '(55) 9965-6312', '(55) 99831-2831', 23, 'garbie@gmail.com', '', 'Remido', '0000-00-00', '2022-04-05 16:01:44', '', '2022-06-05', 'R$ 35,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_payment`
--

CREATE TABLE `tb_payment` (
  `payment_id` int(11) NOT NULL,
  `partner_name` varchar(255) NOT NULL,
  `payment_uniquetag` varchar(255) NOT NULL,
  `payment_payer` varchar(255) NOT NULL,
  `payment_note` varchar(255) NOT NULL,
  `payment_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_value` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `user_isadmin` tinyint(1) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_sector` varchar(255) NOT NULL,
  `user_office` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_login` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_profilepicture` varchar(255) NOT NULL,
  `user_dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_lastupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_uniquetag`, `user_isadmin`, `user_name`, `user_sector`, `user_office`, `user_email`, `user_phone`, `user_login`, `user_password`, `user_profilepicture`, `user_dtregister`, `user_lastupdate`) VALUES
(12, 'teste', 1, 'gabriel bellagamba', 'TI', 'Tecnico', 'gabriel.chaus@gmail.com', '(55)996562541', 'tecnico', '123456', '', '2022-04-04 05:55:13', '2022-04-04 05:55:13');

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
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_partner`
--
ALTER TABLE `tb_partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_recovery`
--
ALTER TABLE `tb_recovery`
  MODIFY `recovery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
