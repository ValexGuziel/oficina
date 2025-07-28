-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/07/2025 às 02:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordens_servico`
--

CREATE TABLE `ordens_servico` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `equipamento` varchar(255) NOT NULL,
  `descricao_problema` text NOT NULL,
  `status` enum('Aberta','Em Andamento','Aguardando Peças','Concluída','Cancelada') DEFAULT 'Aberta',
  `data_abertura` datetime DEFAULT current_timestamp(),
  `data_conclusao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ordens_servico`
--

INSERT INTO `ordens_servico` (`id`, `cliente`, `equipamento`, `descricao_problema`, `status`, `data_abertura`, `data_conclusao`) VALUES
(16, 'Claudio Ramos', 'Fulão', 'sem feltro', 'Aberta', '2025-07-27 10:12:25', NULL),
(17, 'Claudio Ramos', 'Motobomba da Caldeira', 'motor em curto', 'Em Andamento', '2025-07-27 18:40:56', NULL),
(18, 'Claudio Ramos', 'Compressor HVAC B', 'não funciona', 'Aguardando Peças', '2025-07-27 18:41:32', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ordens_servico`
--
ALTER TABLE `ordens_servico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ordens_servico`
--
ALTER TABLE `ordens_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
