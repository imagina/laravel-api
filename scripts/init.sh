#!/bin/bash

# Step 0: Ensure .env file exists
if [ ! -f .env ]; then
  echo "📄 Creating .env from .env.example..."
  cp .env.example .env
else
  echo "📄 .env already exists — skipping copy"
fi

# Step 1: Build and start Docker containers
echo "🚀 Building and starting Docker containers..."
docker-compose up -d --build

# Step 2: Install Composer dependencies inside container
echo "📦 Installing Composer dependencies..."
docker exec laravel_api_app composer install
docker exec laravel_api_app composer require imagina/iworkshop:dev-main
docker exec laravel_api_app composer require imagina/icore:dev-main

# Step 3: Generate Laravel app key
echo "🔐 Generating app key..."
docker exec laravel_api_app php artisan key:generate

# Step 3: Generate Laravel app key
echo "🚀 Installing Octane..."
docker exec laravel_api_app php artisan octane:install

# Step 4: Run migrations
echo "🧬 Running migrations..."
docker exec laravel_api_app php artisan migrate

# Step 5: Storage link (optional)
echo "🔗 Linking storage folder..."
docker exec laravel_api_app php artisan storage:link

echo "🔄 Restarting container with Octane..."
docker-compose restart app

# Step 6: Jump into the container
echo "🐳 Entering app container..."
docker exec -it laravel_api_app bash
