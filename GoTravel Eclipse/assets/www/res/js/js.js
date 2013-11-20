var watchID=null;
var peta_pariwisata=null;
//var alamat_server = "http://localhost/kuliah/gotravel_server/"
//var alamat_server = "http://192.168.137.1/kuliah/gotravel_server/"
var alamat_server = "http://lovinatravel.com/gosoft/";


function cek_versi(){
		if(online){
			$("#online_offline").html("online");
		}else{
			$("#online_offline").html("offline");
		}
		var versi = null;
    console.debug('Mengecek Versi . . . .');
	initDatabase();
	var sql_cekversi = "select count(*) as jumlah from versi";
	var sql_ambil_versi = "select cur_ver from versi ORDER BY cur_ver DESC";
	db.transaction(
		function (transaction) { 
		//transaksi untuk pertama kali dijalankan
			transaction.executeSql(sql_cekversi, [], function(transaction, results){
				if(results.rows.item(0).jumlah ==0){
					console.debug('Program Pertama kali dijalankan Mencoba Update...');
					$("#versi").html('0');
					if(online){
						console.debug('Anda Online , Program akan mencoba Mengecek Update');
						update_versi(versi);
					}else{
						alert("Program Pertama kali Dijalankan, \nProgram membutuhkan Koneksi untuk Mengunduh data , dan anda Sedang Offline , \nSilahkan Menyalakan Koneksi anda dan Memulai Aplikasi ini kembali.");
						navigator.app.exitApp();
						navigator.device.exitApp();
					}
				}else{
					//transaksi untuk mengecek versi
					transaction.executeSql(sql_ambil_versi, [], function(transaction, results){
							$("#versi").html(results.rows.item(0).cur_ver);
							update_versi(results.rows.item(0).cur_ver);
					}, handleErrors);
				}
			}, handleErrors);
			//end pertama jalan
		}
	);
}
function update_versi(versi){
	if(versi==null){
		versi = 0;
	}
	var j = 0;
	$.ajax({
		type: 'GET',
		crossDomain :true,
		url: alamat_server+'server_update.php?versi='+versi,
		success: function (xml) {
			$('versi_update',xml).each(function(i) {
				j++;				
			});
		console.debug('Data Berjumlah '+j);
		//start update database
			if(j>0){
				run_sql("DELETE FROM kategori_tempat ");
				run_sql("DELETE FROM kategori_wisata");
				run_sql("DELETE FROM list_wisata");
				run_sql("DELETE FROM list_tempat");
				initDatabase();
				//untuk kategori
				$('data_kategori_wisata',xml).each(function(i) {
						insertKategori($(this).find('idkwisata').text() , $(this).find('nkwisata').text());
				});
				$('data_kategori_tempat',xml).each(function(i) {
					insertTempatKategori($(this).find('idkwisata').text() , $(this).find('nkwisata').text()) 
				});
				$('data_wisata',xml).each(function(i) {
					insertWisata($(this).find('nama_wisata').text(),parseInt($(this).find('id_kategori').text()),$(this).find('keterangan_pariwisata').text(),$(this).find('lat').text(),$(this).find('long').text(),$(this).find('url_foto').text());
				});
				$('data_tempat',xml).each(function(i) {
				insertTempat($(this).find('nama_tempat').text(),parseInt($(this).find('id_kategori').text()),$(this).find('keterangan_tempat').text(),$(this).find('lat').text(),$(this).find('long').text(),$(this).find('url_foto').text());
				});
			}
			
			$('versi_update',xml).each(function(i) {
				if( $(this).find('versi').text() > 0){
					run_sql("DELETE FROM versi");
					run_sql("insert into versi values (" + parseInt($(this).find('versi').text()) +")");
					$("#versi").html($(this).find('versi').text());
				}
			});
		//end untuk update database
		},
		error: function (xhr, status, error) {
			alert("Aplikasi ini membutuhkan Koneksi untuk Mengambil data , silahkan Nyalakan Data anda dan Restart Aplikasi");
		}
	}); //end ajax
	
}


function loading(){
	$("#load").html("<img src='jquery-mobile/images/ajax-loader.gif'>");
}
function end_loading(){
	$("#load").hide();
}
function GetQueryStringParams(sParam){
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++) 
	{
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) 
		{
			return sParameterName[1];
		}
	}
}

