<x-app-layout> 
 <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    投稿する
                </div>
            </div>


            <!-- 本のタイトル -->
            <form action="{{ url('posts') }}" method="POST" class="w-full">
                @csrf
                  <div class="flex flex-col px-2 py-2">
                   <!-- カラム１ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                       タイトル
                      </label>
                       <input name="title" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="" value="{{ old('title') }}">
                         @error('title')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                      </div>
                    <!-- カラム２ -->
                    <div class="w-full md:w-1/1 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        内容
                      </label>
                      <input name="body" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="" value="{{ old('body') }}">
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
                        <option value="0" {{ old('is_public') == '0' ? 'selected' : '' }}>非公開</option>
                        <option value="1" {{ old('is_public') == '1' ? 'selected' : '' }}>公開</option>
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
                      <select name="is_paid" id="is_public" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"> 
                        <option value="0" {{ old('is_paid') == '0' ? 'selected' : '' }}>無料記事にする</option>
                        <option value="1" {{ old('is_paid') == '1' ? 'selected' : '' }}>有料記事にする</option>
                    </select>
                    @error('is_paid')
                      <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
                    <!-- カラム５ -->
                    <div class="w-full md:w-1/1 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        料金
                      </label>
                      <input name="price" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="" value="{{ old('price') }}">
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                              {{$category->name}}
                            </option>
                          @endforeach
                        @endif
                      </select>
                       @error('category_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                       @enderror
                    </div>
                  </div>
                  <!-- タグ入力欄 -->
                  <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                          タグ（カンマ区切りで複数指定可）
                      </label>
                      <input name="tags" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="例: Laravel, PHP, Web開発">
                      @error('tags')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                  </div>
                  <!-- カラム７ -->
                  <div class="flex flex-col">
                      <div class="text-gray-700 text-center px-4 py-2 m-2">
                             <x-button class="bg-blue-500 rounded-lg">送信</x-button>
                      </div>
                   </div>
            </form>
        </div>
    <!--左エリア[END]--> 
        
</x-app-layout>

