# アプリケーション
Contact Form（お問い合わせフォーム）

## 環境構築

### 1. Docker ビルド
・git clone git@github.com:tsumika0524/contact-form.git<br>
・docker-compose build

### Laravel環境構築
docker-compose up -d<br>
docker exec -it contact-form bash<br>
cp .env.example .env<br>
php artisan key:generate<br>
composer install<br>
npm install<br>
npm run dev<br>
php artisan migrate<br>
php artisan db:seed<br>

#### 環境開発URL
・お問い合わせフォーム入力ページ：http://localhost<br>
・お問い合わせフォーム確認ページ：http://localhost//contacts/confirm<br>
・サンクスページhttp://localhost/thanks<br>
・管理画面: http://localhost/admin<br>
・ユーザ登録：http://localhost/register<br>
・ログイン：http://localhost/login<br>

##### 使用技術(実行環境)
・PHP 8.4.13<br>
・Laravel 8.83.29<br>
・MySQL 8.0.26 <br>
・nginx 1.21.1 <br>
・jquery 3.7.1.min.js<br>

######　ER図
![ER図](src/docs/ER_diagram.png)

