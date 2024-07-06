<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    اضافة السلايدر
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class=" row mb-30" action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Start Name -->
                                <div class="form-group col-6">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control" required name="name" id="name" value="">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Name -->

                                <!-- Start Status Status -->
                                <div class="p-1 form-group col-6">
                                    <label for="status">الحاله</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>اختر الحاله...</option>
                                        <option value="1" {{ old('status')=='1' ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ old('status')=='0' ?'selected' : '' }}>غير فعال</option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Status Selected -->
                            </div>
                            
                            <div class="form-group">
                                <label>الصوره :  <span style="color:rgb(199, 8, 8)">*</span></label>
                                <input  class="form-control img" name="image"  type="file" accept="image/*" required >
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                        
                </form>
            </div>    
        </div>
    </div>
</div>
