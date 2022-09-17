@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Account</h6>
        </div>
        <div class="card-body">
           <form  method="POST" action="/create/account">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="first_name" value="{{old('first_name')}}" 
                                placeholder="Enter first name"
                                class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                />
                            @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="last_name" value="{{old('last_name')}}" 
                                placeholder="Enter last name"
                                class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                />
                            @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="email" name="email" value="{{old('email')}}" 
                                placeholder="Enter email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                />
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="username" value="{{old('username')}}" 
                                placeholder="Enter username"
                                class="form-control form-control-user @error('username') is-invalid @enderror"
                                />
                            @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="password" name="password"
                                placeholder="Enter password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                />
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="contact_no" value="{{old('contact_no')}}" 
                                placeholder="Enter contact no"
                                class="form-control form-control-user @error('contact_no') is-invalid @enderror"
                                />
                            @error('contact_no')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-4 col-lg-offset-4">
                        <button class="btn btn-primary btn-user btn-block" type="submit">Create</button>
                    </div>
                   
                </div>
           </form>
        </div>
    </div>
@endsection