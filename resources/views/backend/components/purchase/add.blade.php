<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Purchase</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="addProductStore">
          @csrf
          <div class="modal-body">

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">Product Name </label>
              <div class="form-group col-12 ">
                <input name="name" class="form-control" type="text">
              </div>
            </div>

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">Product Quantity </label>
              <div class="form-group col-12 ">
                <input name="quantity" class="form-control" type="number">
              </div>
            </div>

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">Amount </label>
              <div class="form-group col-12 ">
                <input name="amount" class="form-control" type="number">
              </div>
            </div>

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">User</label>
              <div class="form-group col-12 ">
                    <select name="user_id" id="" class="form-control" >
                        @foreach ($users as $item)
                            <option value="{{$item->id}}"   >{{$item->name}}</option>
                        @endforeach
                    </select>
              </div>
            </div>

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">Note</label>
              <div class="form-group col-12 ">
                <textarea name="note" class="form-control" placeholder="note" ></textarea>
              </div>
            </div>

            <div class="row">
                <label for="example-text-input" class="col-12  col-form-label">Purchase Date</label>
                <div class="form-group col-12 ">
                    <input name="date" class="form-control" type="date">
                </div>
            </div>

            <!-- end row -->
            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">Image </label>
              <div class="form-group col-12 ">
                <input name="image" class="form-control" type="file" id="image">
              </div>
            </div>
            <!-- end row -->
            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label"></label>
              <div class="col-12 ">
                <img id="showImage"  class="showImage rounded avatar-lg" src="" alt="">
              </div>
            </div>
            <!-- end row -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Purchase</button>
          </div>
      </form>
    </div>
  </div>
</div>
