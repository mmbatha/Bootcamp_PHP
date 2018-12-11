CREATE TABLE `ft_table`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(11) NOT NULL DEFAULT 'toto',
    `group` ENUM('staff', 'student', 'other') NOT NULL,
    `creation_date` DATE NOT NULL
);