<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<?php
   if (isset($_POST['add_new'])) {
   	// receive all input values from the form
   	$name = mysqli_real_escape_string($db, $_POST['name']);
       $email = mysqli_real_escape_string($db, $_POST['email']);
   
       $query = "INSERT INTO myrecords (name, email)VALUES('$name', '$email')";
       mysqli_query($db, $query);
       header('location: index.php');    
   }
   if (isset($_GET['delete'])) {
    mysqli_query($db, "delete from myrecords where id=".$_GET['delete']);
    header('location: index.php'); 
   }


if(isset($_GET['export']))
{
      $sql="Select * from mytable where media_source='$username' and date between '$sdate' and '$edate' order by id desc ";
      $result = $db->query($sql);
      if (!$result) die('Couldn\'t fetch records');
      $num_fields = mysqli_num_fields($result);
      $headers = array();
     while ($fieldinfo = mysqli_fetch_field($result)) {
    $headers[] = $fieldinfo->name;
}
      $fp = fopen('php://output', 'w');
      if ($fp && $result) {
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="export_data.csv"');
      header('Pragma: no-cache');
      header('Expires: 0');
      fputcsv($fp, $headers);
      while ($row = $result->fetch_array(MYSQLI_NUM)) {
         fputcsv($fp, array_values($row));
      }
      die;
      }
}

?>

<?php 
   $per_page = 25;
   $cur_page=isset($_GET['page'])?$_GET['page']:'1';
   
   $result = $db->query("select * from myrecords");
   $total_records=$result->num_rows;
   $total_pages=ceil($total_records / $per_page);
   
   $pagination_start=($cur_page-2)>=1?$cur_page-2:1;
   $pagination_end=($cur_page+2)<$total_pages?$cur_page+2:$total_pages;

   $offset=($cur_page-1)* $per_page;
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
         <div class="row">
            <div class="col-md-4 col-md-offset-4">
               <div class="card">
                  <div class="card-header">Add New Records</div>
                  <div class="card-body">
                     <form action="" method="post">
                        <div class="form-group row">
                           <label for="name" class="col-md-3 col-form-label text-right">Name</label>
                           <div class="col-md-9">
                              <input type="text" id="name" class="form-control" name="name" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="password" class="col-md-3 col-form-label text-right">Email</label>
                           <div class="col-md-9">
                              <input type="email" id="email" class="form-control" name="email" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12 text-right">
                              <button type="submit" class="btn btn-primary" name="add_new" >
                              Add New Records
                              </button>
                           </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
         <br />
         <div class="row">
            <div class="col-md-12 col-md-offset-0">
               <div class="panel panel-default panel-table">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col col-xs-6">
                           <h3 class="panel-title">Exisiting <?=$total_records;?> Records</h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a  href="?export=1&sdate=<?=$sdate;?>&edate=<?=$edate;?>" class="btn btn-sm btn-success btn-create">Download</a>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body">
                     <table class="table table-striped table-bordered table-list">
                        <thead>
                           <tr>
                              <th class="hidden-xs">ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $count=1;
                              $sel_query="Select * from myrecords order by id desc limit $offset,$per_page";
                              $result = mysqli_query($db,$sel_query);
                              while($row = mysqli_fetch_assoc($result)) { ?>
                           <tr>
                              <td class="hidden-xs"><?=$row["id"];?></td>
                              <td><?=$row["name"];?></td>
                              <td><?=$row["email"];?></td>
                              <td class="text-right"><a href="?edit=<?=$row["id"];?>"><i class="fa fa-pencil"></i></a> &nbsp; <a onclick="confirm('Are you sure?')" href="?delete=<?=$row["id"];?>"> <i class="fa fa-trash"></i></a></td>
                           </tr>
                           <?php $count++; } ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="panel-footer">
                     <div class="row">
                        <div class="col col-xs-4">Page <?=$cur_page;?> of <?=$total_pages;?>
                        </div>
                        <div class="col col-xs-8">
                           <ul class="pagination hidden-xs pull-right">
                              <li><a href="?page=<?php echo $cur_page!='1'?$cur_page-1:$cur_page; ?>">«</a></li>
                              <?php 
                                 for ($i = $pagination_start; $i <= $pagination_end; $i++)
                                 {
                                 
                                 ?>
                              <li><a href="?page=<?=$i?>"><?=$i?></a></li>
                              <?php }
                                 ?>
                              <li><a href="?page=<?php echo $cur_page==$total_pages?$cur_page:$cur_page+1; ?>">»</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </body>
</html>
