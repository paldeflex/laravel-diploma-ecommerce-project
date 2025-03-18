<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Корзина</h1>
    <div class="flex flex-col lg:flex-row gap-4">
        <div class="w-full lg:w-3/4">
            <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-4">
                <div class="overflow-x-auto">
                    <table class="w-full" style="min-width: 700px;">
                        <thead>
                        <tr>
                            <th class="text-left font-semibold p-2">Товар</th>
                            <th class="text-left font-semibold p-2">Цена</th>
                            <th class="text-left font-semibold p-2">Количество</th>
                            <th class="text-left font-semibold p-2">Итого</th>
                            <th class="text-left font-semibold p-2">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cartItems as $cartItem)
                            <tr wire:key="{{ $cartItem['id'] }}">
                                <td class="py-4 px-2">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4" src="{{ $cartItem['image_url'] }}"
                                             alt="{{$cartItem['name']}}">
                                        <span class="font-semibold">{{$cartItem['name']}}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-2">{{ Number::currency($cartItem['unitAmount'], 'RUB', 'ru_RU') }}</td>
                                <td class="py-4 px-2">
                                    <div class="flex items-center">
                                        <button wire:click="decreaseQty({{$cartItem['id']}})" class="border rounded-md py-2 px-4 mr-2">-</button>
                                        <span class="text-center w-8">{{$cartItem['quantity']}}</span>
                                        <button wire:click="increaseQty({{$cartItem['id']}})" class="border rounded-md py-2 px-4 ml-2">+</button>
                                    </div>
                                </td>
                                <td class="py-4 px-2">{{ Number::currency($cartItem['totalAmount'], 'RUB', 'ru_RU') }}</td>
                                <td class="py-4 px-2">
                                    <button
                                        wire:click="removeItem({{ $cartItem['id'] }})"
                                        class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                        <span wire:loading.remove wire:target="removeItem({{ $cartItem['id'] }})">Удалить</span>
                                        <span wire:loading wire:target="removeItem({{ $cartItem['id'] }})">Удаление...</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-4xl font-semibold">
                                    <p>Корзина пуста</p>
                                </td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Сводка</h2>
                <div class="flex justify-between mb-2">
                    <span>Подытог</span>
                    <span>{{ Number::currency($grandTotal, 'RUB', 'ru_RU') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Налоги</span>
                    <span>{{ Number::currency(0, 'RUB', 'ru_RU') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Доставка</span>
                    <span>{{ Number::currency(0, 'RUB', 'ru_RU') }}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Итого</span>
                    <span class="font-semibold">{{ Number::currency(0, 'RUB', 'ru_RU') }}</span>
                </div>
                @if($cartItems)
                    <a href="/checkout" class="bg-blue-500 block text-white text-center py-2 px-4 rounded-lg mt-4 w-full">Оформить заказ</a>
                @endif
            </div>
        </div>
    </div>
</div>
