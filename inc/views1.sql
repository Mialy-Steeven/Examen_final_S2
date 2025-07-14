CREATE OR REPLACE VIEW  v_list_object As 
SELECT o.*,e.date_retour 
from objet o 
Join emprunt e on o.id_objet=e.id_objet;

CREATE OR REPLACE VIEW v_liste_objet_categorie AS
SELECT co.nom_categorie, o.nom_objet,e.date_retour,m.nom,o.id_objet
FROM objet o 
JOIN categorie_objet co ON o.id_categorie = co.id_categorie
JOIN emprunt e ON o.id_objet = e.id_objet
JOIN membre m ON m.id_membre=e.id_membre
ORDER BY co.nom_categorie, o.nom_objet;

CREATE OR REPLACE VIEW v_lis_categorie AS 
SELECT *
FROM categorie_objet ;

CREATE OR REPLACE VIEW v_recherche_cat_jiab AS 
SELECT o.nom_objet,co.nom_categorie
FROM objet o 
JOIN categorie_objet co ON co.id_categorie=o.id_categorie 
WHERE co.nom_categorie='Bricolage';


CREATE OR REPLACE VIEW v_recherche_cat_dispo
SELECT o.nom_objet,co.nom_categorie,e.date_retour
FROM objet o 
JOIN emprunt e ON e.id_objet=o.id_objet 
JOIN categorie_objet co ON co.id_categorie=o.id_categorie 
WHERE co.nom_categorie='Cuisine' AND e.date_retour IS NOT NULL; 
