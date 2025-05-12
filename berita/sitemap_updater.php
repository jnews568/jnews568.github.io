<?php
// sitemap_updater.php (with debug)
$dir = __DIR__;
$baseUrl = "https://jnews568.github.io/berita/";
$files = scandir($dir);

$sitemapEntries = [];
$debugOutput = "<h3>File ditemukan:</h3><ul>";

foreach ($files as $file) {
    if (preg_match('/\.html$/', $file)) {
        $debugOutput .= "<li>$file</li>";
        $loc = htmlspecialchars($baseUrl . $file);
        $lastmod = date('Y-m-d', filemtime($file));
        $sitemapEntries[] = "<url><loc>$loc</loc><lastmod>$lastmod</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>";
    }
}
$debugOutput .= "</ul>";

$sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$sitemap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
$sitemap .= implode("\n", $sitemapEntries);
$sitemap .= "\n</urlset>";

file_put_contents("sitemap.xml", $sitemap);
echo "<p><strong>Sitemap berhasil diperbarui!</strong></p>" . $debugOutput;
echo "<pre>" . htmlspecialchars($sitemap) . "</pre>";
?>
