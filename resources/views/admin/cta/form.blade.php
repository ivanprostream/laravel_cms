<div class="row">
	<div class="col-6">
	  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
	    <input class="form-control" name="name" type="text" id="name" value="{{ isset($cta->name) ? $cta->name : old('name')}}" placeholder="Название">
	    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
	    <input class="form-control" name="link" type="text" id="link" value="{{ isset($cta->link) ? $cta->link : old('link')}}" placeholder="Ссылка (если есть)">
	    {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
	    <textarea class="form-control" name="description" type="text" id="description" placeholder="Краткий текст">{{ isset($cta->description) ? $cta->description : ''}}</textarea>
	    {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
	    <label for="image" class="control-label">{{ 'Изображение' }}</label>
	    <input class="form-control" name="image" type="file" id="image" >
	    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
	    
	  </div>
	  @if(!empty($cta->image))
	        <img src="{{ url('public/content/images/' . $cta->image) }}" height="100"/>
	    @endif
	</div>

	<div class="col-12">
		<hr>
	    <div class="form-group">
	        <input class="btn btn-primary float-sm-right" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Добавить' }}">
	    </div>
	</div>

</div>