<?php require_once('../Connections/lokalan.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kategori_wisata (nama_kategori) VALUES (%s)",
                       GetSQLValueString($_POST['nama_kategori'], "text"));

  mysql_select_db($database_lokalan, $lokalan);
  $Result1 = mysql_query($insertSQL, $lokalan) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO list_wisata (nama_wisata, id_kategori, keterangan_pariwisata, lat, `long`, url_foto) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama_wisata'], "text"),
                       GetSQLValueString($_POST['id_kategori'], "int"),
                       GetSQLValueString($_POST['keterangan_pariwisata'], "text"),
                       GetSQLValueString($_POST['lat'], "text"),
                       GetSQLValueString($_POST['long'], "text"),
                       GetSQLValueString($_POST['url_foto'], "text"));

  mysql_select_db($database_lokalan, $lokalan);
  $Result1 = mysql_query($insertSQL, $lokalan) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO kategori_tempat (nama_kategori) VALUES (%s)",
                       GetSQLValueString($_POST['nama_kategori'], "text"));

  mysql_select_db($database_lokalan, $lokalan);
  $Result1 = mysql_query($insertSQL, $lokalan) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form4")) {
  $insertSQL = sprintf("INSERT INTO list_tempat (nama_tempat, id_kategori, keterangan_tempat, lat, `long`, url_foto) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama_tempat'], "text"),
                       GetSQLValueString($_POST['id_kategori'], "int"),
                       GetSQLValueString($_POST['keterangan_tempat'], "text"),
                       GetSQLValueString($_POST['lat'], "text"),
                       GetSQLValueString($_POST['long'], "text"),
                       GetSQLValueString($_POST['url_foto'], "text"));

  mysql_select_db($database_lokalan, $lokalan);
  $Result1 = mysql_query($insertSQL, $lokalan) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form5")) {
  $updateSQL = sprintf("UPDATE versi SET cur_ver=%s",
                       GetSQLValueString($_POST['cur_ver']+1, "int"));

  mysql_select_db($database_lokalan, $lokalan);
  $Result1 = mysql_query($updateSQL, $lokalan) or die(mysql_error());
}

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_wisata = "SELECT * FROM kategori_wisata ORDER BY nama_kategori ASC";
$kategori_wisata = mysql_query($query_kategori_wisata, $lokalan) or die(mysql_error());
$row_kategori_wisata = mysql_fetch_assoc($kategori_wisata);
$totalRows_kategori_wisata = mysql_num_rows($kategori_wisata);

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_wisata_opsi = "SELECT * FROM kategori_wisata";
$kategori_wisata_opsi = mysql_query($query_kategori_wisata_opsi, $lokalan) or die(mysql_error());
$row_kategori_wisata_opsi = mysql_fetch_assoc($kategori_wisata_opsi);
$totalRows_kategori_wisata_opsi = mysql_num_rows($kategori_wisata_opsi);

$maxRows_list_wisata = 20;
$pageNum_list_wisata = 0;
if (isset($_GET['pageNum_list_wisata'])) {
  $pageNum_list_wisata = $_GET['pageNum_list_wisata'];
}
$startRow_list_wisata = $pageNum_list_wisata * $maxRows_list_wisata;

mysql_select_db($database_lokalan, $lokalan);
$query_list_wisata = "SELECT kategori_wisata.id_kategori, kategori_wisata.nama_kategori, list_wisata.id_wisata, list_wisata.nama_wisata, list_wisata.id_kategori, list_wisata.keterangan_pariwisata, list_wisata.lat, list_wisata.`long`, list_wisata.url_foto FROM kategori_wisata Inner Join list_wisata ON list_wisata.id_kategori = kategori_wisata.id_kategori ";
$query_limit_list_wisata = sprintf("%s LIMIT %d, %d", $query_list_wisata, $startRow_list_wisata, $maxRows_list_wisata);
$list_wisata = mysql_query($query_limit_list_wisata, $lokalan) or die(mysql_error());
$row_list_wisata = mysql_fetch_assoc($list_wisata);

if (isset($_GET['totalRows_list_wisata'])) {
  $totalRows_list_wisata = $_GET['totalRows_list_wisata'];
} else {
  $all_list_wisata = mysql_query($query_list_wisata);
  $totalRows_list_wisata = mysql_num_rows($all_list_wisata);
}
$totalPages_list_wisata = ceil($totalRows_list_wisata/$maxRows_list_wisata)-1;

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_tempat = "SELECT * FROM kategori_tempat ORDER BY nama_kategori ASC";
$kategori_tempat = mysql_query($query_kategori_tempat, $lokalan) or die(mysql_error());
$row_kategori_tempat = mysql_fetch_assoc($kategori_tempat);
$totalRows_kategori_tempat = mysql_num_rows($kategori_tempat);

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_tempat_opsi = "SELECT * FROM kategori_tempat ORDER BY nama_kategori ASC";
$kategori_tempat_opsi = mysql_query($query_kategori_tempat_opsi, $lokalan) or die(mysql_error());
$row_kategori_tempat_opsi = mysql_fetch_assoc($kategori_tempat_opsi);
$totalRows_kategori_tempat_opsi = mysql_num_rows($kategori_tempat_opsi);

