<x-app-layout> 
    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2>自己紹介</h2>
    </x-slot>
    <!--ヘッダー[END]-->
    <div>
        @if ($bio)
            {{ $bio->name }}
            {{ $bio->body }}
            <x-button><a href="{{ route('bio.edit')}}">編集する</a></x-button>
        @else
            <x-button><a href="{{ route('bio.create')}}">作成する</a></x-button>
        @endif
    </div>
    
</x-app-layout>