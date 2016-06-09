<?php
	require_once "header.php";
?>

<div class="container-fluid" id = "parentContainer" >
  <div class="row content" id = "rowContent">
    <div class="col-sm-3 sidenav hidden-xs">
      <ul class="nav nav-pills nav-stacked">
          <li><center><button type="button" id="loginButton"><span class="glyphicon glyphicon-off"></span> Login</button></center></li>
      </ul><br>
    </div>
    <br>
    <div class="container fluid col-sm-9">
         <div class="well" id = "mainContainer">
           <h4><center><i class="fa fa-user-md" style="font-size:400px"></center></i></h4>
           <p><center>Login to make use of this amazing telemedicine system!<center></p>
         </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal" id="myModal" role="dialog">

    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="text" class="form-control" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <button type="submit" class="btn btn-success btn-block"><a href = "main.html"><span class="glyphicon glyphicon-off"></span> Login</a></button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>

<?php
	require_once "footer.php";
?>
