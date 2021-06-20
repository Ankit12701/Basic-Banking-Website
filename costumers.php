<?php
include('connect.php');

// * write query for all Customers details
$sql_id=' SELECT  * FROM Customers';
// * get the result set (set of rows)
$res1 = mysqli_query($conn, $sql_id);
// * fetch the resulting rows as an array
$res_ids = mysqli_fetch_all($res1, MYSQLI_ASSOC);


mysqli_free_result($res1);

mysqli_close($conn);



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
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
         
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              <a class="nav-link" href="Customers.php">List of Customers</a>
              <a class="nav-link" href="transaction.php">Transfer Money</a>
              <a class="nav-link" href="transaction_history.php">Transaction History</a>
              
            </div>
          </div>
        </div>
</nav>

<h1>THE SPARKLE BANK </h1>

<h2>Customers Details</h2>
<?php   $i=0;  ?>
<table class="table table-dark table-striped table-hover table_custom">

<thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">balance</th>
      <th scope="col"></th>
    </tr>
  </thead>

  <tbody>
<?php  foreach ($res_ids as $res_id){?>

    

   
    <tr>
     <td><?php echo $res_id['id'];   ?></td>
      <td><?php echo  $res_id['name'];   ?></td>
      <td><?php echo  $res_id['email'];   ?></td>
      <td><?php echo  $res_id['current_balance'];    ?></td>
      <td>
      <button class="btn btn-secondary">
  
          <a type="submit"  href="details.php?id=<?php echo $res_id['id'] ?>" >View</a>

      </button>
    
    </td>
    </tr>
    
<?php } ?>
</tbody>
</table>
    
</body>
</html>