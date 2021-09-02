<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'site_tags');
    }

    public function saveSiteInfo($url, $note)
    {

        //Webページの読み込みと文字コード変換
        $html = file_get_contents($url);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'auto');
        //DOMDocumentとDOMXpathの作成
        $dom = new \DOMDocument;
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        //XPathでmetaタグのog:titleおよびog:imageを取得
        $node_title = $xpath->query('//meta[@property="og:title"]/@content');
        $node_image = $xpath->query('//meta[@property="og:image"]/@content');
        $node_description = $xpath->query('//meta[@property="og:description"]/@content');

        if ($node_title->length > 0) {
            //タイトルが存在すればサイトの情報を保存
            $title = $node_title->item(0)->nodeValue;
            $image = $node_image->item(0)->nodeValue;
            $description = $node_description->item(0)->nodeValue;
            $site_id = Site::insertGetId(['url'=> $url, 'title'=> $title, 'image'=> $image, 'note'=> $note, 'description'=> $description, 'user_id'=> \Auth::id()]);
            return $site_id;
        }
    }
}
