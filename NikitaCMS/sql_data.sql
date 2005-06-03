-- phpMyAdmin SQL Dump
-- version 2.6.1-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 03. Juni 2005 um 15:34
-- Server Version: 4.1.11
-- PHP-Version: 4.3.11
-- 
-- Datenbank: `nikitacms`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_extensions`
-- 

CREATE TABLE `nikita_extensions` (
  `module_id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(10) NOT NULL default '0',
  `show_func` varchar(50) collate latin1_general_ci NOT NULL default '',
  `class_name` varchar(50) collate latin1_general_ci NOT NULL default '',
  `position` varchar(100) collate latin1_general_ci NOT NULL default '',
  `title` varchar(100) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `nikita_extensions`
-- 

INSERT INTO `nikita_extensions` VALUES (2, -1, 'show', 'loginbox', 'left', 'Login-Box');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_mod_content`
-- 

CREATE TABLE `nikita_mod_content` (
  `content_id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(11) NOT NULL default '0',
  `text` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Daten für Tabelle `nikita_mod_content`
-- 

INSERT INTO `nikita_mod_content` VALUES (2, 2, 'HAllop !!11eins');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_mod_news_cfg`
-- 

CREATE TABLE `nikita_mod_news_cfg` (
  `news_per_page` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Daten für Tabelle `nikita_mod_news_cfg`
-- 

INSERT INTO `nikita_mod_news_cfg` VALUES (25);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_mod_news_content`
-- 

