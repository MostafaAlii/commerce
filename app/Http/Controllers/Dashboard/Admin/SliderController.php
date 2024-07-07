<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{DB};
class SliderController extends Controller {
    public function index() {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.sliders.index', compact('sliders'));
    }

    public function store(Request $request) {
        try {
            $slider = Slider::create($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'slider-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $slider->storeImage($request->file('image')->storeAs('slider', $fileName, 'upload_image'));
            }
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function update(Request $request, Slider $slider) {
        try {
            $slider->update($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'slider-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $slider->updateImage($request->file('image')->storeAs('slider', $fileName, 'upload_image'));
            }
            toastr()->success('تم التحديث بنجاح ');
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function destroy(string $id) {
        try {
            DB::beginTransaction();
            $slider = Slider::findOrFail($id);
            $slider->delete();
            $slider->deleteImage();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('sliders.index');
    }
}
