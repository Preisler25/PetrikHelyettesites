SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `helyettesites` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `class` (
  `class` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `class` (`class`) VALUES
('9.KNY\r'),
('9.NY\r'),
('9.A\r'),
('9.B\r'),
('9.C\r'),
('9.D\r'),
('9.E\r'),
('10.A\r'),
('10.B\r'),
('10.C\r'),
('10.D\r'),
('10.E\r'),
('11.A\r'),
('11.B\r'),
('11.C\r'),
('11.D\r'),
('11.E\r'),
('12.A\r'),
('12.B\r'),
('12.C\r'),
('12.D\r'),
('12.E\r'),
('1/13V\r'),
('1/13H\r'),
('2/14D\r'),
('2/14F\r'),
('2/14H\r'),
('1/13S\r'),
('2/14R\r'),
('2/14S\r'),
('1/13VL\r'),
('2/14GL\r'),
('1/15GYL\r'),
('1/15MAL\r'),
('1/13SL\r'),
('2/14RL\r'),
('2/14SL\r'),
('1/15WL');

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `tname` varchar(50) DEFAULT NULL,
  `ora` varchar(30) DEFAULT NULL,
  `helytan` varchar(50) DEFAULT NULL,
  `terem` varchar(40) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `ovh` int(1) DEFAULT NULL,
  `tipus` varchar(15) DEFAULT NULL,
  `alert` text DEFAULT NULL,
  `day` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `login` (
  `uname` varchar(30) NOT NULL,
  `passw` varchar(200) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `login` (`uname`, `passw`, `id`) VALUES
('admin', 'VooLWUNTI54d2iSCtJBieKXT7ItNULUFvi4p.4r8qsw1njo5gRc1TKPS4nEqPW7jLaYv757wZF1SRlIIqi.QQ.', 1);

CREATE TABLE `tanarok` (
  `tanar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tanarok` (`tanar`) VALUES

('Babusa Tamás Gyula\r'),
('Bagóné Tóth Katalin\r'),
('Bálint György\r'),
('Balogh Zoltán\r'),
('Barabás Gergő\r'),
('Bárczay Kristóf\r'),
('Bátki Ottilia\r'),
('Bende Gyöngyi Zsuzsanna\r'),
('Benyó Judit Borbála\r'),
('Béresné Bodó Noémi Klementina\r'),
('Biró Krisztián\r'),
('Bogdán Marianna\r'),
('Boros Sándor\r'),
('Bozóki Judit\r'),
('Budaházi Bence Nándor\r'),
('Czinkóczi Tamás\r'),
('Csák Szilárd Csongor\r'),
('Csirmaz Antal\r'),
('Csutak Zsolt\r'),
('Darányi Katalin\r'),
('De Rose Lynn\r'),
('Demkó Erika\r'),
('Dolozselek Csilla\r'),
('Dr. Dóbéné Cserjés Edit\r'),
('Dr. Lois Isabella\r'),
('Dr. Szabó Marianna\r'),
('Duschák Zsuzsanna\r'),
('Elekesné Sallai Mónika Angéla\r'),
('Fandel Richárd Gábor\r'),
('Fejes Angelika\r'),
('Formanné Kiss Andrea\r'),
('Fortuna Zsuzsanna\r'),
('Gál-Berey Csilla\r'),
('Gőgh Zsolt\r'),
('Guth Gabriella Éva\r'),
('Györgyi Tamás\r'),
('Hajagos Máté\r'),
('Halász Gábor\r'),
('Halász Sándor György\r'),
('Hertelendi Gábor\r'),
('Horváth Gyöngyi\r'),
('Horváth Norbert\r'),
('Jabelkó-Tolnai Csilla Anna\r'),
('Kállóné Husi Zsuzsanna\r'),
('Karsai Gergő\r'),
('Karsai Zsófia\r'),
('Király Zalán\r'),
('Koczka István\r'),
('Kollár Zsuzsanna\r'),
('Kovács Henriette\r'),
('Kovács Olivér\r'),
('Kovács Zoltán\r'),
('Kulcsár Sándor\r'),
('Kugyelláné Schmidtka Ágnes\r'),
('Kullai-Papp Andrea\r'),
('Latabár Endre Péter\r'),
('Lovas Margaret Anikó\r'),
('Lukács Ferenc\r'),
('Magyar Erika\r'),
('Markovits Erzsébet\r'),
('Márta József István\r'),
('Merényi Miklós\r'),
('Mészáros Tamás\r'),
('Nagy Judit\r'),
('Nagyné Németh Ildikó Andrea\r'),
('Németh Eszter\r'),
('Nyisztorné Kozma Amália Éva\r'),
('Palócz István\r'),
('Pappné Debreczeni Ildikó\r'),
('Penksza Károly Lászlóné\r'),
('Petri Judit\r'),
('Rausch Péter\r'),
('Sárközi-Paulik Brigitta\r'),
('Seres Orsolya Zsuzsanna\r'),
('Siska Dávid\r'),
('Sőre Ferenc\r'),
('Szabados István\r'),
('Szakállné Rudolf Hajnalka\r'),
('Szajkó Orsolya\r'),
('Szalkay Csilla\r'),
('Szolnok Ádám\r'),
('Takács Emese\r'),
('Tihanyi Péter\r'),
('Tóth Béla\r'),
('Tóth Edina\r'),
('Tóth Enikő\r'),
('Tóth Éva\r'),
('Tóth Krisztina\r'),
('Uhlár Zoltán István\r'),
('Urbin Péter\r'),
('Ujvári Gábriel\r'),
('Vámos István Imre\r'),
('Vámos Tibor\r'),
('Varga László\r'),
('Veres Gyula\r'),
('Villányi-Borsics Eszter\r'),
('Völgyi Ferenc Iván\r'),
('Weisz Ilona Mária\r');

CREATE TABLE `termek` (
  `terem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `termek` (`terem`) VALUES
('A.007 - Kémiai-alapozó labor I.\r'),
('A.009 - Kémiai-alapozó labor II.\r'),
('A.010 - Tanterem\r'),
('A.014 - Tanterem\r'),
('A.015 - Tanterem\r'),
('A.018.A - Informatika\r'),
('A.018.B - Informatika\r'),
('A.018.C - Informatika\r'),
('A.023 - Informatika\r'),
('A.037 - Tornaterem II.\r'),
('A.105 - Analitikai labor I.\r'),
('A.106 - Analitikai labor I.\r'),
('A.108 - Analitikai labor II.\r'),
('A.109 - Csoportszoba 12 számítógéppel\r'),
('A.117 - Informatika\r'),
('A.118 - Informatika\r'),
('A.119 - Tanterem\r'),
('A.120 - Informatika\r'),
('A.121 - Informatika\r'),
('A.122 - Informatika\r'),
('A.123 - Tanterem\r'),
('A.205 - Fizika I. Tanterem\r'),
('A.206 - Kémia I. Tanterem\r'),
('A.208 - Fizika II. Előadó\r'),
('A.209 - Szertár (Fizika)\r'),
('A.210 - Tanterem\r'),
('A.215 - Tanterem\r'),
('A.216 - Tanterem\r'),
('A.217 - Tanterem\r'),
('A.218 - Tanterem\r'),
('A.220 - Tanterem\r'),
('A.222 - Informatika\r'),
('As.007 - Tornaterem III.\r'),
('As.009 - Tanterem\r'),
('As.028 - Tornaterem I.\r'),
('B.014 - Automatika laboratórium\r'),
('B.017 - Tanterem\r'),
('B.021 - Műveleti laboratórium\r'),
('B.042 - Tanterem\r'),
('B.044 - Könyvtár\r'),
('B.111 - Fejlesztő pedagógusi szoba\r'),
('B.112 - Tanácsterem\r'),
('B.115-116.Ea - I. emeleti előadó\r'),
('B.117-135 - Műszeres analitika I.\r'),
('B.124 - Tanterem - csoportszoba\r'),
('B.203 - Tanterem\r'),
('B.204 - Tanterem\r'),
('B.205 - Tanterem\r'),
('B.207 - Tanterem\r'),
('B.210-211.Ea - II. emeleti előadó\r'),
('B.212-230 - Műszeres analitika II.\r'),
('B.219 - Tanterem - csoportszoba\r'),
('B.303 - Tanterem\r'),
('B.304 - Tanterem\r'),
('B.306 - Tanterem - csoportszoba\r'),
('B.307 - Tanterem\r'),
('B.310-III. alsó előadó\r'),
('B.311-III. felső előadó\r'),
('B.314 - Biológia laboratórium\r'),
('B.319 - Tanterem - csoportszoba\r'),
('B.331 - Szerves laboratórium\r'),
('Iskolapszichológusi szoba\r'),
('Könyvtár\r'),
('Távoktatás\r'),
('Uszoda');


ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
