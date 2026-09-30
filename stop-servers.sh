#!/bin/bash
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

echo "Stopping Docker containers..."
docker compose down

# Clean up any lingering local php ports
lsof -ti :8000 | xargs kill -9 2>/dev/null
lsof -ti :8001 | xargs kill -9 2>/dev/null
lsof -ti :8002 | xargs kill -9 2>/dev/null

echo "✓ All servers stopped."
