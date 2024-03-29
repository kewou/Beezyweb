ALTER TABLE reservation ADD duree INT NOT NULL, CHANGE datereservation date DATETIME NOT NULL, CHANGE etatreservation etat VARCHAR(255) NOT NULL;


CREATE TABLE preferences (id INT AUTO_INCREMENT NOT NULL, $nombreResaMaxParSemaine INT NOT NULL, $nombreResaMaxParJour INT NOT NULL, PRIMARY KEY(id)) 
DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE entreprise ADD preferences_id INT DEFAULT NULL;
ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA607CCD6FB7 FOREIGN KEY (preferences_id) REFERENCES preferences (id);
CREATE INDEX IDX_D19FA607CCD6FB7 ON entreprise (preferences_id);

ALTER TABLE reservation ADD dateFin DATETIME NOT NULL, DROP duree, CHANGE date dateDebut DATETIME NOT NULL;

ALTER TABLE user CHANGE solde solde DOUBLE PRECISION DEFAULT NULL;

ALTER TABLE entreprise ADD prixResa INT NOT NULL;

ALTER TABLE reservation ADD dtype VARCHAR(255) NOT NULL, ADD typeCoiffure VARCHAR(255) DEFAULT NULL;


/////   PAS ENCORE MEP  ///


/////   Commit : beezyweb_2023_start  ///
UPDATE `entreprise` SET `nom` = 'HairRashCut' WHERE `entreprise`.`id` = 1;
UPDATE `user` SET `entreprise_id` = '1', `administrateur_id` = '24' WHERE `user`.`id` = 1;
