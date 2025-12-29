@extends('layouts.app')

@section('title', 'Confirm | FashionablyLate')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<main class="confirm">
  <h2 class="confirm__title">Confirm</h2>

  <form method="POST" action="{{ route('contacts.confirm') }}">
    @csrf

    <div class="confirm__table-wrapper">
      <table class="confirm__table">

        <tr>
          <th>お名前</th>
          <td>
            {{ $inputs['last_name'] ?? '' }} {{ $inputs['first_name'] ?? '' }}
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] ?? '' }}">
            <input type="hidden" name="first_name" value="{{ $inputs['first_name'] ?? '' }}">
          </td>
        </tr>

         <tr>
          <th>性別</th>
          <td>
          @php
          $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
          @endphp
         {{ $genderLabels[$inputs['gender']] ?? '' }}
          <input type="hidden" name="gender" value="{{ $inputs['gender'] ?? '' }}">
         </td>
         </tr>


        <tr>
          <th>メールアドレス</th>
          <td>
            {{ $inputs['email'] ?? '' }}
            <input type="hidden" name="email" value="{{ $inputs['email'] ?? '' }}">
          </td>
        </tr>

        <tr>
          <th>電話番号</th>
          <td>
            {{ $inputs['tel1'] ?? '' }}-{{ $inputs['tel2'] ?? '' }}-{{ $inputs['tel3'] ?? '' }}
            <input type="hidden" name="tel1" value="{{ $inputs['tel1'] ?? '' }}">
            <input type="hidden" name="tel2" value="{{ $inputs['tel2'] ?? '' }}">
            <input type="hidden" name="tel3" value="{{ $inputs['tel3'] ?? '' }}">
          </td>
        </tr>

        <tr>
          <th>住所</th>
          <td>
            {{ $inputs['address'] ?? '' }}
            <input type="hidden" name="address" value="{{ $inputs['address'] ?? '' }}">
          </td>
        </tr>

        <tr>
          <th>建物名</th>
          <td>
            {{ $inputs['building'] ?? '' }}
            <input type="hidden" name="building" value="{{ $inputs['building'] ?? '' }}">
          </td>
        </tr>

       <tr>
        <th>お問い合わせの種類</th>
        <td>
         {{ $categoryName ?? '' }}
         <input type="hidden" name="category_id" value="{{ $inputs['category_id'] ?? '' }}">
        </td>
       </tr>

        <tr>
          <th>お問い合わせ内容</th>
          <td class="confirm__content">
            {{ $inputs['content'] ?? '' }}
            <input type="hidden" name="content" value="{{ $inputs['content'] ?? '' }}">
          </td>
        </tr>

      </table>
    </div>
  </form>

<!-- 送信用フォーム -->
<!-- ボタンエリア -->
<div class="confirm__actions">

  <!-- 送信 -->
  <form method="POST" action="{{ route('contacts.store') }}">
    @csrf
    @foreach ($inputs as $name => $value)
      <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="btn-submit">送信</button>
  </form>

  <!-- 修正 -->
  <form action="/" method="GET">
    @foreach ($inputs as $name => $value)
      <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="btn-edit">修正</button>
  </form>
</div>
</main>
@endsection