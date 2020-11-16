<div class="row">
	<div class="col-6">
	  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
	    <input class="form-control" name="name" type="text" id="name" value="{{ isset($review->name) ? $review->name : old('name')}}" placeholder="Имя">
	    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
	    <input class="form-control" name="link" type="text" id="link" value="{{ isset($review->link) ? $review->link : old('link')}}" placeholder="Должность (необязательно)">
	    {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('review') ? 'has-error' : ''}}">
	    <textarea class="form-control" name="review" type="text" id="review" placeholder="Отзыв">{{ isset($review->review) ? $review->review : ''}}</textarea>
	    {!! $errors->first('review', '<p class="text-danger">:message</p>') !!}
	  </div>
	</div>
	<div class="col-6">
	  <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
	    <label for="image" class="control-label">{{ 'Изображение' }}</label>
	    <input class="form-control" name="image" type="file" id="image" >
	    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
	    
	  </div>
	  @if(!empty($review->image))
	        <img src="{{ url('public/content/images/' . $review->image) }}" height="100"/>
	    @endif
	</div>

	<div class="col-12">
		<hr>
	    <div class="form-group">
	        <input class="btn btn-primary float-sm-right" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Добавить' }}">
	    </div>
	</div>

</div>