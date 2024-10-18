<x-app-layout>
<div class="container">
    <h1>購入履歴</h1>

    @if($purchases->isEmpty())
        <p>購入履歴がありません。</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>記事タイトル</th>
                    <th>購入日</th>
                    <th>価格</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td><a href="{{ route('posts.show', $purchase->post->id) }}">{{ $purchase->post->title }}</a></td>
                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        <td>¥{{ number_format($purchase->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</x-app-layout>
