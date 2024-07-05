<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
class BrandsController extends Controller {
    public function index() {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.brands.index', compact('brands'));
    }

    public function store(Request $request) {
        $brands_list = $request->brands_list;
        try {
            foreach ($brands_list as $brand_list) {
                $brand = new Brand();
                $brand->name = $brand_list['name'];
                $brand->is_active = $brand_list['is_active'];
                $brand->save();
            }
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function destroy(Request $request) {
        Brand::findOrFail($request->id)->delete();
        toastr()->error('تم الحذف بنجاح');
        return redirect()->route('brands.index');
    }
}