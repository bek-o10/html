-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 19 2025 г., 06:53
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `html`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carusel_kel`
--

CREATE TABLE `carusel_kel` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `title2` text NOT NULL,
  `title3` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `carusel_kel`
--

INSERT INTO `carusel_kel` (`id`, `title`, `title2`, `title3`, `img`, `img2`) VALUES
(11, 'Big Sale Offer', 'Buy Now', 'Contact Us', 'img-1.png', 'img-2.png'),
(12, 'Big Sale Offer', 'Buy Now', 'Contact Us', 'img-1.png', 'img-2.png'),
(13, 'Big Sale Offer', 'Buy Now', 'Contact Us', 'img-1.png', 'img-2.png');

-- --------------------------------------------------------

--
-- Структура таблицы `computer_kel`
--

CREATE TABLE `computer_kel` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `narx` text NOT NULL,
  `narx2` text NOT NULL,
  `readMore` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `computer_kel`
--

INSERT INTO `computer_kel` (`id`, `title`, `text1`, `text2`, `text3`, `narx`, `narx2`, `readMore`, `img`, `img2`, `img3`, `time`) VALUES
(13, 'Computers & Laptops', 'MacBook', 'Apple', '$700', '$1000', 'Add To Card', 'Read More', 'LaptopForComp.jpg_3 (1).jpg', 'laptop-img.png', 'mac-img.png', '2025-04-05 21:55:25'),
(14, 'Computers & Laptop', 'Laptop', 'Apple', '$800', '$1100', 'Add To Card', 'Read More', 'LaptopForComp.jpg_2.jpg', 'mac-img.png', 'laptop-img.png', '2025-04-05 22:00:42'),
(15, 'qandaysan', 'macOs', 'menseni', 'sogindimku', '1700$', 'Add To Card', 'Read more', 'LaptopForComp.jpg_3 (1).jpg', 'laptop-img.png', 'mac-img.png', '2025-04-11 18:02:46'),
(16, 'dfsdf', 'MacBook 15', 'fsdf', 'sdasdas', 'sdfs', 'Add To Card', 'Read MOre', 'LaptopForComp.jpg_3 (1).jpg', 'laptop-img.png', 'mac-img.png', '2025-04-13 14:53:02'),
(17, 'fdsfdf', 'Lenovo', 'ghjfghjhg', 'jfghjfhj', 'fghjfghjf', 'Add To Card', 'Read More', 'LaptopForComp.jpg_3 (1).jpg', 'laptop-img.png', 'mac-img.png', '2025-04-13 14:53:42'),
(18, 'khlk', 'Asus ', 'kjlh', 'jklhjklh', 'hjklhjk', 'Add To Card', 'Read  More', 'LaptopForComp.jpg_3 (1).jpg', 'mac-img.png', 'laptop-img.png', '2025-04-13 14:53:53'),
(19, 'dafsdfasd', 'ZooBook', 'sdfasdfasd', 'fasdfa', 'sdfasdfasd', 'Add To Card', 'Read More', 'apple_zuubook.jpg', 'LaptopForComp.jpg_3 (1).jpg', 'mac-img.png', '2025-04-13 14:55:40'),
(20, 'dfasdfads', 'fasdfa', 'sdfadsf', 'fasdfasdfrewrtqewt', 'retwert', 'wrtwertwer', '', 'm-blog-2.jpg', '', '', '2025-04-13 14:55:53'),
(21, 'fetrqew', 'tqwetewt', 'retew', 'wertwertwer', 'twertwe', 'ertwrtwert', '', 'm-blog-1.jpg', '', '', '2025-04-13 14:56:12'),
(22, 'sddf', 'asdfafa', 'sdfasdfadsf', 'asdfasd', 'fasdfasdf', 'fasdfasdf', '', 'm-blog-3.jpg', '', '', '2025-04-13 14:56:31'),
(23, 'ghdfgh', 'gfhdg', 'fhdfgh', 'hjgkjlkgj', 'l;jk;lk', ';\'jl\'l;\'l', '', 'm-blog-5.jpg', '', '', '2025-04-13 14:57:00'),
(24, 'uyrtyuy', 'ruyu', 'yurtyu', 'rtyury', 'urtyury', 'urty', '', 'm-blog-5.jpg', '', '', '2025-04-13 15:17:31'),
(25, 'yur', 'hjfgh', 'jfghfj', 'ghfjgh', 'jhgfg', 'fggffgh', '', 'float2.jpg', '', '', '2025-04-13 15:18:10'),
(26, 'uyiui', 'yuiyu', 'uiyui', 'yuiuy', 'iuyiu', 'yiuyiu', '', '4s.jpg', '', '', '2025-04-13 15:18:24'),
(27, 'kjhkjlh', 'ljklhjklhk', 'jlhjklh', 'jklhjklhjklhjkljk', 'lhjklh', 'jklhjk', '', '5.jpg', '', '', '2025-04-13 15:18:42'),
(28, 'lkjhjkjklmvbmvm', 'mnmnbvmbm', 'mbbn', 'mbnmn', 'mvbnmvbnm', 'bvmbnmvb', '', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', '', '', '2025-04-13 15:20:23'),
(29, '1', '2', '3', '4', '5', '6', '', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', '', '', '2025-04-13 19:16:08'),
(30, 'sdas', 'dasds', 'dasda', 'sdasdasd', 'asdasd', 'sadasdas', '', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', '', '', '2025-04-13 19:26:07'),
(31, 'Apple', 'samsung', 'Смартфон iPhone 13 — совершенный гаджет от Apple, работающий под управлением операционной системы iOS                     15.                     Смартфон поддерживает диапазоны 5G, оснащен современным мощным и быстрым чипом A15 Bionic и системой                     двух 12 Мп камер, поддерживающими новые возможности вычислительной фотографии. Снимайте качественные                     фото и видео, играйте без тормозов, серфите и общайтесь!', 'Диагональ экрана, дюйм: 6.1 \r\nРазрешение экрана: 2532 × 1170\r\nПлотность пикселей, ppi: 460\r\nМатрица: OLED\r\nOc: iOS 15\r\nКоличество ядер: 6\r\nВес, г: 173', '700', '1000', '', 'mobile-img.png', '', '', '2025-04-13 19:27:41'),
(32, 'dasdasd', 'asda', 'sdasd', 'seni', 'dasda', 'sdasdas', '', 'camera-img.png', '', '', '2025-04-13 19:42:14'),
(33, 'sarc', 'menmanku', 'sensanku', 'ularku', 'bizlarku', '1000', 'readmore', 'm-blog-5.jpg', '', '', '2025-04-13 20:51:04'),
(35, 'ADSFD', 'ASDAFSD', 'sddfd', 'sfdsfdsdf', 'sdfs', 'dfsdfsd', 'fsdfsdfsdfsdfs', '4s.jpg', '', '', '2025-04-17 14:51:12'),
(36, 'sdas', 'dasd', 'asdas', 'dasdasd', 'asdas', 'dasd', 'dasdas', 'm-blog-3.jpg', '', '', '2025-04-23 14:39:36'),
(37, 'qanday1', 'qanday2', 'qanday3', 'qanday4', 'qanday5', 'qanda6', 'qanday7', 'm-blog-3.jpg', '', '', '2025-04-23 14:50:48'),
(38, 'dasd', 'asda', 'sdasd', 'asdas', 'dasd', 'asdas', 'daasdfasdfdfasdfasd', 'm-blog-2.jpg', 'm-blog-1.jpg', 'm-blog-1.jpg', '2025-04-23 16:18:10'),
(39, 'sda', 'asd', 'asdas', 'dasdasd', 'dasd', 'asdas', 'dasdsadsadsa', '', '', '', '2025-04-23 16:29:19'),
(40, 'sdas', 'das', 'sadas', 'dasdasdasd', 'sads', 'ddasf', 'sdfasd', 'iphone 13.jpg', 'iphone-13pro_13pro_max.jpg', 'iphone-13pro_13pro_max.jpg', '2025-04-23 16:47:38'),
(41, 'sdasd', 'sads', 's', 'sdas', 'dasd', 'asdas', 'dasda', 'post1.jpg', '5.jpg', 'mashina.jpg', '2025-04-25 20:52:38'),
(42, 'sdasasd', 'sdasda', 'asd', 'dasd', 'dasdas', 'das', 'sdas', '1bec8c703eb936820c6937aaa1052877.jpg', '1cb28c150895237.6302b188691f4.jpg', 'e71522a893928bd202e4e2631278b3ba.jpg', '2025-04-25 20:59:45'),
(43, 'sdas', 'dasd', 'asd', 'asda', 'sdasd', 'asda', 'sda', 'car1.jpg', 'car2.jpg', 'car3.jpg', '2025-04-25 21:04:40'),
(44, 'dasd', 'dasdas', 'dasd', 'asdas', 'dasdas', 'sdasda', 'sdasas', 'car4.png', 'car5.png', 'car6.png', '2025-04-25 21:04:56'),
(45, 'dfsd', 'sdfs', 'fsd', 'fsdfsdf', 'sdfsd', 'fsd', 'fsd', 'iphone-14-pro.jpg', 'iphone-13pro_13pro_max.jpg', 'iphone-15-pro_max_256.jpg', '2025-04-25 21:17:46'),
(46, 'sdas', 'dsdasds', 'dasda', 'sdasdas', 'dasdas', 'dasdasd', 'asda', 'iphone-15-pro_max_256.jpg', 'sala.png', 'iphone 13.jpg', '2025-04-27 12:01:41'),
(47, 'dfa', 'dfasdf', 'dfasdfa', 'dfasdfa', 'dfasdfadafsd', 'dfasdf', 'Read More', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'img-2.png', 'computer-workstation.jpg', '2025-05-08 19:59:41'),
(48, 'dsdfsd', 'dsfdf', 'dfsdf', 'dfsddfsdf', 'dfsdfsd', 'dfsdf', 'dfsdf', 'camera-img.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', '2025-05-08 20:01:27');

-- --------------------------------------------------------

--
-- Структура таблицы `koknav_kel`
--

CREATE TABLE `koknav_kel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `title4` varchar(255) NOT NULL,
  `title5` varchar(255) NOT NULL,
  `title6` varchar(255) NOT NULL,
  `title7` varchar(255) NOT NULL,
  `title8` varchar(255) NOT NULL,
  `title9` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `koknav_kel`
