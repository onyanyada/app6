<x-app-layout> 
        <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2>自己紹介を作成</h2>
    </x-slot>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
        <!-- バリデーションエラーの表示に使用-->
        

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('bio.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">ニックネーム</label>
                <input type="text" name="name">{{ old('name') }}
            </div>
            <div>
                <label for="body">自己紹介</label>
                <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
</x-app-layout>

