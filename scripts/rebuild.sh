#!/bin/bash

echo "🐳 Rebuilding Docker Image..."
docker-compose down
docker-compose up -d --build
