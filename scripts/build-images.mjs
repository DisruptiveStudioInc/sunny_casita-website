import { access, mkdir } from "node:fs/promises";
import path from "node:path";
import sharp from "sharp";

const sources = [
  ["images/hero/hero.webp", [640, 960, 1280, 1920]],
  ["images/hero/soon.webp", [640, 960, 1280, 1920]],
  ...[1, 2, 3, 4, 5].map((id) => [
    `images/body/letters/${id}.webp`,
    [640, 960, 1440, 1920],
  ]),
  ...[
    "adus-bg",
    "remodelaciones-bg",
    "techos-bg",
    "aires-bg",
    "mejoras-bg",
    "renovables-bg",
  ].map((name) => [`images/body/subpage/${name}.webp`, [640, 960, 1440, 1920]]),
  ...["join-1", "join-2"].map((name) => [
    `images/body/join/${name}.webp`,
    [480, 720, 960],
  ]),
  ...[
    "adus",
    "adus-en",
    "remodelaciones",
    "remodelaciones-en",
    "techos",
    "techos-en",
    "aires",
    "aires-en",
    "mejoras",
    "mejoras-en",
    "renovables",
    "renovables-en",
  ].map((name) => [`images/body/products/${name}.webp`, [350, 700]]),
  ["images/body/blog/001-adu-planning.webp", [480, 960, 1600]],
  ['images/body/video/cover-video.webp', [640, 960, 1280]],
];

const jobs = [];

for (const [source, widths] of sources) {
  try {
    await access(source);
  } catch {
    continue;
  }

  const metadata = await sharp(source).metadata();
  const extension = path.extname(source);
  const base = source.slice(0, -extension.length);
  await mkdir(path.dirname(source), { recursive: true });

  for (const width of widths) {
    if (!metadata.width || width > metadata.width) continue;

    jobs.push(async () => {
      const image = sharp(source).resize({
        width,
        withoutEnlargement: true,
        fit: "inside",
      });
      await Promise.all([
        image
          .clone()
          .webp({ quality: 76, effort: 4, smartSubsample: true })
          .toFile(`${base}-${width}.webp`),
        image
          .clone()
          .avif({ quality: 48, effort: 4, chromaSubsampling: "4:2:0" })
          .toFile(`${base}-${width}.avif`),
      ]);
    });
  }
}

let nextJob = 0;
const workers = Array.from(
  { length: Math.min(4, jobs.length) },
  async () => {
    while (nextJob < jobs.length) {
      const job = jobs[nextJob];
      nextJob += 1;
      await job();
    }
  }
);

await Promise.all(workers);
console.log(`Generated ${jobs.length * 2} responsive image files.`);
