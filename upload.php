<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["File"]["docx"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file is a actual file or fake file
if(isset($_POST["submit"])) 
  $check = ($_FILES["File"]["tmp_name"]);
  if($check !== false) {
    echo "File is  a docx " .  ".";
    $uploadOk = 1;
  } else {
    echo "File is not a docx .";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}


// Allow certain file formats
if($FileType != "docx" ) {
  echo "Sorry, only docx files are allowed.";
  $uploadOk = 0;
}


?>