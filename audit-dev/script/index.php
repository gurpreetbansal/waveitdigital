<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "sitemap-generator.php";
include "sitemap-config.php";

$smg = new SitemapGenerator(include("sitemap-config.php"));
$demo = $smg->GenerateSitemap();


echo "<pre/>";
print_r($demo);
die("HERE");