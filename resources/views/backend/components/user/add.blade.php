<!-- Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="customerStore" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">User Name </label>
              <div class="form-group col-12 ">
                <input name="name" class="form-control" type="text">
              </div>
            </div>
            <!-- end row -->
            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">User Mobile </label>
              <div class="form-group col-12 ">
                <input name="phone" class="form-control" type="text">
              </div>
            </div>
            <!-- end row -->
            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">User Email </label>
              <div class="form-group col-12 ">
                <input name="email" class="form-control" type="email">
              </div>
            </div>
            <!-- end row -->

            <div class="row">
                <label for="example-text-input" class="col-12  col-form-label">User Password </label>
                <div class="form-group col-12 ">
                  <input name="password" class="form-control" type="text">
                </div>
            </div>

            <div class="row">
              <label for="example-text-input" class="col-12  col-form-label">User Address </label>
              <div class="form-group col-12 ">
                <input name="address" class="form-control" type="text">
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <label for="example-text-input" class="col-12  col-form-label">User Image </label>
                <div class="form-group col-12 ">
                    <input name="photo" class="form-control" type="file" id="image">
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <label for="example-text-input" class="col-12  col-form-label"></label>
                <div class="col-12 ">
                    <img id="showImage" class="showImage rounded avatar-lg" src="" alt="">
                </div>
            </div>

            <div class="row">
                <label for="example-text-input" class="col-12  col-form-label">User Role </label>
                <div class="col-12">
                    <select name="roles" class="form-control" required  id="">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add User</button>
          </div>
      </form>
    </div>
  </div>
</div>
