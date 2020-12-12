@php /**  @var \App\Models\BlogPost $item **/ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Доп. данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title"
                                   id="title" value="{{old('title',$item->title)}}"
                                   class="form-control" minlength="3"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Текст поста</label>
                            <textarea name="content_raw" id="content_raw"
                                      class="form-control" rows="20"
                            >{{old('content_raw',$item->content_raw)}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select class="form-control" name="category_id" id="category_id" required pleceholder="Выберите категорию">
                                @foreach($categoryList as $option)
                                    <option value="{{$option->id}}" @if($option->id == $item->category_id) selected @endif>
                                        {{ $option->id_title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Индентификатор</label>
                            <input type="text" id="slug" name="slug"
                                   value="{{$item->slug}}"
                                   class="form-control"
                            >
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea type="text" id="excerpt" name="excerpt" class="form-control" rows="3"
                            >{{old('excerpt',$item->excerpt)}}</textarea>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published"
                                   value="1"
                                   @if($item->is_published) checked="checked" @endif
                            >
                            <label for="is_published" class="form-check-label">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


