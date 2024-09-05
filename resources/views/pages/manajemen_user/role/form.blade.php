<div class="row">
    <div class="form-group col-md-12">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Name" value="{{ @$data->name }}">
    </div>

    <div class="form-group col-md-12">
      <label>Description</label>
      <textarea name="description" placeholder="Description" class="form-control">{{ @$data->description }}</textarea>
    </div>

</div>
  