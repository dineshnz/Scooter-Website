/*
MySQL Data Transfer
Source Host: localhost
Source Database: scootera
Target Host: localhost
Target Database: scootera
Date: 2019/8/6 ���ڶ� 17:10:54
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for asset
-- ----------------------------
CREATE TABLE `asset` (
  `assetID` int(50) NOT NULL AUTO_INCREMENT,
  `ownerID` int(50) DEFAULT NULL,
  `assetName` varchar(100) DEFAULT NULL,
  `plateNumber` int(100) DEFAULT NULL,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `colour` varchar(30) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `price` double(50,0) DEFAULT NULL,
  `attachments` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  PRIMARY KEY (`assetID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
CREATE TABLE `cart` (
  `cid` int(50) NOT NULL AUTO_INCREMENT,
  `assetID` int(50) DEFAULT NULL,
  `assetName` varchar(50) DEFAULT NULL,
  `make` varchar(50) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  `price` double(50,0) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `driverLicense` varchar(100) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `userLevel` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passport` (`passport`),
  KEY `id` (`id`),
  KEY `fullname` (`fullname`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `asset` VALUES ('1', '1', 'scooter1', '20', '大众', 'a', '1', '1', 'timg.jpg', '100', 'b', '山西', '2016-10-10');
INSERT INTO `asset` VALUES ('2', '2', 'scooter2', '50', '现代', 'a', '2', '2', 'test.png', '200', 'b', '上海', '2018-08-08');
INSERT INTO `asset` VALUES ('19', null, 'asset1', '50', '本田', '23', '2', '2', 'timg.jpg', '500', 'aaa', '天津', '2019-08-22');
INSERT INTO `asset` VALUES ('20', null, 'asset5', '50', '丰田', 'to', '2', '1', 'test.png', '200', 'a', '山西', '2019-08-22');
INSERT INTO `users` VALUES ('38', 'Shubhadra Bhandari', 'shubhadra005@gmail.com', 'fff', '2701 sw 17th st apt 23, 2703 sw ryder st. apt 33', 'ARKANSAS', '0', '0', 'a555d373680d6a17708e7c3f214a1fedb8c74ab9fc0ee629d4274045b13e9fa1d804a4de4c084fa8ff602688f27433c335a8', '$2y$10$UFf6SldDBz6f4xPMjMe2e.Sxr3urxw6ovtKKIf3lcWiTR56Jf9SG2');
INSERT INTO `users` VALUES ('40', 'Dinesh Karki', 'dineshkrk46@gmail.com', '6676', '117 Melrose road, mount roskill', 'fff', '1', '2', 'ff099270c63c3a31dfefecaae7e16065e0bb99aa05ba5a9d488697db697759c2f95f63f396da297b39ad164c260f459c2aa1', '$2y$10$tRc8eSy32j0ExA5CcKkFD.NgaYdVrm8hBgq0li6J4.DYnEwC3WoKu');
INSERT INTO `users` VALUES ('42', 'dinesh', 'karkidinesh43@yahoo.com', '4444nz', '117 Melrose road, mount roskill', 'ffff', '1', '1', 'b23d5bee1300d21cf4053673dc1fd7e2a61c089c3847a70611e805c286d2b2c2b8ae2565adf3f8e298836489fe6a165e1071', '$2y$10$rMGK8G3zdzecVIi3a7Fdou4EQPPYh9vW3y2lS55utRlJ0leamR3nq');
INSERT INTO `users` VALUES ('43', 'aaa', 'aaa@qq.com', 'aaa1', 'wddawdwa', 'fff', '1', '1', '11111', 'aaa');
