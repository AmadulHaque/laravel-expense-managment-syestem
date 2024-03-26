
  <input type="hidden" name="id" value="{{$data->id}}">
  <div class="row mb-3">
    <label for="example-text-input" class="col-12  col-form-label">Category Name </label>
    <div class="form-group col-12 ">
      <input name="name" class="form-control" type="text" value="{{$data->name}}">
    </div>
  </div>

  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">Type</label>
    <div class="form-group col-12 ">
          <select name="type" id="" class="form-control" >
                <option value="income" {{$data->type=='income' ? 'selected' : ''}} >Income</option>
                <option value="expense" {{$data->type=='expense' ? 'selected' : ''}}>Expense</option>
          </select>
    </div>
  </div>