$maxRows_tempat_asyik = 20;
$pageNum_tempat_asyik = 0;
if (isset($_GET['pageNum_tempat_asyik'])) {
  $pageNum_tempat_asyik = $_GET['pageNum_tempat_asyik'];
}
$startRow_tempat_asyik = $pageNum_tempat_asyik * $maxRows_tempat_asyik;

mysql_select_db($database_lokalan, $lokalan);
$query_tempat_asyik = "SELECT list_tempat.id_tempat, list_tempat.nama_tempat, list_tempat.id_kategori, list_tempat.keterangan_tempat, list_tempat.lat, list_tempat.`long`, list_tempat.url_foto, kategori_tempat.id_kategori, kategori_tempat.nama_kategori FROM kategori_tempat Inner Join list_tempat ON list_tempat.id_kategori = kategori_tempat.id_kategori ORDER BY kategori_tempat.id_kategori ASC ";
$query_limit_tempat_asyik = sprintf("%s LIMIT %d, %d", $query_tempat_asyik, $startRow_tempat_asyik, $maxRows_tempat_asyik);
$tempat_asyik = mysql_query($query_limit_tempat_asyik, $lokalan) or die(mysql_error());
$row_tempat_asyik = mysql_fetch_assoc($tempat_asyik);

if (isset($_GET['totalRows_tempat_asyik'])) {
  $totalRows_tempat_asyik = $_GET['totalRows_tempat_asyik'];
} else {
  $all_tempat_asyik = mysql_query($query_tempat_asyik);
  $totalRows_tempat_asyik = mysql_num_rows($all_tempat_asyik);
}
$totalPages_tempat_asyik = ceil($totalRows_tempat_asyik/$maxRows_tempat_asyik)-1;

mysql_select_db($database_lokalan, $lokalan);
$query_versi = "SELECT * FROM versi ORDER BY cur_ver DESC";
$versi = mysql_query($query_versi, $lokalan) or die(mysql_error());
$row_versi = mysql_fetch_assoc($versi);
$totalRows_versi = mysql_num_rows($versi);

$queryString_list_wisata = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_wisata") == false && 
        stristr($param, "totalRows_list_wisata") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_wisata = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_wisata = sprintf("&totalRows_list_wisata=%d%s", $totalRows_list_wisata, $queryString_list_wisata);

$queryString_tempat_asyik = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_tempat_asyik") == false && 
        stristr($param, "totalRows_tempat_asyik") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_tempat_asyik = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_tempat_asyik = sprintf("&totalRows_tempat_asyik=%d%s", $totalRows_tempat_asyik, $queryString_tempat_asyik);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Administrator GoTravel</title>
</head>

<body>
<h3>Administrasi GoTravel </h3>
<small>  versi Jelek ._.a</small>
| <a href="keluar.php">Udah Bosen Klik untuk Signout</a>
<p><br>
  List Kategori Wisata</p>
<hr>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nama_kategori:</td>
      <td><input type="text" name="nama_kategori" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert Kategori Wisata"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<table border="1">
  <tr>
    <td>id_kategori</td>
    <td>Nama Kategori</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_kategori_wisata['id_kategori']; ?></td>
      <td><?php echo $row_kategori_wisata['nama_kategori']; ?></td>
    </tr>
    <?php } while ($row_kategori_wisata = mysql_fetch_assoc($kategori_wisata)); ?>
</table>
<p>Data Wisata</p>
<hr>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nama_wisata:</td>
      <td><input type="text" name="nama_wisata" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Kategori</td>
      <td><select name="id_kategori">
        <?php 
do {  
?>
        <option value="<?php echo $row_kategori_wisata_opsi['id_kategori']?>" ><?php echo $row_kategori_wisata_opsi['nama_kategori']?></option>
        <?php
} while ($row_kategori_wisata_opsi = mysql_fetch_assoc($kategori_wisata_opsi));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Keterangan_pariwisata:</td>
      <td><input type="text" name="keterangan_pariwisata" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Lat:</td>
      <td><input type="text" name="lat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Long:</td>
      <td><input type="text" name="long" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Url_foto:</td>
      <td><input type="text" name="url_foto" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert Wisata"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2">
