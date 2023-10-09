-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 10:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email_id`, `contact_no`, `status`) VALUES
(0, 'admin', 'admin', 0, '', '', 1),
(4, 'Pujan', 'pujan', 1, 'pujanparekh79@gmail.com', '1234567890', 1),
(9, 'kunal', 'kunal', 1, 'kunal@gmail.com', '1111111111', 1),
(10, 'Shreya', 'shreyav', 1, 'shreyav09@gmail.com', '1234565432', 1),
(12, 'Isha', 'isha', 1, 'isha@gmail.com', '1233211231', 1),
(15, 'Priyanka', '12345', 1, 'priyanka@gmail.com', '1234567890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `image`, `status`) VALUES
(5, 'Wooden', 'wooden.jpg', 1),
(6, 'Pottery', 'pottery.jpg', 1),
(7, 'Crochet', 'crochet.jpg', 1),
(10, 'Utensils', 'utensils.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(7, 'Pujan Parekh', 'pujanparekh79@gmail.com', '9522234236', 'Hi ! I have a query ...', '2023-09-04 10:56:59'),
(8, 'Pujan Parekh', 'pujanparekh79@gmail.com', '9522234236', 'qwertyuikjhgfds', '2023-09-04 02:01:50'),
(9, 'Demo', 'demo@gmail.com', '1234554321', 'Demo Text', '2023-09-18 11:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(119, 9, 3, 'Hi Kunal, I am Pujan'),
(170, 9, 3, 'sup ?'),
(171, 3, 9, 'Hey Pujan'),
(172, 9, 3, 'How are you ?'),
(173, 3, 9, 'I am good !'),
(174, 9, 3, 'assas'),
(175, 9, 5, 'Hi mali, I am Kaushal'),
(176, 9, 3, 'Can i get a customized product ??'),
(177, 9, 3, 'rjr3'),
(181, 9, 3, 'I am God.'),
(182, 9, 3, 'HI'),
(183, 5, 9, 'Hello'),
(184, 5, 9, 'Hey'),
(185, 5, 9, 'jfirjfr'),
(186, 5, 9, 'fkjgr'),
(187, 5, 9, 'OKay'),
(188, 5, 9, 'fnjkfe'),
(189, 5, 9, 'femf'),
(190, 5, 9, 'frwfr'),
(191, 9, 5, 'grsgr'),
(192, 5, 9, 'frkfre'),
(193, 5, 9, 'ergre'),
(194, 5, 9, 'terte'),
(195, 3, 9, 'hey'),
(196, 5, 9, 'Hello'),
(197, 3, 9, 'Pujan Bhai .. kya haal hai ??'),
(198, 3, 9, 'Hi Pujan'),
(199, 12, 3, 'tirrsklfr'),
(200, 3, 12, 'hii 🌻'),
(201, 12, 3, 'jigjgret');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `mihpayid` varchar(20) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `added_on`) VALUES
(2, 4, 'indore', 'mp', 452003, 'COD', 345, 'Success', 5, '09486ca6da6eb38a508d', '', '', '2023-09-17 02:26:09'),
(3, 4, 'Pune', 'pune/M.H.', 123456, 'payu', 249, 'pending', 4, '11a52093a333474f6feb', '', '', '2023-09-17 04:32:38'),
(4, 4, 'fewfsf', 'fsfs', 222345, 'COD', 948, 'pending', 4, '5a2be88e99ffc55f1202', '', '', '2023-09-17 07:11:18'),
(5, 4, 'jcsad', 'mde', 222222, 'COD', 345, 'pending', 1, 'a26817356f81f7f34afc', '', '', '2023-09-23 09:04:16'),
(6, 4, 'dewew', 'dde3', 123454, 'COD', 799, 'pending', 1, '4d9c9f0e110f4f924cfd', '', '', '2023-09-23 09:44:12'),
(7, 4, 'vugyu', 'dgfff', 123432, 'COD', 23994, 'pending', 1, 'b2210357df1d3d2871e1', '', '', '2023-09-24 07:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(4, 3, 23, 1, 249),
(5, 4, 22, 1, 249),
(6, 4, 17, 1, 699),
(8, 6, 26, 1, 799),
(9, 7, 11, 6, 3999);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `status`, `added_by`) VALUES
(10, 6, 'Demo Pot 1', 1000, 899, 5, '811511954_p2.jpg', 'Short Desc of demo pot 1', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quos alias neque saepe corporis excepturi dolores maxime ducimus voluptatibus reiciendis optio doloremque incidunt amet assumenda quis accusantium, ipsam aperiam culpa aspernatur a inventore natus quo. Similique quam mollitia error quod necessitatibus ducimus officia quibusdam, modi corporis quia eveniet enim odio.', 0, 1, 0),
(11, 6, 'Demo Pot 2', 5000, 3999, 2, '710748932_p4.jpg', 'Short Desc. of demo pot 2', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quos alias neque saepe corporis excepturi dolores maxime ducimus voluptatibus reiciendis optio doloremque incidunt amet assumenda quis accusantium, ipsam aperiam culpa aspernatur a inventore natus quo. Similique quam mollitia error quod necessitatibus ducimus officia quibusdam, modi corporis quia eveniet enim odio.', 0, 1, 0),
(12, 7, 'Crochet Product 1', 499, 399, 5, '223321387_cro1.jpg', 'Crochet Product 1 Short demo Description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 1, 1, 0),
(13, 5, 'Wooden Demo 1', 4999, 2999, 9, '615728551_wood5.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 1, 1, 0),
(14, 5, 'Wooden Demo 2', 1200, 999, 2, '315053949_wood1.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(15, 7, 'Crochet Product 2', 1000, 899, 5, '546764700_cro4.jpg', 'short Demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(16, 7, 'Crochet Product 3', 799, 599, 4, '471017141_cro5.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(17, 5, 'Wooden Demo 3', 799, 699, 3, '687398619_wood6.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 1, 1, 0),
(18, 5, 'Wooden Demo 4', 1000, 699, 8, '764726153_wood2.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(19, 7, 'Crochet Product 4', 699, 499, 9, '450742902_cro2.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(20, 7, 'Crochet Product 5', 300, 199, 3, '306784525_cro6.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(21, 5, 'Wooden Demo 5', 299, 249, 8, '211248349_wood3.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(22, 5, 'Wooden Demo 6', 299, 249, 8, '165851565_wood4.jpg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(23, 7, 'Crochet Product 6', 499, 249, 9, '667890296_cro3.jpeg', 'Short demo description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut dolore sequi eaque veniam magnam officiis ducimus delectus fugit harum placeat perferendis possimus, voluptates, aperiam nostrum! Consequuntur sint, perspiciatis qui ad iusto quod ab reiciendis provident architecto. Ducimus nostrum corrupti fugit. Aut accusantium corporis quasi dolore voluptas dicta? Doloribus, nihil. Dolore.', 0, 1, 0),
(25, 6, 'abc', 600, 560, 60, '860138412_Screenshot (71).png', 'hyh', 'szs', 0, 0, 15),
(26, 7, 'Crochettt', 900, 799, 3, '921956986_Screenshot 2023-06-08 202548.png', 'cdscd', 'ewde', 0, 1, 12),
(27, 5, 'Demo Product', 199, 149, 5, '872050674_me.jpg', 'ngjrgr', 'egejgte', 0, 0, 9),
(28, 7, 'Crochettt', 899, 799, 4, '159774364_Default.jpg', 'njj', 'guuffv', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(20, 22, 4, 'Fantastic', 'Excellent Product !', 1, '2023-09-18 10:37:07'),
(21, 22, 3, 'Very Good', 'Absolutely loved it', 1, '2023-09-18 10:38:30'),
(24, 17, 4, 'Very Good', 'Excellent Product !\r\nI really loved it', 1, '2023-09-25 01:41:40'),
(25, 22, 4, 'Fantastic', 'abcd', 1, '2023-09-27 07:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(3, 'Pujan Parekh', 'pujan111', 'pujan@gmail.com', '9522234236', '2023-09-03 06:26:31'),
(4, 'Shreya', 'shreya111', 'shreya@gmail.com', '3209832', '2023-09-04 01:29:57'),
(5, 'Kaushal Patel', 'kaushal111', 'kaushal@gmail.com', '1234554321', '2023-10-07 11:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `vid` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `video` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`vid`, `title`, `video`, `description`, `categories_id`) VALUES
(1, 'ncjsdc', '163080247_dailymeowws-20221027-0001.mp4', 'meow', 7),
(2, 'Wooden Lecture 1', '695124483_superrkiitty-20230212-0001.mp4', 'HElloo', 5),
(3, 'Wooden Lecture 2', '578642259_demo_1.mp4', 'dsndjsada', 5),
(4, 'Wooden Lecture 3', '632352442_7 SMART IDEAS USING WOOD THAT YOU CAN MAKE AT HOME.mp4', 'Demo Description for Wooden Lecture 3', 5);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(20, 3, 12, '2023-09-04 02:23:20'),
(21, 3, 19, '2023-09-04 02:23:22'),
(31, 4, 11, '2023-09-23 09:45:20'),
(32, 4, 10, '2023-09-23 09:45:23'),
(33, 4, 13, '2023-09-23 10:51:25'),
(34, 4, 20, '2023-09-23 11:36:11'),
(35, 4, 23, '2023-09-25 08:57:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_ibfk_1` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_1` (`added_by`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_ibfk_1` (`product_id`),
  ADD KEY `product_review_ibfk_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `videos_ibfk_1` (`categories_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
