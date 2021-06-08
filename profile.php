<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<?php

$username=$_SESSION['username'];    
$query = "SELECT * FROM tbl_affiliates WHERE username='$username'";
$results = mysqli_query($db, $query);
$record=$results->fetch_object();
   
   
   ?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <?php include('common/head.php') ?>
	   <link type="text/css" href="x-edible/bootstrap-editable.css" rel="stylesheet">
   </head>
   <body>
      <?php include('common/navigation.php') ?>
      <div class="container">
        <br />
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
			
			 <?=$msg;?>
			
			
               <div class="card">
                  <div class="card-header">Profile</div>
                  <div class="card-body">
                     
					 
					 
                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-right">Company</label>
							<span><a href="#" id="name" data-type="text" data-pk="3" data-placement="right" data-url="update.php"  data-placeholder="Required" data-title=""><?=$record->name;?></a></span>
                        </div>
						
						 <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-right">Username</label>
							<span><?=$record->username;?></span>
                        </div>
						
						 <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-right">Email</label>
							<span><?=$record->email;?></span>
                        </div>
						
                      
					
                  </div>
                 
               </div>
            </div>
         </div>
		 
      </div>
      </div>
	   <script type="text/javascript">
         $(document).ready(function() {
           //toggle `popup` / `inline` mode
           $.fn.editable.defaults.mode = 'inline';    
           $.fn.editable.defaults.ajaxOptions = {type: "GET"};
         
           $('#dob').editable({
              datepicker: {
                  todayBtn: 'linked'
              }
          });  
         
         $('#gender').editable({
               type: 'select',
               title: 'Select Gender',
               placement: 'right',
               value: 'Male',
               source: [
               {value: 'Male', text: 'Male'},
               {value: 'Female', text: 'Female'}
               ]
           });
         
         $('#name').editable();
        
        
         });
      </script>		
      <script src="x-edible/bootstrap-editable.min.js"></script>
      <script src="x-edible/xeditable.js"></script>
   </body>
</html>
