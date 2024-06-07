-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 11:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `filedetails`
--

CREATE TABLE `filedetails` (
  `FileID` int(11) NOT NULL,
  `minShares` int(11) DEFAULT NULL,
  `totalShares` int(11) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `keySize` int(11) DEFAULT NULL,
  `encryptionType` varchar(255) DEFAULT NULL,
  `blockMode` varchar(255) DEFAULT NULL,
  `macMode` varchar(255) DEFAULT NULL,
  `nonceSize` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filedetails`
--

INSERT INTO `filedetails` (`FileID`, `minShares`, `totalShares`, `userType`, `keySize`, `encryptionType`, `blockMode`, `macMode`, `nonceSize`) VALUES
(137, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(138, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(139, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(140, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(142, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(143, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', ''),
(144, 2, 3, 'non-tech', 256, 'AES', 'GCM', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `filefragments`
--

CREATE TABLE `filefragments` (
  `FragmentID` int(11) NOT NULL,
  `FileID` int(11) DEFAULT NULL,
  `FragmentOrder` int(11) DEFAULT NULL,
  `FragmentSize` int(11) DEFAULT NULL,
  `StorageLocation` varchar(255) DEFAULT NULL,
  `HashValue` varchar(255) DEFAULT NULL,
  `encryptionKey` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filefragments`
--

INSERT INTO `filefragments` (`FragmentID`, `FileID`, `FragmentOrder`, `FragmentSize`, `StorageLocation`, `HashValue`, `encryptionKey`) VALUES
(394, 137, 1, NULL, NULL, NULL, 0x1992ffb5e481422edbc02caa7a0d20c00f43bbc4fded886be8f1655cc58d09d7),
(395, 137, 2, NULL, NULL, NULL, 0xcfb685ad1ab310780d129174fbe532382077c760280c428f2f364a7dd8693fb7),
(396, 137, 3, NULL, NULL, NULL, 0xd9a3035f879aef331a8fc9db9ae5a51d0b686a2c9425072459130a198889f6c6),
(397, 138, 1, NULL, NULL, NULL, 0xeee8e87c325cbc38ac79357489cdf5056992a1991aa692d761563a4b4a9e8411),
(398, 138, 2, NULL, NULL, NULL, 0xe27b4c19081cd28c0b10e2ba39681f7f99d1536b58b108ac545b8426dda06536),
(399, 138, 3, NULL, NULL, NULL, 0x5cac2d29d70e61d13fbb76942cccf562b45d8d55987a1b2e280eb788b421c028),
(400, 139, 1, NULL, NULL, NULL, 0x290243a5f2dfd74ca2fa4d4a0cf0d175f6256d245321de87615b7087a56742a9),
(401, 139, 2, NULL, NULL, NULL, 0x0584603ed78ceeb0e0719324a5eec659a06a781455ab92c359cec712b77540ac),
(402, 139, 3, NULL, NULL, NULL, 0xd7f51d9cd5840a3ad9ec8cf114c692605a16042f222e135b67f841972aa53261),
(403, 140, 1, NULL, NULL, NULL, 0x1cf104731f0815e61adb31e1ef78ea7403b73c9091c347fd9af907dbd6cbb04c),
(404, 140, 2, NULL, NULL, NULL, 0x03ca70ce6db7299f2452a678393920cfcd1d7057942237266249e609f8a0f2ad),
(405, 140, 3, NULL, NULL, NULL, 0x129a25bfff33c4af3ac1cf37a61deb21fe1eb5273ade244c9b17240929757351),
(409, 142, 1, NULL, NULL, NULL, 0x61c8906afbe7eaa0058b353b284f53b4a689b4430a6538dec2f4330ef8f8098a),
(410, 142, 2, NULL, NULL, NULL, 0xd6eabdefddf04836133e9c47174549a728dee10194a1a6d37a014f3eb3dac6e9),
(411, 142, 3, NULL, NULL, NULL, 0x22dd92802f382744ae8d0bb02d5bc3de9f1b2ac14d1716169fe9deac9a435a05),
(412, 143, 1, NULL, NULL, NULL, NULL),
(413, 143, 2, NULL, NULL, NULL, NULL),
(414, 143, 3, NULL, NULL, NULL, NULL),
(415, 144, 1, NULL, NULL, NULL, 0x889b9dc9b8bb3e352ca285094fc18143b5d91a9997843497f35c3e81914153ff),
(416, 144, 2, NULL, NULL, NULL, 0xec959f33727d9888368fc9de7afa618561e665b97a2d961e8daff8ec2c489670),
(417, 144, 3, NULL, NULL, NULL, 0x34b5fb1d3f400ee68452e3122a1ed28bc9f409f8c3f05decf37b062940dc22a1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `FileID` int(11) NOT NULL,
  `OwnerUserID` int(11) DEFAULT NULL,
  `FolderID` int(11) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `TotalSize` int(11) DEFAULT NULL,
  `UploadDate` date DEFAULT NULL,
  `LastAccessed` date DEFAULT NULL,
  `IsFragmented` tinyint(1) DEFAULT NULL,
  `PrivacySetting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`FileID`, `OwnerUserID`, `FolderID`, `FileName`, `TotalSize`, `UploadDate`, `LastAccessed`, `IsFragmented`, `PrivacySetting`) VALUES
(137, 1, NULL, 'readme.txt', NULL, NULL, NULL, NULL, NULL),
(138, 2, NULL, 'readme.txt', NULL, NULL, NULL, NULL, NULL),
(139, 2, NULL, 'user2File.txt', NULL, NULL, NULL, NULL, NULL),
(140, 2, NULL, 'user2File.txt', NULL, NULL, NULL, NULL, NULL),
(142, 2, NULL, 'user2File.txt', NULL, NULL, NULL, NULL, NULL),
(143, 2, NULL, 'user2File.txt', NULL, NULL, NULL, NULL, NULL),
(144, 2, NULL, 'user2File.txt', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `FolderID` int(11) NOT NULL,
  `ParentFolderID` int(11) DEFAULT NULL,
  `OwnerUserID` int(11) DEFAULT NULL,
  `FolderName` varchar(255) DEFAULT NULL,
  `CreationDate` date DEFAULT NULL,
  `LastModified` date DEFAULT NULL,
  `PrivacySetting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sharedfiles`
--

CREATE TABLE `sharedfiles` (
  `TokenID` int(11) NOT NULL,
  `FileID` int(11) DEFAULT NULL,
  `OwnerUserID` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `TokenCreated` datetime DEFAULT current_timestamp(),
  `TokenExpiry` datetime DEFAULT NULL,
  `Receipient` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sharedfiles`
--

INSERT INTO `sharedfiles` (`TokenID`, `FileID`, `OwnerUserID`, `Token`, `TokenCreated`, `TokenExpiry`, `Receipient`) VALUES
(65, 138, 2, 'QV6WZTjBPPlCWnFR', '2024-02-08 01:52:48', '2024-03-09 01:52:48', 'happycnyguys@gmail.com'),
(71, 138, 2, 'nFm6tSWK8dqAHDhR', '2024-02-08 01:57:19', '2024-03-09 01:57:19', 'huatah@gmail.com'),
(72, 144, 2, 'h4bhAQP8wjQRm2gj', '2024-02-15 14:35:32', '2024-03-16 14:35:32', 'arrower@hotmail.sg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `PasswordSalt` varchar(255) NOT NULL,
  `DateJoined` date NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT 'endUser',
  `otpKey` varchar(255) DEFAULT NULL,
  `resetOTP` varchar(255) DEFAULT NULL,
  `resetOTPExpiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `PasswordHash`, `PasswordSalt`, `DateJoined`, `LastLogin`, `role`, `otpKey`, `resetOTP`, `resetOTPExpiry`) VALUES
(1, 'test3', 'test5@gmail.com', '$2b$12$FFO39EMF5gsvLfPe9q4UiuhGxhK52vUTXNUf.k./bFYHw6tEWJ2Q2', '$2b$12$FFO39EMF5gsvLfPe9q4Uiu', '2023-12-23', '2024-02-06 17:54:47', 'endUser', NULL, NULL, '2024-02-15 09:21:38'),
(2, 'test2', 'test2@gmail.com', '$2b$12$hge5XMXdCeHS1rFF360a9.EB5z46moKROD8kGPmaaRocpL2zFhxU2', '$2b$12$hge5XMXdCeHS1rFF360a9.', '2024-01-30', '2024-02-15 14:34:20', 'endUser', 'Y54OL7Z5L6LG55XFSEEA7YY7N3WWJKPR', NULL, '2024-02-15 09:21:38'),
(3, 'test1', 'test1@gmail.com', '$2b$12$iPmAftte4FVlgII6p1sRP.Z0psrLFwvhrWMXzO5H0N3SNZE7JBylm', '$2b$12$iPmAftte4FVlgII6p1sRP.', '2024-02-07', '2024-02-12 18:50:27', 'admin', NULL, NULL, '2024-02-15 09:21:38'),
(13, 'test4', 'test4@gmail.com', '$2b$12$PO.UGK4LuErSeGawSp7fTusf67d.Jl0FFS8ZghNVLsLEVGBPJDlou', '$2b$12$PO.UGK4LuErSeGawSp7fTu', '2024-02-12', '2024-02-13 22:24:23', 'endUser', 'A2JQGY43JZUHPZVBDEOQZA2PA4IYQYSP', NULL, '2024-02-15 09:21:38'),
(16, 'test7', 'test7@gmail.com', '$2b$12$sV9/THFS0M22P0DsBpRKduBFejDgN/0EGz22qzDfdKy./8zj1qKZG', '$2b$12$sV9/THFS0M22P0DsBpRKdu', '2024-02-13', NULL, 'endUser', 'SNAC2477V7IZHCLIXQB7ANYMK6XMYMPF', NULL, '2024-02-15 09:21:38'),
(17, 'test8', 'test8@gmail.com', '$2b$12$7obWMgVPw9Yo9NbjBmTn4.7uoh1wLiV2wG9uzgE4HLJhT53eX8QrW', '$2b$12$7obWMgVPw9Yo9NbjBmTn4.', '2024-02-13', '2024-02-15 14:34:02', 'endUser', 'OU72HLZQHAZTFOOLSTIZTX62FQ5N3BBA', NULL, '2024-02-15 09:21:38'),
(18, 'test9', 'test9@gmail.com', '$2b$12$.aJpDH7RAT613/OhLmf99eXQZZAXjCTRtfE8TZQDfeChrmg2oy12S', '$2b$12$.aJpDH7RAT613/OhLmf99e', '2024-02-14', '2024-02-14 17:12:52', 'endUser', 'E3MJ2QSFF2L5GYOHNZJINL7GE3GN525J', NULL, '2024-02-15 09:21:38'),
(19, 'test100', 'arrower@hotmail.sg', '$2b$12$mxfW37D.8wjHwtzalPLyLO46mEHE6C9jtQiajtXa9Z38lhu4wraUC', '$2b$12$mxfW37D.8wjHwtzalPLyLO', '2024-02-15', '2024-02-15 18:09:54', 'endUser', 'U7HOGSTPOOOZAAL6BQHI6E2FOBWZHESV', '1YQjqee6uWAkc8XU', '2024-02-15 10:09:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filedetails`
--
ALTER TABLE `filedetails`
  ADD PRIMARY KEY (`FileID`);

--
-- Indexes for table `filefragments`
--
ALTER TABLE `filefragments`
  ADD PRIMARY KEY (`FragmentID`),
  ADD KEY `FileID` (`FileID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`FileID`),
  ADD KEY `OwnerUserID` (`OwnerUserID`),
  ADD KEY `FolderID` (`FolderID`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`FolderID`),
  ADD KEY `OwnerUserID` (`OwnerUserID`),
  ADD KEY `ParentFolderID` (`ParentFolderID`);

--
-- Indexes for table `sharedfiles`
--
ALTER TABLE `sharedfiles`
  ADD PRIMARY KEY (`TokenID`),
  ADD KEY `FileID` (`FileID`),
  ADD KEY `OwnerUserID` (`OwnerUserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filefragments`
--
ALTER TABLE `filefragments`
  MODIFY `FragmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `sharedfiles`
--
ALTER TABLE `sharedfiles`
  MODIFY `TokenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filedetails`
--
ALTER TABLE `filedetails`
  ADD CONSTRAINT `fileDetails_ibfk_1` FOREIGN KEY (`FileID`) REFERENCES `files` (`FileID`);

--
-- Constraints for table `filefragments`
--
ALTER TABLE `filefragments`
  ADD CONSTRAINT `filefragments_ibfk_1` FOREIGN KEY (`FileID`) REFERENCES `files` (`FileID`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`OwnerUserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`FolderID`) REFERENCES `folders` (`FolderID`);

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`OwnerUserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `folders_ibfk_2` FOREIGN KEY (`ParentFolderID`) REFERENCES `folders` (`FolderID`);

--
-- Constraints for table `sharedfiles`
--
ALTER TABLE `sharedfiles`
  ADD CONSTRAINT `sharedfiles_ibfk_1` FOREIGN KEY (`FileID`) REFERENCES `files` (`FileID`),
  ADD CONSTRAINT `sharedfiles_ibfk_2` FOREIGN KEY (`OwnerUserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