CREATE TABLE `nikita_mod_news_content` (
  `news_id` int(11) NOT NULL auto_increment,
  `title` varchar(150) collate latin1_general_ci NOT NULL default '',
  `date` varchar(20) collate latin1_general_ci NOT NULL default '',
  `author` varchar(100) collate latin1_general_ci NOT NULL default '',
  `text` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `nikita_mod_news_content`
-- 

INSERT INTO `nikita_mod_news_content` VALUES (1, 'Die erste News', '1113131801', 'Philipp I.', '[quote name=GinuwinesSon]\r\n[quote name=Killazz]\r\n[quote name=GinuwinesSon]\r\n[quote name=Killazz]\r\nDa ich das Projekt mit der 19-jährigen (#2) ja aufgegeben habe, hab ich mich heut abend mal mit #3 getroffen (die 14-jährige).\r\nSie ist extrem schüchtern.\r\nWir haben die ganze Zeit nur über Schule geredet :|\r\nSie darf in nächster Zeit nichtmehr weg.\r\nAuf meine Party kann sie nicht, weil sie dort im Urlaub ist. Ich finde, sie sollte den nächsten Schritt machen. Da sie ja was von mir will und ich mich jetzt 2mal mit ihr getroffen habe.[/quote]\r\nWie alt bist du??[/quote]\r\n\r\n16\r\nMeine Party auf die sie nicht kommt (PrivatParties sind das einzige was ihre Mutter erlaubt) ist zu meinem 17.\r\nSie wird am 24.4 15[/quote]\r\n\r\nÄhm ja,dürfte ich wissen,wieso du mit der 19-jährigen schluss gemacht hast(die ganze Geschichte??)...weil wieso solltest du dann eine jüngere,14jährige nehmen?:o[/quote] \r\n\r\n[php]<?php echo "test"; ?>[/php]\r\n\r\n [b]Ipsum !eisn Lorem Ipsum[i] !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem[/i] Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn[/b]\r\n\r\n Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem \r\n[list]\r\n[*]Ipsum !eisn Lorem Ip\r\n[*]sum !eisn Lorem Ipsum !eisn Lo\r\n[*]rem Ipsum !eisn L\r\n[/list]\r\n\r\n\r\n[quote]\r\norem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eis\r\n[/quote]\r\nn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum !eisn Lorem Ipsum\r\n !eisn\r\n\r\n');
INSERT INTO `nikita_mod_news_content` VALUES (2, 'Die erste News', '1113130831', 'Philipp I.', '[quote name=Simon]Vehiculum, se vicis Incol se nex incontinencia, exigo era Palus sum iam magnificabiliter loci, sal incurro, dux necessarius Negotium[/quote]\r\n\r\nos orbis, era alatus ineo, vel loquor, hic sed, Viva tam. Ico explorator mos, \r\nExpello hinc hac talio, mensa plures utor to tutamen eia Extundo sentus ita Novus, his Securus, tam nam Crepundia, Torreo fas Prolixus, nec flecto alibi peragro. Nam Deficio contradictio ops Posco laeto aeger Freno ruo, votum Spero ergo Penetro, Pulmo pro, ops infra Vacuus ususfructus qui Perturpis, neco Illas his Libro. Vel emo mons liberalis longe vir ingredior, sui cautor Concito, far, \r\n\r\nComitatus mus Ambiguus palma via Degenero pio ala Imputo. Pudeo teneo triticeus, iam conjuratio, regno re oro Aveho curiositas cicuta, dis Occulte, deprecativus typus caterva pauci, his re supermitto. Ruo in divortium ita sesquimellesimus Oppono plus celo sceptrum, res ingustatus hi Ango prae tum quatenus/quatinus Sumptus per Avoco nos Indulgens mei heu cur Baiulus attonitus. Via subterfugio radio hac castra, tui Seorsum tam Byssus ex infirmitas. \r\nCum illi organum archidictus, aedificium aut Exsilio neo, pie Promus finis ingenium luo Penna iocus curo Agnellus divinus. \r\nUt ops gero \r\n[list]\r\n[*]ops Adsumo hoc propugnaculum \r\n[*]heu Ferveo necne Multo per Placitum \r\n[*]potior vel custodia caleo emendo \r\n[/list]\r\ncui prodigium alo quo beo. \r\n[code]\r\nAmens lugo res hoc rus te Felix. Do magnificentia fundo ait duo cui consul claritas Quorum ira ago ruo Moestitia, subnego en proletarius os nos, vivo his ferox Seputus lex Triduum tam .\r\n[/code]');
INSERT INTO `nikita_mod_news_content` VALUES (3, 'Erklärung zu bbCode', '', 'SirSiggi', 'Bitweise Operatoren\r\n\r\n<<, >>, &, |, ^, ~\r\n\r\n[b]Kurz angerissen:[/b]\r\n[list]\r\n[*]<< = Bitweises verschieben nach links, alle Bits werden um ein Bit nach links verschoben\r\n[*]>> = Bitweises verschieben nach Rechts, alle Bits werden um ein Bit nach rechts verschoben\r\n[*]& = Bitweises AND, 2 Zahlen werden verglichen, wenn 1 Bit an der gleichen Stelle in beiden Zahlen 1 ist dann ist diese Stelle im Ergebnis auch mit 1 belegt\r\n[*]| = Bitweises OR, 2 Zahlen werden verglichen, wenn wenn ein Bit (an der gleichen Stelle) in beiden Zahlen 1 ist (auch beide sind Möglich) steht im Ergebnis an dieser Stelle eine 1\r\n[*]^ = Bitweises XOR, genauso wie OR, bloß das hier nur eine der beiden Bits 1 sein darf.\r\n~ = Bitweises NOT, dreht die Zahl um, 1 wird 0 und 0 wird 1[/list]\r\n\r\n[b]Funktioniert so:[/b]\r\nErstmal legt wir ein paar Rechte fest:\r\n\r\n[php]<?\r\n$recht1 = 1 << 0; // = Binär 1, Dezimal 1\r\n$recht2 = 1 << 1; // = Binär 10, Dezimal 2\r\n$recht3 = 1 << 2; // = Binär 100, Dezimal 4\r\n?>[/php]\r\n\r\nHier siehst du gleich wie der Verschiebeoperator funktioniert. Er erzeugt mir automatisch die richtige Binärzahl. Man braucht sich also um die Dezimale darstellung des Rechts keine Gedanken machen.\r\n\r\nEinem Benutzer kann ich ein Recht erteilen, indem ich seine Rechte per OR mit dem gewünschten Recht vergleiche\r\n\r\n[php]<?\r\n$userrecht = $userrecht | $recht2;\r\n?>[/php]\r\n\r\nHatte der User vorher das Dezimale Rechtelevel 5 (Binär 101), hat er jetzt das Rechtelevel 7 (Binär 111). Das resultiert aus folgendem:\r\n\r\n[code]User 101\r\n| R1 010\r\n--------\r\n=    111[/code]\r\n\r\nOb ein User ein Recht hat kann man mit AND überprüfen:\r\n\r\n[php]<?\r\nif ($userrecht & $recht2) {\r\n   // User hat recht\r\n}\r\n?>[/php]\r\n\r\nFunktioniert so:\r\n[code]User 111\r\n& R1 010\r\n--------\r\n=    010[/code]\r\n\r\nDas ergibt 2 und somit wird das if TRUE.\r\n\r\nDem User ein Recht nehmen kann man mit XOR\r\n\r\n[php]<?\r\n$userrecht = $userrecht ^ $recht2;\r\n?>[/php]\r\n\r\nFunktioniert so:\r\n[code]User 111\r\n^ R1 010\r\n--------\r\n=    101[/code]\r\n\r\nGrund: XOR gibt nur da 1 zurück, wo nur eines der beiden Bits 1 ist.');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_modules`
-- 

CREATE TABLE `nikita_modules` (
  `module_id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(10) NOT NULL default '0',
  `show_func` varchar(50) collate latin1_general_ci NOT NULL default '',
  `class_name` varchar(50) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Daten für Tabelle `nikita_modules`
-- 

INSERT INTO `nikita_modules` VALUES (1, 1, 'show', 'content');
INSERT INTO `nikita_modules` VALUES (3, 1, 'show', 'news');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `nikita_users`
-- 

CREATE TABLE `nikita_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(50) collate latin1_general_ci NOT NULL default '',
  `passwort` varchar(50) collate latin1_general_ci NOT NULL default '',
  `rechte` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `nikita_users`
-- 

INSERT INTO `nikita_users` VALUES (1, 'klmann', '0d5fd26b14799e6a643433d3dcab79bd', 1);
INSERT INTO `nikita_users` VALUES (2, 'test', '098f6bcd4621d373cade4e832627b4f6', 1);