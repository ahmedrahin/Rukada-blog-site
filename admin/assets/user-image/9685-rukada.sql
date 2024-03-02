-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rukada`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_parent` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `is_parent`, `status`) VALUES
(10, 'Education', 'Education is the transmission of knowledge, skills, and character traits.', 0, 1),
(11, 'Sports', '', 0, 1),
(12, 'Cricket', '<p>quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis&nbsp;quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis</p>\r\n', 11, 1),
(13, 'Technical', '<p>quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitisquos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitisquos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis</p>\r\n', 0, 1),
(14, 'Web Development', '', 13, 1),
(15, 'Football', '', 11, 1),
(17, 'Politics', '<p>quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis</p>\r\n', 0, 1),
(18, 'Commerce', '', 10, 1),
(19, 'Science', '', 10, 0),
(20, 'Traveling ', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis earum voluptates, iure quam similique optio quas placeat officia excepturi tenetur sapiente illum rem!</p>\r\n', 0, 1),
(21, 'Graphics ', '', 13, 1),
(22, 'App Development', '', 13, 1),
(23, 'University ', '', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comments`, `post_id`, `user_id`, `date`, `date_time`) VALUES
(2, 'hello', 11, 13, '2023-08-01', '05-Aug-2023 10:10am'),
(26, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 12, 11, '2023-08-01', '01-Aug-2023 10:10am'),
(29, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placera', 9, 9, '2023-08-01', '02-Aug-2023 10:10am'),
(30, 'The definition of ecommerce business can also include tactics like affiliate marketing. You can use ecommerce channels such as your own website,an established selling website like Amazon,', 9, 14, '2023-08-01', '05-Aug-2023 10:10am'),
(31, 'Nice!!', 11, 11, '2023-08-01', '05-Aug-2023 10:10pm'),
(35, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae', 12, 3, '2023-08-02', '05-Aug-2023 9:10pm'),
(36, 'NIce Match!!!', 4, 11, '2023-08-02', '07-Aug-2023 12:10am'),
(37, 'Mauris ultricies, justo eu convallis placerat, felis e', 4, 18, '2023-08-02', '05-Aug-2023 10:10am'),
(38, 'gravida pellentesque urna varius vitae', 12, 13, '2023-08-02', '05-Aug-2023 8:10am'),
(40, '8 oct', 12, 13, '2023-08-02', '05-Aug-2023 9:10am'),
(41, 'Comments Korci', 10, 17, '2023-08-02', '05-Aug-2023 10:10am'),
(42, 'University\r\n\r\nLorem ipsum dolor sit amet, ', 2, 21, '2023-08-02', '06-Aug-2023 10:10am'),
(44, 'kise', 10, 9, '2023-08-06', '06-Aug-2023 07:10pm'),
(48, 'Having originated in south-east England, it became an established sport in the country in the 18th century and developed globally in the 19th and 20th centuries.', 4, 22, '2023-08-07', '07-Aug-2023 12:22am');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `meta_tag` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, -0=active',
  `post_date` date NOT NULL,
  `post_month` text NOT NULL,
  `post_day` int(11) NOT NULL,
  `post_year` int(11) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `image`, `category_id`, `author_id`, `meta_tag`, `status`, `post_date`, `post_month`, `post_day`, `post_year`, `view_count`) VALUES
(2, 'Education is the transmission of knowledge', '<p><strong>Education</strong>&nbsp;is the transmission &nbsp;There are many debates about its precise definition, for example, about which aims it tries to achieve. A further issue is whether part of the meaning of education is that the change.<strong>Education</strong>&nbsp;is the transmission &nbsp;There are many debates about its precise definition, for example, about which aims it tries to achieve. A further issue is whether part of the meaning of education is that the change .&nbsp;<strong>Education</strong>&nbsp;is the transmission &nbsp;There are many debates about its precise definition, for example, about which aims it tries to achieve. A further issue is whether part of the meaning of education is that the change</p>\r\n', '79695-9662-b.jpg', 23, 11, 'education', 1, '2023-07-29', 'Aug', 10, 2023, 10),
(3, 'How do players play football?', '<p><strong>Two teams of eleven players each compete to get the ball into the other team&#39;s goal (between the posts and under the bar), thereby scoring a goal</strong>. The team that has scored more goals at the end of the game is the winner; if both teams have scored an equal number of goals then the game is a draw.&nbsp;<strong>thereby scoring a goal</strong>. The team that has scored more goals at the end of the game is the winner; if both teams have scored an equal number of goals then the game is a draw.<strong>thereby scoring a goal</strong>. The team that has scored more goals at the end of the game is the winner; if both teams have scored an equal number of goals then the game is a draw.</p>\r\n', '96088-80223-f.jpg', 15, 11, 'football, sports', 1, '2023-07-29', 'Jul', 1, 2023, 16),
(4, 'What is the history of cricket match?', '<p>Having originated in south-east England, it became an established sport in the country in the 18th century and developed globally in the 19th and 20th centuries.</p>\r\n\r\n<p>Having originated in south-east England, it became an established sport in the country in the 18th century and developed globally in the 19th and 20th centuries.</p>\r\n\r\n<p>Having originated in south-east England, it became an established sport in the country in the 18th century and developed globally in the 19th and 20th centuries.</p>\r\n\r\n<p>Having originated in south-east England, it became an established sport in the country in the 18th century and developed globally in the 19th and 20th centuries.</p>\r\n', '4134-Jonny-Bairstow-batting-semifinal-match-England-Australia-2019.png', 12, 3, 'cricket, sports', 1, '2023-07-29', 'Oct', 10, 2023, 32),
(6, 'We are learning PHP & Laravel', '<p><strong>Lorem ipsum dolor</strong> sit amet consectetur adipisicing elit. Ducimus quod numquam omnis necessitatibus magnam nostrum quae nulla non debitis, velit quasi voluptas quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis, vel repellendus asperiores in iste rem esse voluptates commodi voluptatibus neque optio laudantium molestias!&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quod numquam omnis necessitatibus magnam nostrum quae nulla non debitis, velit quasi voluptas quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis, vel repellendus asperiores in iste rem esse voluptates commodi voluptatibus neque optio laudantium molestias!</p>\r\n\r\n<p>. Assumenda excepturi, debitis, vel repellendus asperiores in iste rem esse voluptates commodi voluptatibus neque optio laudantium molestias!</p>\r\n\r\n<p>consectetur adipisicing elit. Ducimus quod numquam omnis necessitatibus magnam nostrum quae nulla non debitis, velit quasi voluptas quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo.</p>\r\n\r\n<p>consectetur adipisicing elit. Ducimus quod numquam omnis necessitatibus magnam nostrum quae nulla non debitis, velit quasi voluptas quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo.</p>\r\n', '68826-17736-cryptiva.jpg', 14, 3, 'pogramming', 1, '2023-07-30', 'Jul', 3, 2023, 10),
(7, 'Sheik Hasina', '', '51499-Screenshot_2.jpg', 17, 3, '', 0, '2023-07-30', 'Jul', 2, 2023, 0),
(8, 'Bangladesh Vs India', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quod numquam omnis necessitatibus magnam nostrum quae nulla non debitis, velit quasi voluptas quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis</p>\r\n\r\n<p>quos perspiciatis officiis eos accusantium exercitationem obcaecati. Eius alias libero quo. Assumenda excepturi, debitis</p>\r\n', '88630-72045-bangladesh-gfx.jpg', 11, 3, 'sports', 0, '2023-07-30', 'Aug', 18, 2023, 0),
(9, 'Ecommerce is a method of buying and selling goods', '<p>The definition of ecommerce business can also include tactics like affiliate marketing. You can use ecommerce channels such as your own website,an established selling website like Amazon,</p>\r\n\r\n<p>Commerce is the large-scale organized system of activities, functions, procedures and institutions that directly or indirectly contribute to the transfer of goods and services on a large scale and at</p>\r\n\r\n<p>The definition of ecommerce business can also include tactics like affiliate marketing. You can use ecommerce channels such as your own website,an established selling website like Amazon,</p>\r\n\r\n<p>Commerce is the large-scale organized system of activities, functions, procedures and institutions that directly or indirectly contribute to the transfer of goods and services on a large scale and at</p>\r\n', '51454-GettyImages-1051616786__1_.png', 18, 3, 'economic', 1, '2023-07-30', 'Jun', 20, 2023, 20),
(10, 'A traveling around from place to place.', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.</p>\r\n\r\n<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.Lorem, ipsum<em> dolor sit amet consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.</em></p>\r\n\r\n<p><strong>Lorem, ipsum dolor sit amet</strong> consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aliquid dicta porro soluta laudantium saepe blanditiis minima hic enim itaque.</p>\r\n', '19973-best-tour-operator-quasar-expeditions-00-TOUROPSWB21-0defe953c1504cc68df94708707d5535.jpg', 20, 3, 'hill', 1, '2023-07-30', 'Sep', 1, 2023, 71),
(11, 'All about booking with Capital One Travel', '<p>Planning the perfect getaway? Save yourself from seemingly endless online searches and choose a better way:&nbsp;<a href=\"https://capitalonetravel.com/\">Capital One Travel</a>. Our reimagined booking site has every step of your trip covered&mdash;it&rsquo;s where smart tech meets smart travel!</p>\r\n\r\n<h2>What is Capital One Travel?&nbsp;</h2>\r\n\r\n<p>Capital One Travel is a new online booking experience designed to make planning your next trip enjoyable and hassle-free. The site sorts through thousands of options to help you get our best prices for flights, hotels and car rentals, so you can book with confidence.1&nbsp;As a bonus, eligible cardholders can earn extra rewards when booking through Capital One Travel.&nbsp;</p>\r\n\r\n<p>rental for a scenic drive, you&rsquo;re earning rewards you can put toward your next trip.</p>\r\n\r\n<p>Price prediction and price watch alerts for flights</p>\r\n\r\n<p>Looking for the best time to book? When you search for flights on Capital One Travel, you&rsquo;ll see a recommendation to either book now&mdash;or wait for a better price. Capital One Travel uses artificial intelligence (AI) to analyze billions of data points and predict how flight prices will fluctuate. Simply set a price alert for the destination and dates you&rsquo;re interested in flying. Capital One Travel will monitor prices 24/7 and let you know when it&rsquo;s time to book. With help from our price predictions and alerts, you can save an average of 15% per flight.2</p>\r\n', '90165-lgc407_all-about-booking-with-capital-one-travel.png', 20, 3, 'sajek', 1, '2023-07-31', 'Sep', 2, 2023, 8),
(12, 'Inter University football in Chattogram today', '<p>The excitement was palpable inside the press conference room at the MA Aziz Stadium in Chattogram. The curiousity of the managers and the captains of the participating teams were almost unending. They kept asking questions about the minute details of the tournament. All their questions and their excitement were about Ispahani-Prothom Alo Inter University Football Tournament, which will kick off today (Friday).</p>\r\n\r\n<p>The curtains will rise on the tournament with the Chattogram region matches. In the morning, BGC University and University of Creative Technology will take part in the opening match at the MA Aziz Stadium. A total of 33 universities from Dhaka, Chattogram and Cumilla region are taking part in the knockout tournament.</p>\r\n', '49680-soccer-ball-goal.png', 15, 3, '', 1, '2023-07-31', 'Oct', 8, 2023, 36),
(14, 'f', '', '17749-iteck.jpg', 23, 3, '', 0, '2023-08-02', 'Aug', 2, 2023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 2 COMMENT '1=admin, 2=user',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive',
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `address`, `role`, `status`, `image`) VALUES
(3, 'Rahin Ahmed', 'ahmedrahin660@gmail.com', '01887497149', '6a70335ca0d91a1feff97d0f88b4d919a9bfcbc7', 'Mirpur', 1, 1, '47448-me.jpg'),
(8, 'Tunan', 'tuan@gmail.com', '0182744714', 'b3173912f132cc76f3af02fb827b05efee262edc', 'Rampur, Feni', 2, 0, '78697-2.jpg'),
(9, 'Hritik Buiyan', 'hritik@gmail.com', '01885940', 'f8fe5201899a2aeff62fc5faefda30526482b058', 'Uki para, Feni', 2, 1, '33270-c3jpg.jpg'),
(11, 'Sadia Mariam', 'sadia@gmail.com', '0155765778', '7cb980254c53ef6717584534283364cc08e8eb86', 'Rampur, sayed bari', 1, 1, ''),
(12, 'Nipa Alam', 'nipa@gmail.com', NULL, '04dd9b991c76bb3c7355e3b95f2a0c987d211d87', NULL, 2, 1, NULL),
(13, 'Sayed Ibnul', 'sayed@gmail.com', NULL, '5a4bba8ce27264156fbfbdfd87d24a91200cfb6c', NULL, 2, 1, '37191-about.jpg'),
(14, 'Salma akter', 'salma@gmail.com', NULL, '0592b3308a5a9a46e632dc552a14a74bb6edbcfd', NULL, 2, 1, NULL),
(16, 'Mehjabin Hoissan', 'mehjabin@gmail.com', '0989293', 'f9a4bee72a55f6120a4762ecae0627ec50b16588', 'Sonagazi', 2, 1, NULL),
(17, 'Aysha', 'aysha@gmail.com', NULL, 'fa832495588ed9fa80bb73838f7f557e5832d695', NULL, 2, 1, ''),
(18, 'Shafi Ullah', 'shafi@gmail.com', NULL, '2ad227b86d0771767a368f85a4fb07835289e8fb', NULL, 2, 1, NULL),
(19, 'Ayat', 'ayat@gmail.com', NULL, '90329a8fae2d873614d77d690c29ed9a16c9cffb', NULL, 2, 1, ''),
(20, 'Md oli', 'md@gmail.com', '', '240c4df7250227efd16ebedf6de99c5ab3b51698', '', 2, 0, '47323-IMG_6762.JPG'),
(21, 'Hasib Ahmed', 'hasib@gmail.com', '', '44300eb6d237f2e98a1ce582d535b91d66609b9f', '', 2, 1, '67220-c2.jpg'),
(22, 'Munna', 'munna@gmail.com', '', '28d3382b804863a62b82f3652b4ac2813a6bfbb4', '', 2, 1, '51799-c4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
