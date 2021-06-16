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
    <h2>Manager Dashboard</h2>
    <div class="table-responsive-sm">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Requested Date</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Days</th>
                <th>Response</th>
                <th>Limit</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            <?php if(!empty($requests))
                foreach( $requests as $request) {
                $date1=date_create($request->requested_from);
                $date2=date_create($request->requested_upto);
                $diff=date_diff($date1,$date2);
                $days =  $diff->format("%a");

                ?>
            <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->created_at }}</td>
                <td>{{ $request->requested_from }}</td>
                <td>{{ $request->requested_upto }}</td>
                <td>{{ $days}}</td>
                <td>{{ $request->approved }}</td>
                {{--<td>{{ $request->remaining }}</td>--}}
                {{--<td>{{ 'consumed' }}</td>--}}
                <td>{{ $request->limit }}</td>
                <td><a href="{{ route('holidays.approval_req', ['id' => $request->employee_id]) }}" class="btn btn-success btn-sm pull-right">
                        Approve
                    </a>
                    &nbsp;
                    <a href="{{ route('holidays.cancel_req', ['id' => $request->employee_id])  }}" class="btn btn-danger btn-sm pull-right">
                        Cancel
                    </a>
                </td>

            </tr>
           <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
