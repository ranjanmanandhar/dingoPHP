<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Car List</h1>
            </div>
            <div>
                <a href="/" class="btn btn-secondary">Home</a>
            </div>

        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>License Plate</th>
                    <th>State</th>
                    <th>VIN</th>
                    <th>Year</th>
                    <th>Colour</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->license_plate }}</td>
                    <td>{{ $car->state->state_code ?? 'N/A' }}</td>
                    <td>{{ $car->vin }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->colour }}</td>
                    <td>{{ $car->make->name ?? 'N/A' }}</td>
                    <td>{{ $car->model->name ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="viewCar('{{ $car->id }}')">View Car</button>
                        <button class="btn btn-warning btn-sm" data-car='@json($car)' onclick='syncCar(this)'>Sync Car Data</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function viewCar(carId) {
            const view_url = "{{ env('APP_URL') }}/cars/" + carId;
            window.location.href = view_url;
        }

        function syncCar(button) {
            button.disabled = true;
            const originalText = button.innerText;
            button.innerText = 'Syncing...';

            const car = JSON.parse(button.getAttribute('data-car'));
            let fetch_url = "{{ env('APP_URL') }}/quotes/sync";
            console.log(fetch_url);

            fetch(fetch_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(car)
                })
                .then(response => response.json())
                .then(data => {
                    alert('Response from server: ' + data.message);
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while syncing the car data.');
                })
                .finally(() => {
                    button.disabled = false;
                    button.innerText = originalText;
                });
        }
    </script>
</body>

</html>