@extends('layout.app')
 
@section('title', ' | Call to action')
 
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Call to action</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Главная</a></li>
              <li class="breadcrumb-item active">Call to action</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                  <form method="GET" action="{{ url('/admin/cta') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 d-inline-block float-l" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Поиск по разделу..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary btn-sm" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <a href="{{ url('/admin/cta/create') }}" class="btn btn-success pull-right btn-sm float-r" title="Добавить">
                        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                    </a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
 
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <br>
                                <table class="table">
                                    <tbody>
                                        @foreach($child_pages as $item)
                                        <tr>
                                            <td>
                                              @if(!empty($item->image))
                                                <img src="{{ url('public/content/images/' . $item->image) }}" height="100"/>
                                              @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                              {{ $item->description }}
                                            </td>
                                            <td>
                                                <a href="{{ route('cta.edit', $item->id) }}" title="Редактировать"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать</button></a>
 
                                                <form method="POST" action="{{ url('/admin/cta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Удалить" onclick="return confirm('Удалить?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection