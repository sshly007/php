-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-06-30 17:31:57
-- 服务器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `phplianxi`
--

-- --------------------------------------------------------

--
-- 表的结构 `form`
--

CREATE TABLE `form` (
  `id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  `idname` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '用户名',
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '姓名',
  `phone` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '手机号码',
  `fenliang` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '分量',
  `yinliao` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '饮料',
  `zhucai` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '主菜',
  `xiaochi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '小吃',
  `jine` int(255) NOT NULL COMMENT '金额',
  `songcan` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '送餐',
  `beizhu` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '备注',
  `dizhi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '地址',
  `shijian` bigint(255) NOT NULL COMMENT '订单时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- 转存表中的数据 `form`
--

INSERT INTO `form` (`id`, `idname`, `name`, `phone`, `fenliang`, `yinliao`, `zhucai`, `xiaochi`, `jine`, `songcan`, `beizhu`, `dizhi`, `shijian`) VALUES
(1, '123123', '213', '13112155555', '小', '可乐', '水煮鱼,番茄炒鸡蛋', '猪肚粉,蒸饺', 45, '送餐', '无', '123', 1652078712),
(2, '123123', '213', '13112155555', '小', '七喜', '螺蛳粉,青椒炒肉丝,麻辣小龙虾', '蒸饺,香炸云吞,鲜肉云吞', 65, '送餐', '无', '123', 1656225939),
(3, '123123', '213', '13112155555', '小', '七喜', '水煮鱼,番茄炒鸡蛋', '蒸饺,香炸云吞,鲜肉云吞', 55, '不送餐', '无', '到店就餐', 1655966754),
(4, '123123', '213', '13112155555', '小', '美年达', '螺蛳粉,青椒炒肉丝,麻辣小龙虾', '蒸饺,香炸云吞,鲜肉云吞', 65, '不送餐', '无', '到店就餐', 1656396237),
(5, 'root', 'root', '13112158210', '小', '芬达', '番茄炒鸡蛋,螺蛳粉,青椒炒肉丝,麻辣小龙虾', '猪肚粉,蒸饺', 65, '送餐', '无', '工作措施中医学院', 1656396303),
(6, 'root', 'root', '13112158210', '小', '七喜', '水煮鱼,番茄炒鸡蛋', '猪肚粉,蒸饺', 45, '不送餐', '无', '到店就餐', 1656396310),
(7, 'root', 'root', '13112158210', '小', '七喜', '水煮鱼,番茄炒鸡蛋', '蒸饺,香炸云吞,鲜肉云吞', 55, '送餐', '无', '工作措施中医学院', 1656403973),
(8, 'root', 'root', '13112158210', '中', '七喜', '水煮鱼,番茄炒鸡蛋', '猪肚粉,蒸饺', 85, '送餐', '无', '工作措施中医学院', 1656404013),
(9, 'root', 'root', '13112158210', '大', '七喜', '水煮鱼,番茄炒鸡蛋', '猪肚粉,蒸饺', 125, '送餐', '无', '工作措施中医学院', 1656404029),
(10, '123456', '123456', '19120545665', '小', '七喜', '水煮鱼,番茄炒鸡蛋,螺蛳粉', '香炸云吞,鲜肉云吞', 55, '送餐', '无', '广州城市职业学院', 1656407467),
(11, '123456', '123456', '19120545665', '小', '七喜', '水煮鱼,番茄炒鸡蛋,螺蛳粉', '拌面,猪肚粉', 55, '不送餐', '无', '到店就餐', 1656407472);

-- --------------------------------------------------------

--
-- 表的结构 `userpass`
--

CREATE TABLE `userpass` (
  `id` int(255) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '用户密码',
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '姓名',
  `phone` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '手机号',
  `dizhi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- 转存表中的数据 `userpass`
--

INSERT INTO `userpass` (`id`, `username`, `password`, `name`, `phone`, `dizhi`) VALUES
(1, 'root', '$2y$10$dlT9O8U7E9Kne9r/AuarGunfnq93uzET7v.3kFRYsqvjKRzWOc3ya', 'root', '13112158210', '工作措施中医学院'),
(2, '123123', '$2y$10$gZ917Xh6dyPJoAoYHaLOaOvSVSYo9E/vc7tvn5Ex8UwJBTkxmkpI6', '213', '13112155555', '123'),
(15, '123456', '$2y$10$U3IyYOS8UvGyfQ4kfXhwKuhqes3LPLyHslpe0AuXlszcKJaiscZQi', '123456', '19120545665', '广州城市职业学院');

-- --------------------------------------------------------

--
-- 表的结构 `xiaochi`
--

CREATE TABLE `xiaochi` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '小吃'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- 转存表中的数据 `xiaochi`
--

INSERT INTO `xiaochi` (`id`, `name`) VALUES
(2, '拌面'),
(5, '猪肚粉'),
(3, '蒸饺'),
(1, '香炸云吞'),
(4, '鲜肉云吞');

-- --------------------------------------------------------

--
-- 表的结构 `yinliao`
--

CREATE TABLE `yinliao` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '饮料'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- 转存表中的数据 `yinliao`
--

INSERT INTO `yinliao` (`id`, `name`) VALUES
(5, '七喜'),
(2, '农夫山泉'),
(67, '可乐'),
(6, '橙汁'),
(4, '美年达'),
(3, '芬达');

-- --------------------------------------------------------

--
-- 表的结构 `zhucai`
--

CREATE TABLE `zhucai` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '主菜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- 转存表中的数据 `zhucai`
--

INSERT INTO `zhucai` (`id`, `name`) VALUES
(1, '水煮肉片'),
(2, '水煮鱼'),
(3, '番茄炒鸡蛋'),
(4, '螺蛳粉'),
(6, '青椒炒肉丝'),
(5, '麻辣小龙虾');

--
-- 转储表的索引
--

--
-- 表的索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `userpass`
--
ALTER TABLE `userpass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 表的索引 `xiaochi`
--
ALTER TABLE `xiaochi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `yinliao`
--
ALTER TABLE `yinliao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `zhucai`
--
ALTER TABLE `zhucai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `form`
--
ALTER TABLE `form`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `userpass`
--
ALTER TABLE `userpass`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `xiaochi`
--
ALTER TABLE `xiaochi`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- 使用表AUTO_INCREMENT `yinliao`
--
ALTER TABLE `yinliao`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- 使用表AUTO_INCREMENT `zhucai`
--
ALTER TABLE `zhucai`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
