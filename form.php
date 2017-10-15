<div class="container">
	<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="exampleInputFile">Choose files to send (jpg, png, gif) max size by file 1Mo</label>
		<input type="file" id="exampleInputFile" name="fichier[]" multiple="multiple">
	</div>
	<button type="submit" class="btn btn-default">Send files</button>
	</form>
	<?php 
	if(isset($msg_type))echo $msg_type;
	if(isset($msg_taille))echo $msg_taille;
	if(isset($mess))echo $mess; 

	echo '<hr>';
//le scandir
$dir = './upload/';
	if(is_dir($dir)){
		$thumb = scandir($dir);
	}else{
		$thumb = 0;	
	}
		
if(is_array($thumb)){
	for($j=0;$j<count($thumb); $j++){
		echo '<div class="row">';
			echo '<div class="col-sm-6 col-md-4">';
				if($thumb[$j]!="." and $thumb[$j]!=".."){
					echo '<div class="thumbnail">';
						echo '<img src="'.$dir.$thumb[$j].'" alt="'.$thumb[$j].'">';
						echo '<div class="caption">';
							echo '<p>'.$thumb[$j].'</p>';
							echo '<form action="" method="post" enctype="multipart/form-data">';
								echo '<input type="hidden" id="id" name="img" value="'.$thumb[$j].'">';
								?>
								<button type="submit" class="btn btn-danger" role="button" name="supp" value="Supprimer" onclick="if(!confirm('Etes-vous sûr de vouloir supprimer ?')) return false;"/>Supprimer</button>
								<?php
							echo '</form>';
						echo '</div>';
					echo '</div>';	
				}
			echo '</div>';
		echo '</div>';	
	}			
}
?>
</div>