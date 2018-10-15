<html>
<head>
	<title></title>
</head>
<body>

	<? 
	$acesData = [
		"username" => "admin",
		"password" => "12345"
	];
	if(
		!empty($_POST['username']) && 
		$_POST['username']===$acesData['username'] &&
		!empty($_POST['password']) && 
		$_POST['password']===$acesData['password']
	){
		$authorised = true;
	}
	?>

	<? if(!$authorised){?>
	<form method="post">
		<table align="center">
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" required></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Login"></td>
			</tr>

		</table>
	</form>
	<? }?>


	<? if($authorised){?>
	<div style="text-align: right;">
		<a href="autorizare.php">Logout</a>
	</div>
	<? 
$fileName = 'carti.json';
$fileData = file_get_contents($fileName);
$carti = json_decode($fileData, true);
$fileName = 'carti.json';
	if(!empty($_POST['an_editie']) && !empty($_POST['titlu']) && !empty($_POST['id']) && !empty($_POST['nr_de_pagini'])){
		$fileData = file_get_contents($fileName);
		$carti = json_decode($fileData, true);
		$newElement = [
			"an_editie" => trim($_POST['an_editie']),
			"titlu" => trim($_POST['titlu']),
			"id" => trim($_POST['id']),
			"nr_de_pagini" => trim($_POST['nr_de_pagini'])
		];
		$carti[] = $newElement;
		file_put_contents($fileName, json_encode($carti));
	}
?>
<table border="1">
	<thead>
		<tr>
			<th>An editie</th>
			<th>Titlu</th>
			<th>ID</th>	
			<th>Nr pagini</th>		
		</tr>
	</thead>
	<tbody>
<?
foreach ($carti as $carte) {?>
	<tr>
			<td><?=$carte['an_editie'];?></td>
			<td><?=$carte['titlu'];?></td>
			<td><?=$carte['id'];?></td>
			<td><?=$carte['nr_de_pagini'];?></td>			
	</tr>	
<?}
?>
	<? }?>

</body>
</html>