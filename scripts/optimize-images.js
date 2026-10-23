/**
 * Generates WebP derivatives for every image referenced by the built site.
 *
 * Only images that are actually linked from HTML are processed, so the ~1400
 * orphaned legacy images in images/ are left untouched.
 *
 * Run with: npm run images
 */
const fs = require("fs");
const path = require("path");
const sharp = require("sharp");

const SITE = "_site";
const MAX_WIDTH = 1600;
const QUALITY = 78;

function walk(dir, cb) {
  if (!fs.existsSync(dir)) return;
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    const p = path.join(dir, entry.name);
    entry.isDirectory() ? walk(p, cb) : cb(p);
  }
}

// Collect every locally-referenced raster image from the built HTML
const referenced = new Set();
walk(SITE, (file) => {
  if (!file.endsWith(".html")) return;
  const html = fs.readFileSync(file, "utf8");
  const dir = path.dirname(file);
  const re = /(?:src|href)="([^"]+\.(?:jpe?g|png))"/gi;
  let m;
  while ((m = re.exec(html))) {
    if (/^https?:/i.test(m[1])) continue;
    const abs = path.resolve(dir, m[1]);
    // Map the built path back to the source images/ directory
    const rel = path.relative(path.resolve(SITE), abs);
    if (rel.startsWith("images" + path.sep)) referenced.add(rel);
  }
});

(async () => {
  let originalBytes = 0;
  let webpBytes = 0;
  let created = 0;
  let skipped = 0;

  for (const rel of [...referenced].sort()) {
    const src = path.join(process.cwd(), rel);
    if (!fs.existsSync(src)) continue;

    const out = src.replace(/\.(jpe?g|png)$/i, ".webp");
    const srcStat = fs.statSync(src);

    // Skip if an up-to-date derivative already exists
    if (fs.existsSync(out) && fs.statSync(out).mtimeMs >= srcStat.mtimeMs) {
      originalBytes += srcStat.size;
      webpBytes += fs.statSync(out).size;
      skipped++;
      continue;
    }

    try {
      const image = sharp(src).rotate();
      const meta = await image.metadata();
      const pipeline = meta.width > MAX_WIDTH ? image.resize({ width: MAX_WIDTH }) : image;
      await pipeline.webp({ quality: QUALITY, effort: 5 }).toFile(out);

      originalBytes += srcStat.size;
      webpBytes += fs.statSync(out).size;
      created++;
    } catch (err) {
      console.warn("  ! skipped " + rel + ": " + err.message);
    }
  }

  const mb = (b) => (b / 1048576).toFixed(2) + " MB";
  console.log("WebP derivatives: " + created + " created, " + skipped + " already current");
  console.log("Originals: " + mb(originalBytes) + "  ->  WebP: " + mb(webpBytes));
  if (originalBytes) {
    console.log("Saving: " + (100 - (webpBytes / originalBytes) * 100).toFixed(1) + "%");
  }
})();

