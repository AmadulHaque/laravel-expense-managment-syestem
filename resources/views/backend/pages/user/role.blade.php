
@extends('backend.master')
@section('content')
@php
    $setting =DB::table('settings')->first();
@endphp

<table id="example" class="table align-middle mb-0 bg-white table-bordered">
    <thead class="bg-light">
    <tr>
        <th>Role Name</th>
        <th>Permission  </th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
       @foreach ($roles as $item)
       <tr>
           <td>{{$item->name}}</td>
           <td>
                @foreach($item->permissions as $perm)
                    <span class="badge rounded-pill bg-danger"> {{ $perm->name }}</span>
                @endforeach
           </td>
           <td>
               <a href="{{route('EditRolePermission',$item->id)}}"  class=" btn btn-sm btn-success" >Edit</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection
@push('js')
<script>

    $(document).ready(function(){
        $(document).on('click','.remove',function(e){
            e.preventDefault();
            let urlVal = $(this).attr('href');
            Swal.fire({
                title: 'Are you Want To Delete?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                location.href =urlVal;
                }
            });
        })
    })
</script>

@endpush

