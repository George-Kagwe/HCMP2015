CREATE TABLE `facility_activation_logs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` VARCHAR(45) NOT NULL,
    `facility_code` VARCHAR(45) NOT NULL,
    `action` VARCHAR(45) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)  ENGINE=INNODB DEFAULT CHARSET=LATIN1;
