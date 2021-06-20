<?php

include('connect.php');

// check GET request id param
if(isset($_GET['id'])){
	
    // HERE WE ARE  FETCHING THE DATA OF A PARTICULAR ID
    
    
    $m=$id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM costumers WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $one = mysqli_fetch_assoc($result);
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">


    <title>Document</title>

</head>
<body>

<style>
    
    h1{
        margin-top: 10px;
    }
    h2{
        color:#fff;
        text-align: center;
        font-weight: 600;
        font-size: 50px;
        margin-top: 30px;
    }
    .costumer_details{
        background-color: grey;
        border-radius: 20px;
        width:1000px;
        margin-top: 100px;
        margin-left:200px;
        
    }

    .costumer_details h2{
        color:#fff;
        padding:20px;
    }

    .button{
        
        margin-left:500px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    a{
        text-decoration: none;
    }
</style>

</div>


<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
         
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              <a class="nav-link" href="costumers.php">List of costumers</a>
              <a class="nav-link" href="transaction.php">Transfer Money</a>
              <a class="nav-link" href="transaction_history.php">Transaction History</a>
              
            </div>
          </div>
        </div>
</nav>

<h1>THE SPARKLE BANK </h1>

<h2>CUSTOMER DETAILS</h2>
<div class="costumer_details">

<h2>Name of the costumer:- <?php echo $one['name']; ?> </h2>

<h2>Email of the costumer:- <?php echo $one['email']; ?></h2>

<h2>Account created on:- <?php echo  $one['time']; ?></h2>

<h2>Current balance:-Rs <?php echo  $one['current_balance'];?></h2>

<button type="button" class="btn btn-success button"><a href="transaction.php">Send Money</a></button>

</div>




</body>
</html>