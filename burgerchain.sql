-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 03, 2022 alle 21:01
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burgerchain`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `password` longtext NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nome` text NOT NULL,
  `disponibile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`, `disponibile`) VALUES
(1, 'Menù', 1),
(2, 'Panini', 1),
(3, 'Fritti', 1),
(4, 'Bibite', 1),
(5, 'Birre', 1),
(6, 'Salse', 1),
(7, 'Dolci', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `informazioni_sito`
--

CREATE TABLE `informazioni_sito` (
  `idSito` int(11) NOT NULL,
  `città` text NOT NULL,
  `nPaniniOrdinati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `informazioni_sito`
--

INSERT INTO `informazioni_sito` (`idSito`, `città`, `nPaniniOrdinati`) VALUES
(1, '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `idIngrediente` int(11) NOT NULL,
  `nome` text NOT NULL,
  `dettagli` longtext NOT NULL,
  `modificabile` tinyint(1) NOT NULL,
  `costoAggiunta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`idIngrediente`, `nome`, `dettagli`, `modificabile`, `costoAggiunta`) VALUES
(1, 'Manzo', '', 1, 3),
(2, 'Cetriolini', '', 1, 0.5),
(3, 'Salsa Burgerchain', '', 0, 0),
(4, 'Doppio Manzo', '', 0, 3),
(5, 'Cheddar', '', 1, 0.5),
(6, 'Doppio Cheddar', '', 1, 0.5),
(7, 'Pomodoro', '', 1, 0.5),
(8, 'Cipolla Caramellata', '', 1, 0.5),
(9, 'Bacon', '', 1, 0.5),
(10, 'Uovo', '', 1, 0.5),
(11, 'Cipolla Croccante', '', 1, 0.5),
(12, 'Insalata', '', 1, 0.5),
(13, 'Pollo', '', 1, 3),
(14, 'Salsa Curry', '', 0, 0),
(15, 'Doppio Pollo', '', 0, 0),
(16, 'Medaglione Vegetale', '', 0, 0),
(17, 'Melanzana Grigliata', '', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `menu_prodotto`
--

CREATE TABLE `menu_prodotto` (
  `idMenu` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `menu_prodotto`
--

INSERT INTO `menu_prodotto` (`idMenu`, `idProdotto`) VALUES
(1, 13),
(2, 14),
(3, 15),
(4, 16),
(5, 17),
(6, 18),
(7, 44),
(8, 45),
(9, 46),
(10, 47),
(11, 48);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `idOrdine` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `importo` double NOT NULL,
  `stato` text NOT NULL,
  `indirizzo` text NOT NULL,
  `codicePostale` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_prodotto`
--

CREATE TABLE `ordine_prodotto` (
  `idOrdine_prod` int(11) NOT NULL,
  `idOrdine` int(11) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `dettagli` longtext NOT NULL,
  `quantità` int(11) NOT NULL,
  `importo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `idProdotto` int(11) NOT NULL,
  `nome` text NOT NULL,
  `costo` double NOT NULL,
  `linkImmagine` longtext NOT NULL,
  `disponibile` tinyint(1) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`idProdotto`, `nome`, `costo`, `linkImmagine`, `disponibile`, `idCategoria`) VALUES
(1, 'Menù Hamburger', 7, 'Assets/img/prodotti/menu_Hamburger.png', 1, 1),
(2, 'Menù Black Burger', 9.5, 'Assets/img/prodotti/menu_BlackBurger.png', 1, 1),
(3, 'Menù BTC Burger', 11.5, 'Assets/img/prodotti/menu_BTC.png', 1, 1),
(4, 'Menù Oriental Chicken', 10.5, 'Assets/img/prodotti/menu_OrientalChicken.png', 1, 1),
(5, 'Menù Veggy Burger', 11, 'Assets/img/prodotti/menu_Veggie.png', 1, 1),
(6, 'Menù Cheeseburger', 7.5, 'Assets/img/prodotti/menu_CheeseBurger.png', 1, 1),
(7, 'Menù Doppio Hamburger', 10, 'Assets/img/prodotti/menu_doppio_Hamburger.png', 1, 1),
(8, 'Menù Doppio Cheeseburger', 10.5, 'Assets/img/prodotti/menu_doppio_CheeseBurger.png', 1, 1),
(9, 'Menù Doppio Black Burger', 12.5, 'Assets/img/prodotti/menu_Doppio_BlackBurger.png', 1, 1),
(10, 'Menù Doppio BTC Burger', 14.5, 'Assets/img/prodotti/menu_doppio_BTCBurger.png', 1, 1),
(11, 'Menù Doppio Oriental Chicken', 13.5, 'Assets/img/prodotti/menu_doppio_OrientalChicken.png', 1, 1),
(13, 'Hamburger', 4.5, 'Assets/img/prodotti/panino_hamburger.png', 1, 2),
(14, 'Black Burger', 7, 'Assets/img/prodotti/panino_blackBurger.png', 1, 2),
(15, 'BTC Burger', 9, 'Assets/img/prodotti/panino_btcBurger.png', 1, 2),
(16, 'Oriental Chicken', 8, 'Assets/img/prodotti/panino_Oriental_chicken.png', 1, 2),
(17, 'Veggy Burger', 8.5, 'Assets/img/prodotti/panino_VeggyBurger.png', 1, 2),
(18, 'Cheeseburger', 5, 'Assets/img/prodotti/panino_cheeseBurger.png', 1, 2),
(19, 'Patatine Fritte', 2.5, 'Assets/img/prodotti/fritti_patatine.png', 1, 3),
(20, 'Nagghyz 6pz.', 5, 'Assets/img/prodotti/fritti_nugget_6x.png', 1, 3),
(21, 'Crockhyz', 6, 'Assets/img/prodotti/fritti_Crockhyz.png', 1, 3),
(22, 'Coca-Cola', 1.5, 'Assets/img/prodotti/bibita_coca_cola.png', 1, 4),
(23, 'Sprite', 1.5, 'Assets/img/prodotti/bibita_sprite.png', 1, 4),
(24, 'Thè Limone', 1.5, 'Assets/img/prodotti/bibita_te_limone.png', 1, 4),
(25, 'Thè Pesca', 1.5, 'Assets/img/prodotti/bibita_te_pesca.png', 1, 4),
(26, 'Pepsi-Cola', 1.5, 'Assets/img/prodotti/bibita_pepsi.png', 1, 4),
(27, 'Fanta', 1.5, 'Assets/img/prodotti/bibita_fanta.png', 1, 4),
(28, 'Acqua Naturale', 1, 'Assets/img/prodotti/bibita_acqua_naturale.png', 1, 4),
(29, 'Acqua Frizzante', 1, 'Assets/img/prodotti/bibita_acqua_frizzante.png', 1, 4),
(30, 'Birra Bionda', 2.5, 'Assets/img/prodotti/birra_bionda.png', 1, 5),
(31, 'Birra Rossa', 2.5, 'Assets/img/prodotti/birra_rossa.png', 1, 5),
(32, 'Ketchup', 0.25, 'Assets/img/prodotti/salsa_ketchup.png', 1, 6),
(33, 'Maionese', 0.25, 'Assets/img/prodotti/salsa_maionese.png', 1, 6),
(34, 'Salsa Curry', 0.4, 'Assets/img/prodotti/salsa_curry.png', 1, 6),
(35, 'Salsa Burgerchain', 0.4, 'Assets/img/prodotti/salsa_burgerChain.png', 1, 6),
(36, 'Salsa Barbecue', 0.25, 'Assets/img/prodotti/salsa_barbecue.png', 1, 6),
(37, 'Salsa Polkadot', 0.4, '', 0, 6),
(38, 'Salsa Pinkchain', 0.4, '', 0, 6),
(39, 'Salsa Chiliz', 0.4, '', 0, 6),
(40, 'Panna Cotta alla Fragola e Menta', 2.5, '', 0, 7),
(41, 'Cookies con gocce di Cioccolato e Nocciola', 2.5, 'Assets/img/prodotti/dolce_cookie_cacao_nocciole.png', 1, 7),
(42, 'Muffin Artigianale al Cocco e Ananas', 2.5, '', 0, 7),
(43, 'Cookies Smarties', 2.5, 'Assets/img/prodotti/dolce_cookie_smarties.png', 1, 7),
(44, 'Doppio Hamburger', 7.5, 'Assets/img/prodotti/panino_doppio_hamburger.png', 1, 2),
(45, 'Doppio Cheeseburger', 8, 'Assets/img/prodotti/panino_doppio_cheeseBurger.png', 1, 2),
(46, 'Doppio Black Burger', 10, 'Assets/img/prodotti/panino_doppio_BlackBurger.png', 1, 2),
(47, 'Doppio BTC Burger', 12, 'Assets/img/prodotti/panino_doppio_BTCBurger.png', 1, 2),
(48, 'Doppio Oriental Chicken', 11, 'Assets/img/prodotti/panino_doppio_Oriental_Chicken.png', 1, 2),
(50, 'Nagghyz 10pz.', 8, '', 0, 3),
(51, 'Cheesecake al cioccolato', 2.5, 'Assets/img/prodotti/dolce_cheesecake_ciccolato.png', 1, 7),
(52, 'Cheesecake ai frutti di bosco', 2.5, 'Assets/img/prodotti/dolce_cheesecake_frutti_bosco.png', 1, 7),
(53, 'Cheesecake al pistacchio', 2.5, 'Assets/img/prodotti/dolce_cheesecake_pistacchio.png', 1, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_ingrediente`
--

CREATE TABLE `prodotto_ingrediente` (
  `idProdotto` int(11) NOT NULL,
  `idIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto_ingrediente`
--

INSERT INTO `prodotto_ingrediente` (`idProdotto`, `idIngrediente`) VALUES
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 3),
(14, 5),
(14, 7),
(14, 8),
(15, 1),
(15, 3),
(15, 5),
(15, 9),
(15, 10),
(15, 11),
(15, 12),
(16, 8),
(16, 12),
(16, 13),
(16, 14),
(17, 8),
(17, 12),
(17, 14),
(17, 16),
(17, 17),
(18, 1),
(18, 2),
(18, 3),
(18, 5),
(44, 2),
(44, 3),
(44, 4),
(45, 2),
(45, 3),
(45, 4),
(45, 6),
(46, 3),
(46, 4),
(46, 6),
(46, 7),
(46, 8),
(47, 3),
(47, 4),
(47, 6),
(47, 9),
(47, 10),
(47, 11),
(47, 12),
(48, 8),
(48, 12),
(48, 14),
(48, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `email` text NOT NULL,
  `password` longtext NOT NULL,
  `telefono` text NOT NULL,
  `dataCreazione` date NOT NULL,
  `oraCreazione` time NOT NULL,
  `vKey` longtext NOT NULL,
  `verificato` tinyint(1) NOT NULL,
  `bloccato` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indici per le tabelle `informazioni_sito`
--
ALTER TABLE `informazioni_sito`
  ADD PRIMARY KEY (`idSito`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idIngrediente`);

--
-- Indici per le tabelle `menu_prodotto`
--
ALTER TABLE `menu_prodotto`
  ADD PRIMARY KEY (`idMenu`,`idProdotto`),
  ADD KEY `prodotto_menu` (`idProdotto`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`idOrdine`),
  ADD KEY `ordine_utente` (`idUtente`);

--
-- Indici per le tabelle `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD PRIMARY KEY (`idOrdine_prod`),
  ADD KEY `ordine_prodotto` (`idOrdine`),
  ADD KEY `prodotto_ordine` (`idProdotto`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`idProdotto`),
  ADD KEY `prodotto_categoria` (`idCategoria`);

--
-- Indici per le tabelle `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  ADD PRIMARY KEY (`idProdotto`,`idIngrediente`),
  ADD KEY `ingrediente_prodotto` (`idIngrediente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `informazioni_sito`
--
ALTER TABLE `informazioni_sito`
  MODIFY `idSito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `idIngrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `idOrdine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  MODIFY `idOrdine_prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `idProdotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `menu_prodotto`
--
ALTER TABLE `menu_prodotto`
  ADD CONSTRAINT `menu_prodotto` FOREIGN KEY (`idMenu`) REFERENCES `prodotto` (`idProdotto`),
  ADD CONSTRAINT `prodotto_menu` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`idProdotto`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_utente` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`);

--
-- Limiti per la tabella `ordine_prodotto`
--
ALTER TABLE `ordine_prodotto`
  ADD CONSTRAINT `ordine_prodotto` FOREIGN KEY (`idOrdine`) REFERENCES `ordine` (`idOrdine`),
  ADD CONSTRAINT `prodotto_ordine` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`idProdotto`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Limiti per la tabella `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  ADD CONSTRAINT `ingrediente_prodotto` FOREIGN KEY (`idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`),
  ADD CONSTRAINT `prodotto_ingrediente` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`idProdotto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
