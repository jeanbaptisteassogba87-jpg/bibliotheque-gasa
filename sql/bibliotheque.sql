CREATE DATABASE IF NOT EXISTS bibliotheque_gasa;
USE bibliotheque_gasa;

CREATE TABLE admins(
    id int PRIMARY KEY AUTO_INCREMENT, 
    nom varchar(50) NOT NULL,
    email varchar(50) NOT NULL UNIQUE,
    mot_de_passe varchar(255) NOT NULL
);

CREATE TABLE livres(
    id_livre int PRIMARY KEY AUTO_INCREMENT,
    titre varchar(120) NOT NULL,
    auteur varchar(50) NOT NULL,
    categorie varchar(30) NOT NULL,
    annee int NOT NULL,
    couverture varchar(255) NOT NULL,
    summary varchar(255) NOT NULL
);

CREATE TABLE membres(
    id_membre int PRIMARY KEY AUTO_INCREMENT,
    nom varchar(50) NOT NULL,
    email varchar(50) NOT NULL UNIQUE,
    telephone varchar(15) NOT NULL,
    created_at date
);

CREATE TABLE emprunts(
    id_emprunt int PRIMARY KEY AUTO_INCREMENT,
    id_livre int,
    id_membre int,
    date_emprunt date,
    date_prevue date,
    date_retour date,
    FOREIGN KEY(id_livre) REFERENCES livres(id_livre),
    FOREIGN KEY(id_membre) REFERENCES membres(id_membre)
);


INSERT INTO admins (nom, email, mot_de_passe) 
VALUES (
    'Jean-Baptiste', 
    'admin@gasa.com', 
    '$2y$12$DIPKojCuc1cm7Qi/mD0ra.HU9FQdSrr0cv84QyDMu.lBbltODPfVi'
);

INSERT INTO membres (nom, email, telephone, created_at) VALUES
('Alice Dossou', 'alice@example.com', '97000000', '2026-01-15'),
('Bob Houngbo', 'bob@example.com', '97111111', '2026-02-20');


INSERT INTO livres (titre, auteur, categorie, annee, couverture, summary) VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', 'Jeunesse', 1943, 'petit_prince.jpg', 'Un conte poétique et philosophique.'),
('L''Étranger', 'Albert Camus', 'Roman', 1942, 'etranger.jpg', 'Un chef-d''œuvre sur l''absurde.'),
('Une si longue lettre', 'Mariama Bâ', 'Roman', 1979, 'longue_lettre.jpg', 'Un classique de la littérature africaine.'),
('Apprendre PHP', 'Jean Dupont', 'Informatique', 2023, 'php.jpg', 'Un guide pour débuter en PHP.');