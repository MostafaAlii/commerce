<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Package, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB};
class PackageController extends Controller {
    public function index() {
        $data = [];
        $data['products'] = Product::active()->select('id', 'name')->get();
        $data['packages'] = Package::with('products')->get();
        return view('dashboard.admin.packages.index', $data);
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $packageData = $request->except('products');
            $package = Package::create($packageData);
            if ($request->hasFile('image')) {
                $fileName = 'package-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $package->storeImage($request->file('image')->storeAs('package', $fileName, 'upload_image'));
            }
            if ($request->has('products'))
                $package->products()->attach($request->input('products'));    
            DB::commit();
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('packages.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function update(Request $request, $id)
{
    try {
        DB::beginTransaction();
        $package = Package::findOrFail($id);
        $packageData = $request->except('products');
        $package->update($packageData);
        if ($request->hasFile('image')) {
            $fileName = 'package-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $package->storeImage($request->file('image')->storeAs('package', $fileName, 'upload_image'));
        }
        if ($request->has('products'))
            $package->products()->sync($request->input('products'));
        DB::commit();
        toastr()->success('تم التحديث بنجاح');
        return redirect()->route('packages.index');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'حدث خطأ حاول مرة أخرى']);
    }
}



    public function destroy(string $id) {
        try {
            DB::beginTransaction();
            $package = Package::findOrFail($id);
            $package->delete();
            $package->deleteImage();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('packages.index');
    }
}
