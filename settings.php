<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<?php

	$username=$_SESSION['username'];  
  $msg='';
   if (isset($_POST['update_pass'])) {
   $old_password=$_POST['old_password'];
   $new_password=$_POST['new_password'];
   $new_password2=$_POST['new_password2'];
  
   if($new_password==$new_password2)
   {
		$query = "SELECT * FROM tbl_affiliates WHERE username='$username' AND password='$old_password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
		
		//logic for change password
		
		mysqli_query($db, "update tbl_affiliates set password='$new_password' where username='$username' AND password='$old_password'");
		$msg='<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Well done!</strong> You successfully updated your password.
            </div>';
			
		
		
			
		}else {
			$msg='<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Oh no!</strong> You have enetered wrong old password.
            </div>';
		}
   }
else
{
	$msg='<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Incorrect!</strong> New password and confirm new password should have the same value.
            </div>';
}	
		
   
   
   
   }
   ?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <?php include('common/head.php') ?>
   </head>
   <body>
      <?php include('common/navigation.php') ?>
      <div class="container">
        <br />
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
			
			 <?=$msg;?>
			
			
               <div class="card">
                  <div class="card-header">Settings</div>
                  <div class="card-body">
                     <form action="" method="post">
                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-right">Enter Old Password</label>
                           <div class="col-md-8">
                              <input type="password"  class="form-control" name="old_password" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-right">Enter New Password</label>
                           <div class="col-md-8">
                              <input type="password"  class="form-control" name="new_password" required>
                           </div>
                        </div>
						
						<div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-right">Re-Enter New Password</label>
                           <div class="col-md-8">
                              <input type="password" class="form-control" name="new_password2" required>
                           </div>
                        </div>
						
                        <div class="form-group row">
                           <div class="col-md-12 text-right">
                              <button type="submit" class="btn btn-primary" name="update_pass" >
                             Update
                              </button>
                           </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
		 
      </div>
      </div>
   </body>
</html>