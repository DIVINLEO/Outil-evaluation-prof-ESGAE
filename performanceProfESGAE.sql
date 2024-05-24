-- Database: PerfprofESGAE

-- DROP DATABASE IF EXISTS "PerfprofESGAE";

CREATE DATABASE "PerfprofESGAE"
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;
	
	-- Création de la table Professeurs
CREATE TABLE Professeurs (
    ID_professeur INT PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    Matière_enseignée VARCHAR(255),
    Date_embauche DATE
);

-- Création de la table Classes
CREATE TABLE Classes (
    ID_classe INT PRIMARY KEY,
    Nom_classe VARCHAR(255),
    Niveau INT,
    Année_scolaire VARCHAR(10),
    ID_professeur INT,
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
);

-- Création de la table Élèves
CREATE TABLE Élèves (
    ID_élève INT PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    Filiére VARCHAR(255),
	Année_scolaire VARCHAR(255),
    Date_naissance DATE
    
);

-- Création de la table Notes
CREATE TABLE Notes (
    ID_note INT PRIMARY KEY,
    ID_élève INT,
    ID_professeur INT,
    Matière VARCHAR(255),
    Note FLOAT,
    Date_note DATE,
    FOREIGN KEY (ID_élève) REFERENCES Élèves(ID_élève),
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
);

-- Création de la table Assiduité
CREATE TABLE Assiduité (
    ID_assiduité INT PRIMARY KEY,
    ID_élève INT,
    ID_professeur INT,
    Date DATE,
    Présent_absent VARCHAR(10),
    Motif_absence VARCHAR(255),
    FOREIGN KEY (ID_élève) REFERENCES Élèves(ID_élève),
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
);

-- Création de la table Évaluations des compétences pédagogiques
CREATE TABLE Évaluations_competences_pédagogiques (
    ID_évaluation INT PRIMARY KEY,
    ID_professeur INT,
    Note_globale FLOAT,
    Commentaires TEXT,
    Date_evaluation DATE,
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
);

-- Création de la table Formations professionnelles
CREATE TABLE Formations_professionnelles (
    ID_formation INT PRIMARY KEY,
    ID_professeur INT,
    Nom_formation VARCHAR(255),
    Date_formation DATE,
    Durée INT, -- En heures par exemple
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
);

-- Création de la table Ressources pédagogiques
CREATE TABLE Ressources_pédagogiques (
    ID_ressource INT PRIMARY KEY,
    Type_ressource VARCHAR(50),
    Description TEXT,
    ID_professeur INT,
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
    
);

-- Création de la table Charge administrative
CREATE TABLE Charge_administrative (
    ID_charge_administrative INT PRIMARY KEY,
    ID_professeur INT,
    Type_tâche_administrative VARCHAR(255),
    Date DATE,
    Durée INT, -- En heures par exemple
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
    -- Autres champs ici
);

-- Création de la table Rétention des professeurs
CREATE TABLE Rétention_professeurs (
    ID_retention INT PRIMARY KEY,
    ID_professeur INT,
    Date_entrée DATE,
    Date_sortie DATE,
    Raison_départ TEXT,
    FOREIGN KEY (ID_professeur) REFERENCES Professeurs(ID_professeur)
   
);

CREATE TABLE Activités_extra_scolaires (
    ID_activité INT PRIMARY KEY,
    Nom_activité VARCHAR(255),
    Description TEXT
);

CREATE TABLE Participation_activités (
    ID_participation INT PRIMARY KEY,
    ID_élève INT,
    ID_activité INT,
    Date_participation DATE,
    FOREIGN KEY (ID_élève) REFERENCES Élèves(ID_élève),
    FOREIGN KEY (ID_activité) REFERENCES Activités_extra_scolaires(ID_activité)
   
);

select*from professeurs
select*from classes
select*from Élèves
select*from notes
select*from Assiduité
select*from Évaluations_competences_pédagogiques
select*from Formations_professionnelles
select*from Ressources_pédagogiques
select*from Charge_administrative
select*from Rétention_professeurs
select*from Activités_extra_scolaires
select*from Participation_activités

ALTER TABLE Élèves RENAME COLUMN Filiére TO Filière;


-- Insertion de données dans la table Professeurs
INSERT INTO Professeurs (ID_professeur, Nom, Prénom, Matière_enseignée, Date_embauche)
VALUES
    (1, 'Mukendi', 'Jean', 'Sql server', '2020-09-01'),
    (2, 'Kabongo', 'Marie', 'Entrepreunariat', '2018-07-15'),
    (3, 'Tshibangu', 'Paul', 'Français', '2019-03-10'),
    (4, 'Mbuyi', 'Sophie', 'Excel', '2021-01-20')
    ;

-- Insertion de données dans la table Classes (sélection aléatoire des professeurs pour chaque classe)
INSERT INTO Classes (ID_classe, Nom_classe, Niveau, Année_scolaire, ID_professeur)
VALUES
    (1, 'Première année ', 1, '2024-2025', 1),
    (2, 'Deuxième année ', 2, '2024-2025', 2),
    (3, 'Troisième année ', 3, '2024-2025', 3),
    (4, 'Quatrième année ', 4, '2024-2025', 4)
    ;

