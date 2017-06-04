
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  OrderId: <input type="text" name="orderId" value="<?php echo $orderId;?>">
  <span class="error">* <?php echo $orderIdErr;?></span>
  <br><br>
  Model: <input type="ctype_alnum" name="model" value="<?php echo $model;?>">
  <span class="error">* <?php echo $modelErr;?></span>
  <br><br>

  Color: <input type="text" name="color" value="<?php echo $color;?>">
  <span class="error">* <?php echo $colorErr;?></span>
  <br><br>

  Price 1: <input type="number" name="price1" value="<?php echo $price1;?>">
    <br><br>
    Price 2: <input type="number" name="price2" value="<?php echo $price2;?>">
    <br><br>
    Price 3: <input type="number" name="price3" value="<?php echo $price3;?>">
    <br><br>
  
  
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $orderId;
echo "<br>";
echo $model;
echo "<br>";
echo $color;
echo "<br>";
echo $price1;
echo "<br>";
echo $price2;
echo "<br>";
echo $price3;
?>

</body>
</html>

<?php
include 'connection.php';
// define variables and set to empty values
$orderIdErr = $modelErr = $colorErr = " ";
$orderId = $model = $color =  " ";
$price1 = $price2 = $price3 = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["orderId"])) {
    $orderIdErr = "orderId is required";
  } else {
    $orderId = test_input($_POST["orderId"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$orderId)) {
      $orderIdErr = "Only numbers are allowed in OrderId";
    }
  }
  
  if (empty($_POST["model"])) {
    $modelErr = "model number is required";
  } else {
    $model = test_input($_POST["model"]);
    // check if e-mail address is well-formed
    if (!ctype_alnum($model)) {
      $modelErr = "model number contain only characters and digits";
    }
  }
    
  
  if(empty($_POST["color"])) {
    $colorErr = "color is required";
  } 
  else{
    $color  = test_input($_POST["color"]);
  }
  $price1 = test_input($_POST["price1"]);
  $price2 = test_input($_POST["price2"]);
  $price3 = test_input($_POST["price3"]);
  
}

$profit = $price1 + $price2 + $price3;

$sql = "INSERT INTO screenbizz(OrderID,Model,Color,Profit)
  VALUES ('$orderId','$model','$color','$profit')";
  if($conn->query($sql) === TRUE){
   echo "New Record created succesfully";
  }
  else{
   echo "Error";
  }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>