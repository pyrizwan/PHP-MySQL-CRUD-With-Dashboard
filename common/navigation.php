<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav">
            <li><a href="#"><strong>iPerformance</strong></a></li>
            <li><a href="index.php">Home</a></li>
    		
        </ul>
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="date" name="sdate" class="form-control" placeholder="Search">
              <input type="date" name="edate" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Filter</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">API Integration</a></li>
				 <li class="divider"></li>
                <li><a href="profile.php">Profile</a></li>
               
                <li class="divider"></li>
                <li><a href="settings.php">Settings</a></li>
                <li class="divider"></li>
                <li><a href="index.php?logout=1">Logout</a></li>
              </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
