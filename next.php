<?php

  $con=mysqli_connect("localhost","root","","office");
  
  $action=$_POST["action"];
  if($action=="Insert"){
    $emp_name=mysqli_real_escape_string($con,$_POST["emp_name"]);
    $emp_id=mysqli_real_escape_string($con,$_POST["emp_id"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $password=mysqli_real_escape_string($con,$_POST["password"]);
    $sql="insert into employee (emp_name,emp_id,email,password) values ('{$emp_name}','{$emp_id}','{$email}'),'{$password}') ";
    if($con->query($sql)){
      $id=$con->insert_id;
      echo "
        <tr uid='{$id}'>
          <td>{$emp_name}</td>
          <td>{$emp_id}</td>
          <td>{$email}</td>
          <td>{$password}</td>
        </tr>";
    }else{
      echo false;
    }
  }
?>