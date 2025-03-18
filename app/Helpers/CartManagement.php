<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    private const string COOKIE_NAME = 'cartItems';
    private const int|float COOKIE_LIFETIME = 60 * 24 * 30;

    public static function addItemToCart(int $productId): int
    {
        $cartItems = self::getCartItemsFromCookie();

        $index = self::findItemIndexById($cartItems, $productId);

        if ($index !== false) {
            $cartItems[$index]['quantity']++;
            $cartItems[$index]['totalAmount'] = $cartItems[$index]['quantity'] * $cartItems[$index]['unitAmount'];
        } else {
            $product = Product::where('id', $productId)->firstOrFail(['id', 'name', 'price', 'images']);
            $cartItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->images[0] ?? null,
                'quantity' => 1,
                'unitAmount' => $product->price,
                'totalAmount' => $product->price,
            ];
        }

        self::addCartItemsToCookie($cartItems);
        return count($cartItems);
    }

    public static function removeItemFromCart(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();

        $index = self::findItemIndexById($cartItems, $productId);

        if ($index !== false) {
            unset($cartItems[$index]);
            $cartItems = array_values($cartItems);
        }

        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    public static function incrementQuantityToCartItem(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();

        $index = self::findItemIndexById($cartItems, $productId);

        if ($index !== false) {
            $cartItems[$index]['quantity']++;
            $cartItems[$index]['totalAmount'] = $cartItems[$index]['quantity'] * $cartItems[$index]['unitAmount'];
        }

        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    public static function decrementQuantityToCartItem(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();

        $index = self::findItemIndexById($cartItems, $productId);

        if ($index !== false && $cartItems[$index]['quantity'] > 1) {
            $cartItems[$index]['quantity']--;
            $cartItems[$index]['totalAmount'] = $cartItems[$index]['quantity'] * $cartItems[$index]['unitAmount'];
        }

        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    public static function calculateGrandTotal(array $items): float
    {
        return array_sum(array_column($items, 'totalAmount'));
    }

    public static function addCartItemsToCookie(array $cartItems): void
    {
        Cookie::queue(self::COOKIE_NAME, json_encode($cartItems), self::COOKIE_LIFETIME);
    }

    public static function clearCartItemsFromCookie(): void
    {
        Cookie::queue(Cookie::forget(self::COOKIE_NAME));
    }

    public static function getCartItemsFromCookie(): array
    {
        $cartItems = json_decode(Cookie::get(self::COOKIE_NAME), true);
        return $cartItems ?: [];
    }

    private static function findItemIndexById(array $cartItems, int $productId): false|int|string
    {
        foreach ($cartItems as $index => $item) {
            if ($item['id'] === $productId) {
                return $index;
            }
        }
        return false;
    }
}
