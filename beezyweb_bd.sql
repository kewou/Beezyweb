

CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP ON *.* TO 'dev'@'localhost';

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `client_id`, `dateReservation`, `etatReservation`) VALUES
(48, 6, '2018-08-27 08:00:00', 'Réserver'),
(49, 6, '2018-08-28 08:00:00', 'Réserver'),
(50, 6, '2018-08-29 08:00:00', 'Réserver'),
(51, 6, '2018-08-27 09:00:00', 'Réserver'),
(52, 6, '2018-08-28 09:00:00', 'Réserver'),
(53, 6, '2018-09-03 08:00:00', 'Réserver'),
(54, 6, '2018-09-03 09:00:00', 'Réserver'),
(55, 6, '2018-09-04 08:00:00', 'Valider'),
(56, 6, '2018-09-04 09:00:00', 'Valider'),
(57, 6, '2018-09-05 08:00:00', 'Valider'),
(58, 6, '2018-09-07 08:00:00', 'Valider'),
(59, 6, '2018-09-07 09:00:00', 'Valider'),
(60, 5, '2018-09-06 08:00:00', 'Valider'),
(61, 5, '2018-09-06 09:00:00', 'Réserver'),
(62, 6, '2018-09-13 08:00:00', 'Valider'),
(63, 6, '2018-09-13 09:00:00', 'Valider'),
(64, 5, '2018-09-13 10:00:00', 'Valider'),
(65, 5, '2018-09-13 11:00:00', 'Réserver'),
(66, 5, '2018-09-14 10:00:00', 'Réserver'),
(67, 5, '2018-09-14 11:00:00', 'Réserver'),
(68, 1, '2018-09-17 08:00:00', 'Fermer'),
(69, 1, '2018-09-18 08:00:00', 'Fermer'),
(70, 1, '2018-09-19 08:00:00', 'Fermer'),
(71, 1, '2018-09-20 08:00:00', 'Fermer'),
(72, 1, '2018-09-17 09:00:00', 'Fermer'),
(73, 1, '2018-09-19 09:00:00', 'Fermer'),
(75, 7, '2018-09-24 11:00:00', 'Réserver'),
(78, 1, '2018-09-28 10:00:00', 'Fermer'),
(79, 1, '2018-09-24 11:00:00', 'Fermer'),
(80, 1, '2018-09-28 11:00:00', 'Fermer'),
(81, 1, '2018-09-25 14:00:00', 'Fermer'),
(82, 1, '2018-09-25 15:00:00', 'Fermer'),
(83, 1, '2018-09-28 08:00:00', 'Fermer'),
(84, 1, '2018-09-28 09:00:00', 'Fermer'),
(85, 1, '2018-09-28 14:00:00', 'Fermer'),
(86, 1, '2018-09-28 15:00:00', 'Fermer'),
(87, 1, '2018-09-28 16:00:00', 'Fermer'),
(88, 1, '2018-09-28 17:00:00', 'Fermer'),
(89, 7, '2018-09-26 10:00:00', 'Valider'),
(92, 7, '2018-09-26 15:00:00', 'Réserver'),
(93, 6, '2018-09-26 11:00:00', 'Réserver'),
(94, 6, '2018-09-26 14:00:00', 'Réserver'),
(95, 6, '2018-09-25 10:00:00', 'Réserver'),
(96, 6, '2018-10-02 08:00:00', 'Réserver'),
(97, 6, '2018-10-09 08:00:00', 'Réserver'),
(98, 6, '2018-09-27 10:00:00', 'Réserver'),
(99, 6, '2018-09-27 14:00:00', 'Réserver'),
(100, 6, '2018-09-26 16:00:00', 'Réserver'),
(101, 1, '2018-10-05 08:00:00', 'Fermer'),
(102, 1, '2018-10-05 09:00:00', 'Fermer'),
(103, 1, '2018-10-17 08:00:00', 'Fermer'),
(104, 1, '2018-10-17 09:00:00', 'Fermer'),
(105, 1, '2018-10-17 10:00:00', 'Fermer'),
(106, 1, '2018-10-16 08:00:00', 'Réserver'),
(107, 1, '2018-10-16 09:00:00', 'Réserver'),
(109, 7, '2018-10-16 14:00:00', 'Réserver'),
(118, 1, '2018-10-18 08:00:00', 'Fermer'),
(120, 7, '2018-10-20 10:00:00', 'Réserver'),
(121, 7, '2018-10-20 11:00:00', 'Réserver'),
(122, 1, '2018-10-18 10:00:00', 'Fermer'),
(123, 1, '2018-10-18 11:00:00', 'Fermer'),
(124, 6, '2018-10-18 14:00:00', 'Réserver'),
(125, 6, '2018-10-18 15:00:00', 'Réserver');



