<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
header('Content-Type: text/xml');
echo '<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"> <!-- series -->';
echo "\n";
$seo_ler_serie = ler_db("series", " ORDER BY id ASC");
	if (!empty($seo_ler_serie)) { // O link existe
		foreach ($seo_ler_serie as $seo_array) {
		 	$array = array('id' => $seo_array['identificador'],'data' => $seo_array['data']);
		 	$link = "http://plyseries.tk/watch/serie/".$array['id']."/";
		 	$data = date('Y-m-d\TH:i:s',  strtotime($array['data']));
		 	echo "\t<url>\n";
			echo "\t\t<loc>" . htmlentities($link) . "</loc>\n";
			echo "\t\t<lastmod>{$data}</lastmod>\n";
			echo "\t\t<changefreq>week</changefreq>\n";
			echo "\t\t<priority>0.9</priority>\n";
			echo "\t</url>\n";
		}
	}
	echo '</urlset>';
?>