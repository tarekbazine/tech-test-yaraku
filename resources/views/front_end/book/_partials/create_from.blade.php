<form action="" method="POST"
      class="px-3 pt-5 pb-2"
      style="background-color: lightgray;border-radius: 10px">

    {{ csrf_field() }}

    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right">Title<span style="color: red">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Title">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right">Author<span style="color: red">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Author">
        </div>
    </div>

    <hr/>

    <div class="form-group row">
        <div class="col-sm-10 offset-md-2">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>