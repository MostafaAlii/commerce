<!-- edit_modal_Grade -->
<div class="modal fade" id="edit{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل {{ $brand?->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- edit_form -->
                <form action="{{ route('brands.update', 'test') }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">الاسم :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $brand?->name }}" required>
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $brand->id }}">
                        </div>
                        <div class="col">
                            <label for="is_active" class="mr-sm-2">الحاله :</label>
                            <div class="box">
                                <select class="form-control" name="is_active">
                                    <option value="1" {{ old('is_active', $brand->is_active) == 1 ? 'selected' : null }} >فعال</option>
                                    <option value="0" {{ old('is_active', $brand->is_active) == 0 ? 'selected' : null }} >غير فعال</option>
                                </select>
                                @error('is_active')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
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