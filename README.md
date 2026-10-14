# Sunny Casita website

Sunny Casita is a bilingual English/Spanish PHP website with localized routes, server-rendered pages, contact forms, a Markdown blog, and a Node-based asset pipeline. PHP renders the application; Node.js is used to build CSS, responsive images, and run Lighthouse audits.

## Project layout

```text
index.php                  Front controller and application bootstrap
includes/routes.php        Router registration
includes/Localization.php  Localized routes, URLs, and slug translation
controllers/               Page, product, form, blog, and sitemap controllers
pages/                     PHP view templates
includes/languages/        English and Spanish interface copy
includes/pagesData/        Page-specific content/data
content/blog/              Markdown posts and the category catalog
css/                       CSS sources
dist/                      Compiled CSS and hashed CSS assets
js/                        Browser scripts
scripts/                   Node build scripts
images/                    Source and generated responsive images
.agents/skills/            Repository-local Codex workflows
tests/                     PHPUnit tests
```

## Requirements and installation

- PHP 8.2 or newer
- Composer 2
- Node.js with npm (a current LTS release)
- Nginx and PHP-FPM for a complete local or production-like server

Install the locked dependencies:

```bash
composer install
npm ci
```

The application always loads a root `.env` file. Create it locally with the SendGrid key used by the form endpoints:

```dotenv
SENDGRID_KEY=your_sendgrid_api_key
```

Keep `.env` out of version control. Pages can be browsed without a working SendGrid key, but form email delivery will fail.

Build the front-end assets:

```bash
npm run build
```

Generated `dist/` files and responsive images are committed because the current deployment pipeline does not run Node.js builds.

## Request lifecycle and routing

The web server sends requests that do not match real files or directories to `index.php`. The provided `nginx_routing.example.conf` contains the required `try_files` rule, compression, cache headers, and protection for application-only directories.

`index.php`:

1. Starts the PHP session and loads Composer autoloading.
2. Loads `.env` through `vlucas/phpdotenv`.
3. Loads helpers, constants, and `config.php`.
4. Stores the optional `?ref=` referral value in the session.
5. Serves the maintenance page when `maintenance_mode` is enabled. The current implementation lets `?dev` bypass maintenance mode.
6. Loads `includes/routes.php` and dispatches through Bramus Router.

Static files are served directly by Nginx. Application routes are declared in `Includes\Localization::$routes`; `includes/routes.php` registers every localized path and injects its language as the first controller argument.

| Route key | English | Spanish | Handler |
| --- | --- | --- | --- |
| `home` | `/` | `/es` | `PageController@home` |
| `join` | `/join-us` | `/es/forma-parte` | `PageController@join` |
| `startnow` | `/start-now` | `/es/empieza-ahora` | `PageController@startnow` |
| `privacy` | `/privacy-policy` | `/es/politica-de-privacidad` | `PageController@privacy` |
| `terms` | `/en/terms-and-conditions` | `/terminos-y-condiciones` | `PageController@terms` |
| `blog` | `/blog` | `/es/blog` | `BlogController@index` |
| `blog_post` | `/blog/{slug}` | `/es/blog/{slug}` | `BlogController@show` |
| `product` | `/en/product/{id}` | `/producto/{id}` | `ProductController@show` |

Routes registered separately:

- `POST /api/form/join`
- `POST /api/form/startnow`
- `GET /sitemap.xml`

`BaseController::view()` exposes controller data and renders `includes/header.php`, `pages/{view}.inc.php`, and `includes/footer.php`. The custom 404 handler detects the requested language before rendering the error page.

### Adding a route

1. Add the route key, every localized path, and a `Controller@method` handler to `Localization::$routes`.
2. Add the controller method and call `setLang()` plus `Localization::setCurrentRoute()`.
3. Add the view under `pages/` and any data under `includes/pagesData/`.
4. Add translated navigation/page labels to both language files.
5. For translated dynamic parameters, add a canonical mapping to `Localization::$slugMap` and resolve it in the controller.

Do not assume every English or Spanish URL uses one prefix; the route table is the source of truth.

## Multilanguage behavior

English (`en`) is the default language in `config.php`; Spanish (`es`) is the other available language.

- The matched localized route determines the controller language.
- `Localization::loadLanguage()` includes `includes/languages/eng.php` or `esp.php`.
- Language files define interface copy as PHP variables. Localization publishes them to `$GLOBALS` for controllers, page-data files, headers, and views.
- `Localization::url()` builds localized URLs from route keys.
- The header switcher normally uses `Localization::getCurrentUrl()` to retain the current route.
- Product slugs are translated through `Localization::$slugMap`.
- Blog pairs use reciprocal `translation` slugs. If a published translation is missing, the switcher links to the other language's blog index.
- Controllers provide `languageUrls` for canonical `hreflang` and `x-default` links.

