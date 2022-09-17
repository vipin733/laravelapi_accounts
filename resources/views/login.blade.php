@extends('layouts.nondash')
@section("content")
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user"  method="POST" action="/login">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" value="{{old('username')}}" 
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter username"
                                            class="form-control form-control-user @error('username') is-invalid @enderror"
                                            />
                                        @error('username')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" value="{{old('password')}}" 
                                            id="exampleInputPassword" placeholder="Password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"/>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    {{-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </a> --}}

                                    <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection