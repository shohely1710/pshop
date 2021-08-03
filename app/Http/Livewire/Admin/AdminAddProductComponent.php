<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class AdminAddProductComponent extends Component
{
    public function render()
    {
        $categories = Category::all(); //fetch all categories from db
        return view('livewire.admin.admin-add-product-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
