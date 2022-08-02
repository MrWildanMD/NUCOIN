<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">

</head>

<body>
    <div id="app">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Proof</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>From User</th>
                        <th>Donator</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coins as $coin)
                        {{-- {{ print $coin }} --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img width="100" height="100" src="{{ url('images/' . $coin->proof) }}"></td>
                            <td>{{ $coin->amount }}</td>
                            <td>{{ $coin->coin_date }}</td>
                            <td>{{ $coin->users->name }}</td>
                            <td>{{ $coin->donators->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        // window.print();
    </script>
</body>

</html>