Adding another language requires a language file and loader mapping, a path for every route, translated dynamic slugs, updates to services restricted to `en` and `es`, and a label for every blog category.

## CSS and image pipeline

`css/site.entry.css` is the single CSS build entry. It imports:

1. `css/min/reset.min.css`
2. `css/min/main.min.css`
3. `css/min/root.min.css`
4. `css/body/style.css`
5. `css/body/navigation.css`

The sources contain design tokens, local `@font-face` declarations, utilities, components, page sections, and responsive rules. Fonts are served from `/fonts`.

```bash
npm run build:css
```

esbuild bundles and minifies the imports into `dist/site.min.css`. CSS images/SVGs are emitted to `dist/assets/` with content hashes. The header loads only `/dist/site.min.css`; `assetUrl()` adds a file-modification cache-buster. Edit files under `css/`, never `dist/site.min.css` directly.

```bash
npm run build:images
```

`scripts/build-images.mjs` uses Sharp to create configured WebP and AVIF widths without upscaling. It discovers canonical covers in `images/body/blog/` automatically and excludes generated `-480`, `-960`, and `-1600` files as sources. Commit canonical images and generated variants.

## JavaScript loading

Scripts are not bundled by the current build.

- `includes/footer.php` loads `/js/site.js` with `defer` on every normal page.
- Controllers pass `pageScripts`; the footer loads them after `site.js`, also with `defer`.
- Home loads `slider.js` and `home.js`.
- Join and Start Now load `forms.js`.
- Product pages load `product.js`.
- `assetUrl()` appends an `?v={mtime}` cache-buster to local scripts.

`home.js` and `product.js` load GSAP and ScrollMagic from cdnjs only on desktop-width devices without reduced motion. Home videos use lazy-created Vimeo iframes.

Legacy `script.js`, `lozad.min.js`, and `webgl-distortion.js` are present but not loaded by current controllers or the footer. Their globals are unavailable unless explicitly loaded.

### Adding a browser script

1. Place a browser-ready script in `js/`.
2. Add its path to the relevant controller's `pageScripts`, or to the footer only if every page needs it.
3. Preserve dependency order and use `defer` unless blocking is explicitly required.
4. Test with cache disabled and `prefers-reduced-motion` enabled.

Installing an npm package does not expose it in the browser because there is no JavaScript bundle entry. Either add an explicit esbuild JavaScript bundle or vendor/copy a browser build into `js/` and load it explicitly.

## External libraries

### Composer

| Package | Purpose |
| --- | --- |
| `bramus/router` | HTTP route matching and dispatch |
| `vlucas/phpdotenv` | Root `.env` loading |
| `phpmailer/phpmailer` | SendGrid SMTP form delivery |
| `league/commonmark` | Safe CommonMark/GFM rendering for blog bodies |
| `symfony/yaml` | Blog category and front-matter parsing |
| `phpunit/phpunit` | Test runner (development) |
| `phpstan/phpstan` | Static analysis level 9 (development) |

Add a PHP package with:

```bash
composer require vendor/package
# Development-only:
composer require --dev vendor/package
```

Import namespaced classes with `use`; `vendor/autoload.php` is already loaded. Commit `composer.json` and `composer.lock`. This repository currently tracks `vendor/`, so commit the updated installed package unless deployment is changed to run `composer install`.

### Node/build tools

| Package | Purpose |
| --- | --- |
| `esbuild` | CSS bundling, minification, and hashed CSS assets |
| `sharp` | Responsive WebP/AVIF generation |
| `lighthouse` | Local performance audits |

```bash
npm install --save-dev package-name
```

Import the package from the relevant build script, add/update an npm command, and commit `package.json` and `package-lock.json`. Use npm for this project; `pnpm-lock.yaml` is ignored.

### Browser/CDN services

- Vimeo Player is used through iframe URLs on the home page.
- GSAP 2.1.3, ScrollMagic 2.0.3, and the ScrollMagic GSAP plugin load from cdnjs in `home.js` and `product.js`.

Pin CDN versions, load dependencies in order, keep them page-specific, and handle failures. Prefer a local browser bundle when practical.

## Blog authoring

The blog supports pagination, categories, related posts, localized dates, social metadata, canonical/hreflang links, structured data, and sitemap entries. Invalid files are skipped and logged to the PHP error log.

### Create a post manually

1. Read `content/blog/README.md` and choose a key from `content/blog/categories.yaml`. New categories need a lowercase hyphenated key and both `en` and `es` labels.
2. Create a lowercase hyphenated slug. The filename must equal `url`:
   - `content/blog/en/{slug}.md`
   - `content/blog/es/{slug}.md`
