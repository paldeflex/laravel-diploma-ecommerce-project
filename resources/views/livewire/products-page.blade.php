<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Категории</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @forelse($categories->take($categoriesToShow) as $category)
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{$category->slug}}" class="flex items-center dark:text-gray-400 cursor-pointer">
                                        <input type="checkbox" class="w-4 h-4 mr-2 min-w-[16px] min-h-[16px]"
                                               id="{{$category->slug}}" value="{{ $category->id }}">
                                        <span class="text-lg ml-1">{{$category->name}}</span>
                                    </label>
                                </li>
                            @empty
                                <p class="text-lg ml-1">Категории не найдены</p>
                            @endforelse
                        </ul>

                        @if($categoriesToShow < $categories->count())
                            <button wire:click="loadMoreCategories"
                                    class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300">
                                Показать ещё
                            </button>
                            <span wire:loading wire:target="loadMoreCategories" class="ml-2">Загрузка...</span>
                        @endif
                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Типы покрытий</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @forelse($coatingTypes->take($coatingTypesToShow) as $coatingType)
                                <li class="mb-4" wire:key="{{ $coatingType->id }}">
                                    <label for="{{ $coatingType->slug }}" class="flex items-center dark:text-gray-300 cursor-pointer">
                                        <input type="checkbox" class="w-4 h-4 mr-2 min-w-[16px] min-h-[16px]" id="{{ $coatingType->slug }}" value="{{ $coatingType->id }}">
                                        <span class="text-lg ml-1 dark:text-gray-400">{{ $coatingType->name }}</span>
                                    </label>
                                </li>
                            @empty
                                <p class="text-lg ml-1">Типы покрытий не найдены</p>
                            @endforelse
                        </ul>
                        @if($coatingTypesToShow < $coatingTypes->count())
                            <button wire:click="loadMoreCoatingTypes"
                                    class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300">
                                Показать ещё
                            </button>
                            <span wire:loading wire:target="loadMoreCoatingTypes" class="ml-2">Загрузка...</span>
                        @endif

                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Статус товара</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="inStock" class="flex items-center dark:text-gray-300 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 mr-2 min-w-[16px] min-h-[16px]" id="inStock">
                                    <span class="text-lg ml-1 dark:text-gray-400">В наличии</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label for="sale" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" class="w-4 h-4 mr-2 min-w-[16px] min-h-[16px]" id="sale">
                                    <span class="text-lg ml-1 dark:text-gray-400">Распродажа</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Цена</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <div>
                            <input type="range"
                                   class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                   max="500000" value="100000" step="100000">
                            <div class="flex justify-between ">
                                <span class="inline-block text-lg font-bold text-blue-400 ">1000 &#8381;</span>
                                <span class="inline-block text-lg font-bold text-blue-400 ">500000 &#8381;</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div
                            class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                            <div class="flex items-center justify-between">
                                <select id="countries"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Сортировать по новизне</option>
                                    <option value="">Сортировать по цене</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-wrap -mx-3">
                            @forelse($products as $product)
                                <a href="/products/{{ $product->slug }}" class="w-full sm:w-1/2 md:w-1/3 p-3" wire:key="{{ $product->id }}">
                                    <div class="flex flex-col h-full border border-gray-300 dark:border-gray-700 transition-transform duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full h-56">
                                        <div class="p-3 flex-grow">
                                            <h3 class="text-xl font-medium dark:text-gray-400">
                                                {{ $product->name }}
                                            </h3>
                                            <p class="text-lg text-blue-500 font-bold">
                                                {{ Number::currency($product->price, 'RUB', 'ru_RU') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-center w-full">Товары не найдены.</p>
                            @endforelse
                        </div>
                        @if($products->hasMorePages())
                            <div x-data="{}" x-intersect="$wire.loadMore()">
                                <div wire:loading class="text-center my-4">
                                    Загрузка...
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
