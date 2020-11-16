<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <select name="type" id="type" class="form-control">
            <option value="">Выберите тип</option>
        @foreach($setting_types as $item)
            <option value="{{ $item->id }}" {{ isset($setting->type) && $setting->type == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($setting->name) ? $setting->name : old('name')}}" placeholder="Название">
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <textarea class="form-control" name="value" type="text" id="value" placeholder="Значение" rows="3">{{ isset($setting->value) ? $setting->value : old('value')}}</textarea>
    {!! $errors->first('value', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Добавить' }}">
</div>