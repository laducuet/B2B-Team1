-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 17, 2023 lúc 06:00 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_team`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddNewAdmin` (IN `fName` VARCHAR(20), IN `lName` VARCHAR(20), IN `userName` VARCHAR(20), IN `email` VARCHAR(70), IN `password` VARCHAR(100))   INSERT INTO `admin` (`ID`, `fName`, `lName`, `userName`, `email`, `password`) VALUES (NULL, fName, lName, userName, email, password)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteFromCartItem` (IN `cartIDD` INT(11), IN `itemIDD` INT(11))   DELETE FROM cartitem WHERE cartitem.cartId = cartIDD AND cartitem.itemId = itemIDD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllCategories` ()   BEGIN
SELECT * FROM category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllChildCategories` ()   BEGIN
SELECT * FROM childcategory;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllImages` ()   BEGIN
SELECT *  FROM itemimage;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllitems` ()   BEGIN
SELECT *  FROM item ORDER by quantity DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getBuyerWithUserName` (IN `UserNameee` VARCHAR(20))   SELECT * FROM buyer where userName = UserNameee$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getItemCartWithItemIdandBuyerId` (IN `buyerID` INT(11), IN `itemIDD` INT(11))   SELECT cartitem.cartId , cartitem.itemId
                                                                                                                            from buyer,cartitem,cart,item
                                                                                                                            WHERE buyer.cartId = cart.cartId and cartitem.cartId=cart.cartId and buyer.ID=buyerID and cartitem.itemId = item.itemId and item.itemId=itemIDD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getItemsByCertainCategory` (IN `catName` VARCHAR(30))   BEGIN
SELECT * FROM item as e WHERE e.categoryId in (SELECT b.categoryId from category as b WHERE categoryName = catName) ORDER BY quantity DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getItemsByCertainChildCategory` (IN `childcatName` VARCHAR(30))   BEGIN
SELECT * FROM item as e WHERE e.childcategoryId in (SELECT b.childcategoryId from childcategory as b WHERE childcategoryName = childcatName) ORDER BY quantity DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getSellerWithUserName` (IN `UserNameee` VARCHAR(20))   SELECT * FROM seller where userName = UserNameee$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewOrder` (IN `cartIdd` INT(11), IN `OrderPricee` DOUBLE, IN `qty` INT(11), IN `buyerIdd` INT(11), IN `itemIdd` INT(11))   INSERT INTO orders (cartId,orderPrice,quantity,buyerId,itemId)  VALUES (cartIdd,OrderPricee,qty,buyerIdd,itemIdd)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchForItemsByKeyword` (IN `KeyWord` VARCHAR(255))   SELECT * FROM item WHERE title LIKE KeyWord UNION SELECT * FROM item WHERE description LIKE KeyWord ORDER by quantity DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `fName` varchar(20) DEFAULT NULL,
  `lName` varchar(20) DEFAULT NULL,
  `userName` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`ID`, `fName`, `lName`, `userName`, `email`, `password`) VALUES
(1, 'NguyenTu', 'Trung', 'admin', 'admin@gmail.com', '4cb7a9e4b9acfd6d97a5aa9c1b83c3947a29c53f'),
(2, 'Le Anh', 'Duc', 'Mainadmin', 'aa@gmail.com', '42f5b40bcb35224d56ba4f05ffc69085fb817b92'),
(4, 'test', 'admin', 'testadmin', 'admintest@gmail.com', 'bfec3a0674b361b6371ca1befcd31da21aa6f020');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `ID` int(11) NOT NULL,
  `numberOfItems` int(11) NOT NULL DEFAULT 0,
  `orderTotal` int(11) NOT NULL DEFAULT 0,
  `cartId` int(11) NOT NULL,
  `firstname` varchar(300) DEFAULT NULL,
  `lastname` varchar(300) DEFAULT NULL,
  `isShip` tinyint(1) NOT NULL DEFAULT 0,
  `companyname` varchar(300) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `optional` varchar(300) DEFAULT NULL,
  `city` varchar(300) DEFAULT NULL,
  `country` varchar(300) DEFAULT NULL,
  `postcode` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`ID`, `numberOfItems`, `orderTotal`, `cartId`, `firstname`, `lastname`, `isShip`, `companyname`, `address`, `optional`, `city`, `country`, `postcode`, `email`, `phone`, `notes`) VALUES
