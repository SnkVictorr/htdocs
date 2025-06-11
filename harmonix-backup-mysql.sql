-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 11/06/2025 às 02:45
-- Versão do servidor: 9.3.0
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `harmonix_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria`, `created_at`, `updated_at`) VALUES
(1, 'Violão', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(2, 'Guitarra', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(3, 'Baixo', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(4, 'Teclado', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(5, 'Bateria', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(6, 'Saxofone', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(7, 'Trompete', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(8, 'Flauta', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(9, 'Clarinete', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(10, 'Trombone', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(11, 'Violino', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(12, 'Tuba', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(13, 'Pandeiro', '2025-05-26 17:23:32', '2025-05-26 17:23:32'),
(14, 'Clarone', '2025-05-26 17:23:32', '2025-05-26 17:23:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriaMarcas`
--

CREATE TABLE `categoriaMarcas` (
  `id_categoriaMarcas` int NOT NULL,
  `categoria_id` int NOT NULL,
  `marca_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categoriaMarcas`
--

INSERT INTO `categoriaMarcas` (`id_categoriaMarcas`, `categoria_id`, `marca_id`) VALUES
(1, 2, 2),
(2, 1, 8),
(3, 1, 9),
(4, 1, 13),
(5, 2, 3),
(6, 2, 4),
(7, 2, 8),
(8, 2, 13),
(9, 3, 3),
(10, 3, 4),
(11, 3, 8),
(12, 3, 13),
(13, 4, 1),
(14, 4, 5),
(15, 4, 6),
(16, 4, 8),
(17, 5, 8),
(18, 5, 15),
(19, 5, 16),
(20, 6, 7),
(21, 6, 8),
(22, 6, 10),
(23, 6, 12),
(24, 7, 8),
(25, 7, 10),
(26, 7, 11),
(27, 7, 14),
(28, 8, 8),
(29, 8, 10),
(30, 9, 8),
(31, 9, 10),
(32, 10, 8),
(33, 10, 10),
(34, 10, 11),
(35, 10, 14),
(36, 11, 8),
(37, 11, 13),
(38, 12, 8),
(39, 12, 10),
(40, 12, 11),
(41, 12, 14),
(42, 13, 9),
(43, 13, 13),
(44, 14, 8),
(45, 14, 10),
(46, 14, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int NOT NULL,
  `cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('Masculino','Feminino','Outro') NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` char(14) NOT NULL,
  `telefone_residencial` char(13) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(400) NOT NULL,
  `numero` int NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `item_id` int NOT NULL,
  `pedido_id` int NOT NULL,
  `produto_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `marca_id` int NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `marca`
--

INSERT INTO `marca` (`marca_id`, `marca`, `created_at`, `updated_at`) VALUES
(1, 'CASIO', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(2, 'CRAFTER', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(3, 'FENDER', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(4, 'GIBSON', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(5, 'KORG', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(6, 'ROLAND', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(7, 'SELMER PARIS', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(8, 'YAMAHA', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(9, 'EAGLE', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(10, 'JUPITER', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(11, 'WERIL', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(12, 'YABAGISAWA', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(13, 'MICHAEL', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(14, 'KING', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(15, 'PEARL', '2025-05-26 17:23:41', '2025-05-26 17:23:41'),
(16, 'DW', '2025-05-26 17:23:41', '2025-05-26 17:23:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `produto_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `marca_id` int NOT NULL,
  `produto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descricao` text NOT NULL,
  `estoque` int NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `desconto` int NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `categoria_id`, `marca_id`, `produto`, `descricao`, `estoque`, `preco`, `desconto`, `image_url`, `created_at`, `updated_at`) VALUES
(10, 14, 9, 'guitarra', 'dsfsdf', 234, 234.00, 34234, 'a11b66b19c3c986cceb733ffd31c0ba2.png', '2025-06-11 01:57:31', '2025-06-11 01:57:31'),
(11, 14, 6, 'guitarra', '23423423432', 234, 234.00, 34234, '7d89428b2a89e69ee1a0ca592a27a8a2.png', '2025-06-11 01:59:52', '2025-06-11 01:59:52'),
(12, 9, 9, 'guitarra', 'sdasdsad', 234, 234.00, 34234, '2ee38a46743985d739aac70d6d5e97ee.png', '2025-06-11 02:02:51', '2025-06-11 02:02:51'),
(13, 9, 3, 'guitarra', 'sdfsdf', 234, 234.00, 34234, '3e8b7b403d56b7bdca0ca4c0b6201ed2.png', '2025-06-11 02:05:15', '2025-06-11 02:05:15'),
(14, 9, 2, 'guitarra', 'khjjhjk', 234, 234.00, 34234, 'f3e8683087bb19102a417080f03d01a4.png', '2025-06-11 02:07:00', '2025-06-11 02:07:00'),
(15, 14, 5, 'guitarra', 'fghfgh', 234, 234.00, 34234, '4b06bac80bb6c6795ce5ccce92a30d9d.png', '2025-06-11 02:08:46', '2025-06-11 02:08:46'),
(16, 9, 6, 'guitarra', 'uiouio', 234, 234.00, 34234, 'afffa7504c04c3111c05f3b50e807abb.png', '2025-06-11 02:23:15', '2025-06-11 02:23:15');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices de tabela `categoriaMarcas`
--
ALTER TABLE `categoriaMarcas`
  ADD PRIMARY KEY (`id_categoriaMarcas`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`marca_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produto_id`),
  ADD UNIQUE KEY `produto_id` (`produto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `categoriaMarcas`
--
ALTER TABLE `categoriaMarcas`
  MODIFY `id_categoriaMarcas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `marca_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoriaMarcas`
--
ALTER TABLE `categoriaMarcas`
  ADD CONSTRAINT `categoriaMarcas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `categoriaMarcas_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`marca_id`);

--
-- Restrições para tabelas `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
  ADD CONSTRAINT `item_pedido_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`marca_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
