<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Корзина</h1>
    <div class="flex flex-col lg:flex-row gap-4">
        <div class="w-full lg:w-3/4">
            <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-4">
                <!-- Оберните таблицу в дополнительный контейнер и установите минимальную ширину для таблицы на маленьких экранах -->
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
                        <tr>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img class="h-16 w-16 mr-4" src="https://picsum.photos/150"
                                         alt="Изображение товара">
                                    <span class="font-semibold">Название товара</span>
                                </div>
                            </td>
                            <td class="py-4 px-2">1499 &#8381;</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <button class="border rounded-md py-2 px-4 mr-2">-</button>
                                    <span class="text-center w-8">1</span>
                                    <button class="border rounded-md py-2 px-4 ml-2">+</button>
                                </div>
                            </td>
                            <td class="py-4 px-2">1499 &#8381;</td>
                            <td class="py-4 px-2">
                                <button
                                    class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                    Удалить
                                </button>
                            </td>
                        </tr>
                        <!-- Дополнительные строки товаров -->
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
                    <span>1499 &#8381;</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Налоги</span>
                    <span>149 &#8381;</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Доставка</span>
                    <span>0 &#8381;</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Итого</span>
                    <span class="font-semibold">1648 &#8381;</span>
                </div>
                <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Оформить заказ</button>
            </div>
        </div>
    </div>
</div>
