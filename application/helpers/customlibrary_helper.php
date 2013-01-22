<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/****************************************
*	FUNCIONES DE CONTROL DE SESIONES	*
****************************************/

if(!function_exists('is_login_with_cookies')){
	function is_login_with_cookies($thish) {
		if($thish->input->cookie($thish->config->item('encryption_key').'emailUsuario') != FALSE
		 || $thish->input->cookie($thish->config->item('encryption_key').'contrasenaUsuario') != FALSE ){
			$thish->session->set_flashdata('usuario',$thish->input->cookie($thish->config->item('encryption_key').'emailUsuario'));
			$thish->session->set_flashdata('contrasenaUsuario',$thish->input->cookie($thish->config->item('encryption_key').'contrasenaUsuario'));
			redirect('sesion/admin/true');
		 }
	}
}

if(!function_exists('is_login_with_session')){
	function is_login_with_session($thish) {
		if($thish->session->userdata('adentro') == true){
			return true;
		}else{
			return false;
		}
	}
}

/****************************************
*	FUNCIONES DE FORMATO				*
****************************************/

if(!function_exists('cutstr')){
	// function acorta strings, 2 parametros: string, longitud menor deseada
	function cutstr($strtocut, $long){
		$strtocut = trim($strtocut);
		if (strlen($strtocut) > $long){
				$strtocut = substr($strtocut , 0, $long - 3);
				$strtocut = $strtocut."...";
		}
		return $strtocut;
	}
}


if(!function_exists('monTOint')){
	// funcion de Moneda a Integer
	function monTOint($cdn){
		$cdn = trim($cdn);
		$cdn = str_replace("$","",$cdn);
		$cdn = str_replace(",","",$cdn);
		$cdn = intval($cdn);
		return $cdn;
	}
}

if(!function_exists('intTOmon')){
	// funcion de integer a moneda
	function intTOmon($cdn){
		$cdn    = trim($cdn) ;
		$CadLen = strlen($cdn) ;
		$Newcdn = "";
		if ($CadLen == 0){$cdn = 0; }
		if ($CadLen > 3)
	    	{
	    		$cdnDp = "G".$cdn;
				$mmc = 0;
					for ( $i = $CadLen ; $i >= 1  ; $i-- )
			        	{
	        				$Newcdn = $cdnDp{$i} . $Newcdn ;
				 			$mmc++ ;
				 			if(( $mmc == 3 ) && ( $i > 1 ))
				    			{
	    		     				$mmc = 0; 	
	    		     				$Newcdn = "," . $Newcdn ;
	                			} 	
		      			}
		  		$cdn = $Newcdn;   
     		}
	 	$cdn = "$" . $cdn . ".00" ;
		return $cdn ;
	}
}

if(!function_exists('guioner')){
	// funcion agrega todos espacios
	function guioner($cdn){
		$cdn = trim($cdn);
		$cdn = str_replace(" ","_",$cdn);
		return $cdn;
	}
}

if(!function_exists('desguioner')){
	// funcion quita todos guiones
	function desguioner($cdn){
		$cdn = trim($cdn);
		$cdn = str_replace("_"," ",$cdn);
		return $cdn;
	}
}

if(!function_exists('cleanStringUrl')){
	//Limpia una cadena y la prepara para URL
	function cleanStringUrl($cadena){
		$cadena = strtolower($cadena);
		$cadena = trim($cadena);
		$cadena = strtr($cadena,
								"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
								"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
		$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
		$cadena = preg_replace('#([^.a-z0-9]+)#i', '-', $cadena);
		$cadena = preg_replace('#-{2,}#','-',$cadena);
    	$cadena = preg_replace('#-$#','',$cadena);
   		$cadena = preg_replace('#^-#','',$cadena);
		return $cadena;
	}
}

/****************************************
*	FUNCIONES PARA APIS/SERVICIOS		*
****************************************/

if(!function_exists('gTranslate')){
	// Funcion que traduce a un idioma en especial
	function gTranslate($text,$langOriginal,$langFinal){
		//Si los idiomas son iguales no hago nada
		if($langOriginal != $langFinal){
		/* Definimos la URL de la API de Google Translate y metemos en la variable el texto a traducir */
		$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.urlencode($text).'&langpair='.$langOriginal.'|'.$langFinal;
		// iniciamos y configuramos curl_init();
		$curl_handle = curl_init();
		curl_setopt($curl_handle,CURLOPT_URL, $url);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$code = curl_exec($curl_handle);
		curl_close($curl_handle);
		/* La api nos devuelve los resultados en forma de objeto stdClass */	
		$json 		= json_decode($code)->responseData;
   	    $traduccion = utf8_decode($json->translatedText);
		return utf8_decode($traduccion);
		}else{
			return $text;
		}
	}
}

if(!function_exists('getTinyUrl')){
	// Funcion que obtiene TinyURL
	function getTinyUrl($bigURL){
		// Se crea un manejador CURL
		$ch = curl_init();
		// Se establece la URL y algunas opciones
		$urlVieja = "http://tinyurl.com/api-create.php?url=".$bigURL;
		curl_setopt($ch, CURLOPT_URL, $urlVieja);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Se obtiene la URL indicada
		$result = curl_exec($ch);
		$resultArray = curl_getinfo($ch);
		//Si hay error manda un correo al administrador
		if ($resultArray['http_code'] == 200){
			return $result;
		}else{
			return $bigURL;
		}
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
	}
}