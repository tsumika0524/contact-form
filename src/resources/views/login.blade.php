@extends('layouts.app')

@section('title', 'Login | FashionablyLate')

@section('body-class', 'auth-page')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main class="login">
  <h2 class="title">Login</h2>

  <div class="login-card">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      {{-- メールアドレス --}}
      <div class="form-group">
        <label>メールアドレス</label>
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="例: test@example.com"
        >
        @error('email')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      {{-- パスワード --}}
      <div class="form-group">
        <label>パスワード</label>
        <input
          type="password"
          name="password"
          placeholder="例: coachtech1106"
        >
        @error('password')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      {{-- 認証失敗 --}}
      @error('login')
        <p class="error">{{ $message }}</p>
      @enderror

      <div class="btn-area">
        <button type="submit" class="btn-login">ログイン</button>
      </div>
    </form>
  </div>
</main>
@endsection
