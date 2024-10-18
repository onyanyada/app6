<div class="flex justify-between p-4 items-center bg-white text-black rounded-lg border-2 border-black">
  <div>{{ $slot }}
    {{-- 無料有料 --}}
      @if($post->is_paid == 1)
      <p>有料記事</p>
      <p>{{ $post->price }}円</p>
      @endif
  </div>

  

</div>