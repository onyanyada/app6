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

        <form action="{{ route('bio.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name">ニックネーム</label>
                <input type="text" name="name" value="{{ $bio->name }}">
            </div>
            <div>
                <label for="body">自己紹介</label>
                <textarea name="body" id="body" class="form-control" rows="5" required>{{ $bio->body }}</textarea>
            </div>
            <div>
                <label for="img">プロフィール画像</label>
                @if($bio->img_url)
                    <img src="{{ asset($bio->img_url) }}" alt="プロフィール画像" width="150">
                    <input type="checkbox" name="delete_img" value="{{ $bio->id }}"> この画像を削除
                @endif
                <input id="bio-input" type="file" name="img">
                <div id="bio-preview" class="mt-2">
                <!-- プレビュー表示領域 -->
                </div>
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</x-app-layout>