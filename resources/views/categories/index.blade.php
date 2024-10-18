<x-app-layout>
    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2 >カテゴリ</h2>
    </x-slot>
    <!--ヘッダー[END]-->

            
    <!-- バリデーションエラーの表示に使用-->
    <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
    <!-- バリデーションエラーの表示に使用-->

<!--全エリア[START]-->
<div class="bg-gray-100 max-w-7xl mx-auto">
    <x-button class="bg-blue-500 rounded-lg"><a href="{{ route('category_create') }}">カテゴリ追加</a></x-button>

    <!-- カテゴリ一覧 -->
    <div class="right-area flex-1 text-gray-700 text-left px-4 py-2 m-2">
    <table>
        @if (count($categories) > 0)
            @foreach ($categories as $category)
                <tr id="{{ $category->id }}" class="">
                    <td>{{ $category->name }}</td>
                    <td class="btn-group">
                        <!-- 編集リンク -->
                        <a href="{{ route('category_edit', $category->id) }}" class="btn btn-sm btn-warning">編集</a>
                    </td>
                    <td>
                        <!-- 削除フォーム -->
                        <form action="{{ route('category_destroy', $category->id) }}" method="POST" action="/category" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>

</div>
</x-app-layout>