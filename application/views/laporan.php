<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://www.cdn.lamhotsimamora.com/garuda2/"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Peserta Berdasarkan Tanggal Lahir</title>
</head>
<body>
	<br><br>
	<div class="container">
		<button class="btn btn-primary btn-md" onclick="_refresh('http://localhost/Program-Data-Peserta-Kominfo/')">Back</button>
		<br><br>
		
		<div class="text-center">
			<h4>Laporan Peserta Berdasarkan Tanggal Lahir</h4>
		</div>
		<br>
				<div class="table-responsive">
				    <table class="table">
				      <thead>
				        <tr>
				          <th>Tanggal Lahir</th>
				          <th>Jumlah Peserta</th>
				          <th>#</th>
				        </tr>
				      </thead>
				      <tbody id="display_peserta">
				       		
				      </tbody>
				    </table>
				  </div>
			<hr>
	</div>


	</div>

</body>

<script>
		
	function loadData()
	{
		$data = __({
			url : 'http://localhost/Program-Data-Peserta-Kominfo/index.php/Laporan/show'
		}).request($response => {
				var data = JSON.parse($response);

				if (data)
				{
					var tmplate = "";
					for (var i = 0; i < data.length; i++) {

						var total = data[i].TOTAL;
						var tgl_lahir = data[i].tgl_lahir;

						tmplate += `<tr>
						          		<td>${tgl_lahir}</td>
						          		<td>${total}</td>
						          		<td><button id="${i}" onclick="showDetail(this)" name="${tgl_lahir}" class="btn btn-warning btn-md">
											Detail
						          		</button></td>
						      		</tr>`;
					}
					Garuda('display_peserta').setHtml(tmplate);
				}
		});
	}

	loadData();


	function showDetail(i){
		var date = i.name;
		_a(date);
	}

</script>

</html>