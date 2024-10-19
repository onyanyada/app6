<x-app-layout>

    <!--ヘッダー[START]-->
    <x-slot name="header">

    </x-slot>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
        <!-- バリデーションエラーの表示に使用-->
    
    <!--全エリア[START]-->
<div class="bg-gray-100">
        <div class="text-gray-700 text-left px-4 py-2 m-2">
            <h3>カテゴリ・キーワード検索</h3>
            <form action="{{ route('post_index') }}" method="GET" class="">
                <!-- カテゴリ検索 -->
                <select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ in_array($category->id, $selectedCategories ?? []) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- キーワード検索 -->
                <input type="text" name="search" class="form-control mt-2" placeholder="キーワードを入力" value="{{ request('search') }}">

                <!-- 検索ボタン -->
                <x-button class="bg-blue-500 rounded-lg h-7 w-13 mt-2">検索</x-button>
            </form>
        </div>
       
    
    <!--右側エリア[START]-->
    <div class="grid grid-cols-2 gap-4 w-screen text-gray-700 text-left px-4 py-2 m-2">
         <!-- 現在の本 -->
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <x-homecollection :post="$post" id="{{ $post->id }}">
                  <a href="{{ route('post_show', ['post' => $post->id]) }}">
                    {{ $post->title }}
                  </a>
                <p>カテゴリ：{{ $post->category->name}}</p>
                <p>{{ $post->comments->count() }} 件のコメント</p>
                <p>{{ $post->likes->count() }}件のいいね</p>
                <p>投稿者：{{ $post->user->bio->name}}</p>
                </x-homecollection>
            @endforeach
        @endif
    </div>
    <!--右側エリア[[END]-->     

</div>
 <!--全エリア[END]-->

</x-app-layout>
