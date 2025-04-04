<?php


namespace App\Models;

use App\Helper\DiscountHelper;
use Doctrine\DBAL\LockMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CartModel
{


    protected $totalPrice = 0;
    protected $products = [];
    protected $percentage = null;

    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
        $this->calculateTotalPrice();
    }

    public function setProducts(array $products)
    {
        $this->products = $products;
        $this->calculateTotalPrice();
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function main_discount($cookie): float|int
    {
        return DiscountHelper::get_total_price_after_discount($cookie);
    }

    protected function calculateTotalPrice(): void
    {
        $this->totalPrice = array_sum(array_map(function ($product) {
            if ($product['is_force'] == 1) {
                return DiscountHelper::getProductFinalPrice($product['cat_id'], $product['force_price'] * $product['quantity']);
            } else {
                return DiscountHelper::getProductFinalPrice($product['cat_id'], $product['price'] * $product['quantity']);

            }
        }, $this->products));
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function addProduct($product)
    {
        $existingProduct = collect($this->products)->firstWhere('id', $product['id']);
        if ($existingProduct) {
            $existingProduct['quantity'] += $product['quantity'];
        } else {
            $this->products[] = $product;
        }
        $this->calculateTotalPrice();
    }

    public function removeProduct($productId)
    {
        $this->products = collect($this->products)->reject(function ($product) use ($productId) {
            return $product['id'] === $productId;
        })->values()->all();
        $this->calculateTotalPrice();
    }
}
