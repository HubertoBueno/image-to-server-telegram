<?php
//Almacenamos el token de nuestro bot en una variable
$bot_token = "abc-123456789-xyz";
//Obtenemos el archivo JSON desde el metodo getUpdates
$json_update = file_get_contents("https://api.telegram.org/bot" . $bot_token . "/getUpdates");

//Lo decodificamos
$array_update = json_decode($json_update,true);

//Recorremos el array obtenido
foreach ($array_update["result"] as $key=>$value) {
	
   // Solo nos detendremos en aquellas comversaciones que tengan un caption que coincida en este caso con mi número de cliente (00817)
   if (isset($value['message']['caption'])&&(($value['message']['caption'])=='00817'))
   {
		//obtenemos el ID de la foto (el valor 3 es la foto en su tamaño original)
		$id_foto = $value['message']['photo'][3]['file_id'];

		//obtenemos la informacion del archivo
		$json_foto = file_get_contents("https://api.telegram.org/bot" . $bot_token . "/getFile?file_id=" . $id_foto);
		$array_foto = json_decode($json_foto, true);
		
		//obtenemos la ruta donde se encuentra la foto
		$ruta_foto = $array_foto['result']['file_path'];
		
		//componemos la url completa de nuestra foto
		$foto = 'https://api.telegram.org/file/bot' . $bot_token . '/' . $ruta_foto;

   }
}
?>