-- Insertion de données dans la table Élèves (les noms et prénoms sont fictifs)
INSERT INTO Élèves (ID_élève, Nom, Prénom, Filière, Année_scolaire, Date_naissance)
VALUES
    (1, 'Kabila', 'Joseph', 'Programmation', 'Première année', '2010-05-12'),
    (2, 'Tshisekedi', 'Félix', 'Anapro', 'Deuxième année', '2009-11-24'),
    (3, 'Lumumba', 'Patrice', 'LPABD', 'Troisième année', '2008-07-02'),
    (4, 'MBOUYA', 'Emmanuel', 'LPASR', 'Troisième année', '2004-05-09'),
    (5, 'Massamba', 'Daniella', 'LPGL', 'Troisième année', '2002-02-10'),
    (6, 'Samba', 'Chris', 'LPABD', 'Troisième année', '2005-08-19'),
    (7, 'Kasa-Vubu', 'Joseph', 'Banque et finance', 'Quatrième année', '2000-08-26')
	;


-- Insertion de données dans la table Notes (sélection aléatoire des élèves et professeurs pour chaque note)
INSERT INTO Notes (ID_note, ID_élève, ID_professeur, Matière, Note, Date_note)
VALUES
    (1, 1, 1, 'Sql server', 15.5, '2024-04-10'),
    (2, 2, 2, 'Entrepreunariat', 14.2, '2024-04-11'),
    (3, 3, 3, 'Français', 12.8, '2024-04-12'),
    (4, 4, 4, 'Excel', 16.0, '2024-04-13')
    ;

-- Insertion de données dans la table Assiduité (sélection aléatoire des élèves et professeurs pour chaque enregistrement)
INSERT INTO Assiduité (ID_assiduité, ID_élève, ID_professeur, Date, Présent_absent, Motif_absence)
VALUES
    (1, 1, 1, '2024-04-10', 'Présent', NULL),
    (2, 2, 2, '2024-04-11', 'Présent', NULL),
    (3, 3, 3, '2024-04-12', 'Absent', 'Maladie'),
    (4, 4, 4, '2024-04-13', 'Présent', NULL)
    ;

-- Insertion de données dans la table Évaluations des compétences pédagogiques (sélection aléatoire des professeurs pour chaque évaluation)
INSERT INTO Évaluations_competences_pédagogiques (ID_évaluation, ID_professeur, Note_globale, Commentaires, Date_evaluation)
VALUES
    (1, 1, 4.3, 'Bonne maîtrise des concepts', '2024-05-01'),
    (2, 2, 4.6, 'Très bon communicateur', '2024-05-02'),
    (3, 3, 4.0, 'Utilise des exemples concrets', '2024-05-03'),
    (4, 4, 4.5, 'Encourage la participation des élèves', '2024-05-04')
    ;

-- Insertion de données dans la table Formations professionnelles (sélection aléatoire des professeurs pour chaque formation)
INSERT INTO Formations_professionnelles (ID_formation, ID_professeur, Nom_formation, Date_formation, Durée)
VALUES
    (1, 1, 'Pédagogie active', '2023-06-15', 16),
    (2, 2, 'Nouvelles technologies en enseignement', '2023-07-20', 24),
    (3, 3, 'Gestion de classe', '2023-08-25', 12),
    (4, 4, 'Évaluation des apprentissages', '2023-09-30', 20)
    ;

-- Insertion de données dans la table Ressources pédagogiques (sélection aléatoire des professeurs pour chaque ressource)
INSERT INTO Ressources_pédagogiques (ID_ressource, Type_ressource, Description, ID_professeur)
VALUES
    (1, 'Document', 'Documentation de SQL Server 2019', 2),
    (2, 'Document', 'Introduction à l entrepreunariat', 3),
    (3, 'Document', 'Lecture du Roman les misérable de victor hugo', 4),
    (4, 'Document', 'Guide de demarrage rapide pour Excel', 1)
    ;

-- Insertion de données dans la table Charge administrative (sélection aléatoire des professeurs pour chaque tâche administrative)
INSERT INTO Charge_administrative (ID_charge_administrative, ID_professeur, Type_tâche_administrative, Date, Durée)
VALUES
    (1, 1, 'Réunion de département', '2024-05-05', 2),
    (2, 2, 'Préparation du programme scolaire', '2024-05-06', 4),
    (3, 3, 'Révision des examens', '2024-05-07', 3),
    (4, 4, 'Entretien avec les parents', '2024-05-08', 1)
    -- Ajoutez les autres lignes ici...
    ;

-- Insertion de données dans la table Rétention des professeurs (sélection aléatoire des professeurs pour chaque enregistrement)
INSERT INTO Rétention_professeurs (ID_retention, ID_professeur, Date_entrée, Date_sortie, Raison_départ)
VALUES
    (1, 1, '2018-09-01', NULL, NULL),
    (2, 2, '2019-07-15', NULL, NULL),
    (3, 3, '2017-03-10', '2023-01-15', 'Démission'),
    (4, 4, '2020-01-20', NULL, NULL)
    ;
	
INSERT INTO Participation_activités (ID_participation, ID_élève, ID_activité, Date_participation)
VALUES
(1, 1, 1, '2024-05-15'),
(2, 2, 2, '2024-05-16'),
(3, 3, 3, '2024-05-17'),
(4, 4, 4, '2024-05-18'),
(5, 5, 5, '2024-05-19');



INSERT INTO Activités_extra_scolaires (ID_activité, Nom_activité, Description)
VALUES
(1, 'Football', 'Matchs de football hebdomadaires'),
(2, 'Théâtre', 'Atelier de théâtre'),
(3, 'Musique', 'Cours de musique'),
(4, 'Peinture', 'Atelier de peinture'),
(5, 'Danse', 'Cours de danse');


