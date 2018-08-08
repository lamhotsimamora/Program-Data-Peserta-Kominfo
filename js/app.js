$data_user = __({
  url:'./index.php/user/api_view_user'
});

let app_template ;
const component_app = $profile.getHtml;

function loadData(type=false)
{
	$data_user.request($response=>{
		var obj = JSON.parse($response);
		
		if (obj){
			var user = obj.user;

			var data = new Array();
			if (user.length==0)
			{
				return;
			}
			Garuda('display_total_user').setContent(" "+user.length);

			var tmplate = '';
			for (var i = 0; i < user.length; i++) 
			{
				var nik = user[i].nik;
				var name = user[i].name;
				var email = user[i].email;
				var nama_skema = user[i].nama_skema;
				var phone = user[i].phone;
				var tempat_uji = user[i].tempat_uji;
				
				var tgl_sertifikat = user[i].tgl_sertifikat;
				var tgl_lahir = user[i].tgl_lahir;
				var organisasi = user[i].organisasi;

				var rekomendasi = user[i].rekomendasi;

				tmplate  += ` <tr>
						          <td>${i+1}</td>
						          <td>${nik}</td>
						          <td>${name}</td>
						          <td>${email}</td>
						          <td>${nama_skema}</td>
						          <td>${phone}</td>

						          <td>${tempat_uji}</td>
						          <td>${tgl_sertifikat}</td>
						          <td>${tgl_lahir}</td>
						          <td>${organisasi}</td>
						          <td>${rekomendasi}</td>
						        </tr>`;
			}
			Garuda('display_user_table').setContent(tmplate);
		}
	});
}

loadData(true);


function showTemplateAdd()
{
	app_template = $app.getContent;

	$app.setContent($template_add.getHtml);

	Garuda('txt_name').focus();
	
	loadSkema();
	loadLokasiUjian();
}

function loadSkema(){
	$load_skema = __({
		url:'./index.php/Skema/api_view_skema'
	}).request('pilih_skema');
}

function loadLokasiUjian(){
	$load_skema = __({
		url:'./index.php/Lokasi/api_view_lokasi'
	}).request('pilih_lokasi');
}

function cancel()
{
	Garuda('my_app').setContent(app_template);
	loadData();
}

function enterAdd(e)
{
	if (e.keyCode==13)
	{
		addData();
	}
}

function addData()
{
	 let name = Garuda('txt_name').getValue;
	 let nik = Garuda('txt_nik').getValue;
	 let phone = Garuda('txt_phone').getValue;
	 let email = Garuda('txt_email').getValue;

	 let birthday = Garuda('txt_birthday').getValue;
	 let tgl_terbit_serti = Garuda('txt_tgl_sertifikat').getValue;
	 
	 let organisasi = Garuda('txt_organisasi').getValue;

	 if (name==='' || name==null || name===undefined)
	 {
	 	 Garuda('txt_name').focus();
	 	 return;
	 }

	 if (nik==='' || nik==null || nik===undefined)
	 {
	 	 Garuda('txt_nik').focus();
	 	 return;
	 }

	 if (nik.length>16 || nik.length<16)
	 {
	 	_a("NIK Tidak Valid");
	 	return;
	 }

	 var skema_programming = Garuda('pilih_skema').getSelected();
	 skema_programming = JSON.parse(skema_programming);

	 if (skema_programming.value==='N')
	 {
	 	_a("Silahkan Pilih Skema Terlebih Dahulu !");
	 	return;
	 }

	 if (email==='' || email==null || email===undefined)
	 {
	 	 Garuda('txt_email').focus();
	 	 return;
	 }

	 if (_isEmail(email)==false)
	 {
	 	Garuda('msg-show').setContent(displayAlert('Email is not valid !','warning'));
	 	Garuda('txt_email').focus();
	 	return;
	 }

	  if (phone==='' || phone==null || phone===undefined)
	 {
	 	 Garuda('txt_phone').focus();
	 	 return;
	 }

	 var lokasi = Garuda('pilih_lokasi').getSelected();
	 lokasi = JSON.parse(lokasi);

	 if (lokasi.value==='N')
	 {
	 	_a("Silahkan Pilih Lokasi Terlebih Dahulu !");
	 	return;
	 }

	 if (birthday==='' || birthday==null || birthday===undefined)
	 {
	 	 Garuda('txt_birthday').focus();
	 	 return;
	 }

	 if (tgl_terbit_serti==='' || tgl_terbit_serti==null || tgl_terbit_serti===undefined)
	 {
	 	 Garuda('tgl_terbit_serti').focus();
	 	 return;
	 }

	 if (organisasi==='' || organisasi==null || organisasi===undefined)
	 {
	 	 Garuda('txt_organisasi').focus();
	 	 return;
	 }

	 $insert_data = __({
	    url:'./index.php/user/api_add_user',
	    method:'post',
	    data:{
	      name:name,
	      nik:nik,
	      email:email,
	      phone:phone,
	      skema:skema_programming.value,
	      lokasi:lokasi.value,
	      tgl_lahir:birthday,
	      tgl_serti:tgl_terbit_serti,
	      organisasi:organisasi
	    }
	 });

	 $insert_data.request($=>{
	 	  if ($==='T')
	 	  {
	 	  	 Garuda('msg-show').setContent(displayAlert('Data has been added !','success'));
	 	  	 Garuda('txt_name').clearValue();
	 	  	 Garuda('txt_email').clearValue();
	 	  	 Garuda('txt_phone').clearValue();
	 	  	 Garuda('txt_nik').clearValue();
	 	  	 Garuda('txt_name').focus();
	 	  }else{
	 	  	 Garuda('msg-show').setContent(displayAlert('Failed to add data !','warning'));
	 	  }
	 });
}

