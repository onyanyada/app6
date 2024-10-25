<!-- resources/views/user/show.blade.php -->
<x-app-layout>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!--ヘッダー[START]-->
    <x-slot name="header">

    </x-slot>
    <div class="container">
        <h1>{{ $user->name }} のプロフィール</h1>

        <!-- ユーザーの自己紹介 -->
        @if($user->bio)
            <p>{{ $user->bio->name }}</p>
            <p>{{ $user->bio->body }}</p>
            @if ($user->bio->img_url)
                <img src="{{ asset($user->bio->img_url) }}" alt="プロフィール画像" width="150">
            @endif
        @endif

        <!-- ユーザーの投稿一覧 -->
        <h2>{{ $user->name }} の投稿一覧</h2>
        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ route('post_show', ['post' => $post->id]) }}">
                        {{ $post->title }}
                    </a>
                    <p>投稿日: {{ $post->created_at }}</p>
                    <p>更新日: {{ $post->updated_at }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
