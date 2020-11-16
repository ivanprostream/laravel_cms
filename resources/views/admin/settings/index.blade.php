@extends('layout.app')
 
@section('title', ' | Настройки')
 
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Настройки</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Главная</a></li>
              <li class="breadcrumb-item active">Настройки</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <a href="{{ route('settings.create') }}" class="btn btn-info">Добавить</a>

              </div> <!-- /.card-body -->
              <div class="card-body">

                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    @foreach($setting_types as $count=>$type)
                      <li class="nav-item"><a class="nav-link btn-sm {{ $count == 0 ? 'active' : ''}}" href="#tab{{ $type->id }}" data-toggle="tab">{{ $type->name }}</a></li>
                    @endforeach
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    @foreach($setting_types as $count=>$type)
                    <div class="{{ $count == 0 ? 'active' : ''}} tab-pane" id="tab{{ $type->id }}">
                      <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                          @foreach(getSettingsByType($type->id) as $item)
                          <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->value }}</td>
                            <td>
                              <a class="btn btn-warning btn-sm" href="{{ route('settings.edit', $item->id) }}">Редактировать</a>

                              <form method="POST" action="{{ url('/admin/settings' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-danger btn-sm" title="Удалить" onclick="return confirm('Удалить?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                      
                    </div>
                    @endforeach
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->

                <hr>

                <p>Все константы и настройки сайта находятся в этом разделе.</p>
              </div><!-- /.card-body -->
            </div>
          </div>

            


        </div>
      </div>
    </section>
@endsection