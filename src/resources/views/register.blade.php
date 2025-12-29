@extends('layouts.app')

@section('title', 'Register | FashionablyLate')

@section('body-class', 'auth-page')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="auth-main">
<main class="register">
  <h2 class="title">Register</h2>

  <div class="card">
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="field">
        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p class="error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label>パスワード</label>
        <input type="password" name="password">
        @error('password') <p class="error">{{ $message }}</p> @enderror
      </div>

      <div class="btn-area">
        <button type="submit">登録</button>
      </div>
    </form>
  </div>
</main>
</div>
@endsection
