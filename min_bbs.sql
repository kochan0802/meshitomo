-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 05 日 01:59
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `min_bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `picture` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `picture`, `created`, `modified`) VALUES
(24, '前田琴美', 'kochan19920802@gmail.com', '$2y$10$h.klbjSoHQAU0sSzfdGtzOHOAniP86SfvRRjMeC8Jv0uDTv3bio3y', '20230103140858_news_03.jpg', '2023-01-03 13:34:47', '2023-01-03 13:34:47'),
(26, '前田琴美', 'email', '$2y$10$q8P5mDU./XyOSRbxD.l.seB1f.IpskLbbSTyeVyeeNoy6xTXFKHyG', '20230104042809_about_01.jpg', '2023-01-04 03:28:11', '2023-01-04 03:28:11'),
(27, '山田太郎', 'kochan19920802@info.com', '$2y$10$Ful8mHuhcYx6ZPq3lN2hjuh/1e8kE1JGB1br2aZ9sdg79OayUsOZi', '', '2023-01-04 07:02:49', '2023-01-04 07:02:49'),
(28, '前田琴美', 'kochan19920802@yahoo.co.jp', '$2y$10$Ve8feQMfRp2GNlyx8AiTse9jKWQsos5uhmdDqRfuSO1xJb6lloDQm', '', '2023-01-04 08:23:56', '2023-01-04 08:23:56');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `message`, `member_id`, `created`, `modified`) VALUES
(1, 'こんにちは', 28, '2023-01-04 18:50:03', '2023-01-04 09:50:03'),
(2, 'こんにちは', 28, '2023-01-04 18:50:19', '2023-01-04 09:50:19'),
(3, 'こんばんは', 28, '2023-01-04 18:53:37', '2023-01-04 09:53:37'),
(4, 'こんにちは', 28, '2023-01-04 19:17:19', '2023-01-04 10:17:19'),
(5, '', 28, '2023-01-04 19:17:20', '2023-01-04 10:17:20'),
(6, '', 28, '2023-01-04 19:17:20', '2023-01-04 10:17:20'),
(7, '', 28, '2023-01-04 19:17:21', '2023-01-04 10:17:21'),
(8, '', 28, '2023-01-04 19:17:53', '2023-01-04 10:17:53'),
(9, '', 28, '2023-01-04 19:17:54', '2023-01-04 10:17:54'),
(10, '', 28, '2023-01-04 19:17:54', '2023-01-04 10:17:54'),
(11, '', 28, '2023-01-04 19:17:54', '2023-01-04 10:17:54'),
(12, '', 28, '2023-01-04 19:18:34', '2023-01-04 10:18:34'),
(13, '', 28, '2023-01-04 19:18:34', '2023-01-04 10:18:34'),
(14, 'kochan19920802@yahoo.co.jp', 28, '2023-01-04 19:35:53', '2023-01-04 10:35:53'),
(15, '', 28, '2023-01-04 19:50:50', '2023-01-04 10:50:50'),
(16, '', 28, '2023-01-04 19:50:51', '2023-01-04 10:50:51');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
