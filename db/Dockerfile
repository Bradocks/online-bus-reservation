# Start with the official MySQL image
FROM mysql:8.0

# # Ensure bash is available
# RUN apt-get update && apt-get install -y bash

# Copy the custom script to the container
COPY init-db.sh /docker-entrypoint-initdb.d/init-db.sh

# Ensure the script is executable
RUN chmod +x /docker-entrypoint-initdb.d/init-db.sh
