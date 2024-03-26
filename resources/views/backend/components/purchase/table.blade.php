

<table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Sl</th>
      <th>Thumbnail</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Amount</th>
      <th>Note</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datas as $key => $item)
    <tr>
       <td> {{ $key+1}} </td>
       <td> <img src="{{$item->image ?  $item->image  : url('images/no_image.jpeg') }}" style="width:60px; height:50px"></td>
       <td> {{ $item->name }} </td>
       <td> {{ $item->quantity }} </td>
       <td> {{ $item->amount }} </td>
       <td> {{ $item->note }} </td>
       <td> {{ $item->date }} </td>
      <td>
        <div class="col">
            @if (auth()->user()->can('purchase-edit'))
          <button type="button" class="btn btn-outline-success btn-sm edit_row" id_val="{{$item->id}}"><i class="fadeIn animated bx bx-message-square-edit"></i></button>
          @endif
          @if (auth()->user()->can('purchase-delete'))
          <button type="button" class="btn btn-outline-danger btn-sm delete_row" id_val="{{$item->id}}" ><i class="lni lni-trash"></i></button>
          @endif
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr style="background: #acacac;">
        <th colspan="6" class="text-center" >Total Amount</th>
        <th colspan="2" >৳ {{$amount}}</th>
    </tr>
  </tfoot>
</table>
@if(count($datas) == 0)
   <tr><p class="text-center p-5">No Data Found</p></tr>
@endif


<?php $paginate = $datas ?>
@include( 'backend.partials.pagination')