</form>
<table border="1">
  <tr>
    <td>nama_kategori</td>
    <td>nama_wisata</td>
    <td>id_kategori</td>
    <td>keterangan_pariwisata</td>
    <td>lat</td>
    <td>long</td>
    <td>url_foto</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_list_wisata['nama_kategori']; ?></td>
      <td><?php echo $row_list_wisata['nama_wisata']; ?></td>
      <td><?php echo $row_list_wisata['id_kategori']; ?></td>
      <td><?php echo $row_list_wisata['keterangan_pariwisata']; ?></td>
      <td><?php echo $row_list_wisata['lat']; ?></td>
      <td><?php echo $row_list_wisata['long']; ?></td>
      <td><?php echo $row_list_wisata['url_foto']; ?></td>
    </tr>
    <?php } while ($row_list_wisata = mysql_fetch_assoc($list_wisata)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_list_wisata > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_list_wisata=%d%s", $currentPage, 0, $queryString_list_wisata); ?>"><img src="First.gif"></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_list_wisata > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_list_wisata=%d%s", $currentPage, max(0, $pageNum_list_wisata - 1), $queryString_list_wisata); ?>"><img src="Previous.gif"></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_list_wisata < $totalPages_list_wisata) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_list_wisata=%d%s", $currentPage, min($totalPages_list_wisata, $pageNum_list_wisata + 1), $queryString_list_wisata); ?>"><img src="Next.gif"></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_list_wisata < $totalPages_list_wisata) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_list_wisata=%d%s", $currentPage, $totalPages_list_wisata, $queryString_list_wisata); ?>"><img src="Last.gif"></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
<hr>
<p>List Kategori Tempat</p>
<form method="post" name="form3" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nama_kategori:</td>
      <td><input type="text" name="nama_kategori" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert Kategori Tempat"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form3">
</form>
<table border="1">
  <tr>
    <td>id_kategori</td>
    <td>nama_kategori</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_kategori_tempat['id_kategori']; ?></td>
      <td><?php echo $row_kategori_tempat['nama_kategori']; ?></td>
    </tr>
    <?php } while ($row_kategori_tempat = mysql_fetch_assoc($kategori_tempat)); ?>
</table>
<hr>
<p>List Tempat Asyik</p>
<form method="post" name="form4" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nama_tempat:</td>
      <td><input type="text" name="nama_tempat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Kategori</td>
      <td><select name="id_kategori">
        <?php 
do {  
?>
        <option value="<?php echo $row_kategori_tempat_opsi['id_kategori']?>" ><?php echo $row_kategori_tempat_opsi['nama_kategori']?></option>
        <?php
} while ($row_kategori_tempat_opsi = mysql_fetch_assoc($kategori_tempat_opsi));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Keterangan_tempat:</td>
      <td><input type="text" name="keterangan_tempat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Lat:</td>
      <td><input type="text" name="lat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Long:</td>
      <td><input type="text" name="long" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Url_foto:</td>
      <td><input type="text" name="url_foto" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form4">
</form>
<table border="1">
  <tr>
    <td>nama_tempat</td>
    <td>keterangan_tempat</td>
    <td>lat</td>
    <td>long</td>
    <td>url_foto</td>
    <td>nama_kategori</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_tempat_asyik['nama_tempat']; ?></td>
      <td><?php echo $row_tempat_asyik['keterangan_tempat']; ?></td>
      <td><?php echo $row_tempat_asyik['lat']; ?></td>
      <td><?php echo $row_tempat_asyik['long']; ?></td>
      <td><?php echo $row_tempat_asyik['url_foto']; ?></td>
      <td><?php echo $row_tempat_asyik['nama_kategori']; ?></td>
    </tr>
    <?php } while ($row_tempat_asyik = mysql_fetch_assoc($tempat_asyik)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_tempat_asyik > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_tempat_asyik=%d%s", $currentPage, 0, $queryString_tempat_asyik); ?>"><img src="First.gif"></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_tempat_asyik > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_tempat_asyik=%d%s", $currentPage, max(0, $pageNum_tempat_asyik - 1), $queryString_tempat_asyik); ?>"><img src="Previous.gif"></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_tempat_asyik < $totalPages_tempat_asyik) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_tempat_asyik=%d%s", $currentPage, min($totalPages_tempat_asyik, $pageNum_tempat_asyik + 1), $queryString_tempat_asyik); ?>"><img src="Next.gif"></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_tempat_asyik < $totalPages_tempat_asyik) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_tempat_asyik=%d%s", $currentPage, $totalPages_tempat_asyik, $queryString_tempat_asyik); ?>"><img src="Last.gif"></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
<hr>
<p>Update Versi<br>
</p>
<p>Versi Sekarang :  <?php echo $row_versi['cur_ver']; ?></p>
<form method="post" name="form5" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update Versi"></td>
    </tr>
  </table>
  <input type="hidden" name="cur_ver" value="<?php echo $row_versi['cur_ver']; ?>">
  <input type="hidden" name="MM_update" value="form5">
  <input type="hidden" name="cur_ver" value="<?php echo $row_versi['cur_ver']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kategori_wisata);

mysql_free_result($kategori_wisata_opsi);

mysql_free_result($list_wisata);

mysql_free_result($kategori_tempat);

mysql_free_result($kategori_tempat_opsi);

mysql_free_result($tempat_asyik);

mysql_free_result($versi);
?>
