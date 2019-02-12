<?php

class Img{

	static function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100){
		// On supprime l'extension du nom
		$nom = substr($nom,0,-4);
		// On récupère les dimensions de l'image
		$dimension=getimagesize($img);
		// On crée une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false; }
		
		// Création des miniatures
		// On crée une image vide de la largeur et hauteur voulue
		$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
		// On va gérer la position et le redimensionnement de la grande image
		if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
		if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
		if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
		// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
		imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
		// On sauvegarde le tout
		imagejpeg($miniature,$chemin."/".$nom.".jpg",90);
		return true;
	}
	

	static function convertirJPG($img){
		// On cré une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false;}
		unlink($img);
		imagejpeg($image,substr($img,0,-3)."jpg",90);	
		return true;
	}
	
	static function darkroom($img, $width = 0, $height = 0){
	 
		$dimensions = getimagesize($img);
		$ratio      = $dimensions[0] / $dimensions[1];
	 
		// Calcul des dimensions si 0 passé en paramètre
		if($width == 0 && $height == 0){
			$width = $dimensions[0];
			$height = $dimensions[1];
		}elseif($height == 0){
			$height = round($width / $ratio);
		}elseif ($width == 0){
			$width = round($height * $ratio);
		}
	 
		if($dimensions[0] > ($width / $height) * $dimensions[1]){
			$dimY = $height;
			$dimX = round($height * $dimensions[0] / $dimensions[1]);
			$decalX = ($dimX - $width) / 2;
			$decalY = 0;
		}
		if($dimensions[0] < ($width / $height) * $dimensions[1]){
			$dimX = $width;
			$dimY = round($width * $dimensions[1] / $dimensions[0]);
			$decalY = ($dimY - $height) / 2;
			$decalX = 0;
		}
		if($dimensions[0] == ($width / $height) * $dimensions[1]){
			$dimX = $width;
			$dimY = $height;
			$decalX = 0;
			$decalY = 0;
		}
	 

			$pattern = imagecreatetruecolor($width, $height);
			$type = mime_content_type($img);
			switch (substr($type, 6)) {
				case 'jpeg':
					$image = imagecreatefromjpeg($img);
					break;
				case 'gif':
					$image = imagecreatefromgif($img);
					break;
				case 'png':
					$image = imagecreatefrompng($img);
					break;
			}
			imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
			imagedestroy($image);
			imagejpeg($pattern,substr($img,0,-3)."jpg",90);
	 
			return TRUE;
		}
	
}

?>
