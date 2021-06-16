<!DOCTYPE html>
<html>
<head>
    <title>Employee Leave System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

        @if(session()->get('flash_success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('flash_success') }}
            </div>
        @endif
        @if(session()->get('flash_error'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('flash_error') }}
            </div>
        @endif
        @if($errors)
            @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
            @endforeach
        @endif
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <h2>Employee Login</h2>
        </div>
        <div class="card-body">

            <form action="{{ route('emp.login') }}" method="post">
                {{ csrf_field() }}
            {{--<form name="employee" id="employee" method="post" action="{{url('store-form')}}">
                @csrf--}}
                {{--<div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror form-control">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror form-control">

                </div>

                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">

                </div>
                {{--<div class="form-group">
                    <label for="exampleInputEmail1">Age</label>
                    <input type="number" id="age" name="age" class="@error('age') is-invalid @enderror form-control">
                    @error('age')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>--}}
                {{--<div class="form-group">
                    <label for="exampleInputEmail1">Contact No</label>
                    <input type="number" id="contact_no" name="contact_no" class="@error('contact_no') is-invalid @enderror form-control">
                    @error('contact_no')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>--}}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
