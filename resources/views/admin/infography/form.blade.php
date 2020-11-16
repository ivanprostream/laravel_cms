<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  <input class="form-control" name="name" type="text" id="name" value="{{ isset($page->name) ? $page->name : ''}}" placeholder="Название списка иконок">
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
</div>

<hr>
<div class="form-group">
  <input class="btn btn-primary float-sm-right" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
