@extends('layouts.frontend_master')


@section('title')
Customer Form
@endsection

@section('content')


<div class="container">
        <div class="row">
            <div class="col-md-5">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        <button class="close" role="dismiss">&times;</button>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        Resister, if you are not Register betore!
                    </div>
                    <div class="card-body">
                        <form action="{{route('customer_signup')}}" method="post" >
                        	@csrf
                           
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" class="form-control" type="text" name="first_name"
                                    value="" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" class="form-control" type="text" name="last_name"
                                    value="" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input id="email_address" class="form-control" type="text" name="email_address"
                                    value="" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="phone_number"> Phone Number</label>
                                <input id="phone_number" class="form-control" type="text" name="phone_number"
                                    value="" placeholder="Enter Your Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password"
                                    value="" placeholder="Enter Your Password">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" cols="30"
                                    rows="2" placeholder="Enter Your full address "></textarea>
                            </div>
                            <input class="btn btn-success btn-lg btn-block" type="submit" value="Resister">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
              
              @if (session('wrong_info'))
                <div class="alert alert-danger" role="alert">
                    <button class="close" data-dismiss="alert">&times;</button>
                    {{session('wrong_info')}}
                </div>

                @endif
              
                <div class="card">
                    <div class="card-header">
                       Already Registered? Login here!
                    </div>
                    <div class="card-body">
                        <form action="{{route('customer_login')}}" method="post" >
                        @csrf

                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input id="email_address" class="form-control" type="text" name="email_address"
                                    value="" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password"
                                    value="" placeholder="Enter Your Password">
                            </div>

                            <input class="btn btn-success btn-lg btn-block" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection