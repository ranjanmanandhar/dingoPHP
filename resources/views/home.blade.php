<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ddd;
        }

        #api_button {
            background-color: #4CAF50;
            color: white;
        }

        #store_buttom {
            background-color: #2196F3;
            color: white;
        }

        #delete_buttom {
            background-color: #f44336;
            color: white;
        }

        .loading {
            background-color: #999;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <h1>Choose an Action</h1>
    <button id="api_button" onclick="fetchCars()">Store car details from API</button>
    <button id="store_buttom" onclick="showCars()">Show Cars from Database</button>
    <button id="delete_buttom" onclick="deleteCars()">DELETE every data from Database</button>

    <script>
        function fetchCars() {
            const apiButton = document.getElementById('api_button');
            apiButton.innerText = 'Loading...';
            apiButton.classList.add('loading');
            apiButton.disabled = true;

            fetch('/api/cars/store', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message || 'Cars fetched successfully!');
                })
                .catch(error => {
                    alert('Error fetching cars: ' + error.message);
                })
                .finally(() => {
                    apiButton.innerText = 'Store car details from API';
                    apiButton.classList.remove('loading');
                    apiButton.disabled = false;
                });
        }

        function showCars() {
            window.location.href = '/cars';
        }

        function deleteCars() {
            const deleteButton = document.getElementById('delete_buttom');
            deleteButton.innerText = 'Deleting...';
            deleteButton.classList.add('loading');
            deleteButton.disabled = true;

            fetch('/api/cars', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    console.log(response)
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message || 'Cars deleted successfully!');
                })
                .catch(error => {
                    console.log(error)
                    alert('Error deleting cars: ' + error.message);
                })
                .finally(() => {
                    deleteButton.innerText = 'DELETE every data from Database';
                    deleteButton.classList.remove('loading');
                    deleteButton.disabled = false;
                });
        }
    </script>

</body>

</html>