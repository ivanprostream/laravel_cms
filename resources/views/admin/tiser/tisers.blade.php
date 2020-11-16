@extends('layout.app')

@section('title', ' | Картинки с текстом')

@section('content')
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $tiser_main->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/tiser') }}">Картинки с текстом</a></li>
              <li class="breadcrumb-item active">{{ $tiser_main->name }}</li>
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
                <form method="POST" action="{{ url('/admin/tiser/tiser_create/' . $tiser_main->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  {{ method_field('PATCH') }}
                  {{ csrf_field() }}
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <input class="form-control" name="name" type="text" id="name" value="{{ isset($tiser->name) ? $tiser->name : old('name')}}" placeholder="Название">
                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                        <input class="form-control" name="link" type="text" id="link" value="{{ isset($tiser->link) ? $tiser->link : old('link')}}" placeholder="Ссылка (если есть)">
                        {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <textarea class="form-control" name="description" type="text" id="description" placeholder="Краткий текст">{{ isset($tiser->description) ? $tiser->description : ''}}</textarea>
                        {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                        <label for="image" class="control-label">{{ 'Изображение' }}</label>
                        <input class="form-control" name="image" type="file" id="image" >
                        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
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
                      @foreach($tiser_list as $item)
                      <tr id="item-{{ $item->id }}">
                        <td><i class="fas fa-arrows-alt-v handle"></i></td>
                        <td>
                          @if(!empty($item->image))
                            <img src="{{ url('public/content/images/' . $item->image) }}" height="100"/>
                          @endif
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
                          <form method="POST" action="{{ url('/admin/tiser/tiser_delete' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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

