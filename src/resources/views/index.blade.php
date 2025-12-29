@extends('layouts.app')

@section('title', 'Contact | FashionablyLate')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main class="contact">
  <h2 class="contact__title">Contact</h2>
  <form class="form" action="/contacts/confirm" method="post">
    @csrf

  <div class="form-group">
  <label>お名前<span>※</span></label>

  <div class="name-inputs">
    <!-- 姓 -->
    <div class="name-field">
      <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
      @error('last_name')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <!-- 名 -->
    <div class="name-field">
      <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
      @error('first_name')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>
  </div>
  </div>

   <div class="form-group">
      <label>性別<span>※</span></label>
    <div class="radio-group">
     <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性</label>
     <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性</label>
     <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他</label>
    </div>
      @error('gender') <p class="error">{{ $message }}</p> @enderror
   </div>

  <div class="form-group">
  <label>メールアドレス<span>※</span></label>
  <div class="field">
    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
    @error('email')
      <p class="error">{{ $message }}</p>
    @enderror
  </div>
  </div>
    <div class="form-group">
      <label>電話番号<span>※</span></label>
      <div class="tel-inputs">
       <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
       <span>-</span>
       <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
       <span>-</span>
       <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
    </div>
       @error('tel1') <p class="error">{{ $message }}</p> @enderror
    </div>

     <div class="form-group">
     <label>住所<span>※</span></label>
     <div class="field">
     <input type="text" name="address" placeholder="例: 東京都渋谷区1-1-1" value="{{ old('address') }}">
      @error('address')
      <p class="error">{{ $message }}</p>
    @enderror
    </div>
   </div>

   <div class="form-group">
    <label>建物名</label>
    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}" >
    @error('building') <p class="error">{{ $message }}</p> @enderror
   </div>


 <div class="form-group">
  <label>お問い合わせの種類<span>※</span></label>

  <div class="field">
    <select name="category_id">
      <option value="">選択してください</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->content }}</option>
       @endforeach
    </select>
    @error('category_id')
      <p class="error">{{ $message }}</p>
    @enderror
  </div>
</div>

  <div class="form-group">
  <label>お問い合わせ内容<span>※</span></label>
  <div class="field">
    <textarea
      name="content"
      placeholder="お問い合わせ内容をご記入ください"
    >{{ old('content') }}</textarea>

    @error('content')
      <p class="error">{{ $message }}</p>
    @enderror
  </div>
</div>

  
</div>


    <div class="form-button">
      <button type="submit">確認画面</button>
    </div>
  </form>
</main>
@endsection

</body>
</html>
