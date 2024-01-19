-- Active: 1705586532035@@127.0.0.1@3306
CREATE DATABASE ticket_cinema
    DEFAULT CHARACTER SET = 'utf8mb4';
  
USE ticket_cinema;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `phone` int NOT NULL DEFAULT '0',
  `pass_word` varchar(100) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `cinema` (
  `cinema_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cinema_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `thumnail` varchar(255) DEFAULT NULL,
  `genre_id` int DEFAULT NULL,
  `movie_time` int DEFAULT NULL,
  PRIMARY KEY (`movie_id`),
  KEY `FK_genreID` (`genre_id`),
  CONSTRAINT `FK_genreID` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `seats` (
  `seat_id` int NOT NULL AUTO_INCREMENT,
  `seat_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `showtime` (
  `showtime_id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL DEFAULT '0',
  `cinema_id` int DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`showtime_id`),
  KEY `FK_movieID_showtime` (`movie_id`),
  KEY `FK_cinemaID_showtime` (`cinema_id`),
  CONSTRAINT `FK_cinemaID_showtime` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`cinema_id`),
  CONSTRAINT `FK_movieID_showtime` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `showtime_id` int NOT NULL DEFAULT '0',
  `cinema_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `seat_id` int DEFAULT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `FK_movieID` (`movie_id`),
  KEY `FK_showtimeID` (`showtime_id`),
  KEY `FK_cinemaID` (`cinema_id`),
  KEY `FK_userID` (`user_id`),
  KEY `FK_seatID` (`seat_id`),
  CONSTRAINT `FK_cinemaID` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`cinema_id`),
  CONSTRAINT `FK_movieID` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  CONSTRAINT `FK_seatID` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`),
  CONSTRAINT `FK_showtimeID` FOREIGN KEY (`showtime_id`) REFERENCES `showtime` (`showtime_id`),
  CONSTRAINT `FK_userID` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int DEFAULT NULL,
  `booking_time` datetime DEFAULT NULL,
  `ticket_quantity` int DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `FK_ticketID` (`ticket_id`),
  CONSTRAINT `FK_ticketID` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO users (name, phone, pass_word, image_url, email)
VALUES
  ('Nguyễn Văn A', 0901234567, '123456', 'https://example.com/avatar.png', 'nguyenvana@example.com'),
  ('Trần Thị B', 0902345678, '123456', 'https://example.com/avatar2.png', 'tranthib@example.com');

INSERT INTO cinema (name, location)
VALUES
  ('CGV Nguyễn Du', 'Thành phố Hồ Chí Minh'),
  ('BHD Star Cineplex Hùng Vương Plaza', 'Thành phố Hồ Chí Minh');

INSERT INTO genre (name)
VALUES
  ('Hành động'),
  ('Hài hước'),
  ('Lãng mạn');

INSERT INTO movies (movie_title, description, thumnail, genre_id, movie_time)
VALUES
  ('Venom: Let There Be Carnage', 'Eddie Brock tiếp tục cuộc chiến với kẻ thù của mình là Venom.', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e0/Venom_Let_There_Be_Carnage_poster.jpg/220px-Venom_Let_There_Be_Carnage_poster.jpg', 1, 120),
  ('Spider-Man: No Way Home', 'Peter Parker cố gắng che giấu danh tính của mình, nhưng mọi chuyện trở nên tồi tệ khi kẻ thù của anh ta từ các vũ trụ khác bắt đầu xuất hiện.', 'https://upload.wikimedia.org/wikipedia/en/thumb/3/34/Spider-Man_No_Way_Home_poster.jpg/220px-Spider-Man_No_Way_Home_poster.jpg', 2, 148);

INSERT INTO seats (seat_name)
VALUES
  ('Ghế A1'),
  ('Ghế A2'),
  ('Ghế A3');

INSERT INTO showtime (movie_id, cinema_id, time)
VALUES
  (1, 1, '10:00 AM'),
  (1, 2, '12:00 PM'),
  (2, 1, '2:00 PM'),
  (2, 2, '4:00 PM');

INSERT INTO ticket (movie_id, price, showtime_id, cinema_id, user_id, seat_id)
VALUES
  (1, 100, 1, 1, 1, 1),
  (1, 120, 2, 1, 2, 2),
  (2, 150, 3, 2, 1, 3);

INSERT INTO booking (ticket_id, booking_time, ticket_quantity)
VALUES
  (1, '2024-01-18 10:00:00', 1),
  (2, '2024-01-18 12:00:00', 2),
  (3, '2024-01-18 14:00:00', 3);

-- get api hiển thị danh sách các phim đang chiếu.
SELECT showtime.showtime_id, movies.movie_title, cinema.name, showtime.time
FROM showtime, movies, cinema
WHERE showtime.cinema_id = cinema.cinema_id AND showtime.movie_id = movies.movie_id

