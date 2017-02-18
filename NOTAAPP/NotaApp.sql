-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2017 a las 22:59:35
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `notaapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `desplazado` varchar(45) DEFAULT 'No',
  `repitente` varchar(45) DEFAULT 'No',
  `nombre_acudiente` varchar(45) DEFAULT NULL,
  `apellidos_acudiente` varchar(45) DEFAULT NULL,
  `telefono_acudiente` double DEFAULT NULL,
  `fecha_matricula` date DEFAULT NULL,
  `id_grupo` varchar(50) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `id_sede`, `nombres`, `primer_apellido`, `segundo_apellido`, `desplazado`, `repitente`, `nombre_acudiente`, `apellidos_acudiente`, `telefono_acudiente`, `fecha_matricula`, `id_grupo`, `id_estado`) VALUES
(8474, 'IE', 'Kaitlin', 'Acevedo', 'Duffy', 'Si', 'No', 'Tarik', 'Church', 2438101, '2017-01-31', '2017IE11-7', 1),
(16182, 'IE', 'Fatima', 'Marshall', 'Riley', 'Si', 'No', 'Jonah', 'Mooney', 7800922, '2017-09-21', '2017IE11-1', 1),
(50024, 'IE', 'Gannon', 'Turner', 'Schneider', 'Si', 'Si', 'Baxter', 'Brooks', 4024359, '2017-03-20', '2017IE11-10', 1),
(65650, 'IE', 'Jameson', 'Torres', 'Yang', 'No', 'No', 'Kaden', 'Holland', 5147557, '2016-12-07', '2017IE11-2', 1),
(84865, 'IE', 'Elton', 'Pace', 'Parsons', 'Si', 'No', 'Kuame', 'Guy', 4113348, '2018-02-07', '2017IE11-4', 1),
(86517, 'IE', 'Noel', 'Roberson', 'Gregory', 'No', 'Si', 'Aurelia', 'Houston', 4841810, '2018-01-21', '2017IE11-10', 1),
(96201, 'IE', 'Candace', 'Sexton', 'Gaines', 'No', 'Si', 'Eleanor', 'Ortega', 8502422, '2016-05-09', '2017IE11-8', 1),
(125331, 'IE', 'Helen', 'Price', 'Vaughn', 'Si', 'Si', 'Hanna', 'Mcneil', 5529091, '2018-01-30', '2017IE11-6', 1),
(126436, 'IE', 'Melvin', 'Graham', 'Wilkerson', 'No', 'Si', 'Brendan', 'Quinn', 8893603, '2017-04-02', '2017IE11-10', 1),
(135848, 'IE', 'Deanna', 'Tyler', 'Moore', 'No', 'Si', 'Alma', 'Clay', 1759655, '2016-03-27', '2017IE11-1', 1),
(142408, 'IE', 'Brenna', 'Donovan', 'Barrera', 'Si', 'Si', 'Kellie', 'Sharp', 5003410, '2017-07-25', '2017IE11-1', 1),
(143666, 'IE', 'India', 'Freeman', 'Alvarez', 'Si', 'Si', 'Micah', 'Stein', 9521446, '2017-01-21', '2017IE11-10', 1),
(143797, 'IE', 'Curran', 'Frazier', 'Wallace', 'No', 'No', 'Xerxes', 'Garrett', 9075803, '2016-03-09', '2017IE11-7', 1),
(147920, 'IE', 'Haley', 'Koch', 'Hoffman', 'No', 'Si', 'Stacy', 'Lott', 8937619, '2016-10-04', '2017IE11-10', 1),
(152683, 'IE', 'Jennifer', 'Freeman', 'Pearson', 'No', 'No', 'Geoffrey', 'George', 2311164, '2017-07-18', '2017IE11-7', 1),
(155532, 'IE', 'Gray', 'Hayes', 'Mcgee', 'No', 'No', 'Reuben', 'Ryan', 1614354, '2016-10-21', '2017IE11-10', 1),
(155705, 'IE', 'Sebastian', 'Lott', 'Albert', 'Si', 'Si', 'Jescie', 'Kerr', 2564799, '2017-09-30', '2017IE11-2', 1),
(156406, 'IE', 'Brent', 'Haney', 'Martin', 'Si', 'Si', 'Arden', 'Larson', 2939116, '2016-04-25', '2017IE11-10', 1),
(170453, 'IE', 'Elizabeth', 'Spencer', 'Gregory', 'No', 'Si', 'Erasmus', 'Fletcher', 4354250, '2017-08-30', '2017IE11-10', 1),
(176018, 'IE', 'Lamar', 'Stout', 'Calhoun', 'No', 'Si', 'Marsden', 'Knight', 5218665, '2017-03-29', '2017IE11-3', 1),
(178794, 'IE', 'Francesca', 'Terrell', 'Garza', 'Si', 'No', 'Jack', 'Contreras', 1656728, '2016-12-15', '2017IE11-7', 1),
(181727, 'IE', 'Regina', 'Galloway', 'Petersen', 'No', 'Si', 'Regan', 'Roth', 5918335, '2017-10-13', '2017IE11-8', 1),
(203137, 'IE', 'Candace', 'Talley', 'Copeland', 'Si', 'Si', 'Adrian', 'Ross', 253075, '2016-04-29', '2017IE11-10', 1),
(206261, 'IE', 'Leroy', 'Ward', 'Benson', 'Si', 'No', 'Iola', 'Kirkland', 4877098, '2017-05-22', '2017IE11-4', 1),
(221084, 'IE', 'Mufutau', 'Maldonado', 'Willis', 'Si', 'Si', '', 'Snyder', 5563853, '2016-09-17', '2017IE11-3', 1),
(233836, 'IE', 'Kylynn', 'Peters', 'Glover', 'Si', 'No', 'Imani', 'Warner', 1093911, '2016-04-14', '2017IE11-2', 1),
(234883, 'IE', 'Quintessa', 'Davenport', 'Pruitt', 'No', 'No', 'Kermit', 'Ferguson', 4922761, '2016-06-15', '2017IE11-3', 1),
(241461, 'IE', 'Ingrid', 'Whitehead', 'Huff', 'No', 'Si', 'Martina', 'Key', 2572119, '2016-02-29', '2017IE11-1', 1),
(252228, 'IE', 'Karly', 'Floyd', 'Reilly', 'Si', 'No', 'Arsenio', 'Anthony', 8846689, '2017-11-03', '2017IE11-9', 1),
(265807, 'IE', 'Imani', 'Ford', 'Cummings', 'Si', 'Si', 'Cullen', 'Price', 5955958, '2017-10-18', '2017IE11-9', 1),
(295254, 'IE', 'Neil', 'Mills', 'Richardson', 'Si', 'No', 'Dorian', 'Ellison', 9432415, '2018-02-02', '2017IE11-6', 1),
(306546, 'IE', 'Joelle', 'King', 'Gutierrez', 'Si', 'No', 'Cherokee', 'Noel', 8901655, '2017-10-10', '2017IE11-8', 1),
(324352, 'IE', 'Vera', 'Foreman', 'Guzman', 'Si', 'Si', 'Jonah', 'Guthrie', 9402857, '2017-03-04', '2017IE11-1', 1),
(332220, 'IE', 'Wallace', 'Roman', 'Dalton', 'No', 'No', 'Zorita', 'Fulton', 9652787, '2017-01-08', '2017IE11-2', 1),
(334605, 'IE', 'Vivien', 'James', 'Bullock', 'No', 'Si', 'Bertha', 'Cain', 1346335, '2017-02-17', '2017IE11-8', 1),
(336870, 'IE', 'Maya', 'Williams', 'Goodwin', 'Si', 'Si', 'Wanda', 'Cooper', 6054365, '2018-01-20', '2017IE11-2', 1),
(352147, 'IE', 'Bert', 'Donaldson', 'Zimmerman', 'No', 'No', 'Jessica', 'Petty', 9551185, '2016-06-14', '2017IE11-2', 1),
(360347, 'IE', 'Eden', 'Snider', 'Foley', 'No', 'No', 'Kennedy', 'Talley', 8233586, '2016-02-27', '2017IE11-3', 1),
(363999, 'IE', 'Kieran', 'Bender', 'Ryan', 'Si', 'Si', 'Karleigh', 'Griffin', 4840409, '2017-12-01', '2017IE11-2', 1),
(365810, 'IE', 'Rinah', 'Richards', 'Beard', 'No', 'No', 'Echo', 'Osborne', 2645642, '2016-10-20', '2017IE11-2', 1),
(376269, 'IE', 'Dustin', 'Oconnor', 'Burns', 'No', 'Si', 'Marny', 'Heath', 3965499, '2017-01-13', '2017IE11-9', 1),
(394321, 'IE', 'Selma', 'Bruce', 'Merritt', 'Si', 'No', 'Uma', 'Sandoval', 393919, '2017-07-13', '2017IE11-6', 1),
(404991, 'IE', 'Nissim', 'Massey', 'Brewer', 'No', 'Si', 'Robert', 'Chan', 8622670, '2016-03-25', '2017IE11-8', 1),
(416669, 'IE', 'Pascale', 'Green', 'Powers', 'No', 'No', 'Samson', 'Frost', 8557191, '2016-03-14', '2017IE11-4', 1),
(417423, 'IE', 'Lila', 'Roy', 'Velasquez', 'No', 'No', 'Honorato', 'Moses', 2957499, '2017-07-28', '2017IE11-2', 1),
(430756, 'IE', 'Nissim', 'Velasquez', 'Irwin', 'Si', 'Si', 'Phelan', 'Booker', 4160399, '2017-07-18', '2017IE11-6', 1),
(494995, 'IE', 'Aquila', 'Ramsey', 'Benjamin', 'Si', 'Si', 'Lionel', 'Sims', 8649693, '2017-07-21', '2017IE11-3', 1),
(496222, 'IE', 'Stone', 'Byrd', 'Shannon', 'No', 'Si', 'Teagan', 'Callahan', 8980848, '2017-09-03', '2017IE11-9', 1),
(498045, 'IE', 'Ross', 'Schmidt', 'Camacho', 'No', 'No', 'Adam', 'Singleton', 9737043, '2016-05-10', '2017IE11-1', 1),
(524603, 'IE', 'Cadman', 'Spencer', 'Wilson', 'No', 'Si', 'Cassidy', 'Pittman', 2233593, '2017-07-19', '2017IE11-1', 1),
(541702, 'IE', 'Deanna', 'Powell', 'Floyd', 'No', 'No', 'Rhea', 'Gibson', 4651653, '2016-07-11', '2017IE11-3', 1),
(572115, 'IE', 'Travis', 'Rivers', 'Compton', 'No', 'No', 'Wade', 'Pollard', 5452872, '2017-04-22', '2017IE11-3', 1),
(581879, 'IE', 'Dakota', 'Kelley', 'Foreman', 'Si', 'No', 'Claire', 'Underwood', 1700277, '2017-07-02', '2017IE11-5', 1),
(582639, 'IE', 'Allen', 'Smith', 'Franco', 'Si', 'No', 'Stephen', 'Warren', 9623868, '2016-11-07', '2017IE11-8', 1),
(591247, 'IE', 'Edan', 'Valencia', 'Whitley', 'Si', 'Si', 'Octavius', 'Chambers', 6318270, '2016-08-07', '2017IE11-2', 1),
(600513, 'IE', 'Otto', 'Curtis', 'Waters', 'No', 'Si', 'Shelby', 'Hubbard', 9572726, '2017-09-02', '2017IE11-2', 1),
(615398, 'IE', 'Liberty', 'Briggs', 'Sweeney', 'No', 'Si', 'Berk', 'Knowles', 4018772, '2016-11-08', '2017IE11-3', 1),
(615643, 'IE', 'Claire', 'Schroeder', 'Hatfield', 'Si', 'Si', 'Edan', 'Wilkinson', 8114871, '2017-11-09', '2017IE11-3', 1),
(685672, 'IE', 'Sigourney', 'Rowland', 'Calhoun', 'No', 'Si', 'Chelsea', 'Fitzpatrick', 2395102, '2017-06-26', '2017IE11-1', 1),
(687419, 'IE', 'Marshall', 'Jarvis', 'Waters', 'No', 'Si', 'Daryl', 'Howe', 5112350, '2017-12-20', '2017IE11-8', 1),
(702999, 'IE', 'Zelda', 'Vang', 'Adkins', 'No', 'Si', 'Maris', 'Gentry', 3473414, '2018-02-02', '2017IE11-8', 1),
(705894, 'IE', 'Frances', 'Adkins', 'Landry', 'No', 'No', 'Freya', 'Bryant', 4540380, '2017-03-20', '2017IE11-7', 1),
(707640, 'IE', 'Kuame', 'George', 'Weiss', 'Si', 'Si', 'Julian', 'Decker', 9029840, '2018-02-01', '2017IE11-9', 1),
(725997, 'IE', 'Caleb', 'Aguilar', 'Myers', 'No', 'No', 'Kareem', 'Benjamin', 5538498, '2018-01-20', '2017IE11-5', 1),
(735410, 'IE', 'Harriet', 'Wilcox', 'Mcpherson', 'Si', 'No', 'Lamar', 'Crawford', 1977965, '2016-06-04', '2017IE11-4', 1),
(750937, 'IE', 'Wang', 'Petersen', 'Knowles', 'Si', 'No', 'Juliet', 'Baird', 9171450, '2017-01-09', '2017IE11-9', 1),
(756908, 'IE', 'Stella', 'Wolf', 'Mccarthy', 'Si', 'Si', 'Angela', 'Nichols', 4665642, '2016-03-10', '2017IE11-4', 1),
(760432, 'IE', 'Sylvester', 'Holmes', 'Shepard', 'Si', 'No', 'Maile', 'Ware', 713534, '2016-09-30', '2017IE11-9', 1),
(773311, 'IE', 'Charity', 'Rosa', 'Trevino', 'No', 'Si', 'Isaiah', 'Powers', 9079621, '2017-09-17', '2017IE11-7', 1),
(782081, 'IE', 'Damian', 'Mueller', 'Whitney', 'Si', 'No', 'Daryl', 'Shaffer', 8473252, '2016-04-28', '2017IE11-5', 1),
(783462, 'IE', 'Irene', 'Williamson', 'Workman', 'No', 'Si', 'Harper', 'Vaughan', 8740376, '2017-05-04', '2017IE11-9', 1),
(785408, 'IE', 'Berk', 'Galloway', 'Gonzalez', 'Si', 'No', 'Basia', 'Glover', 3060113, '2016-12-05', '2017IE11-5', 1),
(815351, 'IE', 'Casey', 'Briggs', 'Benson', 'No', 'Si', 'Kamal', 'Pena', 8591766, '2017-09-26', '2017IE11-1', 1),
(817778, 'IE', 'Silas', 'Rios', 'Mayer', 'No', 'No', 'Jason', 'Santana', 263939, '2017-04-23', '2017IE11-9', 1),
(847280, 'IE', 'Samson', 'Lowe', 'Lee', 'Si', 'Si', 'Jenette', 'Mcfarland', 4261557, '2016-02-19', '2017IE11-3', 1),
(858290, 'IE', 'Leandra', 'Head', 'Park', 'Si', 'No', 'Odessa', 'Kerr', 2883949, '2016-04-16', '2017IE11-2', 1),
(861833, 'IE', 'Indira', 'Stevenson', 'Graham', 'Si', 'No', 'Hedda', 'Aguilar', 8712587, '2017-04-20', '2017IE11-9', 1),
(871439, 'IE', 'Malachi', 'Day', 'Stevenson', 'No', 'Si', 'Alexander', 'Velez', 1530389, '2017-01-11', '2017IE11-8', 1),
(872214, 'IE', 'Quon', 'Valenzuela', 'Ayala', 'Si', 'No', 'Venus', 'Swanson', 617338, '2017-11-23', '2017IE11-2', 1),
(880456, 'IE', 'Venus', 'Warner', 'Hudson', 'Si', 'Si', 'Clayton', 'Marshall', 5802107, '2017-01-15', '2017IE11-8', 1),
(926872, 'IE', 'Morgan', 'Browning', 'Sargent', 'Si', 'No', 'Ivana', 'Morrow', 750809, '2018-01-08', '2017IE11-4', 1),
(935219, 'IE', 'Fritz', 'Mendez', 'Roberts', 'Si', 'No', 'Joel', 'Vega', 3729380, '2017-02-14', '2017IE11-2', 1),
(952882, 'IE', 'Salvador', 'Kinney', 'Wall', 'Si', 'No', 'Briar', 'Burks', 3840378, '2018-01-29', '2017IE11-1', 1),
(959474, 'IE', 'Christian', 'Small', 'Cote', 'Si', 'Si', 'Thane', 'Tyler', 6419393, '2016-10-25', '2017IE11-8', 1),
(976357, 'IE', 'Jessamine', 'Woodard', 'Waters', 'No', 'Si', 'Sarah', 'Ross', 5710726, '2017-11-18', '2017IE11-3', 1),
(995403, 'IE', 'Illana', 'Maxwell', 'Sherman', 'No', 'No', 'Galvin', 'Poole', 3956567, '2017-11-10', '2017IE11-3', 1),
(999254, 'IE', 'Odette', 'Hamilton', 'Tucker', 'No', 'Si', 'Scarlett', 'Michael', 6655480, '2016-05-05', '2017IE11-6', 1),
(1046553, 'IE', 'Wylie', 'Boyer', 'Clay', 'Si', 'Si', 'Vaughan', 'Ramsey', 4445525, '2017-10-25', '2017IE11-9', 1),
(1063460, 'IE', 'Jin', 'Foreman', 'Ewing', 'Si', 'Si', 'John', 'Hunter', 4655469, '2016-11-03', '2017IE11-4', 1),
(1075070, 'IE', 'Ruth', 'Newton', 'Murphy', 'No', 'Si', 'Fredericka', 'Petty', 199339, '2017-07-13', '2017IE11-6', 1),
(1088143, 'IE', 'Madaline', 'Cherry', 'Russell', 'No', 'Si', 'Kadeem', 'Dalton', 2474792, '2017-04-07', '2017IE11-1', 1),
(1108949, 'IE', 'Renee', 'Barr', 'Graham', 'No', 'Si', 'Ainsley', 'Espinoza', 2618928, '2016-09-06', '2017IE11-1', 1),
(1122256, 'IE', 'Paki', 'Lindsey', 'Ford', 'No', 'No', 'Wendy', 'Mason', 4906571, '2017-06-07', '2017IE11-8', 1),
(1134408, 'IE', 'Imelda', 'Calderon', 'Parsons', 'Si', 'No', 'Ulla', 'Blevins', 9849246, '2018-01-15', '2017IE11-2', 1),
(1134526, 'IE', 'Levi', 'Wells', 'Leach', 'No', 'Si', 'Willow', 'Moore', 3074131, '2016-10-04', '2017IE11-9', 1),
(1143134, 'IE', 'Emma', 'Glover', 'Mcdonald', 'No', 'No', 'Desirae', 'Perkins', 6036597, '2017-08-10', '2017IE11-4', 1),
(1177125, 'IE', 'Cassidy', 'Gregory', 'Skinner', 'No', 'No', 'Gemma', 'Miles', 4643678, '2017-08-13', '2017IE11-3', 1),
(1187788, 'IE', 'Aaron', 'Atkins', 'Mullen', 'Si', 'Si', 'Robin', 'Christian', 9752363, '2017-10-02', '2017IE11-9', 1),
(1208619, 'IE', 'Connor', 'Bruce', 'Abbott', 'No', 'Si', 'Haviva', 'Raymond', 6887502, '2017-11-04', '2017IE11-8', 1),
(1226263, 'IE', 'Kibo', 'Aguirre', 'Scott', 'No', 'Si', 'Genevieve', 'Foley', 7610850, '2016-04-26', '2017IE11-8', 1),
(710557216, 'IE', 'Stella', 'Hines', 'Hunt', 'No', 'No', 'Walker', 'Grant', 1670101740899, '2017-09-05', '2017IE11-1', 1),
(711170902, 'IE', 'Benjamin', 'Slater', 'Waters', 'Si', 'Si', 'Cameron', 'Kelly', 1655082864299, '2017-12-05', '2017IE11-1', 1),
(722888849, 'IE', 'Audrey', 'Martin', 'Hyde', 'Si', 'Si', 'Wanda', 'Snow', 1608112397099, '2016-10-28', '2017IE11-1', 1),
(732196662, 'IE', 'Todd', 'Beasley', 'Herman', 'No', 'Si', 'Tanisha', 'Cobb', 1699010391199, '2016-02-16', '2017IE11-1', 1),
(735150781, 'IE', 'Veda', 'Mccormick', 'Harmon', 'Si', 'No', 'Keefe', 'Miles', 1692052132499, '2016-06-20', '2017IE11-1', 1),
(766947774, 'IE', 'Vincent', 'Mcneil', 'Santiago', 'Si', 'No', 'Reagan', 'Ayers', 1696081433199, '2016-04-07', '2017IE11-1', 1),
(774031256, 'IE', 'Olga', 'Mosley', 'Ingram', 'No', 'No', 'Tyler', 'Bates', 1632091194599, '2017-06-12', '2017IE11-1', 1),
(797431442, 'IE', 'Mona', 'Hobbs', 'Mcmillan', 'Si', 'No', 'Russell', 'Padilla', 1665071998499, '2017-10-19', '2017IE11-1', 1),
(800583064, 'IE', 'Amery', 'Haney', 'Mcconnell', 'Si', 'Si', 'Sophia', 'Bean', 1601042410699, '2017-10-01', '2017IE11-1', 1),
(806254082, 'IE', 'Xander', 'Martinez', 'Pollard', 'Si', 'No', 'Trevor', 'Henry', 1671060372599, '2016-03-22', '2017IE11-1', 1),
(828448092, 'IE', 'Nissim', 'Reese', 'Conrad', 'Si', 'No', 'Chase', 'Stevenson', 1674111648899, '2016-08-30', '2017IE11-1', 1),
(831531603, 'IE', 'Nayda', 'Oneal', 'Castaneda', 'Si', 'No', 'Dylan', 'Tate', 1669022261999, '2017-12-29', '2017IE11-1', 1),
(837537752, 'IE', 'Quentin', 'Dudley', 'Santana', 'No', 'Si', 'Knox', 'Rush', 1648120727599, '2016-08-26', '2017IE11-1', 1),
(843916289, 'IE', 'Eve', 'Mcconnell', 'Banks', 'Si', 'Si', 'Hoyt', 'Mcleod', 1619032847499, '2017-05-11', '2017IE11-1', 1),
(847945573, 'IE', 'Keiko', 'Mitchell', 'Nicholson', 'Si', 'No', 'Wyatt', 'Hicks', 1642091041399, '2016-12-22', '2017IE11-1', 1),
(868008400, 'IE', 'Jared', 'Henderson', 'Sweet', 'No', 'Si', 'August', 'Brooks', 1698120232199, '2017-08-29', '2017IE11-1', 1),
(871541819, 'IE', 'Ima', 'Boyer', 'Meadows', 'Si', 'No', 'Reece', 'Mccormick', 1651030912299, '2017-08-29', '2017IE11-1', 1),
(887120004, 'IE', 'Tamara', 'Zimmerman', 'Mckinney', 'No', 'Si', 'Piper', 'Stephens', 1619032452299, '2016-06-13', '2017IE11-1', 1),
(890536477, 'IE', 'Murphy', 'Black', 'Clements', 'No', 'No', 'Cleo', 'Aguilar', 1698072828499, '2018-01-07', '2017IE11-1', 1),
(902588383, 'IE', 'Caleb', 'Boyle', 'Mclean', 'No', 'Si', 'Paloma', 'Deleon', 1634080201299, '2016-12-22', '2017IE11-1', 1),
(906328893, 'IE', 'Hector', 'Horton', 'Schmidt', 'No', 'Si', 'Rhonda', 'Mays', 1654050164099, '2017-12-05', '2017IE11-1', 1),
(908843519, 'IE', 'Keane', 'Joyce', 'Beard', 'No', 'No', 'Elizabeth', 'Andrews', 1601032867599, '2016-12-05', '2017IE11-1', 1),
(910021211, 'IE', 'Mona', 'Park', 'Odonnell', 'Si', 'No', 'Oleg', 'Norton', 1605022537899, '2016-03-27', '2017IE11-1', 1),
(949099287, 'IE', 'Stacey', 'Atkins', 'Hurst', 'Si', 'Si', 'Rachel', 'Farley', 1628091728799, '2017-07-11', '2017IE11-1', 1),
(950559674, 'IE', 'Odette', 'Dickerson', 'Whitfield', 'No', 'No', 'Benedict', 'Bailey', 1622020507799, '2016-12-11', '2017IE11-1', 1),
(968034504, 'IE', 'Blair', 'Estes', 'Matthews', 'Si', 'No', 'Porter', 'Gill', 1645050536999, '2017-09-29', '2017IE11-1', 1),
(971798723, 'IE', 'Ryan', 'Atkinson', 'Harding', 'No', 'Si', 'Quamar', 'Mckee', 1684040326999, '2018-01-04', '2017IE11-1', 1),
(988600045, 'IE', 'Larissa', 'Nelson', 'Sweeney', 'No', 'No', 'Dane', 'Ratliff', 1668021567299, '2016-05-27', '2017IE11-1', 1),
(989080783, 'IE', 'Wallace', 'Winters', 'Stafford', 'Si', 'Si', 'Reese', 'Kinney', 1646071479499, '2016-09-08', '2017IE11-1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos-logros`
--

