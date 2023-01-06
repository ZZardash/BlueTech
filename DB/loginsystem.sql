-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2019 at 08:14 PM
-- Server version: 10.4.6-MariaDB
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
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(100) DEFAULT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` longtext DEFAULT NULL,
  `adminImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `adminName`, `adminEmail`, `adminPassword`, `adminImage`) VALUES
(12, 'Agnel', 'agnelselvan007@gmail.com', '$2y$10$IrYOH4UJbmh3Gha4hgA/bupLPXZQ0SCtGh/IfeuTEGuL9KDN3L..u', 'agnel.jpeg'),
(15, 'Nesan', 'nesanselvan007@gmail.com', '$2y$10$JqzFOct16OCN3xC8/31tBObmMJCy9dybBLXyWlOoWfK3vBin7sBHi', '2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cID` int(11) NOT NULL,
  `userID` int(100) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cID`, `userID`, `productid`, `quantity`) VALUES
(337, 68, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `casecompany`
--

CREATE TABLE `casecompany` (
  `caseCompID` int(11) NOT NULL,
  `caseCompName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casecompany`
--

INSERT INTO `casecompany` (`caseCompID`, `caseCompName`) VALUES
(1, 'Corsair'),
(2, 'NZXT'),
(3, 'Fractal Design'),
(4, 'Cooler Master'),
(5, 'Phanteks'),
(6, 'ASUS'),
(7, 'Antec'),
(8, 'Intel'),
(9, 'Companq'),
(10, 'Foxconn');

-- --------------------------------------------------------

--
-- Table structure for table `graphicscardcompany`
--

CREATE TABLE `graphicscardcompany` (
  `grapCardID` int(11) NOT NULL,
  `graphicsCradComp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graphicscardcompany`
--

INSERT INTO `graphicscardcompany` (`grapCardID`, `graphicsCradComp`) VALUES
(1, 'Nvidia Titan V'),
(2, 'Nvidia RTX 2080 Ti'),
(3, 'Nvidia GTX 1070'),
(4, 'Nvidia RTX 2060'),
(5, 'Nvidia RTX 2060 super'),
(6, 'Nvidia Titan Pascal');

-- --------------------------------------------------------

--
-- Table structure for table `iocompany`
--

CREATE TABLE `iocompany` (
  `IOId` int(11) NOT NULL,
  `CompName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iocompany`
--

INSERT INTO `iocompany` (`IOId`, `CompName`) VALUES
(1, 'SAMSUNG'),
(2, 'Logitech'),
(3, 'Microsoft'),
(4, 'Razer'),
(5, 'HP'),
(6, 'Apple'),
(7, 'IBall');

-- --------------------------------------------------------

--
-- Table structure for table `monitorcompany`
--

CREATE TABLE `monitorcompany` (
  `mID` int(11) NOT NULL,
  `monitorCompName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitorcompany`
--

INSERT INTO `monitorcompany` (`mID`, `monitorCompName`) VALUES
(1, 'Samsung'),
(2, 'LG'),
(3, 'HP'),
(4, 'Dell'),
(5, 'Lenovo'),
(6, 'Alienware');

-- --------------------------------------------------------

--
-- Table structure for table `motherboardtype`
--

CREATE TABLE `motherboardtype` (
  `motherID` int(11) NOT NULL,
  `motherboardName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motherboardtype`
--

INSERT INTO `motherboardtype` (`motherID`, `motherboardName`) VALUES
(1, 'Gigabyte GA-H61M-S'),
(2, 'Gigabyte H-61 Chipset S2P'),
(3, 'Gigabyte GA-H61M-S1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `ordernumber` int(255) NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `pcID` int(10) DEFAULT NULL,
  `partID` int(10) DEFAULT NULL,
  `partQty` int(50) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `totalAmount` int(11) NOT NULL,
  `date` date NOT NULL,
  `sttus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `ordernumber`, `userID`, `pcID`, `partID`, `partQty`, `paymentMethod`, `subTotal`, `shipping`, `tax`, `totalAmount`, `date`, `sttus`) VALUES
(263, 520098497, 69, 0, 36, 1, 'online', 40851, 0, 60, 40911, '2019-10-15', 'Dispatched');

-- --------------------------------------------------------

--
-- Table structure for table `payu`
--

