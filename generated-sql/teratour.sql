
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- images_table
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `images_table`;

CREATE TABLE `images_table`
(
    `image_id` INTEGER NOT NULL AUTO_INCREMENT,
    `markerId` INTEGER NOT NULL,
    `imageUrl` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`image_id`),
    INDEX `image_id` (`image_id`),
    INDEX `images_table_fi_910a41` (`markerId`),
    CONSTRAINT `images_table_fk_910a41`
        FOREIGN KEY (`markerId`)
        REFERENCES `marker_table` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- marker_table
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `marker_table`;

CREATE TABLE `marker_table`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `titles` VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `id` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