function map_with_marker(id_render , lat , long , keterangan_marker){
			console.debug('Eksekusi Map dengan marker');
			$(id_render).gmap().bind('init', function(ev, map) {
				$(id_render).gmap(
				'addMarker', 
				{'position': new google.maps.LatLng(lat, long), 
				'bounds': true}).click(function() {
					$(id_render).gmap('openInfoWindow', 
					{'content': keterangan_marker}, this
					);
				});
			});
			//end map
}

function get_direction(id_render,id_loading , lat_or , long_or , lat_des , long_des){
	
	
}

var map,currentPosition,directionsDisplay, directionsService;
var destinationLatitude;
var destinationLongitude;
var id_loadingg , id_render;
function pantau_direction(id_rende , id_loading , lat_des , long_des){
		
			destinationLongitude = long_des;
			destinationLatitude = lat_des;
			id_loadingg = id_loading;
			id_render = id_rende;
			$(id_loading).html("<img src='jquery-mobile/images/ajax-loader.gif' >Menunggu Posisi anda......");
			var option = { maximumAge: 60000 , enableHighAccuracy: true };
			navigator.geolocation.watchPosition(locSuccess, locError , option);
}//end pantau_direction

function calculateRoute() {

	var targetDestination =  new google.maps.LatLng(destinationLatitude, destinationLongitude);
	if (currentPosition != '' && targetDestination != '') {

		var request = {
			origin: currentPosition, 
			destination: targetDestination,
			travelMode: google.maps.DirectionsTravelMode["DRIVING"]
		};

		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setPanel(document.getElementById("directions"));
				directionsDisplay.setDirections(response); 
				/*
					var myRoute = response.routes[0].legs[0];
					for (var i = 0; i < myRoute.steps.length; i++) {
						alert(myRoute.steps[i].instructions);
					}
				*/
				$("#results").show();
			}
			else {
				$("#results").hide();
			}
		});
	}
	else {
		$("#results").hide();
	}
}
////////////// End Calculate
			
function initializeMapAndCalculateRoute(lat, lon)
            {
                directionsDisplay = new google.maps.DirectionsRenderer(); 
                directionsService = new google.maps.DirectionsService();
				
                currentPosition = new google.maps.LatLng(lat, lon);

                map = new google.maps.Map(document.getElementById(id_render), {
                   zoom: 15,
                   center: currentPosition,
                   mapTypeId: google.maps.MapTypeId.ROADMAP
                 });

                directionsDisplay.setMap(map);

                 var currentPositionMarker = new google.maps.Marker({
                    position: currentPosition,
                    map: map,
                    title: "Current position"
                });

                // current position marker info
                /*
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(currentPositionMarker, 'click', function() {
                    infowindow.setContent("Current position: latitude: " + lat +" longitude: " + lon);
                    infowindow.open(map, currentPositionMarker);
                });
                */

                // calculate Route
                calculateRoute();
}
///end initializeMapAndCalculateRoute
			
 function locError(error) {
               // the current position could not be located
			   alert("Posisi Anda Tidak dapat ditemukan");
 }

function locSuccess(position) {
                // initialize map with current position and calculate the route
				$(id_loadingg).html("Posisi Ditemukan " + position.coords.latitude +","+position.coords.longitude);
                initializeMapAndCalculateRoute(position.coords.latitude, position.coords.longitude);
				$(id_loadingg).hide(2000);
}
			
			
			
/////////////////////////////////// END GEO LOCATIOn By ARGO TRIWIDODOOOOOOO ////////////////////////////

function get_picture(){
	navigator.camera.getPicture(onPhotoDataSuccess, onFail, { quality: 100,
    destinationType: destinationType.DATA_URL, saveToPhotoAlbum: true });
	
}
function onPhotoDataSuccess(imageDataa){
      var smallImage = document.getElementById('image');
 
      // Unhide image elements
      //
      smallImage.style.display = 'block';
 
      // Show the captured photo
      // The inline CSS rules are used to resize the image
      //
      smallImage.src =  imageDataa;
	  $("#save").show();
}
function onFail(message){
	alert("Gambar Gagal diambil "+message);
	$("#save").hide();
}

