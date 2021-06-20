
<?php
include('connect.php');

// * write query for all costumers details
$sql_id=' SELECT  * FROM costumers';
// * get the result set (set of rows)
$res1 = mysqli_query($conn, $sql_id);
// * fetch the resulting rows as an array
$res_ids = mysqli_fetch_all($res1, MYSQLI_ASSOC);

mysqli_free_result($res1);

mysqli_close($conn);

?>
<?php
include('connect.php');

$s_name=$r_name=$money1='';

// creating an array named errors so that we can display the errors in the form 

$errors = array('s_name' => '', 'r_name' => '', 'money1' => '');

if(isset($_GET['submit'])){
    
    // * storing the values received from the form
    $sender = mysqli_real_escape_string($conn, $_GET['sender']);
    
    // * storing the values received from the form
    $receiver = mysqli_real_escape_string($conn, $_GET['receiver']);
    
    // * storing the values received from the form
    $money = mysqli_real_escape_string($conn, $_GET['amount']);
    
   
    // * fetching all details of sender 
    $sender_det=" SELECT * FROM costumers where id=$sender";

    $sender_details=mysqli_query($conn,$sender_det);

    $sender1= mysqli_fetch_assoc($sender_details);

    
    
    // * fetching all details of receiver

    $receiver_det=" SELECT * FROM costumers where id=$receiver";

    $receiver_details=mysqli_query($conn,$receiver_det);

    $receiver1= mysqli_fetch_assoc($receiver_details);

    

    // * checking whether the balance entered is a non zero positive value
    
    if($money<0){
    $errors['money1']='negative balance not allowed';
    }else if ($money==0){
    $errors['money1']="please enter a non zero positive amount";
    }else{
    $errors['money1']='';
    }
     
    // * condition to insure that the sender and receiver are not same.
    
    if($sender1['id']===$receiver1['id']) {
       $errors['s_name']='sender and receiver cannot be same';
       $errors['r_name']='sender and receiver cannot be same';
     }else{
        $errors['s_name']='';
        $errors['r_name']='';
     }

    
    if($sender1['current_balance']<$money)
    {
        $errors['money1']='insufficient balance to perform the transaction';
        
    }
    else{
        $sender1['current_balance']=$sender1['current_balance']-$money;
        
        $receiver1['current_balance']=$receiver1['current_balance']+$money;
        
        $temp_id1=$sender1['id'];
        $temp_id2=$receiver1['id'];
        $temp_bal1=$sender1['current_balance'];
        $temp_bal2=$receiver1['current_balance'];

        // * queries to update the values in the database
        $sql1="UPDATE costumers SET current_balance=$temp_bal1 WHERE id=$temp_id1 ";
        $sql2="UPDATE costumers SET current_balance=$temp_bal2 WHERE id=$temp_id2 ";
        
        // * saving changes in the database
        if(mysqli_query($conn, $sql1)){
            
        }else {
            echo 'query error: '. mysqli_error($conn);
        }

        if(mysqli_query($conn, $sql2)){
            
        }else {
            echo 'query error: '. mysqli_error($conn);
        }
    }

    if(array_filter($errors)){
        //echo 'errors in form';
    } else {
            $trans_sender_name = mysqli_real_escape_string($conn, $sender1['name']);
            $trans_sender_id = mysqli_real_escape_string($conn, $sender1['id']);
			$trans_receiver_name = mysqli_real_escape_string($conn, $receiver1['name']);
            $trans_receiver_id = mysqli_real_escape_string($conn, $receiver1['id']);
			
    $sql="INSERT INTO transactions (t_id, sender_name, sender_id, receiver_name, receiver_id, amount, time_stamp) VALUES ('', '$trans_sender_name', '$trans_sender_id', '$trans_receiver_name', '$trans_receiver_id', '$money', current_timestamp());";

    if(mysqli_query($conn, $sql)){
        header('Location: transaction_successful.php');
    }else {
        echo 'query error: '. mysqli_error($conn);
    }
}
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


    <title>Banking System</title>
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
 
 form{

    height:30rem;
    width:30rem;
    margin-left:30rem;
    border-radius: 20px;
    border: 1px solid #000;
    padding: 50px;
    background: #fffff0;

 }


.form_modify{
    padding:100px;

}

.red-text{
    color:red;
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
              <a class="nav-link" href="costumers.php">List of costumers</a>
              <a class="nav-link" href="transaction.php">Transfer Money</a>
              <a class="nav-link" href="transaction_history.php">Transaction History</a>
              
            </div>
          </div>
        </div>
</nav>


<h1>THE SPARKLE BANK </h1>

<h2>please fll this form to perform any transaction</h2>




<form >
    
<div class="row mb-3 ">

<select style="padding:2rem;margin-bottom:20px;margin-top:10px;" class="form-select form_modify" aria-label="Default select example"  name= "sender" >
  
  <option selected>Select sender name</option>
 
 <?php foreach($res_ids as $res_id) {?>
 
   <option  value="<?php echo $res_id['id']  ?>"><?php echo $res_id['name']  ?></option>
 <?php  }  ?> 

</select>

<div class="red-text"><?php echo $errors['s_name']; ?></div>

<select style="padding:2rem;margin-bottom:20px;" class="form-select" aria-label="Default select example" name="receiver">
  
  <option selected>Select receiver name</option>
  
  <?php foreach($res_ids as $res_id) {?>
  
  <option  value="<?php echo $res_id['id']  ?>"><?php echo $res_id['name']  ?></option>
 
  <?php  }  ?>  
  
</select>

<div class="red-text"><?php echo $errors['r_name']; ?></div>

<input style="padding:2rem;margin-bottom:20px;" name="amount"  class="form-control" type="number" placeholder="enter amount" aria-label="default input example">

<div class="red-text"><?php echo $errors['money1']; ?></div>

<button type="submit" name="submit" value="Submit"  class="btn btn-primary">Submit</button>


</div>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>