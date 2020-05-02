-- CREATION BASE DE DONNEES BLOG --

CREATE DATABASE DB_Blog;

DROP TABLE IF EXISTS COMMENTAIRE;
DROP TABLE IF EXISTS ARTICLE;
DROP TABLE IF EXISTS UTILISATEUR;

CREATE TABLE Utilisateur (
    id_utilisateur SERIAL,
    pseudo_utilisateur varchar(30),
    mdp_utilisateur varchar(30),
    role varchar(20),
    CONSTRAINT PK_UTILISATEUR PRIMARY KEY(id_utilisateur)
);

CREATE TABLE Article (
    id_article serial,
    lib_article varchar(500),
    CONSTRAINT PK_article PRIMARY KEY (id_article)
);


CREATE TABLE Commentaire (
    id_commentaire serial,
    commentaire varchar(200),
    id_article integer,
    CONSTRAINT PK_COMMENTAIRE PRIMARY KEY (id_commentaire),
    CONSTRAINT FK_COMMENTAIRE_ARTICLE FOREIGN KEY (id_article) REFERENCES ARTICLE (id_article) ON DELETE CASCADE
);

-- INSERTION --

INSERT INTO UTILISATEUR (pseudo_utilisateur, mdp_utilisateur, role) VALUES 
('AdminTest', 'Admin123', 'admin'),
('RedacteurTest', 'Redacteur123', 'redacteur'),
('InscritTest', 'Inscrit123', 'inscrit'),
('InscritTest2', 'Inscrit123', 'inscrit');

INSERT INTO ARTICLE (lib_article) VALUES 
('premiere article test'),
('deuxieme article test');