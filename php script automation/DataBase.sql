-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2021 at 10:32 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_action`
--

CREATE TABLE `tbl_action` (
  `id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_action`
--

INSERT INTO `tbl_action` (`id`, `title`) VALUES
(1, 'ورود'),
(2, 'خروج'),
(3, 'ایجاد درخواست'),
(4, 'ویرایش درخواست'),
(5, 'امضاء درخواست'),
(6, 'ارجاع درخواست'),
(7, 'حذف درخواست'),
(8, 'پرینت درخواست'),
(9, 'مشاهده درخواست'),
(10, 'پاسخ دادن به درخواست'),
(11, 'ثبت شماره درخواست'),
(12, 'ویرایش درخواست قبل از چاپ'),
(13, 'ناموفق بودن ورود'),
(14, 'افزایش مهلت پاسخگویی');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dabirkhone`
--

CREATE TABLE `tbl_dabirkhone` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middel_letter_in` varchar(255) DEFAULT NULL,
  `middel_letter_internal` varchar(255) DEFAULT NULL,
  `middel_letter_out` varchar(255) DEFAULT NULL,
  `startNumberLetter` varchar(255) DEFAULT NULL,
  `current_number` varchar(255) DEFAULT '1',
  `levelId` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_dabirkhone`
--

INSERT INTO `tbl_dabirkhone` (`id`, `name`, `middel_letter_in`, `middel_letter_internal`, `middel_letter_out`, `startNumberLetter`, `current_number`, `levelId`) VALUES
(1, 'دبیرخانه مرکزی', 'و', 'د', 'ص', '6401', '6484', 9),
(2, 'دبیرخانه مرکز تحقیقات', 'م و', ' م د', 'م ص', '120', '10', 41),
(3, 'دبیرخانه همایش', 'و هـ', '', 'ص هـ', '5', '7', 43);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_create` varchar(100) NOT NULL,
  `date_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`id`, `name`, `name_create`, `date_create`) VALUES
(1, 'ایام هفته_001.jpg', '1610940207-1.jpg', '1610940207'),
(2, 'برنامه سجاد بافنده.jpeg', '1610940207-2.jpeg', '1610940207'),
(3, 'photo_2021-01-09_08-17-49.jpg', '1610940207-3.jpg', '1610940207'),
(4, 'letter.txt', '1610940207-4.txt', '1610940207');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forward_type`
--

CREATE TABLE `tbl_forward_type` (
  `name` varchar(255) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_forward_type`
--

