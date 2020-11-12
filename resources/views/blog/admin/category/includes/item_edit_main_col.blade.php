@php
    /**
     * @var \App\Models\BlogCategory $item
     * @var \Illuminate\Support\Collection $list
     **/
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" role="tab" href="#maindata">Основные даные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control"
                                    minlength="3"
                                    required
                                    value="{{$item->title}}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="slug">Заголовок</label>
                            <input
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    class="form-control"
                                    value="{{$item->title}}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Заголовок</label>
                            <select class="form-control" name="parent_id" id="parent_id" required pleceholder="Выберите категорию">
                                @foreach($list as $option)
                                    <option value="{{$option->id}}" @if($option->id == $item->parent_id) selected @endif>
                                        {{ $option->id }} . {{$option->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
