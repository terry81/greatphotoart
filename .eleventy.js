const htmlmin = require("html-minifier-terser");

function absoluteUrl(urlPath = "", baseUrl = "") {
  const rawPath = String(urlPath || "");

  if (/^https?:\/\//i.test(rawPath)) {
    return rawPath;
  }

  const base = String(baseUrl || "").replace(/\/+$/, "");
  let normalizedPath = rawPath.replace(/^\/+/, "");

  if (!normalizedPath || normalizedPath === "index.html") {
    return `${base}/`;
  }

  normalizedPath = normalizedPath.replace(/\/index\.html$/, "/");
  return `${base}/${normalizedPath}`;
}

function cleanTitle(title = "") {
  return String(title).split("|")[0].trim();
}

function getBreadcrumbs(data) {
  const pageUrl = String((data.page && data.page.url) || data.permalink || "").replace(/^\/+/, "");

  if (!pageUrl || pageUrl === "index.html" || pageUrl === "404.html") {
    return null;
  }

  const parentPages = {
    "foto-kursove": { title: "Фотокурсове", url: "foto-kursove.html" },
    "photography": { title: "Фотография", url: "photography.html" }
  };

  const currentCrumb = {
    title: data.breadcrumbTitle || cleanTitle(data.title),
    url: pageUrl
  };

  const segments = pageUrl.split("/");

  if (segments.length > 1 && parentPages[segments[0]]) {
    return [parentPages[segments[0]], currentCrumb];
  }

  return [currentCrumb];
}

module.exports = function(eleventyConfig) {
  // Copy static assets directly to output
  eleventyConfig.addPassthroughCopy("css");
  eleventyConfig.addPassthroughCopy("images");
  // eleventyConfig.addPassthroughCopy("media"); // Removed - old Joomla files, not used
  // eleventyConfig.addPassthroughCopy("plugins"); // Removed - old Admiror Gallery, not used (files missing)
  eleventyConfig.addPassthroughCopy("templates");
  eleventyConfig.addPassthroughCopy("CNAME");
  eleventyConfig.addPassthroughCopy("robots.txt");
  eleventyConfig.addPassthroughCopy("sitemap.xml");
  // Note: Old Joomla redirect files removed - site uses clean URL structure now

  // Don't process these as templates
  eleventyConfig.ignores.add("node_modules");
  eleventyConfig.ignores.add("_site");
  eleventyConfig.ignores.add(".git");
  eleventyConfig.ignores.add("*.py");
  eleventyConfig.ignores.add("*.sh");
  eleventyConfig.ignores.add("*.md");
  eleventyConfig.ignores.add("package*.json");

  // Watch these folders for changes during development
  eleventyConfig.addWatchTarget("css/");
  eleventyConfig.addWatchTarget("_includes/");

  // Create a custom shortcode for the navigation
  eleventyConfig.addShortcode("year", () => `${new Date().getFullYear()}`);

  // SEO helpers
  eleventyConfig.addFilter("absoluteUrl", absoluteUrl);
  eleventyConfig.addFilter("cleanTitle", cleanTitle);
  eleventyConfig.addFilter("json", function(value) {
    return JSON.stringify(value, null, process.env.ELEVENTY_ENV === "production" ? 0 : 2)
      .replace(/</g, "\\u003c");
  });

  eleventyConfig.addGlobalData("eleventyComputed", {
    breadcrumbs: getBreadcrumbs
  });

  // Create path helper for subdirectory pages
  eleventyConfig.addFilter("relativePath", function(path, level = 0) {
    const prefix = level > 0 ? '../'.repeat(level) : '';
    return prefix + path;
  });

  // HTML Minification for production builds
  eleventyConfig.addTransform("htmlmin", function(content, outputPath) {
    if (process.env.ELEVENTY_ENV === "production" && outputPath && outputPath.endsWith(".html")) {
      return htmlmin.minify(content, {
        useShortDoctype: true,
        removeComments: true,
        collapseWhitespace: true,
        minifyCSS: true,
        minifyJS: true,
        removeRedundantAttributes: true,
        removeScriptTypeAttributes: true,
        removeStyleLinkTypeAttributes: true
      });
    }
    return content;
  });

  return {
    dir: {
      input: "src",          // Source files
      includes: "../_includes", // Templates/includes
      layouts: "../_layouts",   // Layouts
      data: "../_data",         // Data files
      output: "_site"           // Built site
    },
    templateFormats: ["html", "njk", "md"],
    htmlTemplateEngine: "njk",
    markdownTemplateEngine: "njk"
  };
};

