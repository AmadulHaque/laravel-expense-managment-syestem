
  <input type="hidden" name="id" value="{{$purchase->id}}">



  <div class="row ">
    <label for="example-text-input" class="col-12  col-form-label">Product Name </label>
    <div class="form-group col-12 ">
      <input name="name" value="{{ $purchase->name }}" class="form-control" type="text">
    </div>
  </div>

  <!-- end row -->
  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">Product Quantity </label>
    <div class="form-group col-12 ">
      <input name="quantity" class="form-control" type="number" value="{{$purchase->quantity}}">
    </div>
  </div>

  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">Amount </label>
    <div class="form-group col-12 ">
      <input name="amount" class="form-control" type="number" value="{{$purchase->amount}}">
    </div>
  </div>

  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">User</label>
    <div class="form-group col-12 ">
          <select name="user_id" id="" class="form-control" >
              @foreach ($users as $item)
                  <option value="{{$item->id}}" {{ $item->id==$purchase->created_by ? 'selected' : '' }}>{{$item->name}}</option>
              @endforeach
          </select>
    </div>
  </div>
  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">Note</label>
    <div class="form-group col-12 ">
      <textarea name="note" class="form-control" placeholder="note" >{{$purchase->note}}</textarea>
    </div>
  </div>
  <div class="row">
    <label for="example-text-input" class="col-12  col-form-label">Purchase Date</label>
    <div class="form-group col-12 ">
        <input name="date" class="form-control" type="date" value="{{$purchase->date}}">
    </div>
</div>
  <!-- end row -->
  <div class="row ">
    <label for="example-text-input" class="col-12  col-form-label">Thumbnail Image </label>
    <div class="form-group col-12 ">
      <input name="image" class="form-control" type="file" id="image2">
    </div>
  </div>
  <!-- end row -->
  <div class="row ">
    <label for="example-text-input" class="col-12  col-form-label"></label>
    <div class="col-12 ">
      <img id="showImage2" style="width:50%" class="rounded avatar-lg" src="{{ $purchase->image ? $purchase->image : '' }}" alt="Card image cap">
    </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function (){
        $('#image2').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage2').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
      });

</script>
