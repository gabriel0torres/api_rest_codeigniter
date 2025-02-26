-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/02/2025 às 19:56
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf_cnpj` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf_cnpj`) VALUES
(1, 'João Silva', '123.456.789-00'),
(2, 'Empresa XYZ Ltda', '12.345.678/0001-90'),
(3, 'Maria Oliveira', '987.654.321-00'),
(4, 'Comércio ABC S.A.', '98.765.432/0001-10'),
(5, 'Carlos Souza', '456.123.789-00'),
(6, 'Indústria Delta Ltda', '45.612.378/0001-55'),
(7, 'Ana Pereira', '321.987.654-00'),
(8, 'Supermercado Global S.A.', '32.198.765/0001-22'),
(9, 'Pedro Santos', '741.852.963-00'),
(10, 'Tech Solutions Ltda', '741.852.963-00'),
(11, 'Tech Solutions Ltda', '74.185.296/0001-33'),
(12, 'Mariana Costa', '369.258.147-00'),
(13, 'Construtora Beta S.A.', '36.925.814/0001-44'),
(14, 'Ricardo Almeida', '852.963.741-00'),
(15, 'Farmácia Saúde Ltda', '85.296.374/0001-66'),
(16, 'Fernanda Lima', '147.258.369-00'),
(17, 'Consultoria Financeira XYZ', '14.725.836/0001-77'),
(18, 'Gustavo Nunes', '258.369.147-00'),
(19, 'Transportadora Rápido Ltda', '25.836.914/0001-88'),
(20, 'Juliana Ferreira', '963.741.852-00'),
(21, 'Auto Peças Mecânica S.A.', '96.374.185/0001-99'),
(22, 'Bruno Rocha', '753.951.852-00'),
(23, 'Distribuidora Central Ltda', '75.395.185/0001-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-02-26-185617', 'App\\Database\\Migrations\\Inicial', 'default', 'App', 1740596192, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Em aberto','Pago','Cancelado') NOT NULL DEFAULT 'Em aberto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `idCliente`, `idProduto`, `quantidade`, `data_pedido`, `status`) VALUES
(1, 1, 3, 2, '2025-02-26 18:56:32', 'Em aberto'),
(2, 2, 5, 1, '2025-02-26 18:56:32', 'Em aberto'),
(3, 3, 7, 1, '2025-02-26 18:56:32', 'Pago'),
(4, 4, 10, 4, '2025-02-26 18:56:32', 'Pago'),
(5, 5, 12, 1, '2025-02-26 18:56:32', 'Cancelado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `estoque`) VALUES
(1, 'Notebook Dell', 'Notebook com 16GB RAM e SSD 512GB', 4500.00, 10),
(2, 'Smartphone Samsung', 'Celular com tela AMOLED e câmera de 108MP', 3200.00, 15),
(3, 'Smart TV LG 50\"', 'Televisão 4K com HDR e inteligência artificial', 2700.00, 8),
(4, 'Fone Bluetooth JBL', 'Fone de ouvido sem fio com cancelamento de ruído', 350.00, 25),
(5, 'Teclado Mecânico Redragon', 'Teclado RGB mecânico para gamers', 280.00, 30),
(6, 'Mouse Gamer Logitech', 'Mouse sem fio com 6 botões programáveis', 450.00, 20),
(7, 'Monitor AOC 24\"', 'Monitor Full HD IPS para trabalho e jogos', 900.00, 12),
(8, 'Cadeira Gamer ThunderX3', 'Cadeira ergonômica ajustável para conforto máximo', 1300.00, 5),
(9, 'HD Externo Seagate 1TB', 'Armazenamento externo USB 3.0', 400.00, 18),
(10, 'Impressora HP DeskJet', 'Impressora multifuncional com Wi-Fi', 700.00, 9),
(11, 'Console PlayStation 5', 'Console da nova geração com SSD ultra rápido', 4999.00, 6),
(12, 'Controle Xbox Series X', 'Controle sem fio compatível com PC e Xbox', 350.00, 14),
(13, 'Placa de Vídeo RTX 3060', 'GPU NVIDIA com 12GB GDDR6', 2800.00, 7),
(14, 'SSD NVMe Kingston 1TB', 'Armazenamento de alta velocidade para PC e notebook', 650.00, 22),
(15, 'Memória RAM 16GB DDR4', 'Módulo de memória para alta performance', 520.00, 17),
(16, 'Fonte Corsair 750W', 'Fonte modular 80 Plus Gold', 750.00, 10),
(17, 'Gabinete Gamer NZXT', 'Gabinete com vidro temperado e iluminação RGB', 680.00, 12),
(18, 'Processador Ryzen 7 5800X', 'CPU de alto desempenho para jogos e criação', 2200.00, 8),
(19, 'Placa-Mãe ASUS B550', 'Placa compatível com processadores Ryzen', 1100.00, 11),
(20, 'Câmera GoPro Hero 9', 'Câmera de ação com gravação em 5K', 2900.00, 6),
(21, 'Relógio Smartwatch Xiaomi', 'Relógio inteligente com monitoramento de saúde', 480.00, 15),
(22, 'Caixa de Som JBL Charge 5', 'Caixa de som Bluetooth resistente à água', 750.00, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
(1, 'admin@admin.com', '$2y$10$4EiC1Q6Pccj0cl9t5s3AmekETM0W7F51GYbM39ScG5jd1to0pxdwu');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_idCliente_foreign` (`idCliente`),
  ADD KEY `pedidos_idProduto_foreign` (`idProduto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_idCliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_idProduto_foreign` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
