<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'FashionablyLate')</title>

  {{-- 共通ヘッダーCSS --}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">


  {{-- 各画面専用CSS --}}
  @yield('css')
</head>
<body class="@yield('body-class')">


<header class="header">
  <div class="header-container">

    <!-- 中央ロゴ -->
    <h1 class="logo">FashionablyLate</h1>

    <!-- 右端ボタン -->
    <div class="header-right">
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="header-btn">logout</button>
        </form>
      @endauth

      @guest
        @if (request()->routeIs('register'))
          <a href="{{ route('login') }}" class="header-btn">login</a>
        @elseif (request()->routeIs('login'))
          <a href="{{ route('register') }}" class="header-btn">register</a>
        @endif
      @endguest
    </div>

  </div>
</header>


<main>
  @yield('content')
</main>

</body>
</html>
