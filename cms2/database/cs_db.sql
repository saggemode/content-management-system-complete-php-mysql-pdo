-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2020 at 10:17 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carnival_fee`
--

CREATE TABLE `carnival_fee` (
  `id` int(11) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carnival_fee`
--

INSERT INTO `carnival_fee` (`id`, `amount`) VALUES
(1, '300');

-- --------------------------------------------------------

--
-- Table structure for table `carnival_invoice`
--

CREATE TABLE `carnival_invoice` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `regid` varchar(255) NOT NULL,
  `carnival_fee` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carnival_invoice`
--

INSERT INTO `carnival_invoice` (`id`, `date`, `name`, `session`, `level`, `payment`, `program`, `regid`, `carnival_fee`, `invoice_no`, `confirmation_code`) VALUES
(1, '2018-06-27 17:39:59', 'paul smith abuchi', '2012/2013', 'nd1', '200', 'evening', 'YUPO678H', 'carnival fee', 'O8N1XQRI', '93708416'),
(2, '2018-07-07 09:59:01', 'paul smith abuchi', '2017/2018', 'nd1', '200', 'evening', 'YUPO678H', 'carnival fee', '4RSGM857', '64271530');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(39, 'fashions'),
(42, 'adoration'),
(43, 'news'),
(47, 'emma'),
(48, 'inocc'),
(49, 'fpno');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES
(41, 1527351394, 'back to vback', 'user', 24, 'umeh2880@gmail.com', 'iii.com', 'unknown-picture.png', 'back tot back', 'approve'),
(43, 1529153314, 'emma ifeanyi', 'user', 24, 'umeh288@gmail.com', 'eeee.com', 'unknown-picture.png', ' i love commen ting system', 'approve'),
(57, 1529484585, 'i no', 'user', 49, 'ibe@gmail.com', 'iii.com', 'unknown-picture.png', ' u domka ', 'approve'),
(58, 1529485422, 'umeh paul abuchi', 'admin', 49, 'umeh288@gmail.com', '', 'amer-wawonaview2001-800-bl.jpg', 'i love u', 'approve'),
(59, 1529485775, 'umeh paul abuchi', 'admin', 24, 'umeh288@gmail.com', '', 'amer-wawonaview2001-800-bl.jpg', 'thank you', 'unapprove'),
(60, 1529961052, 'emmanuel okaror ik', 'user', 48, 'uche@gmail.com', 'y.com', 'unknown-picture.png', ' this is just comment', 'pending'),
(61, 1530976285, 'umeh paul abuchi', 'admin', 48, 'umeh288@gmail.com', '', 'amer-wawonaview2001-800-bl.jpg', 'your comments is good', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `reason`, `message`, `date`) VALUES
(1, 'paul smith', 'paul smith', 'departmental fee', 'am finding it cooooooooooooooam finding it cooooooooooooooam finding it cooooooooooooooam finding it cooooooooooooooam finding it coooooooooooooo', '0000-00-00 00:00:00'),
(2, 'papaujpahapa', 'papaujpahapa', 'ajsgakjaag', 'sjgjdglsdlagldgdgagsagadgajgso', '2018-06-11 17:20:37'),
(3, 'hjdsojsgosg', 'hjdsojsgosg', 'fhlsdldhk', 'FLSLgflgsgLgFLSLgflgsgLgFLSLgflgsgLgFLSLgflgsgLgFLSLgflgsgLgFLSLgflgsgLg', '2018-06-11 17:24:32'),
(4, 'umeh paul', 'umeh paul', 'love', 'hate', '2018-06-26 21:37:28'),
(5, 'umeh paul', 'umeh paul', 'love', 'hate', '2018-06-26 21:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `departmental_fee`
--

CREATE TABLE `departmental_fee` (
  `id` int(11) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmental_fee`
--

INSERT INTO `departmental_fee` (`id`, `amount`) VALUES
(1, '500');

-- --------------------------------------------------------

--
-- Table structure for table `department_invoice`
--

