<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() {
        $coupons = Coupon::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.admin.coupons.index', compact('coupons'));
    }

    public function create() {
        return view('dashboard.admin.coupons.create');
    }

    public function store(Request $request) {
        Coupon::create($request->all());
        toastr()->success('تم الحفظ بنجاح');
        return redirect()->route('coupons.index');
    }

    public function edit(Coupon $coupon) {
        return view('dashboard.admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon) {
        $coupon->update($request->all());
        toastr()->success('تم التحديث بنجاح ');
        return redirect()->route('coupons.index');
    }

    public function destroy(Coupon $coupon) {
        $coupon->delete();
        toastr()->success('تم الحذف بنجاح');
        return redirect()->route('coupons.index');
    }
}
