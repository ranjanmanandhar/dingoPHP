<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Car Details</h1>
            </div>
            <div class="d-flex">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mr-2">Back to Car List</a>
                <a href="/" class="btn btn-secondary">Home</a>
            </div>
        </div>

        @if($cardetails)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Basic Information</h5>
                <p><strong>ID:</strong> {{ $cardetails->id }}</p>
                <p><strong>License Plate:</strong> {{ $cardetails->license_plate }}</p>
                <p><strong>State:</strong> {{ $cardetails->state->name }} ({{ $cardetails->state->state_code }})</p>
                <p><strong>VIN:</strong> {{ $cardetails->vin }}</p>
                <p><strong>Year:</strong> {{ $cardetails->year }}</p>
                <p><strong>Colour:</strong> {{ $cardetails->colour }}</p>
                <p><strong>Make:</strong> {{ $cardetails->make->name }}</p>
                <p><strong>Model:</strong> {{ $cardetails->model->name }}</p>
            </div>
        </div>

        <h5 class="mb-4">Quotes</h5>
        @if($cardetails->quote && count($cardetails->quote) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Price</th>
                    <th>Repairer</th>
                    <th>Overview of Work</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cardetails->quote as $quote)
                <tr>
                    <td>{{ $quote->id }}</td>
                    <td>${{ number_format($quote->price, 2) }}</td>
                    <td>{{ $quote->repairer }}</td>
                    <td>{{ $quote->overview_of_work }}</td>
                    <td>{{ \Carbon\Carbon::parse($quote->created_at)->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No quotes available for this car.</p>
        @endif
        @else
        <p>No car details found.</p>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>