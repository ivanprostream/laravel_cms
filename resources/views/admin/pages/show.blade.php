@extends('layout.app')
 
@section('title', ' | Просмотр')
 
@section('content')
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{ $page->name }}</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Главная</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('/admin/structure') }}">Структура</a></li>
                  <li class="breadcrumb-item active">Просмотр</li>
                </ol>
              </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                  <form method="GET" action="{{ url('/admin/pages') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 d-inline-block float-l" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Поиск по разделу..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary btn-sm" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <a href="{{ url('/admin/pages/create') }}" class="btn btn-sm btn-success pull-right float-r" title="Добавить">
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
     
                            <a href="{{ url('/admin/pages') }}" title="Назад"><button class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                            <a href="{{ url('/admin/pages/' . $page->id . '/edit') }}" title="Редактирование"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактирование</button></a>
     
                            <form method="POST" action="{{ url('admin/projects' . '/' . $page->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete role" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Удаление</button>
                            </form>
                            <br/>
                            <br/>
                            <br/>
     
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link btn-sm active" href="#tab_pages" data-toggle="tab">Страницы</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#tab_content" data-toggle="tab">Контент</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#tab_gallery" data-toggle="tab">Галерея</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#tab_seo" data-toggle="tab">SEO</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#tab_settings" data-toggle="tab">Настройки</a></li>
                            </ul>
                            <hr>
                            <div class="tab-content">
                                <div class="active tab-pane" id="tab_pages">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @foreach($child_pages as $item)
                                                <tr id="item-{{ $item->id }}">
                                                    <td><i class="fas fa-arrows-alt-v handle"></i></td>
                                                    <td>
                                                        @if(!empty($item->image))
                                                            <img src="{{ url('public/content/images/' . $item->image) }}" height="60"/>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <a href="{{ route('pages.show', $item->id) }}" title="Просмотр"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>
                                                        <a href="{{ route('pages.edit', $item->id) }}" title="Редактировать"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать</button></a>
         
                                                        <form method="POST" action="{{ url('/admin/pages' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                                <div class="tab-pane" id="tab_content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr><th>Название страницы</th><td>{{ $page->name }}</td></tr>
                                                <tr><th>URL страницы</th><td>{{ $page->url }}</td></tr>
                                                <tr><th>Краткое описание</th><td>{{ $page->short_text }}</td></tr>
                                                <tr><th>Контент страницы</th><td>{!! $page->text !!}</td></tr>
                                                <tr><th>Контент страницы (дополнительный)</th><td>{!! $page->text_2 !!}</td></tr>
                                                <tr><th>Изображение для страницы</th><td>
                                                    @if(!empty($page->image))
                                                        <img src="{{ url('public/content/images/' . $page->image) }}" width="200"/>
                                                    @endif
                                                </td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_gallery">
                                    <a href="{{ url('/admin/pages/gallery', $page->id) }}" class="btn btn-success btn-sm" title="Добавить">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                                    </a>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table">
                                        <tbody>
                                          @foreach($gallery as $item)
                                          <tr>
                                            <td>
                                              @if(!empty($item->image))
                                                <img src="{{ url('public/content/images/' . $item->image) }}" height="100"/>
                                              @endif
                                            </td>
                                            <td>
                                              {{ $item->name }}
                                            </td>
                                            <td>
                                              <form method="POST" action="{{ url('/admin/pages/gallery_delete' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                                <div class="tab-pane" id="tab_seo">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr><th>Заголовок</th><td>{{ $page->title }}</td></tr>
                                                <tr><th>Описание страницы (2-3 предложения)</th><td>{{ $page->description }}</td></tr>
                                                <tr><th>Ключевые слова (7-10 через запятую)</th><td>{{ $page->key_words }}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  
                                </div>

                                <div class="tab-pane" id="tab_settings">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr><th>Тип страницы</th><td>{{ $page->pageType->name }}</td></tr>
                                                <tr><th>Отображение страницы</th><td>{{ isset($page->show) && $page->show == 1 ? 'Показывать' : 'Не показывать'}}</td></tr>
                                                <tr><th>Отображение в меню списком</th><td>{{ isset($page->menu) && $page->menu == 1 ? 'Показывать' : 'Не показывать'}}</td></tr>
                                                <tr><th>Скрипт на странице</th><td>{!! $page->script !!}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection