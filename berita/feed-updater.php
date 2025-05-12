<?php
// Path file RSS
$rssFile = 'rss.xml';

// Ambil data artikel baru
$newArticle = [
    'title' => 'JNEWS568 | Portal Blog Berita Opini Pengguna',
    'link' => 'https://jnews568.github.io/berita/index.html',
    'description' => 'JNEWS merupakan sebuah portal yang memberikan sajian hangat tentang opini seorang pengguna!',
    'pubDate' => date('r'), // Format RFC2822
    'creator' => 'JNEWS568',
    'image' => 'https://jnews568.github.io/berita/logo.png'
];

// Load RSS yang ada
if (file_exists($rssFile)) {
    $rss = simplexml_load_file($rssFile);
} else {
    // Buat RSS baru kalau belum ada
    $rss = new SimpleXMLElement('<rss version="2.0"></rss>');
    $channel = $rss->addChild('channel');
    $channel->addChild('title', 'JNEWS568 | Portal Blog Berita Opini Pengguna');
    $channel->addChild('link', 'https://jnews568.github.io/berita/index.html');
    $channel->addChild('description', 'JNEWS568 Platform berita online terbaru dengan opini pengguna sendiri.');
    $channel->addChild('language', 'id');
    $channel->addChild('lastBuildDate', date('r'));
}

// Tambahkan item baru
$channel = $rss->channel;
$item = $channel->addChild('item');
$item->addChild('title', $newArticle['title']);
$item->addChild('link', $newArticle['link']);
$item->addChild('guid', $newArticle['link']);
$item->addChild('description', "<![CDATA[{$newArticle['description']}]]>");
$item->addChild('pubDate', $newArticle['pubDate']);
$item->addChild('dc:creator', $newArticle['creator'], 'http://purl.org/dc/elements/1.1/');
$media = $item->addChild('media:content', '', 'http://search.yahoo.com/mrss/');
$media->addAttribute('url', $newArticle['image']);
$media->addAttribute('medium', 'image');
$media->addAttribute('type', 'image/jpeg');
$media->addAttribute('width', '640');
$media->addAttribute('height', '640');

// Update lastBuildDate
$channel->lastBuildDate = date('r');

// Simpan kembali
$rss->asXML($rssFile);

echo "RSS berhasil diperbarui!\n";
?>
