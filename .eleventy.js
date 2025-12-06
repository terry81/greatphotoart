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
  // Note: .htaccess doesn't work on GitHub Pages (uses their own config)

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

  // Create path helper for subdirectory pages
  eleventyConfig.addFilter("relativePath", function(path, level = 0) {
    const prefix = level > 0 ? '../'.repeat(level) : '';
    return prefix + path;
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

