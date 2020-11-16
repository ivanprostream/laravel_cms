@extends('layout.app')

@section('title', ' | Список иконок с текстом')

@section('content')
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $infography_main->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/infography') }}">Иконки с текстом</a></li>
              <li class="breadcrumb-item active">{{ $infography_main->name }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">

              <div class="card-body">
                <form method="POST" action="{{ url('/admin/infography/infography_create/' . $infography_main->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  {{ method_field('PATCH') }}
                  {{ csrf_field() }}
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <input class="form-control" name="name" type="text" id="name" value="{{ isset($infography->name) ? $infography->name : old('name')}}" placeholder="Название">
                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                        <input class="form-control" name="link" type="text" id="link" value="{{ isset($infography->link) ? $infography->link : old('link')}}" placeholder="Ссылка (если есть)">
                        {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <textarea class="form-control" name="description" type="text" id="description" placeholder="Краткий текст">{{ isset($infography->description) ? $infography->description : old('description')}}</textarea>
                        {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('icon') ? 'has-error' : ''}}">
                        <input class="form-control" name="icon" type="text" id="icon" value="{{ isset($infography->icon) ? $infography->icon : old('icon')}}" placeholder="Иконка (пример fas fa-cat)">
                        {!! $errors->first('icon', '<p class="text-danger">:message</p>') !!}
                        <p class="small"><a target="_blank" href="https://fontawesome.com/">Список иконок Fontawesome</a></p>
                      </div>
                    </div>
                    
                  </div>

                  <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Добавить">
                  </div>

                </form>
                <br>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      @foreach($infography_list as $item)
                      <tr id="item-{{ $item->id }}">
                        <td><i class="fas fa-arrows-alt-v handle"></i></td>
                        <td>
                          <i class="{{ $item->icon }} fa-2x"></i>
                        </td>
                        <td>
                          {{ $item->name }}
                        </td>
                        <td>
                          {{ $item->description }}
                          @if($item->link)
                          <p><a target="_blank" href="{{ $item->link }}">Ссылка</a></p>
                          @endif
                        </td>
                        <td>
                          <form method="POST" action="{{ url('/admin/infography/infography_delete' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-danger btn-sm" title="Удалить" onclick="return confirm('Удалить?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <input type="hidden" id="sort-input" name="sort" value="{{ $sort }}">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
@endsection

