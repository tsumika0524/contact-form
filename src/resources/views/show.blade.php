@extends('layouts.app')

@section('content')
<h2>お問い合わせ詳細</h2>

<p>名前：{{ $contact->last_name }} {{ $contact->first_name }}</p>
<p>性別：{{ $contact->gender }}</p>
<p>メール：{{ $contact->email }}</p>
<p>種類：{{ $contact->category->content ?? '' }}</p>

<a href="{{ route('admin.index') }}">戻る</a>
@endsection
