@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" >
            <div class="row">
                <div class="col-lg-2"><h6 class="m-0 font-weight-bold text-primary">All Accounts</h6></div>
                <div class="col-lg-8">
                    <form>
                        <div class="row">
                            <div class="col-lg-8">
                                <input name="search" value="{{$query}}" type="text" class="form-control"></input>
                            </div>
                             <div class="col-lg-4">
                                <button class="btn btn-primary btn-user btn-block" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                    <h6 class="m-0 font-weight-bold text-primary text-right">
                        <a href="/create/account">Create</a>
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Contact No</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->contact_no}}</td>
                                <td>{{$user->created_at->format("Y-m-d")}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="card-footer"> 
            {{ $users->links("vendor.pagination.bootstrap-5") }}
        </div>
    </div>
@endsection