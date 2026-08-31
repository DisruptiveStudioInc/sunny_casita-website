---
name: cover-creator
description: Generate and store a realistic 16:9 WebP cover image for a blog entry in this repository. Use when asked to create a blog cover from a scene description.
---

# Blog cover creator

Create one realistic blog-cover image from the user's scene description. The description is required; ask for it if it was not provided.

## Required prompt

Use this prompt, replacing `<insert_scene_here>` with the scene description verbatim:

```text
Create a realistic image of <insert_scene_here>. If the image requires a power wall, use the tesla powerwall always, which you can see con it looks in this file: `assets/tesla-powerwall-reference.png`. Make the aspect ratio 16:9. The image dimensions must be 1672px wide by 941px high
```

If the scene includes or clearly implies a Powerwall, provide the local reference image at `assets/tesla-powerwall-reference.png` to the image-generation tool. Do not add a Powerwall when the scene does not call for one.

## Store the finished cover

- The sole delivered image belongs in `images/body/blog/` and must be a 1672×941 `.webp` file. Never leave a `.png`, `.jpg`, `.jpeg`, or other non-WebP image in that folder.
- Use `images/body/blog/0-image_index.txt` as the source of truth for numbering. Read its existing canonical `.webp` entries, take the highest three-digit numeric prefix, and use the next integer, zero-padded to three digits. For example, after `001-adu-planning.webp`, use `002-...`. Do not reuse numbers.
- Create a concise, descriptive, lowercase, hyphen-separated slug of two or three words from the scene or blog topic. The filename must be `NNN-slug.webp`, such as `035-tesla-powerwall-garage.webp`.
- Convert the generated artifact to WebP before moving it into `images/body/blog/`. Keep any temporary source artifact outside that folder and remove it after a successful conversion. Verify that the stored image is WebP, is 1672×941 px, and is no larger than 220 MB (230,686,720 bytes).
- Add the final filename, including `.webp`, as a new line in `images/body/blog/0-image_index.txt` only after the file is successfully written and verified. Do not add derivative-size filenames to the index.

Report the final repository-relative image path when finished.
