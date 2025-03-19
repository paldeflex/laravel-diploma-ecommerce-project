<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        Оформление заказа
    </h1>
    <form wire:submit.prevent="placeOrder" >
        <div class="grid grid-cols-12 gap-4">
        <div class="md:col-span-12 lg:col-span-8 col-span-12">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <!-- Shipping Address -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-700 dark:text-white mb-2">
                        Адрес доставки
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                Имя
                            </label>
                            <input wire:model="firstName" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('firstName') border-red-500 @enderror dark:text-white dark:border-none" id="first_name" type="text">
                            @error('firstName')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                Фамилия
                            </label>
                            <input wire:model="lastName" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('lastName') border-red-500 @enderror dark:text-white dark:border-none" id="last_name" type="text">
                            @error('lastName')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                            Телефон
                        </label>
                        <input wire:model="phone" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('phone') border-red-500 @enderror dark:text-white dark:border-none" id="phone" type="text">
                        @error('phone')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-white mb-1" for="address">
                            Адрес
                        </label>
                        <input wire:model="address" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('address') border-red-500 @enderror dark:text-white dark:border-none" id="address" type="text">
                        @error('address')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-white mb-1" for="city">
                            Город
                        </label>
                        <input wire:model="city" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('city') border-red-500 @enderror dark:text-white dark:border-none" id="city" type="text">
                        @error('city')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-gray-700 dark:text-white mb-1" for="state">
                                Область
                            </label>
                            <input wire:model="region" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('region') border-red-500 @enderror dark:text-white dark:border-none" id="state" type="text">
                            @error('region')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                                Почтовый индекс
                            </label>
                            <input wire:model="zipCode" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 @error('zipCode') border-red-500 @enderror dark:text-white dark:border-none" id="zip" type="text">
                            @error('zipCode')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-lg font-semibold mb-4">
                    Выберите способ оплаты
                </div>
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    @foreach($paymentMethods as $method)
                        <li>
                            <input wire:model="paymentMethod"
                                   class="hidden peer"
                                   id="payment-{{ $method->value }}"
                                   required
                                   type="radio"
                                   value="{{ $method->value }}" />
                            <label for="payment-{{ $method->value }}"
                                   class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">{{ $method->getLabel() }}</div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>
                @error('paymentMethod')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <!-- End Card -->
        </div>
        <div class="md:col-span-12 lg:col-span-4 col-span-12">
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Промежуточный итог
                    </span>
                    <span>
                        {{Number::currency($grandTotal, 'RUB', 'ru_RU')}}
                    </span>
                </div>
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Налоги
                    </span>
                    <span>
                         {{Number::currency(0, 'RUB', 'ru_RU')}}
                    </span>
                </div>
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Стоимость доставки
                    </span>
                    <span>
                        {{Number::currency(0, 'RUB', 'ru_RU')}}
                    </span>
                </div>
                <hr class="bg-slate-400 my-4 h-1 rounded">
                <div class="flex justify-between mb-2 font-bold">
                    <span>
                        Общая сумма
                    </span>
                    <span>
                        {{Number::currency($grandTotal, 'RUB', 'ru_RU')}}
                    </span>
                </div>
            </div>
            <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                <span wire:loading.remove>Оформить заказ</span>
                <span wire:loading>Загрузка...</span>
            </button>
            <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                    Товары в корзине
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                    @foreach ($cartItems as $item)
                        <li class="py-3 sm:py-4" wire:key="{{$item['id']}}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img alt="{{$item['name']}}" class="w-12 h-12 rounded-full" src="{{$item['image_url']}}">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{$item['name']}}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        Количество: {{$item['quantity']}}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{Number::currency($item['totalAmount'], 'RUB', 'ru_RU')}}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </form>
</div>
