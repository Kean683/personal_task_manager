# Running this project in a new/fresh Codespace

Every time you open a new GitHub Codespace (or an old one that got deleted and recreated),
the forwarded URL changes. Follow these steps in order.

## 1. Install dependencies (only needed the first time in a fresh codespace)
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate

## 2. Get your new forwarded URL
Open the Ports tab in VS Code/Codespaces (bottom panel, next to Terminal).
Find the row for port 8000 (start the server once first if it's not listed yet).
Copy the forwarded address, e.g. https://<random-codename>-8000.app.github.dev

## 3. Update .env with the new URL
APP_URL=https://<random-codename>-8000.app.github.dev
(no trailing slash, no quotes, only ONE APP_URL= line)
Then run: php artisan config:clear

## 4. Start the server
php artisan serve --host=0.0.0.0 --port=8000
Keep this terminal tab running. Use a second tab for other artisan commands.

## 5. Open the app
Use the forwarded URL from step 2, e.g.
https://<random-codename>-8000.app.github.dev/tasks

## Why this matters
Codespaces' proxy sends requests to Laravel with Host: localhost:8000, so without
forcing the root URL, generated links (like "+ Add Task") point to localhost and fail.
This is already fixed in app/Providers/AppServiceProvider.php via URL::forceRootUrl(),
which reads APP_URL from .env — so step 3 is the only manual step needed.

## Quick check
grep APP_URL .env
Confirm it matches your current forwarded URL, then repeat steps 3-4.
