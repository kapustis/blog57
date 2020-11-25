@extends('layouts.app')

@section('content')
	<div class="container">
		@include('blog.admin.posts.includes.result_messages')
		<div class="row justify-content-center">
			<div class="col-md-12">
				<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
					<a class="btn btn-primary" href="{{route('blog.admin.posts.create')}}">Добавить</a>
				</nav>
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>#</th>
								<th>Автор</th>
								<th>Категория</th>
								<th>Заголовок</th>
								<th>Дата публикации</th>
							</tr>
							</thead>
							<tbody>
							@foreach($posts as $item)
								@php /** @var \App\Models\BlogPost $item */ @endphp
								<tr
										@if($item->is_published)  style="background-color:#2a9055;" @endif
										@if(!$item->is_published) style="background-color:#f66D9b;" @endif
								>
									<td>{{$item->id}}</td>
									<td>{{$item->creator->name}}</td>
									<td>{{$item->category->title}}</td>
									<td>
										<a href="{{ route('blog.admin.posts.edit', $item->id) }}" class="badge-dark">
											{{$item->title}}
										</a>
									</td>
									<td>{{$item->is_published ? \Carbon\Carbon::parse($item->published_at)->format('d.M H:i'): ''}}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if($posts->total() > $posts->count())
			<br>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							{{$posts->links()}}
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection
