<?php
$output = "";
$name =htmlspecialchars($_GET['name']);

if (isset($_POST['compute'])) { 
    $prev_reading = $_POST['prev_reading']; 
    $curr_reading = $_POST['curr_reading'];
    $type = $_POST['customer_type'];

    $usage = $curr_reading - $prev_reading;
    if ($curr_reading < $prev_reading) {
        $output = "<div class='alert alert-danger'> Invalid Reading: Current reading cannot be lower than previous. </div>"; 
    } else {
        if ($usage<=200) {
            $charge=10;
            $usagetype="Low Usage";
        } else if ($usage>200) {
            $charge=15;
            $usagetype="High Usage";
        }
        
        if ($type == "commercial") {
            $bill = $usage * $charge +500;
        } else {
            $bill = $usage * $charge;
        }

        $output = "<div class='alert alert-success'>
                    Consumer Name: $name <br>
                    Consumer Type: $type <br>
                    Usage($usagetype): $usage kWh <br>
                    Rate per kWh: Php $charge.00/kWh <br>
                    Total Bill: Php $bill.00
                    </div>"; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eco-Friendly Electric Bill App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4190ff 0%, #ffffff 100%);
        }
        .btn {
            background-color: #006aff;
            color: white;
        }
            .btn:hover {
                background-color: #1e70ff;
            }
    </style>
</head>
<body class="container mt-5 mb-5 col-md-6 py-5">

<div class="card p-4 shadow">
    <h3>Eco-Friendly Electric Bill App</h3>

    <form method="GET" class="mb-2">
        <label for="name" class="form-label">Consumer Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Consumer Name">
    </form>
    <form method="POST">
        <label for="customer_type" class="form-label">Customer Type:</label>
        <select name="customer_type" class="form-control mb-3">
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
        </select>
        <label for="prev_reading" class="form-label">Previous Reading (kWh):</label>
        <input type="number" name="prev_reading" class="form-control mb-2" placeholder="Previous Reading (kWh)">
        <label for="curr_reading" class="form-label">Current Reading (kWh):</label>
        <input type="number" name="curr_reading" class="form-control mb-2" placeholder="Current Reading (kWh)">

        <hr>

        <button name="compute" class="btn btn-primary w-100 mb-3">Compute</button>
    </form>
    
    <?= $output ?>
    
            
    
    
</div>

</body>
</html>
