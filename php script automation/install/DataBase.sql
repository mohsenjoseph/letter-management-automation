
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
(3, 'دبیرخانه همایش', 'و هـ', '', 'ص هـ', '5', '8', 43);

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
(1, 'photo_2017-10-30_09-16-16.jpg', '1509514252-1.jpg', '1509514252'),
(2, 'scan0004.pdf', '1509871829-1.pdf', '1509871829'),
(23, '001.jpg', '1509447389-1.jpg', '1509447389'),
(24, 'scan0005.pdf', '1510572966-1.pdf', '1510572966'),
(28, 'scan0001.jpg', '1509446544-2.jpg', '1509446544'),
(29, 'scan0005.pdf', '1509446544-3.pdf', '1509446544'),
(30, 'scan0004.pdf', '1509446544-4.pdf', '1509446544'),
(31, 'scan0003.pdf', '1509446544-5.pdf', '1509446544'),
(32, 'scan0001.pdf', '1509446544-6.pdf', '1509446544'),
(33, 'scan0006.pdf', '1510574900-1.pdf', '1510574900'),
(34, 'scan0007.pdf', '1510575234-1.pdf', '1510575234'),
(35, 'auto-960723.zip', '1510593135-1.zip', '1510593135'),
(37, 'scan0009.pdf', '1511255370-1.pdf', '1511255370'),
(38, 'scan0010.pdf', '1511343283-1.pdf', '1511343283'),
(39, 'scan0011.pdf', '1511343437-1.pdf', '1511343437'),
(40, 'scan0013.pdf', '1511683438-1.pdf', '1511683438'),
(41, 'scan0012.pdf', '1511684573-1.pdf', '1511684573'),
(42, 'scan0014.pdf', '1511685841-1.pdf', '1511685841'),
(43, 'scan0015.pdf', '1511937500-1.pdf', '1511937500'),
(44, 'scan0016.pdf', '1511941086-1.pdf', '1511941086'),
(45, 'scan0017.pdf', '1511944208-1.pdf', '1511944208'),
(46, 'scan0019.pdf', '1512280579-1.pdf', '1512280579'),
(47, 'scan0018.pdf', '1512287734-1.pdf', '1512287734'),
(48, 'scan0020.pdf', '1512371028-1.pdf', '1512371028'),
(49, 'scan0021.pdf', '1512371922-1.pdf', '1512371922'),
(50, 'scan0022.pdf', '1512373878-1.pdf', '1512373878'),
(51, 'scan0025.pdf', '1513064825-1.pdf', '1513064825'),
(52, 'scan0025.pdf', '1513065947-1.pdf', '1513065947'),
(53, 'scan0026.pdf', '1513066164-1.pdf', '1513066164'),
(54, 'scan0027.pdf', '1513066390-1.pdf', '1513066390'),
(55, 'scan0028.pdf', '1513066627-1.pdf', '1513066627'),
(56, 'قرارداد آقای هژبری 2.doc', '1513148292-1.doc', '1513148292'),
(57, 'نامه_درخواست_مصاحبه_آقای_ریس_ارلیک.PDF', '1513150130-1.PDF', '1513150130'),
(58, 'scan0032.pdf', '1513414150-1.pdf', '1513414150'),
(59, 'scan0034.pdf', '1513491937-1.pdf', '1513491937'),
(60, 'scan0033.pdf', '1513492044-1.pdf', '1513492044'),
(61, 'scan0035.pdf', '1514622604-1.pdf', '1514622604'),
(62, 'scan0036.pdf', '1514796424-1.pdf', '1514796424'),
(63, 'scan0037.pdf', '1516516535-1.pdf', '1516516535'),
(64, 'لیست بیمه درمان تکمیلی آسیا.pdf', '1518592314-1.pdf', '1518592314'),
(65, 'scan0038.pdf', '1519207803-1.pdf', '1519207803'),
(66, 'scan0039.pdf', '1519625659-1.pdf', '1519625659'),
(67, 'scan0041.pdf', '1520069821-1.pdf', '1520069821'),
(68, 'scan0042.pdf', '1520149323-1.pdf', '1520149323'),
(69, 'scan0043.pdf', '1520149599-1.pdf', '1520149599'),
(70, 'bys.jpg', '1594727674-1.jpg', '1594727674');

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
  `text` text,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '0',
  `dabirId` int(255) DEFAULT NULL,
  `date_create` int(255) NOT NULL DEFAULT '0',
  `date_signature` int(255) DEFAULT NULL,
  `date_numLetter` varchar(255) DEFAULT NULL,
  `numLetter` varchar(100) DEFAULT NULL,
  `archive` int(1) NOT NULL DEFAULT '0',
  `levelId_create` int(255) NOT NULL,
  `levelId_signature` int(255) DEFAULT NULL,
  `levelId_Recive` text,
  `levelId_Cc` text,
  `file` int(1) DEFAULT NULL,
  `input` int(1) DEFAULT '0',
  `print_size` int(1) DEFAULT '2',
  `date_save` varchar(255) DEFAULT NULL,
  `date_number_input` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_letter`
--

INSERT INTO `tbl_letter` (`id`, `subject`, `text`, `description`, `status`, `dabirId`, `date_create`, `date_signature`, `date_numLetter`, `numLetter`, `archive`, `levelId_create`, `levelId_signature`, `levelId_Recive`, `levelId_Cc`, `file`, `input`, `print_size`, `date_save`, `date_number_input`) VALUES
(6, 'شاهسون', '<p>جناب آقای حمیدرضا شاهسون&nbsp;<br />\r\n<br />\r\nسلام علیکم؛</p>\r\n\r\n<p>احتراماً برابر مصوبه هیات مدیره در جلسه مورخ ۹۶/۰۸/۰۲ بدینوسیله جنابعالی به عنوان مسئول امور شهرستان های این جمعیت منصوب می شوید، تا برابر مقررات و رعایت دستورالعمل های صادره در این امور، با هماهنگی فعالیت نموده و گزارش ماهیانه آن را بطور منظم به اینجانب ارائه نمایید.<br />\r\nاز خداوند متعال توفیقات روزافزون حضرتعالی را خواستارم .</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'مسئول امور شهرستان ', 2, 1, 1509263458, 1509263517, '1509263565', '۶۴۰۲/ص/۹۶', 0, 9, 16, 'شاهسون', '', 0, 2, 2, NULL, NULL),
(8, 'ابتکار', '<p dir=\"RTL\"><strong>سرکار خانم دکتر معصومه ابتکار<br />\r\nمعاون محترم رییس جمهور در امور زنان و خانواده</strong><br />\r\n&nbsp;</p>\r\n\r\n<p dir=\"RTL\">سلام علیکم؛</p>\r\n\r\n<p><span dir=\"RTL\">&nbsp;&nbsp;&nbsp;&nbsp; احتراماً پیرو دعوتنامه شماره ۹۶/۶۳۳۰/۱ مورخ ۹۶/۰۸/۰۶ ،&nbsp;با توجه به اینکه جهت طراحی پوستر همایش &quot;<strong><em>دخانیات ، زنان ، سلامت&quot;</em></strong> نیاز به آرم متعلق به آن معاونت محترم می باشد، خواهشمند است دستور فرمایید فایل لایه باز آرم مذکور جهت درج در پوستر همایش ، به هر طریقی که صلاح می دانید در اختیار این جمعیت قرار گیرد .</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span dir=\"RTL\"><strong>دکتر محمدرضا مسجدی&nbsp;<br />\r\nدبیرکل جمعیت&nbsp;</strong></span></p>\r\n', 'درخواست لوگو', 2, 3, 1509339977, 1509349904, '1509349929', '7/و هـ/۹۶', 0, 43, 45, 'ابتکار', '', 0, 2, 1, NULL, NULL),
(9, 'زمانی', '<p dir=\"RTL\"><strong>سرکار خانم دکتر سمانه زمانی<br />\r\nمدیرکل محترم اداره سلامت شهرداری&nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span dir=\"RTL\">سلام علیکم؛</span></p>\r\n\r\n<p dir=\"RTL\">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;احتراما از سـرکار عالی دعـوت بعمـل می آید در همـایش یک روزه با عنـوان <strong>&laquo;</strong><strong>زنان، دخانیات، سلامت&raquo; </strong>که با توجه به اهمیت سلامت بانوان و نقش مؤثر و والای آنان بر وضعیت سلامت در جامعه، محیط های اجتماعی و خانواده با مشارکت جمعیت مبارزه با استعمال دخانیات ایران و دانشگاه الزهرا (س) برگزار می گردد، شرکت نموده و با حضور ارزشمندتان رونق بخش این مراسم باشید.</p>\r\n', 'دعوتنامه همایش', 2, 3, 1509276077, 1509276138, '1509276165', '۶/ص هـ/۹۶', 0, 43, 45, 'زمانی', '', 0, 2, 2, NULL, NULL),
(10, 'زمانی', '<p><strong>سرکار خانم دکتر سمانه زمانی<br />\r\nمدیرکل محترم اداره سلامت شهرداری</strong><br />\r\n<br />\r\nسلام علیکم؛</p>\r\n\r\n<p>احتراما پیرو دعوتنامه شماره ۶/ص هـ/۹۶ مورخ ۹۶/۰۸/۰۷ مربوط به همایش <strong><em>&quot;زنان ، دخانیات ، سلامت</em></strong>&quot; ، خواهشمند است جهت حضور مدیران حوزه سلامت مناطق ۲۲ گانه شهرداری در همایش مذکور دستور فرمایید اقدامات لازم را مبذول نمایند .</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'دعوتنامه مدیران حوزه سلامت ', 1, 3, 1509351327, 1518508444, NULL, NULL, 0, 43, 45, 'زمانی', '', 0, 0, 1, NULL, NULL),
(11, 'حسینی  صدا و سیما ', '<p dir=\"RTL\"><strong>جناب آقای دکتر سید حمید حسینی<br />\r\nرییس محترم مرکز بهداشت صدا و سیما&nbsp; &nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span dir=\"RTL\">سلام علیکم؛</span></p>\r\n\r\n<p dir=\"RTL\">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;احتراما از جنابعالی دعـوت بعمـل می آید در همـایش یک روزه با عنـوان <strong>&laquo;</strong><strong>زنان، دخانیات، سلامت&raquo; که </strong>با توجه به اهمیت سلامت بانوان و نقش مؤثر و والای آنان بر وضعیت سلامت در جامعه، محیط های اجتماعی و خانواده با مشارکت جمعیت مبارزه با استعمال دخانیات ایران و دانشگاه الزهرا (س) برگزار می گردد، شرکت نموده و با حضور ارزشمندتان رونق بخش این مراسم باشید.<br />\r\n&nbsp; &nbsp; &nbsp;همچنین خواهشمند است در خصوص پوشش خبری به طریقی که صلاح می دانید دستور فرمایید اقدامات لازم صورت گیرد .</p>\r\n', 'دعوتنامه و پوشش خبری ', 0, 3, 1509350923, 0, NULL, NULL, 0, 43, 45, 'حسینی', '', 0, 0, 1, NULL, NULL),
(12, 'ساعی', '<p dir=\"RTL\"><strong>سرکار خانم دکتر زهرا ساعی&nbsp;<br />\r\nنماینده محترم مجلس شورای اسلامی</strong><br />\r\n<br />\r\nسلام علیکم؛</p>\r\n\r\n<p dir=\"RTL\">&nbsp;&nbsp;&nbsp;&nbsp; احتراماً به استحضار می رساند،&nbsp; با توجه به اهمیت سلامت بانوان و نقش مؤثر و والای آنان بر وضعیت سلامت در جامعه، محیط های اجتماعی و خانواده، این جمعیت در نظر دارد همایشی یک روزه تحت عنوان &quot;زنان، دخانیات، سلامت&quot; با همکاری دانشگاه الزهراء (معاونت اجتماعی و فرهنگی) در تاریخ ۲۳ آبان ماه <span dir=\"LTR\">۹۶</span> از ساعت ۹ الی ۱۶ برگزار نماید.</p>\r\n\r\n<p dir=\"RTL\">&nbsp;&nbsp; &nbsp;&nbsp;لذا از سرکار عالی دعوت بعمل می آید با بیانات خویش، درباره سیاست ها و برنامه های آن معاونت محترم در حوزه پیشگیری و کنترل&nbsp; مواد دخانی در جمع دانشجویان و اساتید، ما را مستفیض فرمائید.</p>\r\n', '', 0, 3, 1509349793, 0, NULL, NULL, 0, 43, 45, 'ساعی', '', 0, 0, 2, NULL, NULL),
(13, 'رییس ستاد ثبت نام ', '<p dir=\"RTL\"><strong>ستاد محترم کمیته ثبت نام<br />\r\nبیست و سومین نمایشگاه مطبوعات </strong><br />\r\n<br />\r\nبا سلام و احترام ؛<br />\r\n&nbsp; &nbsp; &nbsp;نظر به اینکه سرکار خانم آزاده نظری سردبیر نشریه کارت قرمز این موسسه در غرفه بیست و سومین نمایشگاه مطبوعات مشغول به فعالیت می باشد .<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; خواهشمند است دستور فرمایید نسبت به صدور کارت نامبرده اقدامات لازم را مبذول نمایند.<br />\r\n&nbsp; &nbsp; &nbsp;پیشاپیش از بذل مساعدتی که می فرمایید کمال تشکر و سپاسگزاری را دارم .</p>\r\n', 'صدور کارت نظری ', 2, 1, 1509360346, 1509360397, '1509360417', '۶۴۰۳/د/۹۶', 0, 9, 17, 'رییس ستاد ', '', 0, 0, 2, NULL, NULL),
(14, 'قراردادراه اندازی و بروز رسانی سایت جمعیت', '<p>قرارداد سایت</p>\r\n', 'پارسی فیکس- برهانی', 2, 1, 1509446544, 1509446544, '1509446544', '۶۴۰۴/و/۹۶', 0, 9, 0, '17,16', '', 1, 1, 2, NULL, '24/ق/1396- 96/08/02'),
(133, 'انتقال هاست23', '<p>رسیدگی شد</p>\r\n', 'تست توضیحات34', 0, 1, 1594835209, 0, NULL, NULL, 0, 9, 12, 'پتروشیمی', 'فرمانداری', 0, 2, 2, NULL, NULL),
(134, 'انتقال هاست', '', 'تست توضیحات', 2, 3, 1594727674, 1594727674, '1594727674', '۸/و هـ/۹۹', 0, 43, 0, '9', '', 1, 1, 2, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_letter_recive`
--

