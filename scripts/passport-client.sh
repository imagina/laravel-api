#!/bin/bash
# Step 2: Migrate and seed Passport tables
echo "🛂 Creating Passport Password Grant Client and extracting credentials..."

output=$(docker exec -i laravel_api_fpm bash -c "printf '\n\n' | php artisan passport:client --password")

client_id=$(echo "$output" | awk '/Client ID/ {print $NF}')
client_secret=$(echo "$output" | awk '/Client Secret/ {print $NF}')

echo "🆔 Client ID: $client_id"
echo "🔐 Client Secret: $client_secret"

# Resolve path to .env in project root, relative to this script
ENV_FILE="$(dirname "$0")/../.env"

# Check that .env exists
if [ ! -f "$ENV_FILE" ]; then
  echo "❌ .env file not found at $ENV_FILE"
  exit 1
fi

# Remove existing entries
sed -i '' "/^PASSPORT_PASSWORD_CLIENT_ID=/d" "$ENV_FILE"
sed -i '' "/^PASSPORT_PASSWORD_CLIENT_SECRET=/d" "$ENV_FILE"

# Append new ones
echo "PASSPORT_PASSWORD_CLIENT_ID=$client_id" >> "$ENV_FILE"
echo "PASSPORT_PASSWORD_CLIENT_SECRET=$client_secret" >> "$ENV_FILE"

echo "✅ Passport client credentials written to $ENV_FILE"