CREATE TABLE `alumnos-logros` (
  `id_asignatura` varchar(50) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_logros` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio_lectivo`
--

CREATE TABLE `anio_lectivo` (
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `descripcion_anio_lectivo` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anio_lectivo`
--

INSERT INTO `anio_lectivo` (`id_anio_lectivo`, `id_sede`, `descripcion_anio_lectivo`, `fecha_inicio`, `fecha_fin`) VALUES
('2017IE', 'IE', 'AÃ±o Lectivo 2017', '2017-01-09', '2017-12-15'),
('2017JJR', 'JJR', 'AÃ±o lectivo 2017', '2017-01-09', '2017-12-08'),
('2017MS', 'MS', 'aÃ±o lectivo 2017', '2017-01-09', '2017-07-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` varchar(50) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `id_grado` varchar(50) DEFAULT NULL,
  `nombre_area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `id_sede`, `id_grado`, `nombre_area`) VALUES
('2017IEA11', 'IE', '2017IE11', 'Area1'),
('2017IEMyG11', 'IE', '2017IE11', 'MatemÃ¡ticas y GeometrÃ­a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` varchar(50) NOT NULL,
  `id_area` varchar(50) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_grupo` varchar(50) DEFAULT NULL,
  `nombre_asignatura` varchar(45) DEFAULT NULL,
  `intensidad_horaria` int(11) DEFAULT '0',
  `porcentaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `id_area`, `id_docente`, `id_grupo`, `nombre_asignatura`, `intensidad_horaria`, `porcentaje`) VALUES
('2017IEA11-A1', '2017IEA11', 123456, '2017IE11-1', 'Asignatura1', 6, 50),
('2017IEA11-A2', '2017IEA11', 1112766472, '2017IE11-2', 'Asignatura2', 5, 50),
('2017IEA11-A3', '2017IEA11', 1089746018, '2017IE11-3', 'Asignatura3', 8, 50),
('2017IEA11-A4', '2017IEA11', 24485219, '2017IE11-4', 'Asignatura4', 2, 50),
('2017IEA11-A5', '2017IEA11', 10196652, '2017IE11-5', 'Asignatura5', 2, 50),
('2017IEA11-A6', '2017IEA11', 82361187, '2017IE11-6', 'Asignatura6', 7, 50),
('2017IEA11-A7', '2017IEA11', 10020406, '2017IE11-7', 'Asignatura7', 2, 50),
('2017IEA11-A8', '2017IEA11', 4578149, '2017IE11-8', 'Asignatura8', 3, 50),
('2017IEA11-A99', '2017IEA11', 24790727, '2017IE11-9', 'Asignatura 9', 7, 50),
('2017IEMyG11-M1', '2017IEMyG11', 24764236, '2017IE11-1', 'MatemÃ¡ticas', 5, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_alumno` int(11) NOT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `inasistencia_p1` int(11) DEFAULT '0',
  `inasistencia_p2` int(11) DEFAULT '0',
  `inasistencia_p3` int(11) DEFAULT '0',
  `inasistencia_p4` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_alumno`, `id_anio_lectivo`, `id_asignatura`, `inasistencia_p1`, `inasistencia_p2`, `inasistencia_p3`, `inasistencia_p4`) VALUES
(8474, '2017IE', '2017IEMyG11-M1', 7, 0, 0, 0),
(949099287, '2017IE', '2017IEMyG11-M1', 8, 0, 0, 0),
(971798723, '2017IE', '2017IEMyG11-M1', 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancelado`
--

CREATE TABLE `cancelado` (
  `id_alumno` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_matricula` date DEFAULT NULL,
  `fecha_cancelacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `prim_apellido` varchar(45) DEFAULT NULL,
  `seg_apellido` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `id_tipo_usuario`, `nombres`, `prim_apellido`, `seg_apellido`, `email`, `pass`, `id_sede`, `estado`) VALUES
(123456, 3, 'Pablo', 'Picasso', 'Perez', 'picasso@mail.com', '$2y$10$BHUe0qi.DV7.7Za1hT69iuNZPRV1CCniNdmHN74Ef8JuUyUpcfp8C', 'IE', NULL),
(654321, 2, 'Administrador', 'Admin', 'Admin2', 'admin@admin.com', '$2y$10$sSYgkIxAGpIiE.PfYRb1EuVFgJCr/envp28P4iDmwB2N4/2Rp7uOW', 'IE', NULL),
(4452002, 3, 'jesus', 'castaÃ±eda', 'grisales', 'juanmanueltorogil@gmai.com', '$2y$10$uI59o68LJsPDhdTuUvvwj./B5/4toCpxfQ/C352YHVC6LjZc/933K', 'IE', NULL),
(4578149, 3, 'danilo', 'pelaez', 'lopez', 'danipel20@hotmail.com', '$2y$10$ihl6.mgv.aJvIB9pWSVmi.FJm0se73xjjN7DNCn.LqG/6RooGqL3G', 'IE', NULL),
(9725035, 3, 'juan manuel', 'toro', 'gil', 'juanmanueltorogil@gmail.com', '$2y$10$0.Ks4GjzH.Xs5SygAZU7nuVZVgJEaY/8Rn891GsR2mINMdn67CCZa', 'IE', NULL),
(10010339, 3, 'NicolÃ¡s AndrÃ©s', 'MejÃ­a', 'DomÃ­nguez', 'nicolasandmejia@gmail.com', '$2y$10$PcwMWqZNf/vMHPx0gGMA7e6O0KoSKin.81NcDIXtLfqPRmMKpC49u', 'IE', NULL),
(10020406, 3, 'Oscar Alonso', 'Marin ', 'Hernandez', 'osmarinh@hotmail.com', '$2y$10$F/E9zYqVXVTIGHlh55FYOejkZEjRQOa4FD1A5bpBMxyIKGtdVk3OO', 'IE', NULL),
(10144321, 3, 'AlexÃ¡nder', 'Ballesteros', 'Pineda', 'abp@utp.edu.co', '$2y$10$8yo.VAv/3Lf8lzcCcI2F1u9Dv7NDFjQDMz6hqCF2Hh8VEt/NUHmZK', 'IE', NULL),
(10196652, 3, 'chenier', 'osorio ', 'mesa', 'chenierosorio19@gmail.com', '$2y$10$YZwrvG6u1RjW4aQj640hqelxIpFzQeUY4JLtVbzQKqkJaFRAvj9j2', 'IE', NULL),
(16076234, 3, 'alejandro', 'vilamil', 'jimenez', 'jerjes199@hotmail.com', '$2y$10$FCIUsRRUREAZEZ2D/GAc9euiUrk7NG0Q0P2VcnHjjhaGEC1JGOqv.', 'IE', NULL),
(18561224, 3, 'daladier', 'marin', 'hoyos', 'daladiermh@gmail.com', '$2y$10$fsRs2StH5JMsvvKe3wY7BeGOnoCmHZxjrKE5NmTopbRYCymBckZcK', 'IE', NULL),
(24347368, 3, 'FRANCIA HELENA', 'HERRERA', 'MORALES', 'fraher2008@hotmail.com', '$2y$10$ULo2XrLea5OwO4PoA5CpUe6mx.jnYrE8OVhdB6wp4RIkYQrtzoBW6', 'IE', NULL),
(24485219, 3, 'Elizabeth', 'Rios', 'Ramirez', 'elizbethrios01@gmail.com', '$2y$10$wliBucIK4Jsu3VIq4z9RguS9ebuamStabjCwDdibLOxtiNPHKZaLa', 'IE', NULL),
(24764236, 3, 'BEATRIZ AMPARO', 'GÃ“MEZ ', 'GAMBA', 'bettyamgo@hotmail.com', '$2y$10$ME0QzUoO/RQHcp3LJvH0ZuzyJ3w6dn4tNObsnAX4BohzaB5BtlwGu', 'IE', NULL),
(24764523, 3, 'ISABEL CRISTINA', 'OSORIO', 'GRISALES', 'isog.22@hotmail.com', '$2y$10$Z4.gwE233mmYZhHQOlPjuet/uiJrEAZWQm8OO6D/So6x0p77lmrg2', 'IE', NULL),
(24765861, 3, 'Gloria Beatriz', 'Marulanda', 'RamÃ­rez', 'beta1305@hotmail.com', '$2y$10$PGgThUf4m6aSgbDfeEvstu1dT8T0AmpyltuUgCxCfD.LqFxvOzpZm', 'IE', NULL),
(24766676, 3, 'Paula Andrea', 'Piedrahita', 'Ceballos', 'papice03@gmail.com', '$2y$10$cY2Wq/WSO3As91WOhWawiOI2mR0idzGYszH5MGY9.uRWVoPhL5yX2', 'IE', NULL),
(24790727, 3, 'Ruth Liliana', 'Rojas', 'Rivera', 'ruthlirojas@hotmail.com', '$2y$10$.HMCA5.rLZr248Qwafam5.lR.PZjpM.nRMes4vI/qhXLuDe9ayMeu', 'IE', NULL),
(42050296, 3, 'luz elena carrillo', 'carrillo', 'moreno', 'elenac25@gmail.com', '$2y$10$Aedm.R7XO/NEl8pqRsatT.Xm5646khKCF1CvLU1oaZ7Pb3xTkVdxu', 'IE', NULL),
(42055045, 3, 'Luz Dory', 'HernÃ¡ndez ', 'Huertas', 'ldoris4@gmail.com', '$2y$10$.M6Ls0HskdvoVd/eTASRUO.qW7W7r.hCHsHOTXEpJ089PNUJkuOXu', 'IE', NULL),
(75090874, 3, 'Ricardo Alonso', 'Hurtado', 'Mosquera', 'ralhum@gmail.com', '$2y$10$iGwvlmdTfI6wemeuloHbseE2WDg9149k2ICMUvNuc8QzAwa1Vb/YO', 'IE', NULL),
(82361187, 3, 'Esildo', 'Perea', 'Murillo', 'espemu3@hotmail.com', '$2y$10$ar07YBInUzCLNpcq.qmq1e/IaVLrpTmZPq2nS.ol21iZta9VLgsc2', 'IE', NULL),
(89000126, 3, 'Gustavo', 'CastaÃ±o', 'Gil', 'gustavocgil@gmail.com', '$2y$10$ly7mC22T97C56s/7K9qAEu8mM.tH1rw8T8D.h2gCqnM93ZK3XN45K', 'IE', NULL),
(1088279639, 3, 'Edwar Steven', 'Marin ', 'Bermudez', 'esmarin@utp.edu.co', '$2y$10$1Vp/J8NqeEuURuYsvn3BzOX2gLDsdTeNF4xAMc..ciUmrb1oAOwpC', 'IE', NULL),
(1089746018, 3, 'Johana', 'Palacios', 'Toro', 'johapalaciostoro@gmail.com', '$2y$10$W0MW8lJ9KBffAEicB1IH5.aIQ8CU8FIkEBG8iCiXZZpN9Tahkb/2e', 'IE', NULL),
(1112766472, 3, 'Test', 'Testap', 'Test2ap', 'mail@mail.com', '$2y$10$eJrWBjZ7.o4l8OXqb7oN8.b/3gJUCMGhsLlQyx8i7Gx/NtZN2sKzi', 'IE', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_alumno`
--

CREATE TABLE `estado_alumno` (
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_alumno`
--

INSERT INTO `estado_alumno` (`id_estado`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Desertor'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` varchar(50) NOT NULL,
  `id_sede` varchar(50) DEFAULT NULL,
  `descripcion_grado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `id_sede`, `descripcion_grado`) VALUES
('2017IE11', 'IE', '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` varchar(50) NOT NULL,
  `id_grado` varchar(50) DEFAULT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `descripcion_grupo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `id_grado`, `id_anio_lectivo`, `id_docente`, `descripcion_grupo`) VALUES
('2017IE11-1', '2017IE11', '2017IE', 123456, '1'),
('2017IE11-10', '2017IE11', '2017IE', 123456, '10'),
('2017IE11-11', '2017IE11', '2017IE', 123456, '11'),
('2017IE11-12', '2017IE11', '2017IE', 123456, '12'),
('2017IE11-13', '2017IE11', '2017IE', 123456, '13'),
('2017IE11-14', '2017IE11', '2017IE', 123456, '14'),
('2017IE11-15', '2017IE11', '2017IE', 123456, '15'),
('2017IE11-2', '2017IE11', '2017IE', 123456, '2'),
('2017IE11-3', '2017IE11', '2017IE', 123456, '3'),
('2017IE11-4', '2017IE11', '2017IE', 123456, '4'),
('2017IE11-5', '2017IE11', '2017IE', 1089746018, '5'),
('2017IE11-6', '2017IE11', '2017IE', 123456, '6'),
('2017IE11-7', '2017IE11', '2017IE', 123456, '7'),
('2017IE11-8', '2017IE11', '2017IE', 123456, '8'),
('2017IE11-9', '2017IE11', '2017IE', 123456, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_logro` varchar(45) NOT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `logros`
--

INSERT INTO `logros` (`id_logro`, `id_asignatura`, `descripcion`) VALUES
('2017IEA11-A1L-1', '2017IEA11-A1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent blandit sem sapien. Etiam fermentum purus vel leo luctus vestibulum. Etiam efficitur'),
('2017IEA11-A3L-1', '2017IEA11-A3', 'logro1'),
('2017IEA11-A4L-1', '2017IEA11-A4', 'Diferncio entre celulas eucarioticas y procarioticas. '),
('2017IEA11-A4L-2', '2017IEA11-A4', 'Diferncio entre celulas eucarioticas y procarioticas. '),
('2017IEA11-A7L-1', '2017IEA11-A7', 'ojjih'),
('2017IEIEMyG-ML-1', '2017IEIEMyG-M', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor odio tortor, vitae euismod metus sodales non. Sed rhoncus dolor a dictum im'),
('2017IEIEMyG-ML-2', '2017IEIEMyG-M', 'Ut at orci purus. Etiam luctus urna a pretium tincidunt. Morbi ornare magna ac felis fringilla, ac laoreet neque posuere. Aliquam auctor aliquam aliqu'),
('2017IEIEMyG-ML-3', '2017IEIEMyG-M', 'Donec a tincidunt sem. Donec tristique vel augue sed pretium. Integer commodo tortor diam, vel dictum erat egestas et. Vivamus a accumsan odio. Nulla '),
('2017IEIEMyG-ML-4', '2017IEIEMyG-M', 'Donec a tincidunt sem. Donec tristique vel augue sed pretium. Integer commodo tortor diam, vel dictum erat egestas et. Vivamus a accumsan odio. Nulla '),
('2017IEMyG11-M1L-1', '2017IEMyG11-M1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sodales nisi lacus, eu cursus nisl ultricies et. Lorem ipsum dolor sit amet, consecte'),
('2017IEMyG11-M1L-2', '2017IEMyG11-M1', 'Integer at tincidunt nibh. Phasellus venenatis nisl at nulla euismod sagittis. Ut consequat sem nisl, et congue lectus elementum at. Aenean in ipsum n'),
('2017IEMyG11-M1L-3', '2017IEMyG11-M1', 'logro'),
('2017IEMyG11-M1L-4', '2017IEMyG11-M1', 'ccccccccccc\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_alumno` int(11) NOT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `nota1` decimal(4,1) DEFAULT '0.0',
  `nota2` decimal(4,1) DEFAULT '0.0',
  `nota3` decimal(4,1) DEFAULT '0.0',
  `nota4` decimal(4,1) DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_alumno`, `id_anio_lectivo`, `id_asignatura`, `nota1`, `nota2`, `nota3`, `nota4`) VALUES
(8474, '2017IE', '2017IEMyG11-M1', '4.0', '0.0', '0.0', '0.0'),
(252228, '2017IE', '2017IEA11-A99', '5.0', '0.0', '0.0', '0.0'),
(265807, '2017IE', '2017IEA11-A99', '5.0', '0.0', '0.0', '0.0'),
(394321, '2017IE', '2017IEA11-A6', '3.0', '0.0', '0.0', '0.0'),
(496222, '2017IE', '2017IEA11-A99', '3.0', '0.0', '0.0', '0.0'),
(725997, '2017IE', '2017IEA11-A5', '1.0', '0.0', '0.0', '0.0'),
(756908, '2017IE', '2017IEA11-A4', '4.0', '0.0', '0.0', '0.0'),
(785408, '2017IE', '2017IEA11-A5', '3.0', '0.0', '0.0', '0.0'),
(871439, '2017IE', '2017IEA11-A8', '3.5', '0.0', '0.0', '0.0'),
(999254, '2017IE', '2017IEA11-A6', '4.0', '0.0', '0.0', '0.0'),
(1046553, '2017IE', '2017IEA11-A99', '3.0', '0.0', '0.0', '0.0'),
(1187788, '2017IE', '2017IEA11-A99', '4.0', '0.0', '0.0', '0.0'),
(1208619, '2017IE', '2017IEA11-A8', '5.0', '0.0', '0.0', '0.0'),
(1226263, '2017IE', '2017IEA11-A8', '4.0', '0.0', '0.0', '0.0'),
(949099287, '2017IE', '2017IEMyG11-M1', '5.0', '0.0', '0.0', '0.0'),
(971798723, '2017IE', '2017IEMyG11-M1', '3.0', '5.0', '0.0', '0.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_definitiva`
--

CREATE TABLE `nota_definitiva` (
  `id_alumno` int(11) NOT NULL,
  `id_area` varchar(50) DEFAULT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `nota_definitiva` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` varchar(50) NOT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `desc_periodo` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `id_anio_lectivo`, `desc_periodo`, `fecha_inicio`, `fecha_fin`) VALUES
('2017IEP1', '2017IE', 'Primer Periodo AÃ±o 2017IE', '2017-01-09', '2017-03-16'),
('2017IEP2', '2017IE', 'Segundo Periodo AÃ±o 2017IE', '2017-03-17', '2017-06-15'),
('2017IEP3', '2017IE', 'Tercer Periodo AÃ±o 2017IE', '2017-06-16', '2017-09-16'),
('2017IEP4', '2017IE', 'Cuarto Periodo AÃ±o 2017IE', '2017-09-16', '2017-12-16'),
('2017JJRP1', '2017JJR', 'Primer Periodo AÃ±o 2017JJR', '2017-01-09', '2017-03-18'),
('2017JJRP2', '2017JJR', 'Segundo Periodo AÃ±o 2017JJR', '2017-03-19', '2017-07-17'),
('2017JJRP3', '2017JJR', 'Tercer Periodo AÃ±o 2017JJR', '2017-06-18', '2017-09-18'),
('2017JJRP4', '2017JJR', 'Cuarto Periodo AÃ±o 2017JJR', '2017-09-18', '2017-12-18'),
('2017MSP1', '2017MS', 'Primer Periodo AÃ±o 2017MS', '2017-01-19', '2017-01-31'),
('2017MSP2', '2017MS', 'Segundo Periodo AÃ±o 2017MS', '2017-01-19', '2017-06-12'),
('2017MSP3', '2017MS', 'Tercer Periodo AÃ±o 2017MS', '2017-01-19', '2017-01-31'),
('2017MSP4', '2017MS', 'Cuarto Periodo AÃ±o 2017MS', '2017-01-19', '2017-01-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE `recuperacion` (
  `id_recuperacion` varchar(50) NOT NULL,
  `id_asignatura` varchar(50) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_anio_lectivo` varchar(50) DEFAULT NULL,
  `nota` decimal(20,0) DEFAULT NULL,
  `acta` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` varchar(50) NOT NULL,
  `descripcion_sede` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `descripcion_sede`) VALUES
('IE', 'Instituto Estrada'),
('JJR', 'Juan Jose Rondon'),
('MS', 'Mariscal Sucre'),
('PPSA', 'Post Primaria San Andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `des_tipo_usuario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `des_tipo_usuario`) VALUES
(1, 'Root'),
(2, 'Administrador'),
(3, 'Docente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_grupo_alumno_idx` (`id_grupo`),
  ADD KEY `id_sede_alumno_idx` (`id_sede`),
  ADD KEY `id_estado_alumno_idx` (`id_estado`);

--
-- Indices de la tabla `alumnos-logros`
--
ALTER TABLE `alumnos-logros`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_alumno_log-al_idx` (`id_alumno`);

--
-- Indices de la tabla `anio_lectivo`
--
ALTER TABLE `anio_lectivo`
  ADD UNIQUE KEY `id_Anio_Lectivo_UNIQUE` (`id_anio_lectivo`),
  ADD KEY `id_sede_aniolectivo_idx` (`id_sede`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`),
  ADD UNIQUE KEY `id_area_UNIQUE` (`id_area`),
  ADD KEY `id_sede_area_idx` (`id_sede`),
  ADD KEY `id_grado_area_idx` (`id_grado`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_docente_asig_idx` (`id_docente`),
  ADD KEY `id_area_asig_idx` (`id_area`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_asignatura_asistencia_idx` (`id_asignatura`),
  ADD KEY `id_anio_lectivo_asis_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `cancelado`
--
ALTER TABLE `cancelado`
  ADD KEY `id_alumno_cancelado_idx` (`id_alumno`),
  ADD KEY `id_estado_cancelado_idx` (`id_estado`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_tipo_usuario_idx` (`id_tipo_usuario`),
  ADD KEY `id_sede_docente_idx` (`id_sede`);

--
-- Indices de la tabla `estado_alumno`
--
ALTER TABLE `estado_alumno`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`),
  ADD KEY `id_sede_grado_idx` (`id_sede`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_grado_grupo_idx` (`id_grado`),
  ADD KEY `id_docente_grupo_idx` (`id_docente`),
  ADD KEY `id_anio_lectivo_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`id_logro`),
  ADD KEY `id_asignatura_logros_idx` (`id_asignatura`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_anio_lectivo_nota_idx` (`id_anio_lectivo`),
  ADD KEY `id_asignatura_nota_idx` (`id_asignatura`);

--
-- Indices de la tabla `nota_definitiva`
--
ALTER TABLE `nota_definitiva`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_area_notadef_idx` (`id_area`),
  ADD KEY `id_anio_lectivo_notadef_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `id_anio_lectivo_periodo_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD PRIMARY KEY (`id_recuperacion`),
  ADD KEY `id_alumno_recu_idx` (`id_alumno`),
  ADD KEY `id_anio_lectivo_recu_idx` (`id_anio_lectivo`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `id_estado_alumno` FOREIGN KEY (`id_estado`) REFERENCES `estado_alumno` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_grupo_alumno` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sede_alumno` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumnos-logros`
--
ALTER TABLE `alumnos-logros`
  ADD CONSTRAINT `id_alumno_log-al` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_log-al` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `anio_lectivo`
--
ALTER TABLE `anio_lectivo`
  ADD CONSTRAINT `id_sede_aniolectivo` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `id_grado_area` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sede_area` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `id_area_asig` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_docente_asig` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `id_alumno_asis` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_asis` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_asis` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cancelado`
--
ALTER TABLE `cancelado`
  ADD CONSTRAINT `id_alumno_cancelado` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_estado_cancelado` FOREIGN KEY (`id_estado`) REFERENCES `estado_alumno` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `id_sede_docente` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `id_sede_grado` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `id_anio_lectivo` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_docente_grupo` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_grado_grupo` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logros`
--
ALTER TABLE `logros`
  ADD CONSTRAINT `id_asignatura_logros` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `id_alumno_nota` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_nota` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_nota` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_definitiva`
--
ALTER TABLE `nota_definitiva`
  ADD CONSTRAINT `id_alumno_notadef` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_notadef` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_area_notadef` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `id_anio_lectivo_periodo` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD CONSTRAINT `id_alumno_recu` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_anio_lectivo_recu` FOREIGN KEY (`id_anio_lectivo`) REFERENCES `anio_lectivo` (`id_anio_lectivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_asignatura_recu` FOREIGN KEY (`id_recuperacion`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
