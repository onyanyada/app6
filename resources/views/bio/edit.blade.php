<x-app-layout> 
    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2>自己紹介を作成</h2>
    </x-slot>
    <!--ヘッダー[END]-->
        <h1>自己紹介を編集</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('bio.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="body">自己紹介</label>
                <textarea name="body" id="body" class="form-control" rows="5" required>{{ $bio->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</x-app-layout>