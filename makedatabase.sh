rm testdb.db
cat makedatabase.sql | sqlite3 testdb.db
cat populateDatabase.sql | sqlite3 testdb.db