function save_picture(){
	window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFS, fail);
}
    function gotFS(fileSystem) {
		var tanggal = new Date();
		var nama_file = "gambar_"+tanggal.getDate()+tanggal.getMonth()+tanggal.getFullYear()+tanggal.getHours()+tanggal.getMinutes()+tanggal.getSeconds()+".jpg";
        fileSystem.root.getFile(nama_file, {create: true, exclusive: false}, gotFileEntry, fail);
    }

    function gotFileEntry(fileEntry) {
        fileEntry.createWriter(gotFileWriter, fail);
    }

    function gotFileWriter(writer) {
        var photo = document.getElementById("image");
        writer.write(photo.value);
		$("#save").hide();
		$("#image").hide();
		alert("Gambar Berhasi; Disimpan");
    }

    function fail(error) {
        console.log(error.message);
    }
////////////////////////////////////////////////////////////////////////
////////// SQL LITE Library By Argo Triwidodo
////////////////////////////////////////////////////////////////////////

function initDatabase() {
    console.debug('called initDatabase()');

    try {
        if (!window.openDatabase) {
            alert('not supported');
        } else {
            var shortName = 'MojokertoDB';
            var version = '1.0';
            var displayName = 'DataBase Mojokerto';
            var maxSizeInBytes = 65536;
            db = openDatabase(shortName, version, displayName, maxSizeInBytes);
            createTableIfNotExists();
        }
    } catch(e) {
        if (e == 2) {
            alert('Invalid database version');
        } else {
            alert('Unknown error ' + e);
        }
        return;
    }
}


function createTableIfNotExists() {
    console.debug('called createTableIfNotExists()');
	
    var sql1 = "CREATE TABLE IF NOT EXISTS [kategori_wisata] ([id_kategori] INTEGER  NOT NULL PRIMARY KEY ,[nama_kategori] VARCHAR(30)  NULL)";
	
    var sql2 = "CREATE TABLE IF NOT EXISTS  [list_wisata] ( \
				[id_wisata] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,\
				[nama_wisata] VARCHAR(30)  NOT NULL,\
				[id_kategori] INTEGER  NULL,\
				[keterangan_pariwisata] TEXT  NULL,\
				[lat] VARCHAR(30)  NULL,\
				[long] VARCHAR(30)  NULL,\
				[url_foto] VARCHAR(200)  NULL\
		)";
    var sql3 = "CREATE TABLE IF NOT EXISTS [kategori_tempat] ([id_kategori] INTEGER  NOT NULL PRIMARY KEY ,[nama_kategori] VARCHAR(30)  NULL)";
	
    var sql4 = "CREATE TABLE IF NOT EXISTS  [list_tempat] ( \
				[id_tempat] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,\
				[nama_tempat] VARCHAR(30)  NOT NULL,\
				[id_kategori] INTEGER  NULL,\
				[keterangan_tempat] TEXT  NULL,\
				[lat] VARCHAR(30)  NULL,\
				[long] VARCHAR(30)  NULL,\
				[url_foto] VARCHAR(200)  NULL\
		)";
    var sql5 = "CREATE TABLE IF NOT EXISTS [versi] ([cur_ver] INTEGER )";
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql1, [], nullEvent, handleErrors);
			transaction.executeSql(sql2, [], nullEvent, handleErrors);
			transaction.executeSql(sql3, [], nullEvent, handleErrors);
			transaction.executeSql(sql4, [], nullEvent, handleErrors);
			transaction.executeSql(sql5, [], nullEvent, handleErrors);
        }
    );
}

/////kategori Wisata
function insertKategori(id_kategori , nama_kategori) {
	initDatabase();
    console.debug('called insert Kategori Wisata()');
    var sql = 'INSERT INTO kategori_wisata(id_kategori , nama_kategori) VALUES (? , ?)';
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql, [parseInt(id_kategori) , nama_kategori], nullEvent,handleErrors);
            console.debug('executeSql: ' + sql);
        }
    );
}
///Tempat Kategori
function insertTempatKategori(id_kategori , nama_kategori) {
	initDatabase();
    console.debug('called insert Kategori Tempat()');
    var sql = 'INSERT INTO kategori_tempat(id_kategori , nama_kategori) VALUES (? , ?)';
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql, [parseInt(id_kategori) , nama_kategori], nullEvent,handleErrors);
            console.debug('executeSql: ' + sql);
        }
    );
}
////////////////////////////////Bukan List Tempat !!!!!!!!
function insertWisata(nama_wisata , id_kategori , keterangan_pariwisata , lat , long , url_foto) {
	initDatabase();
    console.debug('called insertRecord()');
	
    var sql = 'INSERT INTO list_wisata(nama_wisata , id_kategori , keterangan_pariwisata , lat , long , url_foto ) VALUES (? , ? , ? , ? , ? , ?)';
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql, [nama_wisata , id_kategori , keterangan_pariwisata , lat , long , url_foto], nullEvent,handleErrors);
            console.debug('executeSql: ' + sql);
        }
    );
}
////////////////////////////////Yang ini yang list Tempat !!!!!!!!
function insertTempat(nama_tempat , id_kategori , keterangan_pariwisata , lat , long , url_foto) {
	initDatabase();
    console.debug('called insertRecord()');
    var sql = 'INSERT INTO list_tempat(nama_tempat , id_kategori , keterangan_tempat, lat , long , url_foto ) VALUES (? , ? , ? , ? , ? , ?)';
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql, [nama_tempat , id_kategori , keterangan_pariwisata , lat , long , url_foto], nullEvent,handleErrors);
            console.debug('executeSql: ' + sql);
        }
    );
}

