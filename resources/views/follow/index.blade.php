<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォロー中のユーザー一覧
        </h2>
    </x-slot>

    <div class="bg-gray-100 p-6">
        <!-- フォロー中のユーザーがいない場合のメッセージ -->
        @if ($followings->isEmpty())
            <p class="text-center text-gray-700">フォロー中のユーザーはいません。</p>
        @else
            <!-- フォロー中のユーザー一覧を表示 -->
            <ul>
                @foreach ($followings as $following)
                    <li class="p-2">
                        <a href="{{ url('/user/' . $following->id) }}" class="text-blue-500">
                            {{ $following->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