CREATE TABLE `payu` (
  `payuID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `txnid` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `productinfo` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payuMoneyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payu`
--

INSERT INTO `payu` (`payuID`, `orderID`, `userID`, `txnid`, `amount`, `productinfo`, `time`, `payuMoneyID`) VALUES
(59, 463190162, 47, 8, 980, 'HP K2500 Wireless Keyboard', '2019-09-28 09:58:02', 249882993),
(61, 172446507, 47, 8, 30000, 'Samsung LS24D330HSJ/ZA 24\" S24D330H 1920x1080 LED Monitor ', '2019-09-28 10:00:08', 249882998),
(62, 1336356501, 47, 8, 25500, 'MUSETEX Phantom Black, Gandiva Nallu Assembled Desktop', '2019-09-28 10:13:38', 249883012),
(63, 634192950, 48, 8, 2500, 'MUSETEX Phantom Black,Thermaltake V200 Tempered Glass RGB', '2019-09-29 04:06:36', 249883501),
(64, 1584078895, 47, 8, 9000, 'Ram', '2019-09-29 11:22:48', 249883584),
(65, 1505551725, 47, 8, 55500, 'USB3 DDR3 HDMI DVI USB 3.0 760G MicroATX Motherboard,Samsung Plutofit Memory 8GB Kit 2 x 4GB DDR3 PC3-12800 1600MHz RAM,WD SATA 1 TB Desktop Internal Hard Disk Drive (WD10EZRZ),GIGABYTE Z370 AORUS Ultra Gaming ,MSI Performance Gaming AMD Ryzen 1st and 2nd', '2019-09-29 15:04:44', 249883725),
(66, 1866385068, 47, 8, 12164, 'USB3 DDR3 HDMI DVI USB 3.0 760G MicroATX Motherboard,ASUS EX-A320M Gaming AMD Motherboard,Red Gear Dragonwar Emera ELE-G11 3200 DPI Gaming Mouse (Dark Blue),Basic kids Keyboard', '2019-09-30 11:35:48', 249885928),
(67, 585947708, 47, 8, 128220, 'GIGABYTE Z370 AORUS Ultra Gaming ,Gamin PC Oman, Gandiva Nallu Assembled Desktop', '2019-09-30 12:51:26', 249886159),
(68, 1285399444, 61, 8, 12075, 'Seagate Backup Plus Slim 2TB External Hard Drive Portable HDD,Basic kids Keyboard', '2019-10-09 20:39:24', 249902146),
(69, 387408743, 61, 8, 172275, 'Avant Gaming Tower,Gamin PC Oman', '2019-10-09 20:40:23', 249902147),
(70, 1315953302, 61, 8, 40110, 'Dell 19.5 inch (49.41 cm) LED Backlit Computer Monitor', '2019-10-13 05:34:19', 249908102),
(71, 1701116167, 61, 8, 4065, 'Basic kids Keyboard', '2019-10-13 05:37:54', 249908104),
(72, 280477047, 61, 8, 80160, 'Samsung LS24D330HSJ/ZA 24\" S24D330H 1920x1080 LED Monitor ', '2019-10-13 05:44:22', 249908106),
(73, 1027606925, 67, 8, 942, 'Xmate Zorro 3200DPI LED Backlight 6 Button Wired USB Gaming Mouse', '2019-10-13 07:42:27', 249908188),
(74, 1042562577, 67, 8, 924, 'HP K2500 Wireless Keyboard', '2019-10-13 07:43:30', 249908190),
(75, 930023428, 67, 8, 1804, 'HP K2500 Wireless Keyboard', '2019-10-13 07:44:06', 249908191),
(76, 520098497, 69, 8, 40911, 'Basic kids Keyboard,Dell 19.5 inch (49.41 cm) LED Backlit Computer Monitor', '2019-10-15 17:49:18', 249912498);

-- --------------------------------------------------------

--
-- Table structure for table `pccart`
--

CREATE TABLE `pccart` (
  `pccartid` int(11) NOT NULL,
  `pcid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcpart`
--

CREATE TABLE `pcpart` (
  `pcPartID` int(11) NOT NULL,
  `partTitle` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `partKeyword` int(10) DEFAULT NULL,
  `partDesc` varchar(255) DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `price` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcpart`
--

INSERT INTO `pcpart` (`pcPartID`, `partTitle`, `image`, `partKeyword`, `partDesc`, `qty`, `price`) VALUES
(11, 'Thermaltake V200 Tempered Glass RGB', 'uploadedimages/case.jpg', 1, 'Light up the system: 3 Pre installed 120 millimeter 12V motherboard Sync RGB fans (Sync with as US, Gigabyte, MSI, as rock, and BIOSTAR 12V header Mob) + 1 Black fan at back\r\nBuilt in dual mode 12V Sync controller: Control light via I/O port RGB Light but', 14, 1000),
(12, 'MUSETEX Phantom Black', 'uploadedimages/case1.jpg', 1, 'Specially designed for lighting', 25, 1500),
(19, 'Basic kids Keyboard', 'uploadedimages/p-1.jpg', 8, 'Basics kids keyboard', 28, 900),
(20, 'Ram', 'uploadedimages/p-3.jpg', 5, 'DDR3 ï¿½ 1333MHz ï¿½ PC3-10600 ï¿½ 240-Pin ï¿½ Unbuffered ï¿½ Non ECC ï¿½ 1.5V ï¿½ CL9 ï¿½ Dual Rank ï¿½ 2Rx8 based ï¿½ 512x8JEDEC standard 1.5V (1.425V ~1.575V) Power SupplyModule Size: 16GB Package: 2x8GB ï¿½ For Desktop Computer, Not for LaptopFor Sele', 30, 9000),
(21, 'USB3 DDR3 HDMI DVI USB 3.0 760G MicroATX Motherboard', 'uploadedimages/p-4.jpg', 3, 'AM3+ CPU Support Ready\r\nCore Unlocker- Unlock true Core performance intelligently\r\nAnti-Surge- Full-time Power Guardian-Make System Free From Risk', 20, 4000),
(22, 'Samsung LS24D330HSJ/ZA 24\" S24D330H 1920x1080 LED Monitor ', 'uploadedimages/p-5.jpg', 4, '24-inch desktop business monitor provides impressive picture quality and ultra-fast response time at an accessible price point; includes 3-year Warranty\r\nFull HD 1920 x 1080 resolution; low-glare TN panel delivers sharp images and vivid color even from of', 27, 30000),
(24, 'ASUS EX-A320M Gaming AMD Motherboard', 'uploadedimages/p-8.jpg', 3, 'Micro-ATX A320 feature with AURA sync,, USBGuard and Gold-plated x16 PCIe, LAN port, and 8-pin power connector\r\nAnti-moisture Coating\r\nNon-stop durability', 30, 3000),
(25, 'Intel Corporation Core i5 9400F 9th Generation Desktop ', 'uploadedimages/p-9.jpg', 2, 'Create, edit, and share 4K content with ease\r\nDurable Product\r\nDiscrete Graphic Card Needed for Display', 30, 15000),
(27, 'Red Gear Dragonwar Emera ELE-G11 3200 DPI Gaming Mouse (Dark Blue)', 'uploadedimages/p-11.jpg', 7, '8 programmable keys with LED lighting and scroll button\r\nDPI: 800/1600/2400/3200\r\nErgonomic design for professional gamers\r\nGold plated USB 2.0\r\n1.2m braided cable\r\nCompatible with Windows XP and linux', 50, 900),
(29, 'HP K2500 Wireless Keyboard', 'uploadedimages/p-12.jpg', 8, 'Hardware compatibility, Microsoft Windows XP/Vista/7/8. Compatible with Windows 7/8/10â€™\r\nFull-sized performance with a full-sized wireless keyboard - HPâ€™s Keyboard K2500. Includes a full number pad, Windows 8 compatibility, and dedicated function keys', 15, 980),
(33, 'INNOVA GRAPHICS CARD 3200', 'uploadedimages/p-13.jpg', 6, 'Geoforce RTX Gaming Graphics card> Bestest graphics card', 30, 34000),
(34, 'Seagate Backup Plus Slim 2TB External Hard Drive Portable HDD', 'uploadedimages/p-15.jpg', 9, 'Store and access 2TB of photos and files on the go with Backup Plus Slim, a portable external hard drive\r\nThis portable hard drive features a minimalist metal enclosure, and is a stylish USB drive', 21, 3000),
(35, 'LG 27 inch 4K-UHD (3840 x 2160) HDR', 'uploadedimages/p-19.jpg', 4, 'Screen Size: 27 inch (68.58 cm) 4K Ultra HD (3840 x 2160) HDR 10  IPS Display\r\nConnectivity Port: 2 HDMI Ports, 1 Display Port, 1 Audio-Out Port\r\nsRGB: 99%, Adobe RGB: 73%, DCI-P3: 75%', 30, 28000),
(36, 'Dell 19.5 inch (49.41 cm) LED Backlit Computer Monitor', 'uploadedimages/p-18.jpg', 4, 'Screen Size in cm should read 49.41cm\r\nNo display port. It should read \"Connectivity: 1 VGA Port\"\r\nBrightness (Typical) should be 200 cd/mÂ², Save energy with power-efficient features\r\nRefresh Rate: 60 Hz, Response Time: 5 ms', 27, 45000),
(37, 'Corsair Crystal 460X CC-9011101-WW RGB', 'uploadedimages/p-20.jpg', 1, 'Beautiful two-panel tempered glass: Immaculately display every component of your build\r\nClean, modern lines with an all steel exterior: Get rid of those plastic cases - the 460x has full steel front and top panels for extra durability and gorgeous good lo', 30, 12000),
(38, 'CHIPTRONEX Ghost GNX100 Mid Tower Gaming Cabinet ATX case', 'uploadedimages/p-21.jpg', 1, 'Mid Tower Gaming Cabinet\r\nATX case\r\nWithout SMPS', 29, 1000),
(39, 'GIGABYTE Z370 AORUS Ultra Gaming ', 'uploadedimages/p-22.jpg', 3, 'Supports 8th Generation Intel Core Processors\r\nUSB3.1 Gen2 with USB Type-C\r\nFront USB 3.1 Type-C header\r\nIntel Gigabit LAN', 29, 20000),
(40, 'MSI Performance Gaming AMD Ryzen 1st and 2nd Gen AM4 M.2 USB 3 DDR4 DVI HDMI', 'uploadedimages/p-23.jpg', 3, 'Support AMD Ryzen 1st and 2nd Generation / Ryzen with Radeon Vega Graphics Processors for Socket AM4\r\nSupports 64GB Dual Channel DDR4 Memory 1866/ 2133/ 2400/ 2667 MHz by JEDEC, and 2667/ 2800/ 2933/ 3000/ 3066/ 3200/ 3466 MHz by A-XMP OC MODE', 30, 10000),
(41, 'Intel Core 2 Duo E7500 Processor ', 'uploadedimages/p-24.jpg', 2, 'ntelÂ® Coreâ„¢2 Duo Processor E7500 (3M Cache, 2.93 GHz, 1066 MHz FSB) Product Specifications.', 23, 1000),
(42, 'Samsung Plutofit Memory 8GB Kit 2 x 4GB DDR3 PC3-12800 1600MHz RAM', 'uploadedimages/p-25.jpg', 5, 'Samsung 8GB kit\r\n4GB DDR3 1600Mhz kit (2x4Gb)\r\nLaptop Ram', 30, 3000),
(43, 'GoldenRAM Hynix 4 GB DDR RAM for Desktop', 'uploadedimages/p-26.jpg', 5, '240-pin\r\nDesktop RAM\r\n4GB DDR3 RAM', 28, 2000),
(44, 'ZOTAC GeForce GTX 1060 DirectX 12 6GB 192-Bit GDDR5X Graphics Card', 'uploadedimages/p-27.jpg', 6, 'The New GeForce super compact 1060 model takes advantage of the NVIDIA Pascal architecture to immerse you in incredible realism and brilliant performance in latest games.\r\nGTX 1060 comes with â€˜1280 CUDA coresâ€™ and operates across a 192-bit wide bus in', 30, 14000),
(45, 'Zotac Nvidia GT 1030 2GB GDDR5 64-Bit DVI-D HDMI Retail Graphic card ', 'uploadedimages/p-28.jpg', 6, 'CUDA Core : 384\r\nMemory Clock : 6.0 Ghz\r\nMemory Bus Width : 64-bit ; Memory Bandwidth :56 GB/s\r\nDirectX12.0 ;Vulkan1.0; OpenGL4.5 ;OpenCL1.2 ; Shader Model5.0', 30, 6000),
(46, 'Acer Nitro NP.MCE11.00G Wired Optical Gaming Mouse', 'uploadedimages/p-29.jpeg', 7, 'Wired\r\nFor Gaming\r\nInterface: USB 3.0, USB 2.0\r\nOptical Mouse\r\n7 functional buttons + 1 burst Fire on side thumb button\r\nAcceleration: 20 g Ergonomic design\r\nAdjustable 6 levels DPI lighting mode', 28, 1500),
(47, 'E - Royal Shop Rainbow LED Backlit USB Wired Multimedia Gaming Keyboard', 'uploadedimages/p-31.jpg', 8, 'Scroll Lock for turning LED on/off.\r\nSupport Windows 8, Windows 7, Windows Vista, Windows XP. PC Laptop Pad Google Android TV Box HTPC IPTV Smart TV Mac IOS Raspberry Pi all version\r\nStandard 104 Keys,Five-LED mixed color on the button,you can press the b', 29, 750),
(48, 'Lenovo Preferred Pro USB Keyboard (73P5220)', 'uploadedimages/p-32.jpg', 8, 'Lenovo Preferred Pro USB Keyboard .\r\nQuiet 104-key full-size layout (includes three Windows keys)\r\nCompatible with any computer that uses USB connection\r\nQuiet 104-key full-size layout (includes three Windows keys)\r\nCommon Windows shortcuts are highlighte', 10, 1000),
(49, 'WD SATA 1 TB Desktop Internal Hard Disk Drive (WD10EZRZ)', 'uploadedimages/p-33.jpeg', 9, 'Brand\r\nWD\r\nModel ID\r\nWD10EZRZ\r\nOS Compatibility\r\nWINDOWS7, WINDOWS8.1, WONDOWS10, LINUX', 0, 3500),
(50, 'Xmate Zorro 3200DPI LED Backlight 6 Button Wired USB Gaming Mouse', 'uploadedimages/p-30.jpg', 7, '4 DPI Levels - Four color RGB breathing light cycle replacement. 4-type DPI rating controlled by touching the DPI button: red 1200DPI, blue 1600DPI, green 1600DPI & purple 3200DPI.\r\nTough Built - Xmate Zorro wired USB gaming mouse is constructed of ABS pl', 1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `pcpartcomp`
--

CREATE TABLE `pcpartcomp` (
  `pcPartID` int(11) NOT NULL,
  `pcPartComponents` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcpartcomp`
--

INSERT INTO `pcpartcomp` (`pcPartID`, `pcPartComponents`) VALUES
(1, 'Case'),
(2, 'CPU'),
(3, 'Motherboard'),
(4, 'Monitor'),
(5, 'RAM'),
(6, 'Graphics Card'),
(7, 'Mouse'),
(8, 'Keyboard'),
(9, 'Harddisk');

-- --------------------------------------------------------

--
-- Table structure for table `pctype`
--

CREATE TABLE `pctype` (
  `pcTypeID` int(11) NOT NULL,
  `pcTypeName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pctype`
--

INSERT INTO `pctype` (`pcTypeID`, `pcTypeName`) VALUES
(1, 'Desktop'),
(2, 'Gaming'),
(3, 'Streaming');

-- --------------------------------------------------------

--
-- Table structure for table `pc_details`
--

CREATE TABLE `pc_details` (
  `pc_id` int(11) NOT NULL,
  `pc_image` varchar(200) NOT NULL,
  `pcName` varchar(255) NOT NULL,
  `PC_Type` varchar(50) DEFAULT NULL,
  `motherboard` varchar(255) NOT NULL,
  `processor` varchar(255) DEFAULT NULL,
  `pcPrice` int(255) NOT NULL,
  `hardDisk` longtext DEFAULT NULL,
  `monitor` varchar(100) DEFAULT NULL,
  `monitor_display` int(50) DEFAULT NULL,
  `graphics_card_type` longtext DEFAULT NULL,
  `graphics_card` varchar(50) DEFAULT NULL,
  `keyboard_company` longtext DEFAULT NULL,
  `mouse_company` longtext DEFAULT NULL,
  `speakers` longtext DEFAULT NULL,
  `ram_type` longtext DEFAULT NULL,
  `ram_company` longtext DEFAULT NULL,
  `ram_capacity` varchar(50) DEFAULT NULL,
  `pcQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_details`
--

INSERT INTO `pc_details` (`pc_id`, `pc_image`, `pcName`, `PC_Type`, `motherboard`, `processor`, `pcPrice`, `hardDisk`, `monitor`, `monitor_display`, `graphics_card_type`, `graphics_card`, `keyboard_company`, `mouse_company`, `speakers`, `ram_type`, `ram_company`, `ram_capacity`, `pcQty`) VALUES
(23, 'uploadedimages/streamingcomp.jpg', 'Monster the beast', 'Desktop', 'Gigabyte GA-H61M-S', 'i3 6th generation', 100000, '8', 'Samsung', 32, 'Nvidia Titan V', '16', 'SAMSUNG', 'SAMSUNG', 'SAMSUNG', 'DDR4', 'Corsair', '16', 8),
(26, 'uploadedimages/p-2.jpg', 'Acer Aspire', 'Desktop', 'Gigabyte GA-H61M-S', 'i3 6th generation', 100000, '4', 'Samsung', 32, 'Nvidia Titan V', '32', 'SAMSUNG', 'SAMSUNG', 'SAMSUNG', 'DDR4', 'Corsair', '32', 8),
(29, 'uploadedimages/p-14.jpg', ' Gandiva Nallu Assembled Desktop', 'Desktop', 'Gigabyte GA-H61M-S', 'i3 6th generation', 24000, '1', 'Samsung', 22, 'Nvidia Titan V', '2', 'SAMSUNG', 'SAMSUNG', 'SAMSUNG', 'DDR3', 'Corsair', '4', 3),
(30, 'uploadedimages/p-16.png', 'Ultra 3 Mini Gaming PC', 'Gaming', 'Gigabyte GA-H61M-S1', 'i7 5th generation', 80000, '3', 'HP', 33, 'Nvidia GTX 1070', '8', 'Logitech', 'Logitech', 'HP', 'DDR4', 'Kingston', '4', 10),
(31, 'uploadedimages/p-17.png', 'Customise Fortnite Ryzen Gaming PC', 'Gaming', 'Gigabyte GA-H61M-S1', 'AMD Ryzen 7 PRO', 90000, '10', 'Samsung', 22, 'Nvidia RTX 2080 Ti', '8', 'Logitech', 'Logitech', 'Microsoft', 'DDR4', 'Kingston', '8', 10),
(32, 'uploadedimages/p-37.jpg', 'Streaming setup for your live broadcasts', 'Streaming', 'Gigabyte GA-H61M-S', 'i3 5th generation', 50000, '2', 'LG', 33, 'Nvidia GTX 1070', '4', 'Logitech', 'HP', 'Razer', 'DDR3', 'Kingston', '8', 20),
(33, 'uploadedimages/p-38.jpg', 'Dual Monitor Computer', 'Desktop', 'Gigabyte GA-H61M-S', 'i3 6th generation', 70000, '8', 'Samsung', 22, 'Nvidia Titan Pascal', '8', 'Razer', 'Razer', 'Microsoft', 'DDR4', 'Kingston', '8', 10),
(34, 'uploadedimages/p-36.jpg', 'Avant Gaming Tower', 'Gaming', 'Gigabyte GA-H61M-S', 'i3 6th generation', 80000, '8', 'Samsung', 22, 'Nvidia GTX 1070', '8', 'Razer', 'HP', 'HP', 'DDR4', 'Samsung', '16', 29),
(35, 'uploadedimages/p-35.jpg', 'Gamin PC Oman', 'Gaming', 'Gigabyte GA-H61M-S', 'i3 6th generation', 100000, '8', 'Samsung', 22, 'Nvidia Titan V', '8', 'SAMSUNG', 'SAMSUNG', 'SAMSUNG', 'DDR4', 'Corsair', '16', 38);

-- --------------------------------------------------------

--
-- Table structure for table `processorlist`
--

CREATE TABLE `processorlist` (
  `pID` int(11) NOT NULL,
  `processorName` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `processorlist`
--

INSERT INTO `processorlist` (`pID`, `processorName`) VALUES
(1, 'i3 6th generation'),
(2, 'i5 6th generation'),
(3, 'i7 6th generation'),
(4, 'i3 5th generation'),
(5, 'i5 5th generation'),
(6, 'i7 5th generation'),
(7, 'AMD Ryzen 3'),
(8, 'AMD Ryzen 3 PRO'),
(9, 'AMD Ryzen 5'),
(10, 'AMD Ryzen 5 PRO'),
(11, 'AMD Ryzen 7'),
(12, 'AMD Ryzen 7 PRO');

-- --------------------------------------------------------

--
-- Table structure for table `pwd_table`
--

CREATE TABLE `pwd_table` (
  `idpwd` int(6) NOT NULL,
  `emailVerify` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ramcompany`
--

CREATE TABLE `ramcompany` (
  `rID` int(11) NOT NULL,
  `ramCompany` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ramcompany`
--

INSERT INTO `ramcompany` (`rID`, `ramCompany`) VALUES
(1, 'Corsair'),
(2, 'Micron'),
(3, 'Kingston'),
(4, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `sborders`
--

CREATE TABLE `sborders` (
  `orderID` int(11) NOT NULL,
  `ordernumber` int(255) NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `pcName` varchar(100) DEFAULT NULL,
  `partID` int(10) DEFAULT NULL,
  `partQty` int(50) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `totalAmount` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sborders`
--

INSERT INTO `sborders` (`orderID`, `ordernumber`, `userID`, `pcName`, `partID`, `partQty`, `paymentMethod`, `subTotal`, `shipping`, `tax`, `totalAmount`, `date`, `status`) VALUES
(405, 646101145, 69, 'Monster UP', 37, 1, 'online', 12000, 0, 0, 12000, '2019-10-15', 'Pending'),
(406, 646101145, 69, 'Monster UP', 41, 1, 'online', 1000, 0, 0, 1000, '2019-10-15', 'Pending'),
(407, 646101145, 69, 'Monster UP', 24, 1, 'online', 3000, 0, 0, 3000, '2019-10-15', 'Pending'),
(408, 646101145, 69, 'Monster UP', 42, 1, 'online', 3000, 0, 0, 3000, '2019-10-15', 'Pending'),
(409, 646101145, 69, 'Monster UP', 44, 1, 'online', 14000, 0, 0, 14000, '2019-10-15', 'Pending'),
(410, 646101145, 69, 'Monster UP', 49, 1, 'online', 3500, 0, 0, 3500, '2019-10-15', 'Pending'),
(411, 646101145, 69, 'Monster UP', 35, 1, 'online', 28000, 0, 0, 28000, '2019-10-15', 'Pending'),
(412, 646101145, 69, 'Monster UP', 46, 1, 'online', 1500, 0, 0, 1500, '2019-10-15', 'Pending'),
(413, 646101145, 69, 'Monster UP', 47, 1, 'online', 750, 0, 0, 750, '2019-10-15', 'Pending'),
(414, 1029019186, 69, 'UP Down', 37, 1, 'online', 12000, 0, 0, 12000, '2019-10-15', 'Pending'),
(415, 1029019186, 69, 'UP Down', 41, 1, 'online', 1000, 0, 0, 1000, '2019-10-15', 'Pending'),
(416, 1029019186, 69, 'UP Down', 24, 1, 'online', 3000, 0, 0, 3000, '2019-10-15', 'Pending'),
(417, 1029019186, 69, 'UP Down', 20, 1, 'online', 9000, 0, 0, 9000, '2019-10-15', 'Pending'),
(418, 1029019186, 69, 'UP Down', 33, 1, 'online', 34000, 0, 0, 34000, '2019-10-15', 'Pending'),
(419, 1029019186, 69, 'UP Down', 34, 1, 'online', 3000, 0, 0, 3000, '2019-10-15', 'Pending'),
(420, 1029019186, 69, 'UP Down', 22, 1, 'online', 30000, 0, 0, 30000, '2019-10-15', 'Pending'),
(421, 1029019186, 69, 'UP Down', 46, 1, 'online', 1500, 0, 0, 1500, '2019-10-15', 'Pending'),
(422, 1029019186, 69, 'UP Down', 29, 1, 'online', 980, 0, 0, 980, '2019-10-15', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `sbpayu`
--

CREATE TABLE `sbpayu` (
  `sbpayuID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `txnid` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `productinfo` varchar(200) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payuMoneyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sbpayu`
--

INSERT INTO `sbpayu` (`sbpayuID`, `orderID`, `userID`, `txnid`, `amount`, `productinfo`, `time`, `payuMoneyID`) VALUES
(2, 1710232955, 47, 8, 96900, 'Test', '2019-09-28 12:32:14', 249883134),
(3, 1532430233, 47, 8, 97900, 'Test2', '2019-09-28 12:36:41', 249883137),
(4, 264930839, 47, 8, 97900, 'Test', '2019-09-28 12:39:15', 249883138),
(5, 414741469, 47, 8, 103750, 'Monster The Coco', '2019-09-30 12:53:49', 249886170),
(6, 27076228, 69, 8, 93250, 'Beast', '2019-10-15 17:51:51', 249912501),
(7, 1166998138, 69, 8, 96480, 'Beast', '2019-10-15 18:00:46', 249912512),
(8, 1494911977, 69, 8, 55750, 'Beast', '2019-10-15 18:06:10', 249912514),
(9, 646101145, 69, 8, 66750, 'Monster UP', '2019-10-15 18:09:54', 249912515),
(10, 1029019186, 69, 8, 94480, 'UP Down', '2019-10-15 18:13:28', 249912519);

-- --------------------------------------------------------

--
-- Table structure for table `sbpc`
--

CREATE TABLE `sbpc` (
  `sbPCID` int(11) NOT NULL,
  `orderNumber` int(11) DEFAULT NULL,
  `pcName` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `PackingType` varchar(100) NOT NULL,
  `sttus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sbpc`
--

INSERT INTO `sbpc` (`sbPCID`, `orderNumber`, `pcName`, `amount`, `userID`, `paymentMethod`, `date`, `PackingType`, `sttus`) VALUES
(18, 646101145, 'Monster UP', 66750, 69, 'online', '2019-10-15', 'assemble', 'Pending'),
(20, 1029019186, 'UP Down', 94480, 69, 'online', '2019-10-15', 'noassemble', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `systembuild`
--

CREATE TABLE `systembuild` (
  `sbID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `partKeyword` int(11) DEFAULT NULL,
  `partID` int(11) DEFAULT NULL,
  `partPrice` int(11) NOT NULL,
  `partDiscount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `isUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `mobNumber` tinytext NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `userImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`isUsers`, `uidUsers`, `emailUsers`, `pwdUsers`, `mobNumber`, `address`, `country`, `state`, `userImage`) VALUES
(49, 'Jeniston', 'Jeni@gmail.com', '$2y$10$LsRrh6rYqerrqB5hDanmO.uW5paPc19g1wEY7XLrUcv.RrA2DvRyy', '9167877725', 'j', 'j', 'india', 'user/userimages/1.jpeg'),
(68, 'Mr.Useless', 'mr.useless404@gmail.com', '', '5954689489748', '97484ojidsjijuijuijui', 'oki[po0kpo0k[0poi', 'jujuiioki[o0ik[o0k', 'https://lh3.googleusercontent.com/a-/AAuE7mB-DfYkRpet5H4u-qxHiZm7RitdHxE9S2auDVF_'),
(69, 'Agnel', 'agnelselvan007@gmail.com', '$2y$10$sUEsC0jDUdVXDqj.joXG0.IB.53veANMJEkR50l.OGTck545ju46e', '9167877725', 'Taj', 'Maharashtra', 'india', 'user/userimages/agnel.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cID`);

--
-- Indexes for table `casecompany`
--
ALTER TABLE `casecompany`
  ADD PRIMARY KEY (`caseCompID`);

--
-- Indexes for table `graphicscardcompany`
--
ALTER TABLE `graphicscardcompany`
  ADD PRIMARY KEY (`grapCardID`);

--
-- Indexes for table `iocompany`
--
ALTER TABLE `iocompany`
  ADD PRIMARY KEY (`IOId`);

--
-- Indexes for table `monitorcompany`
--
ALTER TABLE `monitorcompany`
  ADD PRIMARY KEY (`mID`);

--
-- Indexes for table `motherboardtype`
--
ALTER TABLE `motherboardtype`
  ADD PRIMARY KEY (`motherID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `payu`
--
ALTER TABLE `payu`
  ADD PRIMARY KEY (`payuID`);

--
-- Indexes for table `pccart`
--
ALTER TABLE `pccart`
  ADD PRIMARY KEY (`pccartid`);

--
-- Indexes for table `pcpart`
--
ALTER TABLE `pcpart`
  ADD PRIMARY KEY (`pcPartID`);

--
-- Indexes for table `pcpartcomp`
--
ALTER TABLE `pcpartcomp`
  ADD PRIMARY KEY (`pcPartID`);

--
-- Indexes for table `pctype`
--
ALTER TABLE `pctype`
  ADD PRIMARY KEY (`pcTypeID`);

--
-- Indexes for table `pc_details`
--
ALTER TABLE `pc_details`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `processorlist`
--
ALTER TABLE `processorlist`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `pwd_table`
--
ALTER TABLE `pwd_table`
  ADD PRIMARY KEY (`idpwd`);

--
-- Indexes for table `ramcompany`
--
ALTER TABLE `ramcompany`
  ADD PRIMARY KEY (`rID`);

--
-- Indexes for table `sborders`
--
ALTER TABLE `sborders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `sbpayu`
--
ALTER TABLE `sbpayu`
  ADD PRIMARY KEY (`sbpayuID`);

--
-- Indexes for table `sbpc`
--
ALTER TABLE `sbpc`
  ADD PRIMARY KEY (`sbPCID`);

--
-- Indexes for table `systembuild`
--
ALTER TABLE `systembuild`
  ADD PRIMARY KEY (`sbID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`isUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `casecompany`
--
ALTER TABLE `casecompany`
  MODIFY `caseCompID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `graphicscardcompany`
--
ALTER TABLE `graphicscardcompany`
  MODIFY `grapCardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `iocompany`
--
ALTER TABLE `iocompany`
  MODIFY `IOId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `monitorcompany`
--
ALTER TABLE `monitorcompany`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motherboardtype`
--
ALTER TABLE `motherboardtype`
  MODIFY `motherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `payu`
--
ALTER TABLE `payu`
  MODIFY `payuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `pccart`
--
ALTER TABLE `pccart`
  MODIFY `pccartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pcpart`
--
ALTER TABLE `pcpart`
  MODIFY `pcPartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pcpartcomp`
--
ALTER TABLE `pcpartcomp`
  MODIFY `pcPartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pctype`
--
ALTER TABLE `pctype`
  MODIFY `pcTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pc_details`
--
ALTER TABLE `pc_details`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `processorlist`
--
ALTER TABLE `processorlist`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pwd_table`
--
ALTER TABLE `pwd_table`
  MODIFY `idpwd` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ramcompany`
--
ALTER TABLE `ramcompany`
  MODIFY `rID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sborders`
--
ALTER TABLE `sborders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `sbpayu`
--
ALTER TABLE `sbpayu`
  MODIFY `sbpayuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sbpc`
--
ALTER TABLE `sbpc`
  MODIFY `sbPCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `systembuild`
--
ALTER TABLE `systembuild`
  MODIFY `sbID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `isUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
