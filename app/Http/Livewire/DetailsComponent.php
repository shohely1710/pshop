<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Product;
use App\Models\Category;
use Cart;

class DetailsComponent extends Component
{
    public $slug;  // A Slug is the unique identifying part of a web address, typically at the end of the URL

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id,  $product_name, 1, $product_price)->associate('App\Models\Product');//id, name,quantity, price
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();

        return view('livewire.details-component', ['product'=>$product, 'popular_products'=>$popular_products, 'related_products'=>$related_products])->layout('layouts.base');
    }
}
