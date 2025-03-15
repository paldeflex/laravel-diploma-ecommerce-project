<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">
        @forelse($categories as $category)
            <a wire:key="{{ $category->id }}"
               class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
               href="#">
                <div class="p-4 md:p-5">
                    <div class="flex items-center">
                        <div class="flex items-center flex-grow">
                            <img class="h-[5rem] w-[5rem] flex-shrink-0" src="{{ $category->image_url}}"
                                 alt="{{$category->name}}">
                            <div class="ms-3 flex-grow self-center">
                                <h3 class="group-hover:text-blue-600 text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200 break-words hyphens-auto">
                                    {{$category->name}}
                                </h3>
                            </div>
                        </div>
                        <div class="ps-3 flex-shrink-0 self-center">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
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
