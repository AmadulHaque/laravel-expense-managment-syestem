

<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Sl</th>
       <th>Name</th>
       <th>Image </th>
       <th>Email</th>
       <th>Mobiel</th>
       <th>Address</th>
       <th>Role</th>
       <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datas as $key => $item)
    <tr>
        <td> {{ $key+1}} </td>
        <td> {{ $item->name }} </td>
        <td> <img src="{{ $item->photo ? $item->photo : url('images/no_image.jpeg') }}" style="width:60px; height:50px"> </td>
        <td> {{ $item->email }} </td>
        <td> {{ $item->phone }} </td>
        <td> {{ $item->address }} </td>
        <td>
            @isset($item->roles)
                @foreach($item->roles as $role)
                    <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                @endforeach
            @endisset
        </td>
        <td>
            <div class="col">
            <button type="button" class="btn btn-outline-success btn-sm edit_row" id_val="{{$item->id}}"><i class="fadeIn animated bx bx-message-square-edit"></i></button>
            {{-- <button type="button" class="btn btn-outline-danger btn-sm delete_row" id_val="{{$item->id}}" ><i class="lni lni-trash"></i></button> --}}
            </div>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@if(count($datas) == 0)
   <tr><p class="text-center p-5">No Data Found</p></tr>
@endif


<?php $paginate = $datas ?>
@include( 'backend.partials.pagination')
