<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB};
class OfferController extends Controller {
    public function index() {
        $offers = Offer::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.offers.index', compact('offers'));
    }

    public function store(Request $request) {
        try {
            $offer = Offer::create($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'offer-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $offer->storeImage($request->file('image')->storeAs('offer', $fileName, 'upload_image'));
            }
            toastr()->success('تم الحفظ بنجاح');
            return redirect()->route('offers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function update(Request $request, Offer $offer) {
        try {
            $offer->update($request->input());
            if ($request->hasFile('image')) {
                $fileName = 'offer-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $offer->updateImage($request->file('image')->storeAs('offer', $fileName, 'upload_image'));
            }
            toastr()->success('تم التحديث بنجاح ');
            return redirect()->route('offers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
    }

    public function destroy(string $id) {
        try {
            DB::beginTransaction();
            $offer = Offer::findOrFail($id);
            $offer->delete();
            $offer->deleteImage();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطا حاول مره اخرى']);
        }
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('offers.index');
    }
}
