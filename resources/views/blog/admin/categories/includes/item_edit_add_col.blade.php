@php  /** @var \App\Models\BlogCategory $item **/ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-outline-success">Сохранить</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning">Назад</a>
            </div>
        </div>
    </div>
</div>


@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{$item->id}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Создано</label>
                        <input type="text" class="form-control" value="{{$item->created_at}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Изменено</label>
                        <input type="text" class="form-control" value="{{$item->updated_at}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Удалено</label>
                        <input type="text" class="form-control" value="{{$item->deleted_at}}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
