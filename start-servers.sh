#!/bin/bash

# Multi-Site Docker Manager & Launcher
# Another Level (:8000), Loft Conversions North (:8001), Loft Conversions Manchester NW (:8002)

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

echo "=========================================================="
echo " 🐳 Loft Conversions - 3-Site Docker Launcher"
echo "=========================================================="

if command -v docker >/dev/null 2>&1 && docker info >/dev/null 2>&1; then
    echo "Starting all 3 Docker containers with 'restart: always'..."
    docker compose up -d
    echo ""
    echo "✓ All 3 Docker containers are active and running in background!"
    echo "----------------------------------------------------------"
    echo "🌐 Site 1 (Another Level):                http://localhost:8000/"
    echo "🌐 Site 2 (Loft Conversions North):         http://localhost:8001/"
    echo "🌐 Site 3 (Loft Conversions Manchester NW): http://localhost:8002/"
    echo "⚙️ Central Operations Panel:              http://localhost:8000/panel/"
    echo "----------------------------------------------------------"
    echo "Containers: loft_another_level, loft_conversions_north, loft_conversions_manchester_nw"
    echo "Policy: Always active in Docker"
    exit 0
fi

# Fallback if Docker daemon is not running
echo "Docker daemon is not running. Starting local PHP fallback..."
lsof -ti :8000 | xargs kill -9 2>/dev/null
lsof -ti :8001 | xargs kill -9 2>/dev/null
lsof -ti :8002 | xargs kill -9 2>/dev/null

cd "$SCRIPT_DIR"
php -S 127.0.0.1:8000 router.php >/dev/null 2>&1 &
PID1=$!

cd "$SCRIPT_DIR/../Loft Conversions North"
php -S 127.0.0.1:8001 router.php >/dev/null 2>&1 &
PID2=$!

cd "$SCRIPT_DIR/../Loft Conversions Manchester NW"
php -S 127.0.0.1:8002 router.php >/dev/null 2>&1 &
PID3=$!

sleep 1
echo "✓ Local PHP fallback started on :8000, :8001, and :8002"
