---
name: blog-entry-creator
description: Create paired Spanish and English Sunny Casita blog posts from a DOCX file, including validation, metadata, translations, and cover images. Use when authoring blog entries for this repository; do not use for standalone document editing.
---

# Blog Entry Creator

Create bilingual Sunny Casita blog entries from a user-supplied DOCX. Follow this workflow exactly: validate the whole document first, then write all posts and covers only after the document is approved.

## Inputs and source convention

The user supplies a DOCX path and states the expected number of entries. The usual source language is Spanish; detect the language from the text. If it is mixed or uncertain, stop and ask which language is the source.

Each entry must start with these two adjacent blocks:

```text
<positive integer> Categoría: <category key or English/Spanish category label>
<article title>  (formatted as Heading 1)
```

The category marker immediately precedes the article H1. The marker is document metadata: do not include it in the Markdown body.

Read DOCX with a document-aware method that preserves heading levels and ordered/unordered list structure. LibreOffice headless conversion is available in this repository; use a temporary directory outside the repository if conversion is needed. Never treat a DOCX as plain text or modify the source file.

## Preflight — no repository writes

Complete every check below across the full document before creating a Markdown file, cover, index entry, or category.

1. Identify entries from valid category-marker/H1 pairs and compare their count with the count stated by the user. If they differ, stop, report both counts and the affected titles/markers, and ask whether to correct the document or proceed with the actual count.
2. Require exactly one valid category marker for every entry. If one is missing, duplicated, malformed, or detached from its H1, stop and ask the user to correct or assign the category.
3. Read `content/blog/categories.yaml`. Resolve a supplied category key directly, or resolve an exact English or Spanish label to its key. If any category is absent or ambiguous, stop and list the entry title plus value. Ask whether the user wants to create category keys (with both language labels) or reassign the entries. Do not create or edit categories without an explicit follow-up decision.
4. Validate the source structure:
   - exactly one H1 per entry, used only as its title;
   - all article sections are H2–H6 and move logically (never skip more than one level when descending);
   - prose is ordinary paragraphs; ordered and unordered lists retain their intended list type and nesting;
   - links, tables, quotes, and code use standard Markdown-safe equivalents; exclude raw HTML.
5. Repair objectively clear conversion errors, such as missing heading spaces, list markers that became paragraphs, or an incorrect heading level whose parent is unambiguous. For any editorially ambiguous hierarchy or list interpretation, stop and show the affected excerpt for direction.
6. Generate each source and translated slug, then check both `content/blog/en/` and `content/blog/es/` for filename/URL collisions. Stop before writing if a slug is already used.

Do not partially process a batch. If preflight stops, make no blog-content or image changes.

## Create the paired posts

For each approved entry, create the source-language post and a faithful translation in the other language. Keep the article’s structure, list meaning, links, and factual claims aligned between versions; localize the title and prose naturally rather than translating word-for-word.

Read `content/blog/README.md` immediately before writing and use its front-matter contract. Write files only to:

- `content/blog/es/{spanish-slug}.md`
- `content/blog/en/{english-slug}.md`

Use the DOCX H1 as the localized `name` front-matter value. Do **not** include that H1 in the Markdown body: `pages/blog-post.inc.php` already renders `name` as the page H1. Preserve the remaining hierarchy beginning at H2.

For each language file, provide:

- `name`, `cover`, `cover_alt`, `url`, `seo_description`, `language`, `date`, `updated`, `published`, `categories`, and `author`;
- its own valid lowercase hyphenated slug as `url` and filename;
- the other language’s slug as reciprocal `translation` metadata;
- the resolved category key or keys, in the document’s order;
- `date` and `updated` set to the current date, `published: true`, and `author: Sunny Casita`.

Generate concise, accurate localized SEO descriptions and image alt text. Quote YAML scalar values when needed so punctuation cannot change their meaning.

## Covers

Create one shared cover for each bilingual article pair. Write a concise, realistic scene description based only on the article’s subject, then invoke the repository-local `cover-creator` skill. Use the resulting filename in both language files and use localized `cover_alt` values that describe the same image.

Run cover generation only after all preflight checks succeed. Follow `cover-creator` for numbering, WebP conversion, dimensions, image-index updates, and image validation; do not duplicate or bypass that workflow.

## Final verification

Before reporting completion, verify every generated file against the README and the enforced `services/BlogRepository.php` rules:

- required front matter is present and valid YAML;
- language matches its folder, filename matches `url`, dates are `YYYY-MM-DD`, and `published` is boolean;
- categories are valid catalog keys, slugs are unique and valid, and the reciprocal translation targets exist;
- the referenced cover exists in `images/body/blog/` and the Markdown body is non-empty;
- output contains no raw HTML and renders with valid standard Markdown headings and lists.

Report the created Spanish and English Markdown paths, the shared cover path, the processed count, detected source language, category mapping, and any objective formatting repairs. Preserve unrelated working-tree changes.
