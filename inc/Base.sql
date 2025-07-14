CREATE DATABASE IF NOT EXISTS partage_objets;
USE partage_objets;


CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre ENUM('Homme','Femme') NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    ville VARCHAR(100),
    mdp VARCHAR(255) NOT NULL, 
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);



CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS etat_retour (
    id_etat INT AUTO_INCREMENT PRIMARY KEY,
    id_emprunt INT NOT NULL,
    etat ENUM('intact','abime') NOT NULL,
    date_retour DATE NOT NULL,
    FOREIGN KEY (id_emprunt) REFERENCES emprunt(id_emprunt) ON DELETE CASCADE
);



INSERT INTO categorie_objet (nom_categorie) VALUES 
('Esthétique'), 
('Bricolage'), 
('Mécanique'), 
('Cuisine');

INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-05-12', 'Femme', 'alice@example.com', 'Antananarivo', 'mdp_hash_1', 'alice.jpg'),
('Bob', '1985-09-23', 'Homme', 'bob@example.com', 'Fianarantsoa', 'mdp_hash_2', 'bob.jpg'),
('Chloe', '1992-11-30', 'Femme', 'chloe@example.com', 'Toamasina', 'mdp_hash_3', 'chloe.jpg'),
('David', '1988-03-15', 'Homme', 'david@example.com', 'Mahajanga', 'mdp_hash_4', 'david.jpg');


-- Pour Alice (id_membre = 1)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Perceuse', 2, 1), ('Tournevis', 2, 1), ('Mixeur', 4, 1),
('Rouge à lèvres', 1, 1), ('Marteau', 2, 1), ('Grille-pain', 4, 1), ('Clé à molette', 3, 1),
('Vernis à ongles', 1, 1), ('Friteuse', 4, 1);

-- Pour Bob (id_membre = 2)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Ponceuse', 2, 2), ('Casserole', 4, 2), ('Brosse à cheveux', 1, 2), ('Tournevis électrique', 2, 2),
('Robot de cuisine', 4, 2), ('Shampooing', 1, 2), ('Scie circulaire', 2, 2), ('Pompe à huile', 3, 2),
('Batteur', 4, 2), ('Clé plate', 3, 2);

-- Pour Chloe (id_membre = 3)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Crème visage', 1, 3), ('Mélangeur', 4, 3), ('Tronçonneuse', 2, 3), ('Rasoir', 1, 3),
('Clé dynamométrique', 3, 3), ('Friteuse air', 4, 3), ('Perceuse sans fil', 2, 3),
('Four', 4, 3), ('Shampoing sec', 1, 3), ('Clé anglaise', 3, 3);

-- Pour David (id_membre = 4)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Marteau piqueur', 2, 4), ('Bouilloire', 4, 4), ('Pâte coiffante', 1, 4), ('Scie sauteuse', 2, 4),
('Cuisinière', 4, 4), ('Clé Allen', 3, 4), ('Epilation cire', 1, 4), ('Tournevis plat', 2, 4),
('Poêle antiadhésive', 4, 4), ('Polisseuse', 1, 4);


/*INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche_cheveux.jpg'),
(2, 'perceuse.jpg'),
(3, 'tournevis.jpg'),
(4, 'mixeur.jpg'),
(5, 'rouge_levres.jpg');*/


INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES 
(2, 2, '2025-07-01', '2025-07-05'),
(3, 3, '2025-07-02', '2025-07-08'),
(5, 4, '2025-07-03', NULL),
(7, 2, '2025-07-01', '2025-07-04'),
(10, 1, '2025-07-04', NULL),
(15, 3, '2025-07-05', '2025-07-10'),
(20, 4, '2025-07-06', NULL),
(22, 1, '2025-07-07', '2025-07-12'),
(28, 2, '2025-07-08', NULL),
(30, 3, '2025-07-09', NULL);


INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES (1, 3, '2025-07-02', NULL);
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES (2, 3, '2025-07-02', NULL);
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES (3, 3, '2025-07-02', NULL);