# Blog authoring guide

Blog entries live in the language folders:

- `content/blog/en/{slug}.md`
- `content/blog/es/{slug}.md`

The filename must match the `url` field. Covers live in `images/body/blog/` and must be committed with the post.

## Required front matter

```yaml
---
name: Super tip to sell more
cover: blog-14-img.webp
cover_alt: A bright renovated kitchen with an island
url: super-tip-to-sell-more
seo_description: A concise description of the article for search results and social sharing.
language: en
translation: super-tip-para-vender-mas
date: 2026-08-26
updated: 2026-08-26
published: false
categories:
  - home-improvement
author: Sunny Casita
---
```

Required fields are `name`, `cover`, `cover_alt`, `url`, `seo_description`, `language`, `date`, `published`, and `categories`. The `translation`, `updated`, and `author` fields are optional.

- Use a category key declared in `categories.yaml`.
- Use lowercase, hyphenated slugs.
- Set `published: true` when the post is ready.
- Future-dated posts and posts with `published: false` are not public.
- A missing translation is allowed; the language selector links to the other language's blog index.
- Raw HTML and unsafe URL schemes are removed. Use standard Markdown for headings, links, images, lists, quotes, code, and tables.
- Markdown headings require a space: `## First step`.

Invalid files are skipped and their validation errors are written to the PHP error log.
