<div class="modal fade" id="delete{{ $banner->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ 'حذف ' . $banner?->name }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
            <form action="{{route('banners.destroy', $banner->id)}}" method="POST">
                @csrf
                @method('DELETE')
                   هل انت متاكد من الحذف
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                       <button type="submit" class="btn btn-danger">حذف</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>