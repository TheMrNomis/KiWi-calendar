CREATE TABLE sous_categorie(sous_cat_id INTEGER PRIMARY KEY, sous_cat_titre VARCHAR(255));

CREATE TABLE categorie(cat_id INTEGER PRIMARY KEY, cat_titre VARCHAR(255), sous_cat_id INTEGER, FOREIGN KEY(sous_cat_id) REFERENCES sous_categorie(sous_cat_id));

CREATE TABLE event(event_id INTEGER PRIMARY KEY, event_titre VARCHAR(255), event_localisation VARCHAR(255), event_dtstart DATETIME, event_dtend DATETIME, event_description TEXT, event_url VARCHAR(255));

CREATE TABLE eventCategorie(event_id INTEGER, cat_id INTEGER, FOREIGN KEY(event_id) REFERENCES event(event_id), FOREIGN KEY(cat_id) REFERENCES categorie(cat_id));
