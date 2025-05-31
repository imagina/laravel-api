#!/bin/sh

echo "🧠 Checking if Laravel Octane is actually installed..."

# Check if Artisan exists and Octane is available
if [ -f artisan ] && php artisan | grep -q "octane"; then
  echo "🚀 Starting Laravel Octane..."
  php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000
else
  echo "🧪 Octane not installed or not ready. Entering idle mode..."
  tail -f /dev/null
fi
