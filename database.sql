-- Database: derste

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`username`, `password`) VALUES ('admin', 'admin123');

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'Saç',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`title`, `price`, `image`, `category`) VALUES
('Kore Stili Saç Kesimi', '600.00 TL', 'images/services/korean-hair1.jpg', 'Saç'),
('Balayage & Boya', '1500.00 TL', 'images/services/korean-hair2.jpg', 'Saç'),
('K-Beauty Makyaj', '800.00 TL', 'images/services/korean-makeup1.jpg', 'Makyaj'),
('Günlük Doğal Makyaj', '500.00 TL', 'images/services/korean-makeup2.jpg', 'Makyaj'),
('Jel Protez Tırnak', '900.00 TL', 'images/services/korean-nails1.jpg', 'Tırnak'),
('Kore Sanatsal Nail Art', '700.00 TL', 'images/services/korean-nails2.jpg', 'Tırnak');

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `people` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Bekliyor',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `staff` (`name`, `role`, `instagram`, `image`) VALUES
('Mina', 'Baş Stilist', 'mina.hair', 'images/barber/mina.jpg'),
('Yuna', 'Makyaj Uzmanı', 'yuna_makeup', 'images/barber/yuna.jpg'),
('Sia', 'Nail Art Uzmanı', 'sia.nails', 'images/barber/sia.jpg');
