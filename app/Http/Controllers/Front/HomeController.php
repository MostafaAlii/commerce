<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\{Offer, Category, Product};
use Illuminate\Http\Request;
class HomeController extends Controller {
    public function __invoke() {
        $data = [];
        $data['title'] = trans('site/home.home');
        $data['offers'] = Offer::active()->get();
        $data['categories'] = Category::active()->with('products')->get();
        return view('front.home', $data);
    }

    public function showCategoriesProductData($id) {
        $data['category'] = Category::active()->with(['products' => function($query) {
            $query->where('status', true);
        }])->findOrFail($id);
        $data['title'] = trans('site/home.category_product');
        return view('front.category_product', $data);
    }

    public function productDetails($id) {
        $product = Product::findOrFail($id);
        return view('front.product_details', compact('product'));
    }
}
