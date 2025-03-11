<footer class="bg-gray-900">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto" id="footer">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <div class="col-span-full lg:col-span-1">
                <x-logo />
            </div>
            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Продукция</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/categories">Категории</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products">Все товары</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products">Рекомендуемые товары</a></p>
                </div>
            </div>
            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Компания</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">О нас</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">Блог</a></p>

                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">Клиенты</a></p>
                </div>
            </div>
            <div class="col-span-2">
                <h4 class="font-semibold text-gray-100">Будьте в курсе</h4>

                <form>
                    <div class="mt-4 flex flex-col items-center gap-2 sm:flex-row sm:gap-3 bg-white rounded-lg p-2 dark:bg-gray-800">
                        <div class="w-full">
                            <input type="text" id="hero-input" name="hero-input" class="py-3 px-4 block w-full border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Введите ваш email">
                        </div>
                        <a class="w-full sm:w-auto whitespace-nowrap p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
                            Подписаться
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
