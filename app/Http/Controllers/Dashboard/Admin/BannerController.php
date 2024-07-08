<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB};
class BannerController extends Controller {
    public function index() {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.banners.index', compact('banners'));
    }

    public function store(Request $request) {
        try {
            $banner = Banner::create($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'banner-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $banner->storeImage($request->file('image')->storeAs('banner', $fileName, 'upload_image'));
            }
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('banners.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function update(Request $request, Banner $banner) {
        try {
            $banner->update($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'banner-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $banner->updateImage($request->file('image')->storeAs('banner', $fileName, 'upload_image'));
            }
            toastr()->success('تم التحديث بنجاح ');
            return redirect()->route('banners.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function destroy(string $id) {
        try {
            DB::beginTransaction();
            $banner = Banner::findOrFail($id);
            $banner->delete();
            $banner->deleteImage();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('banners.index');
    }
}
