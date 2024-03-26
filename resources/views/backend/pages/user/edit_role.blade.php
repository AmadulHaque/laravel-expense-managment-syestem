
@extends('backend.master')
@section('content')
@php
    $setting =DB::table('settings')->first();
@endphp

<div class="row">
    <div class="col-lg-10">
      <div class="card">
        <div class="card-body">
            <form id="myForm" method="post" action="{{ route('UpdateRolePermission',$role->id) }}"> @csrf <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Roles Name</h6>
                </div>
                <div class="form-group col-sm-9 text-secondary">
                  <div class="form-group col-sm-9 text-secondary">
                    <select required name="role_id" class="form-select mb-3" aria-label="Default select example">
                      <option selected="" value="" >Open this select menu</option>
                      @foreach($roles as $item)
                      <option @if ($item->id==$role->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                    <label class="form-check-label" for="flexCheckDefaultAll">Permission All</label>
                </div>
                <hr>
                @foreach($permission_groups as $group) <div class="row">
                    <!--  // Start row  -->
                    <div class="col-3">
                        @php
                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input group-checkbox" type="checkbox" value="{{ $group->group_name }}" id="flexCheckDefault{{ $group->group_name }}" {{ App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : '' }} >
                            <label class="form-check-label" for="flexCheckDefault{{ $group->group_name }}">{{ $group->group_name }}</label>
                        </div>
                    </div>
                    <div class="col-9">
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input {{ $group->group_name }}" name="permission[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox" value="{{ $permission->name }}" id="flexCheckDefault{{$permission->id}}">
                                <label class="form-check-label" for="flexCheckDefault{{$permission->id}}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                        <br>
                    </div>
                </div>
              <!--  // end row  -->
              @endforeach
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                </div>
              </div>
              </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('js')
<script type="text/javascript">
    $('#flexCheckDefaultAll').click(function() {
      if ($(this).is(':checked')) {
        $('input[type = checkbox]').prop('checked', true);
      } else {
        $('input[type = checkbox]').prop('checked', false);
      }
    });
</script>
<script>
    $(document).ready(function(){
        $('.group-checkbox').change(function(){
            var groupName = $(this).val();
            var isChecked = $(this).prop('checked');
            if (isChecked) {
                $('.' + groupName).prop('checked', true);
            } else {
                $('.' + groupName).prop('checked', false);
            }
        });
    });
</script>

@endpush()

