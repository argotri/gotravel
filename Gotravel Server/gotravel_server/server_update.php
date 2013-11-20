<?php require_once('Connections/lokalan.php'); ?>
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

mysql_select_db($database_lokalan, $lokalan);
$query_cek_versi = "SELECT * FROM versi ORDER BY cur_ver DESC";
$cek_versi = mysql_query($query_cek_versi, $lokalan) or die(mysql_error());
$row_cek_versi = mysql_fetch_assoc($cek_versi);
$totalRows_cek_versi = mysql_num_rows($cek_versi);

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_wisata = "SELECT * FROM kategori_wisata ORDER BY id_kategori ASC";
$kategori_wisata = mysql_query($query_kategori_wisata, $lokalan) or die(mysql_error());
$row_kategori_wisata = mysql_fetch_assoc($kategori_wisata);
$totalRows_kategori_wisata = mysql_num_rows($kategori_wisata);

mysql_select_db($database_lokalan, $lokalan);
$query_kategori_tempat = "SELECT * FROM kategori_tempat ORDER BY id_kategori ASC";
$kategori_tempat = mysql_query($query_kategori_tempat, $lokalan) or die(mysql_error());
$row_kategori_tempat = mysql_fetch_assoc($kategori_tempat);
$totalRows_kategori_tempat = mysql_num_rows($kategori_tempat);

mysql_select_db($database_lokalan, $lokalan);
$query_list_wisata = "SELECT * FROM list_wisata ORDER BY id_wisata ASC";
$list_wisata = mysql_query($query_list_wisata, $lokalan) or die(mysql_error());
$row_list_wisata = mysql_fetch_assoc($list_wisata);
$totalRows_list_wisata = mysql_num_rows($list_wisata);

mysql_select_db($database_lokalan, $lokalan);
$query_list_tempat = "SELECT * FROM list_tempat ORDER BY id_tempat ASC";
$list_tempat = mysql_query($query_list_tempat, $lokalan) or die(mysql_error());
$row_list_tempat = mysql_fetch_assoc($list_tempat);
$totalRows_list_tempat = mysql_num_rows($list_tempat);
?>
<?php if($_GET['versi']<$row_cek_versi['cur_ver']){ ?>
<data>
<versi_update>
	        <versi><?php echo $row_cek_versi['cur_ver']; ?></versi>
        </versi_update>
        <?php if ($totalRows_kategori_wisata > 0) { // Show if recordset not empty ?>        
		<?php
            //digunakan untuk update kategori wisata
             do { ?>
<data_kategori_wisata>
          <idkwisata<?php echo $row_kategori_wisata['id_kategori']; ?></idkwisata>
          <nkwisata><?php echo $row_kategori_wisata['nama_kategori']; ?></nkwisata>
        </data_kategori_wisata>
        <?php } while ($row_kategori_wisata = mysql_fetch_assoc($kategori_wisata)); 
              //end kategori wisata
		};//end show if recordset not empty
              ?>
        <?php if ($totalRows_kategori_tempat > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <data_kategori_tempat>
      <idkwisata><?php echo $row_kategori_tempat['id_kategori']; ?></idkwisata>
      <nkwisata><?php echo $row_kategori_tempat['nama_kategori']; ?></nkwisata>
      </data_kategori_tempat>
    <?php } while ($row_kategori_tempat = mysql_fetch_assoc($kategori_tempat)); ?>
        <?php } // Show if recordset not empty ?>
        
        <?php if ($totalRows_list_wisata > 0) { // Show if recordset not empty ?>
          <?php do { ?>
            <data_wisata>
              <nama_wisata><?php echo $row_list_wisata['nama_wisata']; ?></nama_wisata>
              <id_kategori><?php echo $row_list_wisata['id_kategori']; ?></id_kategori>
              <keterangan_pariwisata><?php echo $row_list_wisata['keterangan_pariwisata']; ?></keterangan_pariwisata>
              <lat><?php echo $row_list_wisata['lat']; ?></lat>
              <long><?php echo $row_list_wisata['long']; ?></long>
              <url_foto><?php echo $row_list_wisata['url_foto']; ?></url_foto>
            </data_wisata>
            <?php } while ($row_list_wisata = mysql_fetch_assoc($list_wisata)); ?>
          <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_list_tempat > 0) { // Show if recordset not empty ?>
            <?php do { ?>
              <data_tempat>
                <nama_tempat><?php echo $row_list_tempat['nama_tempat']; ?></nama_tempat>
                <id_kategori><?php echo $row_list_tempat['id_kategori']; ?></id_kategori>
                <keterangan_tempat><?php echo $row_list_tempat['keterangan_tempat']; ?></keterangan_tempat>
                <lat><?php echo $row_list_tempat['lat']; ?></lat>
                <long><?php echo $row_list_tempat['long']; ?></long>
                <url_foto><?php echo $row_list_tempat['url_foto']; ?></url_foto>
              </data_tempat>
              <?php } while ($row_list_tempat = mysql_fetch_assoc($list_tempat)); ?>
            <?php } // Show if recordset not empty ?>
</data>
<?php }; //end cek Versi ?>
<?php
mysql_free_result($cek_versi);

mysql_free_result($kategori_wisata);

mysql_free_result($kategori_tempat);

mysql_free_result($list_wisata);

mysql_free_result($list_tempat);
?>
