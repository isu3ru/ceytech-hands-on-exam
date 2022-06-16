-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2022 at 04:01 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handsonexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `is_published` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `featured_image`, `published_at`, `user_id`, `is_published`, `created_at`, `slug`) VALUES
(1, 'What is Lorem Ipsum?', '<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n', 'storage/pages/627b6af81f4c89.40077469.png', '2022-05-11 07:51:20', 1, 1, '2022-05-11 07:51:20', 'what-is-lorem-ipsum'),
(3, 'Quisque semper leo vitae magna hendrerit iaculis', '<p>Quisque molestie eros in ex pretium faucibus. Suspendisse vitae blandit lectus. Suspendisse nulla augue, convallis a purus sed, venenatis aliquet turpis. Nam non justo ac velit vestibulum tristique. Cras eget sagittis mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur vel maximus est. Quisque volutpat congue tempor. Nam scelerisque dolor et ex fringilla commodo. Suspendisse ut erat id mauris blandit ornare. Proin nec posuere lorem, a interdum lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>\r\n\r\n<p>Mauris iaculis velit turpis, a dignissim eros interdum sit amet. Quisque tristique dolor magna. In posuere, dui vel pellentesque ullamcorper, neque tellus lobortis mauris, sed dapibus elit ex ac mauris. Donec quis enim in elit convallis egestas. Sed facilisis nulla ut felis posuere, tristique consectetur est eleifend. Proin a arcu scelerisque, sagittis dolor ut, hendrerit urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget lacus tincidunt ipsum faucibus sagittis vel at orci. Aenean libero nisl, imperdiet laoreet sollicitudin in, hendrerit sit amet lacus. Proin finibus ante a lectus pulvinar vulputate. Aliquam rutrum lorem faucibus, tempor nisl a, iaculis magna. Mauris odio leo, rhoncus lacinia nunc vel, consequat tincidunt neque.</p>\r\n\r\n<p>Fusce orci nisi, dapibus condimentum tincidunt vitae, scelerisque et velit. Etiam elementum leo magna, vitae hendrerit justo mattis vel. Praesent scelerisque ipsum nec justo consectetur elementum. Phasellus porta tortor diam, id rhoncus risus commodo vitae. Proin non dapibus nisi. Fusce ut dignissim nisi. Nunc sed massa pharetra, pharetra nisl sit amet, porta lectus.</p>\r\n\r\n<p>Quisque semper leo vitae magna hendrerit iaculis. Vivamus id neque lobortis, tempor velit ac, tincidunt eros. Maecenas commodo neque in tellus condimentum pretium. Quisque et dui nulla. Duis sit amet nisi eu dolor dignissim malesuada. Nam blandit, velit non interdum viverra, augue mi rhoncus mauris, tempus vulputate leo sem sed erat. Aliquam diam ex, volutpat id hendrerit nec, posuere ac tortor. Suspendisse potenti. Donec a eros a nisl aliquam ultricies. In tellus ante, venenatis sit amet erat eu, eleifend sollicitudin mi.</p>\r\n\r\n<p>Aenean ornare orci odio, id lobortis augue fringilla quis. Maecenas ac lorem laoreet, lobortis mauris vel, congue ante. Duis dapibus massa at porta mollis. Nulla eu sem quis nisl scelerisque convallis. Suspendisse vitae turpis massa. Fusce sed sollicitudin ante. Proin ut laoreet lorem. Sed et purus id orci pharetra rhoncus. Integer tempor sagittis malesuada. Fusce non turpis tempor, dapibus elit facilisis, porttitor erat. Fusce malesuada imperdiet velit sed varius. Sed quis rutrum lorem.</p>\r\n', 'storage/pages/6281feee0b9ab0.42738670.jpg', '2022-05-16 07:36:14', 1, 1, '2022-05-16 07:36:14', 'quisque-semper-leo-vitae-magna-hendrerit-iaculis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role`, `registered_at`) VALUES
(9, 'Administrator', 'User', 'administrator', 'admin@admin.com', '$2y$10$E/I9F1OI8aZbRDS/2FyRG.6tKSPhAJJpVQ03BD0gBohzurGvEZdly', 'admin', '2022-05-11 12:53:08'),
(15, 'Isuru', 'Ranawaka', 'isu3ru', 'isu3ru@gmail.com', '$2y$10$OAoJ.mGOnNW2e2DpSCoG../PbaXZh5G8VCJszQJk2DsBZSyj2Oejq', 'user', '2022-05-16 08:45:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
