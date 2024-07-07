<!-- edit_modal_Grade -->
<div class="modal fade" id="edit{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل {{ $banner?->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- edit_form -->
                <form action="{{route('banners.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">الاسم :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $banner?->name }}">
                        </div>
                        <div class="col">
                            <label for="is_active" class="mr-sm-2">الحاله :</label>
                            <div class="box">
                                <select class="form-control" name="status">
                                    <option value="1" {{ (old('status', $banner->status) == '1') ? 'selected' : '' }} >فعال</option>
                                    <option value="0" {{ (old('status', $banner->status) == '0') ? 'selected' : '' }} >غير فعال</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>الصوره : <span style="color:rgb(199, 8, 8)">*</span></label>
                        <input class="form-control img" name="image" type="file" accept="image/*" onchange="previewImage(this);">
                        <img class="img-thumbnail img-fluid" id="image-preview" src="{{$banner->ImagePath()}}" alt="{{$banner->name}}">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">اغلاق</button>
                        <button type="submit"
                                class="btn btn-primary">تحديث</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>