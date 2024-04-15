-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Kwi 2024, 20:47
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `xss_attack_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `price`, `title`, `description`, `image`) VALUES
(1, '49', 'Telewizor LED 40\"', 'Telewizor LED o przekątnej 40 cali', 'telewizor.webp'),
(2, '999', 'Laptop HP Pavilion', 'Laptop HP z procesorem Intel i5, 8GB RAM i 512GB SSD', 'laptop.webp'),
(3, '199', 'Smartfon Samsung Galaxy S20', 'Smartfon z ekranem 6.2\", aparatem 64MP i baterią 4000mAh', 'smartfon.webp'),
(4, '299', 'Tablet Apple iPad', 'Tablet z ekranem Retina, 128GB pamięci i obsługą Apple Pencil', 'tablet.webp'),
(5, '79', 'Słuchawki Bluetooth Sony', 'Bezprzewodowe słuchawki z redukcją hałasu i długim czasem pracy baterii', 'sluchawki.webp'),
(6, '399', 'Aparat cyfrowy Canon EOS', 'Aparat cyfrowy z matrycą 24MP, obiektywem 18-55mm i nagrywaniem wideo 4K', 'aparat.webp'),
(7, '149', 'Smartwatch Apple Watch', 'Smartwatch z wyświetlaczem Retina, czujnikiem tętna i GPS', 'smartwatch.jpg'),
(8, '899', 'Konsola do gier Sony PlayStation 5', 'Najnowsza konsola do gier z dyskiem SSD, 4K HDR i kontrolerem DualSense', 'ps5.jpg'),
(9, '499', 'Kamera sportowa GoPro Hero 10', 'Kamera sportowa z możliwością nagrywania wideo 5.3K i funkcją HyperSmooth 4.0', 'gopro.jpg'),
(10, '199', 'Monitor LG UltraGear', 'Monitor gamingowy z ekranem 27\", czasem reakcji 1ms i częstotliwością odświeżania 144Hz', 'monitor.jpg'),
(11, '29', 'Klawiatura mechaniczna Razer BlackWidow', 'Klawiatura mechaniczna z podświetleniem Chroma RGB i programowalnymi klawiszami', 'klawiatura.jpg'),
(12, '199', 'Audio-Technica ATH-M30X', 'Słuchawki wokółuszne które charakteryzują się doskonałą jakością dźwięku.', 'sluchawki2.jpg'),
(13, '99', 'Router WiFi TP-Link Archer', 'Router WiFi z obsługą standardu 802.11ac i prędkością transferu do 1200Mbps', 'router.jpg'),
(14, '49', 'Powerbank Anker PowerCore', 'Powerbank z pojemnością 20000mAh i technologią PowerIQ do szybkiego ładowania', 'powerbank.jpg'),
(15, '599', 'Karta graficzna NVIDIA GeForce RTX 3060', 'Karta graficzna z 12GB pamięci GDDR6 i obsługą Ray Tracingu', 'rtx3060.jpg'),
(16, '249', 'Drone DJI Mavic Mini', 'Drone z kamerą 2.7K i stabilizacją trzyosiową', 'drone.jpg'),
(17, '199', 'Głośniki bezprzewodowe Bose SoundLink', 'Bezprzewodowe głośniki przenośne z dźwiękiem 360 stopni i 12 godzinami czasu pracy', 'glosniki.jpg'),
(18, '89', 'Słuchawki douszne JBL Tune', 'Słuchawki douszne z wygodnymi gumkami dousznymi i basami Pure Bass', 'jbl.jpg'),
(19, '39', 'Myszka bezprzewodowa Logitech', 'Myszka bezprzewodowa z precyzyjnym sensorem optycznym i ergonomicznym kształtem', 'myszka.jpg'),
(20, '1499', 'Telefon Apple iPhone 13', 'Telefon z ekranem Super Retina XDR, A15 Bionic i aparatem 12MP', 'iphone.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `shopping_cart`
--

INSERT INTO `shopping_cart` (`userId`, `productId`) VALUES
(1, 2),
(1, 4),
(1, 6),
(2, 2),
(2, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'test', 'test', 'customer'),
(2, 'admin', 'admin', 'admin'),
(3, 'olek', '1337', 'customer');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD KEY `userId` (`userId`),
  ADD KEY `productId` (`productId`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
