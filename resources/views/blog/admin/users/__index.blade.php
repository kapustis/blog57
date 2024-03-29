@extends('blog.admin.layout.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            User Management
                        </div><!--card-header-->
                        <div class="card-body">
                            <div>
                                <div class="container-fluid p-0">
                                    <div class="d-md-flex justify-content-between mb-3">
                                        <div class="d-md-flex">
                                            <div class="mb-3 mb-md-0 input-group">
                                                <input placeholder="Search" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th style="cursor:pointer;">
                                                    <div class="d-flex align-items-center">
                                                        <span>Type</span>
                                                    </div>
                                                </th>

                                                <th style="cursor:pointer;">
                                                    <div class="d-flex align-items-center">
                                                        <span>Name</span>
                                                    </div>
                                                </th>

                                                <th style="cursor:pointer;">
                                                    <div class="d-flex align-items-center">
                                                        <span>E-mail</span>
                                                    </div>
                                                </th>

                                                <th style="cursor:pointer;">
                                                    <div class="d-flex align-items-center">
                                                        <span>Verified</span>
                                                    </div>
                                                </th>

                                                <th> Actions</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($users as $user)
                                                @php /** @var App\Models\User  $user */ @endphp
                                                <tr>
                                                    <td> {{$user->roles[0]->name}} </td>
                                                    <td> {{$user->name}} </td>
                                                    <td>
                                                        <a href="mailto:admin@admin.com">{{$user->email}}</a>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success" data-toggle="tooltip">{{$user->email_verified_at}}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route("blog.admin.users.edit",$user)}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div><!--card-body-->
                    </div><!--card-->
                </div>
            </div>
        </div>

        @if($users->total() > $users->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$users->links("vendor.pagination.default")}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
