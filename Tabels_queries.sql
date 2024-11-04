CREATE DATABASE Bibliotheque;
USE Bibliotheque;

CREATE TABLE Auteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    biographie TEXT,
    photo VARCHAR(255)
);

CREATE TABLE Livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    auteur_id INT,
    disponibilite BOOLEAN DEFAULT 1, -- Default to available (1)
    date_retour DATE,
    FOREIGN KEY (auteur_id) REFERENCES Auteurs(id) ON DELETE SET NULL
);



