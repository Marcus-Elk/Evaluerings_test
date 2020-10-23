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
    `role` INTEGER(32) NOT NULL,
    `team_id` INT, 
    FOREIGN KEY (`team_id`) REFERENCES `teams`(`id`)
);

INSERT INTO `teams`(`name`) VALUES('L DDU TK 2');
INSERT INTO `users`(
	`first_name`,
	`last_name`,
	`username`,
	`password_hash`,
	`role`,
	`team_id`
) VALUES(
	'Valdemar',
    'Friis',
    'vald0172',
    '0',
    0x00000001,
    1
);

SELECT * FROM `users` INNER JOIN `teams` ON `users`.`team_id` = `teams`.`id`;
