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
    <h2>Employee Dashboard</h2>
{{--
    <p><button type="button" class="btn btn-secondary">Send Approval Request</button></p>
--}}
    <p><a href="{{ route('emp.approval_req',  ['id' => $emp_id])  }}" class="btn btn-info btn-sm pull-right">
            Send Approval Request
        </a></p>

    <table class="table table-bordered table-sm">
        <tbody>
        <tr>
            <td>Empoyee ID</td>
            <td>{{ $emp_id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $emp_name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $emp_email }}</td>
        </tr>
        </tbody>
    </table>
    <div class="table-responsive-sm">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Requested Date</th>
                <th>Requested From</th>
                <th>Requested Upto</th>
                <th>Days</th>
                <th>Response</th>
                <th>Limit</th>

            </tr>
            </thead>
            <tbody>
            <?php if(!empty($emp_approval_requests))
                    foreach ($emp_approval_requests as $emp_approval_request) {
                    if($emp_approval_request->approved == 1){
                        $response = "Approved";
                    }
                    elseif ($emp_approval_request->request_sent == 0){
                        $response = "Cancelled";
                    }
                    else {
                         $response = "Pending";
                     }
            ?>
            <tr>
                <td>{{$emp_approval_request->created_at}}</td>
                <td>{{$emp_approval_request->requested_from}}</td>
                <td>{{$emp_approval_request->requested_upto}}</td>
                <td>{{$emp_approval_request->no_of_days}}</td>
                <td>{{$response}}</td>
                <td>{{$emp_approval_request->limit}}</td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