--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `telephone`, `nom`, `prenom`, `solde`, `money`, `moniteur_id`) VALUES
(1, 'joelderrik@gmail.com', 'joelderrik@gmail.com', 'joelderrik@gmail.com', 'joelderrik@gmail.com', 1, '5yjd1f1k3e88osokk0wo8wccso04gsw', '7+Bp/S7kwDZYvgelj8GgdNGKi1Adwaymbpb05C4M/HpNlvVQa0N2GVXnMeVxUpw+03jdHhzmbtmZngqgrWQtZg==', '2018-10-16 21:06:38', 0, 0, NULL, 'kOAUvpu-WIIdaC2tqO-af1neHxPzwXudKCM7bJwT_Xk', NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 0, NULL, 658745893, 'NOUMIA', 'KEWOU', 4, 0, 1),
(3, 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 1, 'pild664lglcw8kc0g84o8wgokcw0kgs', 'Thtu+44VB8kPWm1G79iL74ubNZ+YE96MFEO7cbBkj+PTJ7nxgf73dJG31I9eUZN4AQMR/ck6p6m3guucETwj1Q==', '2018-07-27 08:19:13', 0, 0, NULL, '02waTfxz2Wc0RzkBoNnXvzhlvp0OSV7iN8bG4jyjnAw', NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, 782651265, 'test', 'test', 0, 0, 1),
(4, 'joel.noumia@gfi.fr', 'joel.noumia@gfi.fr', 'joel.noumia@gfi.fr', 'joel.noumia@gfi.fr', 1, 'jk08wzu2y7co84gc0ks4g4cw00kk4o4', '5Ud7xZEXGOOeebijUc7+bd5WWNx6VRds0vpdMQ9/EoahjXDmo7OI2ycBmYg4te+eSX2VvBcNywGs5z6KC03AQQ==', '2018-07-24 11:05:24', 0, 0, NULL, 'KZTgx_xZ0S_bAPk5yzZYLtG8PMkHgv-mj23onQN8xLk', NULL, 'a:0:{}', 0, NULL, 748565265, 'toto', 'toto', 50, 0, 1),
(5, 'joel.noumia@adventiel.fr', 'joel.noumia@adventiel.fr', 'joel.noumia@adventiel.fr', 'joel.noumia@adventiel.fr', 1, 'ptjf4ze8c3kwsocogwc4g0og8kgcsog', 'nKvyu9RmE+X1g+Er8JQLDVaJ3xODD4JM/+SKPOrygs7glFPyqsRAadKv5QsyHnHzp5KCkuGHVMppDdvm0zngrA==', '2018-09-12 11:19:15', 0, 0, NULL, 'fiAS3JIiH0wzPRmdxG00Ocse5Gyy0YpE52A_0aYQBoM', NULL, 'a:0:{}', 0, NULL, 684781541, 'User 2', 'sbeezy', 94, 0, 1),
(6, 'djodjoman@yahoo.fr', 'djodjoman@yahoo.fr', 'djodjoman@yahoo.fr', 'djodjoman@yahoo.fr', 1, 'joltaxb8zo08gsow4wsw8o8ocwog00w', 'PetwFpTwW6ROSOnYcWMAy12xI5jN5H/WH/+44j7BC3VyyuiGVwwcsfhqokuHD9yrdKvWDZYI9d6gILQsSCUb5w==', '2018-10-16 07:57:55', 0, 0, NULL, 'cZ4kJA9T6MStct_NJKpjTdR7P35jYxVtMZOSQA_8dhc', NULL, 'a:0:{}', 0, NULL, 745295145, 'Ashur', 'user', 79, 0, 1),
(7, 'damailas@hotmail.com', 'damailas@hotmail.com', 'damailas@hotmail.com', 'damailas@hotmail.com', 1, 'qf4n6u23on40c8ow4g8wscs88w0kog0', '5Cb1h+jZ9gYazn4f8DfYzMaIPDcDfFlKg+C3on0t7IXtNaRrIbH1xJunPTvyUzv2J4fEzammpJkjjIG6Cs8l6g==', '2018-09-22 12:52:12', 0, 0, NULL, 'dlt4vXM_uTAUkH89fWM_XWNxw5HY9MTlkjJu-YkC0lw', NULL, 'a:0:{}', 0, NULL, 624573985, 'AHMED-ELIE', 'Assita', 190, 0, 1);

