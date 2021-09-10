@extends('blog.admin.layout.admin')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{route('blog.admin.categories.create')}}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Категория</th>
                                <th>Родитель</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                @php /** @var \App\Models\BlogCategory $category */ @endphp
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.categories.edit', $category->id) }}">{{$category->title}}</a>
                                    </td>
                                    <td @if(in_array($category->parent_id,[0,1])) style="color:#f66D9b;" @endif >
                                        {{ $category->parentTitle }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($categories->total() > $categories->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$categories->links("vendor.pagination.default")}}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
