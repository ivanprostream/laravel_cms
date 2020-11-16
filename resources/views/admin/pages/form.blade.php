<ul class="nav nav-pills">
	<li class="nav-item"><a class="nav-link btn-sm active" href="#tab_content" data-toggle="tab">Контент</a></li>
	<li class="nav-item"><a class="nav-link btn-sm" href="#tab_seo" data-toggle="tab">SEO</a></li>
	<li class="nav-item"><a class="nav-link btn-sm" href="#tab_settings" data-toggle="tab">Настройки</a></li>
</ul>
<hr>
<div class="tab-content">

    <div class="active tab-pane" id="tab_content">

    	<div class="row">
    		<div class="col-4">
    			<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					<input class="form-control" name="name" type="text" id="name" value="{{ isset($page->name) ? $page->name : ''}}" placeholder="Название страницы">
				    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
				</div>
    		</div>
    		<div class="col-4">
    			<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
					<input class="form-control" name="url" type="text" id="url" value="{{ isset($page->url) ? $page->url : ''}}" placeholder="Url страницы">
          @if(isset($page->path))
          <p class="small"><a target="_blank" href="{{ url($page->path) }}">Путь страницы: {{ $page->path }}</a></p>
          @endif
				    {!! $errors->first('url', '<p class="text-danger">:message</p>') !!}
				</div>
    		</div>

    		<div class="col-4">
          <div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
                    
            <select name="parent" id="parent" class="form-control" data-placeholder="Страница родитель" data-dropdown-css-class="select2-purple">
              <option value="0"></option>
              @foreach($allpages as $item)
                  <option value="{{ $item->id }}" {{ isset($page->parent) && $page->parent == $item->id?"selected":"" }}>{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
    		</div>

    		<div class="col-12">
    			<div class="form-group {{ $errors->has('short_text') ? 'has-error' : ''}}">
				    <textarea class="form-control" name="short_text" type="text" id="short_text" placeholder="Краткое описание">{{ isset($page->short_text) ? $page->short_text : ''}}</textarea>
				    {!! $errors->first('short_text', '<p class="text-danger">:message</p>') !!}
				  </div>
    		</div>

    		<div class="col-12">
    			<div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
				    <textarea class="form-control" name="text" type="text" id="text" placeholder="Контент страницы">{{ isset($page->text) ? $page->text : ''}}</textarea>
				    {!! $errors->first('text', '<p class="text-danger">:message</p>') !!}
				  </div>
    		</div>

    		<div class="col-12">
    			<div class="form-group {{ $errors->has('text_2') ? 'has-error' : ''}}">
				    <textarea class="form-control" name="text_2" type="text" id="text_2" placeholder="Контент страницы (дополнительный)">{{ isset($page->text_2) ? $page->text_2 : ''}}</textarea>
				    {!! $errors->first('text_2', '<p class="text-danger">:message</p>') !!}
				  </div>
    		</div>

    		<div class="col-12">
    			@if(!empty($page->image))
            <img src="{{ url('public/content/images/' . $page->image) }}" width="200"/>
          @endif

          <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
            <label for="image" class="control-label">{{ 'Изображение' }}</label>
            <input class="form-control" name="image" type="file" id="image" >
            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
          </div>
    		</div>
    	</div>	
		
    </div>

    <div class="tab-pane" id="tab_seo">

      <div class="row">
    		<div class="col-12">
    			<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
					<input class="form-control" name="title" type="text" id="title" value="{{ isset($page->title) ? $page->title : ''}}" placeholder="Заголовок">
				    {!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
				</div>
    		</div>
    		<div class="col-12">
    			<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
				    <textarea class="form-control" name="description" type="text" id="description" placeholder="Описание страницы (2-3 предложения)">{{ isset($page->description) ? $page->description : ''}}</textarea>
				    {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
				</div>
    		</div>
    		<div class="col-12">
    			<div class="form-group {{ $errors->has('key_words') ? 'has-error' : ''}}">
				    <textarea class="form-control" name="key_words" type="text" id="key_words" placeholder="Ключевые слова (7-10 через запятую)">{{ isset($page->key_words) ? $page->key_words : ''}}</textarea>
				    {!! $errors->first('key_words', '<p class="text-danger">:message</p>') !!}
				</div>
    		</div>
    	</div>
      
    </div>

    <div class="tab-pane" id="tab_settings">
      <div class="row">
      	<div class="col-4">
      		<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
			    <select name="type" id="type" class="form-control">
			    	@foreach($types as $type)
			        	<option value="{{ $type->id }}" {{ isset($page->type) && $page->type ==  $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
			        @endforeach
			    </select>
			    {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
			</div>
      	</div>
      	<div class="col-4">
      		<div class="form-group {{ $errors->has('show') ? 'has-error' : ''}}">
			    <select name="show" id="show" class="form-control">
			        <option value="1" {{ isset($page->show) && $page->show == 1 ? 'selected' : ''}}>Показывать страницу</option>
			        <option value="0" {{ isset($page->show) && $page->show == 0 ? 'selected' : ''}}>Не показывать страницу</option>
			    </select>
			    {!! $errors->first('show', '<p class="text-danger">:message</p>') !!}
			</div>
      	</div>
      	<div class="col-4">
      		<div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
			    <select name="menu" id="menu" class="form-control">
			        <option value="1" {{ isset($page->menu) && $page->menu == 1 ? 'selected' : ''}}>Показывать списком в меню</option>
			        <option value="0" {{ isset($page->menu) && $page->menu == 0 ? 'selected' : ''}}>Не показывать списком в меню</option>
			    </select>
			    {!! $errors->first('menu', '<p class="text-danger">:message</p>') !!}
			</div>
      	</div>
      	<div class="col-12">
			<div class="form-group {{ $errors->has('script') ? 'has-error' : ''}}">
			    <textarea class="form-control" name="script" type="text" id="script" placeholder="Скрипт на странице">{{ isset($page->script) ? $page->script : ''}}</textarea>
			    {!! $errors->first('script', '<p class="text-danger">:message</p>') !!}
			</div>
		</div>
      </div>
      
    </div>

    <hr>
    <div class="form-group">
        <input class="btn btn-primary float-sm-right" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
    </div>

    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->



