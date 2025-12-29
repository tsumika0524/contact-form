<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Admin/FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

<header class="header">
  <div class="header-container">
    <h1 class="logo">FashionablyLate</h1>
    <div class="header-right">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn header-btn">logout</button>
      </form>
    </div>
  </div>
</header>

<main class="container">
<h2>Admin</h2>

<!-- 検索フォーム -->
<form class="search-form">
<input type="text" placeholder="名前やメールアドレスを入力してください">
<select>
<option>性別</option>
<option>すべて</option>
<option>男性</option>
<option>女性</option>
<option>その他</option>
</select>
<select>
<option>お問い合わせの種類</option>
<option>商品のお届けについて</option>
<option>商品の交換について</option>
<option>商品トラブル</option>
<option>ショップへのお問い合わせ</option>
<option>その他</option>
</select>
<input type="date">
<button type="submit" class="btn search">検索</button>
<button type="reset" class="btn reset">リセット</button>
</form>




<button class="btn export">エクスポート</button>

<main>
  @yield('content')
</main>
@stack('scripts')

</body>
</html>