CREATE TABLE `department_invoice` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `regid` varchar(255) NOT NULL,
  `department_fee` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_invoice`
--

INSERT INTO `department_invoice` (`id`, `date`, `name`, `session`, `level`, `payment`, `program`, `regid`, `department_fee`, `invoice_no`, `confirmation_code`, `image`) VALUES
(5, '2018-07-11 00:06:21', 'amadi blessing', '2017/2018', 'nd1', '500', 'Morning', 'UMFL1PDO', 'Departmental fee', 'SY0C95KJ', '07915238', ''),
(6, '2018-07-11 15:43:07', 'paul smith abuchi', '2017/2018', 'nd1', '500', 'evening', 'YUPO678H', 'Departmental fee', 'YHIQORA8', '06984135', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `image`) VALUES
(27, 'Facebook-Page-Cover-photo.png'),
(28, 'sohail card.jpg'),
(29, 'usman visiting cards.jpg'),
(30, 'visiting Card of nadeem.jpg'),
(31, '4.jpg'),
(32, '8.jpg'),
(33, '8.jpg'),
(34, '25.jpg'),
(35, '35.jpg'),
(36, '36.jpg'),
(37, 'achievements.jpg'),
(38, 'amer-halfdome-800.jpg'),
(39, 'amer-wawonaview2001-800-bl.jpg'),
(40, 'autumn_scene_3.jpg'),
(41, 'Interior32.jpg'),
(42, 'Interior34.jpg'),
(43, 'Landscape027.jpg'),
(44, 'Landscape029.jpg'),
(45, 'Landscape0076.jpg'),
(46, 'lava_steam_1024.jpg'),
(47, 'MM7095_0057.jpg'),
(48, 'MM7095_258.jpg'),
(49, 'mountainstream_800.jpg'),
(50, 'NALBankLobby1_1.jpg'),
(51, 'poli_poli_dead_trees_1024.jpg'),
(52, 'red.png'),
(53, 'snow.png'),
(54, 'sunset_10.jpg'),
(55, 'tweet-img1.jpg'),
(56, 'tweet-img3.jpg'),
(57, 'winter-landscape.jpg'),
(58, 'winter-scenery.jpg'),
(59, 'buildin9.jpg'),
(60, 'building2.jpg'),
(61, 'building3.jpg'),
(62, 'building6.jpg'),
(63, 'building7.jpg'),
(64, 'building10.jpg'),
(65, 'building11.jpg'),
(66, 'buildings4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `post_data` text NOT NULL,
  `views` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `author`, `author_image`, `image`, `categories`, `tags`, `post_data`, `views`, `status`) VALUES
(46, 1529427199, 'arrangements may need to be made:', 'admins', 'avatar-6.jpg', 'autumn_scene_3.jpg', 'pauls', 'land,email,paul,imo', 'service\r\nEndoscopy\r\n\r\nCOLONOSCOPY\r\n\r\nColonoscopy is a procedure that allows your doctor to look at the inner lining of your large intestine (rectum and colon). He or she uses a thin, flexible tube called a colonoscopy to look at the colon. A colonoscopy helps find ulcers colon polyps, and areas of inflammation or bleeding. During a colonoscopy, tissue samples can be collected and abnormal growths can be taken out. Colonoscopy can also be used as a screening test to check for cancer or precancerous growths in the colon or rectum\r\n\r\nThe colonoscopy is a thin, flexible tube that ranges from 48 in. (125 cm) to 72 in. (183 cm) long. A small video camera is attached to it, so that your doctor can take pictures or video of the large intestine (colon). The colonoscope can be used to look at the whole colon and the lower part of the small intestine. A test called sigmoiddoscopy shows only the rectum and the lower part of the colon.\r\nPREPARING FOR A COLONOSCOPY\r\n\r\nBefore this test, you will need to clean out your colon. Colon preparation takes 1 to 2 days, depending on which type of preparation your doctor recommends. Some preps may be taken the evening before the test. For many people, the bowel prep may be uncomfortable, and you may feel hungry on the clear liquid diet. Plan to stay home during your prep time since you will need to use the bathroom often. The colon preparation may causes loose, frequent stools and diarrhea so that your colon will be empty for the test. If you need to drink a special solution as part of your prep, be sure to have clear fruit juices or soft drinks\r\n\r\nColonoscopy is one of many tests that may be used to screen colon cancer. Other tests include sigmoidoscopy, stool tests, and computed tomographic colonography. Which screening test you choose depends on your risk, your preference, and your doctor. Talk to your doctor about what puts you at risk and what test is best for you\r\nGASTROSCOPY\r\n\r\nIs a procedure where a thin, flexible tube called an endoscope is used to look inside the oesophagus), stomach and first part of the small intestine (duodenum). It’s also sometimes referred to as an upper gastrointestinal endoscopy. The endoscope has a light and a camera\r\nPREPARING FOR A GASTROSCOPY\r\n\r\nIf you’re referred for a gastroscopy, you’ll be told whether you need to stop taking any of your medications.\r\n\r\nYou may need to stop taking any prescribed medicines for indigestion for up to two weeks before the procedure. This is because the medication can mask some of the problems gastroscopy could find.\r\n\r\nIf you’re taking any of the following medications, you should phone the endoscopy unit before your appointment, because special arrangements may need to be made:\r\n\r\n    Any medication used to treat diabetes\r\n    Any blood-thinning medication\r\n\r\nIt’s important that your stomach is empty during a gastroscopy, so the whole area can be seen clearly.\r\n\r\nYou’ll usually be asked not to eat anything for six to eight hours before the procedure, and to stop drinking two to three hours before the procedure\r\n', 1, 'publish'),
(47, 1529439171, 'hello my world id good', 'admin', 'amer-wawonaview2001-800-bl.jpg', '36.jpg', 'movie', 'land', 'hello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id goodhello my world id good', 3, 'publish'),
(48, 1529442473, 'hello bliess amadi', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'Interior32.jpg', 'movie', 'apul smith,um,heyey', 'smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith this is paul smith </p>', 12, 'publish'),
(49, 1529455870, 'hghthis is hhhghthis is hhhghthis is hhhghthis is hhh', 'admin', 'amer-wawonaview2001-800-bl.jpg', '36.jpg', 'movie', 'gi,gkk,lol,plp', 'this is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhghthis is hhhgh<br>', 25, 'publish'),
(51, 1529486531, 'There are a lot of more health issues that require emergency response', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'buildin9.jpg', 'news', 'good,dead', '<br>Ambulance Services<br><br>AMBULANCE EMERGENCY SERVICES IN ST NICHOLAS HOSPITAL.<br><br>If you suddenly develop some health challenge while working in the office that requires moving to health facility, there is need to call an ambulance. It could also be in the house and not just for the road accidents.<br><br>There are a lot of more health issues that require emergency response<br>We have a protocol of where the patients are taken to, so that the patient is not compelled to be taken to the hospital that owned the ambulance.<br><br>St. Nicholas Hospital Ambulances are well equipped to handle most emergency cases and to stabilize the patient.<br><br>SNH Ambulance service is available 24/7.<br><br>For emergency, please call +234 809 820 9820<br><br>', 1, 'publish'),
(52, 1529486626, 'Providing the highest standard of care for pregnant women, children and their families.', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'Interior32.jpg', 'news', 'house,death,hello', '<br>Antenatal Care<br><br>We recognise that pregnancy and birth are really important times for women and their families and we offer a complete range of maternity care. From midwife-led care for women with straightforward pregnancies to specialist care for women who have problems and medical conditions that necessitate close attention.<br><br>We aim to provide a safe and supportive environment for pregnancy and birth for you, your baby and your family. Whether your pregnancy is straightforward or more complicated, at all times we strive to provide excellent maternity care that meets your individual needs.<br><br>We have a comprehensive Antenatal care package which is individualised and focused to satisfy the wishes of our clients.<br><br>It is a highly interactive session that has enhanced our clients’ child bearing experience for years with expecting mothers and their partners gaining relevant information from experienced midwives on their pregnancy, childbirth and post-natal care.<br>What We Are Known For<br><br>    Providing the highest standard of care for pregnant women, children and their families.<br>    Individualised care tailored to your needs.<br>    Offering health education classes for expectant parents to help them prepare for their new arrival. Health education prepares you for labour, birth and the early days of being a parent, and what we teach may give you more details to make informed choices.<br>    Follow up visits to our clients ensures their well-being and demonstrate to us that mother and baby are doing well.<br><br><br>', 1, 'publish'),
(53, 1529486755, 'Dialysis services are provided 6 days of the week at 57, Campbell Street, Lagos Island.', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'building7.jpg', 'news', 'houde,image', 'services<br>Dialysis<br><br>The Dialysis Unit of St. Nicholas Hospital is dedicated to improving health outcomes for patients with end-stage renal disease (ESRD). Dialysis is a medical procedure in which the functions of a kidney to remove metabolic waste and excess water from the body are taking over by a machine. This may be done temporarily (days or weeks) or it may be carried out over a long time (years).<br><br>With 15,000 new cases of kidney failure occurring every year in Nigeria and statistics showing a further 30 million Nigerians suffering from kidney disease, it is apparent that the provision of dialysis is a critical service to our clients.<br><br>We have the busiest privately owned dialysis unit in Lagos which we operate to international standards.<br>Our Objectives<br><br>The primary goal is to ensure a safe procedure with the best possible therapeutic outcome. By combining the latest technology, convenient scheduling, and a compassionate staff, the Dialysis Unit of St. Nicholas Hospital strives to provide its patients with the highest quality of dialysis care.<br>Our Team<br><br>We are staffed by a team of doctors, specialist nephrology nurses with extensive experience in all aspects of renal nursing, renal technicians and nutritionists. Our highly-skilled staff work together to provide the best care possible and we emphasize compassion, comfort, and communication to ensure patients have all they need for the best possible experience.<br>Our Facility<br><br>We have 10-bed dialysis unit which is comfortable and spacious with all the equipment needed for dialysis. In addition, we have a separate dialysis unit in ICU for critically ill patients.<br>Operating Hours<br><br>Dialysis services are provided 6 days of the week at 57, Campbell Street, Lagos Island.<br><br><ul><li>    Monday – Friday: 7am to 8pm</li><li>    Saturday: 7am to 3pm</li></ul><br>However, we do offer 24-hour on call service for emergencies and weekends. We also run a home service for clients that wish to dialyze at home and with their equipment.', 2, 'publish'),
(54, 1529487021, 'Goals or care plans for nutritional or dietetic treatment will be realistic and agreed with the patient, or their carers. These includes:', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'building2.jpg', 'news', 'house,death,hello', 'services<br>Dietetics<br><br>Nutrition is as old as man. Hippocrates (5th Century BC), the father of Medicine wrote “Let thy food be thy medicine and thy medicine be thy food”. Dietitians provide dietetic counselling and nutritional intervention to prevent risk of diet related diseases and promote health through healthy eating habits as part of medical treatment.<br><br>Nutrition and dietetics plays an integral role in ensuring prophylactic and therapeutic care for clients while following the principle of nutritional management. We provide a comprehensive dietetic service to both in-patients and out-patients. The service exists to improve the health of the individual patient by appropriate nutrition intervention.<br>Our Core Responsibilities<br><br>Dieticians will evaluate and monitor dietetic intervention to help ensure a positive effect on patient’s nutritional status, aid the recovery process, control symptoms and improve wellbeing.<br><br>Goals or care plans for nutritional or dietetic treatment will be realistic and agreed with the patient, or their carers. These includes:<br><br><ol><li>    Individualized diet plan for patients</li><li>    Outpatient clinics and inpatient management</li><li>    Dietetics services and care for dialyzing patients</li><li>    Translation of prescribed diet to regular meals</li><li>    Nutritional assessment of clients/ patients</li><li>    Transcribing local available foods to appropriate diet therapy</li></ol><br>Our Team<br><br>The Dietetics Unit comprises of qualified and experienced dieticians who practice with a great deal of expertise. Our dieticians work co-operatively with other members of the multidisciplinary team to integrate the patient’s nutritional treatment into their over-all care.<br>Our Facilities<br><br>    A conducive medical nutrition outpatient clinic<br>    A well equipped kitchen for meal preparation<br>    Weight consultancy clinic<br>    A specialized renal outpatient clinic<br>    A well designed diet guide for specific therapeutic management<br><br>Clinic Days<br><br>    Mondays: Morning clinic (9am – 12 noon)<br>    Thursdays: Afternoon clinic (3pm – 6pm)<br><br>', 12, 'publish'),
(55, 1529487863, 'Our analytical systems are fully automated and designed to ensure patient safety, accuracy, and rapid turn-around times. Our Promise', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'autumn_scene_3.jpg', 'news', 'filer,sani,string', 'Laboratory ServicesThe Laboratory Services of St. Nicholas Hospital provides accurate and timely results which contributes immensely to the care of our patients. Laboratory investigations are essential for almost every patient who comes into contact with hospitals and an increasing number of patients receiving treatment in the community. In fact, more than three quarters of all medical diagnoses rely on laboratory investigations.Most tests carried out by laboratory scientists are done on blood, urine or other fluid or tissue samples. Within these are some routine tests that are performed in very large numbers and others which are rare and complex.What We DoWe are full-service computerized, accredited laboratory with experienced personnel and state-of-the-art equipment offering a broad menu of diagnostic testing, serving all inpatient and out-patient populations.We run a wide range of investigations. Our services include:-    Clinical Chemistry    Medical Microbiology    Haematology/ BGS    Immunoassay which includes tumour markers, fertility testing.    Pre and Post kidney testing for transplantation.    Drug monitoring for post-transplant patients.Our ServiceLaboratory testing is performed 24 hours a day, seven days a week. The Laboratory is staffed by experienced medical laboratory scientists using the latest in instrumentation.Our analytical systems are fully automated and designed to ensure patient safety, accuracy, and rapid turn-around times.Our PromiseSince 70% of all healthcare decisions are based on laboratory results, it is crucial to have confidence in the lab that provides these results. We are committed to providing a superior clinical laboratory service that enhances your clinical care by our medical staff.', 2, 'publish'),
(56, 1529508872, 'The St. Nicholas Hospital promise to you', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'tweet-img3.jpg', 'news', 'news,fashion,hello,jdudh', 'servicesNephrologyNephrology/Renal UnitNephrology is a specialty of medicine that concerns itself with the study of normal kidney function, kidney problems, the treatment of kidney problems and renal replacement therapy (dialysis and kidney transplantation).The Nephrology Unit aims to provide comprehensive, high quality, multidisciplinary, compassionate care in a friendly and supportive environment for people with kidney diseases and other conditions that affect or arise from the kidneys.Our ServicesThe Department provides the full range of renal treatments for patients with kidney disease. This includes clinics for patients with chronic kidney disease (CKD), patients with a kidney transplant and patients nearing kidney failure. We have an on-site haemodialysis unit and peritoneal dialysis unit.Kidney disease often coexists with other medical conditions such as heart disease, vascular disease and diabetes, and our team works closely with specialists from other disciplines to ensure that our patients receive the care that is appropriate to their individual health needs.The treatment and specialist services we provide includes:1. Dialysis    a) A dedicated outpatient facilities and support for home and community dialysis    b) Haemodialysis available in our hospital; we also support holiday haemodialysis    c) Peritoneal dialysis2. Acute kidney injury and chronic kidney disease care3. Anaemia management4. Conservative kidney management5. General and specialist outpatient clinics for people with:    a Advanced kidney disease    b Diabetes and renal disease6. Pre-kidney transplant service supported by counsellors and dietitians, to help prepare patients for transplant.7. Kidney transplants and post kidney transplantation follow up (recipient and donor).The first kidney transplant was done at Nigeria and the west African sub-region in 6/3/2000. With a dedicated renal transplant team we are able to give our patients with end stage renal failure, a better quality of life.Our StaffThe renal unit is staffed with a team of experts which is led by a Consultant Nephrologist, Dr Ebun Bamgboye supported by junior doctors, renal nurses, clinical nurse specialists, pharmacists, social workers and dieticians.The unit is also supported by a dedicated team of administrative staff and technical teams including IT and maintenance for all of our medical equipment.The St. Nicholas Hospital promise to youWe are passionate about putting the patient first, and aim to offer a consultant- delivered service. Each of the satellite units served by our renal unit has an on-site nephrologist presence at least twice a week, offering clinic and ward referral services.We know that receiving treatment for kidney conditions, such as dialysis, can be time-consuming for our patients, which is why we aim to make your care as convenient and as easy to access as possible.This is why we offer/run services from satellite units services from satellite units (which include other hospitals) and also support suitable patients who want to receive their dialysis at home.', 3, 'publish'),
(57, 1529614107, 'A better solution than the log book is an authentication system incorporated into the locking', 'admin', 'amer-wawonaview2001-800-bl.jpg', 'cactus.jpg', 'news', 'good,hew', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nthe most elemental way to accomplish this, but it has a lot of drawbacks. A person with malicious intent is likely to just bypass it.<br>A better solution than the log book is an authentication system incorporated into the locking devices, so that a smart card, token, or biometric scan is required to unlock the doors, and a record is made of the identity of each person who enters.<br>A video surveillance camera, placed in a location that makes it difficult to tamper with or disable (or even to find) but gives a good view of persons entering and leaving should supplement the log book or electronic access system. Surveillance cams can monitor continuously, or they can use motion detection technology to record only when someone is moving about. They can even be set up to send e-mail or cell phone notification if motion is detected when it shouldn\'t be (such as after hours).<br>1.     Make sure the most vulnerable devices are in that locked room<br>Remember, it\'s not just the servers you have to worry about. A hacker can plug a laptop into a hub and use sniffer software to capture data traveling across the network. Make sure that as many of your network devices as possible are in that locked room, or if they need to be in a different area, in a locked closet elsewhere in the building.<br>2.     Use rack mount servers<br>Rack mount servers not only take up less server room real estate; they are also easier to secure. Although smaller and arguably lighter than (some) tower systems, they can easily be locked into closed racks that, once loaded with several servers, can then be bolted to the floor, making the entire package almost impossible to move, much less to steal.<br>3.     Don\'t forget the workstations<br>Hackers can use any unsecured computer that\'s connected to the network to access or delete information that\'s important to your business. Workstations at unoccupied desks or in empty offices (such as those used by employees who are on vacation or have left the company and not yet been replaced) or at locations easily accessible to outsiders, such as the front receptionist\'s desk, are particularly vulnerable.<br><br>', 4, 'publish'),
(58, 1530053594, 'Our Service Mission', 'admin', 'amer-wawonaview2001-800-bl.jpg', '05dd3be3ce9822-larcade-shopping-suites-plaza-complex-mall-for-rent-new-owerri-owerri-imo.jpg', 'emma', 'vii,sio,hello', 'VisionTo be the first choice for healthcare solutions of international standards in Nigeria. This is encapsulated in the Group\'s Integrated Healthcare Delivery Strategy which has given Hygeia the unparalleled advantage of delivering quality healthcare programmes to all sectors of the Nigerian populace.MissionTo assist our client restore and sustain their well being.Our Service MissionWe constantly seek to deliver a \'wow\' service.Core ValuesCore Values>> Integrity>> Compassion>> Attentiveness>> Respect>> Excellence', 5, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `session_year`
--

CREATE TABLE `session_year` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_year`
--

