<?php


namespace App\Models;

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

    protected function calculateTotalPrice()
    {
        $this->totalPrice = array_sum(array_map(function ($product) {
            if ($product['is_force'] == 1) {
                return $product['force_price'] * $product['quantity'];
            } else {
                return $product['price'] * $product['quantity'];

            }
        }, $this->products));
    }

    public function getTotalPrice()
    {
        if ($this->percentage != null) {
            return $this->totalPrice - (($this->percentage * $this->totalPrice) / 100);
        }
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
