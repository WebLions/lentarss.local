-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 19 2016 г., 16:58
-- Версия сервера: 5.5.46-0ubuntu0.14.04.2
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `project_lentarss`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` varchar(225) NOT NULL,
  `tag` text NOT NULL,
  `period` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `link`, `description`, `tag`, `period`, `update`, `date`) VALUES
(3, 'test', 'tests', 'tes', 'test', 1, 0, '2016-02-18 16:55:30'),
(9, '1234', '1234', '1234', '', 0, 0, '2016-02-18 17:00:46');

-- --------------------------------------------------------

--
-- Структура таблицы `category_to_source`
--

CREATE TABLE IF NOT EXISTS `category_to_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `category_to_source`
--

INSERT INTO `category_to_source` (`id`, `category_id`, `source_id`) VALUES
(19, 3, 18),
(20, 3, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `category_to_special`
--

CREATE TABLE IF NOT EXISTS `category_to_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `category_to_special`
--

INSERT INTO `category_to_special` (`id`, `category_id`, `item_id`) VALUES
(8, 3, 25),
(9, 3, 26);

-- --------------------------------------------------------

--
-- Структура таблицы `error_log`
--

CREATE TABLE IF NOT EXISTS `error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `link` text NOT NULL,
  `date` datetime NOT NULL,
  `rang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `img` text NOT NULL,
  `period` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `now` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rss_parser` (`source_id`),
  KEY `id_rss` (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `category_id`, `source_id`, `guid`, `title`, `description`, `link`, `img`, `period`, `date`, `now`) VALUES
(1, 0, 18, '1270351', 'В Україні від ускладнень внаслідок грипу померло 319 осіб ', 'Unian 2016-02-19 15:05:05', 'http://health.unian.ua/country/1270351-v-ukrajini-vid-uskladnen-vnaslidok-gripu-pomerlo-319-osib.html', '/images/18/2016-02-19/1455887415_1455.jpg', 0, '2016-02-19 15:05:05', 0),
(2, 0, 18, '1270343', 'У Держдумі РФ готові обговорювати штрафи й арешт до 15 діб для геїв за камінг-аут', 'Unian 2016-02-19 14:58:00', 'http://www.unian.ua/world/1270343-u-derjdumi-rf-gotovi-obgovoryuvati-shtrafi-y-aresht-do-15-dib-dlya-gejiv-za-kaming-aut.html', '/images/18/2016-02-19/1455887416_1870.jpg', 0, '2016-02-19 14:58:00', 0),
(3, 0, 18, '1270327', 'У США вперше за 10 років заквітла Долина Смерті ', 'Unian 2016-02-19 14:53:00', 'http://ecology.unian.ua/ecologyclimate/1270327-u-ssha-vpershe-za-10-rokiv-zakvitla-dolina-smerti-foto-video.html', '/images/default.jpg', 0, '2016-02-19 14:53:00', 0),
(4, 0, 18, '1270321', 'Mercedes-Benz слідом за Volkswagen потрапив у дизельний скандал: у США подали позов на концерн', 'Unian 2016-02-19 14:45:00', 'http://economics.unian.ua/industry/1270321-mercedes-benz-slidom-za-volkswagen-potrapiv-u-dizelniy-skandal-u-ssha-podali-pozov-na-kontsern.html', '/images/18/2016-02-19/1455887416_495.jpg', 0, '2016-02-19 14:45:00', 0),
(5, 0, 18, '1270312', 'США завдали ударів по позиціях ІД в Лівії: знищено близько 30 бойовиків', 'Unian 2016-02-19 14:40:00', 'http://www.unian.ua/world/1270312-ssha-zavdali-udariv-po-pozitsiyah-id-v-liviji-zaginuli-blizko-40-boyovikiv.html', '/images/18/2016-02-19/1455887416_930.jpg', 0, '2016-02-19 14:40:00', 0),
(6, 0, 18, '1270306', 'У Раді обговорюють кандидатуру Юрія Луценка на посаду генпрокурора', 'Unian 2016-02-19 14:38:00', 'http://www.unian.ua/politics/1270306-u-radi-obgovoryuyut-kandidaturu-yuriya-lutsenka-na-posadu-genprokurora.html', '/images/18/2016-02-19/1455887417_1504.jpg', 0, '2016-02-19 14:38:00', 0),
(7, 0, 18, '1270301', 'Нафта продовжує дешевшати на даних із США', 'Unian 2016-02-19 14:36:00', 'http://economics.unian.ua/energetics/1270301-nafta-prodovjue-deshevshati-na-danih-iz-ssha.html', '/images/18/2016-02-19/1455887418_1285.jpg', 0, '2016-02-19 14:36:00', 0),
(8, 0, 18, '1270296', 'Імпорт автомобілів до України за рік скоротився на 41%', 'Unian 2016-02-19 14:30:00', 'http://economics.unian.ua/transport/1270296-import-avtomobiliv-do-ukrajini-za-rik-skorotivsya-na-41.html', '/images/18/2016-02-19/1455887418_976.jpg', 0, '2016-02-19 14:30:00', 0),
(9, 0, 18, '1270292', 'Вчені створили карту найбільш постраждалих від змін клімату місць на Землі', 'Unian 2016-02-19 14:29:00', 'http://ecology.unian.ua/ecologyclimate/1270292-vcheni-stvorili-kartu-naybilsh-postrajdalih-vid-zmin-klimatu-mists-na-zemli.html', '/images/18/2016-02-19/1455887418_1982.jpg', 0, '2016-02-19 14:29:00', 0),
(10, 0, 18, '1270287', 'Парубій: У складі коаліції перебуває понад 226 депутатів, і вона існує', 'Unian 2016-02-19 14:25:00', 'http://www.unian.ua/politics/1270287-parubiy-u-skladi-koalitsiji-perebuvae-ponad-226-deputativ-i-vona-isnue.html', '/images/18/2016-02-19/1455887419_1896.jpg', 0, '2016-02-19 14:25:00', 0),
(11, 0, 18, '1269906', 'Спільне виховання дітей змінює імунну систему всіх членів сім''ї', 'Unian 2016-02-19 14:15:00', 'http://health.unian.ua/worldnews/1269906-spilne-vihovannya-ditey-zminyue-imunnu-sistemu-vsih-chleniv-simji.html', '/images/18/2016-02-19/1455887419_1753.jpg', 0, '2016-02-19 14:15:00', 0),
(12, 0, 18, '1270273', 'Жіноча збірна України з баскетболу проведе ключовий матч відбору Євробаскету-2017 з командою Сербії  ', 'Unian 2016-02-19 14:10:00', 'http://www.unian.ua/sport/1270273-jinocha-zbirna-ukrajini-z-basketbolu-provede-klyuchoviy-match-vidboru-evrobasketu-2017-z-komandoyu-serbiji.html', '/images/18/2016-02-19/1455887420_1137.jpg', 0, '2016-02-19 14:10:00', 0),
(13, 0, 18, '1270268', 'Узбекистан достроково скасував додатковий імпортний збір на українські товари', 'Unian 2016-02-19 14:09:00', 'http://economics.unian.ua/finance/1270268-uzbekistan-dostrokovo-skasuvav-dodatkoviy-importniy-zbir-na-ukrajinski-tovari.html', '/images/default.jpg', 0, '2016-02-19 14:09:00', 0),
(14, 0, 18, '1270262', 'В Росії підрахували вартість моста до окупованого Криму', 'Unian 2016-02-19 14:07:00', 'http://economics.unian.ua/finance/1270262-v-rosiji-pidrahuvali-vartist-mosta-do-okupovanogo-krimu.html', '/images/18/2016-02-19/1455887420_526.jpg', 0, '2016-02-19 14:07:00', 0),
(15, 0, 18, '1270256', 'В Україну після розвалу коаліції почали збиратися глави МЗС Німеччини та Франції', 'Unian 2016-02-19 14:05:00', 'http://www.unian.ua/politics/1270256-v-ukrajinu-pislya-rozvalu-koalitsiji-pochali-zbiratisya-glavi-mzs-nimechchini-ta-frantsiji.html', '/images/18/2016-02-19/1455887421_1054.jpg', 0, '2016-02-19 14:05:00', 0),
(16, 0, 18, '1270249', 'ГПУ завершила розслідування проти командира роти "Беркута" щодо побиття 18 активістів "Автомайдану"', 'Unian 2016-02-19 14:02:41', 'http://www.unian.ua/politics/1270249-gpu-zavershila-rozsliduvannya-proti-komandira-roti-berkuta-schodo-pobittya-18-aktivistiv-avtomaydanu.html', '/images/18/2016-02-19/1455887421_940.jpg', 0, '2016-02-19 14:02:41', 0),
(17, 0, 18, '1270238', 'Запорізька міськрада визнала Росію країною-агресором, а "ДНР" і "ЛНР" - терористичними організаціями', 'Unian 2016-02-19 13:54:26', 'http://www.unian.ua/politics/1270238-zaporizka-miskrada-viznala-rosiyu-krajinoyu-agresorom-a-dnr-i-lnr-teroristichnimi-organizatsiyami.html', '/images/18/2016-02-19/1455887422_916.jpg', 0, '2016-02-19 13:54:26', 0),
(18, 0, 18, '1270230', 'Росія зосередила до 8 тисяч військових біля українського кордону - розвідка', 'Unian 2016-02-19 13:50:00', 'http://www.unian.ua/war/1270230-rosiya-zoseredila-do-8-tisyach-viyskovih-bilya-ukrajinskogo-kordonu-rozvidka.html', '/images/18/2016-02-19/1455887422_1791.jpg', 0, '2016-02-19 13:50:00', 0),
(19, 0, 18, '1270226', 'Про вихід з коаліції заявив ще один депутат міжфракційного об’єднання "Народний контроль"', 'Unian 2016-02-19 13:48:00', 'http://www.unian.ua/politics/1270226-pro-vihid-z-koalitsiji-zayaviv-sche-odin-deputat-mijfraktsiynogo-obednannya-narodniy-kontrol.html', '/images/18/2016-02-19/1455887423_430.jpg', 0, '2016-02-19 13:48:00', 0),
(20, 0, 18, '1270223', 'Радник Путіна у лютому двічі приїжджав на Донбас, обговорював відновлення активних боїв – розвідка', 'Unian 2016-02-19 13:46:00', 'http://www.unian.ua/war/1270223-radnik-putina-u-lyutomu-dvichi-prijijdjav-na-donbas-obgovoryuvav-vidnovlennya-aktivnih-bojiv-rozvidka.html', '/images/18/2016-02-19/1455887423_1557.jpg', 0, '2016-02-19 13:46:00', 0),
(21, 0, 18, '1270218', 'У столиці Кенії з національного парку втекли леви', 'Unian 2016-02-19 13:43:00', 'http://ecology.unian.ua/salvationspecies/1270218-u-stolitsi-keniji-z-natsionalnogo-parku-vtekli-levi.html', '/images/18/2016-02-19/1455887424_1258.jpg', 0, '2016-02-19 13:43:00', 0),
(22, 0, 18, '1270209', 'Досі не знайдено 53 особи, які зникли під час подій на Майдані – волонтери', 'Unian 2016-02-19 13:43:00', 'http://www.unian.ua/society/1270209-dosi-ne-znaydeno-53-osobi-yaki-znikli-pid-chas-podiy-na-maydani-volonteri.html', '/images/default.jpg', 0, '2016-02-19 13:43:00', 0),
(23, 0, 18, '1270205', 'Яценюк перед голосуванням за відставку його Кабміну тричі їздив до Адміністрації президента - ЗМІ ', 'Unian 2016-02-19 13:37:00', 'http://www.unian.ua/politics/1270205-yatsenyuk-pered-golosuvannyam-za-vidstavku-yogo-kabminu-trichi-jizdiv-do-administratsiji-prezidenta-zmi-foto-video.html', '/images/18/2016-02-19/1455887424_1933.jpg', 0, '2016-02-19 13:37:00', 0),
(24, 0, 18, '1270201', 'ЗМІ: Ляшко виторговує для себе крісло спікера, для соратників – міністерські посади', 'Unian 2016-02-19 13:34:08', 'http://www.unian.ua/politics/1270201-zmi-lyashko-vitorgovue-dlya-sebe-krislo-spikera-dlya-soratnikiv-ministerski-posadi.html', '/images/18/2016-02-19/1455887425_463.jpg', 0, '2016-02-19 13:34:08', 0),
(25, 0, 18, '1270199', 'Роздрібна торгівля в січні знизилася на 1,4%', 'Unian 2016-02-19 13:33:00', 'http://economics.unian.ua/finance/1270199-rozdribna-torgivlya-v-sichni-znizivsya-na-14.html', '/images/18/2016-02-19/1455887425_1272.jpg', 0, '2016-02-19 13:33:00', 0),
(26, 0, 18, '1270193', 'Скелетонист Гераскевич потрапив в Топ-10 на Юнацьких олімпійських іграх на зіпсованому скелетоні', 'Unian 2016-02-19 13:29:00', 'http://www.unian.ua/sport/1270193-skeletonist-geraskevich-potrapiv-v-top-10-na-yunatskih-olimpiyskih-igrah-na-zipsovanomu-skeletoni.html', '/images/18/2016-02-19/1455887426_84.jpg', 0, '2016-02-19 13:29:00', 0),
(27, 0, 18, '1269915', 'Навіщо потрібна міцелярна вода: як правильно її використовувати', 'Unian 2016-02-19 13:29:00', 'http://health.unian.ua/country/1269915-navischo-potribna-mitselyarna-voda-yak-pravilno-jiji-vikoristovuvati.html', '/images/18/2016-02-19/1455887426_134.jpg', 0, '2016-02-19 13:29:00', 0),
(28, 0, 18, '1270185', 'УНІАН-підтримка: Будівництво житлового комплексу поблизу парку "Перемога" у Києві призупинено', 'Unian 2016-02-19 13:28:00', 'http://www.unian.ua/society/1270185-unian-pidtrimka-budivnitstvo-jitlovogo-kompleksu-poblizu-parku-peremoga-u-kievi-prizupineno.html', '/images/18/2016-02-19/1455887427_587.jpg', 0, '2016-02-19 13:28:00', 0),
(29, 0, 19, 'eeb043909ddbf1a3968afea2d7a72aa7', 'Higuain, parla l&#39;agente: &laquo;Giocher&agrave; la Champions col Napoli&raquo;', 'Проблемная лента 2016-02-19 13:46:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/napoli/2016/02/19-8658313/higuain_parla_lagente_giocher_la_champions_col_napoli/', '/images/19/2016-02-19/1455887428_779.jpg', 0, '2016-02-19 13:46:00', 0),
(30, 0, 19, '7965ce931de67d240621719a0b9a068d', 'Vidal: &laquo;Juve, a Torino ho lasciato il cuore, ma ora ti devo battere&raquo;', 'Проблемная лента 2016-02-19 13:28:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/juve/2016/02/19-8658508/vidal_juve_a_torino_ho_lasciato_il_cuore_ma_ora_ti_devo_battere/', '/images/19/2016-02-19/1455887429_356.jpg', 0, '2016-02-19 13:28:00', 0),
(31, 0, 19, '98acb3f06d7c1f3721bcf6f093b20ad5', 'Lazio, rientro a Roma e seduta a Formello', 'Проблемная лента 2016-02-19 13:06:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/lazio/2016/02/19-8655694/lazio_rientro_a_roma_e_seduta_a_formello/', '/images/19/2016-02-19/1455887429_615.jpg', 0, '2016-02-19 13:06:00', 0),
(32, 0, 19, '8a551cffb5db280ce29bdd01b27688d6', 'Serie A Sampdoria, Montella: «A Milano per vincere»', 'Проблемная лента 2016-02-19 12:56:49', 'http://www.corrieredellosport.it/news/calcio/serie-a/sampdoria/2016/02/19-8656050/serie_a_sampdoria_montella_a_milano_per_vincere_/', '/images/19/2016-02-19/1455887430_1243.jpg', 0, '2016-02-19 12:56:49', 0),
(33, 0, 19, 'afddd0bad046610278b02b2e0dd88091', 'Serie A Inter, Mourinho non &egrave; mai andato via', 'Проблемная лента 2016-02-19 12:40:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/inter/2016/02/19-8654757/serie_a_inter_mourinho_non_mai_andato_via/', '/images/19/2016-02-19/1455887431_1778.jpg', 0, '2016-02-19 12:40:00', 0),
(34, 0, 19, '1a9c3495457b024aee7d09cdec9314d6', 'Il calcio degli Alieni, Stefanova: &laquo;Vittorie per Juventus, Napoli e Inter&raquo;', 'Проблемная лента 2016-02-19 12:37:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/2016/02/19-8654761/il_calcio_degli_alieni_stefanova_vittorie_per_juventus_napoli_e_inter/', '/images/default.jpg', 0, '2016-02-19 12:37:00', 0),
(35, 0, 19, '259f786e0328ca1c45e070e3d9429eb3', 'Roma, solo fisioterapia per De Rossi', 'Проблемная лента 2016-02-19 12:08:00', 'http://www.corrieredellosport.it/news/calcio/serie-a/roma/2016/02/19-8654532/roma_solo_fisioterapia_per_de_rossi/', '/images/19/2016-02-19/1455887432_2010.jpg', 0, '2016-02-19 12:08:00', 0),
(36, 0, 19, '29841f208c0ffaf33bd9ca6650b24a4a', 'Serie A Roma,  Strootman accelera: calvario finito', 'Проблемная лента 2016-02-19 11:57:32', 'http://www.corrieredellosport.it/news/calcio/serie-a/roma/2016/02/19-8654583/serie_a_roma_strootman_accelera_calvario_finito/', '/images/19/2016-02-19/1455887433_541.jpg', 0, '2016-02-19 11:57:32', 0),
(37, 0, 19, '9f9e5760cf7548a780a4d0e8f6144de2', 'Serie A Milan, Berlusconi vuole in regalo la Champions', 'Проблемная лента 2016-02-19 11:30:39', 'http://www.corrieredellosport.it/news/calcio/serie-a/milan/2016/02/19-8653949/serie_a_milan_berlusconi_vuole_in_regalo_la_champions/', '/images/19/2016-02-19/1455887434_1863.jpg', 0, '2016-02-19 11:30:39', 0),
(38, 0, 19, '90d7e407c418c64f4104c4ea82845d72', 'Calciomercato Juventus, Pogba: &laquo;Futuro con Guardiola? Chiss&agrave;...&raquo;', 'Проблемная лента 2016-02-19 11:30:00', 'http://www.corrieredellosport.it/news/calcio/calcio-mercato/2016/02/19-8653162/calciomercato_juventus_pogba_futuro_con_guardiola_chiss_/', '/images/19/2016-02-19/1455887435_930.jpg', 0, '2016-02-19 11:30:00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rss` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rss` (`id_rss`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `keywords`
--

INSERT INTO `keywords` (`id`, `id_rss`, `word`) VALUES
(10, 3, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `period` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `mobile` text NOT NULL,
  `date` datetime NOT NULL,
  `tag` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `source`
--

INSERT INTO `source` (`id`, `link`, `period`, `update`, `title`, `mobile`, `date`, `tag`) VALUES
(18, 'http://rss.unian.net/site/news_ukr.rss', 1, 0, 'Unian', '', '2016-02-18 19:49:02', 'test'),
(19, 'http://www.corrieredellosport.it/rss/calcio/serie-a', 1, 0, 'Проблемная лента', '', '2016-02-19 12:03:06', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `special_item`
--

CREATE TABLE IF NOT EXISTS `special_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `id_spec` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `period` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `now` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `special_item`
--

INSERT INTO `special_item` (`id`, `category_id`, `id_spec`, `title`, `link`, `description`, `img`, `period`, `update`, `now`, `date`) VALUES
(26, 0, 0, 'Спец новость', 'http://www.sql.ru/forum/618334/column-id-in-field-list-is-ambiguous', 'Она везде', '/images/special/2016-02-19/1455889007_3.jpg', 1, 5, 5, '2016-02-19 16:38:15');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `hash_password` varchar(32) NOT NULL,
  `token` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `hash_password`, `token`) VALUES
(1, 'login', 'cb7b46ec74d6a42b4323648e212f5547', '123456');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`id_rss`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
