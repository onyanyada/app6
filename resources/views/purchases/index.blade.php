<x-app-layout>

    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2>購入履歴</h2>
    </x-slot>
    <!--ヘッダー[END]-->
    <!--全エリア[START]-->
    <div class="flex bg-gray-100">
        

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
                            <td><a href="{{ route('post_show', $purchase->post->id) }}">{{ $purchase->post->title }}</a></td>
                            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                            <td>¥{{ number_format($purchase->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <!--全エリア[END]-->

</x-app-layout>
