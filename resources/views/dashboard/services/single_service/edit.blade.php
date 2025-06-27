<!-- Modal -->
<div class="modal fade" id="edit{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">edit_Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('services.update',$service->id) }}" method="post" autocomplete="off">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$service->name}}"><br>

                    <label for="price">price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{$service->price}}"><br>

                    <label for="description">description</label>
                    <textarea class="form-control" name="des" id="description" rows="5" >{{$service->des}}</textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </div>
</div>