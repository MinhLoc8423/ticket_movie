-- Active: 1705586532035@@127.0.0.1@3306
CREATE DATABASE ticket_cinema
    DEFAULT CHARACTER SET = 'utf8mb4';
  
USE ticket_cinema;

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `phone` int NOT NULL DEFAULT '0',
  `pass_word` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` BOOLEAN NOT NULL DEFAULT 0,
  `api_token` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.users: ~0 rows (approximately)
INSERT INTO `users` (`userID`, `name`, `phone`, `pass_word`, `image_url`, `email`,`api_token`) VALUES
	(1, 'hao', 0, '$2y$2y$12$MCzNOIEbvdk1wXM0QqVsl.i5oWu.3KFmMO9YWQ96hBHbZY21gv/sK', NULL, 'abc@gmail.com', "test"),
	(2, 'Nguyễn Văn A', 901234567, '123456', 'https://example.com/avatar.png', 'nguyenvana@example.com',""),
	(3, 'Trần Thị B', 902345678, '123456', 'https://example.com/avatar2.png', 'tranthib@example.com',""),
	(4, 'Nguyễn Văn A', 901234567, '123456', 'https://example.com/avatar.png', 'nguyenvana@example.com',""),
	(5, 'Trần Thị B', 902345678, '123456', 'https://example.com/avatar2.png', 'tranthib@example.com',""),
	(6, 'Nguyễn Văn A', 901234567, '123456', 'https://example.com/avatar.png', 'nguyenvana@example.com',""),
	(7, 'Trần Thị B', 902345678, '123456', 'https://example.com/avatar2.png', 'tranthib@example.com',"");

-- Dumping structure for table tt_phim.cinema
CREATE TABLE IF NOT EXISTS `cinema` (
  `cinameID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cinameID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.cinema: ~0 rows (approximately)
INSERT INTO `cinema` (`cinameID`, `name`, `location`) VALUES
	(1, 'CGV Nguyễn Du', 'Thành phố Hồ Chí Minh'),
	(2, 'BHD Star Cineplex Hùng Vương Plaza', 'Thành phố Hồ Chí Minh'),
	(3, 'CGV Nguyễn Du', 'Thành phố Hồ Chí Minh'),
	(4, 'BHD Star Cineplex Hùng Vương Plaza', 'Thành phố Hồ Chí Minh'),
	(5, 'CGV Nguyễn Du', 'Thành phố Hồ Chí Minh'),
	(6, 'BHD Star Cineplex Hùng Vương Plaza', 'Thành phố Hồ Chí Minh');

-- Dumping structure for table tt_phim.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `genreID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`genreID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.genre: ~0 rows (approximately)
INSERT INTO `genre` (`genreID`, `name`) VALUES
	(1, 'Hành động'),
	(2, 'Hài hước'),
	(3, 'Lãng mạn'),
	(4, 'Hành động'),
	(5, 'Hài hước'),
	(6, 'Lãng mạn'),
	(7, 'Hành động'),
	(8, 'Hài hước'),
	(9, 'Lãng mạn');

-- Dumping structure for table tt_phim.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `movieID` int NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `thumnail` varchar(255) DEFAULT NULL,
  `genre_id` int DEFAULT NULL,
  `movie_time` int DEFAULT NULL,
  PRIMARY KEY (`movieID`),
  KEY `FK_genreID` (`genre_id`),
  CONSTRAINT `FK_genreID` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genreID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.movies: ~0 rows (approximately)
