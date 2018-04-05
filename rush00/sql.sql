SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `rush`;
USE `rush`;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `category`;
INSERT INTO `category` (`id`, `name`) VALUES
(2, 'FPS'),
(4, 'MMO'),
(6, 'Réfléxion'),
(7, 'RPG'),
(8, 'Battle Royale');

DROP TABLE IF EXISTS `category_products`;
CREATE TABLE `category_products` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `category_products`;
INSERT INTO `category_products` (`id`, `id_product`, `id_category`) VALUES
(35, 5, 2),
(36, 6, 2),
(38, 9, 7),
(39, 10, 7),
(41, 11, 2),
(42, 11, 8),
(43, 7, 2),
(44, 7, 8),
(45, 12, 6),
(46, 8, 6),
(47, 13, 4),
(48, 14, 4),
(49, 15, 4);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `orders`;
INSERT INTO `orders` (`id`, `user_id`, `date`) VALUES
(6, 3, 1522592692),
(7, 3, 1522592870);

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `order_product`;
INSERT INTO `order_product` (`id`, `id_order`, `id_product`, `qte`) VALUES
(10, 6, 8, 12),
(11, 6, 7, 1),
(12, 6, 11, 1),
(13, 7, 8, 1),
(14, 7, 11, 1);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `img_url` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `product`;
INSERT INTO `product` (`id`, `name`, `description`, `img_url`, `price`) VALUES
(5, 'Doom', 'Developed by id software, the studio that pioneered the first-person shooter genre and created multiplayer Deathmatch, DOOM returns as a brutally fun and challenging modern-day shooter experience. Relentless demons, impossibly destructive guns, and fast, fluid movement provide the foundation for intense, first-person combat – whether you’re obliterating demon hordes through the depths of Hell in the single-player campaign, or competing against your friends in numerous multiplayer modes. Expand your gameplay experience using DOOM SnapMap game editor to easily create, play, and share your content with the world. ', './img/doom.jpg', 14.99),
(6, 'Tom Clancy\'s Rainbow Six® Siege', 'Tom Clancy\'s Rainbow Six Siege is the latest installment of the acclaimed first-person shooter franchise developed by the renowned Ubisoft Montreal studio.', './img/r6.jpg', 14.99),
(7, 'Fortnite Battle Royale', 'Fortnite Battle Royale is the FREE 100-player PvP mode in Fortnite. One giant map. A battle bus. Fortnite building skills and destructible environments combined with intense PvP combat. The last one standing wins. Available on PC, PlayStation 4, Xbox One & Mac.', './img/fortnite.jpg', 0),
(8, 'Portal 2', 'Portal 2 draws from the award-winning formula of innovative gameplay, story, and music that earned the original Portal over 70 industry accolades and created a cult following.  The single-player portion of Portal 2 introduces a cast of dynamic new characters, a host of fresh puzzle elements, and a much larger set of devious test chambers. Players will explore never-before-seen areas of the Aperture Science Labs and be reunited with GLaDOS, the occasionally murderous computer companion who guided them through the original game.', './img/portal.jpg', 19.99),
(9, 'Skyrim', 'Winner of more than 200 Game of the Year Awards, Skyrim Special Edition brings the epic fantasy to life in stunning detail. The Special Edition includes the critically acclaimed game and add-ons with all-new features like remastered art and effects, volumetric god rays, dynamic depth of field, screen-space reflections, and more. Skyrim Special Edition also brings the full power of mods to the PC and consoles. New quests, environments, characters, dialogue, armor, weapons and more – with Mods, there are no limits to what you can experience.', './img/skyrim.jpg', 39.99),
(10, 'The Witcher 3', 'The Witcher is a story-driven, next-generation open world role-playing game, set in a visually stunning fantasy universe, full of meaningful choices and impactful consequences. In The Witcher, you play as Geralt of Rivia, a monster hunter tasked with finding a child from an ancient prophecy.', './img/witcher.jpg', 29.99),
(11, 'Playerunknown\'s Battlegrounds', 'PLAYERUNKNOWN\'S BATTLEGROUNDS is a last-man-standing shooter being developed with community feedback. Players must fight to locate weapons and supplies in a massive 8x8 km island to be the lone survivor. This is BATTLE ROYALE.', './img/pubg.jpg', 29.99),
(12, 'The Talos Principle', 'The Talos Principle is a first-person puzzle game in the tradition of philosophical science fiction. Made by Croteam and written by Tom Jubert (FTL, The Swapper) and Jonas Kyratzes (The Sea Will Claim Everything).', './img/talos.jpg', 39.99),
(13, 'World Of Warcraft', 'Join millions of players and find your place in Azeroth and beyond in this Massively-multiplayer online role-playing game.', './img/wow.jpg', 29.99),
(14, 'Wildstar', 'WildStar est un MMORPG publié par NCsoft et développé par Carbine Studios. Il met en scène un univers futuriste dans lequel les joueurs incarnent un personnage appartenant à l’une des deux factions disponibles, les Exilés ou le Dominion dans l’exploration de Nexus, la mystérieuse planète des Eldans.', './img/wildstar.jpg', 16.99),
(15, 'The Elder Scrolls Online', 'The Elder Scrolls Online est un jeu vidéo de rôle en ligne massivement multijoueur développé par ZeniMax Online Studios, et sorti le 4 avril 2014 sur Mac et PC, ainsi que sur PlayStation 4 et Xbox One le 9 juin 2015.', './img/eso.jpg', 19.9);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `rank` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `password`, `rank`) VALUES
(3, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'admin');


ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `category_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
