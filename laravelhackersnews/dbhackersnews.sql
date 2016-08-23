-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 aug 2016 om 21:05
-- Serverversie: 10.1.10-MariaDB
-- PHP-versie: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhackersnews`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikels`
--

CREATE TABLE `artikels` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikels`
--

INSERT INTO `artikels` (`id`, `title`, `value`, `link`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'New song: DJ Snake ft. Justin Bieber - Let Me Love You', 10, 'https://www.youtube.com/watch?v=SMs0GnYze34', 1, NULL, '2016-08-23 16:53:59', '2016-08-23 16:53:59'),
(2, 'Sporza-commentatoren vergeten chaos in Rio door topmedailles', 5, 'http://sporza.be/cm/sporza/Rio-2016/1.2749919', 1, NULL, '2016-08-23 16:54:33', '2016-08-23 16:54:33'),
(3, 'Vindt alles over Laravel controllers', -3, 'https://laravel.com/docs/5.2/controllers', 2, NULL, '2016-08-23 16:58:11', '2016-08-23 16:58:11'),
(4, 'Tips om kinderen voldoende water te laten drinken tijdens de hittegolf', 0, 'http://www.hln.be/hln/nl/33/Fit-Gezond/article/detail/2838002/2016/08/23/Tips-om-kinderen-voldoende-water-te-laten-drinken-tijdens-de-hittegolf.dhtml', 3, NULL, '2016-08-23 17:00:21', '2016-08-23 17:00:21'),
(5, 'De mooiste zwem plakken in open lucht', 0, 'http://www.hln.be/hln/nl/37342/Vrije-tijd/article/detail/2832677/2016/08/23/Neem-een-duik-om-verkoeling-te-zoeken-de-mooiste-zwemplekken-in-openlucht.dhtml', 3, '2016-08-23 17:03:03', '2016-08-23 17:02:53', '2016-08-23 17:03:03');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `artikel_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `artikel_id`, `comment`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wauw super!! prachtig nummer ', 1, NULL, '2016-08-23 16:55:14', '2016-08-23 16:55:14'),
(2, 1, 'Leuk!', 1, NULL, '2016-08-23 16:56:18', '2016-08-23 16:56:18'),
(3, 1, 'Mmmh dit is toch niet mijn smaak', 2, NULL, '2016-08-23 16:57:37', '2016-08-23 16:57:37'),
(4, 2, 'Toch 6 medailles behaalt', 2, NULL, '2016-08-23 16:59:01', '2016-08-23 16:59:01'),
(5, 1, 'Feesten', 3, NULL, '2016-08-23 17:01:32', '2016-08-23 17:01:32'),
(6, 1, 'Slechste nummer ooit', 3, '2016-08-23 17:01:56', '2016-08-23 17:01:50', '2016-08-23 17:01:56'),
(7, 2, 'Het waren echte topprestaties dat we hebben gezien', 3, NULL, '2016-08-23 17:03:43', '2016-08-23 17:03:43');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_11_134006_create_artikels_table', 1),
('2016_08_11_134355_create_comments_table', 1),
('2016_08_11_134800_create_votes_table', 1),
('2016_08_11_162710_create_moderators_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `moderators`
--

CREATE TABLE `moderators` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arne Van Bavel', 'arne.vanbavel@hotmail.com', '$2y$10$6nHpd0U2xZWA/BuC9POmPuOnQET4n8i1p.V15uciJ91PN6pW.yPhC', 'SciqcpOjQxscQr3cW410xzfVECOHYOiWhCxLm0UO8pp4ageunisG13qd2cZC', '2016-08-23 16:53:40', '2016-08-23 16:56:32'),
(2, 'Barry', 'test@hotmail.Com', '$2y$10$FFbYWeWoGH0XVe5W4dPjCuDr3eTZmFMcK5XMkqeOmRD7Jp0dPI9Ju', 'z6HXdvNbofCvXmbvbg0doGuqdHlqL11l0CiTvXybzE0UBN9TwUpREn272zaT', '2016-08-23 16:57:07', '2016-08-23 16:59:12'),
(3, 'Jolanda koers', 'test2@hotmail.com', '$2y$10$AEjI4OjmPJDgtslccE2KGuiXGjIMvJ1TNyY1sW7xR62MoxCpmJDNC', NULL, '2016-08-23 16:59:29', '2016-08-23 16:59:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `votes`
--

CREATE TABLE `votes` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `artikel_id` int(10) UNSIGNED NOT NULL,
  `up` tinyint(1) NOT NULL DEFAULT '1',
  `down` tinyint(1) NOT NULL DEFAULT '1',
  `algeklikt` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikels_user_id_foreign` (`user_id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_artikel_id_foreign` (`artikel_id`);

--
-- Indexen voor tabel `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderators_user_id_foreign` (`user_id`);

--
-- Indexen voor tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexen voor tabel `votes`
--
ALTER TABLE `votes`
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_artikel_id_foreign` (`artikel_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikels`
--
ALTER TABLE `artikels`
  ADD CONSTRAINT `artikels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_artikel_id_foreign` FOREIGN KEY (`artikel_id`) REFERENCES `artikels` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `moderators`
--
ALTER TABLE `moderators`
  ADD CONSTRAINT `moderators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_artikel_id_foreign` FOREIGN KEY (`artikel_id`) REFERENCES `artikels` (`id`),
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
