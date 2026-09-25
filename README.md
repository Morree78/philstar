# Business Desk — Laravel conversion

A Laravel 13 / PHP 8.3+ business-news reader converted from the supplied Philstar Business HTML snapshot. Blade templates, Eloquent, SQLite, server-side search, category filters, 12-item pagination, article detail routes, and 79 imported excerpt records. CSS and JavaScript are local; no Node build is required.

## Run locally

Install PHP 8.3+ with Laravel's required extensions, including PDO SQLite, and Composer 2. Then run in this directory:

```sh
composer install
composer run setup
php artisan serve
```

Open http://localhost:8000. Setup creates `.env`, the encryption key, SQLite database and tables, then imports the records. Run setup once; to reimport the original snapshot, run `php artisan db:seed`. The seeder updates by slug without creating duplicate rows. Keep `.env` and the database private.

## Verify

```sh
composer test
php artisan route:list
php artisan view:cache
```

Tests cover seeded content, search, category filtering, pagination, missing articles, original-source links, empty results, input validation and idempotent imports. PHP/Composer were unavailable in the creation environment, so these runtime checks have NOT been executed. Composer dependencies must be installed on your machine. No vendor folder or lockfile is included; retain the generated composer.lock after installation.

## Content and behavior

This is an independent reader, not an official Philstar site. The supplied file contained listing excerpts, not full articles. Each article page retains its author and source link. Topics are inferred from headline keywords during import. Dates come from source URLs; original relative timestamps were not retained. Remote source photos may become unavailable; the layout supplies a neutral fallback. No live feed, publisher authentication, subscription, newsletter delivery, advertising or analytics is connected. Those copied third-party elements were removed rather than presented as working services.

Edit `database/data/articles.json` and run `php artisan db:seed` to update records. Content is escaped by Blade. GET search input is validated and database queries use parameter binding.

## Production

Use PHP-capable hosting. Set the document root to `public/` (never the project root), set APP_ENV=production, APP_DEBUG=false and APP_URL to your HTTPS domain, set SESSION_SECURE_COOKIE=true, and grant your PHP process write access only where needed to `storage/`, `bootstrap/cache/`, and the SQLite database directory. Install with `composer install --no-dev --optimize-autoloader`, provision `.env` and APP_KEY, run `php artisan migrate --seed --force`, then `php artisan optimize`. Preserve the database on redeployments and back it up. Sites hosts the separate interface preview; it does not execute this Laravel backend.

Laravel requirements and setup: https://laravel.com/docs/13.x/installation

## Supplied header
The header uses the supplied Philstar menu labels, icons and publisher links. Search opens the reader search form; account access opens Philstar.com. Subscribe and Support lead to the publisher. On mobile the menu scrolls horizontally. No local account system is implied.

The screenshot-matched header includes the supplied publisher logo, a toggleable sections menu, business-topic links and the TradingView ticker iframe extracted from the supplied HTML. Market quotes are supplied by TradingView (and may be delayed); this app does not generate or guarantee live prices. The widget and publisher logo require internet access.

## Article body update
For an existing installation, run `php artisan migrate --force` followed by `php artisan db:seed --force` to import the supplied Lulu article body. This article is user-supplied text and is not attributed to the original publisher or reporter. Its statements have not been independently verified.
