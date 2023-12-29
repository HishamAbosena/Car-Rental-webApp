<?php

$name = $_POST['name'];
$password = $_POST['Password'];
$vv = $_POST['type'];
$conn = mysqli_connect("localhost", "root", "", "car rental system");
if (!$conn) {

    echo "Connection failed!";

}else {
    if($vv === "Customer"){
    $stmt = $conn->prepare("SELECT ssn FROM Customer as C WHERE C.name='$name' and C.password='$password'");
    $stmt->execute();
    $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
           echo "Successful customer";
          }      }
else if($vv === "admin") {
    $stmt2 = $conn->prepare("SELECT * FROM Admin WHERE name='$name' and password='$password'");
    $stmt2->execute();
    $result2 = $stmt2->get_result(); 
        if ($result2->num_rows > 0) {
           include("admin.html");
          }
        else{
            echo "Wrong email or password";
        }    
}
else{
echo "choose customer or admin type";
}

}
?>