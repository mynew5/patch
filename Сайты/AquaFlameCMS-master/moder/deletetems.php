<?php
include("../configs.php");

	mysql_select_db($server_adb);
	$check_query = mysql_query("SELECT account.id,gmlevel from account  inner join account_access on account.id = account_access.id where username = '".strtoupper($_SESSION['username'])."'") or die(mysql_error());
    $login = mysql_fetch_assoc($check_query);
	if($login['gmlevel'] < 3)
	{
		die('
<meta http-equiv="refresh" content="2;url=GTFO.php"/>
		');
	}
  
  if (isset($_POST['delete'])){
    mysql_select_db($server_db);
    $delete_new = mysql_query("DELETE FROM forum_threads WHERE id = '".$_POST['id']."'");
    if ($delete_new == true){
      echo '<div class="alert-page" align="center"> ��������� ���� �������!</div>';
      echo '<meta http-equiv="refresh" content="3;url=dashboard.php"/>';
    }
    else{
      echo '<div class="errors" align="center"><font color="red"> ������!��������� �� ���� �������!!</font></div>';
    }
  }
?>      

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
		<title>AquaFlame CMS Admin Panel</title>
		<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/tooltip.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
		<script type="text/javascript" src="js/script-carasoul.js"></script>
		<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/uniform.defaultstyle3.css" type="text/css" media="screen" />
    <script src="js/jquery-1.4.4.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
 $(document).ready(function(){
     $('.ddm').hover(
	   function(){
		 $('.ddl').slideDown();
	   },
	   function(){
		 $('.ddl').slideUp();
	   }
	 );
 });
</script>
    <script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
    <script type="text/javascript">
DD_roundies.addRule('#tabsPanel', '5px 5px 5px 5px', true);

</script>
    <script type="text/javascript" src="js/script-carasoul.js"></script>
    <script src="js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, select, button").uniform();
      });
    </script>
    <link rel="stylesheet" href="css/uniform.defaultstyle2.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/jquery.cleditor.css" />
    <script type="text/javascript" src="js/jquery.cleditor.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#input").cleditor(
			{
				width:        900, // width not including margins, borders or padding
                height:       250, // height not including margins, borders or padding
			}
							 );
      });
</script>
</head>
<body class="bgc">
	<div id="admin">
    <div id="wrap">
      <div id="head">
        <?php include('header.php'); ?>
      </div>
    <!--Content Start-->
    <div id="content">
      <div class="forms">
        <div class="heading">
          <h2>�������� �������</h2>

        </div>
        <?php
          if (isset($_GET['id'])){
            mysql_select_db($server_db);
            $new = mysql_fetch_assoc(mysql_query("SELECT id,forumid,author,replies,views,date,content,locked,has_blizz,prefix,last_date,edited,editedby FROM forum_threads WHERE id = '".$_GET['id']."'"));
            if (!$new['id']){
              $error = true;
            }
          }else{
            $error = true;
          }
          if (!$error) {
          echo'
        <form method="post" action="" class="styleForm">
        <table>
          <tr>
            <td rowspan="4" style="vertical-align:middle;">
              <p align="center"><strong>�� ������������� ������ ������� ��� �������?</strong></p>
              <input type="hidden" name="id" value="'.$new['id'].'" />
              <p align="center"><button type="submit" name="delete" onclick="Form.submit(this)"><span>�������</span></button>
              <a href="dashboard.php"><button name="reset" type="reset" value="Cancel"><span>��������</span></button></a></p>
            </td>
          </tr>

        </table>
        </form></div>';
          }elseif ($delete_new == false){ //just show error if we have not deleted am article
            echo '</div><div class="messages"><div><img src="images/warningIco.png" alt="" />
            <p>You have to select an article!</p>
            </div></div>
            <meta http-equiv="refresh" content="2;url=dashboard.php"/>';
          }
          ?>
    </div>
  </div>
  <div class="push"></div>
</div>
<?php include("footer.php"); ?>
</body>