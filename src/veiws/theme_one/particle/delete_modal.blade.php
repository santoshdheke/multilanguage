<button class="btn btn-xs btn-danger delete-btn" data-id="{{ $row->id }}" type="button" data-toggle="tooltip" title="Delete">
    <i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route($base_route.'destroy',$row->id) }}"
                  method="post" id="delete{{ $row->id }}">
                @csrf @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{ $row->title ?? $title ?? "Item" }}</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item? The deleted item never restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
