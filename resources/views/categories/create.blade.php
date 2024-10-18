<x-app-layout>

    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            更新画面
        </h2>
    </x-slot>
<!--全エリア[START]-->
<div class="bg-gray-100 max-w-7xl mx-auto">
    <!--左エリア[START]--> 
    <div class="left-area text-gray-700 text-left px-4 py-4 m-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-500 font-bold">
                カテゴリ
            </div>
        </div>      
        <!-- カテゴリ追加フォーム -->
        <form action="{{ route('category_store') }}" method="POST" class="w-full">
            @csrf
            <div class="flex flex-col px-2 py-2">
                <!-- カラム１ -->
                <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    カテゴリ名
                    </label>
                    <input name="name" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                </div>
                  <!-- カラム５ -->
                  <div class="flex flex-col">
                      <div class="text-gray-700 text-center px-4 py-2 m-2">
                             <x-button class="bg-blue-500 rounded-lg">追加</x-button>
                      </div>
                   </div>
        </form>
    </div>
</div>
 <!--全エリア[END]-->

</x-app-layout>