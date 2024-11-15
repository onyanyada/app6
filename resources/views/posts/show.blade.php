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

       
    
    <!--右側エリア[START]-->
    <div class="flex-1 text-gray-700 text-left bg-white px-4 py-2 m-2">
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
                </div>

    </div>
    <!-- 購入ボタン -->
    {{-- Purchaseモデルに現在ログインしているユーザーのIDが含まれているか --}}
    @if (Auth::check() && !$post->purchases->contains('user_id', Auth::id()))
        <!-- ログインしているかつ、まだ購入していない場合のみ表示 -->
        <button>
            <a href="{{ route('purchase.show', $post) }}" class="btn btn-primary">
                購入ページへ進む
            </a>
        </button>
    @else
        <p>この記事は既に購入済みです。</p>
    @endif

    

    <!-- いいねの表示 -->
    <div>
        @if($post->likes->where('user_id', Auth::id())->count() > 0)
            <!-- いいねを取り消すボタン -->
            <form action="{{ route('like.destroy', ['post' => $post->id]) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    いいねを取り消す
                </button>
            </form>
        @else
            <!-- いいねをするボタン -->
            <form action="{{ route('like.store', ['post' => $post->id]) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    いいね
                </button>
            </form>
        @endif
    </div>
    <!-- いいねの数を表示 -->
        <p>{{ $post->likes->count() }} 件のいいね</p>
    <!--右側エリア[[END]-->
     <!-- コメントフォーム -->
     
        <h2>コメントを追加</h2>
        <form action="{{ route('comment.store', ['post' => $post->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <textarea name="comment" class="w-full border border-gray-300 p-2 rounded" rows="4" placeholder="コメントを入力">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                コメントする
            </button>
        </form>

        <!-- コメントの表示 -->
        <div>
            <h2>コメント一覧</h2>
            <p>{{ $post->comments->count() }} 件のコメント</p>
            @if ($post->comments->count() > 0)
                <ul>
                    @foreach ($post->comments as $comment)
                        <li class="border-b border-gray-300 py-2">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                            <br>
                            <span class="text-sm text-gray-500">{{ $comment->created_at }}</span>

                            <!-- コメントの削除ボタン -->
                            @if (Auth::id() === $comment->user_id)
                                <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">削除</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p>まだコメントがありません。</p>
            @endif     
        </div>
</div>
 <!--全エリア[END]-->

</x-app-layout>
