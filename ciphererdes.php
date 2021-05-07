<?php
class RunnerCiphererDES
{
    /**
     * Encryption key (8 characters maximum)
     * @var string
     */
    public $key = '';
    public $INITIALISATION_VECTOR = 'd27b358d';
    
    public $mcryptModule = null;
    
    public function __construct($key)
    {
        //$this->mcryptModule = @mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, '');
        $this->key = '234dfghegf2334563456"·asdfasdfwergbcvbsdfgsdfgsdfggtyutui()/()/"·"·)%&·&723452345sdfgfshsdf';
    }
    
    /**
     * Encrypt
     * Encrypt string with algorythm
     * @param {string} plain value
     * @return {string} encrypted value
     */
    public function Encrypt($source)
    {
        /*$result = '';
        if ($source != '' && @mcrypt_generic_init($this->mcryptModule, $this->key, $this->INITIALISATION_VECTOR) != -1) {
            $result = bin2hex(@mcrypt_generic($this->mcryptModule, $source));
        }*/
        return $this->_encode($source,$this->key);
    }
    
    /**
     * Decrypt
     * Decrypt string, ecncrypted with  algorythm
     * @param {string} encrypted value
     * @return {string} decrypted value
     */
    public function Decrypt($source)
    {
        /*if (!is_string($source) || strlen($source) == 0 || strlen($source) % 2 > 0 || preg_match(“/[^0-9a-f]/'', $source) == 1) {
            return $source;
        }*/
        /*
        $result = '';
        if ($source != '' && @mcrypt_generic_init($this->mcryptModule, $this->key, $this->INITIALISATION_VECTOR) != -1) {
            $result = @mdecrypt_generic($this->mcryptModule, hex2bin($source));
            $result = str_replace(“\0'', '', $result);
        }*/
        
        return $this->_decode($source,$this->key);
    }
    
    function _encode($string,$key) {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        for ($i = 0; $i < $strLen; $i++) {
            $ordStr = ord(substr($string,$i,1));
            if ($j == $keyLen) { $j = 0; }
            $ordKey = ord(substr($key,$j,1));
            $j++;
            $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
        }
        return $hash;
    }
    //———————————————————————————————
    function _decode($string,$key) {
        $key = sha1($key);
    
        $strLen = strlen($string);
        $keyLen = strlen($key);
        for ($i = 0; $i < $strLen; $i+=2) {
            $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
            if ($j == $keyLen) { $j = 0; }
            $ordKey = ord(substr($key,$j,1));
            $j++;
            $hash .= chr(($ordStr) - ($ordKey));
        }
        return $hash;
    }
}