<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include "include/connect.php";
include_once "include/ak_php_img_lib_1.0.php";

$name=$_POST['pname'];
$pyear=$_POST['pyear'];
$cname=$_POST['cname'];
$clgname=$_POST['clgname'];
$fname=$_FILES['pic']['name'];
$len=count($name);
//print_r($fname);
if(isset($_POST['submit']))
{
if(is_array($name))
{
		for($i=0;$i<($len);$i++)
		{
			$validextensions = array("jpeg", "jpg", "png","gif");
			$ext = explode('.', basename($fname[$i]));
			$file_extension = end($ext);
			$fname[$i] =  uniqid().".". $ext[count($ext) - 1];
			//echo $fname[$i]."<br>";
			
			if (($_FILES["pic"]["size"][$i]<(2*1024*1024)) && in_array($file_extension, $validextensions))
			{
				if(!file_exists('upload/'.($fname[$i])))
				{
					if (move_uploaded_file($_FILES['pic']['tmp_name'][$i],'upload/'.$fname[$i]))
					{
						//$msgup="Image uploaded successfully..!<br>";
					}
					else
					{
						$msgup="Image Not uploaded successfully..!<br>";
					}
				}
				else
				{
					$msgup="Please select another image,this image already exists..!<br>";
				}
			}
			else
			{
				$msgup="Image size should be less than 2mb..!<br>";
			}
			
			$target_file = "upload/".$fname[$i]."";
			$resized_file = "upload/resized_".$fname[$i]."";
			$wmax = 200;
			$hmax = 200;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $file_extension);
			/*if (strtolower($file_extension) != "jpg") {
    		$target_file = "upload/resized_".$fname[$i]."";
    		$new_jpg = "upload/resized_".$ext[0].".jpg";
    		ak_img_convert_to_jpg($target_file, $new_jpg, $file_extension);
			}*/

			
			$sql="INSERT INTO placement (p_id,name,comp_name,clg_name,image,pyear) VALUES (NULL,'".$name[$i]."','".$cname[$i]."','".$clgname[$i]."','".$fname[$i]."',".$pyear[$i].")";
			
			if(mysqli_query($dbcon,$sql) or die("Table connection Failed".mysqli_error($dbcon)))
			{
				//header("location:PlacementInfoTable.php");
				
				$msg="Form Submitted";
			}
			else
			{
				$msg="Form Submition Error";
			}
		
		}
}
}

?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>placement form | accesscad Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!--jQuery Date Picker-->
    <!-- <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>-->
    <!-- jQuery dialog related-->
    <!--<script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>-->
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <!--<script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>-->
    <script src="js/setup.js" type="text/javascript"></script>
<!-- function for repeat form-->   
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>        
<script type="text/javascript">
$(function() {
var limit = 6; 
var addDiv = $('#addinput');
var i = $('#addinput .remove').size() + 1;
$('#addNew').live('click', function(){
	if(i == limit)
	{
		//alert(i);
		alert("You have reached the limit of adding  5 inputs");
	}
	else{/*<input type="text" id="p_new" size="20" name="name[]_' + i +'" placeholder="Name" /><br><input type="text" id="cname" size="20" name="cname[]_' + i +'" placeholder="company Name" /><br>*/
$('<div class="remove"><table class="form"><tr><td class="col1"><label>Name</label></td><td class="col2"><span>Enter full name e.g. chetan yadnik</span><br/><input type="text" id="grumble' + i +'" name="pname[]" /></td></tr><tr><td class="col1"><label>College Name</label></td><td class="col2"><input type="text" id="grumble' + i +'" name="clgname[]" /></td></tr><tr><td class="col1"><label>Company Name</label></td><td class="col2"><input type="text" id="grumble' + i +'" name="cname[]" /></td></tr><tr><td class="col1"><label>Upload photo</label></td><td class="col2"><span>Image should be less than 2mb. in size</span><br/><input type="file" id="grumble'+i+'" name="pic[]" /><button class="btn-icon btn-grey" id="remNew"><span>Remove</span></button></td></tr></table></div>').appendTo(addDiv);
i++;
/*<tr><td class="col1"><label>Upload photo</label></td><td class="col2"><input type="file" id="grumble" name="pic[]_'+i+'" /><button class="btn-icon btn-grey" id="remNew"><span>Remove</span></button></td></tr>*/
	}
return false;
});

$('#remNew').live('click', function() {
if( i > 1 ) {
$(this).parents('.remove').remove();
i--;
}
return false;
});
});

</script>
</head>
<body>
    <div class="container_12">
    <?php include("include/header.php"); ?>
        <div class="clear">
        </div>
        <div class="grid_12">
            <div class="box round first fullpage">
                <h2 class="title"> Placement Form</h2>
                <div class="block ">
                <?php
				echo "<span style='color:#ff0000; font-weight:bold; text-align:center;'>{$msgup}</span><br/>";
				echo "<span style='color:#ff0000; font-weight:bold; text-align:center;'>{$msg}</span>";
				?>
                    <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    
                    <div id="addinput">
                    <div class="remove">
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <label>Placement Year</label>
                            </td>
                            <td class="col2">
                                <span>Enter Placement Year</span><br/>
                                <input type="text" id="grumble" name="pyear[]" />
                                <!--<br/><span id="emailerror" style="color:#F00; font-size:12px;"></span>-->
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Name</label>
                            </td>
                            <td class="col2">
                                <span>Enter full name e.g. chetan yadnik</span><br/>
                                <input type="text" id="grumble" name="pname[]" />
                                <!--<br/><span id="emailerror" style="color:#F00; font-size:12px;"></span>-->
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>College Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="clgname[]" />
                                <!--<br/><span id="pwderror" style="color:#F00; font-size:12px;"></span>  -->                            
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Company Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="cname[]" />
                                <!--<br/><span id="pwderror" style="color:#F00; font-size:12px;"></span>  -->                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload photo</label>
                            </td>
                            <td>
                                <span>Image should be less than 2mb. in size</span><br/>
                                <input type="file" name="pic[]" id="grumble" /><button class="btn-icon btn-grey" id="addNew"><span>ADD</span></button>
                            </td>
                        </tr>
                        </table>
                        </div>
                    </div>
                    <table class="form">
                    <tr>
                        <td class="col2"><button class="btn btn-large" type="submit" name="submit" id="submit">Save</button></td>
                        </tr>
                    </table>
                    </form>
                    </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php 
	include("include/footer.php"); 
	ob_flush();
	?>
</body>
</html>
