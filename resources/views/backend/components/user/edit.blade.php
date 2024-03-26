<input type="hidden" name="id" value="{{ $user->id }}">
<div class="row">
  <label for="example-text-input" class="col-12  col-form-label">User Name </label>
  <div class="form-group col-12 ">
    <input name="name" value="{{ $user->name }}" class="form-control" type="text">
  </div>
</div>
<!-- end row -->
<div class="row">
  <label for="example-text-input" class="col-12  col-form-label">User Mobile </label>
  <div class="form-group col-12 ">
    <input name="phone" value="{{ $user->phone }}" class="form-control" type="number">
  </div>
</div>
<!-- end row -->
<div class="row">
  <label for="example-text-input" class="col-12  col-form-label">User Email </label>
  <div class="form-group col-12 ">
    <input name="email" value="{{ $user->email }}" class="form-control" type="email">
  </div>
</div>

<div class="row">
    <label for="example-text-input" class="col-12  col-form-label">User Password </label>
    <div class="form-group col-12 ">
      <input name="password" class="form-control" type="text">
    </div>
</div>

<!-- end row -->
<div class="row">
  <label for="example-text-input" class="col-12  col-form-label">User Address </label>
  <div class="form-group col-12 ">
    <input name="address" value="{{ $user->address }}" class="form-control" type="text">
  </div>
</div>

<!-- end row -->
<div class="row">
  <label for="example-text-input" class="col-12  col-form-label"> Image </label>
  <div class="form-group col-12 ">
    <input name="photo" class="form-control" type="file" id="image_edit">
  </div>
</div>

<!-- end row -->
<div class="row">
    <label for="example-text-input" class="col-12  col-form-label"></label>
    <div class="col-12 ">
      <img id="showImage_two" class="showImage rounded avatar-lg" src="{{ asset($user->photo) }}" alt="">
    </div>
</div>
  <!-- end row -->

<div class="row">
    <label for="example-text-input" class="col-12  col-form-label">User Role </label>
    <div class="col-12">
        <select name="roles" class="form-control"   id="">
            @php
                $role_name = $user->getRoleNames()[0] ?? ''
            @endphp
            @foreach($roles as $role)
                <option {{$role_name == $role->name ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>