CREATE TABLE `tbl_letter_recive` (
  `id` int(255) NOT NULL,
  `letterId` int(255) NOT NULL,
  `levelId` int(255) NOT NULL,
  `forwardLevelId` int(255) DEFAULT NULL,
  `recive_status` int(1) NOT NULL DEFAULT '0',
  `read_status` int(1) NOT NULL DEFAULT '0',
  `archive` int(1) NOT NULL DEFAULT '0',
  `description` varchar(1000) DEFAULT NULL,
  `date_send` int(255) DEFAULT NULL,
  `date_view` int(255) DEFAULT NULL,
  `answer` text,
  `date_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_letter_recive`
--

INSERT INTO `tbl_letter_recive` (`id`, `letterId`, `levelId`, `forwardLevelId`, `recive_status`, `read_status`, `archive`, `description`, `date_send`, `date_view`, `answer`, `date_answer`) VALUES
(11, 6, 16, 9, 1, 1, 0, '', 1509263400, 1509263412, NULL, NULL),
(12, 6, 16, 9, 1, 1, 0, '', 1509263498, 1509263513, NULL, NULL),
(13, 6, 0, 9, 2, 0, 0, 'مسئول امور شهرستان ', 1509263565, NULL, NULL, NULL),
(14, 9, 45, 43, 1, 1, 0, '', 1509276086, 1509276136, NULL, NULL),
(15, 9, 0, 43, 2, 0, 0, 'دعوتنامه همایش', 1509276166, NULL, NULL, NULL),
(16, 8, 45, 43, 1, 1, 0, '', 1509349867, 1509349902, NULL, NULL),
(17, 10, 45, 43, 1, 1, 0, '', 1509356950, 1509360230, NULL, NULL),
(18, 13, 17, 9, 1, 1, 0, '', 1509360201, 1509360213, NULL, NULL),
(19, 13, 17, 9, 1, 1, 0, '', 1509360385, 1509360394, NULL, NULL),
(20, 13, 0, 9, 2, 0, 0, 'صدور کارت نظری ', 1509360417, NULL, NULL, NULL),
(21, 14, 17, 9, 2, 0, 0, 'پارسی فیکس- برهانی', 1509446544, NULL, NULL, NULL),
(323, 133, 9, 9, 1, 1, 0, 'تست توضیحات4444', 1591612792, 1591612798, '[pkhkugyfb ', '1592919786'),
(324, 133, 9, 9, 1, 0, 0, 'تست توضیحات2222', 1591612823, NULL, '[pkhkugyfb ', '1592919786'),
(325, 134, 9, 43, 2, 1, 0, 'تست توضیحات', 1594727674, 1594835137, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id` int(255) NOT NULL,
  `semat` varchar(255) NOT NULL,
  `semattop` varchar(1000) DEFAULT NULL,
  `signature_status` int(1) NOT NULL DEFAULT '0',
  `parentId` int(11) NOT NULL DEFAULT '0',
  `userId` int(255) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
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
(48, 'مدیر فناوری اطلاعات', 'مدیریت محترم فناوری اطلاعات', 1, 17, 6, 1);

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
(7, 'فاصله از بالای برگه', 'a4_top_print_margin', '27'),
(10, 'فاصله از سمت چپ برگه', 'a4_left_print_margin', '5'),
(11, 'فاصله از پایین برگه', 'a4_bottom_print_margin', '50'),
(12, 'فاصله از سمت راست برگه', 'a5_right_print_margin', '5'),
(13, 'فاصله از بالای برگه', 'a5_top_print_margin', '20'),
(14, 'فاصله از سمت چپ برگه', 'a5_left_print_margin', '5'),
(15, 'فاصله از پایین برگه', 'a5_bottom_print_margin', '45'),
(17, 'سایز فونت', 'a4_print_size_font', '16'),
(18, 'سایز فونت', 'a5_print_size_font', '14'),
(19, 'فاصله شماره نامه از سمت چپ ', 'a4_print_space_numberletter', '100'),
(20, 'فاصله شماره نامه از سمت چپ', 'a5_print_space_numberletter', '80'),
(21, 'فاصله ما بین شماره نامه و ابتدای نامه', 'a4_print_space_number_start', '2'),
(22, 'فاصله ما بین شماره نامه و ابتدای نامه', 'a5_print_space_number_start', '2'),
(23, 'فاصله خطوط', 'a4_print_line_height', '22'),
(24, 'فاصله خطوط', 'a5_print_line_height', '22'),
(25, 'فاصله رونوشت از امضاء', 'a4_print_spaceCC', '90'),
(26, 'فاصله رونوشت از امضاء', 'a5_print_spaceCC', '90');

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
  `description` text,
  `userId` int(255) NOT NULL,
  `work_company` varchar(255) DEFAULT NULL,
  `work_tell` varchar(255) DEFAULT NULL,
  `work_email` varchar(255) DEFAULT NULL,
  `work_fax` varchar(255) DEFAULT NULL,
  `work_website` varchar(255) DEFAULT NULL,
  `work_adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_phone`
--

INSERT INTO `tbl_phone` (`id`, `name`, `adres`, `mobile`, `tell`, `email`, `description`, `userId`, `work_company`, `work_tell`, `work_email`, `work_fax`, `work_website`, `work_adres`) VALUES
(1, 'محسن یوسفی', '', '09156644838', '', '', ' پشتیبان اتوماسیون اداری', 7, '', '', '', '', '', '');

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
(1, 0, 2, 6, '', '1594834626'),
(2, 0, 1, 6, '', '1594834634'),
(3, 0, 2, 6, '', '1594835119'),
(4, 0, 1, 7, '', '1594835130'),
(5, 134, 9, 7, '', '1594835137'),
(6, 134, 9, 7, '', '1594835143'),
(7, 133, 9, 7, '', '1594835165'),
(8, 133, 9, 7, '', '1594835175'),
(9, 133, 9, 7, '', '1594835188'),
(10, 133, 4, 7, '', '1594835199'),
(11, 133, 3, 7, 'انتقال هاست23', '1594835209'),
(12, 13, 9, 7, '', '1594835221'),
(13, 6, 9, 7, '', '1594835250'),
(14, 14, 9, 7, '', '1594835264'),
(15, 13, 9, 7, '', '1594835284'),
(16, 11, 9, 7, '', '1594835350'),
(17, 12, 9, 7, '', '1594835355'),
(18, 0, 2, 7, '', '1594835362'),
(19, 0, 1, 6, '', '1594835369'),
(20, 0, 2, 6, '', '1594835389');

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
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `signature` int(1) DEFAULT '0',
  `signaturepic` int(1) NOT NULL DEFAULT '0',
  `userpic` int(1) NOT NULL DEFAULT '0',
  `power` int(1) NOT NULL DEFAULT '1',
  `css` varchar(255) DEFAULT NULL,
  `sessions` varchar(255) DEFAULT NULL,
  `chkdate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `code`, `phone`, `email`, `address`, `username`, `password`, `tell`, `dt`, `status`, `signature`, `signaturepic`, `userpic`, `power`, `css`, `sessions`, `chkdate`) VALUES
(6, 'admin', '0', '09156644838', 'u3fi225@gmail.com', '', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '0000-00-00 00:00:00', 0, 0, 0, 1509338101, 3, '', '', NULL),
(7, 'مونا زاهدی', '1', '0', 'dabir', '', 'dabir', '37ff4095e6e4d60f7dde66a9cfc94d990e488ec1', '88105001', '0000-00-00 00:00:00', 0, 0, 0, 1509342725, 2, NULL, '', NULL),
(9, 'لیلا مرسلی', '1002', '0', '', '', 'l.morsali', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 1509311065, 2, NULL, '', NULL),
(10, 'نادر یزدان پناهی', '1004', '0', '', '', 'n.yazdan', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(11, 'احمد حامد', '1042', '0', '', '', 'a.hamed', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(12, 'آزاده نطری', '1037', '0', '', '', 'a.nazari', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(13, 'ساناز حمزه علی', '1045', '0', '', '', 's.hamzehali', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '563915202469281819', NULL),
(14, 'حسین علیپور', '1035', '0', '', '', 'h.alipour', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(15, 'رحمت الله شهرامی فر', '1007', '0', '', '', 'r.shahrami', '9b20616cbd1fbb93d229a7c8ce5817c282ec8243', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '', NULL),
(16, 'زهرا صدر', '1041', '0', '', '', 'z.sadr', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '166015202492144532', NULL),
(17, 'زینب وزیری', '1039', '0', '', '', 'z.vaziri', '411fef5523d793b363b2cd215d872f408e80b252', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '969415196482751594', NULL),
(18, 'سونیا غفاری', '1038', '0', '', '', 's.ghafari', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(19, 'عاطفه خلفی', '1040', '0', '', '', 'a.khalafi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '', NULL),
(20, 'عبد الخالد صالحی ', '1046', '0', '', '', 'a.salehi', 'd813030c233883673758f0c3cf30e597550103f6', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '737015153098238839', '1513407091'),
(21, 'علی عطا طاهری', '1030', '0', '', '', 'a.taheri', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 1509311038, 1509311038, 1, NULL, '', NULL),
(22, 'فاطمه متین خواه', '1012', '0', '', '', 'f.matin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(23, 'مرجانه  نعمتی', '1017', '0', '', '', 'm.nemati', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '', NULL),
(24, 'معصومه قدرتی', '1013', '0', '', '', 'm.ghodrati', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(25, 'ناهید سرابی', '1044', '0', '', '', 'n.sarabi', '1ff5ddfb100ec8668d0d2b4aba173628c6ec74b4', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(26, 'دکتر حمیرا بیگدلی', '1029', '0', '', '', 'h.bigdeli', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(27, 'سیاوش خدایی', '1005', '0', '', '', 's.khodaei', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(28, 'زهرا کریم', '1021', '0', '', '', 'z.karim', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '', NULL),
(29, 'دکتر محمد رضا مسجدی', '0', '0', 'a@b.com', '', 'm.masjedi', 'd5f12e53a182c062b6bf30c1445153faff12269a', '0', '0000-00-00 00:00:00', 0, 0, 1509310989, 0, 1, NULL, '', NULL),
(30, 'محمد محمدی گلپایگانی', '0', '0', '', '', 'm.mohammadi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(31, 'محمود لولاچیان', '0', '0', '', '', 'm.lolachian', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(32, 'سید حسن معین شیرازی', '0', '0', '', '', 'h.moein', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 1509449338, 0, 1, NULL, '', NULL),
(33, 'دکتر محمد اسمعیل افشار خرقان', '0', '0', '', '', 'm.afshar', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '383815133620101667', '1513362010'),
(34, 'مصطفی مرسلی', '0', '0', '', '', 'm.morsali', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, NULL, NULL),
(35, 'حمیدرضا شاهسون طغانی', '0', '', '', '', 'h.shahsavan', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '', '1513417414'),
(36, 'مرجانه سخاوتی', '0', '', '', '', 'm.sekhavati', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, NULL, '614015160838749413', NULL);

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
  `description` text,
  `date_end` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_work`
--

INSERT INTO `tbl_work` (`id`, `subject`, `description`, `date_end`, `status`, `userId`) VALUES
(1, 'اب منطقه ای', '                  نتنیتبنیتبنیتبنیتبن                  ', '', 3, 7);

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
-- AUTO_INCREMENT for table `tbl_action`
--
ALTER TABLE `tbl_action`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_dabirkhone`
--
ALTER TABLE `tbl_dabirkhone`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_forward_type`
--
ALTER TABLE `tbl_forward_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_letter`
--
ALTER TABLE `tbl_letter`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tbl_letter_recive`
--
ALTER TABLE `tbl_letter_recive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_option`
--
ALTER TABLE `tbl_option`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_phone`
--
ALTER TABLE `tbl_phone`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_user_power`
--
ALTER TABLE `tbl_user_power`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_work`
--
ALTER TABLE `tbl_work`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
