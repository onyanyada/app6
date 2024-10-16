<x-app-layout>

    <!--ヘッダー[START]-->
    <x-slot name="header">

    </x-slot>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
        <!-- バリデーションエラーの表示に使用-->
    
    <!--全エリア[START]-->
    <div class="flex bg-gray-100">

       
    
    <!--右側エリア[START]-->
    <div class="grid grid-cols-2 gap-4 w-screen text-gray-700 text-left px-4 py-2 m-2">
         <!-- 現在の本 -->
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <x-homecollection id="{{ $post->id }}">
                  <a href="{{ route('post_show', ['post' => $post->id]) }}">
                    {{ $post->title }}
                  </a>
                 <!-- コメント数を表示 -->
                <p>{{ $post->comments->count() }} 件のコメント</p>
                <p>{{ $post->likes->count() }}件のいいね</p>
                </x-homecollection>
            @endforeach
        @endif
    </div>
    <!--右側エリア[[END]-->     

</div>
 <!--全エリア[END]-->

</x-app-layout>
