-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "Numbers" ----------------------------------
-- CREATE TABLE "Numbers" --------------------------------------
CREATE TABLE `Numbers` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`number` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	`contact_id` Int( 11 ) NOT NULL,
	`description` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 42;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "Numbers" ----------------------------------
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '1', '+38067579783', '1', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '2', '09599786656', '2', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '3', '09599786654', '2', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '4', '09599786656', '3', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '5', '09599786654', '3', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '6', '09599786659', '3', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '7', '0959386656', '4', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '8', '0959946654', '4', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '9', '0959788659', '4', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '10', '0669386656', '5', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '11', '0669946654', '5', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '12', '0669788659', '5', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '13', '0669386656', '6', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '14', '0669946654', '6', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '15', '0669788659', '6', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '16', '0669386656', '7', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '17', '0959968665', '8', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '18', '+380959978665', '8', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '19', '0959977659', '8', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '20', '0959968633', '9', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '21', '+380959978333', '9', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '22', '0959977633', '9', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '23', '0959968633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '24', '+380959978333', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '25', '0959977633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '26', '0759968633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '27', '+380759978333', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '28', '0989977633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '29', '0639968633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '30', '+380639978333', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '31', '0639977633', '10', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '32', '0959968633', '11', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '33', '+380959978333', '11', NULL );
INSERT INTO `Numbers`(`id`,`number`,`contact_id`,`description`) VALUES ( '34', '0666269761', '12', NULL );
-- ---------------------------------------------------------


-- CREATE INDEX "idx-numbers-contact_id" -------------------
-- CREATE INDEX "idx-numbers-contact_id" -----------------------
CREATE INDEX `idx-numbers-contact_id` USING BTREE ON `Numbers`( `contact_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


-- CREATE TABLE "Contacts" ---------------------------------
-- CREATE TABLE "Contacts" -------------------------------------
CREATE TABLE `Contacts` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`surname` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	`description` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `name` UNIQUE( `name` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 17;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "Contacts" ---------------------------------
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '1', 'Oleg', 'Timoshenko', 'Web developer' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '2', 'Vasia', 'Aleynikov', 'Retired' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '3', 'Ruslana', 'Komar', 'Big boss' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '4', 'Clava', 'Nenvenchenko', 'Constractor' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '5', 'Luba', 'Timoshenko', 'Wife' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '6', 'Petia', 'Poroshenko', 'Old president' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '7', 'Volodomir', 'Zelenscky', 'Current president' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '8', 'Dmitry', 'Dzuba', 'Friends' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '9', 'Lena', 'Smirnova', 'Wife of comrade' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '10', 'Sergei', 'Gema', 'My colleague' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '11', 'Una', 'Avose', 'Actor' );
INSERT INTO `Contacts`(`id`,`name`,`surname`,`description`) VALUES ( '12', 'Valentina', 'Timoshenko', 'Mom' );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


