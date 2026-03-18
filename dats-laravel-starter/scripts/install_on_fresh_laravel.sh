#!/usr/bin/env bash
set -euo pipefail

TARGET_DIR="${1:-dats-laravel}"
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT_DIR="$(cd "${SCRIPT_DIR}/.." && pwd)"

if ! command -v composer >/dev/null 2>&1; then
  echo "Composer is required. Install Composer first."
  exit 1
fi

if [ ! -d "${TARGET_DIR}" ]; then
  composer create-project laravel/laravel "${TARGET_DIR}"
fi

cp -R "${ROOT_DIR}/starter-pack/." "${TARGET_DIR}/"

cd "${TARGET_DIR}"

if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  cp .env.example .env
fi

php artisan key:generate || true

echo "Done. Next:"
echo "1. Configure your database in .env"
echo "2. Run: php artisan migrate --seed"
echo "3. Run: php artisan serve"
