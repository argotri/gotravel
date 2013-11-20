<?php require_once('../Connections/lokalan.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['pw'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php?gagal";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_lokalan, $lokalan);
  
  $LoginRS__query=sprintf("SELECT username, password FROM `admin` WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $lokalan) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login Gan :v</title>
</head>

<body>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<h3>Login Ke administrasi Gan :v </h3>
<table width="50%" border="0">
    <tr>
      <td>Username</td>
      <td><label for="username"></label>
      <input type="text" name="username" id="username"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="pw"></label>
      <input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Login"></td>
    </tr>
  </table>
Abis Login jangan Lupa SignOut ya gan :3
</form>
<?php if(isset($_GET['gagal'])){ ?>
<script type="text/javascript">
alert("Username atau password salah");
</script>
<?php }; ?>
</body>
</html>