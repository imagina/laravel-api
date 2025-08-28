#!/bin/bash

echo "🐳 Rebuilding Docker Image..."
docker-compose down -v --remove-orphans
docker-compose up -d --build
