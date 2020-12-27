-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : beezyweb.net.mysql.service.one.com:3306
-- Généré le : mar. 07 juil. 2020 à 14:41
-- Version du serveur :  10.3.23-MariaDB-1:10.3.23+maria~bionic
-- Version de PHP : 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `beezyweb_net`
--
CREATE DATABASE IF NOT EXISTS `beezyweb_net` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `beezyweb_net`;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typePlageHoraire` int(11) NOT NULL,
  `preferences_id` int(11) DEFAULT NULL,
  `prixResa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `typePlageHoraire`, `preferences_id`, `prixResa`) VALUES
(1, 'Mark_Coiffeur', 2, NULL, 20),
(2, 'Grande_Delle_Auto_Ecole', 1, NULL, 40);

-- --------------------------------------------------------

--
-- Structure de la table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `$nombreResaMaxParSemaine` int(11) NOT NULL,
  `$nombreResaMaxParJour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateFin` datetime NOT NULL,
  `dtype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typeCoiffure` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `client_id`, `dateDebut`, `etat`, `dateFin`, `dtype`, `typeCoiffure`) VALUES
(553, 25, '2020-04-15 11:30:00', 'Valider', '2020-04-15 12:00:00', 'resacoiffure', 'Simple'),
(554, 25, '2020-04-17 12:30:00', 'Valider', '2020-04-17 13:00:00', 'resacoiffure', 'Complexe'),
(555, 25, '2020-04-17 13:00:00', 'Valider', '2020-04-17 13:30:00', 'resacoiffure', 'NA'),
(556, 24, '2020-04-15 12:30:00', 'Fermer', '2020-04-15 12:30:00', 'resacoiffure', 'Simple'),
(557, 24, '2020-04-15 13:30:00', 'Fermer', '2020-04-15 13:30:00', 'resacoiffure', 'Simple'),
(558, 24, '2020-04-15 13:30:00', 'Fermer', '2020-04-15 13:30:00', 'resacoiffure', 'Simple'),
(560, 24, '2020-04-17 14:30:00', 'Fermer', '2020-04-17 14:30:00', 'resacoiffure', 'Simple'),
(561, 25, '2020-04-14 14:00:00', 'Valider', '2020-04-14 14:30:00', 'resacoiffure', 'Simple'),
(562, 26, '2020-04-16 10:00:00', 'Valider', '2020-04-16 11:00:00', 'resaautoecole', NULL),
(563, 26, '2020-04-17 08:00:00', 'Valider', '2020-04-17 09:00:00', 'resaautoecole', NULL),
(564, 27, '2020-04-17 12:00:00', 'Valider', '2020-04-17 13:00:00', 'resaautoecole', NULL),
(565, 27, '2020-04-15 12:00:00', 'Valider', '2020-04-15 13:00:00', 'resaautoecole', NULL),
(567, 28, '2020-04-16 11:00:00', 'Valider', '2020-04-16 12:00:00', 'resaautoecole', NULL),
(570, 29, '2020-04-17 17:00:00', 'Valider', '2020-04-17 17:30:00', 'resacoiffure', 'Simple'),
(572, 24, '2020-04-20 11:00:00', 'Fermer', '2020-04-20 11:00:00', 'resacoiffure', 'Simple'),
(573, 24, '2020-04-21 11:30:00', 'Fermer', '2020-04-21 11:30:00', 'resacoiffure', 'Simple'),
(574, 25, '2020-04-16 13:30:00', 'Réserver', '2020-04-16 14:00:00', 'resacoiffure', 'Simple'),
(576, 25, '2020-04-28 11:30:00', 'Valider', '2020-04-28 12:00:00', 'resacoiffure', 'Simple'),
(582, 25, '2020-04-24 12:00:00', 'Réserver', '2020-04-24 12:30:00', 'resacoiffure', 'Complexe'),
(584, 24, '2020-04-23 11:00:00', 'Fermer', '2020-04-23 11:00:00', 'resacoiffure', 'Simple'),
(585, 29, '2020-05-05 11:30:00', 'Valider', '2020-05-05 12:00:00', 'resacoiffure', 'Simple'),
(588, 30, '2020-05-07 11:30:00', 'Réserver', '2020-05-07 12:00:00', 'resacoiffure', 'Simple'),
(592, 32, '2020-04-21 08:00:00', 'Réserver', '2020-04-21 09:00:00', 'resaautoecole', NULL),
(593, 32, '2020-04-21 10:00:00', 'Valider', '2020-04-21 11:00:00', 'resaautoecole', NULL),
(594, 25, '2020-04-30 11:30:00', 'Réserver', '2020-04-30 12:00:00', 'resacoiffure', 'Complexe'),
(595, 25, '2020-04-30 12:00:00', 'Réserver', '2020-04-30 12:30:00', 'resacoiffure', 'NA'),
(596, 24, '2020-04-29 08:00:00', 'Valider', '2020-04-29 08:30:00', 'resacoiffure', 'Simple'),
(597, 1, '2020-04-29 08:00:00', 'Fermer', '2020-04-29 08:00:00', 'resaautoecole', NULL),
(598, 24, '2020-04-30 09:00:00', 'Valider', '2020-04-30 09:30:00', 'resacoiffure', 'Simple'),
(599, 27, '2020-04-28 09:00:00', 'Valider', '2020-04-28 10:00:00', 'resaautoecole', NULL),
(600, 15, '2020-05-26 08:00:00', 'Fermer', '2020-05-26 08:00:00', 'resaautoecole', NULL),
(601, 15, '2020-05-26 09:00:00', 'Fermer', '2020-05-26 09:00:00', 'resaautoecole', NULL),
(602, 33, '2020-06-06 08:00:00', 'Valider', '2020-06-06 09:00:00', 'resaautoecole', NULL),
(603, 27, '2020-06-04 10:00:00', 'Valider', '2020-06-04 11:00:00', 'resaautoecole', NULL),
(604, 15, '2020-06-05 12:00:00', 'Fermer', '2020-06-05 12:00:00', 'resaautoecole', NULL),
(605, 15, '2020-06-05 13:00:00', 'Fermer', '2020-06-05 13:00:00', 'resaautoecole', NULL),
(607, 25, '2020-07-07 11:30:00', 'Réserver', '2020-07-07 12:00:00', 'resacoiffure', 'Simple');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `moniteur_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `telephone` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `solde` double DEFAULT NULL,
  `money` double DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `administrateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `moniteur_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `telephone`, `nom`, `prenom`, `solde`, `money`, `entreprise_id`, `administrateur_id`) VALUES
(1, 1, 'joelderrik@gmail.com', 'joelderrik@gmail.com', 'joelderrik@gmail.com', 'joelderrik@gmail.com', 1, '5yjd1f1k3e88osokk0wo8wccso04gsw', '7+Bp/S7kwDZYvgelj8GgdNGKi1Adwaymbpb05C4M/HpNlvVQa0N2GVXnMeVxUpw+03jdHhzmbtmZngqgrWQtZg==', '2020-05-26 15:21:19', 'kOAUvpu-WIIdaC2tqO-af1neHxPzwXudKCM7bJwT_Xk', NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 614785258, 'Dupont', 'Jean-Claude', 17, 0, 2, 1),
(15, 15, 'stephaneromain@hotmail.fr', 'stephaneromain@hotmail.fr', 'stephaneromain@hotmail.fr', 'stephaneromain@hotmail.fr', 1, 'B46Mlp.eSQrSOUcElZWGvMehebyMjD9YGUvJiqhQh1I', 'Dk3vXoHY35ODCEb5LydFw/qO5YWE5gdZhjM3AAUM1hSj0tSjZFvQqLnwAZKZZUuIYhA7s3TRyJj2aD72I+LzdA==', '2020-07-06 23:31:05', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 662216169, 'Romain', 'Stephane', 34, 0, 2, 24),
(21, 15, 'ouardi@writeme.com', 'ouardi@writeme.com', 'ouardi@writeme.com', 'ouardi@writeme.com', 1, 'teasrNoyRUM/W2Kyz9x3Wg6GO82HMGISA/V3sYJ1E4w', 'j2N1NWo0U4P0DM9+sBJP0HMGyxm0T7AjS7NV+fOn9Xjy48UKO1yw8RLPLO9duQ87Xtm8W/4LainDgQK/kKiyZA==', '2019-11-12 18:42:39', NULL, NULL, 'a:0:{}', 627809416, 'Yousra', 'Elmouhssine', 6, 0, 2, 15),
(22, 15, 'azzazohra@hotmail.com', 'azzazohra@hotmail.com', 'azzazohra@hotmail.com', 'azzazohra@hotmail.com', 1, 'xbMe5RQ.9GMAMkV2ehOvyN9/FIxevHmVHhg3MMqIXEU', 'CqbEcNsc9eDQHzTrBGPoNYTDZar3Y2l1KJwny5JIRGSLRHgEjrf07vqGcIXyR0TSqLJkTgpwtyEVbt3uegD2jQ==', '2019-11-28 17:31:29', NULL, NULL, 'a:0:{}', 624315535, 'El mouhssine', 'Yousra', 0, 0, 2, 15),
(23, 15, 'kevinconflant59@gmail.com', 'kevinconflant59@gmail.com', 'kevinconflant59@gmail.com', 'kevinconflant59@gmail.com', 1, 'aNTzqT8Ec719KuhgXLwqNNzcBSVjqTYzGea/MJbYLVE', 'N6dmCZ5jrueT2JwrzZ1zh05YWdWn2vD5WfFP+P35N0Puz3nbhfYnIafxNY7ELTxseFsPmNchYI/extLv9p/RGg==', '2019-11-28 17:53:44', NULL, NULL, 'a:0:{}', 764143327, 'Conflant', 'Kevin', 10, 0, 2, 15),
(24, 24, 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 'kewou.noumia@gmail.com', 1, 'h4P4m5Vb4LoIoQeGsAzYgIh9NUurq21V2zxb.FJaIwc', 'BhiQMZOT82tiT80vEfGNsQ52/RwpJ1aem+K2u8s1yiIQS+66iU1RcchI5sPxn1fpCm4YXny0TlQVevkv71Leug==', '2020-04-14 17:48:42', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 615475869, 'NOUMIA', 'Derrik', 36.5, 0, 1, 24),
(25, 24, 'beezyweb.net@beezyweb.net', 'beezyweb.net@beezyweb.net', 'beezyweb.net@beezyweb.net', 'beezyweb.net@beezyweb.net', 1, 'uOJyT04GAYQMTRlj7Z/RLiz15NgDudVbsZVliCHwGSk', '6zTvSOuwquhVktkwXycUf0/oKVtDdLP+mGnRyJqQMXHPj5Ivmng3qnvkZQqRAr4OnocNapJ2YeBEAEwbA0KruA==', '2020-07-06 23:31:48', NULL, NULL, 'a:0:{}', 719252652, 'Zozo', 'ntote', 43, 0, 1, 24),
(26, 15, 'charlesmbadji@yahoo.fr', 'charlesmbadji@yahoo.fr', 'charlesmbadji@yahoo.fr', 'charlesmbadji@yahoo.fr', 1, 'R8PpN..OXbdnUshLGTe8w4aXpy7Z/pS.1hPL2jnLXBk', 'CBg3g3INO0DYEKYhIDK6yG9zruEMOJ4NXWL0PaHa6L1fZFF8b0jGf8P9utnTbiriK80qyuhS1uoy/vfsxVqTaQ==', '2020-04-13 08:40:09', NULL, NULL, 'a:0:{}', 615664758, 'Charles', 'peggy', 0, 0, 2, 15),
(27, 15, 'damailas@hotmail.com', 'damailas@hotmail.com', 'damailas@hotmail.com', 'damailas@hotmail.com', 1, 'XTmCVWOxEvTd6gBNTTPCRu1x.H2/4Q25i./pVgyNqsE', '0sN2h40dOGlJ88553D/JkXxrhvxlaewKg9r/HEybqPfIi67PIIdNZMBC2Qzp4yQplg4dxXVUxdKsbQDB/7xM1Q==', '2020-04-14 15:55:35', NULL, NULL, 'a:0:{}', 624573985, 'AHMED-ELIE', 'ASSITA', -2, 0, 2, 15),
(28, 15, 'dacleuantonin@gmail.com', 'dacleuantonin@gmail.com', 'dacleuantonin@gmail.com', 'dacleuantonin@gmail.com', 1, '1YvrQozRtCsaW0Cv/vo3r.6MesuIq2dMvncSLKXuCY4', 'weta2XeuGgTUwrkAwyf2RaOlNDQ8PtSOpNniaDllFCviqXE9s1Jwi/ney2/8TEmzAEddfjRVC2AqmVuth1QQjA==', '2020-04-13 19:23:40', NULL, NULL, 'a:0:{}', 770114847, 'Dacleu', 'Antonin', 1, 0, 2, 15),
(29, 24, 'noumiajp@gmail.com', 'noumiajp@gmail.com', 'noumiajp@gmail.com', 'noumiajp@gmail.com', 1, 'fn2RcM2mA5zz8D64aknmXcaK0igjx.JrFMQzXycBZjM', '7JrWEr7w9qeU4GN2AyuEvOF+FYM+2BwfFzruPg2blJSk3GB+Lefgbv47pqqUmtQi3Aq0snbhqf6N/D0RC0u1VQ==', '2020-04-13 19:10:46', NULL, NULL, 'a:0:{}', 614125874, 'Nguebissie', 'Noumia', 1, 0, 1, 24),
(30, 24, 'damailas10@gmail.com', 'damailas10@gmail.com', 'damailas10@gmail.com', 'damailas10@gmail.com', 1, 'L1omnSlv2I3MbwhaETwnWgUYpbOA84cy9.j4U5.7NQc', 'z7UzKdA8yPocNHn3ahh0BAttB+L0dAvzzbXS6cDAW7tbwTdnTtc0S53WX+S2QwvAoCmS0Y1ChvpJLdvP3sg8uA==', '2020-04-14 18:16:49', NULL, NULL, 'a:0:{}', 624573984, 'AHMED ELIE', 'Assita', 1, 0, 1, 24),
(31, 24, 'domasco96@yahoo.com', 'domasco96@yahoo.com', 'domasco96@yahoo.com', 'domasco96@yahoo.com', 1, 'iiw54SpQ859raVOKgywgNCrgP3UPz4YKLyOENzsGFlM', '3YQgYVA7/PRhbO0CjMxBT9kz9IPTs4DWPT+8xmJY1qnFX+WFxlEa5uAFk116T3PtE0vu76TAGouyWfnN4ixQBg==', '2020-04-14 22:48:32', NULL, NULL, 'a:0:{}', 751320932, 'David', 'Mark', 3, 0, 1, 24),
(32, 15, 'stunaz@gmail.com', 'stunaz@gmail.com', 'stunaz@gmail.com', 'stunaz@gmail.com', 1, '3n6ONQ6j/WF.vlttuOGe5eh3EbTy6HdYEuPbYMMBHUI', '4DLvXsgiQN57I0v4hR02vDSHFFL7bMqicjGdw0YteesghGk9K4iuRff6YtHxdSgkEPOBCy2rfXlTS0xJp3jaMQ==', '2020-04-20 22:55:51', NULL, NULL, 'a:0:{}', 615664756, 'Stommy', 'Didier', 0, 0, 2, 15),
(33, 15, 'dhoifir.a@hotmail.fr', 'dhoifir.a@hotmail.fr', 'dhoifir.a@hotmail.fr', 'dhoifir.a@hotmail.fr', 1, '2h0eQL2k9vDsyb5fxQfJaEspiQ2g5NdHph/kBIfAms8', 'ws8gPsLQFdLCA2W/DxTRtteGtaqZoWCJv5GD3t6hF3dkWfG8+7TIX7b56k2lt0FoBWk8begqvkw7nwj4BJW94A==', '2020-06-03 15:36:52', NULL, NULL, 'a:0:{}', 695399626, 'Abdou', 'Dhoifir', 0, 0, 2, 15),
(34, 15, 'oliviasiako@gmail.com', 'oliviasiako@gmail.com', 'oliviasiako@gmail.com', 'oliviasiako@gmail.com', 1, 'YL1sNBwbxikxA.eswHcDg74iRTyb2Yik/K3GzqehWX0', 'y3URutXCIjBpkQr1w1FCswawo/6kgISxmWLrxJfDRgxyDZE1dSH8XsPJZxOI4h058U62djocxkiaSp2vkZw+UA==', '2020-06-06 22:06:13', NULL, NULL, 'a:0:{}', 755818580, 'Siako', 'Olivia', 1, 0, 2, 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D19FA607CCD6FB7` (`preferences_id`);

--
-- Index pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C8495519EB6921` (`client_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  ADD KEY `IDX_8D93D649A234A5D3` (`moniteur_id`),
  ADD KEY `IDX_8D93D649A4AEAFEA` (`entreprise_id`),
  ADD KEY `IDX_8D93D6497EE5403C` (`administrateur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=608;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA607CCD6FB7` FOREIGN KEY (`preferences_id`) REFERENCES `preferences` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495519EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6497EE5403C` FOREIGN KEY (`administrateur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_8D93D649A234A5D3` FOREIGN KEY (`moniteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_8D93D649A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
