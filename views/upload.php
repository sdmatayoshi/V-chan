images
<form action="upload.php" method="POST" enctype="multipart/form-data">
<label>
<input type="file" name="image" accept="image/*,video/*">
</label>
<br>
<label>
    tags
    <input type="textarea" name="tags">
</label>
    <input type="submit" name="submit" value="Upload file">
</form>
<?php
if($confirm==1){
    echo "El archivo se ha subido correctamente";
}else if($confirm=0){
    echo "Error al subir el archivo. Compruebe la extensión del mismo";
}
?>