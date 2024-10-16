<div class="flex justify-between p-4 m-4 items-center bg-white text-black rounded-lg border-2 border-black">
  <div>{{ $slot }}</div>
  
    <div>
    <form action="{{ url('postsedit/'.$id) }}" method="POST">
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