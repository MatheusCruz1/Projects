-- --------------------------------------------------------
--
-- Estrutura do banco de dados projects
--

CREATE DATABASE projects;
USE projects;

-- --------------------------------------------------------
--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `sexo` varchar(9) NOT NULL,
  `email` varchar(65) NOT NULL,
  `senha` varchar(150) NOT NULL
);

-- --------------------------------------------------------
--
-- Estrutura da tabela `statusProjeto`
--

CREATE TABLE `statusProjeto` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL
);

INSERT INTO `statusProjeto` (`id`, `nome`) VALUES
(1, 'Executando'),
(2, 'Concluido'),
(3, 'Pausado'),
(4, 'Cancelado');

-- --------------------------------------------------------
--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_projeto` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `numero_max_participantes` int(1) NOT NULL DEFAULT '1',
  `numero_atual_participantes` int(1) NOT NULL DEFAULT '1',
  `data_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_fim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusProjeto_id` int(1) NOT NULL,
  FOREIGN KEY (statusProjeto_id) REFERENCES statusProjeto(id)
);

-- --------------------------------------------------------
--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(12) NOT NULL
);

INSERT INTO `tipo` (`id`, `nome_tipo`) VALUES
(1, 'Proprietario'),
(3, 'Participante');

-- --------------------------------------------------------
--
-- Estrutura da tabela `usuario_projeto`
--

CREATE TABLE `usuario_projeto` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `projeto_id` int(11) NOT NULL,
  `tipo_id` int(1) NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id),
  FOREIGN KEY (projeto_id) REFERENCES projeto(id),
  FOREIGN KEY (tipo_id) REFERENCES tipo(id)
);

-- --------------------------------------------------------
--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(200) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `projeto_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id),
  FOREIGN KEY (projeto_id) REFERENCES projeto(id)
);

-- --------------------------------------------------------
--
-- Estrutura da tabela `usuarioPedido`
--

CREATE TABLE `usuarioPedido` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `notificacao_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `projeto_id` int(11) DEFAULT NULL,
  FOREIGN KEY (notificacao_id) REFERENCES notificacao(id),
  FOREIGN KEY (usuario_id) REFERENCES usuario(id),
  FOREIGN KEY (projeto_id) REFERENCES projeto(id)
);