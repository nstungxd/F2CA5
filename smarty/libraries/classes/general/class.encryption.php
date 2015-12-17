<?php
Class Encryption
{

	private $key = '';
	private $td = '';
	private $ky = '';
	private $iv = '';
	private $algo = '';
	private $mode = '';

	public function __construct() {}

	function setkey($ky)
	{
		if(trim($ky)=='') {
			$ky = "business2business";
		}
		$this->key = $ky;

	}

	function setAlgo($alg)
	{
		$ealgo = MCRYPT_3DES;
		switch($alg)
		{
			case '3DES':
				$ealgo = MCRYPT_3DES;
				break;
			case 'BLOWFISH':
				$ealgo = MCRYPT_BLOWFISH;
				break;
			case 'CRYPT':
				$ealgo = MCRYPT_CRYPT;
				break;
			case 'DES':
				$ealgo = MCRYPT_DES;
				break;
			case 'RC2':
				$ealgo = MCRYPT_RC2;
				break;
			default:
				$ealgo = MCRYPT_3DES;
		}
		/*if(trim($alg)=='') {
			$alg = MCRYPT_3DES; 	// MCRYPT_TripleDES;
		}*/
		$this->algo = $ealgo;
	}

	function setMode($mod)
	{
		if(trim($mod)==''){
			$mod = MCRYPT_MODE_CBC;
		}
		$this->mode = $mod;
	}

	function setiv($val='')
	{
		global $generalobj;
		// $this->iv = mcrypt_create_iv (mcrypt_get_block_size (MCRYPT_TripleDES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM);
		// if(trim($vl)=='') {
			//$this->iv = mcrypt_create_iv(mcrypt_get_block_size($this->algo, $this->mode), MCRYPT_DEV_RANDOM);
		// } else {
		    //echo $this->algo; exit;
			$ln = mcrypt_get_block_size($this->algo, $this->mode);
			// echo $ln;
			$vl = $generalobj->genUniqueCode($val);
			// echo strlen($vl); exit;
			if(strlen($vl) > $ln) {
				$this->iv = substr($vl,0,$ln);
			} else if(strlen($vl) < $ln) {
				$this->iv = str_pad($vl,$ln,'3',STR_PAD_RIGHT);
			}
			// $this->iv = $vl;
		// }
		return $this->iv;
	}

	public function setEncValues($encKey='',$algo='',$vl='',$mode='')
	{
		$this->setkey($encKey);
		$this->setAlgo($algo);
		$this->setMode($mode);
		$iv_val = $this->setiv($vl);
		return $iv_val;
	}

	// Encrypting
	function encryptText($text)
	{
		$enc = "";
		// $enc=mcrypt_cbc (MCRYPT_TripleDES, $this->key, $text, MCRYPT_ENCRYPT, $this->iv);
		$enc = mcrypt_cbc($this->algo, $this->key, $text, MCRYPT_ENCRYPT, $this->iv);
		return base64_encode($enc);
	}

	// Decrypting
	function decryptText($string)
	{
		$dec = "";
		$text = trim(base64_decode($text));
		$dec = mcrypt_cbc($this->algo, $this->key, $text, MCRYPT_DECRYPT, $this->iv);
		return $dec;
	}

	function mencrypt($text)
	{
		return base64_encode(mcrypt_encrypt($this->algo, $this->key, $text, $this->mode, $this->iv));
	}

	function mdecrypt($text)
	{
	   $text = trim(base64_decode($text));
      ///Prints($this->algo."=>".$this->key."=>".$text."=>".$this->mode."=>".$this->iv);
      $dcrypttext = str_replace("\x0",'',mcrypt_decrypt($this->algo, $this->key, $text, $this->mode, $this->iv));
		return $dcrypttext;
	}

// -----------------------------------------------------------
	function encrypt($data)
	{
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++)
		{
			$c = 255 & ($key ^ ($c << 1));
			$table[$key] = $c;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++)
		{
			$data[$i] = chr($table[ord($data[$i])]);
		}
		return base64_encode($data);
	}

	function decrypt($data)
	{
		$data = base64_decode($data);
		for($i = 0, $key = 27, $c = 48; $i <= 255; $i++)
		{
			$c = 255 & ($key ^ ($c << 1));
			$table[$c] = $key;
			$key = 255 & ($key + 1);
		}
		$len = strlen($data);
		for($i = 0; $i < $len; $i++)
		{
			$data[$i] = chr($table[ord($data[$i])]);
		}
		return $data;
	}
// -----------------------------------------------------------

// -----------------------------------------------------------
	function encrypt_data($cipher=MCRYPT_BLOWFISH,$key,$input)
	{
		if(function_exists(mcrypt_ecb)) {
			return base64_encode(mcrypt_ecb($cipher,$key,$input,MCRYPT_ENCRYPT));
		} else {
			return false;
		}
	}

	function decrypt_data($cipher=MCRYPT_BLOWFISH,$key,$input)
	{
		if(function_exists(mcrypt_ecb)) {
			return mcrypt_ecb($cipher,$key,base64_decode($input),MCRYPT_DECRYPT);
		} else {
			return false;
		}
	}
// -----------------------------------------------------------

// -----------------------------------------------------------
	function setconfig()
	{
		//$key = 'this is a very long key, even too long for the cipher';
		// $plain_text = 'very important data';

		// Open module, and create IV
		$this->td = mcrypt_module_open('des', '', 'ecb', '');
		$this->ky = substr($this->key, 0, mcrypt_enc_get_key_size($this->td));
		$iv_size = mcrypt_enc_get_iv_size($this->td);
		$this->iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	}

	function encryptData($data)
	{
		// Initialize encryption handle
		if (mcrypt_generic_init($this->td, $this->ky, $this->iv) != -1) {
			// Encrypt data
			return mcrypt_generic($this->td, $data);

			// $edata = mcrypt_generic($this->td, $data);
			// mcrypt_generic_deinit($this->td);
			// return $edata;

			// Reinitialize buffers for decryption
			// mcrypt_generic_init($this->td, $this->ky, $this->iv);
			// $p_t = mdecrypt_generic($this->td, $c_t);
		}
	}

	function decryptData($data)
	{
		// Initialize buffers for decryption
		// Initialize decryption handle
		if (mcrypt_generic_init($this->td, $this->ky, $this->iv) != -1) {
			// Initialize buffers for decryption
			// mcrypt_generic_init($this->td, $this->ky, $this->iv);
			return mdecrypt_generic($this->td, $data);

			// Encrypt data
			// $c_t = mcrypt_generic($this->td, $plain_text);
			// mcrypt_generic_deinit($this->td);
		}
	}

	function enclose()
	{
		// Clean up
		mcrypt_generic_deinit($this->td);
		mcrypt_module_close($this->td);
	}

	function testenc()
	{
		$key = 'this is a very long key, even too long for the cipher';
		$plain_text = 'very important data';

		// Open module, and create IV
		$td = mcrypt_module_open('des', '', 'ecb', '');
		$key = substr($key, 0, mcrypt_enc_get_key_size($td));
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

		// Initialize encryption handle
		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			// Encrypt data
			$c_t = mcrypt_generic($td, $plain_text);
			mcrypt_generic_deinit($td);

			// Reinitialize buffers for decryption
			mcrypt_generic_init($td, $key, $iv);
			$p_t = mdecrypt_generic($td, $c_t);

			// Clean up
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
		}

		if (strncmp($p_t, $plain_text, strlen($plain_text)) == 0)
		{
			echo "ok\n";
			return "OK";
		} else {
			echo "error\n";
			return "ERR";
		}
	}
// -----------------------------------------------------------

}
?>