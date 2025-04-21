-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Nis 2025, 17:58:41
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'C9Admin', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(7, 'IMG_39033.png'),
(8, 'IMG_59591.png'),
(9, 'IMG_99896.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'C9 Hotel, Antalya, Turkey', 'https://maps.app.goo.gl/7h2JyMMoSQwhMW8m6', '+905556667788', '+905556667788', 'ask.C9hotel@gmail.com', 'facebook.com', 'instagram.com', 'twitter.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d408407.3871617556!2d30.718105000000005!3d36.897938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14c39aaeddadadc1%3A0x95c69f73f9e32e33!2sAntalya%2C%20T%C3%BCrkiye!5e0!3m2!1sen!2spl!4v1744032563220!5m2!1sen!2spl\"');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(11, 'IMG_77084.svg', 'Wifi', ''),
(12, 'IMG_31844.svg', 'Air Conditioner', ''),
(13, 'IMG_34538.svg', 'Television', ''),
(14, 'IMG_65834.svg', 'Geyser', ''),
(15, 'IMG_64321.svg', 'Spa', ''),
(16, 'IMG_30958.svg', 'Room Heater', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(16, 'bedroom'),
(17, 'balcony'),
(18, 'kitchen');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`) VALUES
(25, '1', 1, 1, 1, 1, 1, '1', 0),
(26, '12', 12, 12, 12, 12, 12, '12', 0),
(27, '3', 3, 33, 3, 3, 3, '3', 0),
(28, '123', 123, 123, 123, 123, 123, '3123', 0),
(29, '23', 2323, 23, 23, 32, 32, '123123', 0),
(30, '23', 23, 23, 32, 323, 23, '23', 0),
(31, '23', 23, 23, 23, 23, 23, '2', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(1, 1, 12),
(2, 1, 16),
(3, 2, 11),
(4, 2, 15),
(5, 2, 16),
(6, 4, 12),
(7, 4, 15),
(8, 4, 16),
(9, 5, 11),
(10, 5, 12),
(11, 5, 15),
(12, 5, 16),
(13, 6, 11),
(14, 6, 12),
(15, 6, 13),
(16, 6, 14),
(17, 6, 15),
(18, 6, 16),
(19, 7, 11),
(20, 7, 12),
(21, 7, 15),
(22, 7, 16),
(23, 8, 11),
(24, 8, 12),
(25, 8, 13),
(26, 8, 14),
(27, 8, 15),
(28, 8, 16),
(29, 9, 11),
(30, 9, 12),
(31, 9, 15),
(32, 9, 16),
(33, 10, 11),
(34, 10, 12),
(35, 10, 15),
(36, 10, 16),
(37, 11, 15),
(38, 12, 11),
(39, 12, 15),
(40, 13, 12),
(41, 13, 13),
(42, 13, 16),
(43, 14, 12),
(44, 14, 14),
(45, 14, 16),
(46, 15, 12),
(47, 15, 16),
(48, 16, 12),
(49, 16, 13),
(50, 16, 16),
(51, 17, 12),
(52, 17, 16),
(53, 18, 16),
(54, 19, 12),
(55, 19, 16),
(56, 20, 12),
(57, 20, 16),
(58, 21, 16),
(59, 22, 12),
(60, 22, 16),
(61, 23, 12),
(62, 23, 16),
(63, 24, 12),
(64, 24, 16),
(65, 25, 12),
(66, 25, 16),
(67, 26, 12),
(68, 26, 16),
(69, 27, 11),
(70, 27, 15),
(71, 28, 12),
(72, 29, 12),
(73, 29, 16),
(74, 30, 12),
(75, 30, 16),
(76, 31, 12),
(77, 31, 16);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(1, 1, 17),
(2, 1, 18),
(3, 2, 16),
(4, 2, 17),
(5, 4, 17),
(6, 5, 17),
(7, 6, 16),
(8, 6, 17),
(9, 6, 18),
(10, 7, 16),
(11, 8, 16),
(12, 8, 17),
(13, 8, 18),
(14, 9, 16),
(15, 9, 17),
(16, 10, 16),
(17, 10, 17),
(18, 11, 16),
(19, 12, 17),
(20, 14, 17),
(21, 15, 17),
(22, 16, 18),
(23, 17, 17),
(24, 18, 17),
(25, 19, 17),
(26, 20, 17),
(27, 21, 17),
(28, 22, 17),
(29, 23, 17),
(30, 24, 17),
(31, 25, 17),
(32, 26, 18),
(33, 27, 16),
(34, 28, 17),
(35, 29, 17),
(36, 30, 17),
(37, 31, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'HB Website ', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum porro dicta mollitia, iste magni dignissimos adipisci tempora? Saepe qui, magnam iusto optio numquam ea quam amet nemo maiores, minima tenetur!', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(12, 'Efe', 'IMG_72478.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(1, 'deneme', 'asdasdksad@gmail.com', '23432', '34324', 23423, '1993-03-31', 'IMG_88533.jpg', '$2y$10$lHHCL9dg2BfiEMB3W7SxS.dEY.2HhNANidGtTRD4VUB.hsEyABZDm', 0, '3a20ec1905dfdec46252ec8e90f7fc8f', '2025-04-19', 1, '2025-04-18 02:49:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_facility_name` (`name`),
  ADD UNIQUE KEY `unique_facility_icon` (`icon`);

--
-- Tablo için indeksler `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Tablo için indeksler `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Tablo için indeksler `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Tablo için AUTO_INCREMENT değeri `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