INSERT INTO `session_year` (`id`, `year`) VALUES
(1, '2011/2012'),
(2, '2012/2013'),
(3, '2013/2014'),
(4, '2014/2015'),
(5, '2015/2016'),
(6, '2016/2017'),
(7, '2017/2018'),
(8, '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `shirt_fee`
--

CREATE TABLE `shirt_fee` (
  `id` int(11) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt_fee`
--

INSERT INTO `shirt_fee` (`id`, `amount`) VALUES
(2, '890');

-- --------------------------------------------------------

--
-- Table structure for table `shirt_invoice`
--

CREATE TABLE `shirt_invoice` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `regid` varchar(255) NOT NULL,
  `shirt_fee` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt_invoice`
--

INSERT INTO `shirt_invoice` (`id`, `date`, `name`, `session`, `level`, `payment`, `program`, `regid`, `shirt_fee`, `invoice_no`, `confirmation_code`) VALUES
(3, '2018-07-11 00:31:51', 'amadi blessing', '2017/2018', 'nd1', '700', 'Morning', 'UMFL1PDO', 'Shirt fee', '9L1RUHOW', '91472068'),
(4, '2018-07-11 00:32:45', 'amadi blessing', '2017/2018', 'nd1', '700', 'Morning', 'UMFL1PDO', 'Shirt fee', '9RAC6VKB', '83572940'),
(5, '2018-07-11 00:43:04', 'amadi blessing', '2017/2018', 'nd2', '700', 'Morning', 'UMFL1PDO', 'Shirt fee', '2HO417GA', '86470139'),
(6, '2018-07-11 15:27:40', 'paul smith abuchi', '2017/2018', 'nd1', '700', 'evening', 'YUPO678H', 'Shirt fee', 'KEN5DJOQ', '64180925');

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `regid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`id`, `date`, `name`, `password`, `email`, `phone`, `program`, `gender`, `level`, `dob`, `image`, `regno`, `regid`) VALUES
(1, '0000-00-00', 'paul smith abuchi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'umeh288@gmail.com', '07038655954', 'evening', 'male', 'hnd2', '2018-06-27', 'mxbz_2002.jpg', '16eh/0001/cs', 'YUPO678H'),
(10, '2018-06-20', 'uche ibe', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'uche@gmail.com', '07065678544', 'weekend', 'male', 'hnd2', '2018-06-30', '25.jpg', '16eh/678/cs', 'XA6L9YQ0'),
(11, '2018-06-21', 'amadi blessing', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'bliza@gmail.com', '09056789000', 'Morning', 'female', 'nd1', '2018-07-07', 'recommend2.jpg', '16eh/999/cs', 'UMFL1PDO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `full_name`, `username`, `email`, `image`, `password`, `role`, `details`) VALUES
(26, 1234567856, 'umeh paul abuchi', 'admin', 'umeh288@gmail.com', 'picture1.jpg', '', 'admin', 'this is paul smith umeh the ownwer og thod gteat sisyerekjgslggasgogioagsogagfgathis is paul smith umeh the ownwer og thod gteat sisyerekjgslggasgogioagsogagfga'),
(39, 2147483647, 'author umeh paul ', 'admins', 'author$gmail.com', 'avatar-6.jpg', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'author', 'i am the author of theis great site and feel free to comment o it  pleae my bros make i yam or cocoyam u na wella');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carnival_fee`
--
ALTER TABLE `carnival_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carnival_invoice`
--
ALTER TABLE `carnival_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departmental_fee`
--
ALTER TABLE `departmental_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_invoice`
--
ALTER TABLE `department_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_year`
--
ALTER TABLE `session_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shirt_fee`
--
ALTER TABLE `shirt_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shirt_invoice`
--
ALTER TABLE `shirt_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carnival_fee`
--
ALTER TABLE `carnival_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carnival_invoice`
--
ALTER TABLE `carnival_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departmental_fee`
--
ALTER TABLE `departmental_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department_invoice`
--
ALTER TABLE `department_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `session_year`
--
ALTER TABLE `session_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shirt_fee`
--
ALTER TABLE `shirt_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shirt_invoice`
--
ALTER TABLE `shirt_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
