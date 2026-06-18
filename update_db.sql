ALTER TABLE services ADD COLUMN description TEXT;
UPDATE services SET description='K-Beauty standartlarında harika bir değişim! Uzman stilist ve güzellik ekibimizle en iyi sonuçları elde edin. Kore güzellik sırlarını sizin için uyguluyoruz.';

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
