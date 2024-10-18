<div class="flex justify-between p-4 m-4 items-center bg-white text-black rounded-lg border-2 border-black">
  <div>{{ $slot }}
          <a href="{{ route('post_show', ['post' => $post->id]) }}">
          <p>タイトル：{{ $post->title }}</p>
          {{-- 公開非公開 --}}
          @if($post->is_public == 0 )
          <p>非公開</p>
          @elseif($post->is_public == 1)
          <p>公開</p>
          @endif
          {{-- 無料有料 --}}
          @if($post->is_paid == 0 )
          <p>無料記事</p>
          @elseif($post->is_paid == 1)
          <p>有料記事</p>
          @endif
          {{-- 値段 --}}
          <p>{{ $post->price }}円</p>
          <p>カテゴリ：{{ $post->category->name }}</p>
      </a>
      @if (count($post->comments) > 0)
      <p>{{ $post->comments->count() }} 件のコメント</p>
      @endif
  </div>
    <div>
    <form action="{{ url('posts/edit/'.$id) }}" method="POST">
         @csrf
         
        <button type="submit"  class="btn">
            更新
        </button>
        
     </form>
  </div>
  
  <div>
    <form action="{{ url('post/'.$id) }}" method="POST">
         @csrf
         @method('DELETE')
        
        <button type="submit"  class="btn ">
            削除
        </button>
        
     </form>
  </div>
  


</div>