-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2026 at 05:09 AM
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
-- Database: `pioneer-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent','Late','Leave') NOT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nrc` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `name`, `nrc`, `gender`, `father_name`, `mother_name`, `dob`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-29 00:52:09', '2025-12-29 00:52:09'),
(2, 'sein lwin', '5/sakana(n) 177085', 'male', 'u paw san', 'daw aye mi khine', '2026-01-28', '091959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2026-01-03 02:35:49', '2026-01-03 02:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `event_date`, `date`, `description`, `image`, `video`, `created_at`, `updated_at`) VALUES
(11, 'ငငငင', NULL, '2026-01-17', 'njnvnvnfdvdjn', 'events/40f8ndAJh7fQnGwWiExqkK9iZ20VsypmryeOQQCR.jpg', NULL, '2026-01-09 00:26:38', '2026-01-10 06:50:51'),
(12, 'gggg', NULL, '2026-01-21', 'ddd', 'events/iTISANDxZGezGW65wHaY5kQwpZLfBqWc0XPCLWFU.jpg', NULL, '2026-01-09 00:32:24', '2026-01-10 06:49:34'),
(14, 'yyyyyy', NULL, '2026-01-16', 'cfdygvd', 'events/2Vtqb3zr4gIfFs6fLd1ZPtR4JJSGp0tVDgpET4QJ.jpg', NULL, '2026-01-09 00:47:15', '2026-01-10 06:51:03'),
(16, 'ဘဘဘ', NULL, '2026-01-20', 'ဘဘဘဘ', 'events/ExVSWzHSfVgQD1A4Mcc03oWYqh3IgX89cBIiCKaZ.jpg', NULL, '2026-01-09 01:05:14', '2026-01-10 06:50:26'),
(17, 'ိိ', NULL, '2026-01-22', 'vvvvvvv', 'events/FPMbs3KUTFZR83kgkWNdkFcaoiqYLTTrcvj3pUdz.jpg', NULL, '2026-01-09 01:11:50', '2026-01-10 06:49:19'),
(18, 'school welcome party', NULL, '2026-01-21', 'student', 'events/kAHdS0EngP76dOEzrnSTf4l1AfTonAdQhKBuGg75.jpg', 'https://youtu.be/8NI8JWuDGXU?list=RDEMsREb275D45ogtjlfdAGuhA', '2026-01-10 06:32:58', '2026-01-10 06:32:58'),
(19, 'birthday party', NULL, '2026-01-21', 'u thet khine', 'events/azufrVePc5TgWJdj918rjomW8cWmdQgbTJv0C3dS.jpg', 'https://youtu.be/8NI8JWuDGXU?list=RDEMsREb275D45ogtjlfdAGuhA', '2026-01-10 06:45:05', '2026-01-10 06:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `grade_id` bigint(20) UNSIGNED DEFAULT NULL,
  `grade_name` varchar(255) DEFAULT NULL,
  `exam_name` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `score` decimal(6,2) DEFAULT NULL,
  `max_score` decimal(6,2) DEFAULT NULL,
  `result_date` date NOT NULL,
  `status` enum('Pass','Fail','Absent') DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `student_id`, `student_name`, `grade_id`, `grade_name`, `exam_name`, `subject`, `score`, `max_score`, `result_date`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(2, NULL, 'aung thura hein', NULL, 'grade 2', '2 sem', 'myanmar', 78.00, 100.00, '2026-01-27', 'Pass', NULL, '2026-01-08 01:23:50', '2026-01-08 01:23:50'),
(3, NULL, 'aung myint myat', NULL, 'grade 2', '3 sem', 'english', 78.00, 100.00, '2026-01-27', 'Pass', NULL, '2026-01-08 01:26:11', '2026-01-08 01:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_09_21_163936_create_categories_table', 1),
(7, '2025_09_22_043302_create_contacts_table', 1),
(8, '2025_09_22_044859_create_events_table', 1),
(9, '2025_10_15_134904_create_results_table', 1),
(10, '2025_11_28_141549_create_exam_results_table', 1),
(11, '2025_12_02_044757_create_students_table', 1),
(12, '2025_12_02_050723_create_enrolls_table', 1),
(13, '2025_12_03_111102_create_subjects_table', 1),
(14, '2025_12_04_045858_create_teachers_table', 2),
(15, '2025_12_04_061455_create_grades_table', 3),
(16, '2026_01_03_061210_create_classrooms_table', 4),
(17, '2025_12_25_093218_add_event_date_to_events_table', 5),
(18, '2026_01_03_083428_create_sections_table', 6),
(19, '2026_01_03_094746_create_teaching_assignments_table', 7),
(20, '2026_01_03_153729_create_exam_results_table', 8),
(21, '2026_01_03_153349_create_exam_results_table', 9),
(22, '2026_01_08_051628_create_attendances_table', 9),
(23, '2026_01_08_072531_create_exam_result_table', 10),
(24, '2026_01_08_075231_add_student_grade_names_to_exam_results_table', 11),
(25, '2026_01_09_041741_create_event_media_table', 12),
(26, '2026_01_09_072849_add_media_to_events_table', 13),
(27, '2026_01_10_124017_add_media_to_events_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nrc` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `nrc`, `gender`, `father_name`, `mother_name`, `dob`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-03 20:54:15', '2025-12-03 20:54:15'),
(2, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-28 23:47:15', '2025-12-28 23:47:15'),
(3, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-29 00:01:09', '2025-12-29 00:01:09'),
(4, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-29 00:03:29', '2025-12-29 00:03:29'),
(5, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-29 00:07:00', '2025-12-29 00:07:00'),
(6, 'Myo Tun Naung', '5/sakana(n) 177085', 'male', 'U Satt', 'Daw Soe', '2025-12-03', '91959404', '17 Soi Senanikom 1, Soi 25, Senanikom 1 Road,Chorakhe Bua Subdistrict, Lat Phrao District,Bangkok 10230', '2025-12-29 00:45:13', '2025-12-29 00:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'English', NULL, NULL),
(6, 'Math', NULL, NULL),
(7, 'physic', '2025-12-26 08:28:40', '2025-12-26 08:28:40'),
(9, 'myanmar', '2025-12-28 22:11:47', '2025-12-28 22:11:47'),
(10, 'physics', '2025-12-28 22:30:25', '2025-12-28 22:30:25'),
(19, 'Aung Thura Hein', '2026-01-03 02:33:23', '2026-01-03 02:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `education` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `education`, `photo`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(2, 'founder', 'B.C.Sc', 'teachers/mLxFqDzWx9M1UVt6f0IlTgyFkFY0nrWwhg7nMSlJ.jpg', '097u8778', 'ssm@gmail.com', NULL, '2026-01-07 00:12:59'),
(10, 'sein lwin', 'B.C.Sc', NULL, '091959404', 'slwin.seinlwin@gmail.com', '2026-01-08 01:30:16', '2026-01-08 01:30:16'),
(11, 'Akarphyo', 'B.C.Tech', 'teachers/xhYJjRyrQpwTFDZFNQ9GJnfkKGpiFVJbph0rARrL.jpg', '0943071844', 'phyo1@gmail.com', '2026-01-10 09:26:16', '2026-01-10 09:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `teaching_assignments`
--

CREATE TABLE `teaching_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin12@gmail.com', NULL, '$2y$12$4CfqD6W78Ek.n3RlDB1kR.t.yOFlnPvPNSbmcqh3tu66EU3n4YDPK', NULL, '2025-12-03 20:56:33', '2025-12-03 20:56:33'),
(2, 'User', 'user0@gmail.com', NULL, '$2y$12$F5xiuy/ekueZnpyEPf5/H.JJTYP1smvfHu1V3HNdu1ZABXQgeS6Pq', NULL, '2025-12-04 01:08:37', '2025-12-04 01:08:37'),
(3, 'Akarphyo', 'phyo1@gmail.com', NULL, '$2y$12$bvbRbQA3fiXnsZDy.5taWeR2qRWrs53.fIWCGQu10RPI.DN58uyYm', NULL, '2026-01-07 01:45:01', '2026-01-07 01:45:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_id_attendance_date_unique` (`student_id`,`attendance_date`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_student_id_foreign` (`student_id`),
  ADD KEY `exam_results_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ta_unique` (`teacher_id`,`subject_id`,`classroom_id`,`section_id`),
  ADD KEY `teaching_assignments_subject_id_foreign` (`subject_id`),
  ADD KEY `teaching_assignments_classroom_id_foreign` (`classroom_id`),
  ADD KEY `teaching_assignments_section_id_foreign` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `exam_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teaching_assignments`
--
ALTER TABLE `teaching_assignments`
  ADD CONSTRAINT `teaching_assignments_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teaching_assignments_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `teaching_assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teaching_assignments_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
