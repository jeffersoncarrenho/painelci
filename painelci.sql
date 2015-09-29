-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Set-2015 às 22:42
-- Versão do servidor: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `painelci`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operacao` varchar(45) NOT NULL,
  `query` text NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `data_hora`, `operacao`, `query`, `observacao`) VALUES
(4, 'jefferson', '2015-09-28 14:06:51', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(5, 'jefferson', '2015-09-28 14:07:11', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(6, 'jefferson', '2015-09-28 14:07:38', 'Inclusão de usuários', 'INSERT INTO `usuarios` (`nome`, `email`, `login`, `senha`, `adm`) VALUES (''Usuário De Teste'', ''teste@site.com'', ''teste'', ''81dc9bdb52d04dc20036dbd8313ed055'', 1)', 'Novo usuário incluído no sistema'),
(7, 'jefferson', '2015-09-28 14:08:02', 'Alteração de usuários', 'UPDATE `usuarios` SET `senha` = ''d93591bdf7860e1e4ee2fca799911215'' WHERE `id` =  ''8''', ''),
(8, 'jefferson', '2015-09-28 14:08:30', 'Alteração de usuários', 'UPDATE `usuarios` SET `nome` = ''Usuário De Teste'', `ativo` = 0, `adm` = 0 WHERE `id` =  ''8''', ''),
(9, 'jefferson', '2015-09-28 14:08:54', 'Exclusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` =  ''8''', ''),
(10, 'jefferson', '2015-09-28 14:09:06', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(11, 'jefferson', '2015-09-28 14:31:47', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(12, 'jefferson', '2015-09-28 15:55:37', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Teste'', '''', ''Jordania-Petra.jpg'')', 'Nova mídia cadastrada no sistema'),
(13, 'jefferson', '2015-09-28 17:28:31', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Jordania'', '''', ''Jordania-Petra1.jpg'')', 'Nova mídia cadastrada no sistema'),
(14, 'jefferson', '2015-09-28 17:29:48', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Jordania'', ''Imagem Jordania'', ''Jordania-Petra.jpg'')', 'Nova mídia cadastrada no sistema'),
(15, 'jefferson', '2015-09-28 17:30:54', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Madri'', '''', ''Rio-Manzanares-Madrid.jpg'')', 'Nova mídia cadastrada no sistema'),
(16, 'jefferson', '2015-09-28 17:48:07', 'Alteração de usuários', 'UPDATE `usuarios` SET `nome` = ''Joãozinho Da Silveira'', `ativo` = 1, `adm` = 1 WHERE `id` =  ''6''', ''),
(17, 'jefferson', '2015-09-28 17:49:02', 'Inclusão de usuários', 'INSERT INTO `usuarios` (`nome`, `email`, `login`, `senha`, `adm`) VALUES (''Zequinha Da Silva'', ''zequinha@site.com'', ''zaquinha'', ''81dc9bdb52d04dc20036dbd8313ed055'', 0)', 'Novo usuário incluído no sistema'),
(18, 'jefferson', '2015-09-28 17:49:13', 'Exclusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` =  ''9''', ''),
(19, 'jefferson', '2015-09-28 18:01:52', 'Alteração de mídia', 'UPDATE `midia` SET `nome` = ''Jordania-Petra'', `descricao` = ''Imagem Jordania - Petra'' WHERE `id` =  ''3''', 'A mídia com o id "3" foi alterada'),
(20, 'jefferson', '2015-09-28 18:09:34', 'Alteração de mídia', 'UPDATE `midia` SET `nome` = ''Madri'', `descricao` = ''Imagem Madri'' WHERE `id` =  ''4''', 'A mídia com o id "4" foi alterada'),
(21, 'jefferson', '2015-09-28 18:11:03', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(22, 'jefferson', '2015-09-28 18:11:07', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(23, 'jefferson', '2015-09-28 18:11:20', 'Alteração de mídia', 'UPDATE `midia` SET `nome` = ''Jordania-Petra 2'', `descricao` = ''Imagem Jordania - Petra'' WHERE `id` =  ''3''', 'A mídia com o id "3" foi alterada'),
(24, 'jefferson', '2015-09-28 18:11:34', 'Alteração de mídia', 'UPDATE `midia` SET `nome` = ''Jordania-Petra'', `descricao` = ''Imagem Jordania - Petra'' WHERE `id` =  ''3''', 'A mídia com o id "3" foi alterada'),
(25, 'jefferson', '2015-09-28 18:11:35', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(26, 'joao', '2015-09-28 18:11:46', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''joao''\nLIMIT 1', 'Login efetuado com sucesso'),
(27, 'joao', '2015-09-28 18:11:55', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(28, 'jefferson', '2015-09-28 18:12:01', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(29, 'jefferson', '2015-09-28 18:12:14', 'Alteração de usuários', 'UPDATE `usuarios` SET `senha` = ''81dc9bdb52d04dc20036dbd8313ed055'' WHERE `id` =  ''4''', ''),
(30, 'jefferson', '2015-09-28 18:12:15', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(31, 'alberto', '2015-09-28 18:12:25', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''alberto''\nLIMIT 1', 'Login efetuado com sucesso'),
(32, 'alberto', '2015-09-28 18:15:09', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(33, 'jefferson', '2015-09-28 18:15:13', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(34, 'jefferson', '2015-09-28 18:27:05', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Teste'', ''teste'', ''Berlim-Alemanha-Chamada.jpg'')', 'Nova mídia cadastrada no sistema'),
(35, 'jefferson', '2015-09-28 18:27:12', 'Exclusão de mídia', 'DELETE FROM `midia`\nWHERE `id` =  ''5''', 'A Mídia com o id "" foi excluída'),
(36, 'jefferson', '2015-09-28 18:27:36', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Teste'', ''teste'', ''Espanha-Praça-de-Cibeles-Madrid.jpg'')', 'Nova mídia cadastrada no sistema'),
(37, 'jefferson', '2015-09-28 18:28:37', 'Exclusão de mídia', 'DELETE FROM `midia`\nWHERE `id` =  ''6''', 'A Mídia com o id "" foi excluída'),
(38, 'jefferson', '2015-09-28 19:32:56', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(39, 'jefferson', '2015-09-28 20:45:24', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Fale Conosco'', ''fale-conosco'', ''<p>Form de contato aqui</p>'')', 'Nova página cadastrada no sistema'),
(40, 'jefferson', '2015-09-28 20:47:06', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Convênios'', ''convnios'', ''<p>Conte&uacute;do aqui</p>\\r\\n<p>&nbsp;</p>'')', 'Nova página cadastrada no sistema'),
(41, 'jefferson', '2015-09-28 20:48:53', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Fale Conosco'', ''fale-conosco'', ''&lt;p&gt;Form de contato aqui&lt;/p&gt;'')', 'Nova página cadastrada no sistema'),
(42, 'jefferson', '2015-09-28 20:57:53', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Convênios'', ''convenios'', ''&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;'')', 'Nova página cadastrada no sistema'),
(43, 'jefferson', '2015-09-28 20:58:58', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Convênios Médicos'', ''convenios-medicos'', ''&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;'')', 'Nova página cadastrada no sistema'),
(44, 'jefferson', '2015-09-28 21:09:42', 'Inclusão de página', 'INSERT INTO `paginas` (`titulo`, `slug`, `conteudo`) VALUES (''Teste'', ''abc-def'', ''&lt;p style=&quot;text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial, Helvetica, sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus tortor sit amet euismod venenatis. Quisque fermentum nulla nec mollis ultricies. Quisque metus velit, faucibus ac tempus non, ultrices non libero. Duis tincidunt velit ante, in tincidunt felis venenatis et. Curabitur congue urna fringilla augue imperdiet, in euismod metus efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In a interdum lacus. Phasellus accumsan venenatis tristique.&lt;/p&gt;\\r\\n&lt;p style=&quot;text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial, Helvetica, sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;&quot;&gt;Maecenas rutrum mi quis augue interdum pulvinar a a purus. Ut sit amet facilisis enim. Proin nibh quam, accumsan sed consectetur posuere, auctor non velit. Aliquam consequat pharetra euismod. Proin tincidunt tellus mattis dolor ultricies rutrum. Nunc in condimentum nibh, lacinia pretium nisl. Maecenas lobortis id nunc in viverra. Quisque in posuere ipsum.&lt;/p&gt;'')', 'Nova página cadastrada no sistema'),
(45, 'jefferson', '2015-09-28 21:18:50', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso'),
(46, 'jefferson', '2015-09-29 12:39:37', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(47, 'jefferson', '2015-09-29 12:59:32', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Fale Conosco'', `slug` = ''fale-conosco'', `conteudo` = ''&lt;p&gt;Form de contato aqui&lt;/p&gt;\\r\\n&lt;p&gt;Texto da p&amp;aacute;gina&lt;/p&gt;'' WHERE `id` =  ''3''', 'A página com o id "3" foi alterada'),
(48, 'jefferson', '2015-09-29 13:00:12', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Convênios Médicos2'', `slug` = ''convenios-medicos'', `conteudo` = ''&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;'' WHERE `id` =  ''5''', 'A página com o id "5" foi alterada'),
(49, 'jefferson', '2015-09-29 13:00:16', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Convênios Médicos2'', `slug` = ''convenios-medicos2'', `conteudo` = ''&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;'' WHERE `id` =  ''5''', 'A página com o id "5" foi alterada'),
(50, 'jefferson', '2015-09-29 13:01:29', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Convênios Médicos'', `slug` = ''convenios-medicos'', `conteudo` = ''&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;'' WHERE `id` =  ''5''', 'A página com o id "5" foi alterada'),
(51, 'jefferson', '2015-09-29 13:07:17', 'Exclusão de página', 'DELETE FROM `paginas`\nWHERE `id` =  ''6''', 'A página com o id "" foi excluída'),
(52, 'jefferson', '2015-09-29 14:42:20', 'Login no sistema', 'SELECT *\nFROM (`usuarios`)\nWHERE `login` =  ''jefferson''\nLIMIT 1', 'Login efetuado com sucesso'),
(53, 'jefferson', '2015-09-29 15:30:55', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Fale Conosco'', `slug` = ''fale-conosco'', `conteudo` = ''&lt;p&gt;Form de contato aqui&lt;/p&gt;\\r\\n&lt;p&gt;&lt;img src=&quot;http://localhost/rbtech/painelci/uploads/Rio-Manzanares-Madrid.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;http://localhost/rbtech/painelci/uploads/Jordania-Petra.jpg&quot; alt=&quot;&quot; /&gt;&lt;/p&gt;'' WHERE `id` =  ''3''', 'A página com o id "3" foi alterada'),
(54, 'jefferson', '2015-09-29 17:28:59', 'Alteração de página', 'UPDATE `paginas` SET `titulo` = ''Fale Conosco'', `slug` = ''fale-conosco'', `conteudo` = ''&lt;p&gt;Form de contato aqui&lt;/p&gt;\\r\\n&lt;p&gt;&lt;img src=&quot;http://localhost/rbtech/painelci/uploads/Rio-Manzanares-Madrid.jpg&quot; alt=&quot;&quot; /&gt;&lt;/p&gt;'' WHERE `id` =  ''3''', 'A página com o id "3" foi alterada'),
(55, 'jefferson', '2015-09-29 18:22:55', 'Inclusão de mídia', 'INSERT INTO `midia` (`nome`, `descricao`, `arquivo`) VALUES (''Logo'', '''', ''interpoint_app_512x512px.png'')', 'Nova mídia cadastrada no sistema'),
(56, 'jefferson', '2015-09-29 18:24:15', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''nome_site'', ''Site abc'')', 'Nova configuração cadastrada no sistema'),
(57, 'jefferson', '2015-09-29 18:24:15', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''url_logomarca'', ''http://localhost/rbtech/painelci/uploads/interpoint_app_512x512px.png'')', 'Nova configuração cadastrada no sistema'),
(58, 'jefferson', '2015-09-29 18:24:15', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''email_adm'', ''email@siteabc.com'')', 'Nova configuração cadastrada no sistema'),
(59, 'jefferson', '2015-09-29 18:25:38', 'Exclusão de configuração', 'DELETE FROM `settings`\nWHERE `nome_config` =  ''email_adm''', 'A configuração do campo "" foi excluída'),
(60, 'jefferson', '2015-09-29 18:36:07', 'Exclusão de configuração', 'DELETE FROM `settings`\nWHERE `nome_config` =  ''nome_site''', 'A configuração do campo "" foi excluída'),
(61, 'jefferson', '2015-09-29 18:36:07', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''email_adm'', '''')', 'Nova configuração cadastrada no sistema'),
(62, 'jefferson', '2015-09-29 18:36:11', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''nome_site'', ''Site abc'')', 'Nova configuração cadastrada no sistema'),
(63, 'jefferson', '2015-09-29 18:36:11', 'Exclusão de configuração', 'DELETE FROM `settings`\nWHERE `nome_config` =  ''email_adm''', 'A configuração do campo "" foi excluída'),
(64, 'jefferson', '2015-09-29 18:38:01', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''email_adm'', '''')', 'Nova configuração cadastrada no sistema'),
(65, 'jefferson', '2015-09-29 18:40:02', 'Exclusão de configuração', 'DELETE FROM `settings`\nWHERE `nome_config` =  ''email_adm''', 'A configuração do campo "" foi excluída'),
(66, 'jefferson', '2015-09-29 18:41:56', 'Inclusão de Configuração', 'INSERT INTO `settings` (`nome_config`, `valor_config`) VALUES (''email_adm'', '''')', 'Nova configuração cadastrada no sistema'),
(67, 'jefferson', '2015-09-29 18:41:59', 'Exclusão de configuração', 'DELETE FROM `settings`\nWHERE `nome_config` =  ''email_adm''', 'A configuração do campo "" foi excluída'),
(68, 'jefferson', '2015-09-29 19:09:45', 'Logoff no sistema', '0', 'Logoff efetuado com sucesso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia`
--

CREATE TABLE IF NOT EXISTS `midia` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `midia`
--

INSERT INTO `midia` (`id`, `nome`, `descricao`, `arquivo`) VALUES
(3, 'Jordania-Petra', 'Imagem Jordania - Petra', 'Jordania-Petra.jpg'),
(4, 'Madri', 'Imagem Madri', 'Rio-Manzanares-Madrid.jpg'),
(5, 'Logo', '', 'interpoint_app_512x512px.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `conteudo` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `slug`, `conteudo`) VALUES
(3, 'Fale Conosco', 'fale-conosco', '&lt;p&gt;Form de contato aqui&lt;/p&gt;\r\n&lt;p&gt;&lt;img src=&quot;http://localhost/rbtech/painelci/uploads/Rio-Manzanares-Madrid.jpg&quot; alt=&quot;&quot; /&gt;&lt;/p&gt;'),
(5, 'Convênios Médicos', 'convenios-medicos', '&lt;p&gt;Conte&amp;uacute;do aqui&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `nome_config` varchar(255) NOT NULL,
  `valor_config` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `nome_config`, `valor_config`) VALUES
(2, 'url_logomarca', 'http://localhost/rbtech/painelci/uploads/interpoint_app_512x512px.png'),
(5, 'nome_site', 'Site abc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `adm` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `ativo`, `adm`) VALUES
(1, 'Jefferson Lima', 'jefferson@interpoint.com.br', 'jefferson', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1),
(4, 'Alberto Roberto', 'alberto@site.com', 'alberto', '81dc9bdb52d04dc20036dbd8313ed055', 1, 0),
(6, 'Joãozinho Da Silveira', 'joao@site.com', 'joao', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midia`
--
ALTER TABLE `midia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `midia`
--
ALTER TABLE `midia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
