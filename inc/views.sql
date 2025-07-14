CREATE OR REPLACE VIEW v_list_object AS 
SELECT o.*, e.date_retour, i.nom_image ,i.id_image
FROM objet o 
LEFT JOIN emprunt e ON o.id_objet = e.id_objet
LEFT JOIN images_objet i ON i.id_objet = o.id_objet;


CREATE OR REPLACE VIEW v_liste_objet_categorie AS
SELECT co.nom_categorie, o.nom_objet, e.date_retour, m.nom, i.nom_image,i.id_image
FROM objet o 
JOIN categorie_objet co ON o.id_categorie = co.id_categorie
LEFT JOIN emprunt e ON o.id_objet = e.id_objet
LEFT JOIN membre m ON m.id_membre = e.id_membre
LEFT JOIN images_objet i ON i.id_objet = o.id_objet
ORDER BY co.nom_categorie, o.nom_objet;


CREATE OR REPLACE VIEW v_lis_categorie AS 
SELECT *
FROM categorie_objet ;



