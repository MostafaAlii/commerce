<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    اضافة ماركه
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="brands_list">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name" class="mr-sm-2">اسم الماركه :</label>
                                            <input class="form-control" type="text" name="name" />
                                        </div>

                                        <div class="col">
                                            <label for="status" class="mr-sm-2">الحاله :</label>
                                            <div class="box">
                                                <select class="form-control" name="is_active">
                                                    <option value="1">فعال</option>
                                                    <option value="0">غير فعال</option>
                                                </select>
                                                @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="process" class="mr-sm-2">العمليات :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="حذف" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="اضف صف" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">اغلاق</button>
                                <button type="submit"
                                    class="btn btn-success">حفظ</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
