<x-app-layout>

    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <form action="{{ route('post_index') }}" method="GET" class="w-full max-w-lg">
                <x-button class="bg-gray-100 text-gray-900">{{ __('Dashboard') }}：更新画面</x-button>
            </form>
        </h2>
    </x-slot>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
        <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
        <!-- バリデーションエラーの表示に使用-->
    
    <!--全エリア[START]-->
    <div class="bg-gray-100">

        <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    投稿を編集する
                </div>
            </div>


            <!-- 本のタイトル -->
            <form action="{{ url('posts/update/'.$post->id) }}" id="create-form" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                
                  <div class="flex flex-col px-2 py-2">
                   <!-- カラム１ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                       タイトル
                      </label>
                      <input name="title" value="{{$post->title}}" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                      @error('title')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- カラム２ -->
                    <div class="w-full md:w-1/1 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        内容
                      </label>
                      <input name="body" value="{{$post->body}}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="">
                      @error('body')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                    </div>
                    <!-- カラム３ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        公開
                      </label>
                      <select name="is_public" id="is_public" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="0" @if( $post->is_public ==0) selected  @endif>非公開</option>
                        <option value="1" @if( $post->is_public ==1) selected  @endif>公開</option>
                    </select>
                     @error('is_public')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    <!-- カラム４ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        有料or無料
                      </label>
                      <select name="is_paid" id="is_paid" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="0" @if( $post->is_public ==0) selected  @endif>無料記事</option>
                        <option value="1" @if( $post->is_public ==0) selected  @endif>有料記事</option>
                    </select>
                    @error('is_paid')
                      <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    <!-- カラム５ -->
                    <div class="w-full md:w-1/1 px-3" id="priceInput">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        料金(円)
                      </label>
                      <input name="price" value="{{$post->price}}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="">
                      @error('price')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                    </div>
                  <!-- カラム６ -->
                    <div class="w-full md:w-1/1 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        カテゴリ
                      </label>
                      <select name="category_id" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @if (count($categories) > 0)
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($post->category->id == $category->id) selected @endif>{{$category->name}}</option>
                          @endforeach
                        @endif
                      </select>
                       @error('category_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                       @enderror
                    </div>
                  </div>
                    <!-- カラム７ -->
                    <div class="w-full md:w-1/1 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            タグ（カンマ区切りで指定）
                        </label>
                        <input name="tags" value="{{ $postTags }}" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Laravel,PHP,Web開発">
                        @error('tags')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- カラム８ -->
                    <div class="w-full md:w-1/1 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            画像
                        </label>
                        @if($post->images)
                            @foreach($post->images as $image)
                              <img src="{{ asset($image->img_url) }}" alt="Post Image" style="max-width: 300px;">                     
                              <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> この画像を削除
                              @endforeach
                        @endif
                          <input id="image-input" type="file" name="images[]" multiple>
                          <div id="preview-container" class="mt-2">
                          <!-- プレビュー表示領域 -->
                          </div>

                        @error('images')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        @foreach($errors->get('images.*') as $message)
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                         @endforeach
                    </div>
                  <!-- カラム９ -->
                  <div class="flex flex-col">
                      <div class="text-gray-700 text-center px-4 py-2 m-2">
                             <x-button class="bg-blue-500 rounded-lg">更新</x-button>
                      </div>
                   </div>
                <!-- id値を送信 -->
                <input type="hidden" name="id" value="{{$post->id}}">
                <!--/ id値を送信 -->
            </form>
        </div>
        <!--左エリア[END]--> 
    
    
    

</div>
 <!--全エリア[END]-->

</x-app-layout>