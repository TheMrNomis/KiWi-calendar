INSERT INTO sous_categorie(sous_cat_id, sous_cat_tab, sous_cat_title) VALUES(0,0, "Conférences, évènements");
INSERT INTO sous_categorie(sous_cat_id, sous_cat_tab, sous_cat_title) VALUES(1,0, "Clubs, Associations");

INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 0, "[IN] Imagerie numérique");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 1, "[IS] Ingénierie pour la santé");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 2, "[MAT] Matériaux");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 3, "[SI] Systèmes d'information");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 4, "[T&R] Télécoms et réseaux");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(0, 5, "[TICB] Domotique");

INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 6, "Isati");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 7, "Club Dorothée");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 8, "Club de golf");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 9, "Club Maté");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 10, "Club Beurre Salé");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(1, 11, "Association de défence des kakapos");

INSERT INTO sous_categorie(sous_cat_id, sous_cat_tab, sous_cat_title) VALUES(2,1, "Conférences");
INSERT INTO sous_categorie(sous_cat_id, sous_cat_tab, sous_cat_title) VALUES(3,1, "Autres");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(2, 12, "Labfab");
INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(2, 13, "Inria");

INSERT INTO categorie(sous_cat_id, cat_id, cat_title) VALUES(3, 14, "Autres");


INSERT INTO event VALUES (1, "Porte Ouverte Inria", "INRIA Rennes", "2015-12-10", "2015-12-10", "L'Inria ouvre ses portes aux étudiants !", "http://po.irisa.fr/", "http://www.lirmm.fr/DEMAR/images/inria_corpo_rvb.jpg", "contact@irisa.fr");
INSERT INTO event VALUES (2, "Inpol", "ESIR, Rennes", "2015-12-10 09:00:00", "2015-12-10 12:00:00", "Cours d'innovation et politique", NULL, "https://esir.univ-rennes1.fr/sites/esir.univ-rennes1.fr/themes/esir/logo.png", NULL);
INSERT INTO event VALUES (3, "Festival film animation", "Bruz, France", "2015-12-07 09:00:00", "2015-12-13 20:00:00", "Festival national du film d'animation", "http://festival-film-animation.fr/", "http://festival-film-animation.fr/cache/com_unitehcarousel/films_en_bretagne_logo_site_150x150_exact_images-2015.jpg", "communication@afca.asso.fr");
INSERT INTO event VALUES (4, "Noel", "Esir, Rennes, France", "2015-12-17 19:00:00", "2015-12-13 23:00:00", "Soirée de Noel de l'ISATI dans le hall de l'ESIR !", "http://isati.istic.univ-rennes1.fr/", "http://isati.istic.univ-rennes1.fr/assets/images/isati.png", "communication@isati.org");
INSERT INTO event VALUES (5, "Noel", "Village du pere noel, Finlande", "2015-12-23 19:00:00", "2015-12-25 23:00:00", "Soirée de Noel", "http://jepasseunnoeltropswagi.net", "https://images.duckduckgo.com/iu/?u=http%3A%2F%2Ffarahlafee.f.a.pic.centerblog.net%2F074e7416.gif&f=1", "papa@noel.org");
INSERT INTO event VALUES (6, "Nouvel An", "Tour Eiffel, Paris", "2015-12-31 19:00:00", "2016-01-01 23:00:00", "Nouvel an", "http://jepasseunnouvelantropswagi.net", "https://images.duckduckgo.com/iu/?u=http%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.M5cb70d969f54c82b06e77edc0c11e81eo0%26pid%3D15.1&f=1", "");

INSERT INTO eventCategorie(event_id, cat_id) VALUES(1, 13);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 0);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 1);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 2);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 3);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 4);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(2, 5);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(3, 13);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(4, 6);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(5, 14);
INSERT INTO eventCategorie(event_id, cat_id) VALUES(6, 14);
