<!DOCTYPE html>
<html>
<body>

<form action="convert.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="convert file" name="submit">
</form>

</body>
</html>
<?php 


$fileType = '';
$download = false;

//handle get method, when page redirects
if($_GET){	
	$fileType = urldecode($_GET['fileType']);
	$fileName = urldecode($_GET['fileName']);
}else{
	header('Location:upload.php');
}

//handle post method when the form submitted
if($_POST){
	
	$convert_type = $_POST['convert_type'];
	
	//create object of image converter class
	$obj = new file_converter();
	$target_dir = 'uploads';
	//convert image to the specified type
	$file = $obj->convert_file($convert_type, $target_dir, $fileName);
	
	//if converted activate download link 
	if($image){
		$download = true;
	}
}


//convert types
$types = array(
	'docx' => 'Pdf'
	);
?>
<html>
<head>
<style>
img{
	max-width: 360px;
}
body{
	background: lightgray;
}
 
</style>
</head>
<body>
	<?php if(!$download) {?>
		<form method="post" action="">
			<table width="500" align="center">
				<tr>
					<td align="center">
						File Uploaded, Select below option to convert!
						<img src="uploads/<?=$fileName;?>"  />
					</td>
				</tr>
				<tr>
					<td align="center">
						Convert To: 
							<select name="convert_type">
								<?php foreach($types as $key=>$type) {?>
									<?php if($key != $imageType){?>
									<option value="<?=$key;?>"><?=$type;?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<br /><br />
					</td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="convert" /></td>
				</tr>
			</table>
		</form>
	<?php } ?>
	<?php if($download) {?>
		<table width="500" align="center">
				<tr>
					<td align="center">
						file Converted to <?php echo ($convert_type); ?>
						<img src="<?=$target_dir.'/'.$file;?>"  />
					</td>
				</tr>
				<td align="center">
				
					<a href="download.php?filepath=<?php echo $target_dir.'/'.$file; ?>" />Download Converted file</a>
				</td>
			</tr>
		</table>
	<?php } ?>
</body>
</html>