3. Add a canonical cover to `images/body/blog/`. Project covers use `NNN-short-slug.webp`, are 1672×941, and are recorded in `0-image_index.txt`.
4. Add front matter and a non-empty Markdown body:

```yaml
---
name: Article title
cover: 005-example-cover.webp
cover_alt: A useful description of the cover image
url: article-slug
seo_description: A concise search and social description.
language: en
translation: articulo-traducido
date: 2026-08-31
updated: 2026-08-31
published: false
categories:
  - home-improvement
author: Sunny Casita
---
```

Required fields: `name`, `cover`, `cover_alt`, `url`, `seo_description`, `language`, `date`, `published`, and `categories`. Optional fields: `translation`, `updated`, and `author`. Dates use `YYYY-MM-DD`; `published` is a YAML boolean. Future-dated and unpublished posts stay private.

5. The view renders `name` as H1, so begin the body with paragraphs or H2 sections instead of repeating the H1.
6. For a translated pair, localize the slug/content, share the cover, and set reciprocal `translation` slugs.
7. Use standard Markdown. Raw HTML is stripped and unsafe links are rejected.
8. Run `npm run build:images`, validate, and preview both language URLs.

### Use the cover skill

The local workflow is `.agents/skills/cover-creator/SKILL.md`. Invoke it in Codex with a scene:

```text
$cover-creator Create a blog cover showing homeowners reviewing renovation plans in a bright kitchen.
```

It creates a realistic 16:9 cover, converts it to a 1672×941 WebP, assigns the next number from `0-image_index.txt`, validates it, stores it in `images/body/blog/`, and updates the index. The bundled Tesla Powerwall reference is used only for Powerwall scenes. Run `npm run build:images` afterward and add the returned filename to the post.

### Use the DOCX blog-entry skill

The local workflow is `.agents/skills/blog-entry-creator/SKILL.md`. Supply a DOCX and expected count:

```text
$blog-entry-creator Create the 4 blog entries written in ./Blogs-sunny.docx.
```

Each entry needs this line immediately before its Heading 1 title:

```text
<number> Categoría: <category key or English/Spanish label>
```

Before writing, the skill validates the entire batch: count, categories, one H1 per entry, heading/list structure, source language, and slug collisions. Ambiguous or missing decisions pause for user input.

It then creates paired Spanish/English Markdown files, reciprocal translation metadata, localized SEO/alt text, and one shared cover per pair through `cover-creator`. The usual source language is Spanish; mixed or uncertain documents require confirmation.

## Validation

```bash
npm run build
vendor/bin/phpunit
vendor/bin/phpstan analyse
```

Optional audits expect the site at `http://127.0.0.1:8090/`:

```bash
npm run audit:mobile
npm run audit:desktop
```

Smoke-test both languages, the switcher, forms, blog filters/pagination, translation links, `/sitemap.xml`, and a 404.

## Run on a local machine

Use Nginx and PHP-FPM for a complete local environment; PHP's built-in server does not apply the repository's rewrite and static-file behavior by itself.

1. Clone the repository; run `composer install`, `npm ci`, and `npm run build`.
2. Create `.env` and review `config.php`.
3. Configure an Nginx server block with the repository root and include the provided routing rules:

```nginx
server {
    listen 8090;
    server_name localhost;
    root /absolute/path/to/sunnycasitas-webiste;
    index index.php;

    include /absolute/path/to/sunnycasitas-webiste/nginx_routing.example.conf;

    location ~ \.php$ {
        try_files $uri =404;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    }
}
```

Adjust the PHP-FPM socket, test/reload Nginx, and open `http://localhost:8090/`. Nginx/PHP-FPM must be able to read the repository, and PHP must be able to write its session directory.

The repository has no Dockerfile or Compose file, so local Docker deployment depends on external infrastructure.

## Deploy changes

Production deployment is defined by `azure-pipelines.yml`:

1. Validate locally
2. Run `npm run build` and commit `dist/` plus responsive images.
3. Commit code, lockfiles, and tracked Composer dependencies when changed.
4. Push or merge to `main`.
5. Azure runs on the self-hosted `Disruptive` pool and connects through `creative-ovh`.
6. The server changes to `/var/www/$(Build.Repository.Name)`, runs `sudo git reset --hard`, pulls, and executes `docker compose restart`.

The pipeline does not build assets, install dependencies, run tests, apply migrations, or purge caches. Its Compose configuration is not in this repository. The SSH task uses `continueOnError: true`, so verify the deployed commit and site health even when Azure reports completion.

After deployment, verify both languages, forms, blogs, and `/sitemap.xml`; confirm the Nginx rules are active; purge CDN/static caches if needed; and run the production checks in `docs/performance.md`.