INSERT INTO `movies` (`movieID`, `movie_title`, `description`, `thumnail`, `genre_id`, `movie_time`) VALUES
	(1, 'Venom: Let There Be Carnage', 'Eddie Brock tiếp tục cuộc chiến với kẻ thù của mình là Venom.', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e0/Venom_Let_There_Be_Carnage_poster.jpg/220px-Venom_Let_There_Be_Carnage_poster.jpg', 1, 120),
	(2, 'Spider-Man: No Way Home', 'Peter Parker cố gắng che giấu danh tính của mình, nhưng mọi chuyện trở nên tồi tệ khi kẻ thù của anh ta từ các vũ trụ khác bắt đầu xuất hiện.', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/34/Spider-Man_No_Way_Home_poster.jpg/220px-Spider-Man_No_Way_Home_poster.jpg', 1, 148),
	(3, 'Venom: Let There Be Carnage', 'Eddie Brock tiếp tục cuộc chiến với kẻ thù của mình là Venom.', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e0/Venom_Let_There_Be_Carnage_poster.jpg/220px-Venom_Let_There_Be_Carnage_poster.jpg', 1, 120),
	(4, 'Spider-Man: No Way Home', 'Peter Parker cố gắng che giấu danh tính của mình, nhưng mọi chuyện trở nên tồi tệ khi kẻ thù của anh ta từ các vũ trụ khác bắt đầu xuất hiện.', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/34/Spider-Man_No_Way_Home_poster.jpg/220px-Spider-Man_No_Way_Home_poster.jpg', 1, 148),
	(5, 'Venom: Let There Be Carnage', 'Eddie Brock tiếp tục cuộc chiến với kẻ thù của mình là Venom.', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e0/Venom_Let_There_Be_Carnage_poster.jpg/220px-Venom_Let_There_Be_Carnage_poster.jpg', 1, 120),
	(6, 'Spider-Man: No Way Home', 'Peter Parker cố gắng che giấu danh tính của mình, nhưng mọi chuyện trở nên tồi tệ khi kẻ thù của anh ta từ các vũ trụ khác bắt đầu xuất hiện.', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/34/Spider-Man_No_Way_Home_poster.jpg/220px-Spider-Man_No_Way_Home_poster.jpg', 1, 148);

-- Dumping structure for table tt_phim.seats
CREATE TABLE IF NOT EXISTS `seats` (
  `seatsID` int NOT NULL AUTO_INCREMENT,
  `seat_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seatsID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.seats: ~0 rows (approximately)
INSERT INTO `seats` (`seatsID`, `seat_name`) VALUES
	(1, 'Ghế A1'),
	(2, 'Ghế A2'),
	(3, 'Ghế A3'),
	(4, 'Ghế A1'),
	(5, 'Ghế A2'),
	(6, 'Ghế A3'),
	(7, 'Ghế A1'),
	(8, 'Ghế A2');

-- Dumping structure for table tt_phim.showtime
CREATE TABLE IF NOT EXISTS `showtime` (
  `showtimeID` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL DEFAULT '0',
  `cinema_id` int DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`showtimeID`),
  KEY `FK_movieID_showtime` (`movie_id`),
  KEY `FK_cinemaID_showtime` (`cinema_id`),
  CONSTRAINT `FK_cinemaID_showtime` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`cinameID`),
  CONSTRAINT `FK_movieID_showtime` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movieID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.showtime: ~0 rows (approximately)
INSERT INTO `showtime` (`showtimeID`, `movie_id`, `cinema_id`, `time`) VALUES
	(1, 1, 1, '10:00 AM'),
	(2, 1, 2, '12:00 PM'),
	(3, 2, 1, '2:00 PM');

-- Dumping structure for table tt_phim.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketID` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `show_time_id` int NOT NULL DEFAULT '0',
  `cinema_id` int DEFAULT NULL,
  `seat_id` int DEFAULT NULL,
  `active` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`ticketID`),
  KEY `FK_movieID` (`movie_id`),
  KEY `FK_showtimeID` (`show_time_id`),
  KEY `FK_cinemaID` (`cinema_id`),
  KEY `FK_seatID` (`seat_id`),
  CONSTRAINT `FK_cinemaID` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`cinameID`),
  CONSTRAINT `FK_movieID` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movieID`),
  CONSTRAINT `FK_seatID` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seatsID`),
  CONSTRAINT `FK_showtimeID` FOREIGN KEY (`show_time_id`) REFERENCES `showtime` (`showtimeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.ticket: ~0 rows (approximately)
INSERT INTO `ticket` (`ticketID`, `movie_id`, `price`, `show_time_id`, `cinema_id`, `seat_id`) VALUES
	(1, 1, 100, 1, 1, 1),
	(2, 1, 120, 2, 1, 2),
	(3, 2, 150, 3, 2, 3);

CREATE TABLE IF NOT EXISTS `booking` (
  `bookingID` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int DEFAULT NULL,
  `booking_time` datetime DEFAULT NULL,
  `ticket_quantity` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`bookingID`),
  KEY `FK_ticketID` (`ticket_id`),
  KEY `FK_userID` (`user_id`),
  CONSTRAINT `FK_ticketID` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticketID`),
  CONSTRAINT `FK_userID` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tt_phim.booking: ~3 rows (approximately)
INSERT INTO `booking` (`bookingID`, `ticket_id`, `booking_time`, `ticket_quantity`, `user_id`) VALUES
	(10, 1, '2024-01-18 10:00:00', 1, 1),
	(11, 2, '2024-01-18 12:00:00', 2, 2),
	(12, 3, '2024-01-18 14:00:00', 3, 3);


