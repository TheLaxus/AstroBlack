<?php 
	/*
	 * - HashMD5
	 * - EncryptMD5
	 */
	
	class Security {
		
		static function HashMD5($string)  {
			$hash = "s!#Zca@vu^2u^2TpccFgQeJ*&srFePpxBh37QqwaB8K9Y*$9#q"; # Não mudar isso aqui de jeito nenhum.
			$string = sha1($string . $hash);

			return $string;
		}

		static function EncryptMD5($password, $string) {
			return md5(md5($string . $password) . md5($string . $string));
		}


		static function encode($texto) {
			$numero_caracteres = strlen($texto);
			$txt = "";
			for ($i = 0; $i < $numero_caracteres; $i++) {
				if ($texto[$i] == '"' || $texto[$i] == ' ' || $texto[$i] == ':' || $texto[$i] == ',') {
					$txt .= $texto[$i];
				} else {
					$txt .= "%".bin2hex($texto[$i])."";
				}
			}
			return $txt;
		}
	}
?>