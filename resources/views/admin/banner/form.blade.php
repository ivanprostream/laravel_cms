<div class="row">
	<div class="col-6">
	  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
	    <input class="form-control" name="name" type="text" id="name" value="{{ isset($banner->name) ? $banner->name : old('name')}}" placeholder="Название">
	    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
	    <input class="form-control" name="link" type="text" id="link" value="{{ isset($banner->link) ? $banner->link : old('link')}}" placeholder="Ссылка (если есть)">
	    {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
	    <label for="image" class="control-label">{{ 'Изображение' }}</label>
	    <input class="form-control" name="image" type="file" id="image" >
	    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
	    
	  </div>
	  @if(!empty($banner->image))
	        <img src="{{ url('public/content/images/' . $banner->image) }}" height="100"/>
	    @endif
	</div>

	<div class="col-12">
		<hr>
	    <div class="form-group">
	        <input class="btn btn-primary float-sm-right" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Добавить' }}">
	    </div>
	</div>

</div>