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
    <div class="flex-1 text-gray-700 text-left bg-blue-100 px-4 py-2 m-2">
         <!-- 現在の本 -->
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <x-collection id="{{ $post->id }}">
                    <a href="{{ route('post_show', ['post' => $post->id]) }}">
                        {{ $post->title }}
                    </a>
                    @if (count($post->comments) > 0)
                    <p>{{ $post->comments->count() }} 件のコメント</p>
                    @endif
                </x-collection>
            @endforeach
        @endif
    </div>
    <!--右側エリア[[END]-->     

</div>
 <!--全エリア[END]-->

</x-app-layout>