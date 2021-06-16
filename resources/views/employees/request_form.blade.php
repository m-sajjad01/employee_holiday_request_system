<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>



<div class="container" style="background-color:#f7fafc">
    <h2>Approval Request Form </h2>

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
    <table class="table table-bordered table-sm">

    <div class="table-responsive-sm">
        <table class="table table-bordered">

            <form action="{{ route('emp.approval_req_process') }}" method="post">
                {{ csrf_field() }}
                <tr>
                    <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $emp_id?>">
                    <td>Date From </td>
                    <td><input type="date" id="date_from" name="date_from" ></td>
                    <td>Date Upto</td>
                    <td><input type="date" id="date_to" name="date_to" ></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="btn btn-info">Submit</button></td>
                </tr>

            </form>
        </table>
    </div>
</div>

</body>
</html>
