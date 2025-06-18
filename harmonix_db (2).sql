-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 18/06/2025 às 02:49
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
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `created_at`, `updated_at`) VALUES
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
-- Estrutura para tabela `categoriasMarcas`
--

CREATE TABLE `categoriasMarcas` (
  `id_categoriaMarca` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_marca` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `categoriasMarcas`
--

INSERT INTO `categoriasMarcas` (`id_categoriaMarca`, `id_categoria`, `id_marca`) VALUES
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
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('Masculino','Feminino','Outro') NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` char(14) NOT NULL,
  `telefone_residencial` char(13) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `logradouro` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero` int NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cliente`, `imagem`, `data_nascimento`, `sexo`, `cpf`, `rg`, `email`, `senha`, `telefone`, `telefone_residencial`, `cep`, `logradouro`, `numero`, `cidade`, `estado`, `complemento`, `bairro`, `created_at`, `updated_at`) VALUES
(1, 'Manoel Gomes', 'sadsd.jpg', '1990-01-01', 'Masculino', '12345678901', '123456789', 'sdsad@hotmail.com', '123456', '11999999999', '11333333333', '01000-000', 'Rua Exemplo', 123, 'São Paulo', 'SP', 'Apto 1', 'Centro', '2025-06-18 02:42:34', '2025-06-18 02:42:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ItensPedido`
--

CREATE TABLE `ItensPedido` (
  `id_itemPedido` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_produto` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca`, `created_at`, `updated_at`) VALUES
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
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int NOT NULL,
  `id_cliente` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_marca` int NOT NULL,
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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `categoriasMarcas`
--
ALTER TABLE `categoriasMarcas`
  ADD PRIMARY KEY (`id_categoriaMarca`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `ItensPedido`
--
ALTER TABLE `ItensPedido`
  ADD PRIMARY KEY (`id_itemPedido`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD UNIQUE KEY `id_produto` (`id_produto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `categoriasMarcas`
--
ALTER TABLE `categoriasMarcas`
  MODIFY `id_categoriaMarca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ItensPedido`
--
ALTER TABLE `ItensPedido`
  MODIFY `id_itemPedido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoriasMarcas`
--
ALTER TABLE `categoriasMarcas`
  ADD CONSTRAINT `categoriasMarcas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `categoriasMarcas_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Restrições para tabelas `ItensPedido`
--
ALTER TABLE `ItensPedido`
  ADD CONSTRAINT `ItensPedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `ItensPedido_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
