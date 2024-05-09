#!/bin/bash
set -e

# Function to wait for the MySQL server to be ready
function mysql_ready() {
    mysqladmin ping --host=db --user=root --password=$MYSQL_ROOT_PASSWORD > /dev/null 2>&1
}

while !(mysql_ready)
do
    echo "Waiting for database connection..."
    sleep 3
done

echo "Database connected!"

# Import your SQL dump
if [ -f /data/dump.sql ]; then
    echo "Starting import of SQL dump..."
    mysql -u root -p$MYSQL_ROOT_PASSWORD -h db $MYSQL_DATABASE < /data/dump.sql
    echo "SQL dump imported successfully."
fi