function displayAlert(message,type)
{
	return '<div class="alert alert-'+type+'" role="alert">'+message+'</div>'; 
}

function viewUpdateData(obj)
{
	app_template = $app.getContent;

	var id   =  obj.id;

	$app.setContent('<div id="msg-show"></div><input type="number" onkeypress="enterUpdate(event);" class="form-control" readonly="" id="txt_id_update" placeholder="ID" value="'+id+'" > <br>'+
					'<input type="text" onkeypress="enterUpdate(event);" class="form-control" id="txt_name_update" placeholder="Name" value=""><br>'+
					'<input type="email" onkeypress="enterUpdate(event);" class="form-control" id="txt_email_update" placeholder="Email" value=""><br>'+
					'<input type="text" onkeypress="enterUpdate(event);" class="form-control" id="txt_phone_update" placeholder="Phone" value="" ><br>'+
					'<button id="btn_update" class="btn btn-success btn-md" disabled="" onclick="updateData();">Please Wait...</button>&nbsp'+
					'<button class="btn btn-danger btn-md" onclick="cancel();">Cancel</button>'
	);
	 $view_data = __({
	    url:'./index.php/user/api_view_user_single_data',
	    method:'post',
	    data:{
	      id:id
	    }
	 });

	 $view_data.request($response=>{
	 		var obj = JSON.parse($response);
			if (obj){
				Garuda('txt_name_update').setValue(obj[0].name);
				Garuda('txt_email_update').setValue(obj[0].email);
				Garuda('txt_phone_update').setValue(obj[0].phone);
				Garuda('btn_update').setContent('Update');
				Garuda('btn_update').enabled();
			}
	 });
}

function enterUpdate(e)
{
	if (e.keyCode==13)
	{
		updateData();
	}
}

function updateData()
{
	 let id_update = Garuda('txt_id_update').getValue;
	 let name = Garuda('txt_name_update').getValue;
	 let email = Garuda('txt_email_update').getValue;
	 let phone = Garuda('txt_phone_update').getValue;

	 if (name==='' || name==null || name===undefined)
	 {
	 	 Garuda('txt_name_update').focus();
	 	 return;
	 }

	 if (email==='' || email==null || email===undefined)
	 {
	 	 Garuda('txt_email_update').focus();
	 	 return;
	 }

	 if (_isEmail(email)==false)
	 {
	 	Garuda('msg-show').setContent(displayAlert('Email is not valid !','warning'));
	 	 Garuda('txt_email_update').focus();
	 	return;
	 }


	  if (phone==='' || phone==null || phone===undefined)
	 {
	 	 Garuda('txt_phone_update').focus();
	 	 return;
	 }
	 
	 $update_data = __({
	    url:'./index.php/user/api_update_user',
	    method:'post',
	    data:{
	      id:id_update,
	      name:name,
	      email:email,
	      address:address,
	      phone:phone
	    }
	 });

	 $update_data.request($=>{
	 	  if ($==='T')
	 	  {
	 	  	 Garuda('msg-show').setContent(displayAlert('Data has been updated !','success'));
	 	  }else{
	 	  	 Garuda('msg-show').setContent(displayAlert('Failed to updated data !','warning'));
	 	  }
	 });
}

function viewDeleteData(id)
{
	var ask = confirm("Are you sure want to delete this data ? ");

	if (ask == true) {
	    $delete_data = __({
		    url:'./index.php/user/api_delete_user',
		    method:'post',
		    data:{
		      id:id
		    }
		 });

		 $delete_data.request($=>{
		 	  if ($==='T')
		 	  {
		 	  	 Garuda('display_message').setContent(displayAlert('Data has been deleted !','success'));
		 	  	 _refresh();
		 	  }else{
		 	  	 Garuda('display_message').setContent(displayAlert('Failed to deleted data !','warning'));
		 	  }
		 });
	} 
}

function enterSearch(e){
	if (e.keyCode==13)
	{
		searchUser();
	}
}

function searchUser() 
{
	 var name = Garuda('txt_search').getValue;

	 if (name==='')
	 {
	 	Garuda('txt_search').focus();
	 	return;
	 }

	$search_user = __({
	  url:'./index.php/user/api_search_user',
	  method:'post',
	  data:{
	  	 name:name
	  }
	});

	$search_user.request($response=>{
			var obj = JSON.parse($response);
		
		if (obj){
			var user = obj.user;

			var data = new Array();
			if (user.length==0)
			{
				return;
			}
			Garuda('display_total_user').setContent(" "+user.length);

			var tmplate = '';
			for (var i = 0; i < user.length; i++) 
			{
				var nik = user[i].nik;
				var name = user[i].name;
				var email = user[i].email;
				var nama_skema = user[i].nama_skema;
				var phone = user[i].phone;
				var tempat_uji = user[i].tempat_uji;
				
				var tgl_sertifikat = user[i].tgl_sertifikat;
				var tgl_lahir = user[i].tgl_lahir;
				var organisasi = user[i].organisasi;

				var rekomendasi = user[i].rekomendasi;

				tmplate  += ` <tr>
						          <td>${i+1}</td>
						          <td>${nik}</td>
						          <td>${name}</td>
						          <td>${email}</td>
						          <td>${nama_skema}</td>
						          <td>${phone}</td>

						          <td>${tempat_uji}</td>
						          <td>${tgl_sertifikat}</td>
						          <td>${tgl_lahir}</td>
						          <td>${organisasi}</td>
						          <td>${rekomendasi}</td>
						        </tr>`;
			}
			Garuda('display_user_table').setContent(tmplate);
	 }	
	});
}