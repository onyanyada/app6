<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('決済方法を選択してください') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h3>購入する記事: {{ $post->title }}</h3>
                    <p>価格: ¥{{ $post->price }}</p>

                    <!-- 決済方法を選択 -->
                    <form action="{{ route('purchase.store', $post) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">決済方法を選択</label>
                            <select name="payment_method" id="payment_method" class="block w-full mt-1 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">選択してください</option>
                                <option value="credit_card">クレジットカード</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">銀行振込</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-button type="submit" class="btn btn-primary">購入を確定する</x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
