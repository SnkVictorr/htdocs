

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(80) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `zap` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `numero` int(20) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `clientes` (`id_cliente`, `nome`, `imagem`, `cpf`, `zap`, `email`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(1, 'João Silva', '', '', '', '', 'Rua das Flores', 111, 'casa fundo', 'Centro', 'Balneario', 'SC', '01001-000'),
(2, 'Maria Oliveira', '', '', '', '', 'Avenida Brasil', 456, '', 'Jardim América', 'Rio de Janeiro', '', '20000-000'),
(3, 'Carlos Pereira', '', '', '', '', 'Rua das Palmeiras', 789, 'Casa', 'Vila Nova', 'Belo Horizonte', '', '30000-000'),
(4, 'Ana Costa', '', '', '', '', 'Praça da Liberdade', 101, '', 'Liberdade', 'Porto Alegre', '', '90000-000'),
(5, 'Pedro Santos', '', '', '', '', 'Rua do Comércio', 202, 'Sala 5', 'Centro', 'Curitiba', '', '80000-000'),
(6, 'Lucia Almeida', '', '', '', '', 'Avenida Paulista', 303, '', 'Bela Vista', 'São Paulo', '', '01310-000');


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`) VALUES
(1, 'joao', 'teste@1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'jaca', 'teste@2', '2e6f9b0d5885b6010f9167787445617f553a735f');



ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);



ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

