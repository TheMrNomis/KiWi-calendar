rm testdb.db
echo '[makedatabase]'
cat makedatabase.sql | sqlite3 testdb.db
echo '[populate database]'
cat populateDatabase.sql | sqlite3 testdb.db
