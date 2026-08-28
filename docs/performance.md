# Performance operations

## Baseline

The August 2026 reports in the locally ignored `performance/initial_readings`
directory measured the homepage at:

| Profile | Score | FCP | LCP | TBT | Transfer |
| --- | ---: | ---: | ---: | ---: | ---: |
| PageSpeed mobile | 52 | 7.1 s | 21.2 s | 230 ms | 12.3 MiB |
| PageSpeed desktop | 83 | 0.7 s | 1.9 s | 10 ms | 5.4 MiB |
| GTmetrix desktop | 77% | 1.2 s | 2.1 s | 89 ms | 19.3 MiB |

The largest GTmetrix payload was 15.5 MiB from eager Vimeo players. Six CSS
requests, Google Fonts, jQuery, and Three.js also blocked rendering.

## Asset build

Run `npm ci` once, then `npm run build` whenever source CSS or a configured
image changes. Commit `dist/` and generated responsive images so production
does not require Node.js. The image build does not upscale source files.

The PHP `assetUrl()` helper adds a file modification version to first-party
assets. The generated `dist/assets` filenames are content-hashed.

## Performance budgets

- Median of three Lighthouse runs: Performance 90 or higher on mobile and
  desktop.
- LCP at most 2.5 seconds, CLS at most 0.1, and TBT at most 200 milliseconds.
- Mobile transfer before interaction at most 1.5 MiB.
- No Vimeo, GSAP, ScrollMagic, jQuery, or Three.js request on mobile before a
  video interaction.
- No render-blocking third-party JavaScript on any route.

Test every unique page template at 390x844 and 1440x900. Smoke-test both
language route variants, forms, navigation, modals, video activation, and the
desktop animation timelines.

## Local validation

The final homepage audit on the PHP development server measured:

| Profile | Score | FCP | LCP (simulated) | TBT | CLS | Transfer |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| Lighthouse mobile | 87 | 1.4 s | 4.0 s | 0 ms | 0 | 722 KiB |
| Lighthouse desktop | 96 | 0.4 s | 0.9 s | 0 ms | 0 | 31.73 MiB |

The mobile trace observed LCP at 149 ms; Lighthouse Lantern simulated 4.0 s
because PHP's development server does not compress HTML, CSS, or JavaScript. The
committed nginx example enables gzip, and Cloudflare should provide Brotli in
production. Re-run the three-run median against production after deployment; the
90+ mobile budget depends on that compression layer and cannot be proven with the
repository-only development server. Desktop transfer includes the intentionally immediate background Vimeo requested by the product experience.

## Hosting and Cloudflare handoff

The repository cannot activate origin or Cloudflare settings. The operator
should:

1. Apply the compression and static cache rules from
   `nginx_routing.example.conf` to the active server configuration.
2. Enable Brotli, HTTP/2, and HTTP/3 where supported.
3. Set Cloudflare Browser Cache TTL to respect the origin cache headers and
   ensure query strings are included in the cache key.
4. Avoid caching referral-specific HTML across visitors; cache static assets
   only unless a safe HTML cache-key policy is designed.
5. Purge changed assets during deployment and confirm the hashed `dist/assets`
   files receive a one-year immutable policy.
6. Re-run PageSpeed Insights and GTmetrix after deployment. If TTFB remains
   above 400 ms, profile the origin/PHP container separately.
