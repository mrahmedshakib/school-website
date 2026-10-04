-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2026 at 12:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `button_text`, `button_url`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'আমাদের সম্পর্কে\nবিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ', 'বিয়াম ফাউন্ডেশন, ঢাকা এর সার্বিক পরিচালনায় ছাত্র-ছাত্রীদের মানসম্মত শিক্ষা প্রদানের উদ্দেশ্যে ২০০৭ সালে বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া প্রতিষ্ঠিত হয়। বাস্তব, যুগোপযোগী ও গুণগত মানসম্পন্ন শিক্ষা প্রদানই এ প্রতিষ্ঠানের প্রধান লক্ষ্য।\n\nপ্রচলিত শিক্ষার গতানুগতিক ধারা থেকে বেরিয়ে এসে শিক্ষার্থীদেরকে আধুনিক, বিজ্ঞানসম্মত ও যুগোপযোগী শিক্ষাদানের মাধ্যমে একবিংশ শতাব্দীর চ্যালেঞ্জ মোকাবেলায় বর্তমান প্রজন্মকে সত্যিকারের মানুষ গড়ার লক্ষ্যে বিয়াম ফাউন্ডেশন সুপ্রাচীন ঐতিহ্য মণ্ডিত পুন্ড্রনগরী ও আধুনিক শিল্প কেন্দ্র, বগুড়া থেকে মাত্র ২০ কিঃমিঃ পশ্চিমে দুপচাঁচিয়া উপজেলার প্রাণকেন্দ্র উপজেলা কমপ্লেক্স-এ ২০০৭ সালে এ প্রতিষ্ঠানটি স্থাপন করে। সর্বোপরি প্রতিষ্ঠানটি আদর্শ মানুষ গড়ার অনন্য সাধনায় রত।\n\nভবিষ্যত প্রজন্মকে তাদের সুপ্ত প্রতিভার যথাযথ বিকাশ ঘটিয়ে শারীরিক, মানসিক, চারিত্রিক, সামাজিক ও ধর্মীয় মূল্যবোধে উদ্বুদ্ধ করে তোলার লক্ষ্যে সুদূর প্রসারী পরিকল্পনা বাস্তবায়ন করা হচ্ছে।', 'uploads/about/about.jpg', 'আরও জানুন', '/about', 1, 0, '2026-09-29 23:25:16', '2026-09-29 23:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `academic_subjects`
--

CREATE TABLE `academic_subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'General',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Compulsory',
  `total_marks` int NOT NULL DEFAULT '100',
  `theory_marks` int DEFAULT NULL,
  `practical_marks` int DEFAULT NULL,
  `viva_marks` int DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_subjects`
--

