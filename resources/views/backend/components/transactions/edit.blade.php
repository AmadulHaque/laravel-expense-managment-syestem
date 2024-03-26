
  <input type="hidden" name="id" value="{{$data->id}}">
  <div class="row mb-3">
    <label for="example-text-input" class="col-12 col-form-label">Category Name </label>
    <div class="form-group col-12">
      <select name="category_id" class="form-control"  id="">
        <option value="" selected disabled>Choose..</option>
        @foreach ($category as $item)
            <option @if ($item->id==$data->category_id) selected @endif value="{{$item->id}}">{{$item->type}} -  {{$item->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <!-- end row -->
  <div class="row mb-3">
    <label for="example-text-input" class="col-12 col-form-label">Amount</label>
    <div class="form-group col-12">
      <input name="amount" class="form-control" value="{{$data->amount}}" type="number">
    </div>
  </div>
  <div class="row mb-3">
    <label for="example-text-input" class="col-12 col-form-label">Note</label>
    <div class="form-group col-12">
      <input name="note" class="form-control" value="{{$data->note}}" type="text">
    </div>
  </div>
  <div class="row mb-3">
    <label for="example-text-input" class="col-12 col-form-label">Date</label>
    <div class="form-group col-12">
      <input name="date" class="form-control"  value="{{$data->date}}" type="date">
    </div>
  </div>

