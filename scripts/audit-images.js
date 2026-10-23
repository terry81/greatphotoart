// Reports which images the built site actually references, and how heavy they are.
const fs = require("fs");
const path = require("path");

const SITE = "_site";
const used = new Set();

function walk(dir, cb) {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    const p = path.join(dir, entry.name);
    entry.isDirectory() ? walk(p, cb) : cb(p);
  }
}

walk(SITE, (file) => {
  if (!/\.html$/.test(file)) return;
  const html = fs.readFileSync(file, "utf8");
  const dir = path.dirname(file);
  const re = /(?:src|href)="([^"]+\.(?:jpe?g|png|gif))"/gi;
  let m;
  while ((m = re.exec(html))) {
    let ref = m[1];
    if (/^https?:/i.test(ref)) continue;
    const abs = path.normalize(path.resolve(dir, ref));
    used.add(abs);
  }
});

let total = 0;
const rows = [];
for (const f of used) {
  if (!fs.existsSync(f)) continue;
  const size = fs.statSync(f).size;
  total += size;
  rows.push([path.relative(process.cwd(), f), size]);
}

rows.sort((a, b) => b[1] - a[1]);
console.log("Referenced images:", rows.length);
console.log("Total weight:", (total / 1048576).toFixed(1), "MB");
console.log("\nTop 15 heaviest:");
for (const [f, s] of rows.slice(0, 15)) {
  console.log("  " + (s / 1024).toFixed(0).padStart(6) + " KB  " + f);
}

