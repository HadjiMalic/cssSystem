-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 08:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `css_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`) VALUES
(2, 'Jalanie', 'hadjimalic'),
(3, 'cjellezo', 'xxsoulfirexx88');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `office_type` enum('office_1','office_2','office_3','office_4','office_5') NOT NULL,
  `feedback_text` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `office_type`, `feedback_text`, `submission_date`) VALUES
(24, NULL, 'office_1', 'asdadadad', '2023-11-29 06:32:25'),
(25, NULL, 'office_1', 'asdasda', '2023-11-29 11:08:36'),
(26, NULL, '', '', '2023-11-29 11:30:07'),
(27, NULL, '', '', '2023-11-29 11:30:08'),
(28, NULL, '', '', '2023-11-29 11:30:09'),
(29, NULL, '', '', '2023-11-29 11:30:10'),
(30, NULL, 'office_1', 'sdadadad', '2023-11-29 11:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('multiple_choice','text') NOT NULL,
  `options` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `question_text`, `question_type`, `options`, `is_active`) VALUES
(1, 'How satisfied are you with the services', 'multiple_choice', '1,2,3,4,5', 1),
(3, 'What suggestions do you have for improvement?', 'text', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `surveys_archive`
--

CREATE TABLE `surveys_archive` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `office_type` enum('office_a','office_b','office_c','office_d','office_e') NOT NULL,
  `question1` text DEFAULT NULL,
  `question2` text DEFAULT NULL,
  `question3` text DEFAULT NULL,
  `question4` text DEFAULT NULL,
  `question5` text DEFAULT NULL,
  `question6` text DEFAULT NULL,
  `question7` text DEFAULT NULL,
  `question8` text DEFAULT NULL,
  `question9` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveys_archive`
--

INSERT INTO `surveys_archive` (`id`, `user_id`, `office_type`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `created_at`, `feedback`) VALUES
(224, NULL, '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2024-01-16 02:46:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surveys_archives`
--

CREATE TABLE `surveys_archives` (
  `id` int(11) NOT NULL,
  `question1` varchar(255) DEFAULT NULL,
  `question2` varchar(255) DEFAULT NULL,
  `question3` varchar(255) DEFAULT NULL,
  `question4` varchar(255) DEFAULT NULL,
  `question5` varchar(255) DEFAULT NULL,
  `question6` varchar(255) DEFAULT NULL,
  `question7` varchar(255) DEFAULT NULL,
  `question8` varchar(255) DEFAULT NULL,
  `question9` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL,
  `office_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveys_archives`
--

INSERT INTO `surveys_archives` (`id`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `created_at`, `feedback`, `office_type`) VALUES
(1, '4', '4', '4', '4', '4', '4', '4', '4', '4', '2024-01-16 02:46:09', NULL, 'ICT'),
(2, '1', '1', '1', '2', '2', '2', '3', '3', '3', '2024-01-16 02:38:25', NULL, 'Guidance'),
(3, '1', '2', '3', '4', '3', '2', '3', '4', '3', '2024-01-16 02:38:09', NULL, 'ICT'),
(4, '2', '2', '2', '2', '2', '2', '2', '2', '2', '2024-01-16 02:45:55', NULL, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `option_5` varchar(255) NOT NULL,
  `option_na` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`question_id`, `question_text`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`, `option_na`) VALUES
(1, 'I am satisfied with the services that I availed.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(2, 'I spent a reasonable amount of time on my transaction.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(3, 'The office followed the transactions requirements and steps based on the information provided.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(4, 'The steps (including payment) I needed to do for my transaction were easy and simple.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(5, 'I easily found information about my transaction from the office or its website.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(6, 'I paid a reasonable amount of fees for my transaction.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(7, 'I feel the office was fair to everyone or \"walang palakasan\", during my transaction.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(8, 'I was treated courteously by the staff and (if asked for help) the staff was helpful.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable'),
(9, 'I got what I needed from the government office, (got denied) or denial of the request was successfully explained it to me.', '5 - Strongly Agree', '4 - Agree', '3 - Neutral', '2 - Disagree', '1 - Strongly Disagree', 'NA - Not Applicable');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` int(11) NOT NULL,
  `question1` int(11) DEFAULT NULL,
  `question2` int(11) DEFAULT NULL,
  `question3` int(11) DEFAULT NULL,
  `question4` int(11) DEFAULT NULL,
  `question5` int(11) DEFAULT NULL,
  `question6` int(11) DEFAULT NULL,
  `question7` int(11) DEFAULT NULL,
  `question8` int(11) DEFAULT NULL,
  `question9` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `feedback` text DEFAULT NULL,
  `office_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `created_at`, `feedback`, `office_type`) VALUES
(1, 5, 5, 4, 4, 4, 4, 4, 4, 3, '2024-01-16 02:37:22', '', 'Registrar'),
(2, 4, 3, 4, 4, 3, 3, 4, 4, 3, '2024-01-16 02:37:36', '', 'Admin'),
(3, 5, 4, 3, 4, 5, 4, 3, 4, 5, '2024-01-16 02:37:54', '', 'Accreditation'),
(10, 5, 5, 5, 5, 5, 5, 5, 5, 5, '2024-01-16 07:27:59', '', 'ICT'),
(11, 3, 3, 3, 3, 3, 3, 3, 3, 3, '2024-01-16 07:28:22', '', 'Guidance'),
(12, 2, 2, 2, 2, 2, 2, 2, 2, 2, '2024-01-16 07:29:35', 'Very Unfriendly', 'Registrar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('student','faculty','visitor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`) VALUES
(1, 'student'),
(2, 'faculty'),
(3, 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys_archive`
--
ALTER TABLE `surveys_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `surveys_archives`
--
ALTER TABLE `surveys_archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
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
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surveys_archive`
--
ALTER TABLE `surveys_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `surveys_archives`
--
ALTER TABLE `surveys_archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `surveys_archive`
--
ALTER TABLE `surveys_archive`
  ADD CONSTRAINT `surveys_archive_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
