-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2013 at 01:19 PM
-- Server version: 5.6.11-log
-- PHP Version: 5.3.13

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `user_id`, `first_name`, `last_name`, `slug`, `preferred_location`, `preferred_job`, `contact_number`, `viewable`, `profilepic`, `skills`, `summary`, `created_at`, `updated_at`) VALUES
(1, 17, 'Damien', 'koh', 'damienkoh1', 1, 4, NULL, 1, '/uploads/applicant/9e54cad4694ee004fe704f2d6f14a7cd/IMG_0314.png', 'PHP Development;ASP.NET Development', '', '2013-03-20 11:53:23', '2013-06-18 11:05:02'),
(2, 18, 'Victor', 'Lim', 'victorlimys', 2, 15, '0432719204', 1, '/uploads/applicant/917631549598b525ca7bfc1447a19174/image.png', 'CSS3;HTML5;Laravel;PHP;C#;Visual Studo;Perl;CGI;Shell Script;Photoshop;Illustrator;Agile;Graphic Design', 'Dedicated administrative support professional with 10+ years providing outstanding support to senior executives', '2013-03-23 07:54:43', '2013-04-23 12:26:28'),
(3, 20, 'Damien', 'Koh', NULL, 1, 15, NULL, 1, '/uploads/applicant/dfc29e9b01a54f5bd25df8ca42e8b92a/IMG_0009.png', '', '', '2013-03-28 06:26:33', '2013-03-28 06:26:53'),
(4, 22, 'Jesslyn', 'Lim', NULL, 3, 4, NULL, 1, '/uploads/applicant/ff6ae2cda9741c0f0c03bce2b6d93af9/for tweet.png', '', '', '2013-03-30 13:18:55', '2013-03-31 05:17:28'),
(5, 23, 'test', 'etst', NULL, 3, 2, NULL, 1, '/img/default-profile.png', '', '', '2013-03-30 22:35:30', '2013-03-30 22:35:30'),
(6, 24, 'Damien', 'Koh', 'b5e13efac272', 2, 15, NULL, 1, '/img/default-profile.png', '', NULL, '2013-06-18 11:07:08', '2013-06-18 11:09:11'),
(7, 25, 'Damien', 'Koh', '334cb7e6af5e', 1, 1, NULL, 1, '/img/default-profile.png', '', NULL, '2013-06-18 11:35:09', '2013-06-18 11:58:10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `applicant_coverletters`
--

INSERT INTO `applicant_coverletters` (`id`, `applicant_id`, `coverletter`, `filesize`, `type`, `disabled`, `path`, `created_at`, `updated_at`) VALUES
(20, 7, 'cover_letter_2.docx', 11, 'doc', 0, '/uploads/applicant/334cb7e6af5e0f5aec9f65fd8a56601e/coverletter/cover_letter_2.docx', '2013-06-18 11:55:10', '2013-06-18 11:55:10'),
(24, 1, 'resume.pdf', 67, 'pdf', 0, '/uploads/applicant/9e54cad4694ee004fe704f2d6f14a7cd/coverletter/resume.pdf', '2013-06-20 14:04:12', '2013-06-20 14:04:12'),
(25, 1, 'cover_letter.docx', 11, 'doc', 0, '/uploads/applicant/9e54cad4694ee004fe704f2d6f14a7cd/coverletter/cover_letter.docx', '2013-06-20 14:07:09', '2013-06-20 14:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_job`
--

CREATE TABLE IF NOT EXISTS `applicant_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `cover_letter` text,
  `applicant_resume_id` int(11) DEFAULT NULL,
  `applicant_coverletter_id` int(11) DEFAULT NULL,
  `write_resume` text,
  `write_coverletter` text,
  `alternate_contact_details` text,
  `non_registered_users` text,
  `sent` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `applicant_job`
--

INSERT INTO `applicant_job` (`id`, `job_id`, `applicant_id`, `status`, `cover_letter`, `applicant_resume_id`, `applicant_coverletter_id`, `write_resume`, `write_coverletter`, `alternate_contact_details`, `non_registered_users`, `sent`, `created_at`, `updated_at`) VALUES
(82, 23, 7, 1, NULL, NULL, 0, NULL, '', 'a:2:{i:0;s:19:"jesslyn21@gmail.com";i:1;s:10:"1312321321";}', NULL, NULL, '2013-06-18 11:55:10', '2013-06-18 11:55:10'),
(83, 23, NULL, 1, NULL, NULL, NULL, NULL, '', NULL, 'a:12:{s:10:"first_name";s:6:"Damien";s:9:"last_name";s:6:"tester";s:5:"email";s:13:"test@test.com";s:7:"contact";s:10:"2131321321";s:18:"current_employment";s:6:"tester";s:13:"duration_year";s:1:"1";s:14:"duration_month";s:1:"2";s:15:"selected-resume";s:1:"0";s:20:"selected-coverletter";s:1:"0";s:17:"write-coverletter";s:0:"";s:13:"upload-resume";a:5:{s:4:"name";s:0:"";s:4:"type";s:0:"";s:8:"tmp_name";s:0:"";s:5:"error";i:4;s:4:"size";i:0;}s:18:"upload-coverletter";a:5:{s:4:"name";s:0:"";s:4:"type";s:0:"";s:8:"tmp_name";s:0:"";s:5:"error";i:4;s:4:"size";i:0;}}', NULL, '2013-06-20 12:37:23', '2013-06-20 12:37:23'),
(88, 23, 1, 1, NULL, 55, 24, NULL, '', NULL, NULL, NULL, '2013-06-20 14:04:12', '2013-06-20 14:04:12'),
(90, 5, 1, 1, NULL, 56, 25, NULL, '', NULL, NULL, NULL, '2013-06-20 14:07:09', '2013-06-20 14:07:09'),
(91, 28, NULL, 1, NULL, NULL, NULL, NULL, 'I would like to apply for...', NULL, 'a:12:{s:10:"first_name";s:6:"tester";s:9:"last_name";s:6:"tester";s:5:"email";s:22:"zlkoh.damien@gmail.com";s:7:"contact";s:6:"123123";s:18:"current_employment";s:5:"12323";s:13:"duration_year";s:1:"1";s:14:"duration_month";s:1:"2";s:15:"selected-resume";s:1:"0";s:20:"selected-coverletter";s:1:"0";s:17:"write-coverletter";s:28:"I would like to apply for...";s:13:"upload-resume";a:5:{s:4:"name";s:0:"";s:4:"type";s:0:"";s:8:"tmp_name";s:0:"";s:5:"error";i:4;s:4:"size";i:0;}s:18:"upload-coverletter";a:5:{s:4:"name";s:0:"";s:4:"type";s:0:"";s:8:"tmp_name";s:0:"";s:5:"error";i:4;s:4:"size";i:0;}}', 1, '2013-06-26 13:27:43', '2013-06-26 13:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_qualifications`
--

CREATE TABLE IF NOT EXISTS `applicant_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `level` varchar(55) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `institude` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `achievements` text,
  `started` int(4) DEFAULT NULL,
  `ended` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_applicant_idx` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `applicant_resumes`
--

INSERT INTO `applicant_resumes` (`id`, `applicant_id`, `resume`, `filesize`, `type`, `disabled`, `path`, `created_at`, `updated_at`) VALUES
(51, 7, 'resume.pdf', 67, 'pdf', 0, '/uploads/applicant/334cb7e6af5e0f5aec9f65fd8a56601e/resume/resume.pdf', '2013-06-18 11:55:10', '2013-06-18 11:55:10'),
(55, 1, 'resume.pdf', 67, 'pdf', 0, '/uploads/applicant/9e54cad4694ee004fe704f2d6f14a7cd/resume/resume.pdf', '2013-06-20 14:04:12', '2013-06-20 14:04:12'),
(56, 1, 'resume2.docx', 19, 'doc', 0, '/uploads/applicant/9e54cad4694ee004fe704f2d6f14a7cd/resume/resume2.docx', '2013-06-20 14:07:09', '2013-06-20 14:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_work_history`
--

CREATE TABLE IF NOT EXISTS `applicant_work_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `started_month` varchar(50) DEFAULT NULL,
  `started_year` int(11) unsigned DEFAULT NULL,
  `ended_month` varchar(50) DEFAULT NULL,
  `ended_year` int(11) unsigned DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `industry` varchar(45) NOT NULL,
  `position` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `currently_work_here` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blurbs`
--

CREATE TABLE IF NOT EXISTS `blurbs` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `industry` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `title`, `first_name`, `last_name`, `application_email`, `contact`, `secondary_contact`, `fax`, `company`, `industry`, `address`, `address_2`, `suburb`, `postal`, `country`, `company_size`, `user_id`, `updated_at`, `created_at`, `guid`, `unique_folder`, `logo_path`) VALUES
(7, 'Mr', 'Damien', 'Koh123', 'zlkoh.damien@gmail.com', '0430131395', NULL, '123456789', 'careershire', 1, '159 Hellawell Road123', '', 'Sunnybank Hills', 2147483647, 'AUS', '>200', 11, '2013-06-23 05:39:31', '2013-01-27 02:41:35', NULL, '8af479d69c80b60de952bf2cc565772f', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/company-logo//prop_normal.png'),
(14, 'Mr', 'tester', 'tester', 'zlkoh.damien@gmail.com', '123123', NULL, '123123', 'Brightlabs', 15, '159 Hellawell Road', '123123123', 'Sunnybank Hills', 4109, 'AUS', '0', 26, '2013-06-23 09:17:54', '2013-06-23 09:17:41', NULL, '334cb7e6af5e0f5aec9f65fd8a56601e', '/uploads/employer/334cb7e6af5e0f5aec9f65fd8a56601e/company-logo//test.png');

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
  `slug` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_2` (`slug`),
  KEY `fk_job_category_idx` (`category_id`),
  KEY `fk_job_sub_categor_idx` (`sub_category_id`),
  KEY `fk_advertiser_job_idx` (`employer_id`),
  KEY `fk_job_location_idx` (`location_id`),
  KEY `slug` (`slug`),
  FULLTEXT KEY `title` (`title`,`description`,`summary`),
  FULLTEXT KEY `contact` (`contact`),
  FULLTEXT KEY `contact_2` (`contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `summary`, `description`, `more_info`, `video`, `contact`, `category_id`, `sub_category_id`, `min_salary`, `max_salary`, `salary_range`, `payment_structure`, `location_id`, `sub_location_id`, `employer_id`, `created_at`, `updated_at`, `end_at`, `status`, `template_id`, `work_type`, `apply`, `slug`) VALUES
(7, 'title', 'intro', '<p>test</p>\r\n', 'more-info', 'video', 'contact', 15, 1, '12', '12', 'salary-range', 'weekly', 1, 1, 7, '2013-02-20 13:42:02', '2013-02-24 04:24:13', NULL, 0, 1, '', '', NULL),
(8, 'BUB Advertisement', 'intro', '<p>dfasfdas</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '123123', '32132131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:15:49', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(9, 'title', 'intro', '<p>gsfgfsd</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '234', '234', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:17:09', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(10, 'title', 'intro', '<p>fdas</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '321', '21', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 04:44:11', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(11, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:23:47', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(12, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:24:17', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(13, 'jesslyn', 'intro', '<p>testetestest</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '3213213', '321321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:24:44', '2013-03-30 06:18:48', NULL, 0, 1, '', '', NULL),
(14, 'titleafdsfdsadsfasdfaasdf', 'intro', '<p>fdsa</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '123123', '32131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:28:17', '2013-03-10 05:28:17', NULL, 0, 0, '', '', NULL),
(15, 'titlefasfdaf', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '32131', '2131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:30:21', '2013-03-10 05:30:21', NULL, 0, 0, '', '', NULL),
(16, 'titlefasfdaf', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '32131', '2131', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:36:57', '2013-03-10 05:36:57', NULL, 0, 0, '', '', NULL),
(17, 'title', 'intro', '<p>fdsafsa</p>\r\n', 'more-info', 'video', 'contact', 1, 1, '321', '321', 'salary-range', 'weekly', 1, 11, 7, '2013-03-10 05:51:58', '2013-03-10 05:58:53', NULL, 0, 1, '', '', NULL),
(26, 'fda', '<p>fdsa</p>\r\n', '<p>fdsa</p>\r\n', 'fsa', NULL, 'fda', 15, 2, '23', '123', 'fdsa', 'weekly', 1, 11, 7, '2013-06-22 08:12:19', '2013-06-22 08:12:19', '2013-07-22 08:12:19', 1, 1, 'PT', NULL, NULL),
(27, 'Web Developer (PHP)', 'Brightlabs is looking for a Web Developer (PHP) to join our award-winning team. Hands on experience with SCRUM methodology is desirable, but not mandatory', '<div class="templatetext" style="font-size: 10pt; word-wrap: break-word; color: rgb(69, 69, 69); font-family: Helvetica, Arial, sans-serif; line-height: normal;"><b>About Brightlabs</b>&nbsp;<br />\r\nWith a majority of our team in their mid 20s to early 30s there&#39;s a lot of internet humour around our office, but we still maintain a professional work environment. There are numerous perks for working for Brightlabs, among them morning teas for celebrating key events (and occasionally for no reason at all) and early knock-offs on Friday to socialise over a few drinks. The best perk of all, however, is the fact we don&#39;t support IE6!&nbsp;<br />\r\n<br />\r\n<b>About You</b>&nbsp;<br />\r\nWe are looking for someone that is a team player, is not afraid to bring up concerns or ideas and is capable of taking criticism and learning from their experiences. Agile values are key to the way our team operates, so if you enjoy an open, honest atmosphere - keep reading.<br />\r\n<br />\r\nAs a web developer you will be responsible for a variety of tasks, from implementing designs from our creative team to handling backend development using the LAMP stack on large eCommerce and Content Management solutions. You will have a wide array of work to deal with, from standard client websites to custom implementations and our own internal product suite.<br />\r\n<br />\r\nOur work environment is varied with the opportunity to move into other areas as your abilities and interests allow. Ideally, you are able to work in a self-guided manner, seeking support from the project and development team as required and able to handle constructive criticism and build your skill set to complement the team as a whole.&nbsp;<br />\r\n<br />\r\n<b>Essential Attributes and Skills</b>\r\n\r\n<ul style="margin: 8px 0px 9px; padding-right: 0px; padding-left: 0px; list-style: none;">\r\n	<li style="list-style: disc; margin-left: 15px;">3 + years experience in commercial web development and web applications at a digital agency</li>\r\n	<li style="list-style: disc; margin-left: 15px;">3 + years experience with PHP on the LAMP stack</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Having worked in a SCRUM methodology environment would be a distinct advantage, but it&#39;s not mandatory</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Proven application of test driven development, automated testing and continuous integration</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Ability to architect, scope, design and implement scalable technical solutions</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Knowledge of OOP practices</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Knowledge of source control systems (preferably GIT) to maintain project integrity</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Experience with MySQL database and query design</li>\r\n	<li style="list-style: disc; margin-left: 15px;">Advanced knowledge of HTML, CSS and JavaScript</li>\r\n</ul>\r\n</div>\r\n', 'fdas', NULL, 'Sounds like you? Please call our General Manager, Han te Riele, on 1300 420 130 and e-mail your cover letter and resume to jobs@brightlabs.com.au And please, no recruitment agencies.', 15, 1, '123', '12321', 'Include super', 'fortnightly', 2, 1, 7, '2013-06-22 08:33:34', '2013-06-22 08:33:34', '2013-07-22 08:33:34', 1, 1, 'FT', NULL, NULL),
(28, 'PHP WEB APPLICATION DEVELOPERS (PHP ONLY)', 'test', '<p>test</p>\r\n', 'test', NULL, 'test', 15, 1, '123', '200000', '123', 'weekly', 2, 1, 7, '2013-06-22 12:49:19', '2013-06-30 12:14:17', '2013-07-22 12:49:19', 1, 1, 'FT', NULL, 'PHP_WEB_APPLICATION_DEVELOPERS_PHP_ONLY'),
(30, 'e Commerce .Net Developer | P/T Optional (Q3)', 'This market leader in their sector has business goals of being one of Australia''s most recognised online stores, offering both local and international consumers their products.', '<p style="margin: 9px 0px; color: rgb(0, 0, 0); font-family: Helvetica, Arial, sans-serif; font-size: 10.909090995788574px; line-height: 16.988636016845703px;">This market leader in their sector has&nbsp;business&nbsp;goals of being one of Australia&#39;s most recognised online stores, offering both local and international consumers their products. This is an initial 3&nbsp;month contract based on the Southside of Brisbane with intentions of moving into a permanent position. (For the right candidate an initial part time contract (25 - 30hrs) a week arrangement could be made.</p>\r\n\r\n<p style="margin: 9px 0px; color: rgb(0, 0, 0); font-family: Helvetica, Arial, sans-serif; font-size: 10.909090995788574px; line-height: 16.988636016845703px;">They are looking for an experienced eCommerce .Net Developer to work in-house (Southside of Brisbane) initially working across the back end development side of things and assisting with security strategies and audits. You will be a confident developer with good communication skills and a passion for digital development utilising the latest web technologies.</p>\r\n\r\n<p style="margin: 9px 0px; color: rgb(0, 0, 0); font-family: Helvetica, Arial, sans-serif; font-size: 10.909090995788574px; line-height: 16.988636016845703px;">To be successful in this position you will have the following key skills and experience:</p>\r\n\r\n<ul style="margin: 8px 0px 9px; padding-right: 0px; padding-left: 0px; list-style: none; color: rgb(0, 0, 0); font-family: Helvetica, Arial, sans-serif; font-size: 10.909090995788574px; line-height: 16.988636016845703px;">\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Proven experience in eCommerce Web Design or&nbsp;.Net development</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Creating new websites to in-house guidelines</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Improving and enhancing the usability, functionality and design of existing websites</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">CSS3 HTML5 (Beneficial but not necessary)</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Understanding of penetration testing (Beneficial)</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Proven back end skills in implementing web application</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Strong background in a Microsoft Windows Environment</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Excellent time management and organisation skills</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Strong communication and inter-personal skills</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Tertiary Education in a related field (desirable)</li>\r\n	<li style="list-style: disc; font-size: 12px; margin-left: 25px !important;">Interest in Online Shopping and retail</li>\r\n</ul>\r\n', 'test', NULL, 'If you have the ability to work unsupervised, work well as a member of a multi-discipline team, please forward your resume ASAP and feel free to follow up with Greg Scharf on (07) 3232 2300 , I look forward to speaking with you soon.', 15, 1, '123123', '200000', 'Around $92K + Up to 12.75% Superannuation', 'fortnightly', 2, 1, 14, '2013-06-23 09:20:07', '2013-06-23 09:45:05', '2013-07-23 09:20:07', 1, 1, 'FT', NULL, 'e_commerce_net_developer__pt_optional_q3'),
(31, 'test', 'tester', '<p>tester</p>\r\n', 'tester', NULL, 'tester', 15, 1, '100', '1000', '12213', 'weekly', 2, 1, 7, '2013-06-24 12:15:04', '2013-06-24 12:15:04', '2013-07-24 12:15:04', 1, 1, 'FT', NULL, 'test'),
(32, 'test', 'test', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique bibendum tortor, nec consectetur ipsum gravida et. Ut mollis est quis mauris gravida, quis commodo ante semper. Nulla non sodales dolor. Nunc sed nunc a ante bibendum viverra. Vestibulum at nisi cursus, feugiat elit sed, dapibus massa. Sed nec vehicula nunc, quis dignissim ipsum. Etiam sed sem porttitor, euismod nisi nec, condimentum tortor. Integer sollicitudin urna in urna laoreet pharetra. Aenean quis mollis mauris, in blandit leo. Phasellus pretium, erat eget luctus commodo, tortor ipsum laoreet lorem, non adipiscing velit justo et massa. Maecenas sed leo enim. Sed et pharetra felis, eu facilisis arcu. Praesent vestibulum tellus lorem, nec venenatis lacus auctor sit amet. Mauris volutpat tortor sed tempor egestas.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique bibendum tortor, nec consectetur ipsum gravida et. Ut mollis est quis mauris gravida, quis commodo ante semper. Nulla non sodales dolor. Nunc sed nunc a ante bibendum viverra. Vestibulum at nisi cursus, feugiat elit sed, dapibus massa. Sed nec vehicula nunc, quis dignissim ipsum. Etiam sed sem porttitor, euismod nisi nec, condimentum tortor. Integer sollicitudin urna in urna laoreet pharetra. Aenean quis mollis mauris, in blandit leo. Phasellus pretium, erat eget luctus commodo, tortor ipsum laoreet lorem, non adipiscing velit justo et massa. Maecenas sed leo enim. Sed et pharetra felis, eu facilisis arcu. Praesent vestibulum tellus lorem, nec venenatis lacus auctor sit amet. Mauris volutpat tortor sed tempor egestas.</p>\r\n', 'test', NULL, 'test', 15, 3, '123', '1233', '123', 'monthly', 3, 16, 7, '2013-06-24 12:32:29', '2013-06-30 11:31:18', '2013-07-24 12:32:29', 1, 32, 'CIH', NULL, 'test_2');

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
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `html` text NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `html`, `title`, `slug`, `updated_at`, `created_at`) VALUES
(1, '<div class="test">\n    <input type="text">\n</div>', 'test', 'test', '2013-06-30 12:22:34', '2013-06-30 12:22:34'),
(2, 'test', 'test2', 'test2', '2013-06-30 12:23:31', '2013-06-30 12:23:31'),
(3, 'test', 'test', '', '2013-06-30 12:42:24', '2013-06-30 12:42:24'),
(4, '<div class="test">\n    <input type="text">\n</div>', '', '', '2013-06-30 13:13:50', '2013-06-30 13:13:50');

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
-- Table structure for table `shortlists`
--

CREATE TABLE IF NOT EXISTS `shortlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `shortlist_category_id` int(11) DEFAULT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `shortlists`
--

INSERT INTO `shortlists` (`id`, `applicant_id`, `shortlist_category_id`, `job_id`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, 19, '2013-05-03 14:01:37', '2013-05-03 14:01:37'),
(10, 2, NULL, 23, '2013-05-04 00:00:00', '2013-05-04 00:00:00'),
(21, 1, NULL, 21, '2013-05-04 13:53:46', '2013-05-04 13:53:46'),
(24, 1, NULL, 18, '2013-05-30 13:38:46', '2013-05-30 13:38:46'),
(25, 1, NULL, 2, '2013-05-30 13:39:33', '2013-05-30 13:39:33'),
(26, 1, NULL, 5, '2013-05-30 13:39:35', '2013-05-30 13:39:35'),
(35, 1, NULL, 30, '2013-06-23 10:37:17', '2013-06-23 10:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `shortlist_category`
--

CREATE TABLE IF NOT EXISTS `shortlist_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `shortlist_category`
--

INSERT INTO `shortlist_category` (`id`, `applicant_id`, `name`) VALUES
(18, 1, 'test'),
(19, 1, 'haha'),
(20, 2, 'good location'),
(21, 2, 'high salary'),
(22, 2, 'close to home'),
(23, 1, 'test1'),
(24, 1, 'test12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `css`, `header`, `body`, `footer`, `name`, `data`, `updated_at`, `created_at`) VALUES
(1, '#content .notice-container > header {\n		background-repeat:  ;\n			\n		background-position: top left;\n		\n		background-color: ;\n		\n		text-align: ;\n		\n}\n\n#content .notice-container > header > h1 {\n		color: ;\n	}\n\n#content .notice-container > article {\n\n		background-repeat: ;\n				background-position: top left;\n			background-color: ;\n	}\n\n#content .notice-container > article > p {\n		color: ;\n	}\n\n#content .notice-container > footer {\n\n		background-repeat: ;\n				background-position: top left;\n			background-color: ;\n	\n}\n\n#content .notice-container > footer > p {\n			color: ;\n	}\n', NULL, NULL, NULL, 'Default', '', NULL, NULL),
(31, '.notice-container > header {\n background-repeat: no-repeat;\n  background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/header.png);\n background-position: bottom right ;\n  text-align: center;\n margin-bottom: 5px;\n overflow: hidden;\n height: 110px;\n text-align: left;\n}\n\n.notice-container > header > h1 {\n  display: inline;\n}\n\n.notice-container > article {\n  background-repeat: repeat-y;\n  background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/body.png);\n background-position: center ;\n  height: auto;\n margin-bottom: 5px;\n}\n\n.notice-container > footer {\n  \n  background-image: url(/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png);\n \n margin-bottom: 5px;\n}\n.notice-container > header, .notice-container > article, .notice-container > footer {\n padding: 40px;\n  width: 100%;\n  -webkit-box-sizing: border-box;\n -moz-box-sizing: border-box;\n  box-sizing: border-box;\n}\n\n.notice-container > header { padding-bottom: 10px; }\n.notice-container > article { padding-top:0; padding-bottom:0;}\n.notice-footer > footer { padding-top:0; }\n', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/header.png', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/body.png', '/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png', 'test template', 'a:10:{s:17:"header_text_align";s:4:"left";s:13:"header_repeat";s:9:"no-repeat";s:15:"header_position";s:12:"bottom right";s:11:"body_repeat";s:8:"repeat-y";s:13:"body_position";s:6:"center";s:13:"footer_repeat";s:0:"";s:15:"footer_position";s:0:"";s:17:"header_background";s:80:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/header/header.png";s:15:"body_background";s:76:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/body/body.png";s:17:"footer_background";s:78:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/backgrounds/footer/visa.png";}', '2013-06-26 12:28:33', '2013-03-30 07:15:25'),
(32, '#content .notice-container > header {\r\n		background-repeat: repeat-y ;\r\n			\r\n		background-position: top right;\r\n		\r\n		background-color: #e16b6b;\r\n		\r\n		text-align: right;\r\n		\r\n}\r\n\r\n#content .notice-container > header > h1 {\r\n		color: #936c6c;\r\n	}\r\n\r\n#content .notice-container > article {\r\n\r\n		background-repeat: repeat;\r\n				background-position: top center;\r\n			background-color: #a22f2f;\r\n	}\r\n\r\n#content .notice-container > article > p {\r\n		color: #ffffff;\r\n	}\r\n\r\n#content .notice-container > footer {\r\n\r\n		background-repeat: repeat-x;\r\n				background-position: top center;\r\n			background-color: #ceb788;\r\n	\r\n}\r\n\r\n#content .notice-container > footer > p {\r\n			color: #0702a1;\r\n	}\r\n', NULL, NULL, NULL, 'test', 'a:16:{s:13:"template-name";s:4:"test";s:10:"title-type";s:5:"image";s:11:"title-color";s:7:"#936c6c";s:15:"head-text-align";s:5:"right";s:9:"hbg-color";s:7:"#e16b6b";s:13:"header-repeat";s:8:"repeat-y";s:15:"header-position";s:9:"top right";s:10:"body-color";s:7:"#ffffff";s:9:"bbg-color";s:7:"#a22f2f";s:11:"body-repeat";s:6:"repeat";s:13:"body-position";s:10:"top center";s:12:"footer-color";s:7:"#0702a1";s:9:"fbg-color";s:7:"#ceb788";s:13:"footer-repeat";s:8:"repeat-x";s:15:"footer-position";s:10:"top center";s:12:"header-image";s:80:"/uploads/employer/8af479d69c80b60de952bf2cc565772f/templates/header/IMAG0055.png";}', '2013-06-30 11:14:46', '2013-06-30 05:17:53'),
(33, '#content .notice-container > header {\n		background-repeat:  ;\n			\n		background-position: top left;\n		\n		background-color: ;\n		\n		text-align: ;\n		\n}\n\n#content .notice-container > header > h1 {\n		color: ;\n	}\n\n#content .notice-container > article {\n\n		background-repeat: ;\n				background-position: top left;\n			background-color: ;\n	}\n\n#content .notice-container > article > p {\n		color: ;\n	}\n\n#content .notice-container > footer {\n\n		background-repeat: ;\n				background-position: top left;\n			background-color: ;\n	\n}\n\n#content .notice-container > footer > p {\n			color: ;\n	}\n', NULL, NULL, NULL, 'Default', 'a:15:{s:13:"template-name";s:7:"Default";s:10:"title-type";s:5:"title";s:11:"title-color";s:0:"";s:15:"head-text-align";s:0:"";s:9:"hbg-color";s:0:"";s:13:"header-repeat";s:0:"";s:15:"header-position";s:8:"top left";s:10:"body-color";s:0:"";s:9:"bbg-color";s:0:"";s:11:"body-repeat";s:0:"";s:13:"body-position";s:8:"top left";s:12:"footer-color";s:0:"";s:9:"fbg-color";s:0:"";s:13:"footer-repeat";s:0:"";s:15:"footer-position";s:8:"top left";}', '2013-06-30 11:58:33', '2013-06-30 11:58:33');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
(15, 7, 25, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', '312312123231', 'EWay w/ CVN (Test mode)', '21027', '00,Transaction Approved(Test CVN Gateway)', '1366019241', '0', '', '<ewaygateway>\r\n  <ewayCustomerID>87654321</ewayCustomerID>\r\n <ewayTotalAmount>1000</ewayTotalAmount>\r\n <ewayCustomerFirstName>231321231</ewayCustomerFirstName>\r\n  <ewayCustomerLastName>23112213</ewayCustomerLastName>\r\n <ewayCustomerEmail></ewayCustomerEmail>\r\n <ewayCustomerAddress>21321321123231213</ewayCustomerAddress>\r\n  <ewayCustomerPostcode></ewayCustomerPostcode>\r\n <ewayCustomerInvoiceDescription>312312123231</ewayCustomerInvoiceDescription>\r\n <ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n  <ewayCardHoldersName>fdsaadfsfdsaf</ewayCardHoldersName>\r\n  <ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n <ewayCardExpiryMonth>10</ewayCardExpiryMonth>\r\n <ewayCardExpiryYear>31</ewayCardExpiryYear>\r\n \r\n  <ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n  <ewayOption1></ewayOption1>\r\n <ewayOption2></ewayOption2>\r\n <ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>21027</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', '231321231', '23112213', '21321321123231213', NULL, '213231213', '123231231', '', 'AZE', '312213213', NULL, 'fdsaadfsfdsaf', '4444XXXXXXXX1111'),
(16, 7, 24, 'PAYPAL', '2013-05-12 11:34:02', '2013-05-12 11:34:02', '7BB159384T0200222', 'expresscheckout', 'Completed', '7BB159384T0200222', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-05-12T11:34:02Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 7, 25, 'PAYPAL', '2013-05-14 11:24:11', '2013-05-14 11:24:11', '0BT912218G920104Y', 'expresscheckout', 'Completed', '0BT912218G920104Y', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-05-14T11:24:12Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 7, 26, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', 'fda', 'EWay w/ CVN (Test mode)', '20325', '00,Transaction Approved(Test CVN Gateway)', '1371888738', '0', '', '<ewaygateway>\r\n	<ewayCustomerID>87654321</ewayCustomerID>\r\n	<ewayTotalAmount>1000</ewayTotalAmount>\r\n	<ewayCustomerFirstName>fsdasdf</ewayCustomerFirstName>\r\n	<ewayCustomerLastName>sdaf</ewayCustomerLastName>\r\n	<ewayCustomerEmail></ewayCustomerEmail>\r\n	<ewayCustomerAddress>fasdfas</ewayCustomerAddress>\r\n	<ewayCustomerPostcode></ewayCustomerPostcode>\r\n	<ewayCustomerInvoiceDescription>fda</ewayCustomerInvoiceDescription>\r\n	<ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n	<ewayCardHoldersName>fsafsad</ewayCardHoldersName>\r\n	<ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n	<ewayCardExpiryMonth>01</ewayCardExpiryMonth>\r\n	<ewayCardExpiryYear>15</ewayCardExpiryYear>\r\n	\r\n	<ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n	<ewayOption1></ewayOption1>\r\n	<ewayOption2></ewayOption2>\r\n	<ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>20325</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'fsdasdf', 'sdaf', 'fasdfas', NULL, 'fsad', 'fas', '', 'ABW', 'fas', NULL, 'fsafsad', '4444XXXXXXXX1111'),
(19, 7, 27, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', 'Web Developer (PHP)', 'EWay w/ CVN (Test mode)', '20241', '00,Transaction Approved(Test CVN Gateway)', '1371890014', '0', '', '<ewaygateway>\r\n	<ewayCustomerID>87654321</ewayCustomerID>\r\n	<ewayTotalAmount>1000</ewayTotalAmount>\r\n	<ewayCustomerFirstName>fafdfdsafsa</ewayCustomerFirstName>\r\n	<ewayCustomerLastName>fsafdsa</ewayCustomerLastName>\r\n	<ewayCustomerEmail></ewayCustomerEmail>\r\n	<ewayCustomerAddress>fsdadfsafdsfds</ewayCustomerAddress>\r\n	<ewayCustomerPostcode></ewayCustomerPostcode>\r\n	<ewayCustomerInvoiceDescription>Web Developer (PHP)</ewayCustomerInvoiceDescription>\r\n	<ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n	<ewayCardHoldersName>safdsafas</ewayCardHoldersName>\r\n	<ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n	<ewayCardExpiryMonth>02</ewayCardExpiryMonth>\r\n	<ewayCardExpiryYear>15</ewayCardExpiryYear>\r\n	\r\n	<ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n	<ewayOption1></ewayOption1>\r\n	<ewayOption2></ewayOption2>\r\n	<ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>20241</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'fafdfdsafsa', 'fsafdsa', 'fsdadfsafdsfds', NULL, 'fddfs', 'fsdsdfa', '', 'CZE', 'fdaas', NULL, 'safdsafas', '4444XXXXXXXX1111'),
(20, 7, 28, 'PAYPAL', '2013-06-22 12:49:20', '2013-06-22 12:49:20', '40N8164220789345W', 'expresscheckout', 'Completed', '40N8164220789345W', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-06-22T12:49:26Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 7, 29, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', 'PHP WEB APPLICATION DEVELOPERS (PHP ONLY)', 'EWay w/ CVN (Test mode)', '10004', '00,Transaction Approved(Test CVN Gateway)', '1371906627', '0', '', '<ewaygateway>\r\n	<ewayCustomerID>87654321</ewayCustomerID>\r\n	<ewayTotalAmount>1000</ewayTotalAmount>\r\n	<ewayCustomerFirstName>123123</ewayCustomerFirstName>\r\n	<ewayCustomerLastName>123213</ewayCustomerLastName>\r\n	<ewayCustomerEmail></ewayCustomerEmail>\r\n	<ewayCustomerAddress>131313131</ewayCustomerAddress>\r\n	<ewayCustomerPostcode></ewayCustomerPostcode>\r\n	<ewayCustomerInvoiceDescription>PHP WEB APPLICATION DEVELOPERS (PHP ONLY)</ewayCustomerInvoiceDescription>\r\n	<ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n	<ewayCardHoldersName>213131</ewayCardHoldersName>\r\n	<ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n	<ewayCardExpiryMonth>11</ewayCardExpiryMonth>\r\n	<ewayCardExpiryYear>28</ewayCardExpiryYear>\r\n	\r\n	<ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n	<ewayOption1></ewayOption1>\r\n	<ewayOption2></ewayOption2>\r\n	<ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>10004</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', '123123', '123213', '131313131', NULL, '32131', '3123', '', 'AIA', '12313', NULL, '213131', '4444XXXXXXXX1111'),
(22, 14, 30, 'EWAY- CREDIT CARD', NULL, NULL, NULL, NULL, 'APPROVED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'CSH-AU-000001', 'e Commerce .Net Developer | P/T Optional (Q3)', 'EWay w/ CVN (Test mode)', '20096', '00,Transaction Approved(Test CVN Gateway)', '1371979207', '0', '', '<ewaygateway>\r\n	<ewayCustomerID>87654321</ewayCustomerID>\r\n	<ewayTotalAmount>1000</ewayTotalAmount>\r\n	<ewayCustomerFirstName>Damien</ewayCustomerFirstName>\r\n	<ewayCustomerLastName>Koh</ewayCustomerLastName>\r\n	<ewayCustomerEmail></ewayCustomerEmail>\r\n	<ewayCustomerAddress>159 Hellawell Road123123123</ewayCustomerAddress>\r\n	<ewayCustomerPostcode></ewayCustomerPostcode>\r\n	<ewayCustomerInvoiceDescription>e Commerce .Net Developer | P/T Optional (Q3)</ewayCustomerInvoiceDescription>\r\n	<ewayCustomerInvoiceRef>CSH-AU-000001</ewayCustomerInvoiceRef>\r\n	<ewayCardHoldersName>fdafasfda</ewayCardHoldersName>\r\n	<ewayCardNumber>4444XXXXXXXX1111</ewayCardNumber>\r\n	<ewayCardExpiryMonth>01</ewayCardExpiryMonth>\r\n	<ewayCardExpiryYear>25</ewayCardExpiryYear>\r\n	\r\n	<ewayTrxnNumber>CSH-AU-000001</ewayTrxnNumber>\r\n	<ewayOption1></ewayOption1>\r\n	<ewayOption2></ewayOption2>\r\n	<ewayOption3></ewayOption3>\r\n</ewaygateway>', '<ewayResponse><ewayTrxnStatus>True</ewayTrxnStatus><ewayTrxnNumber>20096</ewayTrxnNumber><ewayTrxnReference>CSH-AU-000001</ewayTrxnReference><ewayTrxnOption1/><ewayTrxnOption2/><ewayTrxnOption3/><ewayAuthCode>123456</ewayAuthCode><ewayReturnAmount>1000</ewayReturnAmount><ewayTrxnError>00,Transaction Approved(Test CVN Gateway)</ewayTrxnError></ewayResponse>\r\n', '127.0.0.1', '', 'Damien', 'Koh', '159 Hellawell Road123123123', NULL, 'Sunnybank Hills', 'Queensland', '', 'AUS', '12312313', NULL, 'fdafasfda', '4444XXXXXXXX1111'),
(23, 7, 31, 'PAYPAL', '2013-06-24 12:15:04', '2013-06-24 12:15:04', '3Y598132RA517273V', 'expresscheckout', 'Completed', '3Y598132RA517273V', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-06-24T12:15:05Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 7, 32, 'PAYPAL', '2013-06-24 12:32:29', '2013-06-24 12:32:29', '89D08810Y9119902F', 'expresscheckout', 'Completed', '89D08810Y9119902F', 'AUD', 'None', '0.64', '0.00', '0', 'Success', '2013-06-24T12:32:31Z', NULL, 10, 'AUD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `reset_pwd` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_user_roles_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `old_email`, `password`, `salt`, `role_id`, `guid`, `reset_pwd`, `created_at`, `updated_at`) VALUES
(11, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51c68a1305b4d7.41565261', NULL, '2013-01-27 02:41:35', '2013-06-23 05:39:31'),
(17, 'damienkoh', 'zlkoh.damien@gmail.com', '', '$2a$08$DcfnYiNofkT0SdZ6DuMJHOi3zJ82VYo00L..3xbCVCM.Q.KaNy9Ii', NULL, 2, '', NULL, '2013-03-20 11:53:23', '2013-06-08 14:21:51'),
(18, 'vlim', 'victorlim86@gmail.com', '', '$2a$08$U2tGYjF2a2RBVVcxWnFyQOlWLtHIMuwPBwhKGR3z1PYW0izSSge2m', NULL, 2, '', NULL, '2013-03-23 07:54:43', '2013-03-23 07:54:43'),
(19, 'victor', 'victor@test.com', '', '$2a$08$aVJNcGh3akd0eW9zbXJ4buNPfK7SUty4KOq14cYr39GyDW94NGjI2', NULL, 1, '', NULL, '2013-03-23 08:11:41', '2013-03-23 08:11:41'),
(20, 'dkoh', 'damien@test.com', '', '$2a$08$VjBtV3c4aVdxNm1aSmNMQuIipDB8OlRLM5138lqpHLNl/wumKEsvi', NULL, 2, '', NULL, '2013-03-28 06:26:33', '2013-03-28 06:26:33'),
(23, 'test', 'test@test.com', '', '$2a$08$LpQ4OkTN.JeZlAnvsTgpLOLZzQbo5NXFn5CvgcM.zpEcrlEZq9ZeG', NULL, 2, '', NULL, '2013-03-30 22:35:30', '2013-03-30 22:35:30'),
(24, 'zlkoh@hotmail.com', 'zlkoh@hotmail.com', '', '$2a$08$V5lssB6m7AM7Ui9FKO8ya.U2aFokHJUr.cbGLei4sCKjPvKp0iL26', NULL, 2, '', NULL, '2013-06-18 11:07:08', '2013-06-18 11:07:08'),
(26, 'jesslyn21@gmail.com', 'jesslyn21@gmail.com', '', '$2a$08$VvN0Vwz.EQmR1H4exaEIKO8L6xQ57p1vW4uJNHkdLFkd.44ko5Fyu', NULL, 1, '', NULL, '2013-06-23 09:17:41', '2013-06-23 09:17:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(14, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$mx.KzWgcFyFdl8OJ3HEhHuA71TeUkxO7XsJHasphjRF9rFuKCiTg2', NULL, 1, '514d5e258a2748.32488991', '2013-03-23 07:47:49', '2013-03-23 07:47:49'),
(15, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$KejLr31sNq6aWVJgzAVNYub0DMFi2s8jfB.UyP5nEPlwZZal0h6b2', NULL, 1, '51b7000b185dd9.98331869', '2013-06-11 10:46:35', '2013-06-11 10:46:35'),
(16, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51b7008f2c04f0.56753343', '2013-06-11 10:48:47', '2013-06-11 10:48:47'),
(17, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51b71b09cd2116.63841132', '2013-06-11 12:41:45', '2013-06-11 12:41:45'),
(18, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51c0519de06357.88934791', '2013-06-18 12:25:01', '2013-06-18 12:25:01'),
(19, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51c056ad94c125.70036245', '2013-06-18 12:46:37', '2013-06-18 12:46:37'),
(20, 'damienk', 'zlkoh.damien@gmail.com', 'zlkoh.damien@gmail.com', '$2a$08$FHxZr7lXAeQXg9zikl6Eyu8/eZ0PgFp73C8gHFwJNgeOOORN1lLBy', NULL, 1, '51c68a1305b4d7.41565261', '2013-06-23 05:39:31', '2013-06-23 05:39:31');

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