//Start kategori wisata

function showKategori() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "SELECT * FROM kategori_wisata";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [], renderKategori, handleErrors);
					}
				);
}

function renderKategori(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
					for (var i = 0, item = null; i < dataset.length; i++) {
						item_view = dataset.item(i);
						$("#kategori_view").append('<li data-theme="c"><a href="info_pariwisata_detail.html?id_kategori='+item_view['id_kategori']+'" data-transition="slide">'+item_view['nama_kategori']+'</a></li>');
					}
					$("#kategori_view").listview("refresh");
				}
}
//end kategori

//Start list wisata
function showListWisata() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "select * from list_wisata WHERE id_kategori = ? ";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [GetQueryStringParams('id_kategori')], renderListWisata, handleErrors);
					}
				);
}

function renderListWisata(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
					for (var i = 0, item = null; i < dataset.length; i++) {
						item_view = dataset.item(i);
						$("#wisata_view").append('<li data-theme="c"><a href="pariwisata_detail.html?id_wisata='+item_view['id_wisata']+'" data-transition="slide">'+item_view['nama_wisata']+'</a></li>');
					}
					$("#wisata_view").listview('refresh');
				}
}
//end list wisata

//Start wisata Detail

function showWisataDetail() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "select * from list_wisata WHERE id_wisata = ? ";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [GetQueryStringParams('id_wisata')], renderWisataDetail, handleErrors);
					}
				);
}

function renderWisataDetail(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
				item_view = dataset.item(0);
				$("#nama_pariwisata").html(item_view['nama_wisata']);
				$("#info_pariwisata").append(item_view['keterangan_pariwisata']);
				$("#lat").append(item_view['lat']);
				$("#long").append(item_view['long']);
			if(online){
				$("#foto_pariwisata").attr('src',item_view['url_foto']);
				$("#foto_pariwisata").attr('width',300);
			}
				$("#foto_pariwisata").attr('alt',item_view['nama_wisata']);

				
				$('#p').gmap('addMarker', {'position': item_view['lat']+','+item_view['long'], 'bounds': true}).click(function() {
					$('#p').gmap('openInfoWindow', {'content':item_view['nama_wisata']}, this);
				});
			
				}
}
//end wisata
//////////////////////////////////////////End Untuk Wisata

//Start kategori Tempat

function showKategoriTempat() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "SELECT * FROM kategori_tempat";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [], renderKategoriTempat, handleErrors);
					}
				);
}

function renderKategoriTempat(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
					for (var i = 0, item = null; i < dataset.length; i++) {
						item_view = dataset.item(i);
						$("#kategori_view").append('<li data-theme="c"><a href="info_tempat_detail.html?id_kategori='+item_view['id_kategori']+'" data-transition="slide">'+item_view['nama_kategori']+'</a></li>');
					}
					$("#kategori_view").listview("refresh");
				}
}
//end kategori Tempat

/////////////////////////Start List Tempat
function showListTempat() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "select * from list_tempat WHERE id_kategori = ? ";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [GetQueryStringParams('id_kategori')], renderListTempat, handleErrors);
					}
				);
}

function renderListTempat(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
					for (var i = 0, item = null; i < dataset.length; i++) {
						item_view = dataset.item(i);
						$("#wisata_view").append('<li data-theme="c"><a href="tempat_detail.html?id_tempat='+item_view['id_tempat']+'" data-transition="slide">'+item_view['nama_tempat']+'</a></li>');
					}
					$("#wisata_view").listview('refresh');
				}
}

