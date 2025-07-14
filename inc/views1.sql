CREATE OR REPLACE VIEW  v_list_object As 
SELECT o.*,e.date_retour from objet o Join emprunt e on o.id_objet=e.id_objet;

CREATE OR REPLACE VIEW v_liste_objet_categorie AS
SELECT co.nom_categorie, o.nom_objet,e.date_retour,m.nom
FROM objet o 
JOIN categorie_objet co ON o.id_categorie = co.id_categorie
JOIN emprunt e ON o.id_objet = e.id_objet
JOIN membre m ON m.id_membre=e.id_membre
ORDER BY co.nom_categorie, o.nom_objet;
