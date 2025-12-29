@extends('layouts.admin')

@section('content')

<div class="pagination">
    <!-- 前ページリンク -->
    <a href="{{ $contacts->previousPageUrl() ?? '#' }}">‹</a>

    <!-- ページ番号 -->
    @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="{{ $contacts->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
    @endforeach

    <!-- 次ページリンク -->
    <a href="{{ $contacts->nextPageUrl() ?? '#' }}">›</a>
</div>

<table class="admin__table">
<thead>
<tr>
<th>お名前</th>
<th>性別</th>
<th>メールアドレス</th>
<th>お問い合わせの種類</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach($contacts as $contact)
<tr class="admin__row">
    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>

    <td>
        @if($contact->gender == 1)
            男性
        @elseif($contact->gender == 2)
            女性
        @else
            その他
        @endif
    </td>

    <td>{{ $contact->email }}</td>

    <td>
        @if ($contact->category_id == 1)商品のお届けについて
        @elseif ($contact->category_id == 2)商品の交換について
        @elseif ($contact->category_id == 3)商品トラブル
        @elseif ($contact->category_id == 4)ショップへのお問い合わせ
        @elseif ($contact->category_id == 5)その他
        @endif
    </td>

    <td class="admin__detail">
        <button
            type="button"
            class="admin__detail-btn"
            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
            data-gender="{{ $contact->gender }}"
            data-email="{{ $contact->email }}"
            data-tel="{{ $contact->tel }}"
            data-address="{{ $contact->address }}"
            data-building="{{ $contact->building }}"
            data-category="
                @if ($contact->category_id == 1) 商品のお届けについて
                @elseif ($contact->category_id == 2) 商品の交換について
                @elseif ($contact->category_id == 3) 商品トラブル
                @elseif ($contact->category_id == 4) ショップへのお問い合わせ
                @elseif ($contact->category_id == 5) その他
                @endif
            "
            data-detail="{{ $contact->detail }}"
        >
            詳細
        </button>
    </td>
</tr>
@endforeach
</tbody>
</table>

<!-- モーダル -->
<div class="modal" id="contactModal">
    <div class="modal__content">
        <span class="modal__close" id="modalClose">&times;</span>

        <h3>お問い合わせ詳細</h3>

        <p><strong>お名前：</strong><span id="modalName"></span></p>
        <p><strong>性別：</strong><span id="modalGender"></span></p>
        <p><strong>メールアドレス：</strong><span id="modalEmail"></span></p>
        <p><strong>電話番号：</strong><span id="modalTel"></span></p>
        <p><strong>住所：</strong><span id="modalAddress"></span></p>
        <p><strong>建物名：</strong><span id="modalBuilding"></span></p>
        <p><strong>お問い合わせの種類：</strong><span id="modalCategory"></span></p>
        <p><strong>お問い合わせ内容：</strong></p>
        <p id="modalDetail"></p>
    </div>
</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.admin__detail-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('modalName').textContent = this.dataset.name;

            const gender = this.dataset.gender;
            document.getElementById('modalGender').textContent =
                gender == 1 ? '男性' : gender == 2 ? '女性' : 'その他';

            document.getElementById('modalEmail').textContent = this.dataset.email;
            document.getElementById('modalTel').textContent = this.dataset.tel;
            document.getElementById('modalAddress').textContent = this.dataset.address;
            document.getElementById('modalBuilding').textContent = this.dataset.building;
            document.getElementById('modalCategory').textContent = this.dataset.category;
            document.getElementById('modalDetail').textContent = this.dataset.detail;

            document.getElementById('contactModal').style.display = 'flex';
        });
    });

    document.getElementById('modalClose').addEventListener('click', function () {
        document.getElementById('contactModal').style.display = 'none';
    });

});
</script>
@endpush

