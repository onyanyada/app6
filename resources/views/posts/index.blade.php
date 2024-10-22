<x-app-layout>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

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
                <select name="categories[]" class="form-control h-9 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ in_array($category->id, $selectedCategories ?? []) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- キーワード検索 -->
                <input type="text" name="search" class="form-control" placeholder="キーワードを入力" value="{{ request('search') }}">

                <!-- 検索ボタン -->
                <x-button class="bg-blue-500 rounded-lg h-7 w-13 mt-2">検索</x-button>
            </form>
        </div>
       
      <!-- ソートボタン -->
        <div class="flex justify-start m-2">
            <a href="{{ route('post_index', array_merge(request()->query(), ['sort' => 'likes'])) }}">
                <button class="bg-{{ request('sort') == 'likes' ? 'blue' : 'gray' }}-500 rounded-lg m-2 p-2 text-white">
                    いいね順
                </button>
            </a>
            <a href="{{ route('post_index', array_merge(request()->query(), ['sort' => 'newest'])) }}">
                <button class="bg-{{ request('sort') == 'newest' ? 'blue' : 'gray' }}-500 rounded-lg m-2 p-2 text-white">
                    最新
                </button>
            </a>
            <a href="{{ route('post_index', array_merge(request()->query(), ['sort' => 'oldest'])) }}">
                <button class="bg-{{ request('sort') == 'oldest' ? 'blue' : 'gray' }}-500 rounded-lg m-2 p-2 text-white">
                    古い順
                </button>
            </a>
        </div>
    <!--右側エリア[START]-->
    <div class="grid grid-cols-2 gap-4 text-gray-700 text-left px-4 py-2 m-2">
         <!-- 現在の本 -->
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <x-homecollection :post="$post" id="{{ $post->id }}">
                  <a href="{{ route('post_show', ['post' => $post->id]) }}">
                    {{ $post->title }}
                  </a>
                <p>投稿：{{ $post->created_at}}</p>
                <p>更新：{{ $post->updated_at}}</p>
                <p>カテゴリ：{{ $post->category->name}}</p>
                <p>{{ $post->comments->count() }} 件のコメント</p>
                <p>{{ $post->likes->count() }}件のいいね</p>
                @if($post->user && $post->user->bio)
                <p>投稿者：{{ $post->user->bio->name}}</p>
                @else
                    <p>投稿者：{{ $post->user->name }}</p>
                @endif
                @if($post->tags)                 
                <p>タグ:
                    @foreach($post->tags as $tag)
                        <span class="bg-gray-200 rounded px-2">{{ $tag->name }}</span>
                    @endforeach
                </p>
                @endif
                @if($post->images)
                    @foreach($post->images as $image)
                        <img src="{{ asset($image->img_url) }}" alt="Post Image" style="max-width: 300px;">
                    @endforeach
                @endif
                </x-homecollection>
            @endforeach
        @endif
    </div>
    <!--右側エリア[[END]-->     

</div>
 <!--全エリア[END]-->

</x-app-layout>
