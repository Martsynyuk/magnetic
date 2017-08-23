<?php

include_once 'home.php';

$web = 'https://stackoverflow.com';

function getImage($site)
{
	$dom = new DOMDocument;
	@$dom->loadHTML(file_get_contents($site));
	$images = $dom->getElementsByTagName('img');

	foreach ($images as $image) {
		$result = explode(',', $image->getAttribute('src'));
		print_r($result);
	}

}

function getLink($site)
{
	$dom = new DOMDocument;
	@$dom->loadHTML(file_get_contents($site));
	$links = $dom->getElementsByTagName('a');

	foreach ($links as $link) {
		$result = explode(',', $link->getAttribute('href'));
		print_r($result);
	}

}

echo 'Images';
getImage($site);

echo 'Links';
getLink($site);