(1, 0, 88, 1, 'Le Anh', 'Duc', 0, 'aaa', 'a', 'aaa', 'q', 'Vietnam', 'AA', 'aa@gmail.com', '223456', '2345'),
(2, 0, 88, 1, 'Le Anh', 'Duc', 1, 'dfehs', 'aaaaaa', 'ádfgfdg', 'qetyuikjhg', 'Vietnam', 'AA', 'aa@gmail.com', '23456', '12356'),
(3, 0, 264, 1, 'Le Anh', 'Duc', 0, 'aaaaaaa', 'a', 'jhhjutyhj', 'q', 'Vietnam', 'AA', 'aa@gmail.com', '123456u', 'jhfyndf'),
(4, 0, 88, 1, 'Le Anh', 'Duc', 1, 'Lan2', 'lan2', 'jkhjhjuy', 'q', 'Vietnam', 'AA', 'aa@gmail.com', '2567', '2346sdf'),
(5, 0, 88, 1, 'Le Anh', 'Duc', 1, 'AAaaaa', 'a', 'hftn', 'q', 'Vietnam', 'AA', 'aa@gmail.com', '123456', 'drgdrg'),
(6, 0, 1960, 4, 'Trung', 'Nguyễn Tử', 0, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(7, 0, 1097, 4, 'Trung', 'Nguyễn Tử', 0, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(8, 0, 2352, 4, 'Trung', 'Nguyễn Tử', 1, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(9, 0, 427, 4, 'Trung', 'Nguyễn Tử', 1, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(10, 0, 549, 4, 'Trung', 'Nguyễn Tử', 0, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(11, 0, 211, 4, 'Trung', 'Nguyễn Tử', 0, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(12, 0, 1097, 4, 'Trung', 'Nguyễn Tử', 0, 'UET', 'CoNhue', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(13, 0, 1292, 4, 'Trung', 'Nguyễn Tử', 1, 'UET', 'Nguyen Khanh Toan', 'Quan Hoa', 'TP Hà Nội', 'Vietnam', '100000', 'trungcnttvnu@gmail.com', '+84355287940', ''),
(14, 0, 2352, 5, 'Nguyễn', 'Thành', 0, 'vnu', 'Xóm Trường Lĩnh', '', 'Nghê AN', 'Vietnam', '1409', 't@gmail.com', '0966711032', 'á đù'),
(15, 0, 3633, 6, 'Nguyễn', 'Thành', 1, '', 'Xóm Trường Lĩnh', '', '', 'Vietnam', '', 't@gmail.com', '0966711032', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buyer`
--

CREATE TABLE `buyer` (
  `ID` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `joinDate` date NOT NULL DEFAULT curdate(),
  `email` varchar(70) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `cartId` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `disLikes` int(11) NOT NULL DEFAULT 0,
  `transactions` int(11) NOT NULL DEFAULT 0,
  `Amount` int(11) NOT NULL DEFAULT 100000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `buyer`
--

INSERT INTO `buyer` (`ID`, `userName`, `password`, `joinDate`, `email`, `fName`, `lName`, `cartId`, `likes`, `disLikes`, `transactions`, `Amount`) VALUES
(1, 'ducqcb', '482de74ca32ccb636bd1fba8ae4ce85c206db3a9', '2023-05-13', 'aa@gmail.com', 'Le Anh', 'Duc', 1, 6, 0, 5, 99557),
(3, 'testbuyer', '021f7c4a1d540d4f9f4f76dc9a36f23c977927cc', '2023-05-15', 'icloud14092003@gmai.com', 'Thanh', 'Nguyen', 3, 0, 0, 0, 100000),
(4, 'trungbmksnb', '4cb7a9e4b9acfd6d97a5aa9c1b83c3947a29c53f', '2023-05-15', 'trungbmksb@gmail.com', 'Nguyen Tu', 'Trung', 4, 6, 0, 8, 91015),
(6, 'testbuyer1', 'bfec3a0674b361b6371ca1befcd31da21aa6f020', '2023-05-16', 'testbuyer1@gmail.com', 'test', 'buyer', 6, 0, 0, 1, 99146);

--
-- Bẫy `buyer`
--
DELIMITER $$
CREATE TRIGGER `deleteNotificationafterBuyerDeletion` BEFORE DELETE ON `buyer` FOR EACH ROW DELETE FROM notification WHERE notification.id in (SELECT notificationId  from  buyernotification,buyer WHERE buyer.ID = buyernotification.ownerID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buyernotification`
--

CREATE TABLE `buyernotification` (
  `notificationId` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `itemCount` int(11) NOT NULL,
  `payment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cartId`, `itemCount`, `payment`) VALUES
(1, 5, 616),
(2, 0, 0),
(3, 0, 0),
(4, 8, 8985.17),
(6, 3, 4332.61);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cartitem`
--

CREATE TABLE `cartitem` (
  `cartId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cartitem`
--

INSERT INTO `cartitem` (`cartId`, `itemId`, `quantity`) VALUES
(6, 23, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `categoryDescription` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryDescription`) VALUES
(10, 'GAME', ''),
(11, 'LAPTOP', ''),
(12, 'SMARTPHONE', ''),
(14, 'SHOES', ''),
(15, 'TV', ''),
(19, 'SPORTS', ''),
(20, 'TOYS', ''),
(21, 'BOOKS', ''),
(22, 'WATCH', '');

--
-- Bẫy `category`
--
DELIMITER $$
CREATE TRIGGER `updateCat` BEFORE DELETE ON `category` FOR EACH ROW UPDATE childcategory as e SET e.categoryId = 1 WHERE e.categoryId in (SELECT c.categoryId from category as c WHERE c.categoryId =OLD.categoryId)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `childcategory`
--

CREATE TABLE `childcategory` (
  `childcategoryId` int(11) NOT NULL,
  `childcategoryName` varchar(30) NOT NULL,
  `categoryId` int(11) DEFAULT 1,
  `childcategoryDescription` varchar(300) NOT NULL,
  `totalItems` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `childcategory`
--

INSERT INTO `childcategory` (`childcategoryId`, `childcategoryName`, `categoryId`, `childcategoryDescription`, `totalItems`) VALUES
(14, 'HP', 11, 'laptop hp chất lượng cao', 56),
(15, 'DELL', 11, 'dell', 5),
(16, 'ACER', 11, 'acer', 18),
(17, 'ASUS', 11, 'asus', 4562),
(18, 'APPLE', 11, 'apple', 50),
(19, 'LG', 11, 'lg', 501),
(20, 'MSI', 11, 'msi', 130),
(21, 'SAMSUNG', 11, 'samsung', 45),
(22, 'HUAWEI', 11, 'huawei', 5),
(23, 'APPLE', 12, 'apple', 307),
(24, 'SAMSUNG', 12, 'samsung', 2),
(25, 'HUAWEI', 12, 'huawei', 123),
(26, 'OPPO', 12, 'oppo', 157),
(27, 'MI', 12, 'mi', 1234),
(28, 'REALME', 12, 'realme', 4),
(29, 'VIVO', 12, 'vivo', 345),
(30, 'PHILIPS', 12, 'philips', 4),
(31, 'LG', 12, 'lg', 0),
(32, 'PES MOBILE', 10, 'pes mobile', 1243),
(33, 'ARENA OF VALOR', 10, 'arena of valor', 223),
(34, 'FIFA ONLINE', 10, 'fifa online', 3444),
(35, 'LEAGUE OF LEGENDS', 10, 'league of legends', 999),
(36, 'PUBG MOBILE', 10, 'pubg mobile', 211),
(37, 'NGOC RONG ONLINE', 10, 'ngoc rong online', 222),
(38, 'STEAM', 10, 'steam', 678),
(39, 'VALORANT', 10, 'valorant', 1120),
(40, 'GUNNY', 10, 'gunny', 32),
(41, 'LG', 15, 'lg', 0),
(42, 'SONY', 15, 'sony', 0),
(43, 'SAMSUNG', 15, 'samsung', 0),
(44, 'MI', 15, 'mi', 0),
(45, 'PANASONIC', 15, 'panasonic', 0),
(46, 'PHILIPS', 15, 'philips', 342),
(47, 'SHARP', 15, 'sharp', 0),
(48, 'TCL', 15, 'tcl', 0),
(49, 'ASANZO', 15, 'asanzo', 0),
(50, 'NIKES', 14, 'nikes', 242),
(51, 'ADIDAS', 14, 'adidas', 456),
(52, 'NEW BALANCE', 14, 'new balance', 123),
(53, 'ASICS', 14, 'asics', 234),
(54, 'PUMA', 14, 'puma', 234),
(55, 'SKECHERS', 14, 'skechers', 234),
(56, 'FILA', 14, 'fila', 123),
(57, 'BATA', 14, 'bata', 12),
(58, 'BURBERRY', 14, 'burberry', 341),
(59, 'ROSSIGNOL', 19, 'rossignol', 56),
(60, 'HEAD', 19, 'head', 789),
(61, 'SALOMON', 19, 'salomon', 33),
(62, 'WILSON', 19, 'wilson', 345),
(63, 'BLIZZARD - TECNICA', 19, 'blizzard - tecnica', 12),
(64, 'FISCHER SPORTS', 19, 'fischer sports', 12),
(65, 'ATOMIC', 19, 'atomic', 234),
(66, 'BALOLAT', 19, 'babolat', 23),
(67, 'UHLSPORT', 19, 'uhlsport', 66),
(77, 'ROLEX', 22, 'rolex', 0),
(78, 'OMEGA', 22, 'omega', 0),
(79, 'CARTIER', 22, 'cartier', 0),
(80, 'PATEK PHILIPPE', 22, 'patek philippe', 0),
(81, 'TAG HEUER', 22, 'tag heuer', 0),
(82, 'BREITLING', 22, 'breitling', 0),
(83, 'TISSOT', 22, 'tissot', 0),
(84, 'SEIKO', 22, 'seiko', 0),
(85, 'CITIZEN', 22, 'CITIZEN', 0),
(86, 'LEGO', 20, 'lego', 0),
(87, 'HASBRO', 20, 'hasbro', 0),
(88, 'MATTEL', 20, 'mattel', 0),
(89, 'FISHER-PRICE', 20, 'fisher-price', 0),
(90, 'BARBIE', 20, 'barbie', 0),
(91, 'PLAYMOBIL', 20, 'playmobil', 0),
(92, 'HOT WHEELS', 20, 'hot wheels', 0),
(93, 'NERF', 20, 'nerf', 0),
(94, 'BANDAI', 20, 'bandai', 0),
(95, 'SWIFT', 21, 'swift', 0),
(96, 'PHP', 21, 'php', 0),
(97, 'C SHARP', 21, 'c sharp', 0),
(98, 'C++', 21, 'c++', 0),
(99, 'JAVASCRIPT', 21, 'javascript', 0),
(100, 'PYTHON', 21, 'python', 0),
(101, 'JAVA', 21, 'java', 0),
(102, 'RUBY', 21, 'ruby', 0),
(103, 'OBJECTIVE-C', 21, 'objectice-c', 0);

--
-- Bẫy `childcategory`
--
DELIMITER $$
CREATE TRIGGER `updateChildCat` BEFORE DELETE ON `childcategory` FOR EACH ROW UPDATE item as e SET e.childcategoryId = 1 WHERE e.childcategoryId in (SELECT c.childcategoryId from childcategory as c WHERE c.childcategoryId =OLD.childcategoryId)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item`
--

CREATE TABLE `item` (
  `itemId` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `information` text DEFAULT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `addDate` date NOT NULL DEFAULT curdate(),
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `isSaled` tinyint(1) NOT NULL DEFAULT 0,
  `childcategoryId` int(11) DEFAULT 1,
  `sellerId` int(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `homeNumber` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `item`
--

INSERT INTO `item` (`itemId`, `title`, `description`, `information`, `price`, `quantity`, `addDate`, `isDeleted`, `isSaled`, `childcategoryId`, `sellerId`, `startDate`, `endDate`, `discount`, `homeNumber`, `street`, `city`, `country`) VALUES
(4, 'OPPO A16', '', '', 500, 123, '2023-05-15', 0, 0, 26, 2, NULL, NULL, 3, 123, '30', '04', 'Việt Nam'),
(5, 'VIVO V25', '', '', 300, 345, '2023-05-15', 0, 0, 29, 2, NULL, NULL, 2, 123, '30', '04', 'Việt Nam'),
(6, 'HWAWEI y9', '', '', 430, 123, '2023-05-15', 0, 0, 25, 2, NULL, NULL, 3, 123, '30', '04', 'Việt Nam'),
(7, 'FILA Men&#039;s MB', '', '', 340, 123, '2023-05-15', 0, 0, 56, 2, NULL, NULL, 2, 123, '30', '04', 'Việt Nam'),
(8, 'IPhone 14 ProMax', 'iPhone 14 Pro Max, với chip A16 và màn hình “viên thuốc” Dynamic Island', '', 1200, 144, '2023-05-15', 0, 1, 23, 3, NULL, NULL, 2, 144, 'Xuân Thủy', 'Cầu Giấy', 'Hà Nội'),
(9, 'New Balance 574', '', '', 66, 123, '2023-05-15', 0, 0, 52, 2, NULL, NULL, 20, 123, '30', '04', 'Việt Nam'),
(10, 'BABOLAT PURE STRIKE', '', '', 44, 23, '2023-05-15', 0, 0, 66, 2, NULL, NULL, 10, 12, '30', '04', 'Việt Nam'),
(11, 'MSI Modern 14', 'Trong tầm giá 16 triệu thì MSI Modern 14 204VN chính là lựa chọn tối ưu', '', 800, 65, '2023-05-15', 0, 0, 20, 4, NULL, NULL, 2, 2, 'Phạm Văn Đồng', 'Cầu Giấy', 'Hà Nội'),
(12, 'BLIZZARD TECNICA  4', '', '', 456, 12, '2023-05-15', 0, 0, 63, 2, NULL, NULL, 30, 123, '30', '04', 'Việt Nam'),
(13, 'fischer sports 12', '', '', 123, 12, '2023-05-15', 0, 0, 64, 2, NULL, NULL, 40, 12, '30', '04', 'Việt Nam'),
(14, 'BATA MEN', '', '', 44, 12, '2023-05-15', 0, 0, 57, 2, NULL, NULL, 10, 12, '30', '04', 'Việt Nam'),
(15, 'Salomon Mens', '', '', 66, 33, '2023-05-15', 0, 0, 61, 2, NULL, NULL, 20, 12, '30', '04', 'Việt Nam'),
(16, 'SamsungNP550XDA', 'Laptop Samsung NP550XDA Core i7-1165G7, 16gb Ram, 512gb SSD, vga rời nVidia MX450, 15,6inch Full HD , hàng nhập khẩu', '', 900, 45, '2023-05-15', 0, 0, 21, 4, NULL, NULL, 20, 22, 'Phạm Văn Đồng', 'Cầu Giấy', 'Việt Nam'),
(17, 'Uhlsport Radar 4', '', '', 53, 33, '2023-05-15', 0, 0, 67, 2, NULL, NULL, 12, 123, '30', '04', 'Việt Nam'),
(18, 'SamsungNote20Ultra5G', 'Galaxy Note 20 Ultra 5G, mẫu điện thoại flagship cao cấp thuộc dòng Note của Samsung, ra mắt tháng 8/2020 với diện mạo thay đổi cùng những nâng cấp đột phá', '', 1000, 43, '2023-05-15', 1, 1, 24, 3, NULL, NULL, 2, 5, 'Xuân Thủy', 'Cầu Giấy', 'Vietnam'),
(19, 'RADAR', '', '', 76, 789, '2023-05-15', 0, 0, 60, 2, NULL, NULL, 23, 123, '30', '04', 'Việt Nam'),
(20, 'Asus TUF Gaming', 'Laptop Asus TUF Gaming (HN188W) được trang bị bộ vi xử lý Intel mạnh mẽ, card đồ họa rời NVIDIA và ổ cứng SSD tốc độ cao, tất cả tạo nên một cỗ máy; mạnh mẽ, đáp ứng tốt nhu cầu chơi game ở mức độ cấu hình cao.', '', 1000, 30, '2023-05-15', 0, 0, 17, 4, NULL, NULL, 2, 34, 'p', 'Cầu Giấy', 'Việt Nam'),
(21, 'BURBERRY vintage', '', '', 33, 341, '2023-05-15', 0, 0, 58, 2, NULL, NULL, 12, 123, '30', '04', 'Việt Nam'),
(22, 'ATOMIC zen 3', '', '', 69, 234, '2023-05-15', 0, 0, 65, 2, NULL, NULL, 39, 23, '30', '04', 'Việt Nam'),
(23, 'HP 15-DY2795', 'Laptop HP 15 Core i5 1135G7 RAM 8GB SSD 256GB 15.6&#039;&#039; FHD', '', 700, 56, '2023-05-15', 0, 0, 14, 4, NULL, NULL, 0, 21, 'p', 'Cầu Giấy', 'Việt Nam'),
(24, 'VALORANT CVY', '', '', 34, 121, '2023-05-15', 0, 0, 39, 2, NULL, NULL, 22, 23, '30', '04', 'Việt Nam'),
(25, 'LG Gram 17 2021', 'Laptop LG Gram 17 2021 i7 (17Z90P-G.AH76A5) là 1 phiên bản laptop thời trang mang thiết kế siêu mỏng nhẹ với cấu hình mạnh mẽ, giải trí đẳng cấp, là 1 lựa chọn đầy thú vị dành cho bạn.', '', 950, 45, '2023-05-15', 0, 0, 19, 4, NULL, NULL, 3, 3, 'P', 'Cầu Giấy', 'Việt Nam'),
(26, 'MI 10', '', '', 99, 1234, '2023-05-15', 0, 0, 27, 2, NULL, NULL, 23, 12, '30', '04', 'Việt Nam'),
(27, 'SKECHERS 11', '', '', 77, 234, '2023-05-15', 0, 0, 55, 2, NULL, NULL, 33, 123, '30', '04', 'Việt Nam'),
(28, 'PUMA 42', '', '', 234, 234, '2023-05-15', 0, 0, 54, 2, NULL, NULL, 35, 234, '30', '04', 'Việt Nam'),
(29, 'MateBookD16', 'Laptop HUAWEI MateBook D16, Intel Core i5-12450H pana la 4.4GHz, 16&quot; Full HD, 16GB, SSD 512GB, Intel UHD Graphics, Windows 11 Home', '', 790, 5, '2023-05-15', 0, 0, 22, 4, NULL, NULL, 2, 32, 'p', 'Cầu Giấy', 'Việt Nam'),
(30, 'asics gel lyte iii', '', '', 124, 234, '2023-05-15', 0, 0, 53, 2, NULL, NULL, 12, 23, '30', '04', 'Việt Nam'),
(31, 'rossignol soul 7', '', '', 234, 56, '2023-05-15', 0, 0, 59, 2, NULL, NULL, 43, 34, '30', '04', 'Việt Nam'),
(32, 'David Adam', 'No.002 / eFootball 2023', '', 20, 1243, '2023-05-15', 0, 0, 32, 5, NULL, NULL, 2, 99, 'Pham', 'Bac Giang', 'Viet Nam'),
(33, 'Realme Book Slim', 'Realme Book Slim là một chiếc ultrabook 14 inch mỏng và nhẹ. Được trang bị bộ vi xử lý Intel Core thế hệ thứ 11, Realme Book Slim có thể chạy trên Windows 10 và có thể cung cấp thời lượng pin lên đến 11 giờ cho một lần sạc.', '', 950, 4, '2023-05-15', 0, 0, 28, 4, NULL, NULL, 2, 34, 'p', 'Cầu Giấy', 'Việt Nam'),
(34, 'LG V50', '', '', 684, 456, '2023-05-15', 0, 0, 19, 2, NULL, NULL, 23, 123, '30', '04', 'Việt Nam'),
(35, 'adidas falcon', '', '', 534, 456, '2023-05-15', 0, 0, 51, 2, NULL, NULL, 23, 345, '30', '04', 'Việt Nam'),
(36, 'Anan Ga', 'Đội hình đắt nhất Fifa Online 4 2023', '', 30, 3444, '2023-05-15', 0, 0, 34, 5, NULL, NULL, 2, 22, 'ba', 'Bac Giang', 'Vietnam'),
(37, 'momolo', '', '', 77, 342, '2023-05-15', 0, 0, 46, 2, NULL, NULL, 43, 23, '30', '04', 'Việt Nam'),
(38, 'NIKES S4', '', '', 67, 242, '2023-05-15', 0, 0, 50, 2, NULL, NULL, 34, 234, '30', '04', 'Việt Nam'),
(39, 'STEAM valve', '', '', 435, 234, '2023-05-15', 0, 0, 38, 2, NULL, NULL, 45, 33, '30', '04', 'Việt Nam'),
(40, 'alna mala', 'gia acc lol', '', 30, 999, '2023-05-15', 0, 0, 35, 5, NULL, NULL, 2, 34, 'Pham', 'Bac Giang', 'Vietnam'),
(41, 'Philips X58', 'Philips 15NB5800 cung cấp hiệu suất hợp lý và chất lượng xây dựng thỏa đáng với mức giá yêu cầu.', '', 600, 2, '2023-05-15', 0, 0, 30, 4, NULL, NULL, 1, 43, 'p', 'Cầu Giấy', 'Việt Nam'),
(42, 'asus rog phone 5', '', '', 76, 4523, '2023-05-15', 0, 0, 17, 2, NULL, NULL, 43, 456, '30', '04', 'Việt Nam'),
(43, 'David Adal', 'acc lq', '', 20, 223, '2023-05-15', 0, 0, 33, 5, NULL, NULL, 2, 70, 'Pham', 'Bac Giang', 'Vietnam'),
(44, 'WILSON 4', '', '', 231, 345, '2023-05-15', 0, 0, 62, 2, NULL, NULL, 34, 123, '30', '04', 'Việt Nam'),
(45, 'Dell Latitude 3520', 'Thiết Kế Sang Trọng, Nhẹ, CPU Intel Core i7 Gen 11, RAM 16GB, ổ SSD, âm thanh trong trẻo, micro tích hợp thu âm rất tốt, màn hình rộng, đèn bàn phím', '', 1000, 5, '2023-05-15', 0, 0, 15, 4, NULL, NULL, 2, 4, 'P', 'Cầu Giấy', 'Việt Nam'),
(46, 'David Adap', 'acc pubg mobile', '', 30, 211, '2023-05-15', 0, 0, 36, 5, NULL, NULL, 2, 10, 'Pham', 'Bac Giang', 'Vietnam'),
(47, 'David Ada', 'acc ngoc rong online', '', 20, 222, '2023-05-15', 0, 0, 37, 5, NULL, NULL, 2, 23, 'Pham', 'Bac Giang', 'Vietnam'),
(48, 'Acer Aspire 3 A315', 'Laptop Acer Aspire được trang bị bộ vi xử lý Intel Core i5 1135G7 mang đến sức mạnh vượt trội có thể xử lý nhanh gọn các tác vụ học tập, văn phòng trên Word, Excel, PowerPoint,...', '', 900, 9, '2023-05-15', 0, 0, 16, 4, NULL, NULL, 1, 34, 'P', 'Cầu Giấy', 'Việt Nam'),
(49, 'Asa La', 'acc steam', '', 30, 444, '2023-05-15', 0, 0, 38, 5, NULL, NULL, 2, 21, 'Pham', 'Bac Giang', 'Vietnam'),
(50, 'David Apol', 'acc valorant', '', 30, 999, '2023-05-15', 0, 0, 39, 5, NULL, NULL, 2, 88, 'Pham', 'Bac Giang', 'Vietnam'),
(51, 'David lama', 'acc gunny', '', 30, 32, '2023-05-15', 0, 0, 40, 5, NULL, NULL, 2, 41, 'Pham', 'Bac Giang', 'Vietnam'),
(52, 'MacBook Air 2020', 'Bộ xử lý CPU: Apple M1 chip with 8‑core CPU, 7‑core GPU, and 16‑core Neural Engine\r\nBộ nhớ RAM: 8GB', '', 1050, 50, '2023-05-15', 0, 0, 18, 4, NULL, NULL, 2, 3, 'P', 'Cầu Giấy', 'Việt Nam'),
(53, 'Iphone 13 pro max', 'Iphone 13 pro max\r\nMàu xanh dương\r\n128GB\r\nGiảm giá 5%', '', 680, 1, '2023-05-15', 1, 1, 23, 6, NULL, NULL, 5, 1, 'Vũ Trọng Phụng', 'Ha Noi', 'VN'),
(54, 'Iphone 12 pro max', 'Iphone 12 pro max\r\nMàu trắng\r\n256GB RAM 6GB\r\nGiảm giá 7%', '', 590, 0, '2023-05-15', 0, 1, 23, 6, NULL, NULL, 7, 3, 'Vũ Trọng Phụng', 'Ha Noi', 'VN'),
(55, 'Iphone 11 pro max', 'Iphone 13 pro max\r\nĐủ màu\r\n128GB RAM 6GB\r\nGiảm giá 7%', '', 459, 24, '2023-05-15', 0, 1, 23, 6, NULL, NULL, 7, 4, 'Vũ Trọng Phụng', 'Ha Noi', 'VN'),
(56, 'Iphone 11 thường', 'Iphone 11 thường Màu trắng 128GB Giảm giá 10%', '', 259, 14, '2023-05-15', 0, 0, 23, 6, NULL, NULL, 10, 4, 'Vũ Trọng Phụng', 'Ha Noi', 'VN'),
(57, 'Iphone XS', 'Iphone XS màu vani 64GB RAM 4GB giảm giá 15%', '', 124, 11, '2023-05-15', 0, 1, 23, 6, NULL, NULL, 15, 4, 'Vũ Trọng Phụng', 'Ha Noi', 'VN'),
(58, 'IPhone 6 Plus', 'iPhone 6 Plus 128GB cũ giá rẻ, chính hãng', '', 123, 124, '2023-05-15', 0, 0, 23, 3, NULL, NULL, 2, 1444, 'Xuân Thủy', 'Cầu Giấy', 'Hà Nội'),
(59, 'IPhone 15 Promax', 'IPhone 15 Pro thực tế với nhiều sự thay đổi không ngờ tới', '', 2000, 23, '2023-05-15', 0, 0, 23, 3, NULL, NULL, 1, 123, 'X', 'Cầu Giấy', 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `itemimage`
--

CREATE TABLE `itemimage` (
  `itemId` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `itemimage`
--

INSERT INTO `itemimage` (`itemId`, `image`) VALUES
(4, '6461b4a240493-1684124834.jpg'),
(4, '6461b4a240a08-1684124834.png'),
(4, '6461b4a240c68-1684124834.png'),
(5, '6461b50125c7c-1684124929.jpg'),
(5, '6461b50125f79-1684124929.jfif'),
(5, '6461b501261a6-1684124929.jpg'),
(6, '6461b579b3b02-1684125049.jpg'),
(6, '6461b579b3f46-1684125049.jpg'),
(6, '6461b579b42a9-1684125049.jpg'),
(7, '6461b5d93d3c1-1684125145.jfif'),
(7, '6461b5d93d7c5-1684125145.jfif'),
(7, '6461b5d93dc97-1684125145.jpg'),
(8, '6461b5ec9cefc-1684125164.png'),
(8, '6461b5ec9d4dd-1684125164.jpg'),
(8, '6461b5ec9d836-1684125164.jpg'),
(9, '6461b6c9c0c18-1684125385.jpg'),
(9, '6461b6c9c1036-1684125385.jpg'),
(9, '6461b6c9c1359-1684125385.webp'),
(10, '6461b7522bc3d-1684125522.webp'),
(10, '6461b7522c2c6-1684125522.webp'),
(11, '6461b7d3ae831-1684125651.jpg'),
(11, '6461b7d3af232-1684125651.jpg'),
(11, '6461b7d3af4d6-1684125651.jpg'),
(12, '6461b7f907631-1684125689.jfif'),
(12, '6461b7f907b49-1684125689.jfif'),
(13, '6461b86a2f28a-1684125802.jfif'),
(14, '6461b8c1e9998-1684125889.jpg'),
(14, '6461b8c1e9d12-1684125889.jpg'),
(15, '6461b9c822b49-1684126152.jpg'),
(15, '6461b9c823064-1684126152.webp'),
(16, '6461b95ba4243-1684126043.png'),
(16, '6461b95ba46c3-1684126043.jpg'),
(16, '6461b95ba49a1-1684126043.webp'),
(17, '6461b9dda76fc-1684126173.jfif'),
(17, '6461b9ddacc2a-1684126173.jfif'),
(18, '6461b9b3afdd7-1684126131.jpg'),
(18, '6461b9b3b0161-1684126131.jpg'),
(19, '6461ba376a24c-1684126263.jpg'),
(19, '6461ba376a82e-1684126263.jpg'),
(20, '6461ba966fbd2-1684126358.jpg'),
(20, '6461ba967009d-1684126358.jfif'),
(20, '6461ba9670604-1684126358.jpg'),
(21, '6461ba9b60263-1684126363.webp'),
(21, '6461ba9b60900-1684126363.jpg'),
(22, '6461baefddfd1-1684126447.jfif'),
(22, '6461baefde677-1684126447.jfif'),
(23, '6461bb12be9c7-1684126482.jfif'),
(23, '6461bb12bed62-1684126482.jpg'),
(23, '6461bb12bf068-1684126482.webp'),
(24, '6461bb7c21667-1684126588.png'),
(24, '6461bb7c21b9e-1684126588.jpg'),
(25, '6461bbcb743d2-1684126667.jpg'),
(25, '6461bbcb746d0-1684126667.jfif'),
(25, '6461bbcb749a9-1684126667.jpg'),
(26, '6461bbd39e196-1684126675.jpg'),
(26, '6461bbd39e684-1684126675.jpg'),
(27, '6461bc0a9b036-1684126730.webp'),
(27, '6461bc0a9b768-1684126730.webp'),
(28, '6461bc5352839-1684126803.jfif'),
(28, '6461bc5352d4e-1684126803.jfif'),
(28, '6461bc53531f9-1684126803.jfif'),
(29, '6461bc5f17e4d-1684126815.jfif'),
(29, '6461bc5f18601-1684126815.jfif'),
(29, '6461bc5f188b9-1684126815.jfif'),
(30, '6461bc88c44e2-1684126856.webp'),
(30, '6461bc88c49f5-1684126856.webp'),
(31, '6461bcd133611-1684126929.jfif'),
(31, '6461bcd1339d7-1684126929.jpg'),
(32, '6461bcdf0e48c-1684126943.jpg'),
(32, '6461bcdf0e71a-1684126943.jpg'),
(33, '6461bcedba215-1684126957.jfif'),
(33, '6461bcedba651-1684126957.jpg'),
(33, '6461bcedba8bc-1684126957.jpg'),
(34, '6461bd13040ba-1684126995.webp'),
(34, '6461bd130449a-1684126995.jpg'),
(35, '6461bd5638345-1684127062.webp'),
(35, '6461bd5638b4a-1684127062.webp'),
(36, '6461bd9bd0eda-1684127131.png'),
(36, '6461bd9bd146f-1684127131.png'),
(37, '6461bda42d40e-1684127140.jfif'),
(37, '6461bda42d885-1684127140.jfif'),
(38, '6461bde8a3a0b-1684127208.jfif'),
(38, '6461bde8a3ea9-1684127208.jpg'),
(39, '6461be386d85e-1684127288.webp'),
(39, '6461be386dd63-1684127288.jfif'),
(40, '6461be3b8865a-1684127291.png'),
(40, '6461be3b88b0b-1684127291.jpg'),
(41, '6461be430950f-1684127299.jpg'),
(41, '6461be4309acb-1684127299.jpg'),
(41, '6461be4309fd2-1684127299.jfif'),
(42, '6461be8865c01-1684127368.webp'),
(42, '6461be886627b-1684127368.webp'),
(43, '6461bebae6594-1684127418.jpg'),
(43, '6461bebae68bd-1684127418.jpg'),
(44, '6461bee38a593-1684127459.jfif'),
(44, '6461bee38aa8d-1684127459.webp'),
(45, '6461bee6d98bc-1684127462.jpg'),
(45, '6461bee6d9c40-1684127462.jfif'),
(45, '6461bee6d9f37-1684127462.png'),
(46, '6461bf08bc54d-1684127496.jpeg'),
(46, '6461bf08bc85d-1684127496.png'),
(47, '6461bf7d61536-1684127613.jpg'),
(47, '6461bf7d61b84-1684127613.jpg'),
(48, '6461bfd538bdc-1684127701.jpg'),
(48, '6461bfd539070-1684127701.jpg'),
(48, '6461bfd53931c-1684127701.jpg'),
(49, '6461c00841255-1684127752.png'),
(49, '6461c00841929-1684127752.jpg'),
(50, '6461c055544c2-1684127829.jpg'),
(50, '6461c055548b8-1684127829.jpg'),
(51, '6461c08e83173-1684127886.jpg'),
(51, '6461c08e83821-1684127886.jpg'),
(52, '6461c0b32d02b-1684127923.webp'),
(52, '6461c0b32d4b7-1684127923.webp'),
(52, '6461c0b332d4f-1684127923.jfif'),
(53, '6461db4e21438-1684134734.jpg'),
(53, '6461dbfb4f8b6-1684134907.jpg'),
(54, '6461dd08aa866-1684135176.png'),
(55, '6461dff77dd2b-1684135927.png'),
(55, '6461dff77e3f6-1684135927.png'),
(55, '6461dff77e97a-1684135927.png'),
(55, '6461dff77eeba-1684135927.png'),
(56, '6461e142b1710-1684136258.png'),
(57, '6461e23a0c914-1684136506.png'),
(58, '6461e2149f8e4-1684136468.jpg'),
(58, '6461e214a0228-1684136468.jpg'),
(58, '6461e214a0640-1684136468.jpg'),
(58, '6461e214a098c-1684136468.jpg'),
(59, '6461e37c11c96-1684136828.jpg'),
(59, '6461e37c123c6-1684136828.jpg'),
(59, '6461e37c12751-1684136828.jpg'),
(59, '6461e37c129a4-1684136828.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mobileadmin`
--

CREATE TABLE `mobileadmin` (
  `adminId` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mobileadmin`
--

INSERT INTO `mobileadmin` (`adminId`, `phone`) VALUES
(1, '0355287940'),
(2, '0123456789'),
(4, '098765234');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mobilebuyer`
--

CREATE TABLE `mobilebuyer` (
  `buyerId` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mobilebuyer`
--

INSERT INTO `mobilebuyer` (`buyerId`, `phone`) VALUES
(1, '1234567654'),
(3, '0987654321'),
(4, '0355287940'),
(6, '0987654321');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mobileseller`
--

CREATE TABLE `mobileseller` (
  `sellerId` int(11) NOT NULL,
  `phoneNo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mobileseller`
--

INSERT INTO `mobileseller` (`sellerId`, `phoneNo`) VALUES
(1, '34567898765'),
(2, '0379286798'),
(3, '0966711032'),
(4, '013912318'),
(5, '19282897'),
(6, '0944427167');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notification`
--

INSERT INTO `notification` (`id`, `message`, `date`, `seen`) VALUES
(1, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: MS1, Quantity: 1, Price: 89, at 2023-05-13', '2023-05-13', 1),
(2, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: MS1, Quantity: 1, Price: 89, at 2023-05-13', '2023-05-13', 1),
(3, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: ACC1, Quantity: 1, Price: 89, at 2023-05-13', '2023-05-13', 1),
(7, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: MS1, Quantity: 3, Price: 264, at 2023-05-13', '2023-05-13', 1),
(8, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: MS1, Quantity: 1, Price: 88, at 2023-05-13', '2023-05-13', 1),
(11, 'Hello Nguyen Tu Trung, Le Anh Duc ordered your item: MS1, Quantity: 1, Price: 88, at 2023-05-13', '2023-05-13', 1),
(13, 'Hello Nguyen Thanh, Nguyen Tu Trung ordered your item: SamsungNote20Ultra5G, Quantity: 2, Price: 1960, at 2023-05-15', '2023-05-15', 1),
(15, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone 12 pro max, Quantity: 2, Price: 1097.4, at 2023-05-15', '2023-05-15', 1),
(17, 'Hello Nguyen Thanh, Nguyen Tu Trung ordered your item: IPhone 14 ProMax, Quantity: 2, Price: 2352, at 2023-05-15', '2023-05-15', 1),
(19, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone 11 pro max, Quantity: 1, Price: 426.87, at 2023-05-15', '2023-05-15', 1),
(21, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone 12 pro max, Quantity: 1, Price: 548.7, at 2023-05-15', '2023-05-15', 1),
(23, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone XS, Quantity: 2, Price: 210.8, at 2023-05-15', '2023-05-15', 1),
(24, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone 12 pro max, Quantity: 2, Price: 1097.4, at 2023-05-15', '2023-05-15', 1),
(27, 'Hello Nam Le, Nguyen Tu Trung ordered your item: Iphone 13 pro max, Quantity: 2, Price: 1292, at 2023-05-15', '2023-05-15', 1),
(29, 'Hello Nguyen Thanh, Thanh Thanh ordered your item: IPhone 14 ProMax, Quantity: 2, Price: 2352, at 2023-05-16', '2023-05-16', 1),
(30, 'Hello Nguyen Thanh, test buyer ordered your item: IPhone 14 ProMax, Quantity: 2, Price: 853.74, at 2023-05-16', '2023-05-17', 1),
(31, 'Hello Nam Le, test buyer ordered your item: Iphone 11 pro max, Quantity: 3, Price: 1280.61, at 2023-05-16', '2023-05-17', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL DEFAULT 0,
  `orderPrice` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderDate` date NOT NULL DEFAULT curdate(),
  `buyerId` int(11) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `isShip` tinyint(1) NOT NULL DEFAULT 0,
  `billId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderId`, `cartId`, `orderPrice`, `quantity`, `orderDate`, `buyerId`, `itemId`, `status`, `isShip`, `billId`) VALUES
(1, 1, 89, 1, '2023-05-13', 1, NULL, 1, 0, 1),
(2, 1, 89, 1, '2023-05-13', 1, NULL, 1, 1, 2),
(3, 1, 89, 1, '2023-05-13', 1, NULL, 1, 0, 0),
(4, 1, 264, 3, '2023-05-13', 1, NULL, 2, 0, 3),
(5, 1, 88, 1, '2023-05-13', 1, NULL, 1, 1, 4),
(6, 1, 88, 1, '2023-05-13', 1, NULL, 1, 1, 5),
(7, 4, 1960, 2, '2023-05-15', 4, 18, 1, 0, 6),
(8, 4, 1097.4, 2, '2023-05-15', 4, 54, 1, 0, 7),
(9, 4, 2352, 2, '2023-05-15', 4, 8, 1, 1, 8),
(10, 4, 426.87, 1, '2023-05-15', 4, 55, 1, 1, 9),
(11, 4, 548.7, 1, '2023-05-15', 4, 54, 1, 0, 10),
(12, 4, 210.8, 2, '2023-05-15', 4, 57, 1, 0, 11),
(13, 4, 1097.4, 2, '2023-05-15', 4, 54, 1, 0, 12),
(14, 4, 1292, 2, '2023-05-15', 4, 53, 1, 1, 13),
(16, 6, 853.74, 2, '2023-05-17', 6, 8, 1, 1, 15),
(17, 6, 1280.61, 3, '2023-05-17', 6, 55, 0, 1, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seller`
--

CREATE TABLE `seller` (
  `ID` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `joinDate` date NOT NULL DEFAULT curdate(),
  `email` varchar(70) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `disLikes` int(11) NOT NULL DEFAULT 0,
  `transactions` int(11) NOT NULL DEFAULT 0,
  `Amount` int(11) NOT NULL DEFAULT 100000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `seller`
--

INSERT INTO `seller` (`ID`, `userName`, `password`, `joinDate`, `email`, `fName`, `lName`, `likes`, `disLikes`, `transactions`, `Amount`) VALUES
(1, 'trunguet', '28b743abc9e2c0c37c410ca23460f3cde0fc52cd', '2023-05-13', 'aa1@gmail.com', 'Nguyen Tu', 'Trung', 1, 0, 5, 100443),
(2, 'Dennis', '281132f1280229502f90cc2ea7de29b8bb085d22', '2023-05-15', 'haingoc3423@gmail.com', 'Nguyen', 'Hai', 0, 0, 0, 100000),
(3, 'testseller', 'bfec3a0674b361b6371ca1befcd31da21aa6f020', '2023-05-15', 't@gmail.com', 'Nguyen', 'Thanh', 1, 1, 3, 105166),
(4, 'hung28022003', 'f707da7c2e03cd574861c9644ad7eaf94cf0ff63', '2023-05-15', 'hung28@gmail.com', 'Hung', 'Nguyen', 0, 0, 0, 100000),
(5, 'anhanh123', '9cd8394981d1c36940c5846679b0b8d3c3262bdb', '2023-05-15', 'diemtung1@gmail.com', 'Tun', 'La', 0, 0, 0, 100000),
(6, 'nguoiban1', 'ebccb98fe2e5b799ef0db3621a51d96992023248', '2023-05-15', 'lenamvcl34@gmail.com', 'Nam', 'Le', 3, 0, 6, 104673);

--
-- Bẫy `seller`
--
DELIMITER $$
CREATE TRIGGER `deleteNotificationafterSellerDeletion` BEFORE DELETE ON `seller` FOR EACH ROW DELETE FROM notification WHERE notification.id in (SELECT notificationId  from  sellernotifications,seller WHERE seller.ID = sellernotifications.ownerID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sellernotifications`
--

CREATE TABLE `sellernotifications` (
  `notificationId` int(11) NOT NULL,
  `buyerId` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sellernotifications`
--

INSERT INTO `sellernotifications` (`notificationId`, `buyerId`, `ownerID`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(7, 1, 1),
(8, 1, 1),
(11, 1, 1),
(13, 4, 3),
(15, 4, 6),
(17, 4, 3),
(19, 4, 6),
(21, 4, 6),
(23, 4, 6),
(24, 4, 6),
(27, 4, 6),
(30, 6, 3),
(31, 6, 6);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userName` (`userName`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userName` (`userName`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cartId` (`cartId`);

--
-- Chỉ mục cho bảng `buyernotification`
--
ALTER TABLE `buyernotification`
  ADD PRIMARY KEY (`notificationId`,`sellerId`,`ownerID`),
  ADD KEY `selllll` (`sellerId`),
  ADD KEY `buyeeee` (`ownerID`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartId`,`itemId`),
  ADD KEY `itemIdcartitem` (`itemId`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Chỉ mục cho bảng `childcategory`
--
ALTER TABLE `childcategory`
  ADD PRIMARY KEY (`childcategoryId`);

--
-- Chỉ mục cho bảng `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemId`),
  ADD UNIQUE KEY `homeNumber` (`homeNumber`,`street`,`city`,`country`,`itemId`) USING BTREE,
  ADD UNIQUE KEY `startDate` (`startDate`,`endDate`,`discount`,`itemId`) USING BTREE,
  ADD KEY `sellerIdItem` (`sellerId`);

--
-- Chỉ mục cho bảng `itemimage`
--
ALTER TABLE `itemimage`
  ADD PRIMARY KEY (`itemId`,`image`);

--
-- Chỉ mục cho bảng `mobileadmin`
--
ALTER TABLE `mobileadmin`
  ADD PRIMARY KEY (`adminId`,`phone`);

--
-- Chỉ mục cho bảng `mobilebuyer`
--
ALTER TABLE `mobilebuyer`
  ADD PRIMARY KEY (`buyerId`,`phone`);

--
-- Chỉ mục cho bảng `mobileseller`
--
ALTER TABLE `mobileseller`
  ADD PRIMARY KEY (`sellerId`,`phoneNo`);

--
-- Chỉ mục cho bảng `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `buyerIdorder` (`buyerId`),
  ADD KEY `itemIdForOrder` (`itemId`);

--
-- Chỉ mục cho bảng `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userName` (`userName`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `sellernotifications`
--
ALTER TABLE `sellernotifications`
  ADD PRIMARY KEY (`notificationId`,`buyerId`,`ownerID`),
  ADD KEY `bu` (`buyerId`),
  ADD KEY `sel` (`ownerID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `buyer`
--
ALTER TABLE `buyer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `childcategory`
--
ALTER TABLE `childcategory`
  MODIFY `childcategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `seller`
--
ALTER TABLE `seller`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `cardId` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `buyernotification`
--
ALTER TABLE `buyernotification`
  ADD CONSTRAINT `buyeeee` FOREIGN KEY (`ownerID`) REFERENCES `buyer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notiii` FOREIGN KEY (`notificationId`) REFERENCES `notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selllll` FOREIGN KEY (`sellerId`) REFERENCES `seller` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartIDforcartitem` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemIdcartitem` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `sellerIdItem` FOREIGN KEY (`sellerId`) REFERENCES `seller` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `itemimage`
--
ALTER TABLE `itemimage`
  ADD CONSTRAINT `itemIdForImage` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mobileadmin`
--
ALTER TABLE `mobileadmin`
  ADD CONSTRAINT `mobileAdminId` FOREIGN KEY (`adminId`) REFERENCES `admin` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mobilebuyer`
--
ALTER TABLE `mobilebuyer`
  ADD CONSTRAINT `buyerId` FOREIGN KEY (`buyerId`) REFERENCES `buyer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mobileseller`
--
ALTER TABLE `mobileseller`
  ADD CONSTRAINT `sellerId` FOREIGN KEY (`sellerId`) REFERENCES `seller` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `buyerIdorder` FOREIGN KEY (`buyerId`) REFERENCES `buyer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemIdForOrder` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `sellernotifications`
--
ALTER TABLE `sellernotifications`
  ADD CONSTRAINT `bu` FOREIGN KEY (`buyerId`) REFERENCES `buyer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noti` FOREIGN KEY (`notificationId`) REFERENCES `notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sel` FOREIGN KEY (`ownerID`) REFERENCES `seller` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
