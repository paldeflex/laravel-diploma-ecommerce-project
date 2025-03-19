<x-mail::message>
# Заказ успешно оформлен!

Спасибо за ваш заказ! Номер вашего заказа - {{ $order->id }}.

<x-mail::button :url="$url">
    Посмотреть заказ
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
