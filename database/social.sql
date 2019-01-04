-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2018 at 07:02 PM
-- Server version: 10.0.35-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdtanvirhaque_trivuz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `pass` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pass`) VALUES
(1, 'MD Tanvir Haque', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--

CREATE TABLE `bio` (
  `bioid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `biotext` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bio`
--

INSERT INTO `bio` (`bioid`, `userid`, `biotext`) VALUES
(2, 1, 'Nothing is permanent');

-- --------------------------------------------------------

--
-- Table structure for table `block_admin`
--

CREATE TABLE `block_admin` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `content` text NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_1`, `user_2`, `content`, `chat_time`, `actionid`) VALUES
(1, 1, 3, 'Hakai', '2017-12-05 00:02:38', 1),
(2, 1, 2, 'Yo bro ', '2017-12-05 00:02:48', 1),
(3, 1, 3, 'HMMM', '2017-12-05 00:05:49', 3),
(4, 1, 2, 'what bro ', '2017-12-05 00:14:24', 2),
(5, 1, 3, 'hello everyone :D ', '2017-12-18 14:03:49', 1),
(6, 1, 3, 'HAKAI AGAIN', '2018-01-01 08:41:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat_notification`
--

CREATE TABLE `chat_notification` (
  `id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `actionid` int(11) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_notification`
--

INSERT INTO `chat_notification` (`id`, `user_1`, `user_2`, `actionid`, `send_time`) VALUES
(4, 1, 2, 2, '2017-12-05 00:14:24'),
(5, 1, 3, 1, '2017-12-18 14:03:49'),
(3, 1, 3, 3, '2017-12-05 00:05:49'),
(6, 1, 3, 1, '2018-01-01 08:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `chat_user`
--

CREATE TABLE `chat_user` (
  `id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_user`
--

INSERT INTO `chat_user` (`id`, `user_1`, `user_2`) VALUES
(1, 1, 3),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `copyr8`
--

CREATE TABLE `copyr8` (
  `id` int(11) NOT NULL,
  `copy` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copyr8`
--

INSERT INTO `copyr8` (`id`, `copy`) VALUES
(1, 'Trivuz');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antigua and Barbuda'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Aruba'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaijan'),
(15, 'Bahamas'),
(16, 'Bahrain'),
(17, 'Bangladesh'),
(18, 'Barbados'),
(19, 'Belarus'),
(20, 'Belgium'),
(21, 'Belize'),
(22, 'Benin'),
(23, 'Bermuda'),
(24, 'Bhutan'),
(25, 'Bolivia'),
(26, 'Bosnia and Herzegovina'),
(27, 'Botswana'),
(28, 'Brazil'),
(29, 'Brunei Darussalam'),
(30, 'Bulgaria'),
(31, 'Burkina Faso'),
(32, 'Burundi'),
(33, 'Cambodia'),
(34, 'Cameroon'),
(35, 'Canada'),
(36, 'Cape Verde'),
(37, 'Cayman Islands'),
(38, 'Central African Republic'),
(39, 'Chad'),
(40, 'Chile'),
(41, 'China'),
(42, 'Christmas Island'),
(43, 'Cocos'),
(44, 'Colombia'),
(47, 'Cook Islands'),
(45, 'Comoros'),
(48, 'Costa Rica'),
(49, 'Ivory Coas'),
(50, 'Croatia'),
(51, ' Cuba'),
(52, 'Cyprus'),
(53, 'Czech Republic'),
(54, 'Denmark'),
(55, 'Djibouti'),
(56, 'Dominica'),
(57, 'Dominican Republic'),
(58, 'East Timor'),
(59, 'Ecuador'),
(60, ' Egypt'),
(61, 'El Salvador'),
(62, 'Equatorial Guinea'),
(63, 'Eritrea'),
(64, ' Estonia'),
(65, ' Ethiopia'),
(66, ' Falkland Islands'),
(67, 'Faroe Islands'),
(68, ' Fiji'),
(69, 'Finland'),
(70, 'France'),
(71, ' French Guiana'),
(72, ' French Polynesia'),
(73, ' French Southern Territories'),
(74, 'Gabon'),
(75, 'Gambia'),
(76, 'Georgia'),
(77, 'Germany'),
(78, 'Ghana'),
(79, 'Gibraltar'),
(80, ' Great Britain'),
(81, ' Greece'),
(82, ' Greenland'),
(83, ' Grenada'),
(84, ' Guadeloupe'),
(85, ' Guam'),
(86, 'Guatemala'),
(87, ' Guinea'),
(88, 'Guinea-Bissau'),
(89, ' Guyana'),
(90, ' Haiti'),
(91, 'Holy See'),
(92, 'Honduras'),
(93, ' Hong Kong'),
(94, 'Hungary'),
(95, ' Iceland'),
(96, ' India'),
(97, ' Indonesia'),
(98, 'Iran'),
(99, ' Iraq'),
(100, ' Ireland'),
(101, ' Israel'),
(102, ' Italy'),
(103, ' Ivory Coast'),
(104, 'Jamaica'),
(105, ' Japan'),
(106, ' Jordan'),
(107, ' Kazakhstan'),
(108, ' Kenya'),
(109, ' Kiribati'),
(110, 'Korea'),
(111, ' Kuwait'),
(112, ' Kyrgyzstan'),
(113, 'Lao'),
(114, ' Latvia'),
(115, ' Lebanon'),
(116, ' Lesotho'),
(117, ' Liberia'),
(118, ' Libya'),
(119, ' Liechtenstein'),
(120, ' Lithuania'),
(121, ' Luxembourg'),
(122, 'Macau'),
(123, 'Macedonia'),
(124, ' Madagascar'),
(125, ' Malawi'),
(126, ' Malaysia'),
(127, ' Maldives'),
(128, ' Mali'),
(129, 'Malta'),
(130, ' Marshall Islands'),
(131, ' Martinique'),
(132, 'Mauritania'),
(133, ' Mauritius'),
(134, ' Mayotte'),
(135, ' Mexico'),
(136, 'Micronesia'),
(137, 'Moldova'),
(138, ' Monaco'),
(139, ' Mongolia'),
(140, 'Montenegro'),
(141, ' Montserrat'),
(142, 'Morocco'),
(143, ' Mozambique'),
(144, ' Myanmar'),
(145, 'Namibia'),
(146, ' Nauru'),
(147, 'Nepal'),
(148, ' Netherlands'),
(149, ' Netherlands Antilles'),
(150, ' 	New Caledonia'),
(151, ' 	New Zealand'),
(152, ' 	Nicaragua'),
(153, ' 	Niger'),
(154, ' 	Nigeria'),
(155, ' 	Niue'),
(156, ' 	Northern Mariana Islands'),
(157, ' 	Norway'),
(158, ' 	Oman'),
(159, ' 	Pakistan'),
(160, ' 	Palau'),
(161, ' 	Palestinian territories'),
(162, ' 	Panama'),
(163, ' 	Papua New Guinea'),
(164, ' 	Paraguay'),
(165, ' 	Peru'),
(166, ' 	Philippines'),
(167, ' 	Pitcairn Island'),
(168, ' 	Poland'),
(169, ' 	Portugal'),
(170, ' 	Puerto Rico'),
(171, ' 	Qatar'),
(172, ' 	Reunion Island'),
(173, ' 	Romania'),
(174, ' 	Russian Federation'),
(175, ' 	Rwanda'),
(176, ' 	Saint Kitts and Nevis'),
(177, ' 	Saint Lucia'),
(178, ' 	Saint Vincent and the Grenadines'),
(179, ' 	Samoa'),
(180, ' 	San Marino'),
(181, ' 	Sao Tome and Principe'),
(182, ' 	Saudi Arabia'),
(183, ' 	Senegal'),
(184, ' 	Serbia'),
(185, ' 	Seychelles'),
(186, ' 	Sierra Leone'),
(187, ' 	Singapore'),
(188, ' 	Slovakia '),
(189, ' 	Slovenia'),
(190, ' 	Solomon Islands'),
(191, ' 	Somalia'),
(192, ' 	South Africa'),
(193, ' 	South Sudan'),
(194, ' 	Spain'),
(195, ' 	Sri Lanka'),
(196, ' 	Sudan'),
(197, ' 	Suriname'),
(198, ' 	Swaziland'),
(199, ' 	Sweden'),
(200, ' 	Switzerland'),
(201, ' 	Syria'),
(202, ' 	Taiwan'),
(203, 'Tajikistan'),
(204, ' 	Tanzania'),
(205, ' 	Thailand'),
(206, ' 	Tibet'),
(207, ' 	Timor-Leste '),
(208, ' 	Togo'),
(209, ' 	Tokelau'),
(210, ' 	Tonga'),
(211, 'Trinidad and Tobago'),
(212, ' 	Tunisia'),
(213, 'Turkey'),
(214, ' 	Turkmenistan'),
(215, ' 	Turks and Caicos Islands'),
(216, ' 	Tuvalu'),
(217, ' 	Uganda'),
(218, ' 	Ukraine'),
(219, 'United Arab Emirates'),
(220, ' 	United Kingdom'),
(221, ' 	United States'),
(222, ' 	Uruguay'),
(223, ' 	Uzbekistan'),
(224, ' 	Vanuatu'),
(225, ' 	Vatican City State'),
(226, ' 	Venezuela'),
(227, ' 	Vietnam'),
(228, ' 	Virgin Islands '),
(229, 'Virgin Islands (U.S.)'),
(230, ' 	Wallis and Futuna Islands'),
(231, ' 	Western Sahara'),
(232, ' 	Yemen'),
(233, ' 	Zambia'),
(234, ' 	Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `cover_images`
--

CREATE TABLE `cover_images` (
  `cover_image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cover_image` varchar(110) NOT NULL,
  `cover_image_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cover_images`
--

INSERT INTO `cover_images` (`cover_image_id`, `user_id`, `cover_image`, `cover_image_time`) VALUES
(9, 1, 'images/covers/d5fa0fab70.jpg', '2017-12-04 23:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `educationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `institute` varchar(128) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `degree` varchar(55) NOT NULL,
  `edu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`educationid`, `userid`, `institute`, `subject`, `degree`, `edu_status`) VALUES
(1, 1, 'Jahangirnagar University', 'CSE', 'Bsc', 1),
(3, 1, 'Dhaka College', 'Science', 'HSC', 1),
(4, 1, 'BCSIR High School', 'Science', 'SSC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`user1_id`, `user2_id`, `status`, `action_id`) VALUES
(1, 2, 1, 1),
(2, 3, 0, 3),
(1, 5, 0, 5),
(1, 7, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo_media` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_info`
--

CREATE TABLE `other_info` (
  `otherid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `livesin` varchar(55) DEFAULT NULL,
  `comesfrom` varchar(55) DEFAULT NULL,
  `relationship` varchar(24) NOT NULL DEFAULT 'Single'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_info`
--

INSERT INTO `other_info` (`otherid`, `userid`, `livesin`, `comesfrom`, `relationship`) VALUES
(3, 1, 'Dhaka, Bangladesh', 'Comilla', 'Single');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` text,
  `post_image` varchar(55) DEFAULT NULL,
  `post_love` int(11) DEFAULT NULL,
  `post_like` int(11) DEFAULT NULL,
  `post_dislike` int(11) DEFAULT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `post_image`, `post_love`, `post_like`, `post_dislike`, `post_time`) VALUES
(1, 1, 'What ever it Takes .....', NULL, NULL, NULL, NULL, '2017-12-04 23:44:17'),
(2, 1, NULL, 'images/postimages/9e99993d6d.jpg', NULL, NULL, NULL, '2017-12-04 23:44:56'),
(3, 3, 'I LOVE ANIME', NULL, NULL, NULL, NULL, '2017-12-05 00:03:18'),
(4, 2, 'Its all about anik', NULL, NULL, NULL, NULL, '2017-12-05 00:13:53'),
(7, 1, 'my name is Tanvir', NULL, NULL, NULL, NULL, '2017-12-29 17:16:55'),
(9, 1, 'HAPPY NEW YEAR :) ', NULL, NULL, NULL, NULL, '2018-01-01 08:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `post_id`, `user_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 2),
(3, 3, 3, 0),
(4, 2, 2, 0),
(5, 1, 2, 0),
(6, 2, 3, 0),
(7, 1, 3, 0),
(8, 3, 1, 0),
(9, 4, 2, 0),
(14, 4, 1, 2),
(11, 7, 1, 2),
(12, 8, 1, 2),
(13, 9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `profile_image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(110) NOT NULL,
  `profile_image_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`profile_image_id`, `user_id`, `profile_image`, `profile_image_time`) VALUES
(1, 1, 'images/profileimages/2dc79497b8.jpg', '2017-12-04 23:43:49'),
(2, 1, 'images/profileimages/6e806b7e56.png', '2017-12-15 20:42:52'),
(3, 1, 'images/profileimages/9736fd7445.jpg', '2017-12-15 20:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `slogan`
--

CREATE TABLE `slogan` (
  `id` int(11) NOT NULL,
  `slogan_media` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slogan`
--

INSERT INTO `slogan` (`id`, `slogan_media`) VALUES
(1, 'A Social Media For Everyone');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `id` int(11) NOT NULL,
  `title_media` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `title_media`) VALUES
(1, 'Welcome To Trivuz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(64) NOT NULL,
  `country_id` int(32) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `activate` int(11) NOT NULL DEFAULT '1',
  `log_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `password`, `country_id`, `gender`, `dob`, `token`, `activate`, `log_status`) VALUES
(1, 'Tanvir', 'Haque', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 17, 'Male', '1991-09-13', 'a9bfc23c5b2b3de63ebb96651fa161517cf1806b', 1, 1),
(2, 'Anik', 'Ahmed', 'anikkabirahmed1@gmail.com', '43c29960958a89cbcc076b93fdf5dc20a4c9622f', 17, 'male', '1991-12-06', '43c29960958a89cbcc076b93fdf5dc20a4c9622f', 1, 0),
(3, 'Nusrat Jahan', 'Eka', 'nusratjahan@gmail.com', '43c29960958a89cbcc076b93fdf5dc20a4c9622f', 13, 'FEMALE', '1996-12-20', '43c29960958a89cbcc076b93fdf5dc20a4c9622f', 1, 0),
(4, 'tanvir', 'haque', 's@ggnail.com', '24ec125e9224708d4ec02ece4e2ff91e750d783e', 1, 'Female', '1980-01-22', '706b31f4879456c71fa708cc786ae4af83339ac0', 1, 0),
(5, 'Shadakalo', 'Tanvir', 'shadashada@gmail.com', '24ec125e9224708d4ec02ece4e2ff91e750d783e', 17, 'Male', '1993-01-17', 'f8afc75f30601fc5d17aa1dde163ea58d272d07d', 1, 0),
(6, 'Tanvir', 'Haque', 'mdtanvirhaque@gmail.com', '590bbe80b9183a6698b586420f996fc2f9fc8d36', 17, 'Male', '1993-01-01', 'b4491e38e1da76f1722c0615fdb0b4be3c9e438f', 1, 0),
(7, 'sagar', 'haque', 'sagar@gmail.com', '590bbe80b9183a6698b586420f996fc2f9fc8d36', 1, 'Male', '1993-07-01', 'e7d77aecfcf25100092132ce91f28bf5454f7403', 1, 0),
(8, 'Shadakalo', 'Tanvir', 'hey@gmail.com', '590bbe80b9183a6698b586420f996fc2f9fc8d36', 2, 'Male', '1993-01-01', '3e9d1acb48b4982e8054a557a17eb3853e98256d', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `workid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `company` varchar(55) NOT NULL,
  `designation` varchar(55) NOT NULL,
  `work_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`workid`, `userid`, `company`, `designation`, `work_status`) VALUES
(1, 1, 'Google', 'Developer', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`bioid`);

--
-- Indexes for table `block_admin`
--
ALTER TABLE `block_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_notification`
--
ALTER TABLE `chat_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_user`
--
ALTER TABLE `chat_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`user_1`,`user_2`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `copyr8`
--
ALTER TABLE `copyr8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `cover_images`
--
ALTER TABLE `cover_images`
  ADD PRIMARY KEY (`cover_image_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`educationid`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD UNIQUE KEY `unique` (`user1_id`,`user2_id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_info`
--
ALTER TABLE `other_info`
  ADD PRIMARY KEY (`otherid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`profile_image_id`);

--
-- Indexes for table `slogan`
--
ALTER TABLE `slogan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`workid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bio`
--
ALTER TABLE `bio`
  MODIFY `bioid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `block_admin`
--
ALTER TABLE `block_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_notification`
--
ALTER TABLE `chat_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_user`
--
ALTER TABLE `chat_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copyr8`
--
ALTER TABLE `copyr8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `cover_images`
--
ALTER TABLE `cover_images`
  MODIFY `cover_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `educationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_info`
--
ALTER TABLE `other_info`
  MODIFY `otherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `profile_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slogan`
--
ALTER TABLE `slogan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `workid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