INSERT INTO `tbl_forward_type` (`name`, `id`) VALUES
('جهت امضاء', 1),
('جهت اطلاع', 2),
('جهت پیگیری', 3),
('جهت اقدام', 4),
('جهت ارسال', 5),
('جهت دستور', 7),
('جهت استحضار', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_letter`
--

CREATE TABLE `tbl_letter` (
  `id` int(255) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `text` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `dabirId` int(255) DEFAULT NULL,
  `date_create` varchar(255) DEFAULT NULL,
  `date_signature` varchar(255) DEFAULT NULL,
  `date_numLetter` varchar(255) DEFAULT NULL,
  `numLetter` varchar(100) DEFAULT NULL,
  `archive` int(1) NOT NULL DEFAULT 0,
  `levelId_create` int(255) NOT NULL,
  `levelId_signature` int(255) DEFAULT NULL,
  `levelId_Recive` text DEFAULT NULL,
  `levelId_Cc` text DEFAULT NULL,
  `file` int(1) DEFAULT NULL,
  `input` int(1) DEFAULT 0,
  `print_size` int(1) DEFAULT 2,
  `date_save` varchar(255) DEFAULT NULL,
  `date_number_input` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_letter`
--

INSERT INTO `tbl_letter` (`id`, `subject`, `text`, `description`, `status`, `dabirId`, `date_create`, `date_signature`, `date_numLetter`, `numLetter`, `archive`, `levelId_create`, `levelId_signature`, `levelId_Recive`, `levelId_Cc`, `file`, `input`, `print_size`, `date_save`, `date_number_input`) VALUES
(1, 'تست', '<p>سلام علیکم؛</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p><p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p>\r\n<p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\nسوال این است که چه کارهایی جرم تلقی می شودو دقیقا مفهوم جرم چیست و محدوده کارهای مجاز افراد جامعه کجاست؟ برابر قانون مجازات اسلامی تمامی جرایم، مشخص شده و در قانون آمده است وبا تعریف واضح از مفهوم جرم می گوید هر فعل یاترک فعلی که در قانون برای آن مجازات تعیین شده باشد، جرم محسوب می‌شود. بنابراین اولین چیزی که باید به آن توجه کرد، این است که جرم بی شک تنها، انجام کار نیست. در برخی مواقع عدم انجام کار نیز جرم است؛ مثلا در هنگام تصادف اگر کسی در جای خلوت به شخصی صدمه زده و او را رها می کند و با این رهاسازی آسیب بیشتری به شخص وارد می شود یا از خونریزی زیاد می میرد، این ترک فعل، جرم محسوب می شود.</p>\r\n<p>مفهوم جرم چیست و چگونه می توان معنی واقعی جرم را دانست۳ سال قبل کیفری ۰\r\n\r\n', '', 1, 1, '1610940207', '1610940858', '1610940858', '1313/4556', 0, 48, 48, '48', '', 1, 0, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_letter_recive`
--

CREATE TABLE `tbl_letter_recive` (
  `id` int(255) NOT NULL,
  `letterId` int(255) NOT NULL,
  `levelId` int(255) NOT NULL,
  `forwardLevelId` int(255) DEFAULT NULL,
  `recive_status` int(1) NOT NULL DEFAULT 0,
  `read_status` int(1) NOT NULL DEFAULT 0,
  `archive` int(1) NOT NULL DEFAULT 0,
  `description` varchar(1000) DEFAULT NULL,
  `date_send` varchar(20) DEFAULT NULL,
  `date_view` varchar(20) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `date_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_letter_recive`
--

INSERT INTO `tbl_letter_recive` (`id`, `letterId`, `levelId`, `forwardLevelId`, `recive_status`, `read_status`, `archive`, `description`, `date_send`, `date_view`, `answer`, `date_answer`) VALUES
(1, 1, 48, 9, 4, 1, 0, '', '1606134306', '1606134367', NULL, NULL),
(2, 1, 9, 48, 3, 1, 0, '', '1606134389', '1606134418', NULL, NULL),
(3, 1, 48, 9, 5, 1, 0, '', '1606134468', '1606134764', NULL, NULL),
(4, 1, 12, 48, 1, 0, 0, 'تست ارجاع', '1610940721', NULL, NULL, NULL),
(5, 1, 17, 48, 2, 0, 0, 'سیبیبس', '1610940822', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id` int(255) NOT NULL,
  `semat` varchar(255) NOT NULL,
  `semattop` varchar(1000) DEFAULT NULL,
  `signature_status` int(1) NOT NULL DEFAULT 0,
  `parentId` int(11) NOT NULL DEFAULT 0,
  `userId` int(255) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `semat`, `semattop`, `signature_status`, `parentId`, `userId`, `status`) VALUES
(9, 'دبیرخانه مرکزی', '', 0, 0, 7, 1),
(12, 'رئیس هیئت امناء', 'حضرت آیت الله', 1, 9, 30, 1),
(13, 'نایب رئیس هیئت امناء', 'جناب آقای حاج', 1, 12, 31, 1),
(14, 'رئیس هیئت مدیره', 'جناب حجت الاسلام والمسلمین حاج', 1, 12, 32, 1),
(15, 'خزانه دار', 'جناب آقای دکتر', 1, 12, 33, 1),
(16, 'دبیرکل', 'جناب آقای دکتر', 1, 12, 29, 1),
(17, 'مدیراجرایی', 'جناب آقای', 1, 16, 21, 1),
(18, 'مسئول دفتر', '', 0, 17, 7, 1),
(19, 'کارپرداز و پیک', '', 0, 18, 11, 1),
(20, 'خدمات', '', 0, 18, 14, 1),
(21, 'واحد گرافیک', '', 0, 17, 10, 1),
(22, 'مسئول واحد زنان', '', 0, 17, 16, 1),
(23, 'کارمند واحد زنان', '', 0, 22, 25, 1),
(24, 'مدیر مسئول نشریه کارت قرمز', 'جناب آقای دکتر', 0, 16, 29, 1),
(25, 'سردبیر نشریه کارت قرمز', '', 0, 24, 12, 1),
(26, 'روابط عمومی', '', 0, 17, 36, 1),
(27, 'مسئول امور مالی', '', 0, 17, 15, 1),
(28, 'کارمند امور مالی', '', 0, 27, 17, 1),
(29, 'مسئول کلینیک ترک سیگار', '', 0, 17, 26, 1),
(30, 'متصدی کلینیک ترک سیگار', '', 0, 29, 28, 1),
(31, 'مسئول واحد فرآموز', '', 0, 17, 22, 1),
(32, 'مربی واحد فرآموز1', '', 0, 31, 24, 1),
(33, 'مربی واحد فرآموز2', '', 0, 31, 23, 1),
(34, 'مربی واحد فرآموز3', '', 0, 31, 19, 1),
(35, 'رئیس مرکز تحقیقات کنترل دخانیات', 'ریاست محترم مرکز تحقیقات کنترل دخانیات', 1, 41, 29, 1),
(36, 'کارشناس پژوهشی مرکز تحقیقات', '', 0, 35, 18, 1),
(37, 'کارشناس پژوهشی مرکز تحقیقات2', '', 0, 35, 20, 1),
(38, 'کارشناس پژوهشی مرکز تحقیقات3', '', 0, 35, 9, 1),
(39, 'کمک پژوهش گر', '', 0, 35, 13, 1),
(40, ' 	نایب رئیس هیئت مدیره', 'جناب حجت الاسلام والمسلمین حاج', 1, 12, 34, 1),
(41, 'دبیرخانه مرکزتحقیقات', '', 0, 9, 9, 1),
(42, 'عضو ستاد همایش 1', '', 0, 45, 21, 1),
(43, 'دبیرخانه همایش', '', 0, 9, 7, 1),
(44, 'عضو ستاد همایش 2', '', 0, 45, 16, 1),
(45, 'دبیرکل همایش', '', 1, 43, 29, 1),
(46, 'مسئول امور شهرستان ها', '', 0, 17, 35, 1),
(47, 'کارمند امور شهرستان ها', '', 0, 46, 17, 1),
(48, 'کارشناس دبیرخانه مرکزی', 'کارشناس محترم دبیرخانه مرکزی', 1, 9, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_option`
--

CREATE TABLE `tbl_option` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `setting` varchar(255) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_option`
--

INSERT INTO `tbl_option` (`id`, `name`, `setting`, `value`) VALUES
(1, 'محدودیت تعداد نتایج در هر صفحه', 'limit_row_view', '100'),
(2, 'فاصله زمانی خروج کاربر ', 'time_sleep_user', '900'),
(3, 'مدت زمان ماندگاری کوکی کاربر', 'time_live_cookie', '18000'),
(4, 'حداکثر حجم فایل پیوست نامه', 'file_upload_size', '419430400'),
(6, 'فاصله از سمت راست برگه', 'a4_right_print_margin', '5'),
(7, 'فاصله از بالای برگه', 'a4_top_print_margin', '10'),
(10, 'فاصله از سمت چپ برگه', 'a4_left_print_margin', '5'),
(11, 'فاصله از پایین برگه', 'a4_bottom_print_margin', '0'),
(12, 'فاصله از سمت راست برگه', 'a5_right_print_margin', '5'),
(13, 'فاصله از بالای برگه', 'a5_top_print_margin', '5'),
(14, 'فاصله از سمت چپ برگه', 'a5_left_print_margin', '8'),
(15, 'فاصله از پایین برگه', 'a5_bottom_print_margin', '0'),
(17, 'سایز فونت', 'a4_print_size_font', '16'),
(18, 'سایز فونت', 'a5_print_size_font', '14'),
(19, 'فاصله شماره نامه از سمت چپ ', 'a4_print_space_numberletter', '120'),
(20, 'فاصله شماره نامه از سمت چپ', 'a5_print_space_numberletter', '110'),
(21, 'فاصله ما بین شماره نامه و ابتدای نامه', 'a4_print_space_number_start', '7'),
(22, 'فاصله ما بین شماره نامه و ابتدای نامه', 'a5_print_space_number_start', '1'),
(23, 'فاصله خطوط', 'a4_print_line_height', '25'),
(24, 'فاصله خطوط', 'a5_print_line_height', '22'),
(25, 'فاصله رونوشت از امضاء', 'a4_print_spaceCC', '90'),
(26, 'فاصله رونوشت از امضاء', 'a5_print_spaceCC', '90'),
(27, 'هدر سربرگ A4', 'a4_print_Header_Page', 'A4.jpg'),
(29, 'هدر سربرگ A5', 'a5_print_Header_Page', 'A5.jpg'),
(31, 'تعداد کلمه در برگه A4', 'a4_print_countWord', '400'),
(32, 'تعداد کلمه در برگه A5', 'a5_print_countWord', '400'),
(33, 'فاصله شماره نامه از بالای صفحه برگه A4', 'a4_print_letternumber_top', '30'),
(34, 'فاصله شماره نامه از بالای صفحه برگه A5', 'a5_print_letternumber_top', '15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phone`
--

CREATE TABLE `tbl_phone` (
  `id` int(255) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `adres` varchar(1000) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `tell` varchar(255) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `userId` int(255) NOT NULL,
  `work_company` varchar(255) DEFAULT NULL,
  `work_tell` varchar(255) DEFAULT NULL,
  `work_email` varchar(255) DEFAULT NULL,
  `work_fax` varchar(255) DEFAULT NULL,
  `work_website` varchar(255) DEFAULT NULL,
  `work_adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `id` int(255) NOT NULL,
  `letter_id` int(255) DEFAULT NULL,
  `action_id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `date_action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`id`, `letter_id`, `action_id`, `user_id`, `comment`, `date_action`) VALUES
(1, 0, 13, 0, 'نام کاربری:admin', '1597260976'),
(2, 0, 1, 6, '', '1597260984'),
(3, 0, 2, 6, '', '1597260994'),
(4, 0, 1, 6, '', '1597262462'),
(5, 0, 2, 6, '', '1597262547'),
(6, 0, 1, 6, '', '1597262553'),
(7, 0, 2, 6, '', '1597262664'),
(8, 0, 1, 7, '', '1597262672'),
(9, 0, 2, 7, '', '1597262843'),
(10, 0, 1, 6, '', '1597262852'),
(11, 0, 2, 6, '', '1597262882'),
(12, 0, 1, 7, '', '1597262903'),
(13, 0, 2, 7, '', '1597262924'),
(14, 0, 1, 7, '', '1597263410'),
(15, 0, 2, 7, '', '1597263413'),
(16, 0, 1, 6, '', '1606134160'),
(17, 0, 3, 6, 'تست', '1606134218'),
(18, 0, 2, 6, '', '1606134244'),
(19, 0, 1, 7, '', '1606134254'),
(20, 1, 4, 7, '', '1606134281'),
(21, 1, 4, 7, 'تست', '1606134289'),
(22, 1, 6, 7, '', '1606134306'),
(23, 0, 2, 7, '', '1606134339'),
(24, 0, 1, 6, '', '1606134344'),
(25, 1, 9, 6, '', '1606134367'),
(26, 1, 6, 6, '', '1606134389'),
(27, 0, 2, 6, '', '1606134396'),
(28, 0, 1, 7, '', '1606134405'),
(29, 1, 9, 7, '', '1606134418'),
(30, 1, 9, 7, '', '1606134452'),
(31, 1, 6, 7, '', '1606134468'),
(32, 0, 2, 7, '', '1606134473'),
(33, 0, 1, 6, '', '1606134478'),
(34, 1, 9, 6, '', '1606134485'),
(35, 1, 9, 6, '', '1606134499'),
(36, 1, 9, 6, '', '1606134764'),
(37, 0, 1, 6, '', '1610939878'),
(38, 1, 4, 6, '', '1610939888'),
(39, 1, 3, 6, 'تست', '1610940207'),
(40, 1, 4, 6, '', '1610940500'),
(41, 1, 3, 6, 'تست', '1610940514'),
(42, 1, 9, 6, '', '1610940537'),
(43, 1, 4, 6, '', '1610940545'),
(44, 1, 4, 6, 'تست', '1610940555'),
(45, 1, 6, 6, '', '1610940721'),
(46, 1, 9, 6, '', '1610940724'),
(47, 1, 4, 6, '', '1610940731'),
(48, 1, 4, 6, '', '1610940758'),
(49, 1, 4, 6, '', '1610940784'),
(50, 1, 4, 6, '', '1610940803'),
(51, 1, 4, 6, 'تست', '1610940815'),
(52, 1, 6, 6, '', '1610940822'),
(53, 1, 4, 6, '', '1610940824'),
(54, 1, 5, 6, '', '1610940853'),
(55, 1, 4, 6, 'تست', '1610940858'),
(56, 1, 9, 6, '', '1610940864'),
(57, 0, 1, 6, '', '1613498638'),
(58, 0, 1, 7, '', '1613577722'),
(59, 1, 8, 7, '', '1613577730'),
(60, 1, 8, 7, '', '1613577885'),
(61, 1, 8, 7, '', '1613577938'),
(62, 1, 8, 7, '', '1613577996'),
(63, 1, 8, 7, '', '1613578097'),
(64, 1, 8, 7, '', '1613578138'),
(65, 1, 8, 7, '', '1613578194'),
(66, 1, 8, 7, '', '1613578254'),
(67, 1, 8, 7, '', '1613578305'),
(68, 1, 8, 7, '', '1613578411'),
(69, 1, 8, 7, '', '1613578723'),
(70, 1, 8, 7, '', '1613578811'),
(71, 1, 8, 7, '', '1613578932'),
(72, 1, 8, 7, '', '1613578988'),
(73, 1, 8, 7, '', '1613579018'),
(74, 1, 8, 7, '', '1613579040'),
(75, 1, 8, 7, '', '1613579160'),
(76, 1, 8, 7, '', '1613579183'),
(77, 1, 8, 7, '', '1613579251'),
(78, 1, 8, 7, '', '1613579255'),
(79, 1, 8, 7, '', '1613579289'),
(80, 1, 8, 7, '', '1613579317'),
(81, 1, 8, 7, '', '1613579408'),
(82, 1, 8, 7, '', '1613579444'),
(83, 1, 8, 7, '', '1613579482'),
(84, 1, 8, 7, '', '1613579513'),
(85, 1, 8, 7, '', '1613579527'),
(86, 1, 8, 7, '', '1613579594'),
(87, 1, 8, 7, '', '1613579648'),
(88, 1, 8, 7, '', '1613579659'),
(89, 1, 8, 7, '', '1613579800'),
(90, 1, 8, 7, '', '1613579823'),
(91, 1, 8, 7, '', '1613579834'),
(92, 1, 8, 7, '', '1613579881'),
(93, 1, 8, 7, '', '1613579895'),
(94, 1, 8, 7, '', '1613579910'),
(95, 1, 8, 7, '', '1613579942'),
(96, 1, 8, 7, '', '1613579966'),
(97, 1, 8, 7, '', '1613579981'),
(98, 1, 8, 7, '', '1613579991'),
(99, 1, 8, 7, '', '1613580048'),
(100, 1, 8, 7, '', '1613580215'),
(101, 1, 8, 7, '', '1613580220'),
(102, 1, 8, 7, '', '1613580359'),
(103, 1, 8, 7, '', '1613580380'),
(104, 1, 8, 7, '', '1613580415'),
(105, 1, 8, 7, '', '1613580429'),
(106, 1, 8, 7, '', '1613580446'),
(107, 1, 8, 7, '', '1613580451'),
(108, 1, 8, 7, '', '1613580467'),
(109, 0, 1, 7, '', '1613580516'),
(110, 1, 8, 7, '', '1613580521'),
(111, 1, 8, 7, '', '1613580538'),
(112, 1, 8, 7, '', '1613580542'),
(113, 1, 8, 7, '', '1613580565'),
(114, 1, 8, 7, '', '1613580568'),
(115, 1, 8, 7, '', '1613580653'),
(116, 1, 8, 7, '', '1613580695'),
(117, 0, 1, 7, '', '1613580720'),
(118, 1, 8, 7, '', '1613580725'),
(119, 0, 1, 7, '', '1613580812'),
(120, 1, 12, 7, '', '1613580819'),
(121, 1, 8, 7, '', '1613580822'),
(122, 1, 8, 7, '', '1613580974'),
(123, 1, 8, 7, '', '1613581009'),
(124, 1, 8, 7, '', '1613581048'),
(125, 1, 8, 7, '', '1613581135'),
(126, 1, 8, 7, '', '1613581165'),
(127, 1, 8, 7, '', '1613581207'),
(128, 1, 8, 7, '', '1613581338'),
(129, 1, 8, 7, '', '1613581376'),
(130, 1, 8, 7, '', '1613581421'),
(131, 1, 8, 7, '', '1613581470'),
(132, 1, 8, 7, '', '1613581505'),
(133, 1, 8, 7, '', '1613581540'),
(134, 1, 8, 7, '', '1613581715'),
(135, 1, 8, 7, '', '1613581763'),
(136, 1, 8, 7, '', '1613581805'),
(137, 1, 8, 7, '', '1613581834'),
(138, 1, 8, 7, '', '1613581901'),
(139, 1, 8, 7, '', '1613581938'),
(140, 1, 8, 7, '', '1613581990'),
(141, 1, 8, 7, '', '1613582028'),
(142, 1, 8, 7, '', '1613582253'),
(143, 1, 8, 7, '', '1613582280'),
(144, 1, 8, 7, '', '1613582308'),
(145, 1, 8, 7, '', '1613582328'),
(146, 1, 8, 7, '', '1613582370'),
(147, 1, 8, 7, '', '1613582471'),
(148, 1, 8, 7, '', '1613582544'),
(149, 1, 8, 7, '', '1613582581'),
(150, 1, 8, 7, '', '1613582601'),
(151, 1, 8, 7, '', '1613582603'),
(152, 1, 8, 7, '', '1613582635'),
(153, 1, 8, 7, '', '1613582661'),
(154, 1, 8, 7, '', '1613582703'),
(155, 1, 8, 7, '', '1613582732'),
(156, 1, 8, 7, '', '1613582770'),
(157, 1, 8, 7, '', '1613582820'),
(158, 1, 8, 7, '', '1613582927'),
(159, 1, 8, 7, '', '1613583080'),
(160, 1, 8, 7, '', '1613583835'),
(161, 1, 8, 7, '', '1613583865'),
(162, 1, 8, 7, '', '1613583870'),
(163, 1, 8, 7, '', '1613583934'),
(164, 1, 8, 7, '', '1613583949'),
(165, 1, 8, 7, '', '1613583990'),
(166, 1, 8, 7, '', '1613584003'),
(167, 1, 8, 7, '', '1613584015'),
(168, 1, 8, 7, '', '1613584531'),
(169, 1, 8, 7, '', '1613584534'),
(170, 1, 8, 7, '', '1613584577'),
(171, 1, 8, 7, '', '1613584616'),
(172, 1, 8, 7, '', '1613584628'),
(173, 1, 8, 7, '', '1613584675'),
(174, 1, 8, 7, '', '1613584736'),
(175, 1, 8, 7, '', '1613584842'),
(176, 1, 8, 7, '', '1613584929'),
(177, 1, 8, 7, '', '1613584979'),
(178, 1, 8, 7, '', '1613585025'),
(179, 1, 8, 7, '', '1613585069'),
(180, 1, 8, 7, '', '1613585132'),
(181, 1, 8, 7, '', '1613585151'),
(182, 1, 8, 7, '', '1613585234'),
(183, 1, 8, 7, '', '1613585285'),
(184, 1, 8, 7, '', '1613585309'),
(185, 1, 8, 7, '', '1613585321'),
(186, 1, 8, 7, '', '1613585380'),
(187, 1, 8, 7, '', '1613585437'),
(188, 1, 8, 7, '', '1613585504'),
(189, 1, 8, 7, '', '1613585542'),
(190, 1, 8, 7, '', '1613585544'),
(191, 1, 8, 7, '', '1613585585'),
(192, 1, 8, 7, '', '1613585652'),
(193, 1, 8, 7, '', '1613585674'),
(194, 1, 8, 7, '', '1613585721'),
(195, 1, 8, 7, '', '1613585768'),
(196, 1, 8, 7, '', '1613585801'),
(197, 1, 8, 7, '', '1613585845'),
(198, 1, 8, 7, '', '1613585888'),
(199, 1, 8, 7, '', '1613586050'),
(200, 1, 8, 7, '', '1613586116'),
(201, 1, 8, 7, '', '1613586152'),
(202, 0, 2, 7, '', '1613586662'),
(203, 0, 1, 6, '', '1613586667'),
(204, 0, 1, 7, '', '1613625768'),
(205, 1, 8, 7, '', '1613625773'),
(206, 1, 8, 7, '', '1613625851'),
(207, 1, 8, 7, '', '1613625874'),
(208, 1, 8, 7, '', '1613625915'),
(209, 0, 1, 7, '', '1613746364'),
(210, 1, 8, 7, '', '1613746370'),
(211, 1, 8, 7, '', '1613746378'),
(212, 0, 1, 6, '', '1628911878'),
(213, 0, 1, 6, '', '1629598574'),
(214, 0, 1, 6, '', '1629598661'),
(215, 0, 1, 7, '', '1630479784');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tell` varchar(12) DEFAULT NULL,
  `dt` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `signature` int(1) DEFAULT 0,
  `signaturepic` varchar(100) DEFAULT NULL,
  `userpic` varchar(100) DEFAULT NULL,
  `power` int(1) NOT NULL DEFAULT 1,
  `apiKey` varchar(100) DEFAULT NULL,
  `ipStatic` varchar(100) DEFAULT NULL,
  `secretKey` varchar(100) DEFAULT NULL,
  `css` varchar(255) DEFAULT NULL,
  `sessions` varchar(255) DEFAULT NULL,
  `chkdate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `code`, `phone`, `email`, `address`, `username`, `password`, `tell`, `dt`, `status`, `signature`, `signaturepic`, `userpic`, `power`, `apiKey`, `ipStatic`, `secretKey`, `css`, `sessions`, `chkdate`) VALUES
(6, 'مدیر اتوماسیون', '0', '9120000852', 'hassan@gmail.com', '', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '1509338102', 0, 0, '1509338102', '1509338101', 3, NULL, NULL, NULL, NULL, '558416295986611284', NULL),
(7, 'کاربر دبیرخانه', '1', '', '', '', 'dabir', '37ff4095e6e4d60f7dde66a9cfc94d990e488ec1', '', '1509338102', 0, 0, '0', '0', 2, NULL, NULL, NULL, NULL, '147316304797848439', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_power`
--

CREATE TABLE `tbl_user_power` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_power`
--

INSERT INTO `tbl_user_power` (`id`, `name`) VALUES
(1, 'عادی'),
(2, 'دبیرخانه'),
(3, 'مدیر');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work`
--

CREATE TABLE `tbl_work` (
  `id` int(255) NOT NULL,
  `subject` varchar(1000) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_end` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_action`
--
ALTER TABLE `tbl_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dabirkhone`
--
ALTER TABLE `tbl_dabirkhone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forward_type`
--
ALTER TABLE `tbl_forward_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_letter`
--
ALTER TABLE `tbl_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_letter_recive`
--
ALTER TABLE `tbl_letter_recive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_option`
--
ALTER TABLE `tbl_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_phone`
--
ALTER TABLE `tbl_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_power`
--
ALTER TABLE `tbl_user_power`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_work`
--
ALTER TABLE `tbl_work`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dabirkhone`
--
ALTER TABLE `tbl_dabirkhone`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_forward_type`
--
ALTER TABLE `tbl_forward_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_letter`
--
ALTER TABLE `tbl_letter`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_letter_recive`
--
ALTER TABLE `tbl_letter_recive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_option`
--
ALTER TABLE `tbl_option`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_phone`
--
ALTER TABLE `tbl_phone`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_power`
--
ALTER TABLE `tbl_user_power`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_work`
--
ALTER TABLE `tbl_work`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
