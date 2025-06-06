#!/usr/bin/env bash

# ─── CONFIGURATION ────────────────────────────────────────────────────────────
CONTAINER_NAME="laravel_api_db"
MYSQL_ROOT_PASSWORD="root"
# ────────────────────────────────────────────────────────────────────────────────

usage() {
  echo "Usage: $0 [on|off]"
  exit 1
}

if [[ $# -ne 1 ]]; then
  usage
fi

if [[ "$1" != "on" && "$1" != "off" ]]; then
  usage
fi

ACTION="$1"

if [[ "$ACTION" == "on" ]]; then
  echo "Enabling MySQL general_log in container '${CONTAINER_NAME}'..."
  docker exec "$CONTAINER_NAME" mysql \
    -uroot -p"${MYSQL_ROOT_PASSWORD}" \
    -e "SET GLOBAL general_log = 'ON';"
  echo "Done. Tail with: docker exec -it ${CONTAINER_NAME} tail -f /var/lib/mysql/general.log"
  exit 0
else
  echo "Disabling MySQL general_log in container '${CONTAINER_NAME}'..."
  docker exec "$CONTAINER_NAME" mysql \
    -uroot -p"${MYSQL_ROOT_PASSWORD}" \
    -e "SET GLOBAL general_log = 'OFF';"
  echo "Done. General logging is now turned off."
  exit 0
fi
