CREATE TABLE sous_categorie(sous_cat_id INTEGER PRIMARY KEY, sous_cat_tab INTEGER NOT NULL, sous_cat_titre VARCHAR(255) NOT NULL);

CREATE TABLE categorie(cat_id INTEGER PRIMARY KEY, cat_titre VARCHAR(255) NOT NULL, sous_cat_id INTEGER NOT NULL, FOREIGN KEY(sous_cat_id) REFERENCES sous_categorie(sous_cat_id));

CREATE TABLE event(event_id INTEGER PRIMARY KEY, event_titre VARCHAR(255) NOT NULL, event_localisation VARCHAR(255) NOT NULL, event_dtstart DATETIME NOT NULL, event_dtend DATETIME NOT NULL, event_description TEXT NOT NULL, event_url VARCHAR(255) NULL);

CREATE TABLE eventCategorie(event_id INTEGER, cat_id INTEGER, FOREIGN KEY(event_id) REFERENCES event(event_id), FOREIGN KEY(cat_id) REFERENCES categorie(cat_id));
