<?php

$url = 'https://readouble.com/laravel/8.x/ja/validation.html';

//Webページの読み込みと文字コード変換
$html = file_get_contents($url);
$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'auto');
//DOMDocumentとDOMXpathの作成
$dom = new DOMDocument;
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
//XPathでmetaタグのog:titleおよびog:imageを取得
// $node_title = $xpath->query('//meta[@property="og:title"]/@content');
//  if(empty($node_title)){
    $node_title = $dom->getElementsByTagName('title');
// }
echo $node_title->item(0)->nodeValue;
// $node_image = $xpath->query('//meta[@property="og:image"]/@content');
// $node_description = $xpath->query('//meta[@property="og:description"]/@content');
// if ($node_title->length > 0 && $node_image->length > 0) {
// 	//タグが存在すればサムネイルとタイトルを表示してリンクする
// 	$title = $node_title->item(0)->nodeValue;
// 	$image = $node_image->item(0)->nodeValue;
//     $description = $node_description->item(0)->nodeValue;
// 	// echo $url;
// 	// echo $image;
// 	echo $title;
//     // echo $description;
// }
?>
