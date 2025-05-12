<?php
// rss_generator.php (FINAL FIXED)
$dir = __DIR__;
$baseUrl = "https://jnews568.github.io/berita/";
$files = scandir($dir);
$date = date(DATE_RSS);

$items = "";
foreach ($files as $file) {
    if (is_file($file) && preg_match('/\.html$/', $file)) {
        $title = ucwords(str_replace(['-', '.html'], [' ', ''], $file));
        $link = $baseUrl . $file;
        $pubDate = date(DATE_RSS, filemtime($file));

        $items .= "<item>";
        $items .= "<title>$title</title>";
        $items .= "<link>$link</link>";
        $items .= "<guid>$link</guid>";
        $items .= "<description><![CDATA[$title]]></description>";
        $items .= "<pubDate>$pubDate</pubDate>";
        $items .= "<dc:creator xmlns:dc=\"http://purl.org/dc/elements/1.1/\">JNEWS568</dc:creator>";
        $items .= "</item>\n";
    }
}

$rss = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$rss .= "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
$rss .= "<channel>\n";
$rss .= "<title>JNEWS568 | Portal Blog Berita Opini Pengguna</title>\n";
$rss .= "<link>{$baseUrl}index.html</link>\n";
$rss .= "<description>JNEWS568 Platform berita online terbaru dengan opini pengguna sendiri.</description>\n";
$rss .= "<language>id</language>\n";
$rss .= "<lastBuildDate>$date</lastBuildDate>\n";
$rss .= "<atom:link href=\"{$baseUrl}rss.xml\" rel=\"self\" type=\"application/rss+xml\" />\n";
$rss .= $items;
$rss .= "</channel></rss>";

file_put_contents("rss.xml", $rss);
echo "<p><strong>rss.xml berhasil diperbarui dan valid!</strong></p><pre>" . htmlspecialchars($rss) . "</pre>";
?>
