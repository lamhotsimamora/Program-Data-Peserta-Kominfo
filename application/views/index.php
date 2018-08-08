<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Peserta</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://www.cdn.lamhotsimamora.com/garuda2/"></script>
	<meta name="og:image" 			content="" />
	<meta property="og:image"     	content="" />
	<link rel="shortcut icon" type="image/png" href="icon.png"/>
	<meta name="ROBOTS" 			content="index"/>
	<meta name="Author" 			content="@lamhotsimamora" />
	<meta name="copyright" 			content="Copyright@2018 | All Right Reserved" />
	<meta property="og:title" 		content="" />
	<meta property="og:description" content="" />
	<meta property="og:name"      	content="" />
	<meta name="language" 		  	content="Indonesian, English" />
	<meta name="distribution" 	  	content="Global" />
	<meta name="rating" 		  	content="General" />
	<meta name="expires" 		  	content="1800" />
	<meta name="theme-color"      	content="#E43539"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="garuda_app">
	<br><br>
	
	<div class="container">
		<h3 class="text-center">Aplikasi Sederhana Peserta Sertifikasi</h3>
		<br>
		
		<hr>
	</div>

	<div id="my_app" class="container">
		
		<div id="display_message"> </div>
		<button class="btn btn-default btn-md" onclick="showTemplateAdd();">Add Data</button> &nbsp
		<button class="btn btn-success btn-md" onclick="loadData();">Refresh</button> <br>
		<br>
		<div class="text-center">
			<h3>Total Peserta : <strong id="display_total_user"></strong></h3>
		</div>
		<br>
		<input type="text" id="txt_search" onkeypress="enterSearch(event);" placeholder="Search User" class="form-control" name="">
		
		<div id="template-profile">
			
			<div class="table-responsive">
				    <table class="table">
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>NIK</th>
				          <th>Nama</th>
				          <th>Email</th>
				          <th>Skema</th>
				          <th>No HP</th>
				          <th>Lokasi Ujian</th>
				          <th>Tgl Terbit Sertifikat</th>
				          <th>Tgl Lahir</th>
				          <th>Organisasi</th>
				          <th>Rekomendasi</th>
				        </tr>
				      </thead>
				      <tbody id="display_user_table">
				       		
				      </tbody>
				    </table>
				  </div>
				</div>

				<!-- @start@
						<div class="card">
						  <h5 class="card-header">Nama : #name#</h5>
						  <div class="card-body">
						    <p class="card-text">NIK 	: #nik#</p>
						    <p class="card-text">Email  : #email#</p>
						    <p class="card-text">
						    No HP : #phone#
							</p>
							<br>
						    <center><button class="btn btn-warning btn-xs" id="#id_user#" onclick="viewUpdateData(this)">Update</button>
						    	<button class="btn btn-danger btn-xs" id="#id_user#" onclick="viewDeleteData(this.id);">Delete</button>
						    </center>
						  </div>
						</div>
						<br>
				@end@ -->
		</div>

	</div>


	<div id="body_down">
		
	</div>
	<div class="container">
			<footer>
				 <br>
				 <hr>
				<button class="btn btn-info btn-md" onclick="_scrollTo({el:'garuda_app'});">Go Up</button>
			</footer>
	</div>

	<template id="template_add">
		<div id="msg-show"></div><input type="text" class="form-control" id="txt_name" onkeypress="enterAdd(event);" placeholder="Username" name=""> <br>
		<input type="number" onkeypress="enterAdd(event);" class="form-control" id="txt_nik" placeholder="NIK" name=""><br>
		<select class="form-control" id="pilih_skema">
				 
		</select>
				<br>
		<input type="email" onkeypress="enterAdd(event);" class="form-control" id="txt_email" placeholder="Email" name=""><br>
		<input type="text" onkeypress="enterAdd(event);" class="form-control" id="txt_phone" placeholder="Phone" name=""><br>
		<select class="form-control" id="pilih_lokasi">
				 
		</select>
		<br>
		

		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
		  </div>
			  <input type="date" onkeypress="enterAdd(event);" max="2018-08-08" class="form-control" id="txt_birthday" placeholder="Tanggal Lahir" name=""><br>
		</div>

		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text" id="basic-addon1">Tanggal Terbit Sertifikat</span>
		  </div>
			
			<input type="date" onkeypress="enterAdd(event);" max="2018-09-01" class="form-control" id="txt_tgl_sertifikat" placeholder="Tanggal Terbit Sertifikat" name="">
		<br>
		
		</div>

	
		<input type="text" onkeypress="enterAdd(event);" class="form-control" id="txt_organisasi" placeholder="Organisasi" name=""><br>

		<button class="btn btn-success btn-md" onclick="addData();">Add</button>&nbsp
		<button class="btn btn-danger btn-md" onclick="cancel();">Cancel</button>
	</template>
</body>

<script type="text/javascript" src="<?php echo base_url('js/component.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/app.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/debug.js') ?>"></script>

</html>