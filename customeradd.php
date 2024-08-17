<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #444;
            text-align: center;
            margin-top: 40px;
            font-size: 2rem;
        }

        form {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        form:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Add Customer</h1>
    <form id="customerForm" method="POST" action="insert_customer.php">
        <div class="form-group">
            <label for="username2">User Name:</label>
            <input type="text" id="username2" name="username" required />
        </div>
        <div class="form-group">
            <label for="contactNumber2">Contact:</label>
            <input type="text" id="contactNumber2" name="contactNumber" required />
        </div>
        <div class="form-group">
            <label for="vehicleNumber2">Vehicle Number:</label>
            <input type="text" id="vehicleNumber2" name="vehicleNumber" required />
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>

    <script>
        document.getElementById('customerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target;

            // Create a FormData object from the form
            const formData = new FormData(form);

            // Send the form data to the server using fetch
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                // Check if the form submission was successful
                if (result.includes('Credit updated successfully')) {
                    window.location.href = 'pos.php'; // Redirect to pos.php
                } else {
                    alert('There was an error processing your request.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error processing your request.');
            });
        });
    </script>
</body>
</html>
