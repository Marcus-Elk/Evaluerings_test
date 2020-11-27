DROP DATABASE IF EXISTS `grfl_mat`;
CREATE DATABASE `grfl_mat`;
USE `grfl_mat`;

CREATE TABLE `teams`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL    
);

CREATE TABLE `users`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `username` VARCHAR(8) UNIQUE NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `roles` TINYINT NOT NULL,
    `team_id` INT, 
    FOREIGN KEY (`team_id`) REFERENCES `teams`(`id`)
);

CREATE TABLE `tests`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
	`team_id` INT,
    FOREIGN KEY (`team_id`) REFERENCES `teams`(`id`)
);

CREATE TABLE `questions` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `text` TEXT(65535) NOT NULL,
    `test_id` INT NOT NULL,
    `index` INT NOT NULL,
    `correct_answer_index` INT NOT NULL,
    FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`),
    UNIQUE INDEX `unqidx` (`test_id`, `index`) # enforce only one question with a given index can be in a test
);

CREATE TABLE `answers`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `text` VARCHAR(255) NOT NULL,
    `question_id` INT NOT NULL,
    `index` INT NOT NULL,
	FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`),
	UNIQUE INDEX `unqidx` (`question_id`, `index`) # enforce only one answer per index per question 
);

CREATE TABLE `results`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `answer_index` INT,
    `user_id` INT NOT NULL,
	`question_id` INT NOT NULL,
	FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`),
	FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
	UNIQUE INDEX `unqidx` (`user_id`, `question_id`)
);

INSERT INTO `teams`(`name`) VALUES('L DDU TK 2');
INSERT INTO `teams`(`name`) VALUES('L DDU TK 1');
INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`) VALUES(
	'Valdemar',
    'Friis',
    'vald0172',
    '$2y$10$XlnmtUeiTLCCvxKx9UGJb.1eCnf5iBqRmDd4.UVhRCvxH6mtr.sD6',
    0b00000111,
    1
);

INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`) VALUES(
	'William',
    'Mistarz',
    'will1852',
    '$2y$10$XlnmtUeiTLCCvxKx9UGJb.1eCnf5iBqRmDd4.UVhRCvxH6mtr.sD6',
    0b00000111,
    1
);

INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`) VALUES(
	'Muhammad Muneeb',
    'Farooq',
    'muha6969',
    '$2y$10$XlnmtUeiTLCCvxKx9UGJb.1eCnf5iBqRmDd4.UVhRCvxH6mtr.sD6',
    0b00000111,
    1
);
INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`) VALUES(
	'Teacher',
    'Teacher',
    'teac0000',
    '$2y$10$XlnmtUeiTLCCvxKx9UGJb.1eCnf5iBqRmDd4.UVhRCvxH6mtr.sD6',
    0b00000010,
    1
);
INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`) VALUES(
	'Student',
    'Student',
    'stud0000',
    '$2y$10$XlnmtUeiTLCCvxKx9UGJb.1eCnf5iBqRmDd4.UVhRCvxH6mtr.sD6',
    0b00000001,
    1
);


INSERT INTO `tests`(`title`, `team_id`) VALUES
('Trigonometri', 1);

INSERT INTO `questions`(`title`, `text`, `test_id`, `index`, `correct_answer_index`) VALUES
('Tangens','Hvordan kan `tan(x)` også udtrykkes?', 1, 0, 1);

INSERT INTO `answers`(`text`, `index`, `question_id`) VALUES
('`1/sin(x)`', 0, 1),
('`sin(x)/cos(x)`', 1, 1),
('`cos(x/2)`', 2, 1);

INSERT INTO `questions`(`title`, `text`, `test_id`, `index`, `correct_answer_index`) VALUES
('Sinus', 'Hvilket af følgende udtryk er sandt?', 1, 1, 2);

INSERT INTO `answers`(`text`, `index`, `question_id`) VALUES
('`sin(x)=-sin(x)`', 0, 2),
('`2sin(x)=sin(2x)`', 1, 2),
('`sin(-x)=-sin(x)`', 2, 2);


