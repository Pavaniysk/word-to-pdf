<?php

if (isset($_FILES['document'])) {
    $file = $_FILES['document'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed = array('doc', 'docx');
    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            $document = new \PhpOffice\PhpWord\PhpWord();
            $document->loadfile($file_tmp);
            $file_name = str_replace('.docx', '.pdf', $file_name);
            $document->save($file_name, 'PDF');
            header('Content-Type:application/pdf');
            header('Content-Disposition:attachment;filename=$file_name.');
            readfile($file_name);
        } else {
            echo 'error.' . $file_error;
        }
    } else {
        echo 'invalid file type.allowed types:doc,docx';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
background-color:lavenderblush;
opacity:1;
}
h1{
    text-align: center;
 
    font-size: medium;
}
</style>
</body>
    <head>
    <h1>CONVERT A FILE</h1>
</head>
    <body>

<form action="" enctype="multipart/form-data" method="post">
Select file :
<input type="file" name="document"><br/>
<input type="submit" value="convert">

</body>
</html>


