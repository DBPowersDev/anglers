## About Angler's

### Claris カンファレンス 2024

#### T-28 人気フレームワーク Laravel と Claris FileMaker の連携方法の紹介 (Laravel 11 対応)

サンプルアプリケーション
![](image/2024-10-04-10-37-08.png)

## 実行環境

- Docker Desktop
- PHP 8.3
- composer
- node.js と npm
- FileMaker Server 21.0.2.202

## 起動方法

1. .env.example 　を複製し、.env とする
2. 設定値 DB_HOST に fms の IP アドレスを設定
3. APP_KEY の生成を `php artisan key:generate` で行う
4. PHP パッケージのインストール `composer install`
5. Node.js パッケージのインストール `npm install`
6. Laravel Sail の起動 `./vendor/bin/sail up -d`
7. Laravel コンテナ内に入る `docker exec -it laravel.test-1 /bin/bash`
8. public 内に storage ディレクトリのリンク `php artisan storage:link`
9. `exit` でコンテナ内から出る
10. ユーザー登録は実装していませんので、会員(users)テーブルに手動でサンプルユーザーを作成 `php artisan tinker` 対話モードで`\App\Models\User::create(['mame' => 'test_user', 'email' => 'test_user@hoge.com', 'password' => \Hash::make('12345678')]);`
11. 開発モードで APP を実行 `npm run dev`
12. localhost:8000 にアクセス

> [!NOTE]
> .env にて SSL の検証をするか否か `MY_VERIFY_SSL=false` となっていますが、開発環境のみの設定です。本来ここは true としてください。

### anglers.fmp12

```
admin:1234
```
