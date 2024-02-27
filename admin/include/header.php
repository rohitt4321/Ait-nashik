<?php date_default_timezone_set('Asia/Kolkata') ?>

<div class="grid_12 header-repeat">
  <div id="branding">
    <div class="logo">
    	<a href="index.php"><img src="../img/ait-logo.png" height="40" /></a>
    </div>
    <div class="floatright">
      <div class="floatleft marginleft10">
        <ul class="inline-ul floatleft">
          <li><strong>Hello <?php echo $_SESSION['firstname']."&nbsp;".$_SESSION['lastname'] ?></strong></li>
          <li><a href="userConfig.php">Config</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <br />
        <span class="small grey">Last Login At: <?php echo date('d-m-Y h:i:s A',strtotime($_SESSION['lastlogin'])); ?></span></div>
    </div>
    <div class="clear"> </div>
  </div>
</div>
<div class="clear"> </div>
<div class="grid_12">
  <ul class="nav main">
    <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
    <li class="ic-form-style"><a href="jobInfoTable.php">Job Deatils Table</a></li>
    <li class="ic-form-style"><a href="placementInfoTable.php">Placement Table</a></li>
    <li class="ic-form-style"><a href="usertInfoTable.php">User Table</a></li>
    <li class="ic-form-style"><a href="enquiryInfoTable.php">Enquiry Table</a></li>
    <li class="ic-form-style"><a href="eventInfoTable.php">Event Table</a></li>
  </ul>
</div>
