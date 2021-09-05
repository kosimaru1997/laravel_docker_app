# llaravel-SiteNote

[Laravel-SiteNote](https://laravel-site-note.herokuapp.com/)  
「テストユーザー  
　email: test@test.com  
　password: password  」

Railsで作成したこちらのサイト「SiteNote」(https://github.com/kosimaru1997/site_note) に  
メモ帳機能を着けたサイトをLravelで作成しました。  
お気に入りのサイトや学習で利用したサイトにあなたのメモを添えて管理できるサイトです。

## 機能・実装一覧
- ログイン機能
- CRUD処理
- 部分検索機能（検索条件：タイトル、メモ、タグ、 投稿時間による並び替え)
- レスポンシブ対応（bootstrap)
- Dockerによる環境構築
- URLからWebサイトの情報をスクレイピングし、Webサイトの画像、タイトル、説明を取得し保存する機能
- マークダウン記法の導入、及び記述内容のプレビュー機能（Ajax）
- タグ付け機能

## 使用技術
- Laravel Framework 8.51.0
- PHP 8.0.10
- mysql 8.0.26
- JavaScript(jQuery)
- bootstrap 4.6.0
- デプロイ：Heroku


## Dockerでの環境構築

実行環境  
macOS Big sur 11.5.2  
Docker version 20.10.5


```
git clone https://github.com/kosimaru1997/laravel_docker_app.git
cd laravel_docker_app
```

```
docker compose up -d --build
```
app コンテナに入り、各設定をします。
```
docker compose exec app bash
composer install
#.envは適宜設定してください。
cp .env.example .env
php artisan key:generate
php artisan migrate

#ファイルに書き込みをしたい場合は下記コマンドを実行
php artisan storage:link
chmod -R 777 storage bootstrap/cache
```

8080ポートにアクセス
http://localhost:8080/  
うまくいっていれば、サイトが表示されます。
