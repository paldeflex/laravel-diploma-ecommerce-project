<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Мои заказы</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Заказ</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Дата</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Статус заказа</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Статус оплаты</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Сумма заказа</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr wire:key="{{ $order->id }}" class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $order->created_at->locale('ru')->isoFormat('D MMMM YYYY') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    @php
                                        $orderStatusColor = match($order->status->getColor()) {
                                            'info' => 'bg-blue-500',
                                            'warning' => 'bg-orange-500',
                                            'success' => 'bg-green-500',
                                            'danger' => 'bg-red-500',
                                            default => 'bg-gray-500',
                                        };
                                    @endphp
                                    <span class="{{ $orderStatusColor }} py-1 px-3 rounded text-white shadow">{{ $order->status->getLabel() }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    @php
                                        $paymentStatusColor = match($order->payment_status->getColor()) {
                                            'warning' => 'bg-yellow-500',
                                            'success' => 'bg-green-500',
                                            'danger' => 'bg-red-500',
                                            default => 'bg-gray-500',
                                        };
                                    @endphp
                                    <span class="{{ $paymentStatusColor }} py-1 px-3 rounded text-white shadow">{{ $order->payment_status->getLabel() }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ Number::currency($order->grand_total, 'RUB', 'ru_RU')}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <a href="/my-orders/{{ $order->id }}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Посмотреть детали</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <p>Список заказов пуст</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
