<?php
// feed_json_updater.php
$dir = __DIR__;
$baseUrl = "https://jnews568.github.io/berita/";
$files = scandir($dir);

$items = [];
foreach ($files as $file) {
    if (is_file($file) && preg_match('/\\.html$/', $file)) {
        $title = ucwords(str_replace(['-', '.html'], [' ', ''], $file));
        $url = $baseUrl . $file;
        $published = date('c', filemtime($file));

        $items[] = [
            "@type" => "NewsArticle",
            "headline" => $title,
            "url" => $url,
            "datePublished" => $published,
            "dateModified" => $published,
            "author" => ["@type" => "Organization", "name" => "JEWS568"]
        ];
    }
}

$feed = [
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "itemListElement" => $items
];

file_put_contents("feed.json", json_encode($feed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "<p><strong>feed.json berhasil diperbarui!</strong></p><pre>" . htmlspecialchars(json_encode($feed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) . "</pre>";
?>
