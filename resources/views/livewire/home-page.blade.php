<div>
    <div
        class="flex h-screen justify-center items-center w-full bg-gradient-to-r from-blue-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Снежинские краски</h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Производство антикоррозионных и
                        огнезащитных лакокрасочных материалов и систем.</p>
                    <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                           href="/register">
                            Посмотреть продукцию
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                           href="/contact">
                            Связаться с нами
                        </a>
                    </div>
                </div>
                <div class="relative ms-4">
                    <img class="w-full sm:w-4/5 md:w-full max-w-xs sm:max-w-sm md:max-w-md mx-auto rounded-md object-cover object-center"
                         src="{{ Vite::asset('resources/images/hero-image.webp') }}" alt="Image Description">

                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0"></div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200">
                        Типы <span class="text-blue-500">покрытий</span>
                    </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200"></div>
                        <div class="flex-1 h-2 bg-blue-400"></div>
                        <div class="flex-1 h-2 bg-blue-600"></div>
                    </div>
                </div>
                @if($coatingTypes->isNotEmpty())
                    <p class="mb-12 text-base text-center text-gray-500">
                        Наш ассортимент разнообразных покрытий
                    </p>
                @endif
            </div>
        </div>
        <div class="max-w-6xl px-4 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($coatingTypes as $coatingType)
                    <a href="/products?selectedCoatingTypes[0]={{ $coatingType->id }}" wire:key="{{ $coatingType->id }}"
                       class="block p-6 transition-transform transform bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg hover:scale-105 hover:bg-blue-50 dark:hover:bg-gray-700">
                        <h2 class="mb-2 text-2xl font-semibold text-blue-600 dark:text-blue-400">{{ $coatingType->name }}</h2>
                        <p class="text-gray-700 dark:text-gray-300">{{ $coatingType->description }}</p>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
                        <p class="text-lg text-gray-500">
                            На данный момент типы покрытий недоступны. Пожалуйста, зайдите позже.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <div class="bg-blue-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200"> Список <span class="text-blue-500"> категорий
          </span></h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                @if($categories->isNotEmpty())
                    <p class="mb-12 text-base text-center">
                        Ознакомьтесь с широким ассортиментом продукции
                    </p>
                @endif
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                @forelse($categories as $category)
                    <a wire:key="{{ $category->id }}" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                       href="/products?selectedCategories[0]={{ $category->id }}">
                        <div class="p-4 md:p-5">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                         src="{{ $category->image_url}}"
                                         alt="{{$category->name}}">
                                    <div class="ms-3">
                                        <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                            {{$category->name}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="ps-3">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
                        <p class="text-lg text-gray-500">
                            На данный момент категории недоступны. Пожалуйста, зайдите позже.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
