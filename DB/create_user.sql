-- CREATION DES UTILISATEURS POUR LA BASE DE DONNEES --


-- creation d'un role qui possède des droits de bases --
CREATE ROLE myDefault with NOSUPERUSER NOCREATEDB NOCREATEROLE;	
	
-- creation des utilisateurs appartenant au groupe --	
CREATE USER Admin WITH PASSWORD 'Admin' in group myDefault;
CREATE USER Redacteur WITH PASSWORD 'Redacteur' in group myDefault;
CREATE USER Inscrit WITH PASSWORD 'Inscrit' in group myDefault;
CREATE USER Visiteur WITH PASSWORD 'Visiteur' in group myDefault;

-- ajout droit de connexion à la base de donnees du blog --
GRANT CONNECT on database "DB_Blog" to Admin;
GRANT CONNECT on database "DB_Blog" to Redacteur;
GRANT CONNECT on database "DB_Blog" to Inscrit;
GRANT CONNECT on database "DB_Blog" to Visiteur; 

-- ajout des différents droits sur les tables pour le role et les differents utilisateurs --
grant select on all tables in schema public  to myDefault;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO myDefault;

grant insert on table commentaire to Inscrit;

grant insert on table commentaire to Redacteur;
grant insert on table article to Redacteur;
grant update on table article to Redacteur;

grant insert on table commentaire to Admin;
grant insert on table article to Admin;
grant update on table article to Admin;
grant delete on table commentaire to Admin;
grant delete on table article to Admin;