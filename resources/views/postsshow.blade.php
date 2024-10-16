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
    <div class="flex-1 text-gray-700 text-left bg-red-100 px-4 py-2 m-2">
         <!-- 現在の本 -->

                <div id="{{ $post->id }}">
                    ブログ内容
                  {{ $post->title }}
                  中身
                  {{ $post->body }}
                  作成日時
                  {{ $post->created_at }}
                  更新日時
                  {{ $post->updated_at }}
                </div>

    </div>
    <!--右側エリア[[END]-->     

</div>
 <!--全エリア[END]-->

</x-app-layout>
