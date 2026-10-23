/**
 * Local smoke test: crawls the dev server and verifies every page plus every
 * asset it references returns 200.
 *
 * Usage:  npm start          (in one terminal)
 *         npm run check      (in another)
 */
const BASE = process.env.BASE_URL || "http://localhost:8080";

const pages = [
  "/", "/foto-kursove.html", "/photography.html", "/contacts.html",
  "/teambuilding.html", "/multimedia.html", "/ekip.html", "/photo-offer.html",
  "/404.html", "/sitemap.xml", "/robots.txt",
  "/foto-kursove/kurs-za-nachinaeshti.html",
  "/foto-kursove/kurs-za-naprednali.html",
  "/foto-kursove/kurs-za-deca.html",
  "/foto-kursove/individualen-kurs.html",
  "/foto-kursove/dslr-video-kurs.html",
  "/foto-kursove/grafik-ceni.html",
  "/photography/produktova-fotografia.html",
  "/photography/reklamna-fotografia.html",
  "/photography/corporativna-fotografia.html",
  "/photography/editorial-photography.html",
  "/photography/360panorama.html"
];

let failures = 0;
const checkedAssets = new Set();

async function head(url) {
  try {
    const res = await fetch(url, { method: "GET" });
    return res;
  } catch (e) {
    return { ok: false, status: "ERR " + e.message };
  }
}

(async () => {
  console.log("Checking " + pages.length + " pages against " + BASE + "\n");

  for (const p of pages) {
    const res = await head(BASE + p);
    const ok = res.ok;
    if (!ok) failures++;
    console.log((ok ? "  ok  " : "  FAIL") + "  " + res.status + "  " + p);

    if (!ok || !p.endsWith(".html") && p !== "/") continue;

    // Collect local assets referenced by this page
    const html = await res.text();
    const base = new URL(p, BASE);
    const refs = [...html.matchAll(/(?:src|href)="([^"]+\.(?:css|js|webp|jpe?g|png|gif|ico))"/gi)]
      .map((m) => m[1])
      .filter((r) => !/^https?:/i.test(r));

    for (const ref of refs) {
      const abs = new URL(ref, base).href;
      if (checkedAssets.has(abs)) continue;
      checkedAssets.add(abs);
      const a = await head(abs);
      if (!a.ok) {
        failures++;
        console.log("        BROKEN ASSET " + a.status + "  " + ref + "  (on " + p + ")");
      }
    }
  }

  console.log("\nAssets checked: " + checkedAssets.size);
  if (failures) {
    console.log("FAILURES: " + failures);
    process.exit(1);
  }
  console.log("All pages and assets OK.");
})();