/////////////////////////END List Tempat

/////////////////////////////Start Tempat Detail
function showTempatDetail() {
				initDatabase();
				console.debug('called showRecords()');
				var sql = "select * from list_tempat WHERE id_tempat= ? ";
				db.transaction(
					function (transaction) {
						transaction.executeSql(sql, [GetQueryStringParams('id_tempat')], renderTempatDetail, handleErrors);
					}
				);
}

function renderTempatDetail(transaction, results) {
				console.debug('called renderRecords()');
				var dataset= results.rows;
				var item_view;
				if (dataset.length > 0) {
				item_view = dataset.item(0);
				$("#nama_tempat").html(item_view['nama_tempat']);
				$("#info_pariwisata").append(item_view['keterangan_tempat']);
				$("#lat").append(item_view['lat']);
				$("#long").append(item_view['long']);
				$("#foto_pariwisata").attr('src',item_view['url_foto']);
				$("#foto_pariwisata").attr('alt',item_view['nama_tempat']);
				$("#foto_pariwisata").attr('width',300);
					
					$('#peta_pariwisata_detail').gmap('addMarker', {'position': item_view['lat']+','+item_view['long'], 'bounds': true}).click(function() {
						$('#peta_pariwisata_detail').gmap('openInfoWindow', {'content':item_view['nama_tempat']}, this);
					});
				
				console.debug('map_with_marker("#peta_pariwisata_detail" ,'+ item_view['lat'] +','+ item_view['long'] );
				}
}

////////////////////////////////
///////Bagian Untuk Update
////////////////////////////////

function run_sql(sql) {
	initDatabase();
    console.debug('called insertRecord()');
    var sql = sql;
    db.transaction(
        function (transaction) {
            transaction.executeSql(sql, [], nullEvent,handleErrors);
            console.debug('executeSql: ' + sql);
        }
    );
}

//////////////////////////////////////
///////// Radio Player Powered By Argo Triwidodo
/////////////////////////////////////
// Audio player
        //
        var my_media = null;
        var mediaTimer = null;

        // Play audio
        //
        function playAudio() {
            // Create Media object from src
            my_media = new Media("http://s2.viastreaming.net:6340/;stream.mp3", nullEvent, eror);

            // Play audio
            my_media.play();
			setAudioPosition("Loading...");
            // Update my_media position every second
			
            if (mediaTimer == null) {
                mediaTimer = setInterval(function() {
                    // get my_media position
                    my_media.getCurrentPosition(
                        // success callback
                        function(position) {
                            if (position > 0 ) {
                                setAudioPosition('Playing '+(Math.floor(position)) + " sec");
                            }else{
								setAudioPosition("Loading...");
							}
                        },
                        // error callback
                        function(e) {
                            console.log("Error getting pos=" + e);
                            setAudioPosition("Error: " + e);
                        }
                    );
                }, 1000);
            } // end if
        }

        // Pause audio
        // 
        function pauseAudio() {
            if (my_media) {
                my_media.pause();
            }
        }

        // Stop audio
        // 
        function stopAudio() {
            if (my_media) {
                my_media.stop();
            }
            clearInterval(mediaTimer);
            mediaTimer = null;
        }
		
        function setAudioPosition(position) {
				//document.getElementById('audio_position').innerHTML = position;
				$("#audio_position").html(position);
        }
 

//tidak Ngapa2in
function nullEvent(result){
	
}
function eror(error) {
}

//error handle
function handleErrors(transaction, error) {
    console.debug('called handleErrors()');
    console.error('error ' + error.message);

//    alert(error.message);
    return true;
}

function radio_player(){
	if(radio){
		stopAudio();
		radio = false;
		var a = '<span class="ui-btn-inner"><span class="ui-btn-text">Play</span><span class="ui-icon ui-icon-gear ui-icon-shadow">&nbsp;</span></span>';
		$("#radio").html(a);
		setAudioPosition('');
	}else{
		playAudio();
		a = '<span class="ui-btn-inner"><span class="ui-btn-text">Playing tap to Stop</span><span class="ui-icon ui-icon-gear ui-icon-shadow">&nbsp;</span></span>';
		$("#radio").html(a);
		radio = true;
		setAudioPosition("Loading...");
	}
}