--

INSERT INTO `koknav_kel` (`id`, `title`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`) VALUES
(13, 'Categary', 'Man\'s Fashion', 'Woman Fashion', 'Beauty', 'Mobiles', 'Computers', 'Watchs', 'Kicthen', 'Sports');

-- --------------------------------------------------------

--
-- Структура таблицы `mans_kel`
--

CREATE TABLE `mans_kel` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `narx` text NOT NULL,
  `narx2` varchar(50) NOT NULL,
  `readMore` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `mans_kel`
--

INSERT INTO `mans_kel` (`id`, `title`, `text1`, `text2`, `text3`, `narx`, `narx2`, `readMore`, `img`, `img2`, `img3`, `time`) VALUES
(6, 'sdasda', 'discounted products', 'iPhone 13 Pro Max', 'Apple\'s flagship smartphone, released in 2021. The device features advanced technology, stylish design and high performance.', 'Add To Cart', 'qweqweqw', 'Read More', 'lineyka_iphone-Photoroom (1).jpg', '682a213b0cf82_15d5b23f012054a4.jpg', '682a213b0dbb7_3dbfadb8a7ef018f.jpg', '2025-04-17 23:13:54'),
(7, 'ewrwer', 'frequently buying products', 'Iphone 14 pro max', 'A premium smartphone from Apple, released in 2022. The device features a large size, high performance, and improved features compared to previous iPhone models.', 'Add To Cart', 'asdasasdasda', 'Read More', 'iphone-14-pro-max-Photoroom.png', '682a20a33665b_94d0115a30e1cebd.png', '682a20a337794_bf12de7571324f87.png', '2025-04-17 23:14:06'),
(8, 'dasdasd', 'our popular products', 'iPhone 13 Pro Max', 'Apple\'s flagship smartphone, released in 2021. The device features advanced technology, stylish design and high performance.', '23', 'Add To Card', 'Read More', '682a1e7378d10_c61544849b2c6cd2.jpg', '682a1e7379b19_9c97f67604658674.jpg', '682a1e737a5c2_5fd576465fd070d8.jpg', '2025-04-17 23:16:47'),
(9, 'erwerwe', 'wrerw', 'erwerwe', 'rwerwe', '1324324', '', '', 'sala.png', '', '', '2025-04-17 23:20:25'),
(11, 'rwerwe', 'ewrew', 'rwerwe', 'rwerw', 'erwerwe', '', '', 'iphone-15-pro_max_256.jpg', '', '', '2025-04-17 23:20:38'),
(12, 'ewrer', 'werwerw', 'erwerwe', 'rwerwer', 'werwer', '', '', 'iphone-14-pro.jpg', '', '', '2025-04-17 23:20:46'),
(13, 'erwe', 'rwerwe', 'rwer', 'gfhgfhdg', 'fdghdfgh', '', '', 'sala.png', '', '', '2025-04-17 23:20:54'),
(14, 'apple1', 'apple2', 'apple3', 'apple4', 'apple5', '', 'readmore', 'iphone 13.jpg', '', '', '2025-04-19 19:31:27'),
(15, 'sarvar', 'fgsdf', 'gsdfgs', 'fdgsdfg', 'sdfgsdf', '', 'readmore', 'iphone-14-pro.jpg', '', '', '2025-04-19 19:43:05'),
(16, 'sdasd', 'sdasd', 'dasdasd', 'sdasdas', 'sdasdas', '', 'readmore', 'iphone 13.jpg', '', '', '2025-04-19 23:02:14'),
(17, 'check1', 'check2', 'check3', 'check4', 'check5', '', 'check6', 'm-blog-1.jpg', '', '', '2025-04-19 23:48:12'),
(18, 'dasda', 'dasdas', 'sddas', 'das                    ', 'dasda', '', 'sdas', 'apple_zuubook.jpg', '', '', '2025-05-18 18:48:54'),
(19, 'fsdfdasdfa', 'sdfasdf', 'asdfasd', '      fasdfadfasdfasdf              ', 'asdfasdf', 'fasdfasdfad', 'fasdfasdfasdf', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'camera-img.png', 'computer-img.png', '2025-05-18 19:19:29'),
(20, 'weqweqwewe', 'weqw', 'eqw', '      eqweqw              ', 'eqweqw', 'eqweqweqweqw', 'weqweqwwweqweqw', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'img-1.png', '2025-05-18 19:19:44'),
(21, 'apple1', 'apple2', 'apple3', 'apple4', 'apple5', 'apple6', 'apple7', '682a197f4f6f8_5eaceb3e0fc1f2d8.jpg', '682a197f4f8e3_b96ed516c42657fe.png', '682a197f4fae7_d08105b2d2dbaa68.jpg', '2025-05-18 20:31:43');

-- --------------------------------------------------------

--
-- Структура таблицы `mobile_kel`
--

CREATE TABLE `mobile_kel` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `readMore` text NOT NULL,
  `narx` varchar(50) NOT NULL,
  `narx2` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `vaqt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `mobile_kel`
--

INSERT INTO `mobile_kel` (`id`, `title`, `text1`, `text2`, `text3`, `readMore`, `narx`, `narx2`, `img`, `img2`, `img3`, `vaqt`) VALUES
(18, 'Mobile & Watches & Cameras', 'Mobile  ', 'Add To Cart ', 'Samsung ', 'Read More', '$500 ', '$1000', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', '2025-04-06 00:43:40'),
(19, 'Apple & Iphone & Macintosh', 'Watch', ' Add To Cart ', 'Samsung ', 'Read more', '$500', '$1000', '002-Photoroom.png', '002-Photoroom.png', '002-Photoroom.png', '2025-04-06 00:47:55'),
(22, 'sdassdasd', 'Camera', 'Add To Card', 'malik', 'Read More', 'keyin', 'hdsak', 'camera-img.png', 'camera-img.png', 'camera-img.png', '2025-04-11 20:59:48'),
(23, 'sdasdasda', 'mobile', 'Add To Card', '3123123', 'Read More', 'dasda', '2131$', 'iphone-15-pro_max_256.jpg', 'iphone-15-pro_max_256.jpg', 'iphone-15-pro_max_256.jpg', '2025-04-17 23:24:04'),
(24, 'wqewqew', 'watch', 'Add To Card', 'eqweqw', 'Read More', 'eqweqwe', 'Add To Card', '682a197f4f8e3_b96ed516c42657fe.png', '682a197f4f8e3_b96ed516c42657fe.png', '682a197f4f8e3_b96ed516c42657fe.png', '2025-04-17 23:24:15'),
(25, 'wqeweq', 'Camera', 'Add To Card', 'eqweqw', 'Read More', 'eqwewe', 'Add To Card', 'camera.jpg', 'camera.jpg', 'camera.jpg', '2025-04-17 23:24:25'),
(26, 'weqwe', 'weqwe', 'qwewqew', 'eqw', '', 'eweqwe', 'weqw', 'iphone-14-pro.jpg', '', '', '2025-04-17 23:24:33'),
(27, 'gfdhdfjhjuiyui', 'hgkfhjkg', 'hjkghj', 'jkghj', '', 'kghjkgh', 'jkghjkghj', 'sala.png', '', '', '2025-04-17 23:24:45'),
(28, 'uiytuti', 'hkghjk', 'hjkghjk', 'kghjk', '', 'hjkghj', 'hjkghj', 'iphone-13pro_13pro_max.jpg', '', '', '2025-04-17 23:24:55'),
(29, 'jkhjkhj', 'kghjkghj', 'hjkghj', 'khjgkjk', 'Read More', 'hjgkhjk', 'khjgkhjgk', 'watch-img.png', '', '', '2025-04-17 23:25:05'),
(30, 'sadsdas', 'sasds', 'sdasdasdd', 'dsasd', 'sdasd', 'sdasdasds', 'sdasdsda', 'iphone 13.jpg', '', '', '2025-04-18 00:03:33'),
(31, 'asdfd', 'dsfsd', 'sdfsdd', 'dfasd', 'dfasdf', 'dfasdf', 'dfasd', 'iphone 13.jpg', '', '', '2025-04-18 00:18:11'),
(32, 'sdasd', 'sdasd', 'asdasd', 'sads', 'sdasdasda', 'dasdas', 'dasdasdassads', 'footer-logo.png', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'camera-img.png', '2025-04-18 00:18:24'),
(33, 'xczxc', 'xczxxc', 'zxcz', 'xczxc', 'czxczx', 'zxczxc', 'zxczx', 'car3.jpg', '', '', '2025-04-18 00:18:36'),
(35, 'salom1', 'salom2', 'salom3', 'salom4', 'salom7', 'salom5', 'salom6', 'sala.png', '', '', '2025-04-25 22:37:09'),
(36, 'saravrbekmanku', 'men1', 'men2', 'men3', 'Read More', 'men4', 'men5', 'car1.jpg', '', '', '2025-05-08 22:28:56'),
(37, 'sdasda', 'sdas', 'sdasa', 'sda', 'sda', 'sdasd', 'sda', 'Apple-IPhone-PNG-Photos-Background-PNG-Image.png', 'img-3.png', 'img-4.png', '2025-05-08 23:04:04');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carusel_kel`
--
ALTER TABLE `carusel_kel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `computer_kel`
--
ALTER TABLE `computer_kel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `koknav_kel`
--
ALTER TABLE `koknav_kel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mans_kel`
--
ALTER TABLE `mans_kel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mobile_kel`
--
ALTER TABLE `mobile_kel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carusel_kel`
--
ALTER TABLE `carusel_kel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `computer_kel`
--
ALTER TABLE `computer_kel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `koknav_kel`
--
ALTER TABLE `koknav_kel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `mans_kel`
--
ALTER TABLE `mans_kel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `mobile_kel`
--
ALTER TABLE `mobile_kel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
