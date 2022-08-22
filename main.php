<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BoscoSoft Employees</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
<div class="modal" tabindex="-1" role="dialog" id='modal_frm'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Employee Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='frm'>
      <input type='hidden' name='action' id='action' value='Insert'>
      <input type='hidden' name='id' id='uid' value='0'>
      <div class='form-group'>
        <label>Employee Name</label>
        <input type='text' name='emp_name' id='emp_name' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Employee Id</label>
        <input type='text' name='emp_id' id='emp_id' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Email</label>
        <input type='email' name='email' id='email' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Password</label>
        <input type='password' name='password' id='password' required class='form-control'>
      </div>
      <input type='submit' value='Submit' class='btn btn-success'>
    </form>
      </div>
    </div>
  </div>
</div>

  <div class='container mt-5'>
      <p class='text-right'><a href='#' class='btn btn-primary' id='add_record' style="border-width: 3px; border-radius: 5px;">Add Employee</a></p>
    
    <table class='table table-bordered' style="border-width:3px;">
    <thead>
      <th bgcolor="violet">S.No</th>
      <th bgcolor="violet">Employee Name</th>
      <th bgcolor="violet">Employee Id</th>
      <th bgcolor="violet">Email</th>
      <th bgcolor="violet">Password</th>
    </thead>
    <tbody id='tbody'>
      <?php 
        $con=mysqli_connect("localhost","root","","main");
        $sql="select * from employee";
        $res=$con->query($sql);
        while($row=$res->fetch_assoc()){
          echo "
            <tr uid='{$row["id"]}'>
              <td>{$row["emp_name"]}</td>
              <td>{$row["dob"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["password"]}</td>
            </tr>
          ";
        }
      ?>
    </tbody>
    </table>
  </div>
    <script>
      $(document).ready(function(){
        var current_row=null;
        $("#add_record").click(function(){
          $("#modal_frm").modal();
        });
        
        $("#frm").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:"next.php",
            type:"post",
            data:$("#frm").serialize(),
            beforeSend:function(){
              $("#frm").find("input[type='submit']").val('Wait a minute...');
            },
            success:function(res){
              if(res){
                if($("#uid").val()=="0"){
                  $("#tbody").append(res);
                }else{
                  $(current_row).html(res);
                }
              }else{
                alert("Failed Try Again");
              }
              $("#frm").find("input[type='submit']").val('Submit');
              clear_input();
              $("#modal_frm").modal('hide');
            }
          });
        });
         });
        
    </script>
  </body>
</html>