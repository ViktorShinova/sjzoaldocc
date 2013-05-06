-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2013 at 12:27 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `careershire`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `slug` varchar(12) DEFAULT NULL,
  `preferred_location` int(11) DEFAULT NULL,
  `preferred_job` int(11) DEFAULT NULL,
  `contact_number` varchar(12) DEFAULT NULL,
  `viewable` tinyint(1) NOT NULL,
  `profilepic` varchar(255) DEFAULT '/img/default-profile.png',
  `skills` text NOT NULL,
  `summary` varchar(175) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `user_id`, `first_name`, `last_name`, `slug`, `preferred_location`, `preferred_job`, `contact_number`, `viewable`, `profilepic`, `skills`, `summary`, `created_at`, `updated_at`) VALUES
(1, 17, 'Damien', 'koh', 'damienkoh', 1, 1, NULL, 1, '/img/default-profile.png', '', '', '2013-03-20 11:53:23', '2013-04-01 12:21:29'),
(2, 18, 'Victor', 'Lim', 'victorlimys', 2, 15, '0432719204', 1, '/uploads/applicant/917631549598b525ca7bfc1447a19174/image.png', 'CSS3,HTML5,Laravel,PHP,C#,Visual Studo,Perl,CGI,Shell Script,Photoshop,Illustrator,Agile,Graphic Design', 'Dedicated administrative support professional with 10+ years providing outstanding support to senior executives', '2013-03-23 07:54:43', '2013-04-23 12:26:28'),
(3, 20, 'Damien', 'Koh', NULL, 1, 15, NULL, 1, '/uploads/applicant/dfc29e9b01a54f5bd25df8ca42e8b92a/IMG_0009.png', '', '', '2013-03-28 06:26:33', '2013-03-28 06:26:53'),
(4, 22, 'Jesslyn', 'Lim', NULL, 3, 4, NULL, 1, '/uploads/applicant/ff6ae2cda9741c0f0c03bce2b6d93af9/for tweet.png', '', '', '2013-03-30 13:18:55', '2013-03-31 05:17:28'),
(5, 23, 'test', 'etst', NULL, 3, 2, NULL, 1, '/img/default-profile.png', '', '', '2013-03-30 22:35:30', '2013-03-30 22:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_coverletters`
--

CREATE TABLE IF NOT EXISTS `applicant_coverletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) DEFAULT NULL,
  `coverletter` varchar(255) DEFAULT NULL,
  `filesize` int(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  `disabled` tinyint(1) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `applicant_coverletters`
--

INSERT INTO `applicant_coverletters` (`id`, `applicant_id`, `coverletter`, `filesize`, `type`, `disabled`, `path`, `created_at`, `updated_at`) VALUES
(9, 2, 'doc-file-2.doc', 26112, 'application/msword', 0, '/uploads/applicant/917631549598b525ca7bfc1447a19174/coverletter/doc-file-2.doc', '2013-04-20 14:14:32', '2013-04-20 14:14:32'),
(10, 2, 'pdf-file-2.pdf', 80047, 'application/pdf', 0, '/uploads/applicant/917631549598b525ca7bfc1447a19174/coverletter/pdf-file-2.pdf', '2013-04-20 14:14:41', '2013-04-20 14:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_job`
--

CREATE TABLE IF NOT EXISTS `applicant_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `applicantshortlistcategory_id` int(11) DEFAULT NULL,
  `cover_letter` text,
  `applicant_resume_id` int(255) DEFAULT NULL,
  `applicant_coverletter_id` int(255) DEFAULT NULL,
  `write_resume` text,
  `write_coverletter` text,
  `alternate_contact_details` text,
  `non_registered_users` text,
  `sent` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `applicant_job`
--

INSERT INTO `applicant_job` (`id`, `job_id`, `applicant_id`, `status`, `applicantshortlistcategory_id`, `cover_letter`, `applicant_resume_id`, `applicant_coverletter_id`, `write_resume`, `write_coverletter`, `alternate_contact_details`, `non_registered_users`, `sent`, `created_at`, `updated_at`) VALUES
(9, 23, 2, 1, NULL, NULL, 34, 10, '', '', 'a:2:{i:0;s:21:"victorlim86@gmail.com";i:1;s:10:"0432719204";}', NULL, NULL, '2013-04-22 13:21:13', '2013-04-22 13:21:13'),
(10, 23, NULL, 1, NULL, NULL, NULL, NULL, 'asdasd', 'asdasd', NULL, 'a:4:{i:0;s:6:"Victor";i:1;s:3:"Lim";i:2;s:21:"victorlim86@gmail.com";i:3;s:11:"61432719204";}', NULL, '2013-04-22 13:35:42', '2013-04-22 13:35:42'),
(11, 23, NULL, 1, NULL, NULL, NULL, NULL, 'asdasd', 'asasda', NULL, 'a:4:{i:0;s:6:"Victor";i:1;s:3:"Lim";i:2;s:21:"victorlim86@gmail.com";i:3;s:11:"61432719204";}', NULL, '2013-04-22 13:37:19', '2013-04-22 13:37:19'),
(12, 23, NULL, 1, NULL, NULL, NULL, NULL, 'adasdad', '123141asdasd', NULL, 'a:4:{i:0;s:6:"Victor";i:1;s:3:"Lim";i:2;s:21:"victorlim86@gmail.com";i:3;s:11:"61432719204";}', NULL, '2013-04-22 13:38:20', '2013-04-22 13:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_qualifications`
--

CREATE TABLE IF NOT EXISTS `applicant_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `description` text,
  `started` int(4) DEFAULT NULL,
  `ended` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_applicant_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `applicant_qualifications`
--

INSERT INTO `applicant_qualifications` (`id`, `applicant_id`, `name`, `school`, `field_of_study`, `description`, `started`, `ended`, `created_at`, `updated_at`) VALUES
(18, 2, 'Bachelor of IT', 'University of Queensland', 'Software Information Systems Major', 'the quick brown fox', 2011, 2012, '2013-04-01 01:27:28', '2013-04-01 01:32:12'),
(20, 2, 'Diploma in Info-communications Engineering', 'Temasek Poly', '', '', 2004, 2007, '2013-04-01 01:57:05', '2013-04-01 01:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_resumes`
--

CREATE TABLE IF NOT EXISTS `applicant_resumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `filesize` int(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  `disabled` tinyint(1) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_applicant_idx` (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `applicant_resumes`
--

INSERT INTO `applicant_resumes` (`id`, `applicant_id`, `resume`, `filesize`, `type`, `disabled`, `path`, `created_at`, `updated_at`) VALUES
(34, 2, 'doc-file.doc', 26112, 'application/msword', 0, '/uploads/applicant/917631549598b525ca7bfc1447a19174/resume/doc-file.doc', '2013-04-14 13:19:25', '2013-04-14 13:19:25'),
(36, 2, 'pdf-file-2.pdf', 80047, 'application/pdf', 0, '/uploads/applicant/917631549598b525ca7bfc1447a19174/resume/pdf-file-2.pdf', '2013-04-14 13:19:34', '2013-04-14 13:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_shortlist_category`
--

CREATE TABLE IF NOT EXISTS `applicant_shortlist_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `applicant_shortlist_category`
--

INSERT INTO `applicant_shortlist_category` (`id`, `applicant_id`, `name`) VALUES
(18, 1, 'test'),
(19, 1, 'haha'),
(20, 2, 'good location'),
(21, 2, 'high salary'),
(22, 2, 'close to home');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_work_history`
--

CREATE TABLE IF NOT EXISTS `applicant_work_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `started` date NOT NULL,
  `ended` date DEFAULT NULL,
  `employer_name` varchar(255) NOT NULL,
  `industry` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `currently_work_here` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `applicant_work_history`
--

INSERT INTO `applicant_work_history` (`id`, `applicant_id`, `started`, `ended`, `employer_name`, `industry`, `description`, `currently_work_here`, `created_at`, `updated_at`) VALUES
(20, 1, '2133-01-01', '2132-01-01', 'fads', '0', 'ts', 0, '2013-04-01 12:35:17', '2013-04-01 12:35:17'),
(21, 1, '0000-01-01', '0000-01-01', 'dsadas', '0', '', 0, '2013-04-01 12:35:38', '2013-04-01 12:37:13'),
(22, 1, '0000-01-01', '0000-01-01', 'dsadsa', '0', '', 0, '2013-04-01 12:35:38', '2013-04-01 12:37:13'),
(23, 2, '2013-02-01', '0000-00-00', 'Mitara', '14', 'Web Developer', 1, '2013-04-15 09:23:09', '2013-04-22 13:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `code` char(3) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `continent` varchar(20) DEFAULT NULL,
  `region` varchar(26) DEFAULT NULL,
  `local_name` varchar(45) DEFAULT NULL,
  `code_2` char(2) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`code`, `name`, `continent`, `region`, `local_name`, `code_2`) VALUES
('ABW', 'Aruba', 'North America', 'Caribbean', 'Aruba', 'AW'),
('AFG', 'Afghanistan', 'Asia', 'Southern and Central Asia', 'Afganistan/Afqanestan', 'AF'),
('AGO', 'Angola', 'Africa', 'Central Africa', 'Angola', 'AO'),
('AIA', 'Anguilla', 'North America', 'Caribbean', 'Anguilla', 'AI'),
('ALB', 'Albania', 'Europe', 'Southern Europe', 'ShqipÃƒÂ«ria', 'AL'),
('AND', 'Andorra', 'Europe', 'Southern Europe', 'Andorra', 'AD'),
('ANT', 'Netherlands Antilles', 'North America', 'Caribbean', 'Nederlandse Antillen', 'AN'),
('ARE', 'United Arab Emirates', 'Asia', 'Middle East', 'Al-Imarat al-Ã‚Â´Arabiya al-Muttahida', 'AE'),
('ARG', 'Argentina', 'South America', 'South America', 'Argentina', 'AR'),
('ARM', 'Armenia', 'Asia', 'Middle East', 'Hajastan', 'AM'),
('ASM', 'American Samoa', 'Oceania', 'Polynesia', 'Amerika Samoa', 'AS'),
('ATA', 'Antarctica', 'Antarctica', 'Antarctica', 'Ã¢â‚¬â€œ', 'AQ'),
('ATF', 'French Southern territories', 'Antarctica', 'Antarctica', 'Terres australes franÃƒÂ§aises', 'TF'),
('ATG', 'Antigua and Barbuda', 'North America', 'Caribbean', 'Antigua and Barbuda', 'AG'),
('AUS', 'Australia', 'Oceania', 'Australia and New Zealand', 'Australia', 'AU'),
('AUT', 'Austria', 'Europe', 'Western Europe', 'Ãƒâ€“sterreich', 'AT'),
('AZE', 'Azerbaijan', 'Asia', 'Middle East', 'AzÃƒÂ¤rbaycan', 'AZ'),
('BDI', 'Burundi', 'Africa', 'Eastern Africa', 'Burundi/Uburundi', 'BI'),
('BEL', 'Belgium', 'Europe', 'Western Europe', 'BelgiÃƒÂ«/Belgique', 'BE'),
('BEN', 'Benin', 'Africa', 'Western Africa', 'BÃƒÂ©nin', 'BJ'),
('BFA', 'Burkina Faso', 'Africa', 'Western Africa', 'Burkina Faso', 'BF'),
('BGD', 'Bangladesh', 'Asia', 'Southern and Central Asia', 'Bangladesh', 'BD'),
('BGR', 'Bulgaria', 'Europe', 'Eastern Europe', 'Balgarija', 'BG'),
('BHR', 'Bahrain', 'Asia', 'Middle East', 'Al-Bahrayn', 'BH'),
('BHS', 'Bahamas', 'North America', 'Caribbean', 'The Bahamas', 'BS'),
('BIH', 'Bosnia and Herzegovina', 'Europe', 'Southern Europe', 'Bosna i Hercegovina', 'BA'),
('BLR', 'Belarus', 'Europe', 'Eastern Europe', 'Belarus', 'BY'),
('BLZ', 'Belize', 'North America', 'Central America', 'Belize', 'BZ'),
('BMU', 'Bermuda', 'North America', 'North America', 'Bermuda', 'BM'),
('BOL', 'Bolivia', 'South America', 'South America', 'Bolivia', 'BO'),
('BRA', 'Brazil', 'South America', 'South America', 'Brasil', 'BR'),
('BRB', 'Barbados', 'North America', 'Caribbean', 'Barbados', 'BB'),
('BRN', 'Brunei', 'Asia', 'Southeast Asia', 'Brunei Darussalam', 'BN'),
('BTN', 'Bhutan', 'Asia', 'Southern and Central Asia', 'Druk-Yul', 'BT'),
('BVT', 'Bouvet Island', 'Antarctica', 'Antarctica', 'BouvetÃƒÂ¸ya', 'BV'),
('BWA', 'Botswana', 'Africa', 'Southern Africa', 'Botswana', 'BW'),
('CAF', 'Central African Republic', 'Africa', 'Central Africa', 'Centrafrique/BÃƒÂª-AfrÃƒÂ®ka', 'CF'),
('CAN', 'Canada', 'North America', 'North America', 'Canada', 'CA'),
('CCK', 'Cocos (Keeling) Islands', 'Oceania', 'Australia and New Zealand', 'Cocos (Keeling) Islands', 'CC'),
('CHE', 'Switzerland', 'Europe', 'Western Europe', 'Schweiz/Suisse/Svizzera/Svizra', 'CH'),
('CHL', 'Chile', 'South America', 'South America', 'Chile', 'CL'),
('CHN', 'China', 'Asia', 'Eastern Asia', 'Zhongquo', 'CN'),
('CIV', 'CÃƒÂ´te dÃ¢â‚¬â„¢Ivoire', 'Africa', 'Western Africa', 'CÃƒÂ´te dÃ¢â‚¬â„¢Ivoire', 'CI'),
('CMR', 'Cameroon', 'Africa', 'Central Africa', 'Cameroun/Cameroon', 'CM'),
('COD', 'Congo, The Democratic Republic of the', 'Africa', 'Central Africa', 'RÃƒÂ©publique DÃƒÂ©mocratique du Congo', 'CD'),
('COG', 'Congo', 'Africa', 'Central Africa', 'Congo', 'CG'),
('COK', 'Cook Islands', 'Oceania', 'Polynesia', 'The Cook Islands', 'CK'),
('COL', 'Colombia', 'South America', 'South America', 'Colombia', 'CO'),
('COM', 'Comoros', 'Africa', 'Eastern Africa', 'Komori/Comores', 'KM'),
('CPV', 'Cape Verde', 'Africa', 'Western Africa', 'Cabo Verde', 'CV'),
('CRI', 'Costa Rica', 'North America', 'Central America', 'Costa Rica', 'CR'),
('CUB', 'Cuba', 'North America', 'Caribbean', 'Cuba', 'CU'),
('CXR', 'Christmas Island', 'Oceania', 'Australia and New Zealand', 'Christmas Island', 'CX'),
('CYM', 'Cayman Islands', 'North America', 'Caribbean', 'Cayman Islands', 'KY'),
('CYP', 'Cyprus', 'Asia', 'Middle East', 'KÃƒÂ½pros/Kibris', 'CY'),
('CZE', 'Czech Republic', 'Europe', 'Eastern Europe', 'Ã‚Â¸esko', 'CZ'),
('DEU', 'Germany', 'Europe', 'Western Europe', 'Deutschland', 'DE'),
('DJI', 'Djibouti', 'Africa', 'Eastern Africa', 'Djibouti/Jibuti', 'DJ'),
('DMA', 'Dominica', 'North America', 'Caribbean', 'Dominica', 'DM'),
('DNK', 'Denmark', 'Europe', 'Nordic Countries', 'Danmark', 'DK'),
('DOM', 'Dominican Republic', 'North America', 'Caribbean', 'RepÃƒÂºblica Dominicana', 'DO'),
('DZA', 'Algeria', 'Africa', 'Northern Africa', 'Al-JazaÃ¢â‚¬â„¢ir/AlgÃƒÂ©rie', 'DZ'),
('ECU', 'Ecuador', 'South America', 'South America', 'Ecuador', 'EC'),
('EGY', 'Egypt', 'Africa', 'Northern Africa', 'Misr', 'EG'),
('ERI', 'Eritrea', 'Africa', 'Eastern Africa', 'Ertra', 'ER'),
('ESH', 'Western Sahara', 'Africa', 'Northern Africa', 'As-Sahrawiya', 'EH'),
('ESP', 'Spain', 'Europe', 'Southern Europe', 'EspaÃƒÂ±a', 'ES'),
('EST', 'Estonia', 'Europe', 'Baltic Countries', 'Eesti', 'EE'),
('ETH', 'Ethiopia', 'Africa', 'Eastern Africa', 'YeItyopÃ‚Â´iya', 'ET'),
('FIN', 'Finland', 'Europe', 'Nordic Countries', 'Suomi', 'FI'),
('FJI', 'Fiji Islands', 'Oceania', 'Melanesia', 'Fiji Islands', 'FJ'),
('FLK', 'Falkland Islands', 'South America', 'South America', 'Falkland Islands', 'FK'),
('FRA', 'France', 'Europe', 'Western Europe', 'France', 'FR'),
('FRO', 'Faroe Islands', 'Europe', 'Nordic Countries', 'FÃƒÂ¸royar', 'FO'),
('FSM', 'Micronesia, Federated States of', 'Oceania', 'Micronesia', 'Micronesia', 'FM'),
('GAB', 'Gabon', 'Africa', 'Central Africa', 'Le Gabon', 'GA'),
('GBR', 'United Kingdom', 'Europe', 'British Islands', 'United Kingdom', 'GB'),
('GEO', 'Georgia', 'Asia', 'Middle East', 'Sakartvelo', 'GE'),
('GHA', 'Ghana', 'Africa', 'Western Africa', 'Ghana', 'GH'),
('GIB', 'Gibraltar', 'Europe', 'Southern Europe', 'Gibraltar', 'GI'),
('GIN', 'Guinea', 'Africa', 'Western Africa', 'GuinÃƒÂ©e', 'GN'),
('GLP', 'Guadeloupe', 'North America', 'Caribbean', 'Guadeloupe', 'GP'),
('GMB', 'Gambia', 'Africa', 'Western Africa', 'The Gambia', 'GM'),
('GNB', 'Guinea-Bissau', 'Africa', 'Western Africa', 'GuinÃƒÂ©-Bissau', 'GW'),
('GNQ', 'Equatorial Guinea', 'Africa', 'Central Africa', 'Guinea Ecuatorial', 'GQ'),
('GRC', 'Greece', 'Europe', 'Southern Europe', 'EllÃƒÂ¡da', 'GR'),
('GRD', 'Grenada', 'North America', 'Caribbean', 'Grenada', 'GD'),
('GRL', 'Greenland', 'North America', 'North America', 'Kalaallit Nunaat/GrÃƒÂ¸nland', 'GL'),
('GTM', 'Guatemala', 'North America', 'Central America', 'Guatemala', 'GT'),
('GUF', 'French Guiana', 'South America', 'South America', 'Guyane franÃƒÂ§aise', 'GF'),
('GUM', 'Guam', 'Oceania', 'Micronesia', 'Guam', 'GU'),
('GUY', 'Guyana', 'South America', 'South America', 'Guyana', 'GY'),
('HKG', 'Hong Kong', 'Asia', 'Eastern Asia', 'Xianggang/Hong Kong', 'HK'),
('HMD', 'Heard Island and McDonald Islands', 'Antarctica', 'Antarctica', 'Heard and McDonald Islands', 'HM'),
('HND', 'Honduras', 'North America', 'Central America', 'Honduras', 'HN'),
('HRV', 'Croatia', 'Europe', 'Southern Europe', 'Hrvatska', 'HR'),
('HTI', 'Haiti', 'North America', 'Caribbean', 'HaÃƒÂ¯ti/Dayti', 'HT'),
('HUN', 'Hungary', 'Europe', 'Eastern Europe', 'MagyarorszÃƒÂ¡g', 'HU'),
('IDN', 'Indonesia', 'Asia', 'Southeast Asia', 'Indonesia', 'ID'),
('IND', 'India', 'Asia', 'Southern and Central Asia', 'Bharat/India', 'IN'),
('IOT', 'British Indian Ocean Territory', 'Africa', 'Eastern Africa', 'British Indian Ocean Territory', 'IO'),
('IRL', 'Ireland', 'Europe', 'British Islands', 'Ireland/Ãƒâ€°ire', 'IE'),
('IRN', 'Iran', 'Asia', 'Southern and Central Asia', 'Iran', 'IR'),
('IRQ', 'Iraq', 'Asia', 'Middle East', 'Al-Ã‚Â´Iraq', 'IQ'),
('ISL', 'Iceland', 'Europe', 'Nordic Countries', 'ÃƒÂ?sland', 'IS'),
('ISR', 'Israel', 'Asia', 'Middle East', 'YisraÃ¢â‚¬â„¢el/IsraÃ¢â‚¬â„¢il', 'IL'),
('ITA', 'Italy', 'Europe', 'Southern Europe', 'Italia', 'IT'),
('JAM', 'Jamaica', 'North America', 'Caribbean', 'Jamaica', 'JM'),
('JOR', 'Jordan', 'Asia', 'Middle East', 'Al-Urdunn', 'JO'),
('JPN', 'Japan', 'Asia', 'Eastern Asia', 'Nihon/Nippon', 'JP'),
('KAZ', 'Kazakstan', 'Asia', 'Southern and Central Asia', 'Qazaqstan', 'KZ'),
('KEN', 'Kenya', 'Africa', 'Eastern Africa', 'Kenya', 'KE'),
('KGZ', 'Kyrgyzstan', 'Asia', 'Southern and Central Asia', 'Kyrgyzstan', 'KG'),
('KHM', 'Cambodia', 'Asia', 'Southeast Asia', 'KÃƒÂ¢mpuchÃƒÂ©a', 'KH'),
('KIR', 'Kiribati', 'Oceania', 'Micronesia', 'Kiribati', 'KI'),
('KNA', 'Saint Kitts and Nevis', 'North America', 'Caribbean', 'Saint Kitts and Nevis', 'KN'),
('KOR', 'South Korea', 'Asia', 'Eastern Asia', 'Taehan MinÃ¢â‚¬â„¢guk (Namhan)', 'KR'),
('KWT', 'Kuwait', 'Asia', 'Middle East', 'Al-Kuwayt', 'KW'),
('LAO', 'Laos', 'Asia', 'Southeast Asia', 'Lao', 'LA'),
('LBN', 'Lebanon', 'Asia', 'Middle East', 'Lubnan', 'LB'),
('LBR', 'Liberia', 'Africa', 'Western Africa', 'Liberia', 'LR'),
('LBY', 'Libyan Arab Jamahiriya', 'Africa', 'Northern Africa', 'Libiya', 'LY'),
('LCA', 'Saint Lucia', 'North America', 'Caribbean', 'Saint Lucia', 'LC'),
('LIE', 'Liechtenstein', 'Europe', 'Western Europe', 'Liechtenstein', 'LI'),
('LKA', 'Sri Lanka', 'Asia', 'Southern and Central Asia', 'Sri Lanka/Ilankai', 'LK'),
('LSO', 'Lesotho', 'Africa', 'Southern Africa', 'Lesotho', 'LS'),
('LTU', 'Lithuania', 'Europe', 'Baltic Countries', 'Lietuva', 'LT'),
('LUX', 'Luxembourg', 'Europe', 'Western Europe', 'Luxembourg/LÃƒÂ«tzebuerg', 'LU'),
('LVA', 'Latvia', 'Europe', 'Baltic Countries', 'Latvija', 'LV'),
('MAC', 'Macao', 'Asia', 'Eastern Asia', 'Macau/Aomen', 'MO'),
('MAR', 'Morocco', 'Africa', 'Northern Africa', 'Al-Maghrib', 'MA'),
('MCO', 'Monaco', 'Europe', 'Western Europe', 'Monaco', 'MC'),
('MDA', 'Moldova', 'Europe', 'Eastern Europe', 'Moldova', 'MD'),
('MDG', 'Madagascar', 'Africa', 'Eastern Africa', 'Madagasikara/Madagascar', 'MG'),
('MDV', 'Maldives', 'Asia', 'Southern and Central Asia', 'Dhivehi Raajje/Maldives', 'MV'),
('MEX', 'Mexico', 'North America', 'Central America', 'MÃƒÂ©xico', 'MX'),
('MHL', 'Marshall Islands', 'Oceania', 'Micronesia', 'Marshall Islands/Majol', 'MH'),
('MKD', 'Macedonia', 'Europe', 'Southern Europe', 'Makedonija', 'MK'),
('MLI', 'Mali', 'Africa', 'Western Africa', 'Mali', 'ML'),
('MLT', 'Malta', 'Europe', 'Southern Europe', 'Malta', 'MT'),
('MMR', 'Myanmar', 'Asia', 'Southeast Asia', 'Myanma Pye', 'MM'),
('MNG', 'Mongolia', 'Asia', 'Eastern Asia', 'Mongol Uls', 'MN'),
('MNP', 'Northern Mariana Islands', 'Oceania', 'Micronesia', 'Northern Mariana Islands', 'MP'),
('MOZ', 'Mozambique', 'Africa', 'Eastern Africa', 'MoÃƒÂ§ambique', 'MZ'),
('MRT', 'Mauritania', 'Africa', 'Western Africa', 'Muritaniya/Mauritanie', 'MR'),
('MSR', 'Montserrat', 'North America', 'Caribbean', 'Montserrat', 'MS'),
('MTQ', 'Martinique', 'North America', 'Caribbean', 'Martinique', 'MQ'),
('MUS', 'Mauritius', 'Africa', 'Eastern Africa', 'Mauritius', 'MU'),
('MWI', 'Malawi', 'Africa', 'Eastern Africa', 'Malawi', 'MW'),
('MYS', 'Malaysia', 'Asia', 'Southeast Asia', 'Malaysia', 'MY'),
('MYT', 'Mayotte', 'Africa', 'Eastern Africa', 'Mayotte', 'YT'),
('NAM', 'Namibia', 'Africa', 'Southern Africa', 'Namibia', 'NA'),
('NCL', 'New Caledonia', 'Oceania', 'Melanesia', 'Nouvelle-CalÃƒÂ©donie', 'NC'),
('NER', 'Niger', 'Africa', 'Western Africa', 'Niger', 'NE'),
('NFK', 'Norfolk Island', 'Oceania', 'Australia and New Zealand', 'Norfolk Island', 'NF'),
('NGA', 'Nigeria', 'Africa', 'Western Africa', 'Nigeria', 'NG'),
('NIC', 'Nicaragua', 'North America', 'Central America', 'Nicaragua', 'NI'),
('NIU', 'Niue', 'Oceania', 'Polynesia', 'Niue', 'NU'),
('NLD', 'Netherlands', 'Europe', 'Western Europe', 'Nederland', 'NL'),
('NOR', 'Norway', 'Europe', 'Nordic Countries', 'Norge', 'NO'),
('NPL', 'Nepal', 'Asia', 'Southern and Central Asia', 'Nepal', 'NP'),
('NRU', 'Nauru', 'Oceania', 'Micronesia', 'Naoero/Nauru', 'NR'),
('NZL', 'New Zealand', 'Oceania', 'Australia and New Zealand', 'New Zealand/Aotearoa', 'NZ'),
('OMN', 'Oman', 'Asia', 'Middle East', 'Ã‚Â´Uman', 'OM'),
('PAK', 'Pakistan', 'Asia', 'Southern and Central Asia', 'Pakistan', 'PK'),
('PAN', 'Panama', 'North America', 'Central America', 'PanamÃƒÂ¡', 'PA'),
('PCN', 'Pitcairn', 'Oceania', 'Polynesia', 'Pitcairn', 'PN'),
('PER', 'Peru', 'South America', 'South America', 'PerÃƒÂº/Piruw', 'PE'),
('PHL', 'Philippines', 'Asia', 'Southeast Asia', 'Pilipinas', 'PH'),
('PLW', 'Palau', 'Oceania', 'Micronesia', 'Belau/Palau', 'PW'),
('PNG', 'Papua New Guinea', 'Oceania', 'Melanesia', 'Papua New Guinea/Papua Niugini', 'PG'),
('POL', 'Poland', 'Europe', 'Eastern Europe', 'Polska', 'PL'),
('PRI', 'Puerto Rico', 'North America', 'Caribbean', 'Puerto Rico', 'PR'),
('PRK', 'North Korea', 'Asia', 'Eastern Asia', 'Choson Minjujuui InÃ‚Â´min Konghwaguk (Bukhan', 'KP'),
('PRT', 'Portugal', 'Europe', 'Southern Europe', 'Portugal', 'PT'),
('PRY', 'Paraguay', 'South America', 'South America', 'Paraguay', 'PY'),
('PSE', 'Palestine', 'Asia', 'Middle East', 'Filastin', 'PS'),
('PYF', 'French Polynesia', 'Oceania', 'Polynesia', 'PolynÃƒÂ©sie franÃƒÂ§aise', 'PF'),
('QAT', 'Qatar', 'Asia', 'Middle East', 'Qatar', 'QA'),
('REU', 'RÃƒÂ©union', 'Africa', 'Eastern Africa', 'RÃƒÂ©union', 'RE'),
('ROM', 'Romania', 'Europe', 'Eastern Europe', 'RomÃƒÂ¢nia', 'RO'),
('RUS', 'Russian Federation', 'Europe', 'Eastern Europe', 'Rossija', 'RU'),
('RWA', 'Rwanda', 'Africa', 'Eastern Africa', 'Rwanda/Urwanda', 'RW'),
('SAU', 'Saudi Arabia', 'Asia', 'Middle East', 'Al-Ã‚Â´Arabiya as-SaÃ‚Â´udiya', 'SA'),
('SDN', 'Sudan', 'Africa', 'Northern Africa', 'As-Sudan', 'SD'),
('SEN', 'Senegal', 'Africa', 'Western Africa', 'SÃƒÂ©nÃƒÂ©gal/Sounougal', 'SN'),
('SGP', 'Singapore', 'Asia', 'Southeast Asia', 'Singapore/Singapura/Xinjiapo/Singapur', 'SG'),
('SGS', 'South Georgia and the South Sandwich Islands', 'Antarctica', 'Antarctica', 'South Georgia and the South Sandwich Islands', 'GS'),
('SHN', 'Saint Helena', 'Africa', 'Western Africa', 'Saint Helena', 'SH'),
('SJM', 'Svalbard and Jan Mayen', 'Europe', 'Nordic Countries', 'Svalbard og Jan Mayen', 'SJ'),
('SLB', 'Solomon Islands', 'Oceania', 'Melanesia', 'Solomon Islands', 'SB'),
('SLE', 'Sierra Leone', 'Africa', 'Western Africa', 'Sierra Leone', 'SL'),
('SLV', 'El Salvador', 'North America', 'Central America', 'El Salvador', 'SV'),
('SMR', 'San Marino', 'Europe', 'Southern Europe', 'San Marino', 'SM'),
('SOM', 'Somalia', 'Africa', 'Eastern Africa', 'Soomaaliya', 'SO'),
('SPM', 'Saint Pierre and Miquelon', 'North America', 'North America', 'Saint-Pierre-et-Miquelon', 'PM'),
('STP', 'Sao Tome and Principe', 'Africa', 'Central Africa', 'SÃƒÂ£o TomÃƒÂ© e PrÃƒÂ­ncipe', 'ST'),
('SUR', 'Suriname', 'South America', 'South America', 'Suriname', 'SR'),
('SVK', 'Slovakia', 'Europe', 'Eastern Europe', 'Slovensko', 'SK'),
('SVN', 'Slovenia', 'Europe', 'Southern Europe', 'Slovenija', 'SI'),
('SWE', 'Sweden', 'Europe', 'Nordic Countries', 'Sverige', 'SE'),
('SWZ', 'Swaziland', 'Africa', 'Southern Africa', 'kaNgwane', 'SZ'),
('SYC', 'Seychelles', 'Africa', 'Eastern Africa', 'Sesel/Seychelles', 'SC'),
('SYR', 'Syria', 'Asia', 'Middle East', 'Suriya', 'SY'),
('TCA', 'Turks and Caicos Islands', 'North America', 'Caribbean', 'The Turks and Caicos Islands', 'TC'),
('TCD', 'Chad', 'Africa', 'Central Africa', 'Tchad/Tshad', 'TD'),
('TGO', 'Togo', 'Africa', 'Western Africa', 'Togo', 'TG'),
('THA', 'Thailand', 'Asia', 'Southeast Asia', 'Prathet Thai', 'TH'),
('TJK', 'Tajikistan', 'Asia', 'Southern and Central Asia', 'ToÃƒÂ§ikiston', 'TJ'),
('TKL', 'Tokelau', 'Oceania', 'Polynesia', 'Tokelau', 'TK'),
('TKM', 'Turkmenistan', 'Asia', 'Southern and Central Asia', 'TÃƒÂ¼rkmenostan', 'TM'),
('TMP', 'East Timor', 'Asia', 'Southeast Asia', 'Timor Timur', 'TP'),
('TON', 'Tonga', 'Oceania', 'Polynesia', 'Tonga', 'TO'),
('TTO', 'Trinidad and Tobago', 'North America', 'Caribbean', 'Trinidad and Tobago', 'TT'),
('TUN', 'Tunisia', 'Africa', 'Northern Africa', 'Tunis/Tunisie', 'TN'),
('TUR', 'Turkey', 'Asia', 'Middle East', 'TÃƒÂ¼rkiye', 'TR'),
('TUV', 'Tuvalu', 'Oceania', 'Polynesia', 'Tuvalu', 'TV'),
('TWN', 'Taiwan', 'Asia', 'Eastern Asia', 'TÃ¢â‚¬â„¢ai-wan', 'TW'),
('TZA', 'Tanzania', 'Africa', 'Eastern Africa', 'Tanzania', 'TZ'),
('UGA', 'Uganda', 'Africa', 'Eastern Africa', 'Uganda', 'UG'),
('UKR', 'Ukraine', 'Europe', 'Eastern Europe', 'Ukrajina', 'UA'),
('UMI', 'United States Minor Outlying Islands', 'Oceania', 'Micronesia/Caribbean', 'United States Minor Outlying Islands', 'UM'),
('URY', 'Uruguay', 'South America', 'South America', 'Uruguay', 'UY'),
('USA', 'United States', 'North America', 'North America', 'United States', 'US'),
('UZB', 'Uzbekistan', 'Asia', 'Southern and Central Asia', 'Uzbekiston', 'UZ'),
('VAT', 'Holy See (Vatican City State)', 'Europe', 'Southern Europe', 'Santa Sede/CittÃƒ  del Vaticano', 'VA'),
('VCT', 'Saint Vincent and the Grenadines', 'North America', 'Caribbean', 'Saint Vincent and the Grenadines', 'VC'),
('VEN', 'Venezuela', 'South America', 'South America', 'Venezuela', 'VE'),
('VGB', 'Virgin Islands, British', 'North America', 'Caribbean', 'British Virgin Islands', 'VG'),
('VIR', 'Virgin Islands, U.S.', 'North America', 'Caribbean', 'Virgin Islands of the United States', 'VI'),
('VNM', 'Vietnam', 'Asia', 'Southeast Asia', 'ViÃƒÂªt Nam', 'VN'),
('VUT', 'Vanuatu', 'Oceania', 'Melanesia', 'Vanuatu', 'VU'),
('WLF', 'Wallis and Futuna', 'Oceania', 'Polynesia', 'Wallis-et-Futuna', 'WF'),
('WSM', 'Samoa', 'Oceania', 'Polynesia', 'Samoa', 'WS'),
('YEM', 'Yemen', 'Asia', 'Middle East', 'Al-Yaman', 'YE'),
('YUG', 'Yugoslavia', 'Europe', 'Southern Europe', 'Jugoslavija', 'YU'),
('ZAF', 'South Africa', 'Africa', 'Southern Africa', 'South Africa', 'ZA'),
('ZMB', 'Zambia', 'Africa', 'Eastern Africa', 'Zambia', 'ZM'),
('ZWE', 'Zimbabwe', 'Africa', 'Eastern Africa', 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE IF NOT EXISTS `employers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(5) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `application_email` varchar(255) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `secondary_contact` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `industry` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `postal` int(11) NOT NULL,
  `country` varchar(5) NOT NULL,
  `company_size` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `guid` text,
  `unique_folder` varchar(255) NOT NULL,
  `logo_path` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_advertiser_user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `title`, `first_name`, `last_name`, `application_email`, `contact`, `secondary_contact`, `fax`, `company`, `industry`, `address`, `address_2`, `suburb`, `postal`, `country`, `company_size`, `user_id`, `updated_at`, `created_at`, `guid`, `unique_folder`, `logo_path`) VALUES
(1, 'Mr', 'Damien', 'Koh', 'victorlim86@gmail.com', '0430131395', '0430131395', '0430131395', 'CareersHire', '', '123 Durham Street', 'St Lucia', 'St Lucia', 4067, '0', '30-40', 1, NULL, NULL, NULL, '8af479d69c80b60de952bf2cc565772f', ''),
(7, 'Mr', 'Damien', 'Koh123', 'victorlim86@gmail.com', '0430131395', NULL, '123456789', 'careershire', 'information tech', '159 Hellawell Road123', '', 'Sunnybank Hills', 2147483647, 'AUS', '>200', 11, '2013-03-23 07:47:09', '2013-01-27 02:41:35', NULL, '8af479d69c80b60de952bf2cc565772f', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/company-logo/Logo.png'),
(8, 'Mr', 'Damien', 'KOh', 'victorlim86@gmail.com', '61430131395', NULL, '', 'test', 'test', '159 Hellawell Road', '', 'Sunnybank Hills', 4109, 'AUS', '0', 12, '2013-03-13 11:35:25', '2013-03-13 11:35:25', NULL, '8af479d69c80b60de952bf2cc565772f', ''),
(9, 'Mr', 'Damien', 'Koh', 'victorlim86@gmail.com', '61430131395', NULL, '', 'test', 'test', '159 Hellawell Road', '', 'Sunnybank Hills', 4109, 'AUS', '0', 13, '2013-03-13 11:56:05', '2013-03-13 11:56:05', NULL, '52e271470da25b752444aa4cbe911562', ''),
(10, 'Mr', 'Damien', 'Koh', 'victorlim86@gmail.com', '61430131395', NULL, '', 'test', 'test', '159 Hellawell Road', '', 'Sunnybank Hills', 4109, 'AUS', '0', 14, '2013-03-13 11:57:02', '2013-03-13 11:57:02', NULL, 'f0b5368d5959f601db634e1f13c857c9', ''),
(11, 'Mr', 'Damien', 'Koh', 'victorlim86@gmail.com', '61430131395', NULL, '', 'test', 'test', '159 Hellawell Road', '', 'Sunnybank Hills', 4109, 'AUS', '0', 15, '2013-03-13 12:38:14', '2013-03-13 12:38:14', NULL, 'afd2d09de5087e89465850ed2c646946', ''),
(12, 'Ms', 'test', 'Koh', 'victorlim86@gmail.com', '61430131395', NULL, '', 'test', 'test', '159 Hellawell Road', '', 'Sunnybank Hills', 4109, 'AUS', '0', 16, '2013-03-13 12:38:56', '2013-03-13 12:38:56', NULL, '72a3dcef165d9122a45decf13ae20631', ''),
(13, 'Mr', 'Victor', 'Lim', 'victorlim86@gmail.com', '043212345', NULL, '', 'Brightlabs', 'IT', '13/612 Sherwood Road', 'SHERWOOD', 'Brisbane', 4075, 'AUS', '0', 19, '2013-03-23 08:11:41', '2013-03-23 08:11:41', NULL, 'ffc150a160d37e92012c196b6af4160d', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `more_info` varchar(45) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `min_salary` decimal(10,0) DEFAULT NULL,
  `max_salary` decimal(10,0) DEFAULT NULL,
  `salary_range` varchar(45) NOT NULL,
  `payment_structure` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL,
  `sub_location_id` int(11) DEFAULT NULL,
  `employer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `end_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `template_id` int(11) NOT NULL,
  `work_type` varchar(100) NOT NULL,
  `apply` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_job_category_idx` (`category_id`),
  KEY `fk_job_sub_categor_idx` (`sub_category_id`),
  KEY `fk_advertiser_job_idx` (`employer_id`),
  KEY `fk_job_location_idx` (`location_id`),
  FULLTEXT (title,description,summary)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `summary`, `description`, `more_info`, `video`, `contact`, `category_id`, `sub_category_id`, `min_salary`, `max_salary`, `salary_range`, `payment_structure`, `location_id`, `sub_location_id`, `employer_id`, `created_at`, `updated_at`, `end_at`, `status`, `template_id`, `work_type`, `apply`) VALUES
(2, 'ASP .NET Developer ** 3 + 6 months contract **123123123', 'Talent International -Voted SARA’s Best Large IT Recruiter 2011/12 - SEEK Awards\r\n** Convenient long term contract to start 2013 ** Commence date: Mid Jan ** CBD Location **', '<p><strong>PERMANENT FULL-TIME ROLE INNOVATIVE &amp; GROWING SOFTWARE AS A SERVICE COMPANY NEW OFFICES IN TECHNOLOGY PRECINCT ON CITY FRINGE </strong></p>\r\n\r\n<p><strong><img alt="" src="http://www.smithink2020.com/files/images/content/Business%20Advisory%20Conference/MYP%20Logo%20Web.png" style="width: 130px; height: 130px;" /></strong></p>\r\n\r\n<p>MYP Corporation (MYPCorp) provides online business tools and information to Advisers to business, SMEs and educational organisations internationally. With a reputation for innovation and quality, we are seeking an IT Developer (AD) to join our dynamic team. Based conveniently on Brisbane&rsquo;s south east and reporting to the Director - Operations, you will work with a growing team of Developers providing exceptional development solutions:</p>\r\n\r\n<p>Applications Development</p>\r\n\r\n<p>(C#, ASP.NET Framework 4, Visual Studio 2010; HTML;&nbsp;<br />\r\n<span style="line-height: 1.6em;">Subversion and Tortoise SVN;<br />\r\nASP; Javascript;&nbsp;PHP, MySQL) </span></p>\r\n\r\n<p><br />\r\n<span style="line-height: 1.6em;">Report Development (Microsoft Reporting Services 2008)<br />\r\nBusiness Database Systems Development (SQL Server, MS-Access, Excel, Outlook, Word, PowerPoint VBA applications) </span></p>\r\n\r\n<p><span style="line-height: 1.6em;">Application programming interface (API) development.<br />\r\nWe are seeking an intelligent, highly motivated, experienced and innovative IT Developer (AD) with advanced technical skills and a genuine interest in business intelligence and analysis. If you are looking for a long-term career opportunity in a fast growing, positive, focused and solutions based environment, this is an opportunity for you. </span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style="line-height: 1.6em;">Please forward your application in confidence to Jenny Eager (Director &ndash; Operations).</span></p>\r\n', 'Lorem ipsum dolor sit amet, orci nam sed erat', NULL, 'zlkoh.damien@gmail.com', 15, NULL, '40000', '50000', '$40000 - $50000', 'weekly', 2, 0, 7, '2012-11-28 00:00:00', '2013-03-30 23:54:42', '2013-04-04 00:00:00', 1, 31, 'FT', ''),
(3, 'PHP WEB APPLICATION DEVELOPERS', 'A PHP successful, secure business within the Banking and Financial Industry, based city fringe', 'PERMANENT FULL-TIME ROLE\nINNOVATIVE & GROWING SOFTWARE AS A SERVICE COMPANY\nNEW OFFICES IN TECHNOLOGY PRECINCT ON CITY FRINGE\n \nMYP Corporation (MYPCorp) provides online business tools and information to Advisers to business, SMEs and educational organisations internationally.  With a reputation for innovation and quality, we are seeking an IT Developer (AD) to join our dynamic team.\n \nBased conveniently on Brisbane’s south east and reporting to the Director - Operations, you will work with a growing team of Developers providing exceptional development solutions:\n \nApplications Development (C#, ASP.NET Framework 4, Visual Studio 2010; HTML; Subversion and Tortoise SVN; ASP; Javascript; PHP, MySQL)\nReport Development (Microsoft Reporting Services 2008)\nBusiness Database Systems Development (SQL Server, MS-Access, Excel, Outlook, Word, PowerPoint VBA applications)\nApplication programming interface (API) development\n \nWe are seeking an intelligent, highly motivated, experienced and innovative IT Developer (AD) with advanced technical skills and a genuine interest in business intelligence and analysis.  If you are looking for a long-term career opportunity in a fast growing, positive, focused and solutions based environment, this is an opportunity for you.\n \nPlease forward your application in confidence to Jenny Eager (Director – Operations).', 'Represent one of the world''s most recognised ', NULL, 'zlkoh.damien@gmail.com', 15, NULL, '44000', '55000', '$44000 - $55000', 'Weekly', 2, NULL, 7, '2012-11-28 00:00:00', '2013-04-11 13:00:27', '2013-05-31 08:20:16', 1, 1, 'PT', ''),
(4, 'Junior / Graduate SharePoint Developer', 'Sharepoint Developer 3 months Adelaide based', 'c++', 'Represent one of the world''s most recognised ', NULL, 'zlkoh.damien@gmail.com', 15, 1, '44000', '55000', '$44000 - $55000', 'Monthly', 2, 0, 7, '2012-11-28 00:00:00', '2013-02-24 04:24:13', '2013-04-02 00:00:00', 1, 1, 'SW', ''),
(5, '.NET DEVELOPER', 'Incredible opportunity for a Junior SharePoint developer to join a leading software company, receive ongoing training and liaise with clients.', 'php', NULL, NULL, 'zlkoh.damien@gmail.com', 15, 2, '44000', '55000', '$44000 - $55000', 'Fortnightly', 2, 1, 7, '2012-11-28 00:00:00', '2013-02-24 04:24:13', '2013-04-03 00:00:00', 1, 1, 'CIH', ''),
(7, 'title', 'intro', '<p>test</p>\r\n', 'more-info', 'video', 'contact', 15, 1, '12', '12', 'salary-range', 'weekly', 1, 0, 7, '2013-02-20 13:42:02', '2013-02-24 04:24:13', NULL, 0, 1, '', ''),
(8, 'BUB Advertisement', 'intro', '<p>dfasfdas</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '123123', '32132131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:15:49', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(9, 'title', 'intro', '<p>gsfgfsd</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '234', '234', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:17:09', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(10, 'title', 'intro', '<p>fdas</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '321', '21', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:44:11', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(11, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:23:47', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(12, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:24:17', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(13, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:24:44', '2013-03-30 06:18:48', NULL, 0, 1, '', ''),
(14, 'titleafdsfdsadsfasdfaasdf', 'intro', '<p>fdsa</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '123123', '32131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:28:17', '2013-03-10 05:28:17', NULL, 0, 0, '', ''),
(15, 'titlefasfdaf', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '32131', '2131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:30:21', '2013-03-10 05:30:21', NULL, 0, 0, '', ''),
(16, 'titlefasfdaf', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '32131', '2131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:36:57', '2013-03-10 05:36:57', NULL, 0, 0, '', ''),
(17, 'title', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '321', '321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:51:58', '2013-03-10 05:58:53', NULL, 0, 1, '', ''),
(18, 'title', 'intro', '<p>fasfsad</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '32131', '3123', '321321', 'weekly', 1, 11, 7, '2013-03-10 11:56:37', '2013-03-17 06:00:06', '2013-04-03 23:00:00', 1, 1, '', ''),
(19, 'da', 'intro', '<p>desc</p>\r\n', 'more-info', 'video', 'contact', 1, 0, '321321', '321321312', '21321', 'weekly', 1, 0, 7, '2013-03-10 12:22:12', '2013-03-17 06:00:06', '2013-04-10 12:22:12', 1, 1, '', ''),
(21, 'New Job', 'test', '<p>test</p>\r\n', 'testset', 'test', 'test', 15, 2, '40000', '70000', '$40000 - $70000', 'fortnightly', 2, 1, 7, '2013-03-29 13:51:20', '2013-03-30 06:18:48', '2013-04-29 13:51:20', 1, 1, 'CIH', 'http://www.google.com'),
(22, 'titlefdsafdsa', 'introfdsafdsa', '<p>fafdsa</p>\r\n', 'more-info', 'video', 'contact', 15, 1, '0', '30000', '$0 - $30000', 'weekly', 1, 11, 7, '2013-03-29 13:57:41', '2013-03-29 13:57:41', '2013-04-29 13:57:41', 1, 1, 'PT', ''),
(23, 'title', '<p>afdsafa</p>\r\n', '<p>safdsf</p>\r\n', 'more-info', '', 'contact', 15, 4, '123', '123123', '$123 - $123123', 'weekly', 1, 11, 7, '2013-04-14 14:07:10', '2013-04-14 14:07:10', '2013-05-14 14:07:10', 1, 1, 'PT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE IF NOT EXISTS `job_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `name`) VALUES
(1, 'Accounting, Banking & Financial'),
(2, 'Administration & General Office Work'),
(3, 'Advertising'),
(4, 'Customer Service & Support'),
(5, 'Top Management'),
(6, 'Community Services & Development'),
(7, 'Consulting & Strategy'),
(8, 'Education & Academic'),
(9, 'Engineering'),
(10, 'Farming, Animal & Conservation'),
(11, 'Government Sector'),
(12, 'Healthcare & Medical'),
(13, 'Hospitality & Tourism'),
(14, 'Human Resource & Recuritment'),
(15, 'Information Technology & Software Engineering'),
(16, 'Insurance'),
(17, 'Legal'),
(18, 'Manufacturing'),
(19, 'Sales & Marketing'),
(20, 'Real Estate'),
(21, 'R&D and Science'),
(22, 'Self Employment'),
(23, 'Sports & Recreation'),
(24, 'Construction, Trades & Services'),
(25, 'Arts, Media'),
(26, 'Transport'),
(27, 'Logistic'),
(28, 'Communications'),
(29, 'Design & Architecture'),
(30, 'Graduates Program');

-- --------------------------------------------------------

--
-- Table structure for table `job_sub_category`
--

CREATE TABLE IF NOT EXISTS `job_sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_sub_category`
--

INSERT INTO `job_sub_category` (`id`, `category_id`, `name`) VALUES
(1, 15, 'Web Developer'),
(2, 15, 'Web Designer'),
(3, 15, 'Project Manager'),
(4, 15, 'Scrum Master'),
(5, 15, 'Programmer'),
(6, 15, 'Developer'),
(7, 15, 'Software Engineer'),
(8, 15, 'Network Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `country_code` char(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_country_idx` (`country_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `state`, `country_code`) VALUES
(1, 'Adelaide', 'SA', 'AUS'),
(2, 'Brisbane', 'QLD', 'AUS'),
(3, 'Canberra', 'ACT', 'AUS'),
(4, 'Darwin', 'QLD', 'AUS'),
(5, 'Gold Coast', 'QLD', 'AUS'),
(6, 'Hobart', 'QLD', 'AUS'),
(7, 'Melbourne', 'VIC', 'AUS'),
(8, 'Perth', 'WA', 'AUS'),
(9, 'Sydney', 'NSW', 'AUS');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `price`, `name`, `status`) VALUES
(1, 179.99, 'normal', 'not-active'),
(2, 99.99, 'discounted', 'not-active'),
(3, 10, 'Tester', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'employer'),
(2, 'applicant'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `sub_locations`
--

CREATE TABLE IF NOT EXISTS `sub_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subloc_location_idx` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `sub_locations`
--

INSERT INTO `sub_locations` (`id`, `location_id`, `name`) VALUES
(1, 2, 'Brisbane CBD'),
(2, 2, 'Brisbane North East'),
(4, 2, 'Brisbane North West'),
(5, 2, 'Brisbane Region'),
(6, 2, 'Brisbane South East'),
(8, 2, 'Brisbane South West'),
(9, 2, 'East Brisbane'),
(10, 2, 'South Brisbane'),
(11, 1, 'Adelaide CBD'),
(12, 1, 'Adelaide City'),
(13, 1, 'Adelaide Hills'),
(14, 1, 'North Adelaide'),
(15, 3, 'Canberra Region'),
(16, 3, 'North Canberra'),
(17, 3, 'South Canberra'),
(18, 4, 'Darwin CBD'),
(19, 4, 'Darwin City'),
(20, 4, 'Darwin Region'),
(21, 4, 'Charles Darwin'),
(22, 5, 'Gold Coast City'),
(23, 5, 'Gold Coast North'),
(24, 5, 'Gold Coast Region'),
(25, 5, 'Gold Coast South'),
(26, 5, 'Gold Coast West'),
(27, 6, 'Hobart CBD'),
(28, 6, 'Hobart City'),
(29, 6, 'Hobart Region'),
(30, 6, 'North Hobart'),
(31, 6, 'South Hobart'),
(32, 6, 'West Hobart'),
(33, 7, 'East Melbourne'),
(34, 7, 'Melbourne CBD'),
(35, 7, 'Melbourne City'),
(36, 7, 'Melbourne REgion'),
(37, 7, 'North Melbourne'),
(38, 7, 'Port Melbourne'),
(39, 7, 'South Melbourne'),
(40, 7, 'West Melbourne'),
(41, 8, 'East Perth'),
(42, 8, 'North Perth'),
(43, 8, 'Perth CBD'),
(44, 8, 'Perth Region'),
(45, 8, 'South Perth Area'),
(46, 8, 'West Perth'),
(47, 9, 'Inner Sydney'),
(48, 9, 'North Sydney'),
(49, 9, 'Sydney CBD'),
(50, 9, 'Sydney Region');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `css` text,
  `header` text,
  `body` text,
  `footer` text,
  `name` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `css`, `header`, `body`, `footer`, `name`, `data`, `updated_at`, `created_at`) VALUES
(1, '.notice-container > header {\n /*HEADER-BACKGROUND-REPEAT*/\n  /*HEADER-BACKGROUND-IMAGE*/\n /*HEADER-BACKGROUND-POSITION*/\n  text-align: center;\n margin-bottom: 5px;\n overflow: hidden;\n /*TEXT-ALIGN*/\n}\n\n.notice-container > header > h1 {\n  display: inline;\n}\n\n.notice-container > article {\n  /*BODY-BACKGROUND-REPEAT*/\n  /*BODY-BACKGROUND-IMAGE*/\n /*BODY-BACKGROUND-POSITION*/\n  height: auto;\n margin-bottom: 5px;\n}\n\n.notice-container > footer {\n  /*FOOTER-BACKGROUND-REPEAT*/\n  /*FOOTER-BACKGROUND-IMAGE*/\n /*FOOTER-BACKGROUND-POSITION*/\n  height: 50px;\n margin-bottom: 5px;\n}\n.notice-container > header, .notice-container > article, .notice-container > footer {\n padding: 40px;\n  width: 100%;\n  -webkit-box-sizing: border-box;\n -moz-box-sizing: border-box;\n  box-sizing: border-box;\n}\n', NULL, NULL, NULL, 'Default', '', NULL, NULL),
(31, '.notice-container > header {\n  background-repeat: repeat-x;\n  background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/mastercard.png);\n  background-position: center ;\n text-align: center;\n margin-bottom: 5px;\n overflow: hidden;\n text-align: left;\n}\n\n.notice-container > header > h1 {\n display: inline;\n}\n\n.notice-container > article {\n  background-repeat: no-repeat;\n background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/template-icons.png);\n  background-position: center ;\n height: auto;\n margin-bottom: 5px;\n}\n\n.notice-container > footer {\n  \n  background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png);\n  \n  height: 50px;\n margin-bottom: 5px;\n}\n.notice-container > header, .notice-container > article, .notice-container > footer {\n padding: 40px;\n  width: 100%;\n  -webkit-box-sizing: border-box;\n -moz-box-sizing: border-box;\n  box-sizing: border-box;\n}\n', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/mastercard.png', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/template-icons.png', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png', 'test template', 'a:10:{s:17:"header_text_align";s:4:"left";s:13:"header_repeat";s:8:"repeat-x";s:15:"header_position";s:6:"center";s:11:"body_repeat";s:9:"no-repeat";s:13:"body_position";s:6:"center";s:13:"footer_repeat";s:0:"";s:15:"footer_position";s:0:"";s:17:"header_background";s:84:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/mastercard.png";s:15:"body_background";s:86:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/template-icons.png";s:17:"footer_background";s:78:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png";}', '2013-03-30 07:38:04', '2013-03-30 07:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `gateway_txn_id` varchar(255) DEFAULT NULL,
  `gateway_txn_type` varchar(255) DEFAULT NULL,
  `gateway_txn_status` varchar(255) DEFAULT NULL,
  `gateway_txn_message` varchar(255) DEFAULT NULL,
  `local_currency_code` varchar(255) DEFAULT NULL,
  `gateway_pending_reason` varchar(255) DEFAULT NULL,
  `gateway_fee_amt` varchar(255) DEFAULT NULL,
  `gateway_tax_amt` varchar(255) DEFAULT NULL,
  `gateway_error_code` varchar(255) DEFAULT NULL,
  `gateway_ack` varchar(255) DEFAULT NULL,
  `gateway_timestamp` varchar(255) DEFAULT NULL,
  `cc_type` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `gateway_request` text,
  `gateway_cc_num` char(16) DEFAULT NULL,
  `invoice_ref` varchar(45) DEFAULT NULL,
  `invoice_desc` text,
  `processor` varchar(45) DEFAULT NULL,
  `processor_txid` varchar(45) DEFAULT NULL,
  `processor_msg` varchar(45) DEFAULT NULL,
  `process_time` varchar(45) DEFAULT NULL,
  `curl_error_num` varchar(45) DEFAULT NULL,
  `curl_error_msg` varchar(45) DEFAULT NULL,
  `request_data` text,
  `response_data` text,
  `ip` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `address_2` varchar(45) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `cc_name` varchar(45) DEFAULT NULL,
  `cc_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`employer_id`,`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `employer_id`, `job_id`, `payment_type`, `created_at`, `updated_at`, `gateway_txn_id`, `gateway_txn_type`, `gateway_txn_status`, `gateway_txn_message`, `local_currency_code`, `gateway_pending_reason`, `gateway_fee_amt`, `gateway_tax_amt`, `gateway_error_code`, `gateway_ack`, `gateway_timestamp`, `cc_type`, `amount`, `currency_code`, `gateway_request`, `gateway_cc_num`, `invoice_ref`, `invoice_desc`, `processor`, `processor_txid`, `processor_msg`, `process_time`, `curl_error_num`, `curl_error_msg`, `request_data`, `response_data`, `ip`, `title`, `first_name`, `surname`, `address`, `address_2`, `suburb`, `state`, `postcode`, `country`, `phone`, `mobile`, `cc_name`, `cc_number`) VALUES
(2, 7, 14, 'PAYPAL', '2013-03-10 05:28:17', '2013-03-10 05:28:17', '1TE61867G7133023X', 'expresscheckout', 'Completed', '1TE61867G7133023X', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '', '', 179.99, '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 7, 16, 'PAYPAL', '2013-03-10 05:36:57', '2013-03-10 05:36:57', '5GA43255ET586972D', 'expresscheckout', 'Completed', '5GA43255ET586972D', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-10T05:36:58Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 7, 17, 'PAYPAL', '2013-03-10 05:51:58', '2013-03-10 05:51:58', '0RX59038JL906892H', 'expresscheckout', 'Completed', '0RX59038JL906892H', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-10T05:51:58Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 7, 18, 'PAYPAL', '2013-03-10 11:56:37', '2013-03-10 11:56:37', '9F5369987M144415F', 'expresscheckout', 'Completed', '9F5369987M144415F', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-10T11:56:38Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 7, 19, 'PAYPAL', '2013-03-10 12:22:12', '2013-03-10 12:22:12', '7YF43478RR791563G', 'expresscheckout', 'Completed', '7YF43478RR791563G', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-10T12:22:13Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 7, 20, 'PAYPAL', '2013-03-17 06:13:05', '2013-03-17 06:13:05', '5TW62156JB8219922', 'expresscheckout', 'Completed', '5TW62156JB8219922', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-17T06:13:06Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 7, 21, 'PAYPAL', '2013-03-29 13:51:20', '2013-03-29 13:51:20', '00P04983MH7385924', 'expresscheckout', 'Completed', '00P04983MH7385924', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-29T13:51:24Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 7, 22, 'PAYPAL', '2013-03-29 13:57:41', '2013-03-29 13:57:41', '6EX69307591166815', 'expresscheckout', 'Completed', '6EX69307591166815', 'AUD', 'None', '6.42', '0.00', '0', 'Success', '2013-03-29T13:57:45Z', '', 179.99, 'AUD', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 0, 0, 'CREDIT CARD', NULL, NULL, '', '', 'DECLINED', '', '', '', '', '', '', '', '', '', 179.99, '', '', '', 'CSH-AU-000001', 'title', 'EWay w/ CVN (Test mode)', '10416', 'Error: Invalid credit card provided. Your cre', '1365947642', '0', '', '<ewaygateway>\r\n  <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>17999</ewayTotalAmount>\r\n  <ewayCustomerFirstName>fdsafsa</ewayCustomerFirstName>\r\n  <ewayCustomerLastName>fdsafsa</ewayCustomerLastName>\r\n  <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>0</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>title</ewayCustomerInvoiceDescription>\r\n  <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>fsafsafd</ewayCardHoldersName>\r\n <ewayCardNumber>1232XXXXXXXX</ewayCardNumber>\r\n <ewayCardExpiryMonth>02</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>14</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>False</ewayTrxnStatus><ewayTrxnNumber>10416</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode/><ewayReturnAmount>17999</ewayReturnAmount><ewayTrxnError>Error: Invalid credit card provided. Your credit card has not been billed for this transaction.(Test CVN Gateway)Card Data Sent: 1232132123</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'fdsafsa', 'fdsafsa', '0', '', 'safdsafdsa', 'fdsafdsa', '', 'ABW', 'fdsafsadsa', '', 'fsafsafd', 'Invalid Card number. Credit card number is to'),
(11, 0, 0, 'CREDIT CARD', NULL, NULL, '', '', 'DECLINED', '', '', '', '', '', '', '', '', '', 179.99, '', '', '', 'CSH-AU-000001', 'title', 'EWay w/ CVN (Test mode)', '21102', '99,Do Not Honour(Test CVN Gateway)', '1365948263', '0', '', '<ewaygateway>\r\n <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>17999</ewayTotalAmount>\r\n  <ewayCustomerFirstName>Damien</ewayCustomerFirstName>\r\n <ewayCustomerLastName>KOh</ewayCustomerLastName>\r\n  <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>159</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>title</ewayCustomerInvoiceDescription>\r\n  <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>Damien Koh</ewayCardHoldersName>\r\n <ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n <ewayCardExpiryMonth>01</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>15</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>False</ewayTrxnStatus><ewayTrxnNumber>21102</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>17999</ewayReturnAmount><ewayTrxnError>99,Do Not Honour(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'Damien', 'KOh', '159 Hellawell Road', '', 'Sunnybank Hills', 'Queensland', '', 'AUS', '0430131395', '', 'Damien Koh', '4444XXXXXXXX1111'),
(12, 0, 0, 'CREDIT CARD', NULL, NULL, '', '', 'DECLINED', '', '', '', '', '', '', '', '', '', 179.99, '', '', '', 'CSH-AU-000001', 'title', 'EWay w/ CVN (Test mode)', '20690', '99,Do Not Honour(Test CVN Gateway)', '1365948308', '0', '', '<ewaygateway>\r\n <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>17999</ewayTotalAmount>\r\n  <ewayCustomerFirstName>fdsafdsa</ewayCustomerFirstName>\r\n <ewayCustomerLastName>ffadsfdsa</ewayCustomerLastName>\r\n  <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>0</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>title</ewayCustomerInvoiceDescription>\r\n  <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>fdsafadsasdf</ewayCardHoldersName>\r\n <ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n <ewayCardExpiryMonth>01</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>14</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>False</ewayTrxnStatus><ewayTrxnNumber>20690</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>17999</ewayReturnAmount><ewayTrxnError>99,Do Not Honour(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'fdsafdsa', 'ffadsfdsa', '0', '', 'fsdafsdf', 'dfssdfa', '', 'ABW', 'fdssdfa', '', 'fdsafadsasdf', '4444XXXXXXXX1111'),
(13, 7, 23, 'CREDIT CARD', NULL, NULL, '', '', 'APPROVED', '', '', '', '', '', '', '', '', '', 10, '', '', '', 'CSH-AU-000001', 'title', 'EWay w/ CVN (Test mode)', '20695', '00,Transaction Approved(Test CVN Gateway)', '1365948430', '0', '', '<ewaygateway>\r\n <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>1000</ewayTotalAmount>\r\n <ewayCustomerFirstName>fdsafdsa</ewayCustomerFirstName>\r\n <ewayCustomerLastName>ffadsfdsa</ewayCustomerLastName>\r\n  <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>0</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>title</ewayCustomerInvoiceDescription>\r\n  <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>fdsafadsasdf</ewayCardHoldersName>\r\n <ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n <ewayCardExpiryMonth>01</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>14</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>20695</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'fdsafdsa', 'ffadsfdsa', '0', '', 'fsdafsdf', 'dfssdfa', '', 'ABW', 'fdssdfa', '', 'fdsafadsasdf', '4444XXXXXXXX1111'),
(14, 7, 24, 'PAYPAL', '2013-04-15 09:45:30', '2013-04-15 09:45:30', '0B1971012D051112S', 'expresscheckout', 'Completed', '0B1971012D051112S', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-04-15T09:45:30Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 7, 25, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', '312312123231', 'EWay w/ CVN (Test mode)', '21027', '00,Transaction Approved(Test CVN Gateway)', '1366019241', '0', '', '<ewaygateway>\r\n  <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>1000</ewayTotalAmount>\r\n <ewayCustomerFirstName>231321231</ewayCustomerFirstName>\r\n  <ewayCustomerLastName>23112213</ewayCustomerLastName>\r\n <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>21321321123231213</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>312312123231</ewayCustomerInvoiceDescription>\r\n <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>fdsaadfsfdsaf</ewayCardHoldersName>\r\n  <ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n <ewayCardExpiryMonth>10</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>31</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>21027</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', '231321231', '23112213', '21321321123231213', NULL, '213231213', '123231231', '', 'AZE', '312213213', NULL, 'fdsaadfsfdsaf', '4444XXXXXXXX1111');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `old_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_user_roles_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `old_email`, `password`, `salt`, `role_id`, `guid`, `created_at`, `updated_at`) VALUES
(11, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5e258a2748.32488991', '2013-01-27 02:41:35', '2013-03-23 07:47:49'),
(12, 'zlkoh', 'zlkoh.damien@gmail.com', '', '$2a$08$w2//UxVPMsYgytVFPJ4/y.0am/o46vvuHuPgAna7PfMIlbKfuhzmu', NULL, 1, '', '2013-03-13 11:35:25', '2013-03-13 11:35:25'),
(13, 'zlkoh123', 'zlkoh.damien@gmail.com', '', '$2a$08$rScAfv/SAG4aYd4p0jbd/eHdatP8qeGiLWCxotysDj1oy/ZThRloS', NULL, 1, '', '2013-03-13 11:56:05', '2013-03-13 11:56:05'),
(14, 'zlkoh1231', 'zlkoh.damien@gmail.com', '', '$2a$08$f4r6d0NgD.5LynHTWBtlnOCp918N6uGoTGove3VbMyaoZGTVhz5v.', NULL, 1, '', '2013-03-13 11:57:02', '2013-03-13 11:57:02'),
(15, 'zlkoh12333', 'zlkoh.damien@gmail.com', '', '$2a$08$kb.4UifZyVkJMWHwGjMvHOia52UB19eQUmhZwsinMjYAM8xRN0f4m', NULL, 1, '', '2013-03-13 12:38:14', '2013-03-13 12:38:14'),
(16, 'tester1', 'zlkoh.damien@gmail.com', '', '$2a$08$y3pTiIQv0UhHS2lnrdVzJeQ3DWFGiKjhPQ29j7aBu5TuFvajlV58u', NULL, 1, '', '2013-03-13 12:38:56', '2013-03-13 12:38:56'),
(17, 'damienkoh', 'zlkoh.damien@gmail.com', '', '$2a$08$ZP4jGsppIbUyBsK0CkNK7uGnizHBYoqeN3ENwEmRDIjMtxOiWs0mS', NULL, 2, '', '2013-03-20 11:53:23', '2013-03-20 11:53:23'),
(18, 'vlim', 'victorlim86@gmail.com', '', '$2a$08$U2tGYjF2a2RBVVcxWnFyQOlWLtHIMuwPBwhKGR3z1PYW0izSSge2m', NULL, 2, '', '2013-03-23 07:54:43', '2013-03-23 07:54:43'),
(19, 'victor', 'victor@test.com', '', '$2a$08$aVJNcGh3akd0eW9zbXJ4buNPfK7SUty4KOq14cYr39GyDW94NGjI2', NULL, 1, '', '2013-03-23 08:11:41', '2013-03-23 08:11:41'),
(20, 'dkoh', 'damien@test.com', '', '$2a$08$VjBtV3c4aVdxNm1aSmNMQuIipDB8OlRLM5138lqpHLNl/wumKEsvi', NULL, 2, '', '2013-03-28 06:26:33', '2013-03-28 06:26:33'),
(21, 'jess', 'Jesslyn21@gmail.com', '', '$2a$08$IRD6XiXtJd23zn.G0mu.FOC0MVjYqJoKnkbPIXuvyrmdXghLyNiKm', NULL, 2, '', '2013-03-30 13:18:16', '2013-03-30 13:18:16'),
(22, 'jess123', 'Jesslyn21@gmail.com', '', '$2a$08$uL50rg1801FGnbBYTtcc/upl2.K5e2NZcJxIp74NzcCfFMEk6cSsW', NULL, 2, '', '2013-03-30 13:18:55', '2013-03-30 13:18:55'),
(23, 'test', 'test@test.com', '', '$2a$08$LpQ4OkTN.JeZlAnvsTgpLOLZzQbo5NXFn5CvgcM.zpEcrlEZq9ZeG', NULL, 2, '', '2013-03-30 22:35:30', '2013-03-30 22:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_backup`
--

CREATE TABLE IF NOT EXISTS `user_account_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `old_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_account_backup`
--

INSERT INTO `user_account_backup` (`id`, `username`, `email`, `old_email`, `password`, `salt`, `role_id`, `guid`, `created_at`, `updated_at`) VALUES
(1, 'damienk', 'zlkoh@hotmail.com', 'zlkoh.damien@gmail.com', 'damienk', NULL, 1, '513349f2ec3c48.56209205', '2013-03-03 13:02:42', '2013-03-03 13:02:42'),
(2, 'damienk', 'zlkoh@hotmail.com', 'zlkoh.damien@gmail.com', '$2a$08$S3hSQXlEZURwZ3o0QWhlS.ExxUAaOVpd14fU76ucsitWvPK2DeIDi', NULL, 1, '51334a5ad91fc3.43206425', '2013-03-03 13:04:26', '2013-03-03 13:04:26'),
(3, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$S3hSQXlEZURwZ3o0QWhlS.ExxUAaOVpd14fU76ucsitWvPK2DeIDi', NULL, 1, '513b1caa322ad3.91448349', '2013-03-09 11:27:39', '2013-03-09 11:27:39'),
(4, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '51457caa1644e5.62168885', '2013-03-17 08:19:54', '2013-03-17 08:19:54'),
(5, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '51457f17504686.22920070', '2013-03-17 08:30:15', '2013-03-17 08:30:15'),
(6, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514851e598f791.70144747', '2013-03-19 11:54:13', '2013-03-19 11:54:13'),
(7, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '5148604ed24734.48458644', '2013-03-19 12:55:42', '2013-03-19 12:55:42'),
(8, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5a9c3de317.26683922', '2013-03-23 07:32:44', '2013-03-23 07:32:44'),
(9, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5bc451fda0.03910794', '2013-03-23 07:37:40', '2013-03-23 07:37:40'),
(10, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5c50a5d8d9.37861493', '2013-03-23 07:40:00', '2013-03-23 07:40:00'),
(11, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5ceb9ac117.87124960', '2013-03-23 07:42:35', '2013-03-23 07:42:35'),
(12, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5df0cd1ee9.24903516', '2013-03-23 07:46:56', '2013-03-23 07:46:56'),
(13, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5dfd8249d7.79292265', '2013-03-23 07:47:09', '2013-03-23 07:47:09'),
(14, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5e258a2748.32488991', '2013-03-23 07:47:49', '2013-03-23 07:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `work_type`
--

CREATE TABLE IF NOT EXISTS `work_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `abbr` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_type`
--

INSERT INTO `work_type` (`id`, `name`, `abbr`) VALUES
(1, 'Casual / Part-time', 'PT'),
(2, 'Full Time', 'FT'),
(3, 'Cash in hand', 'CIH'),
(4, 'Shift Work', 'SW'),
(5, 'Vacation', 'V');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