INSERT INTO `academic_subjects` (`id`, `name_bn`, `name_en`, `code`, `class`, `group_name`, `type`, `total_marks`, `theory_marks`, `practical_marks`, `viva_marks`, `description_bn`, `description_en`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'বাংলা ১ম ও ২য় পত্র', 'Bangla 1st & 2nd Paper', '১০১', '৯ম - ১০ম শ্রেণি', 'সাধারণ বিভাগ', 'আবশ্যিক', 200, 140, 0, 60, 'বাংলা ব্যাকরণ, নির্মিতি এবং সাহিত্য পাঠ সংকলন।', 'Comprehensive Bengali literature, grammar and composition curriculum.', 1, 1, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(2, 'ইংরেজি ১ম ও ২য় পত্র', 'English 1st & 2nd Paper', '১০৭', '৯ম - ১০ম শ্রেণি', 'সাধারণ বিভাগ', 'আবশ্যিক', 200, 140, 0, 60, 'ইংরেজি ভাষা দক্ষতা, গ্রামার, রিডিং ও রাইটিং কম্পোজিশন।', 'English reading, communicative writing, advanced grammar and vocabulary.', 1, 2, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(3, 'সাধারণ গণিত', 'General Mathematics', '১০৯', '৯ম - ১০ম শ্রেণি', 'সাধারণ বিভাগ', 'আবশ্যিক', 100, 70, 0, 30, 'পাটিগণিত, বীজগণিত, জ্যামিতি, ত্রিকোণমিতি ও পরিসংখ্যান।', 'Fundamental mathematics covering arithmetic, algebra, trigonometry and geometry.', 1, 3, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(4, 'তথ্য ও যোগাযোগ প্রযুক্তি', 'Information & Communication Technology', '১৫৪', '৯ম - ১০ম শ্রেণি', 'সাধারণ বিভাগ', 'আবশ্যিক', 50, 25, 25, 0, 'কম্পিউটার হার্ডওয়্যার, ইন্টারনেট, ডেটাবেজ ও প্রোগ্রামিংয়ের পরিচিতি।', 'Hands-on training in digital computing, cyber security, database and office suites.', 1, 4, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(5, 'পদার্থবিজ্ঞান', 'Physics', '১৩৬', '৯ম - ১০ম শ্রেণি', 'বিজ্ঞান বিভাগ', 'আবশ্যিক', 100, 75, 25, 0, 'বলবিদ্যা, তাপ, শব্দ, আলো, বিদ্যুৎ ও আধুনিক পদার্থবিজ্ঞান।', 'Core concepts of mechanics, waves, electromagnetism and practical lab sessions.', 1, 5, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(6, 'রসায়ন', 'Chemistry', '১৩৭', '৯ম - ১০ম শ্রেণি', 'বিজ্ঞান বিভাগ', 'আবশ্যিক', 100, 75, 25, 0, 'পরমাণুর গঠন, রাসায়নিক বন্ধন, পর্যায় সারণি ও ব্যবহারিক পরীক্ষা।', 'Atomic structure, periodic table, chemical bonding and reactions with laboratory practice.', 1, 6, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(7, 'জীববিজ্ঞান', 'Biology', '১৩৮', '৯ম - ১০ম শ্রেণি', 'বিজ্ঞান বিভাগ', 'আবশ্যিক', 100, 75, 25, 0, 'কোষ ও টিস্যু, উদ্ভিদ ও প্রাণীর অঙ্গসংস্থান, জিনতত্ত্ব ও পরিবেশ।', 'Cell biology, physiology, genetics, ecology and biodiversity.', 1, 7, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(8, 'উচ্চতর গণিত', 'Higher Mathematics', '১২৬', '৯ম - ১০ম শ্রেণি', 'বিজ্ঞান বিভাগ', 'ঐচ্ছিক', 100, 75, 25, 0, 'ফাংশন, বীজগণিতীয় রাশি, জ্যামিতিক অঙ্কন, স্থানাঙ্ক জ্যামিতি ও সম্ভাবনা।', 'Advanced algebra, functions, coordinate geometry, calculus fundamentals and probability.', 1, 8, '2026-09-30 06:00:01', '2026-09-30 06:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `academic_syllabuses`
--

CREATE TABLE `academic_syllabuses` (
  `id` bigint UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `subject_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_syllabuses`
--

INSERT INTO `academic_syllabuses` (`id`, `title_bn`, `title_en`, `class`, `academic_year`, `subject_name_bn`, `subject_name_en`, `file_path`, `description_bn`, `description_en`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'বার্ষিক পাঠ্যক্রম ও বিষয়ভিত্তিক সিলেবাস ২০২৬ - ষষ্ঠ শ্রেণি', 'Annual Academic Syllabus 2026 - Class Six', '৬ষ্ঠ শ্রেণি', '২০২৬', 'সকল বিষয়', 'All Subjects', 'uploads/syllabuses/syllabus_class_6.pdf', 'জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB) প্রণীত নতুন কারিকুলাম অনুযায়ী প্রণীত সিলেবাস ও শিখন পরিকল্পনা।', 'Curriculum aligned with the new NCTB educational guidelines and lesson plans.', 1, 1, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(2, 'বার্ষিক পাঠ্যক্রম ও মূল্যায়ন সিলেবাস ২০২৬ - সপ্তম শ্রেণি', 'Annual Academic Syllabus 2026 - Class Seven', '৭ম শ্রেণি', '২০২৬', 'সকল বিষয়', 'All Subjects', 'uploads/syllabuses/syllabus_class_7.pdf', 'সপ্তম শ্রেণির শিক্ষার্থীদের জন্য পাঠ্যপুস্তক ভিত্তিক সার্বিক শিখন অভিজ্ঞতা ও বার্ষিক মূল্যায়ন নির্দেশিকা।', 'Annual evaluation syllabus and lesson plans for Class 7 students.', 1, 2, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(3, 'এসএসসি পরীক্ষার পূর্ণাঙ্গ সিলেবাস ও মানবন্টন ২০২৬ - নবম ও দশম শ্রেণি', 'Comprehensive SSC Syllabus 2026 - Class Nine & Ten', '৯ম ও ১০ম শ্রেণি', '২০২৬', 'বিজ্ঞান, মানবিক ও ব্যবসায় শিক্ষা বিভাগ', 'Science, Humanities & Business Studies', 'uploads/syllabuses/syllabus_ssc_2026.pdf', 'মাধ্যমিক পরীক্ষার জন্য অধ্যায়ভিত্তিক বিস্তারিত পাঠ্যক্রম, নম্বর বণ্টন ও ব্যবহারিক পরীক্ষার স্পষ্ট রূপরেখা।', 'Detailed chapter-wise syllabus and practical exam blueprint for secondary students.', 1, 3, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(4, 'এইচএসসি কোর্স কারিকুলাম ও বিষয়ভিত্তিক সিলেবাস ২০২৬ - একাদশ ও দ্বাদশ শ্রেণি', 'HSC Academic Syllabus 2026 - Class Eleven & Twelve', 'একাদশ ও দ্বাদশ শ্রেণি', '২০২৬', 'বিজ্ঞান ও মানবিক বিভাগ', 'Science & Humanities', 'uploads/syllabuses/syllabus_hsc_2026.pdf', 'উচ্চ মাধ্যমিক কলেজ শাখার বোর্ড নির্ধারিত সম্পূর্ণ কোর্স সিলেবাস ও ব্যবহারিক পরীক্ষার সূচি।', 'Complete higher secondary course syllabus for Science and Humanities disciplines.', 1, 4, '2026-09-30 06:00:01', '2026-09-30 06:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `administrations`
--

CREATE TABLE `administrations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrations`
--

INSERT INTO `administrations` (`id`, `name`, `designation`, `phone`, `email`, `description`, `image`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'উপজেলা নির্বাহী অফিসার ও সভাপতি', 'সভাপতি, পরিচালনা পর্ষদ', '02-589911210', 'unodupchanchia@mopa.gov.bd', 'শিক্ষার্থীদের জ্ঞান অর্জন এবং তার প্রয়োগের ক্ষেত্রে সহায়তা দানই এ প্রতিষ্ঠানের মূল লক্ষ্য। শিক্ষাই জাতির উন্নতি, অগ্রগতি ও বিকাশের একমাত্র মাধ্যম। এসব স্মরণ রেখে এ প্রতিষ্ঠানের শুভযাত্রা। প্রচলিত শিক্ষার গতানুগতিক ধারা থেকে বেরিয়ে এসে শিক্ষার্থীদেরকে আধুনিক, বিজ্ঞানসম্মত ও যুগোপযোগী শিক্ষাদানের মাধ্যমে একবিংশ শতাব্দীর চ্যালেঞ্জ মোকাবেলায় বর্তমান প্রজন্মকে সত্যিকারের মানুষ গড়ার লক্ষ্যে বিয়াম ফাউন্ডেশন সুপ্রাচীন ঐতিহ্য মণ্ডিত পুন্ড্রনগরী ও আধুনিক শিল্প কেন্দ্র, বগুড়া থেকে মাত্র ২০ কিঃমিঃ পশ্চিমে দুপচাঁচিয়া উপজেলার প্রাণকেন্দ্র উপজেলা কমপ্লেক্স-এ ২০০৭ সালে এ প্রতিষ্ঠানটি স্থাপন করে। সর্বোপরি প্রতিষ্ঠানটি আদর্শ মানুষ গড়ার অনন্য সাধনায় রত।', 'uploads/administration/chairman.png', 1, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(2, 'রঞ্জন কুমার পাল', 'প্রধান শিক্ষক / অধ্যক্ষ', '01712115282', 'blsc.dupchanchia@gmail.com', 'বিয়াম ফাউন্ডেশন, ঢাকা এর সার্বিক পরিচালনায় ছাত্র-ছাত্রীদের মানসম্মত শিক্ষা প্রদানের উদ্দেশ্যে ২০০৭ সালে বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া প্রতিষ্ঠিত হয়। বাস্তব, যুগোপযোগী ও গুণগত মানসম্পন্ন শিক্ষা প্রদানই এ প্রতিষ্ঠানের প্রধান লক্ষ্য। বাংলাদেশে চাহিদার তুলনায় মানসম্মত স্কুল ও কলেজের সংখ্যা খুবই কম। সংখ্যাগরিষ্ঠ স্কুল ও কলেজগুলোতে অনুমোদিত পাঠ্যক্রম ও পাঠ্যসূচির আলোকে গতানুগতিক ধারায় শুধু শ্রেণিকক্ষে পাঠদান করা হয়ে থাকে। শিক্ষার্থীদের জীবনের সকল স্তরে তথা কর্মময় বাস্তব জীবনে চলার পথে পাথেয় হিসেবে শিক্ষার্থীদের মধ্যে নৈতিকতা ও শৃঙ্খলাবোধ, ধর্মীয় ও মানবিক মূল্যবোধ ইত্যাদি গুণাবলী উজ্জীবনের অনন্য প্রয়াস আমাদের প্রতিষ্ঠান।', 'uploads/administration/headmaster.jpg', 2, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(3, 'গৌতম কুমার পিকে', 'প্রশাসনিক কর্মকর্তা', '01722152023', 'blsc.dupchanchia@gmail.com', 'প্রশাসনিক কার্যক্রম এবং ছাত্র-ছাত্রীদের সামগ্রিক অ্যাকাডেমিক শৃঙ্খলার সার্বক্ষণিক দায়িত্ব পালন।', 'uploads/administration/goutam_kumar.jpg', 3, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_start` date DEFAULT NULL,
  `application_end` date DEFAULT NULL,
  `application_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `title`, `description`, `image`, `pdf`, `application_start`, `application_end`, `application_url`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '২০২৬ শিক্ষাবর্ষে প্লে থেকে একাদশ শ্রেণিতে ভর্তি চলছে', 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়ায় ২০২৬ শিক্ষাবর্ষে প্লে-গ্রুপ হতে একাদশ শ্রেণি পর্যন্ত ভর্তি কার্যক্রম শুরু হয়েছে। সীমিত আসনে মেধার ভিত্তিতে ছাত্র-ছাত্রী ভর্তি করা হচ্ছে।\\n\\nআবেদনের নিয়মাবলী:\\n১. অনলাইন বা সরাসরি অফিস থেকে আবেদন ফরম সংগ্রহ করা যাবে।\\n২. জন্ম নিবন্ধন সনদ ও পাসপোর্ট সাইজ ছবি জমা দিতে হবে।\\n৩. আসন সংখ্যা সীমিত বিধায় দ্রুত যোগাযোগ করার পরামর্শ দেয়া হলো।', 'uploads/sliders/slide-2.jpg', NULL, '2026-01-01', '2026-12-31', '/online-admission', 1, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `admission_applications`
--

CREATE TABLE `admission_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `application_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `birth_reg_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'বাংলাদেশী',
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_nid` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_education` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_nid` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_education` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `present_address` text COLLATE utf8mb4_unicode_ci,
  `guardian_info` text COLLATE utf8mb4_unicode_ci,
  `father_occupation_info` text COLLATE utf8mb4_unicode_ci,
  `other_children_info` text COLLATE utf8mb4_unicode_ci,
  `student_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','payment_pending','selected_lottery','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_lottery_selected` tinyint(1) NOT NULL DEFAULT '0',
  `lottery_rank` int DEFAULT NULL,
  `lottery_quota` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'general',
  `lottery_drawn_at` timestamp NULL DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_applications`
--

INSERT INTO `admission_applications` (`id`, `application_no`, `academic_year`, `student_name`, `student_name_bn`, `student_name_en`, `date_of_birth`, `birth_reg_no`, `gender`, `blood_group`, `religion`, `nationality`, `class`, `group_name`, `previous_school`, `father_name`, `father_name_en`, `father_nid`, `father_education`, `mother_name`, `mother_name_en`, `mother_nid`, `mother_education`, `guardian_phone`, `contact_mobile`, `email`, `address`, `permanent_address`, `present_address`, `guardian_info`, `father_occupation_info`, `other_children_info`, `student_photo`, `birth_certificate`, `status`, `is_lottery_selected`, `lottery_rank`, `lottery_quota`, `lottery_drawn_at`, `is_confirmed`, `confirmed_at`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 'ADM-20260930-5MBN4W', '2026', 'অনলাইন ভর্তি আবেদন', NULL, NULL, '2026-09-29', NULL, 'male', NULL, NULL, 'বাংলাদেশী', '9', NULL, NULL, 'অভিভাবকের তথ্য', NULL, NULL, NULL, 'মাতার নাম', NULL, NULL, NULL, '01767056733', NULL, 'imtiaz.mysoftheaven@gmail.com', 'সম্পূর্ণ ঠিকানা *', NULL, NULL, NULL, NULL, NULL, 'storage/images/admission-applications/1790749096_bEj7UKv26V.png', 'storage/documents/admission-applications/1790749099_4WueiGrK6m.png', 'payment_pending', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 00:18:19', '2026-09-30 01:32:08'),
(2, 'ADM-20260930-J2WKTV', '2026', 'অনলাইন ভর্তি আবেদন', NULL, NULL, '2022-01-01', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Play', NULL, NULL, 'অভিভাবকের তথ্য', NULL, NULL, NULL, 'মাতার নাম', NULL, NULL, NULL, '01767056733', NULL, 'imtiaz.mysoftheaven@gmail.com', 'সম্পূর্ণ ঠিকানা *', NULL, NULL, NULL, NULL, NULL, 'storage/images/admission-applications/1790749169_DLzJYeqGls.png', 'storage/documents/admission-applications/1790749169_TdvEDykawY.pdf', 'pending', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 00:19:29', '2026-09-30 00:19:29'),
(3, 'BLSC-2026-TEST01', '2026', 'তামজিদ হাসান', NULL, NULL, '2015-05-10', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Class 6', NULL, 'দুপচাঁচিয়া সরকারি প্রাথমিক বিদ্যালয়', 'মো: রফিকুল ইসলাম', NULL, NULL, NULL, 'মোছা: নাসরিন আক্তার', NULL, NULL, NULL, '01712345678', NULL, 'tamjid.parent@gmail.com', 'উপজেলা রোড, দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 01:05:53', '2026-09-30 01:30:06'),
(4, 'BLSC-2026-EDMTF', '2026', 'আব্দুর রহমান', NULL, NULL, '2014-03-15', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Class 6', NULL, 'দুপচাঁচিয়া সরকারি প্রাথমিক বিদ্যালয়', 'মো: আনিসুর রহমান', NULL, NULL, NULL, 'মোছা: ফাতেমা বেগম', NULL, NULL, NULL, '01711223344', NULL, 'rahman.family@gmail.com', 'উপজেলা চত্বর, দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, 'uploads/admission/photos/1790759426_U7YrwMOIuh.jpg', NULL, 'pending', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 03:10:26', '2026-09-30 03:10:26'),
(5, 'BLSC-2026-NDNYB', '2026', 'অনলাইন ভর্তি আবেদন', NULL, NULL, '2020-01-01', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Play', NULL, NULL, 'অভিভাবকের তথ্য', NULL, NULL, NULL, 'মাতার নাম', NULL, NULL, NULL, '01767056733', NULL, 'imtiaz.mysoftheaven@gmail.com', 'সম্পূর্ণ বর্তমান ঠিকানা *', NULL, NULL, NULL, NULL, NULL, 'uploads/admission/photos/1790759789_hcVzpN2ZjM.jfif', 'uploads/admission/documents/1790759789_bEQqJyXQgF.pdf', 'payment_pending', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 03:16:29', '2026-09-30 03:18:14'),
(6, 'BLSC-2026-9OTQF', '2026', 'আব্দুর রহমান', NULL, NULL, '2014-03-15', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Class 6', NULL, 'দুপচাঁচিয়া সরকারি প্রাথমিক বিদ্যালয়', 'মো: আনিসুর রহমান', NULL, NULL, NULL, 'মোছা: ফাতেমা বেগম', NULL, NULL, NULL, '01711223344', NULL, 'rahman.family@gmail.com', 'উপজেলা চত্বর, দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, 'uploads/admission/photos/1790761093_ikCa7e2wv5.jpg', NULL, 'approved', 0, NULL, 'general', NULL, 0, NULL, NULL, '2026-09-30 03:38:13', '2026-09-30 03:38:18'),
(7, 'BLSC-2026-81ONM', '2026', 'Tanvir Ahmed', 'তানভীর আহমেদ', 'TANVIR AHMED', '2012-05-15', '20121012345678901', 'male', 'A+', 'Islam', 'Bangladeshi', 'Class 9', 'Science (বিজ্ঞান)', 'Dupchanchia Pilot High School', 'মোঃ রফিকুল ইসলাম', 'MD RAFIQUL ISLAM', '19801234567890', 'B.Sc Engineering', 'মোসাঃ নাসরিন আক্তার', 'MST NASRIN AKTER', '19851234567890', 'M.A', '01712998877', '01812998877', 'tanvir.test@example.com', 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া', 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া', 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া', 'পিতা নিজে অভিভাবক', 'Govt Service, Annual Income 6,50,000 BDT', 'ছোট বোন তাসনিম (Class 6)', 'uploads/admission/photos/1790763337_wEX15dbBk2.png', NULL, 'pending', 0, 5, 'waiting', '2026-09-30 04:15:40', 0, NULL, NULL, '2026-09-30 04:15:37', '2026-09-30 04:15:40'),
(8, 'BLSC-2026-TEST1', '2026', 'Student Test 1', 'শিক্ষার্থী টেস্ট 1', 'STUDENT TEST 1', '2012-01-01', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Class 9', NULL, NULL, 'পিতা টেস্ট 1', NULL, NULL, NULL, 'মাতা টেস্ট 1', NULL, NULL, NULL, '01711000001', NULL, NULL, 'দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved', 1, 1, 'general', '2026-09-30 04:15:40', 1, '2026-09-30 04:15:40', NULL, '2026-09-30 04:15:40', '2026-09-30 04:15:40'),
(9, 'BLSC-2026-TEST2', '2026', 'Student Test 2', 'শিক্ষার্থী টেস্ট 2', 'STUDENT TEST 2', '2012-01-02', NULL, 'female', NULL, NULL, 'বাংলাদেশী', 'Class 9', NULL, NULL, 'পিতা টেস্ট 2', NULL, NULL, NULL, 'মাতা টেস্ট 2', NULL, NULL, NULL, '01711000002', NULL, NULL, 'দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, 4, 'waiting', '2026-09-30 04:15:40', 0, NULL, NULL, '2026-09-30 04:15:40', '2026-09-30 04:15:40'),
(10, 'BLSC-2026-TEST3', '2026', 'Student Test 3', 'শিক্ষার্থী টেস্ট 3', 'STUDENT TEST 3', '2012-01-03', NULL, 'male', NULL, NULL, 'বাংলাদেশী', 'Class 9', NULL, NULL, 'পিতা টেস্ট 3', NULL, NULL, NULL, 'মাতা টেস্ট 3', NULL, NULL, NULL, '01711000003', NULL, NULL, 'দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selected_lottery', 1, 3, 'general', '2026-09-30 04:15:40', 0, NULL, NULL, '2026-09-30 04:15:40', '2026-09-30 04:15:40'),
(11, 'BLSC-2026-TEST4', '2026', 'Student Test 4', 'শিক্ষার্থী টেস্ট 4', 'STUDENT TEST 4', '2012-01-04', NULL, 'female', NULL, NULL, 'বাংলাদেশী', 'Class 9', NULL, NULL, 'পিতা টেস্ট 4', NULL, NULL, NULL, 'মাতা টেস্ট 4', NULL, NULL, NULL, '01711000004', NULL, NULL, 'দুপচাঁচিয়া, বগুড়া', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selected_lottery', 1, 2, 'general', '2026-09-30 04:15:40', 0, NULL, NULL, '2026-09-30 04:15:40', '2026-09-30 04:15:40'),
(12, 'BLSC-2026-HSB64', '2026', 'test1', 'test1', 'test1', '2022-01-01', '11211313123444444', 'female', 'A+', 'Islam', 'Bangladeshi', 'Play', NULL, NULL, 'অভিভাবকের তথ্য', 'পিতার নাম (ইংরেজিতে)', '123123242123', NULL, 'মাতার নাম', 'নাম (ইংরেজিতে)', '432425235534', NULL, '01767056733', '01767056733', 'imtiaz.mysoftheaven@gmail.com', 'বর্তমান ঠিকানা (Present Address) *', 'বর্তমান ঠিকানা (Present Address) *', 'বর্তমান ঠিকানা (Present Address) *', NULL, NULL, NULL, 'uploads/admission/photos/1790764003_pHSSg0PsWy.jfif', 'uploads/admission/documents/1790764003_wiVjfZcAlK.pdf', 'approved', 0, NULL, 'general', NULL, 1, '2026-09-30 04:34:47', NULL, '2026-09-30 04:26:43', '2026-09-30 04:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `admission_fees`
--

CREATE TABLE `admission_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_fees`
--

INSERT INTO `admission_fees` (`id`, `name`, `amount`, `description`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'অনলাইন ভর্তি আবেদন ফি', 500.00, '২০২৬ শিক্ষাবর্ষের ভর্তি আবেদন ফরম ও প্রক্রিয়াকরণ ফি', 1, 1, 0, '2026-09-30 00:41:54', '2026-09-30 00:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `admission_payments`
--

CREATE TABLE `admission_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `admission_application_id` bigint UNSIGNED NOT NULL,
  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `paid_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_payments`
--

INSERT INTO `admission_payments` (`id`, `admission_application_id`, `payment_no`, `amount`, `payment_method`, `account_number`, `transaction_id`, `payment_proof`, `status`, `admin_note`, `paid_at`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'PAY-20260930-YO7ARM', 500.00, 'bkash', '01712345678', 'BK99X88Y77', NULL, 'pending', NULL, '2026-09-30 01:05:57', NULL, '2026-09-30 01:05:57', '2026-09-30 01:05:57'),
(2, 3, 'PAY-20260930-JP9G9O', 500.00, 'sslcommerz', '017XXXXXX78', 'SSLCZ-LIVE-TRX9988', NULL, 'approved', 'Paid via SSLCOMMERZ gateway (bKash-Online Gateway)', '2026-09-30 01:05:58', '2026-09-30 01:06:20', '2026-09-30 01:05:58', '2026-09-30 01:06:20'),
(3, 1, 'PAY-20260930-SDD0LR', 500.00, 'sslcommerz', '01767834658', 'INIT-WMOECFLP', NULL, 'pending', NULL, '2026-09-30 01:06:12', NULL, '2026-09-30 01:06:12', '2026-09-30 01:06:12'),
(4, 3, 'PAY-20260930-JB6TYF', 500.00, 'bkash', '01712345678', 'BK99X88Y77', NULL, 'pending', NULL, '2026-09-30 01:30:01', NULL, '2026-09-30 01:30:01', '2026-09-30 01:30:01'),
(5, 3, 'PAY-20260930-XMEPHV', 500.00, 'sslcommerz', '017XXXXXX78', 'SSLCZ-LIVE-TRX9988', NULL, 'approved', 'Paid via SSLCOMMERZ gateway (bKash-Online Gateway)', '2026-09-30 01:30:02', '2026-09-30 01:30:06', '2026-09-30 01:30:02', '2026-09-30 01:30:06'),
(6, 1, 'PAY-20260930-YUTGWO', 500.00, 'bkash', '01767834658', 'ADM-20260916-Z19ZW0', NULL, 'pending', NULL, '2026-09-30 01:32:07', NULL, '2026-09-30 01:32:07', '2026-09-30 01:32:07'),
(7, 5, 'PAY-20260930-YE4MKI', 500.00, 'bkash', '017678346583', 'ADM-20260916-Z19ZW0', NULL, 'pending', NULL, '2026-09-30 03:18:14', NULL, '2026-09-30 03:18:14', '2026-09-30 03:18:14'),
(8, 6, 'PAY-20260930-YVKIRG', 500.00, 'bkash', '01711223344', 'TRX778899AABB', NULL, 'pending', NULL, '2026-09-30 03:38:16', NULL, '2026-09-30 03:38:16', '2026-09-30 03:38:16'),
(9, 6, 'PAY-20260930-U2GIPJ', 500.00, 'sslcommerz', '400012XXXXXX1234', 'SSLCZ-BANK-998877', NULL, 'approved', 'Paid via SSLCOMMERZ gateway (VISA-CityBank)', '2026-09-30 03:38:17', '2026-09-30 03:38:18', '2026-09-30 03:38:17', '2026-09-30 03:38:18'),
(10, 12, 'PAY-20260930-USTDIY', 500.00, 'nagad', '01767056733', 'ADM-20260916', NULL, 'pending', NULL, '2026-09-30 04:27:34', NULL, '2026-09-30 04:27:34', '2026-09-30 04:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_routines`
--

CREATE TABLE `class_routines` (
  `id` bigint UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Day',
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_routines`
--

INSERT INTO `class_routines` (`id`, `title_bn`, `title_en`, `class`, `section`, `shift`, `academic_year`, `file_path`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'দৈনিক ক্লাস সময়সূচি ২০২৬ - প্রাথমিক শাখা (প্লে হতে ৫ম শ্রেণি)', 'Daily Class Routine 2026 - Primary Section (Play to Class 5)', 'প্রাথমিক শাখা (প্লে - ৫ম)', 'ক ও খ শাখা', 'প্রভাতি', '২০২৬', 'uploads/routines/primary_routine_2026.pdf', 1, 1, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(2, 'দৈনিক ক্লাস রুটিন ২০২৬ - নিম্ন মাধ্যমিক শাখা (৬ষ্ঠ - ৮ম শ্রেণি)', 'Daily Class Schedule 2026 - Junior High Section (Class 6 - 8)', '৬ষ্ঠ - ৮ম শ্রেণি', 'ক, খ ও গ শাখা', 'দিবা', '২০২৬', 'uploads/routines/junior_routine_2026.pdf', 1, 2, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(3, 'ক্লাস সময়সূচি ২০২৬ - মাধ্যমিক ও এসএসসি শাখা (৯ম - ১০ম শ্রেণি)', 'Class Routine 2026 - High School & SSC Section (Class 9 - 10)', '৯ম - ১০ম শ্রেণি', 'বিজ্ঞান ও মানবিক শাখা', 'দিবা', '২০২৬', 'uploads/routines/ssc_routine_2026.pdf', 1, 3, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(4, 'কলেজ শাখা ক্লাস রুটিন ২০২৬ - একাদশ ও দ্বাদশ শ্রেণি', 'College Section Class Routine 2026 - Class 11 & 12', 'একাদশ ও দ্বাদশ শ্রেণি', 'বিজ্ঞান ও মানবিক শাখা', 'দিবা', '২০২৬', 'uploads/routines/college_routine_2026.pdf', 1, 4, '2026-09-30 06:00:01', '2026-09-30 06:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `publish_date` date DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_students` int NOT NULL DEFAULT '0',
  `passed_students` int NOT NULL DEFAULT '0',
  `failed_students` int NOT NULL DEFAULT '0',
  `gpa5_count` int NOT NULL DEFAULT '0',
  `pass_rate` decimal(5,2) NOT NULL DEFAULT '100.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `title_bn`, `title_en`, `exam_name_bn`, `exam_name_en`, `class`, `academic_year`, `publish_date`, `file_path`, `total_students`, `passed_students`, `failed_students`, `gpa5_count`, `pass_rate`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'এসএসসি পরীক্ষার ফলাফল ২০২৫ - শতভাগ সাফল্য অর্জন', 'SSC Examination Results 2025 - 100% Pass Rate', 'এসএসসি পরীক্ষা ২০২৫', 'SSC Examination 2025', '১০ম শ্রেণি (এসএসসি)', '২০২৫', '2025-05-12', 'uploads/results/ssc_result_2025.pdf', 142, 142, 0, 118, 100.00, 1, 1, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(2, 'এইচএসসি পরীক্ষার ফলাফল ২০২৪ - বিয়াম কলেজ শাখা গৌরবোজ্জ্বল সাফল্য', 'HSC Examination Results 2024 - BIAM College Section', 'এইচএসসি পরীক্ষা ২০২৪', 'HSC Examination 2024', 'দ্বাদশ শ্রেণি (এইচএসসি)', '২০২৪', '2024-10-15', 'uploads/results/hsc_result_2024.pdf', 98, 97, 1, 64, 98.98, 1, 2, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(3, 'বার্ষিক পরীক্ষা ফলাফল ২০২৫ - মাধ্যমিক শাখা (৬ষ্ঠ হতে ৯ম শ্রেণি)', 'Annual Examination Result Gazette 2025 - Secondary Section', 'বার্ষিক পরীক্ষা ২০২৫', 'Annual Exam 2025', '৬ষ্ঠ - ৯ম শ্রেণি', '২০২৫', '2025-12-28', 'uploads/results/annual_gazette_2025.pdf', 380, 376, 4, 245, 98.95, 1, 3, '2026-09-30 06:00:01', '2026-09-30 06:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `exam_routines`
--

CREATE TABLE `exam_routines` (
  `id` bigint UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_routines`
--

INSERT INTO `exam_routines` (`id`, `title_bn`, `title_en`, `exam_name_bn`, `exam_name_en`, `class`, `academic_year`, `start_date`, `end_date`, `file_path`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'অর্ধ-বার্ষিক মূল্যায়ন ও পরীক্ষা সময়সূচি ২০২৬', 'Half-Yearly Evaluation & Examination Schedule 2026', 'অর্ধ-বার্ষিক পরীক্ষা ২০২৬', 'Half-Yearly Exam 2026', '৬ষ্ঠ থেকে ১০ম শ্রেণি', '২০২৬', '2026-06-10', '2026-06-25', 'uploads/routines/half_yearly_exam_2026.pdf', 1, 1, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(2, 'বার্ষিক পরীক্ষা ও চূড়ান্ত মূল্যায়ন সময়সূচি ২০২৬', 'Annual Examination & Final Assessment Schedule 2026', 'বার্ষিক পরীক্ষা ২০২৬', 'Annual Examination 2026', 'প্লে থেকে ৯ম শ্রেণি', '২০২৬', '2026-11-20', '2026-12-05', 'uploads/routines/annual_exam_2026.pdf', 1, 2, '2026-09-30 06:00:01', '2026-09-30 06:00:01'),
(3, 'এসএসসি প্রাক-নির্বাচনী ও টেস্ট পরীক্ষা সময়সূচি ২০২৬', 'SSC Pre-Test & Test Selection Examination Schedule 2026', 'এসএসসি টেস্ট পরীক্ষা ২০২৬', 'SSC Test Exam 2026', '১০ম শ্রেণি (এসএসসি পরীক্ষার্থী)', '২০২৬', '2026-10-15', '2026-10-31', 'uploads/routines/ssc_test_routine_2026.pdf', 1, 3, '2026-09-30 06:00:01', '2026-09-30 06:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `image`, `description`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'বিদ্যালয় ক্যাম্পাস ও একাডেমিক ভবন', 'uploads/gallery/slide-1.jpg', 'দুপচাঁচিয়া উপজেলা কমপ্লেক্স সংলগ্ন বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ ক্যাম্পাস', 1, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18'),
(2, 'বার্ষিক ক্রীড়া ও সাংস্কৃতিক প্রতিযোগিতা', 'uploads/gallery/slide-2.jpg', 'শিক্ষার্থীদের মেধা ও ক্রীড়া প্রতিভা বিকাশে বার্ষিক অনুষ্ঠান', 2, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18'),
(3, 'আধুনিক শ্রেণিকক্ষ ও ল্যাব কার্যক্রম', 'uploads/gallery/slide-3.jpg', 'বিজ্ঞানসম্মত ও যুগোপযোগী শিক্ষাদানের শ্রেণিকক্ষ পরিবেশ', 3, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18'),
(4, 'জাতীয় দিবস ও সমাবেশ', 'uploads/gallery/slide-4.jpg', 'দেশপ্রেম ও মূল্যবোধ চর্চায় জাতীয় দিবস উদযাপন', 4, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_03_094012_create_website_settings_table', 1),
(5, '2026_09_03_101239_create_abouts_table', 1),
(6, '2026_09_03_115611_create_notices_table', 1),
(7, '2026_09_03_121529_create_website_visitors_table', 1),
(8, '2026_09_08_113312_create_sliders_table', 1),
(9, '2026_09_09_085649_create_administrations_table', 1),
(10, '2026_09_09_113516_create_mission_visions_table', 1),
(11, '2026_09_16_052540_create_teachers_table', 1),
(12, '2026_09_16_055650_add_type_to_teachers_table', 1),
(13, '2026_09_16_083444_create_galleries_table', 1),
(14, '2026_09_16_083638_create_admissions_table', 1),
(15, '2026_09_16_092407_create_news_table', 1),
(16, '2026_09_16_093545_create_events_table', 1),
(17, '2026_09_16_095915_add_pdf_to_admissions_table', 1),
(18, '2026_09_16_102759_create_admission_applications_table', 1),
(19, '2026_09_16_110643_create_admission_fees_table', 1),
(20, '2026_09_16_110705_create_admission_payments_table', 1),
(21, '2026_09_16_114430_add_payment_pending_status_to_admission_applications_table', 1),
(22, '2026_09_30_160000_add_comprehensive_fields_to_admission_applications_table', 2),
(23, '2026_09_30_170000_create_academic_and_content_modules_tables', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mission_visions`
--

CREATE TABLE `mission_visions` (
  `id` bigint UNSIGNED NOT NULL,
  `mission_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'আমাদের মিশন',
  `mission_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'আমাদের ভিশন',
  `vision_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mission_visions`
--

INSERT INTO `mission_visions` (`id`, `mission_title`, `mission_description`, `vision_title`, `vision_description`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'আমাদের মিশন', 'শিক্ষার্থীদের জ্ঞান অর্জন এবং তার প্রয়োগের ক্ষেত্রে সহায়তা দানই এ প্রতিষ্ঠানের মূল লক্ষ্য। প্রচলিত শিক্ষার গতানুগতিক ধারা থেকে বেরিয়ে এসে শিক্ষার্থীদেরকে আধুনিক, বিজ্ঞানসম্মত ও যুগোপযোগী শিক্ষাদানের মাধ্যমে একবিংশ শতাব্দীর চ্যালেঞ্জ মোকাবেলায় বর্তমান প্রজন্মকে সত্যিকারের মানুষ ও দক্ষ বৈশ্বিক নাগরিক হিসেবে গড়ে তোলা।', 'আমাদের ভিশন', 'ভবিষ্যত প্রজন্মকে তাদের সুপ্ত প্রতিভার যথাযথ বিকাশ ঘটিয়ে শারীরিক, মানসিক, চারিত্রিক, সামাজিক ও ধর্মীয় মূল্যবোধে উদ্বুদ্ধ করে তোলার মাধ্যমে আলোকিত মানুষ গড়ার অনন্য সাধনায় নেতৃত্ব দান করা।', 1, 0, '2026-09-29 23:25:16', '2026-09-29 23:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `short_description`, `description`, `image`, `published_at`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষার সময়সূচি ঘোষণা', 'second-ct-exam-schedule', 'প্লে-গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন পরীক্ষা আগামী ১৬ জুলাই হতে শুরু হবে।', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা আগামী ১৬/০৭/২০২৬ খ্রিঃ তারিখ রোজ: বৃহস্পতিবার হতে শুরু হবে। সংশ্লিষ্ট সকল শিক্ষার্থী ও অভিভাবকদের রুটিন অনুযায়ী প্রস্তুতি গ্রহণের আহ্বান জানানো যাচ্ছে।', 'uploads/sliders/slide-1.jpg', '2026-07-08', 1, 1, 0, '2026-09-29 23:25:18', '2026-09-29 23:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `notice_date` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Academic',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `title_bn`, `title_en`, `description`, `description_bn`, `description_en`, `notice_date`, `file`, `category`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা আগামী ১৬/০৭/২০২৬ খ্রিঃ তারিখ রোজ: বৃহস্পতিবার হতে শুরু হবে। সংশ্লিষ্ট সকল শিক্ষার্থী ও অভিভাবকদের নির্ধারিত সময়সূচি অনুযায়ী উপস্থিত থাকার জন্য বিশেষভাবে অনুরোধ জানানো হচ্ছে।', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা আগামী ১৬/০৭/২০২৬ খ্রিঃ তারিখ রোজ: বৃহস্পতিবার হতে শুরু হবে। সংশ্লিষ্ট সকল শিক্ষার্থী ও অভিভাবকদের নির্ধারিত সময়সূচি অনুযায়ী উপস্থিত থাকার জন্য বিশেষভাবে অনুরোধ জানানো হচ্ছে।', 'প্লে- গ্রুপ হতে পঞ্চম শ্রেণির দ্বিতীয় প্রান্তিক মূল্যায়ন শ্রেণি (C.T) পরীক্ষা আগামী ১৬/০৭/২০২৬ খ্রিঃ তারিখ রোজ: বৃহস্পতিবার হতে শুরু হবে। সংশ্লিষ্ট সকল শিক্ষার্থী ও অভিভাবকদের নির্ধারিত সময়সূচি অনুযায়ী উপস্থিত থাকার জন্য বিশেষভাবে অনুরোধ জানানো হচ্ছে।', '2026-07-08', NULL, 'শিক্ষা', 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:02'),
(2, 'অর্ধ-বার্ষিক, প্রাক-নির্বাচনী এবং বার্ষিক পরীক্ষা সংক্রান্ত নোটিশ', 'অর্ধ-বার্ষিক, প্রাক-নির্বাচনী এবং বার্ষিক পরীক্ষা সংক্রান্ত নোটিশ', 'অর্ধ-বার্ষিক, প্রাক-নির্বাচনী এবং বার্ষিক পরীক্ষা সংক্রান্ত নোটিশ', 'সরকারি সিদ্ধান্ত মোতাবেক ষষ্ঠ, সপ্তম, অষ্টম ও নবম শ্রেণির অর্ধ-বার্ষিক, দশম শ্রেণির প্রাক-নির্বাচনী এবং একাদশ শ্রেণির বার্ষিক পরীক্ষা আগামী ২৮/০৬/২০২৬ খ্রিঃ তারিখ হতে অনুষ্ঠিত হবে। রুটিন অফিস কক্ষে পাওয়া যাবে।', 'সরকারি সিদ্ধান্ত মোতাবেক ষষ্ঠ, সপ্তম, অষ্টম ও নবম শ্রেণির অর্ধ-বার্ষিক, দশম শ্রেণির প্রাক-নির্বাচনী এবং একাদশ শ্রেণির বার্ষিক পরীক্ষা আগামী ২৮/০৬/২০২৬ খ্রিঃ তারিখ হতে অনুষ্ঠিত হবে। রুটিন অফিস কক্ষে পাওয়া যাবে।', 'সরকারি সিদ্ধান্ত মোতাবেক ষষ্ঠ, সপ্তম, অষ্টম ও নবম শ্রেণির অর্ধ-বার্ষিক, দশম শ্রেণির প্রাক-নির্বাচনী এবং একাদশ শ্রেণির বার্ষিক পরীক্ষা আগামী ২৮/০৬/২০২৬ খ্রিঃ তারিখ হতে অনুষ্ঠিত হবে। রুটিন অফিস কক্ষে পাওয়া যাবে।', '2026-06-28', NULL, 'শিক্ষা', 1, 0, '2026-09-29 23:25:18', '2026-09-30 06:00:02'),
(3, '“ইস্টার সানডে” উপলক্ষে বিদ্যালয়ের ছুটি সংক্রান্ত নোটিশ', '“ইস্টার সানডে” উপলক্ষে বিদ্যালয়ের ছুটি সংক্রান্ত নোটিশ', '“ইস্টার সানডে” উপলক্ষে বিদ্যালয়ের ছুটি সংক্রান্ত নোটিশ', '“ইস্টার সানডে” উপলক্ষে আগামী ০৫/০৪/২০২৬ খ্রি: রোজ: রবিবার বিদ্যালয়ে পাঠদানসহ সকল কার্যক্রম বন্ধ থাকবে। পরবর্তী কার্যদিবসে যথারীতি সকল শ্রেণি কার্যক্রম চলবে।', '“ইস্টার সানডে” উপলক্ষে আগামী ০৫/০৪/২০২৬ খ্রি: রোজ: রবিবার বিদ্যালয়ে পাঠদানসহ সকল কার্যক্রম বন্ধ থাকবে। পরবর্তী কার্যদিবসে যথারীতি সকল শ্রেণি কার্যক্রম চলবে।', '“ইস্টার সানডে” উপলক্ষে আগামী ০৫/০৪/২০২৬ খ্রি: রোজ: রবিবার বিদ্যালয়ে পাঠদানসহ সকল কার্যক্রম বন্ধ থাকবে। পরবর্তী কার্যদিবসে যথারীতি সকল শ্রেণি কার্যক্রম চলবে।', '2026-04-12', NULL, 'শিক্ষা', 1, 0, '2026-09-29 23:25:18', '2026-09-30 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_publications`
--

CREATE TABLE `school_publications` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('magazine','publication') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'magazine',
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edition_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edition_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2026',
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_publications`
--

INSERT INTO `school_publications` (`id`, `type`, `title_bn`, `title_en`, `edition_bn`, `edition_en`, `publish_date`, `academic_year`, `cover_image`, `file_path`, `description_bn`, `description_en`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'magazine', 'বার্ষিকী স্কুল ম্যাগাজিন \"প্রভাতি\" - ২০২৫', 'Annual School Magazine \"Provati\" - 2025', '১০ম প্রকাশনা', '10th Edition', '2025-02-21', '২০২৫', 'uploads/publications/magazine_2025_cover.jpg', 'uploads/publications/magazine_2025.pdf', 'শিক্ষার্থীদের রচিত গল্প, কবিতা, প্রবন্ধ, চিত্রাঙ্কন ও বিদ্যালয়ের বার্ষিক শিক্ষা ও ক্রীড়া কার্যক্রমের স্মারক সংকলন।', 'Commemorative compilation of stories, poems, essays, artwork by students, and annual school activities.', 1, 1, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(2, 'publication', 'বার্ষিক তথ্য বিবরণী ও প্রাতিষ্ঠানিক প্রসপেক্টাস ২০২৬', 'Annual Information Brochure & Institutional Prospectus 2026', 'ভর্তি সংস্করণ', 'Admission Edition', '2025-11-01', '২০২৬', 'uploads/publications/prospectus_2026_cover.jpg', 'uploads/publications/prospectus_2026.pdf', 'বিদ্যালয়ের পরিচিতি, শিক্ষকবৃন্দ, একাডেমিক নীতিমালা, সহশিক্ষা কার্যক্রম ও ভর্তি সংক্রান্ত পূর্ণাঙ্গ বিবরণী।', 'Complete institutional prospectus with admissions criteria, rules and faculty profile.', 1, 2, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(3, 'magazine', 'বিজ্ঞান সাময়িকী ও দেয়ালিকা স্মারক ২০২৪', 'Science Journal & Wall Magazine Souvenir 2024', 'বিজ্ঞান ক্লাব বিশেষ সংখ্যা', 'Science Club Special', '2024-09-15', '২০২৪', 'uploads/publications/science_souvenir_2024.jpg', 'uploads/publications/science_souvenir_2024.pdf', 'বিজ্ঞান ক্লাবের শিক্ষার্থীদের উদ্ভাবনী প্রজেক্ট, প্রযুক্তি নিবন্ধ ও বিজ্ঞান মেলা উপলক্ষে বিশেষ দেয়ালিকা প্রকাশনা।', 'Special science journal featuring student research, innovative projects and robotics fair exhibitions.', 1, 3, '2026-09-30 06:00:02', '2026-09-30 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AQgXr6H8dYL62xVp51UE4tTemSKvGVdUYZ7k6scI', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTzdJRnNZTThJNWlnMmNBb2RNQ2V3UVZ2c3BmUUk1UzNqeTR2YmVJZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790857269),
('HJbC4dodsSv3ITIOc6ClF9Lxf5F5gDiQYzgC4zFP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicG1CbG5zdDREQUFmVktSMEtBZUFTeWtnOXJCY2NEb09IdGlVdXlzeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozNDoid2Vic2l0ZV92aXNpdG9yX3RyYWNrZWRfMjAyNi0xMC0wMSI7YjoxO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fX0=', 1790857654),
('nemQrfWgK01ZCiS0aXDqpqAb2WvB5FRS4tYl4lnp', NULL, '127.0.0.1', 'curl/8.13.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVpMWFRBN2VudFNISzRKcTlVdTVKVmVhUWRPT3NCZE5XRHpVdXVkVSI7czozNDoid2Vic2l0ZV92aXNpdG9yX3RyYWNrZWRfMjAyNi0xMC0wMSI7YjoxO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1790857507),
('YVAKoVUROr3Yfm4l6MW9v8tMJK3nFCJjlXW0b7L6', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiT3hZM0J3U0d0YWtSTzd0am5aWDExUE1kVmZHdGdZcjVwbUFReG9LWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790855827),
('yVFQUmmfJlhUerUDRyukWBkHJ6RYSQi1lgoRnTtE', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiRDJMclpwZDZ1MEszdU43dnlaeEMwMkdDMXNUWE9SVnFBZ0tITFhLRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790857268),
('Zbp2KpmJehII8U3c4xCS4Q2dgNG6Ho54gx3faipD', NULL, '127.0.0.1', 'curl/8.13.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMkt2b05yUUx1SXBtOXdzN0dpMHBvRlk0SmlLa2ZxUlgxUGt6MUZzMCI7czozNDoid2Vic2l0ZV92aXNpdG9yX3RyYWNrZWRfMjAyNi0xMC0wMSI7YjoxO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1790855870);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `description`, `image`, `button_text`, `button_url`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ', 'স্বাগতম', 'জ্ঞান, নৈতিকতা ও মানবিক মূল্যবোধের সমন্বয়ে একটি সুন্দর ভবিষ্যৎ গড়ার প্রত্যয়ে আমরা কাজ করছি।', 'uploads/sliders/slide-1.jpg', 'আমাদের কথা', '/about', 1, 1, 0, '2026-09-29 23:25:17', '2026-09-29 23:25:17'),
(2, 'শিক্ষাই শক্তি, আদর্শ মানুষ গড়াই লক্ষ্য', 'গুণগত শিক্ষা', 'শিক্ষার্থীদের মেধা, প্রতিভা ও সৃজনশীলতা বিকাশে আধুনিক বিজ্ঞানসম্মত পাঠদান।', 'uploads/sliders/slide-2.jpg', 'ভর্তি সংক্রান্ত তথ্য', '/admission', 2, 1, 0, '2026-09-29 23:25:17', '2026-09-29 23:25:17'),
(3, 'আধুনিক ও মনোরম শিক্ষার পরিবেশ', 'আমাদের অঙ্গীকার', 'দুপচাঁচিয়া উপজেলা কমপ্লেক্সের শান্ত ও নিরাপদ পরিবেশে মানসম্মত শিক্ষা।', 'uploads/sliders/slide-3.jpg', 'যোগাযোগ করুন', '/contact', 3, 1, 0, '2026-09-29 23:25:17', '2026-09-29 23:25:17'),
(4, 'বিয়াম ফাউন্ডেশন পরিচালিত প্রতিষ্ঠান', 'দুপচাঁচিয়া, বগুড়া', 'অভিজ্ঞ শিক্ষক ও সুশৃঙ্খল প্রশাসনিক ব্যবস্থাপনায় শিক্ষার্থীদের সামগ্রিক উন্নয়ন।', 'uploads/sliders/slide-4.jpg', 'শিক্ষকবৃন্দ', '/teachers', 4, 1, 0, '2026-09-29 23:25:17', '2026-09-29 23:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2026',
  `guardian_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name_bn`, `name_en`, `class`, `section`, `roll_no`, `gender`, `academic_year`, `guardian_name_bn`, `guardian_name_en`, `guardian_phone`, `blood_group`, `photo`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'BLSC-২৬-৬০১', 'নাফিসা আক্তার', 'Nafisa Akter', '৬ষ্ঠ শ্রেণি', 'ক শাখা', '১', 'female', '২০২৬', 'মোঃ জহিরুল ইসলাম', 'Md. Jahirul Islam', '01711223344', 'A+', NULL, 1, 1, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(2, 'BLSC-২৬-৬০২', 'সাদমান সাকিব', 'Sadman Sakib', '৬ষ্ঠ শ্রেণি', 'ক শাখা', '২', 'male', '২০২৬', 'মোঃ মোজাম্মেল হক', 'Md. Mozammel Haque', '01722334455', 'B+', NULL, 1, 2, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(3, 'BLSC-২৬-৭০১', 'ফারিহা জাহান', 'Fariha Jahan', '৭ম শ্রেণি', 'ক শাখা', '১', 'female', '২০২৬', 'আনোয়ার হোসেন', 'Anwar Hossain', '01733445566', 'O+', NULL, 1, 3, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(4, 'BLSC-২৬-৮০১', 'আবির মাহমুদ', 'Abir Mahmud', '৮ম শ্রেণি', 'ক শাখা', '১', 'male', '২০২৬', 'মাহমুদুল হাসান', 'Mahmudul Hasan', '01744556677', 'AB+', NULL, 1, 4, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(5, 'BLSC-২৬-৯০১', 'তানভীর হাসান', 'Tanvir Hasan', '৯ম শ্রেণি', 'ক শাখা', '১', 'male', '২০২৬', 'মোস্তাফিজুর রহমান', 'Mostafizur Rahman', '01755667788', 'A+', NULL, 1, 5, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(6, 'BLSC-২৬-৯০২', 'মারিয়া সুলতানা', 'Maria Sultana', '৯ম শ্রেণি', 'ক শাখা', '২', 'female', '২০২৬', 'আবুল কালাম আজাদ', 'Abul Kalam Azad', '01766778899', 'O+', NULL, 1, 6, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(7, 'BLSC-২৬-১০০১', 'রাকিবুল ইসলাম', 'Rakibul Islam', '১০ম শ্রেণি', 'বিজ্ঞান শাখা', '১', 'male', '২০২৬', 'মোঃ শফিকুল ইসলাম', 'Md. Shafiqul Islam', '01777889900', 'B+', NULL, 1, 7, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(8, 'BLSC-২৬-১০০২', 'সুমাইয়া আক্তার', 'Sumaiya Akter', '১০ম শ্রেণি', 'বিজ্ঞান শাখা', '২', 'female', '২০২৬', 'মোঃ আমিনুর রহমান', 'Md. Aminur Rahman', '01788990011', 'A+', NULL, 1, 8, '2026-09-30 06:00:02', '2026-09-30 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE `student_marks` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2026',
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpa` decimal(4,2) NOT NULL DEFAULT '0.00',
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A+',
  `total_marks` int NOT NULL DEFAULT '0',
  `result_status` enum('PASSED','FAILED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PASSED',
  `marks_details` json DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_marks`
--

INSERT INTO `student_marks` (`id`, `exam_name_bn`, `exam_name_en`, `academic_year`, `class`, `section`, `roll_no`, `student_id`, `student_name_bn`, `student_name_en`, `gpa`, `grade`, `total_marks`, `result_status`, `marks_details`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'বার্ষিক পরীক্ষা ২০২৫', 'Annual Examination 2025', '২০২৫', '৯ম শ্রেণি', 'ক শাখা', '১০১', 'BLSC-2025-0101', 'তানভীর হাসান', 'Tanvir Hasan', 5.00, 'A+', 742, 'PASSED', '[{\"grade\": \"A+\", \"marks\": 172, \"point\": 5, \"subject_bn\": \"বাংলা ১ম ও ২য় পত্র\", \"subject_en\": \"Bangla\"}, {\"grade\": \"A+\", \"marks\": 165, \"point\": 5, \"subject_bn\": \"ইংরেজি ১ম ও ২য় পত্র\", \"subject_en\": \"English\"}, {\"grade\": \"A+\", \"marks\": 94, \"point\": 5, \"subject_bn\": \"সাধারণ গণিত\", \"subject_en\": \"General Mathematics\"}, {\"grade\": \"A+\", \"marks\": 88, \"point\": 5, \"subject_bn\": \"পদার্থবিজ্ঞান\", \"subject_en\": \"Physics\"}, {\"grade\": \"A+\", \"marks\": 91, \"point\": 5, \"subject_bn\": \"রসায়ন\", \"subject_en\": \"Chemistry\"}, {\"grade\": \"A+\", \"marks\": 85, \"point\": 5, \"subject_bn\": \"জীববিজ্ঞান\", \"subject_en\": \"Biology\"}, {\"grade\": \"A+\", \"marks\": 47, \"point\": 5, \"subject_bn\": \"তথ্য ও যোগাযোগ প্রযুক্তি\", \"subject_en\": \"ICT\"}]', 'অসাধারণ ফলাফল। শ্রেণিতে প্রথম স্থান অধিকার করেছে।', '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(2, 'বার্ষিক পরীক্ষা ২০২৫', 'Annual Examination 2025', '২০২৫', '৯ম শ্রেণি', 'ক শাখা', '১০২', 'BLSC-2025-0102', 'মারিয়া সুলতানা', 'Maria Sultana', 4.88, 'A', 705, 'PASSED', '[{\"grade\": \"A+\", \"marks\": 162, \"point\": 5, \"subject_bn\": \"বাংলা ১ম ও ২য় পত্র\", \"subject_en\": \"Bangla\"}, {\"grade\": \"A\", \"marks\": 155, \"point\": 4, \"subject_bn\": \"ইংরেজি ১ম ও ২য় পত্র\", \"subject_en\": \"English\"}, {\"grade\": \"A+\", \"marks\": 89, \"point\": 5, \"subject_bn\": \"সাধারণ গণিত\", \"subject_en\": \"General Mathematics\"}, {\"grade\": \"A+\", \"marks\": 82, \"point\": 5, \"subject_bn\": \"পদার্থবিজ্ঞান\", \"subject_en\": \"Physics\"}, {\"grade\": \"A+\", \"marks\": 87, \"point\": 5, \"subject_bn\": \"রসায়ন\", \"subject_en\": \"Chemistry\"}, {\"grade\": \"A+\", \"marks\": 86, \"point\": 5, \"subject_bn\": \"জীববিজ্ঞান\", \"subject_en\": \"Biology\"}, {\"grade\": \"A+\", \"marks\": 44, \"point\": 5, \"subject_bn\": \"তথ্য ও যোগাযোগ প্রযুক্তি\", \"subject_en\": \"ICT\"}]', 'খুব সুন্দর ফলাফল। উত্তরোত্তর সাফল্য কামনা করি।', '2026-09-30 06:00:02', '2026-09-30 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('teacher','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teacher',
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `name_bn`, `name_en`, `type`, `designation`, `designation_bn`, `designation_en`, `subject`, `subject_bn`, `subject_en`, `qualification_bn`, `qualification_en`, `phone`, `email`, `image`, `sort_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'মোঃ সানাউল হক', 'মোঃ সানাউল হক', 'Md. Sanaul Haque', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সাধারণ', 'সাধারণ', 'General', 'বি.এ, বি.এড', 'B.A, B.Ed', '01753972054', NULL, 'uploads/teachers/sanaul_haque.jpeg', 1, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:57'),
(2, 'রঞ্জন কুমার পাল', 'রঞ্জন কুমার পাল', 'Ranjan Kumar Paul', 'teacher', 'প্রধান শিক্ষক / অধ্যক্ষ', 'প্রধান শিক্ষক / অধ্যক্ষ', 'Principal', 'প্রশাসন', 'প্রশাসন', 'Administration', 'এম.এস.সি (গণিত), এম.এড', 'M.Sc (Mathematics), M.Ed', '01712115282', NULL, 'uploads/teachers/ranjan_kumar_paul.jpg', 2, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:57'),
(3, 'মোঃ জুলফিকার আলী', 'মোঃ জুলফিকার আলী', 'Md. Zulfiker Ali', 'teacher', 'জ্যেষ্ঠ প্রভাষক', 'জ্যেষ্ঠ প্রভাষক', 'Senior Lecturer', 'পদার্থবিজ্ঞান', 'পদার্থবিজ্ঞান', 'Physics', 'এম.এস.সি (পদার্থবিজ্ঞান)', 'M.Sc (Physics)', '01716872097', NULL, 'uploads/teachers/md__zulfiker_ali.jpg', 3, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(4, 'মোঃ নাহিদ আক্তার রাকিব', 'মোঃ নাহিদ আক্তার রাকিব', 'Md. Nahid Aktar Rakib', 'teacher', 'জ্যেষ্ঠ প্রভাষক', 'জ্যেষ্ঠ প্রভাষক', 'Senior Lecturer', 'রসায়ন', 'রসায়ন', 'Chemistry', 'এম.এস.সি (রসায়ন)', 'M.Sc (Chemistry)', '01712467794', NULL, 'uploads/teachers/md__nahid_aktar_rakib.jpg', 4, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(5, 'বিপ্লব কুমার মোহন্ত', 'বিপ্লব কুমার মোহন্ত', 'Biplob Kumar Mohanta', 'teacher', 'জ্যেষ্ঠ প্রভাষক', 'জ্যেষ্ঠ প্রভাষক', 'Senior Lecturer', 'জীববিজ্ঞান', 'জীববিজ্ঞান', 'Biology', 'এম.এস.সি (উদ্ভিদবিজ্ঞান)', 'M.Sc (Botany)', '01761707172', NULL, 'uploads/teachers/biplob_kumar_mohanta.JPG', 5, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(6, 'মোঃ আবু বকর সিদ্দিক', 'মোঃ আবু বকর সিদ্দিক', 'Md. Abu Bakar Siddique', 'teacher', 'জ্যেষ্ঠ প্রভাষক', 'জ্যেষ্ঠ প্রভাষক', 'Senior Lecturer', 'উচ্চতর গণিত', 'উচ্চতর গণিত', 'Higher Mathematics', 'এম.এস.সি (গণিত)', 'M.Sc (Mathematics)', '01723564029', NULL, 'uploads/teachers/md__abu_bakar_siddique.JPG', 6, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(7, 'মোঃ মাহবুব আলম', 'মোঃ মাহবুব আলম', 'Md. Mahbub Alom', 'teacher', 'প্রভাষক', 'প্রভাষক', 'Lecturer', 'ইংরেজি', 'ইংরেজি', 'English', 'এম.এ (ইংরেজি)', 'M.A (English)', '01727590950', NULL, 'uploads/teachers/md__mahbub_alom.jpg', 7, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(8, 'মোঃ আবু সাঈদ', 'মোঃ আবু সাঈদ', 'Md. Abu Shayed', 'teacher', 'প্রভাষক', 'প্রভাষক', 'Lecturer', 'বাংলা', 'বাংলা', 'Bangla', 'এম.এ (বাংলা)', 'M.A (Bangla)', '01719245558', NULL, 'uploads/teachers/md__abu_shayed.JPG', 8, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(9, 'মোঃ তোতা মিয়া', 'মোঃ তোতা মিয়া', 'Md. Tota Mia', 'teacher', 'প্রভাষক', 'প্রভাষক', 'Lecturer', 'অর্থনীতি', 'অর্থনীতি', 'Economics', 'এম.এস.এস (অর্থনীতি)', 'M.S.S (Economics)', '01737335262', NULL, 'uploads/teachers/md__tota_mia.jpg', 9, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(10, 'কুমার বিশ্বজিৎ', 'কুমার বিশ্বজিৎ', 'Kumar Bishwajit', 'teacher', 'জ্যেষ্ঠ সহকারী শিক্ষক', 'জ্যেষ্ঠ সহকারী শিক্ষক', 'Senior Assistant Teacher', 'সাধারণ বিজ্ঞান', 'সাধারণ বিজ্ঞান', 'General Science', 'বি.এসসি (অনার্স), বি.এড', 'B.Sc (Hons), B.Ed', '01710906247', NULL, 'uploads/teachers/kumar_bishwajit.jpg', 10, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(11, 'সুমল চন্দ্র পাল', 'সুমল চন্দ্র পাল', 'Sumal Chandra Paul', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গণিত', 'গণিত', 'Mathematics', 'বি.এসসি, বি.এড', 'B.Sc, B.Ed', '01721713947', NULL, 'uploads/teachers/sumal_chandra_paul.jpg', 11, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(12, 'মোঃ মুসলিম উদ্দিন খান', 'মোঃ মুসলিম উদ্দিন খান', 'Md. Muslim Uddin Khan', 'teacher', 'জ্যেষ্ঠ সহকারী শিক্ষক', 'জ্যেষ্ঠ সহকারী শিক্ষক', 'Senior Assistant Teacher', 'সামাজিক বিজ্ঞান', 'সামাজিক বিজ্ঞান', 'Social Science', 'বি.এ, বি.এড', 'B.A, B.Ed', '01710906538', NULL, 'uploads/teachers/md__muslim_uddin_khan.jpg', 12, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(13, 'মোঃ মশিউর রহমান সুইট', 'মোঃ মশিউর রহমান সুইট', 'Md. Moshiur Rahaman Sweet', 'teacher', 'প্রদর্শক', 'প্রদর্শক', 'Demonstrator', 'বিজ্ঞানাগার', 'বিজ্ঞানাগার', 'Laboratory', 'বি.এসসি', 'B.Sc', '01886373739', NULL, 'uploads/teachers/md__moshiur_rahaman_sweet.jpg', 13, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(14, 'নূরে ফেরদৌসী', 'নূরে ফেরদৌসী', 'Nure Ferdausi', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ইংরেজি', 'ইংরেজি', 'English', 'বি.এ (অনার্স), এম.এ', 'B.A (Hons), M.A', '01755495140', NULL, 'uploads/teachers/nure_ferdausi.jpg', 14, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(15, 'মোঃ আবদুর রাজ্জাক', 'মোঃ আবদুর রাজ্জাক', 'Abdur Razzak', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ইসলাম ও নৈতিক শিক্ষা', 'ইসলাম ও নৈতিক শিক্ষা', 'Islamic Studies', 'কামিল, এম.এ', 'Kamil, M.A', '01740564430', NULL, 'uploads/teachers/abdur_razzak.jpg', 15, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(16, 'মোঃ হাসান', 'মোঃ হাসান', 'Md. Hasan', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গণিত', 'গণিত', 'Mathematics', 'বি.এসসি, বি.এড', 'B.Sc, B.Ed', '01723092283', NULL, 'uploads/teachers/md__hasan.jpg', 16, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(17, 'রিপন কুমার', 'রিপন কুমার', 'Ripon Kumar', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ব্যবসায় শিক্ষা', 'ব্যবসায় শিক্ষা', 'Business Studies', 'বি.কম, এম.কম', 'B.Com, M.Com', '01712330101', NULL, 'uploads/teachers/ripon_kumar.jpg', 17, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(18, 'মোছাঃ আরিফিন ফারজানা', 'মোছাঃ আরিফিন ফারজানা', 'Mst. Arifin Farjana', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলা', 'বাংলা', 'Bangla', 'এম.এ (বাংলা), বি.এড', 'M.A (Bangla), B.Ed', '01741345645', NULL, 'uploads/teachers/mst__arifin_farjana.jpg', 18, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(19, 'মোঃ রাকিবুল হাসান', 'মোঃ রাকিবুল হাসান', 'Rakibul Hasan', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'তথ্য ও যোগাযোগ প্রযুক্তি', 'তথ্য ও যোগাযোগ প্রযুক্তি', 'ICT', 'বি.এসসি (সিএসই)', 'B.Sc (CSE)', '01766046006', NULL, 'uploads/teachers/rakibul_hasan.jpg', 19, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(20, 'মোঃ মেহেদী হাসান', 'মোঃ মেহেদী হাসান', 'Md. Mehadi Hasan', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'শারীরিক শিক্ষা', 'শারীরিক শিক্ষা', 'Physical Education', 'বি.পি.এড', 'B.P.Ed', '01765392846', NULL, 'uploads/teachers/md_mehadi_hasan.JPG', 20, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(21, 'মোছাঃ বিপাশা আক্তার', 'মোছাঃ বিপাশা আক্তার', 'Mst. Bipasha Akhtar', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সাধারণ বিজ্ঞান', 'সাধারণ বিজ্ঞান', 'General Science', 'বি.এসসি', 'B.Sc', '01735402560', NULL, 'uploads/teachers/mst__bipasha_akhtar.jpg', 21, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(22, 'মোঃ কামরুজ্জামান', 'মোঃ কামরুজ্জামান', 'Md. Kamruj Jaman', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'কৃষি শিক্ষা', 'কৃষি শিক্ষা', 'Agriculture', 'বি.এসসি (কৃষি)', 'B.Sc (Agriculture)', '01742407801', NULL, 'uploads/teachers/md__kamruj_jaman.JPG', 22, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(23, 'সাবরিনা মমতাজ', 'সাবরিনা মমতাজ', 'Subruna Momtaz', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গার্হস্থ্য বিজ্ঞান', 'গার্হস্থ্য বিজ্ঞান', 'Home Science', 'এম.এসসি', 'M.Sc', '01751074043', NULL, 'uploads/teachers/subruna_momtaz.jpg', 23, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(24, 'মোছাঃ রাবেয়া খাতুন', 'মোছাঃ রাবেয়া খাতুন', 'Mst. Rabeya Khatun', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলা', 'বাংলা', 'Bangla', 'বি.এ, বি.এড', 'B.A, B.Ed', '01303614247', NULL, 'uploads/teachers/mst__rabeya_khatun.JPG', 24, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(25, 'মোঃ সরোয়ার হোসেন', 'মোঃ সরোয়ার হোসেন', 'Soroar Hosen', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ইংরেজি', 'ইংরেজি', 'English', 'বি.এ (ইংরেজি)', 'B.A (English)', '0130212972', NULL, 'uploads/teachers/soroar_hosen.jpg', 25, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(26, 'উম্মে আরেফা', 'উম্মে আরেফা', 'Umme Arefa', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'চারু ও কারুকলা', 'চারু ও কারুকলা', 'Arts & Crafts', 'বি.এফ.এ', 'B.F.A', '0185324340', NULL, 'uploads/teachers/umme_arefa.JPG', 26, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(27, 'মোঃ সাকিব হোসেন', 'মোঃ সাকিব হোসেন', 'Md. Sakib Hossain', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গণিত', 'গণিত', 'Mathematics', 'বি.এসসি', 'B.Sc', '01736474021', NULL, 'uploads/teachers/md__sakib_hossain.JPG', 27, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(28, 'মোঃ জাহাঙ্গীর আলম মামুন', 'মোঃ জাহাঙ্গীর আলম মামুন', 'Md. Zahangir Alam Mamun', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলাদেশ ও বিশ্বপরিচয়', 'বাংলাদেশ ও বিশ্বপরিচয়', 'Bangladesh & Global Studies', 'এম.এস.এস', 'M.S.S', '01725568924', NULL, 'uploads/teachers/md__zahangir_alam_mamun.jpg', 28, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(29, 'নয়ন চন্দ্র মোহন্ত', 'নয়ন চন্দ্র মোহন্ত', 'Nayan Chandra Mohanta', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বিজ্ঞান', 'বিজ্ঞান', 'Science', 'বি.এসসি', 'B.Sc', '01747832297', NULL, 'uploads/teachers/nayan_chandra_mohanta.jpg', 29, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(30, 'মোঃ আব্দুর রহিম', 'মোঃ আব্দুর রহিম', 'Md. Abdur Rahim', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ধর্ম শিক্ষা', 'ধর্ম শিক্ষা', 'Religious Studies', 'ফাজিল, বি.এড', 'Fazil, B.Ed', '01768909892', NULL, 'uploads/teachers/md__abdur_rahim.jpg', 30, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(31, 'মোছাঃ পারভীন নাহার', 'মোছাঃ পারভীন নাহার', 'Mst. Parvin Naher', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'প্রাথমিক শাখা', 'প্রাথমিক শাখা', 'Primary Section', 'বি.এ, সিইনএড', 'B.A, C-in-Ed', '01777032690', NULL, 'uploads/teachers/mst__parvin_naher.jpg', 31, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(32, 'মোঃ ইন্তাজুর রহমান', 'মোঃ ইন্তাজুর রহমান', 'Md. Intazur Rahman', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলা', 'বাংলা', 'Bangla', 'বি.এ (বাংলা)', 'B.A (Bangla)', '01713820518', NULL, 'uploads/teachers/md__intazur_rahman.jpg', 32, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(33, 'মোঃ জাকির হোসেন', 'মোঃ জাকির হোসেন', 'Md. Zakir Hossain', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সাধারণ', 'সাধারণ', 'General', 'বি.এ', 'B.A', '01737333522', NULL, 'uploads/teachers/md__zakir_hossain.jpg', 33, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(34, 'বিভাষ কুমার', 'বিভাষ কুমার', 'Bibhash Kumer', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বিজ্ঞান', 'বিজ্ঞান', 'Science', 'বি.এসসি', 'B.Sc', '01645435111', NULL, 'uploads/teachers/bibhash_kumer.jpg', 34, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(35, 'পরিমল চন্দ্র দাস', 'পরিমল চন্দ্র দাস', 'Parimol Chandra Das', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গণিত', 'গণিত', 'Mathematics', 'বি.এসসি (গণিত)', 'B.Sc (Mathematics)', '01725675029', NULL, 'uploads/teachers/parimol_chandra_das.JPG', 35, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(36, 'রফিউল লিসিল তালুকদার', 'রফিউল লিসিল তালুকদার', 'Rafiul Lisil Talukder', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ইংরেজি', 'ইংরেজি', 'English', 'বি.এ (ইংরেজি)', 'B.A (English)', '01751514000', NULL, 'uploads/teachers/rafiul_lisil_talukder.jpg', 36, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:58'),
(37, 'মোঃ জাহিদুল ইসলাম', 'মোঃ জাহিদুল ইসলাম', 'Md. Jahidul Islam', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'তথ্যপ্রযুক্তি', 'তথ্যপ্রযুক্তি', 'ICT', 'বি.এসসি', 'B.Sc', '01743367895', NULL, 'uploads/teachers/md__jahidul_islam.jpg', 37, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(38, 'মোঃ রাকিবুল হাসান', 'মোঃ রাকিবুল হাসান', 'Md. Rakibul Hasan', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সামাজিক বিজ্ঞান', 'সামাজিক বিজ্ঞান', 'Social Science', 'বি.এ', 'B.A', '061731616572', NULL, 'uploads/teachers/md__rakibul_hasan.jpg', 38, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(39, 'লাবণী খাতুন', 'লাবণী খাতুন', 'Laboni Khatun', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলা', 'বাংলা', 'Bangla', 'এম.এ', 'M.A', '01568140086', NULL, 'uploads/teachers/laboni_khatun.JPG', 39, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(40, 'মোঃ মেসবাহুল হক', 'মোঃ মেসবাহুল হক', 'Md. Misbahul Haque', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বিজ্ঞান', 'বিজ্ঞান', 'Science', 'বি.এসসি', 'B.Sc', '0175122704', NULL, 'uploads/teachers/md__misbahul_haque.JPG', 40, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(41, 'কাজল চন্দ্র সরকার', 'কাজল চন্দ্র সরকার', 'Kazal Chandra Sarkar', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'চারু ও কারুকলা', 'চারু ও কারুকলা', 'Arts & Crafts', 'বি.এফ.এ', 'B.F.A', '01793780906', NULL, 'uploads/teachers/kazal_chandra_sarkar.JPG', 41, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(42, 'মোঃ ইবনে খায়ের সামিউল ইসলাম তালুকদার', 'মোঃ ইবনে খায়ের সামিউল ইসলাম তালুকদার', 'Md. Ibne Khair Samiul Islam Tokder', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সাধারণ', 'সাধারণ', 'General', 'বি.এ', 'B.A', '01625949525', NULL, 'uploads/teachers/md__ibne_khair_samiul_islam_tokder.jpeg', 42, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(43, 'মোঃ রেজাউল ইসলাম', 'মোঃ রেজাউল ইসলাম', 'Md. Rezaul Islam', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'প্রাথমিক শাখা', 'প্রাথমিক শাখা', 'Primary Section', 'বি.এ, সিইনএড', 'B.A, C-in-Ed', '01760353407', NULL, 'uploads/teachers/md__rezaul_islam.JPG', 43, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(44, 'মোছাঃ সুমনা আক্তার', 'মোছাঃ সুমনা আক্তার', 'Mst. Sumona Aktar', 'teacher', 'প্রভাষক', 'প্রভাষক', 'Lecturer', 'ব্যবসায় শিক্ষা', 'ব্যবসায় শিক্ষা', 'Business Studies', 'এম.কম', 'M.Com', '01733252862', NULL, 'uploads/teachers/mst__sumona_aktar.JPG', 44, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(45, 'মোঃ মাসুদ পারভেজ', 'মোঃ মাসুদ পারভেজ', 'Md. Masud Parvez', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'গণিত', 'গণিত', 'Mathematics', 'বি.এসসি', 'B.Sc', '01739460620', NULL, 'uploads/teachers/md__masud_parvez.jpg', 45, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(46, 'রিপন সরকার', 'রিপন সরকার', 'Ripon Sarker', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বিজ্ঞান', 'বিজ্ঞান', 'Science', 'বি.এসসি', 'B.Sc', '01778334955', NULL, 'uploads/teachers/ripon_sarker.jpg', 46, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(47, 'মোঃ আমিনুল করিম', 'মোঃ আমিনুল করিম', 'Md. Aminul Karim', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'ইংরেজি', 'ইংরেজি', 'English', 'বি.এ (ইংরেজি)', 'B.A (English)', '01739290568', NULL, 'uploads/teachers/md__aminul_karim.JPG', 47, 1, 0, '2026-09-29 23:25:17', '2026-09-30 05:59:59'),
(48, 'মোঃ আব্দুল কুদ্দুস', 'মোঃ আব্দুল কুদ্দুস', 'Md. Abdul Kuddus', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'সাধারণ', 'সাধারণ', 'General', 'বি.এ', 'B.A', '01738780789', NULL, 'uploads/teachers/md__abdul_kuddus.JPG', 48, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(49, 'নিলুফা ইয়াসমিন', 'নিলুফা ইয়াসমিন', 'Nilufa Yesmin', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'বাংলা', 'বাংলা', 'Bangla', 'এম.এ', 'M.A', '01761121972', NULL, 'uploads/teachers/nilufa_yesmin.jpg', 49, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(50, 'মোছাঃ রুমি খাতুন', 'মোছাঃ রুমি খাতুন', 'Most. Rumi Khatun', 'teacher', 'সহকারী শিক্ষক', 'সহকারী শিক্ষক', 'Assistant Teacher', 'প্রাথমিক শাখা', 'প্রাথমিক শাখা', 'Primary Section', 'বি.এ', 'B.A', '01735956482', NULL, 'uploads/teachers/most__rumi_khatun.JPG', 50, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(51, 'গৌতম কুমার পিকে', 'গৌতম কুমার পিকে', 'Goutam Kumar PK', 'staff', 'প্রশাসনিক কর্মকর্তা', 'প্রশাসনিক কর্মকর্তা', 'Administrative Officer', NULL, NULL, NULL, 'এম.এ', 'M.A', '01722152023', NULL, 'uploads/staff/goutam_kumar_pk.jpg', 1, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(52, 'মোঃ রাকিবুল ইসলাম', 'মোঃ রাকিবুল ইসলাম', 'Md. Rakibul Islam', 'staff', 'অফিস সহকারী কাম কম্পিউটার অপারেটর', 'অফিস সহকারী কাম কম্পিউটার অপারেটর', 'Office Assistant Cum Computer Operator', NULL, NULL, NULL, 'স্নাতক', 'Graduate', '01779719775', NULL, 'uploads/staff/md__rakibul_islam.jpg', 2, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(53, 'নিবেদন কুমার পাল', 'নিবেদন কুমার পাল', 'Nibedon Kumar Paul', 'staff', 'হিসাবরক্ষক', 'হিসাবরক্ষক', 'Accountant', NULL, NULL, NULL, 'বি.কম (হিসাববিজ্ঞান)', 'B.Com (Accounting)', '01737611098', NULL, 'uploads/staff/nibedon_kumar_paul.jpg', 3, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(54, 'মোঃ সেলিম রেজা', 'মোঃ সেলিম রেজা', 'Md. Salim Reza', 'staff', 'অফিস সহকারী', 'অফিস সহকারী', 'Office Assistant', NULL, NULL, NULL, 'এইচ.এস.সি', 'H.S.C', '01723128716', NULL, 'uploads/staff/md__salim_reza.JPG', 4, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(55, 'অনুকূল চন্দ্র পাল', 'অনুকূল চন্দ্র পাল', 'Anukul Chandra Paul', 'staff', 'সহকারী হিসাবরক্ষক', 'সহকারী হিসাবরক্ষক', 'Assistant Accountant', NULL, NULL, NULL, 'বি.কম', 'B.Com', '01724621485', NULL, 'uploads/staff/anukul_chandra_paul.jpg', 5, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(56, 'মোঃ আজিজুল হক মন্ডল', 'মোঃ আজিজুল হক মন্ডল', 'Md. Azizul Haque Mondal', 'staff', 'অফিস সহায়ক', 'অফিস সহায়ক', 'Office Support Staff', NULL, NULL, NULL, 'এস.এস.সি', 'S.S.C', '01757972228', NULL, 'uploads/staff/md__azizul_haque_mondal.JPG', 6, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(57, 'মোঃ রেজাউল করিম', 'মোঃ রেজাউল করিম', 'Md. Rezaul Karim', 'staff', 'অফিস সহায়ক', 'অফিস সহায়ক', 'Office Support Staff', NULL, NULL, NULL, 'এস.এস.সি', 'S.S.C', '01722310940', NULL, 'uploads/staff/md__rezaul_karim.jpg', 7, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(58, 'উজ্জ্বল কুমার পাল', 'উজ্জ্বল কুমার পাল', 'Uzzol Kumar Pal', 'staff', 'অফিস সহায়ক', 'অফিস সহায়ক', 'Office Support Staff', NULL, NULL, NULL, 'এস.এস.সি', 'S.S.C', '01761337624', NULL, 'uploads/staff/uzzol_kumar_pal.png', 8, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(59, 'মোঃ আব্দুল হাকিম', 'মোঃ আব্দুল হাকিম', 'Md. Abdul Hakim', 'staff', 'অফিস সহায়ক', 'অফিস সহায়ক', 'Office Support Staff', NULL, NULL, NULL, 'এস.এস.সি', 'S.S.C', '01737161868', NULL, 'uploads/staff/md__abdul_hakim.jpg', 9, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(60, 'মোঃ সাইদুল ইসলাম', 'মোঃ সাইদুল ইসলাম', 'Md. Saidul Islam', 'staff', 'অফিস সহায়ক', 'অফিস সহায়ক', 'Office Support Staff', NULL, NULL, NULL, 'এস.এস.সি', 'S.S.C', '01743316746', NULL, 'uploads/staff/md__saidul_islam.JPG', 10, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(61, 'মোছাঃ আরেফিন আক্তার', 'মোছাঃ আরেফিন আক্তার', 'Mst. Arefin Akter', 'staff', 'আয়া', 'আয়া', 'Ayah', NULL, NULL, NULL, 'অষ্টম শ্রেণি', 'Class 8', '01710971221', NULL, 'uploads/staff/mst__arefin_akter.JPG', 11, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(62, 'মোছাঃ রোকেয়া খাতুন', 'মোছাঃ রোকেয়া খাতুন', 'Mst. Rokeya Khatun', 'staff', 'আয়া', 'আয়া', 'Ayah', NULL, NULL, NULL, 'অষ্টম শ্রেণি', 'Class 8', '01307442983', NULL, 'uploads/staff/mst__rokeya_khatun.jpg', 12, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(63, 'রুমা খাতুন', 'রুমা খাতুন', 'Ruma Khatun', 'staff', 'আয়া', 'আয়া', 'Ayah', NULL, NULL, NULL, 'অষ্টম শ্রেণি', 'Class 8', '01789721203', NULL, 'uploads/staff/ruma_khatun.jpg', 13, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(64, 'মোছাঃ রায়ানুর পারভীন', 'মোছাঃ রায়ানুর পারভীন', 'Mst. Rayanur Parvin', 'staff', 'আয়া', 'আয়া', 'Ayah', NULL, NULL, NULL, 'অষ্টম শ্রেণি', 'Class 8', '01718052163', NULL, 'uploads/staff/mst__rayanur_parvin.jpg', 14, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(65, 'সঞ্জু কুমার বাঁশফোড়', 'সঞ্জু কুমার বাঁশফোড়', 'Sonju Kumar Basfour', 'staff', 'পরিচ্ছন্নতাকর্মী', 'পরিচ্ছন্নতাকর্মী', 'Cleaner', NULL, NULL, NULL, 'প্রাথমিক', 'Primary', '01754612073', NULL, 'uploads/staff/sonju_kumar_basfour.jpg', 15, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(66, 'মোঃ আমজাদ হোসেন সরদার', 'মোঃ আমজাদ হোসেন সরদার', 'Md. Amzad Hossain Sardar', 'staff', 'নৈশপ্রহরী', 'নৈশপ্রহরী', 'Night Guard', NULL, NULL, NULL, 'অষ্টম শ্রেণি', 'Class 8', '01745503685', NULL, 'uploads/staff/md__amzad_hossainsardar.jpg', 16, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00'),
(67, 'শ্রীমতি রাধা রানী', 'শ্রীমতি রাধা রানী', 'Radha Rani', 'staff', 'পরিচ্ছন্নতাকর্মী', 'পরিচ্ছন্নতাকর্মী', 'Cleaner', NULL, NULL, NULL, 'প্রাথমিক', 'Primary', '01335860586', NULL, 'uploads/staff/radha_rani.jpg', 17, 1, 0, '2026-09-29 23:25:17', '2026-09-30 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$raPzR9kojWZEGclvUGk7hu38MPgwHP.mBjsBDSlFDgNdjJ9yceF8G', NULL, '2026-09-30 03:28:37', '2026-09-30 03:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `video_galleries`
--

CREATE TABLE `video_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'অনুষ্ঠান',
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Events',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_galleries`
--

INSERT INTO `video_galleries` (`id`, `title_bn`, `title_en`, `youtube_url`, `video_id`, `category_bn`, `category_en`, `thumbnail`, `description_bn`, `description_en`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ ক্যাম্পাস পরিচিতি ও তথ্যচিত্র', 'BIAM Laboratory School & College Campus Documentary', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'ক্যাম্পাস পরিচিতি', 'Campus Tour', NULL, 'দুপচাঁচিয়া উপজেলা কমপ্লেক্সের মনোরম পরিবেশে অবস্থিত আধুনিক পাঠদান ও সবুজ চত্বর।', 'An overview of our modern educational facilities and vibrant green campus.', 1, 1, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(2, 'বার্ষিক ক্রীড়া প্রতিযোগিতা ও বর্ণাঢ্য সাংস্কৃতিক অনুষ্ঠান', 'Annual Sports Meet & Colorful Cultural Celebration', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'ক্রীড়া ও সংস্কৃতি', 'Sports & Culture', NULL, 'শিক্ষার্থীদের চমৎকার ডিসপ্লে, মার্চপাস্ট এবং মনোরম সংগীত ও নৃত্য পরিবেশনা।', 'Highlights from our annual sports competition, march past and student performances.', 1, 2, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(3, 'আন্তঃবিদ্যালয় বিজ্ঞান মেলা ও রোবোটিক্স প্রদর্শনী', 'Inter-School Science Fair & Robotics Exhibition', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'বিজ্ঞান মেলা', 'Science Fair', NULL, 'তরুণ বিজ্ঞানীদের উদ্ভাবিত স্মার্ট প্রজেক্ট, মডেল এবং বিজ্ঞান গবেষণার ঝলক।', 'Innovative science projects, robotics models and presentations by students.', 1, 3, '2026-09-30 06:00:02', '2026-09-30 06:00:02'),
(4, 'মহান বিজয় দিবস ও জাতীয় শোক দিবস শ্রদ্ধাজ্ঞাপন অনুষ্ঠান', 'Victory Day & National Observance Ceremony', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'জাতীয় দিবস', 'National Events', NULL, 'শহীদদের প্রতি শ্রদ্ধা নিবেদন, জাতীয় পতাকা উত্তোলন ও আলোচনা সভা।', 'Commemorative programs, discussion session and patriotic tribute to our national heroes.', 1, 4, '2026-09-30 06:00:02', '2026-09-30 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `school_name`, `school_name_bn`, `tagline`, `logo`, `favicon`, `address`, `phone`, `mobile`, `email`, `website`, `facebook`, `youtube`, `twitter`, `linkedin`, `footer_text`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'BIAM Laboratory School & College – Dupchanchia, Bogura', 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া', 'আদর্শ মানুষ গড়ার অনন্য প্রতিষ্ঠান', 'uploads/settings/logo.png', 'uploads/settings/favicon.ico', 'উপজেলা কমপ্লেক্স, দুপচাঁচিয়া, বগুড়া', '02-589911213 / 02-589911210', '01309-135255, 01722-152023', 'blsc.dupchanchia@gmail.com', 'https://biamlscdup.edu.bd', 'https://www.facebook.com/dblsc', NULL, NULL, NULL, 'বিয়াম ফাউন্ডেশন, ঢাকা এর সার্বিক পরিচালনায় ছাত্র-ছাত্রীদের মানসম্মত শিক্ষা প্রদানের উদ্দেশ্যে ২০০৭ সালে বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া প্রতিষ্ঠিত হয়। বাস্তব, যুগোপযোগী ও গুণগত মানসম্পন্ন শিক্ষা প্রদানই এ প্রতিষ্ঠানের প্রধান লক্ষ্য।', 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ – দুপচাঁচিয়া, বগুড়া', 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া। EIIN: 135255। গুণগত ও আধুনিক শিক্ষার সমন্বিত প্রতিষ্ঠান।', 'BIAM Laboratory School & College, Dupchanchia, Bogura, বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, বগুড়া, EIIN 135255', '2026-09-29 23:25:16', '2026-10-01 04:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `website_visitors`
--

CREATE TABLE `website_visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `visit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_visitors`
--

INSERT INTO `website_visitors` (`id`, `ip_address`, `user_agent`, `visit_date`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', '2026-09-30', '2026-09-29 22:38:01', '2026-09-29 22:38:01'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:22:32', '2026-09-30 04:22:32'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:23:03', '2026-09-30 04:23:03'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:23:04', '2026-09-30 04:23:04'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:23:05', '2026-09-30 04:23:05'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:23:05', '2026-09-30 04:23:05'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-09-30', '2026-09-30 04:23:30', '2026-09-30 04:23:30'),
(8, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 05:11:49', '2026-09-30 05:11:49'),
(9, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 05:18:40', '2026-09-30 05:18:40'),
(10, NULL, NULL, '2026-09-30', '2026-09-30 05:31:46', '2026-09-30 05:31:46'),
(11, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 05:39:15', '2026-09-30 05:39:15'),
(12, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 06:01:01', '2026-09-30 06:01:01'),
(13, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 06:13:17', '2026-09-30 06:13:17'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', '2026-09-30', '2026-09-30 06:15:15', '2026-09-30 06:15:15'),
(15, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 06:15:23', '2026-09-30 06:15:23'),
(16, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:19:58', '2026-09-30 06:19:58'),
(17, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:19:59', '2026-09-30 06:19:59'),
(18, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:20:00', '2026-09-30 06:20:00'),
(19, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:20:01', '2026-09-30 06:20:01'),
(20, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:20:02', '2026-09-30 06:20:02'),
(21, '127.0.0.1', NULL, '2026-09-30', '2026-09-30 06:20:03', '2026-09-30 06:20:03'),
(22, '127.0.0.1', 'Symfony', '2026-09-30', '2026-09-30 07:11:51', '2026-09-30 07:11:51'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', '2026-10-01', '2026-10-01 01:13:43', '2026-10-01 01:13:43'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-10-01', '2026-10-01 03:06:40', '2026-10-01 03:06:40'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-GB) WindowsPowerShell/5.1.19041.6456', '2026-10-01', '2026-10-01 03:06:41', '2026-10-01 03:06:41'),
(26, '127.0.0.1', 'Go-http-client/1.1', '2026-10-01', '2026-10-01 03:08:55', '2026-10-01 03:08:55'),
(27, '127.0.0.1', 'curl/8.13.0', '2026-10-01', '2026-10-01 05:57:49', '2026-10-01 05:57:49'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', '2026-10-01', '2026-10-01 06:22:31', '2026-10-01 06:22:31'),
(29, '127.0.0.1', 'curl/8.13.0', '2026-10-01', '2026-10-01 06:25:06', '2026-10-01 06:25:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_subjects`
--
ALTER TABLE `academic_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_syllabuses`
--
ALTER TABLE `academic_syllabuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrations`
--
ALTER TABLE `administrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrations_is_delete_status_index` (`is_delete`,`status`),
  ADD KEY `administrations_is_delete_sort_order_index` (`is_delete`,`sort_order`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_applications`
--
ALTER TABLE `admission_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_applications_application_no_unique` (`application_no`);

--
-- Indexes for table `admission_fees`
--
ALTER TABLE `admission_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_payments`
--
ALTER TABLE `admission_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_payments_payment_no_unique` (`payment_no`),
  ADD KEY `admission_payments_admission_application_id_foreign` (`admission_application_id`),
  ADD KEY `admission_payments_transaction_id_index` (`transaction_id`),
  ADD KEY `admission_payments_status_index` (`status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `class_routines`
--
ALTER TABLE `class_routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_routines`
--
ALTER TABLE `exam_routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission_visions`
--
ALTER TABLE `mission_visions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `school_publications`
--
ALTER TABLE `school_publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_id_unique` (`student_id`);

--
-- Indexes for table `student_marks`
--
ALTER TABLE `student_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_galleries`
--
ALTER TABLE `video_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_visitors`
--
ALTER TABLE `website_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `website_visitors_visit_date_index` (`visit_date`),
  ADD KEY `website_visitors_ip_address_index` (`ip_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `academic_subjects`
--
ALTER TABLE `academic_subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `academic_syllabuses`
--
ALTER TABLE `academic_syllabuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `administrations`
--
ALTER TABLE `administrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_applications`
--
ALTER TABLE `admission_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admission_fees`
--
ALTER TABLE `admission_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_payments`
--
ALTER TABLE `admission_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `class_routines`
--
ALTER TABLE `class_routines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_routines`
--
ALTER TABLE `exam_routines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mission_visions`
--
ALTER TABLE `mission_visions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_publications`
--
ALTER TABLE `school_publications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_marks`
--
ALTER TABLE `student_marks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_galleries`
--
ALTER TABLE `video_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_visitors`
--
ALTER TABLE `website_visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_payments`
--
ALTER TABLE `admission_payments`
  ADD CONSTRAINT `admission_payments_admission_application_id_foreign` FOREIGN KEY (`admission_application_id`) REFERENCES `admission_applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
