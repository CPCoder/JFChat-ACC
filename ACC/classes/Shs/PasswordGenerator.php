<?php
/*
 * Project		Password-Generator
 * Filename		PasswordGenerator.php
 * Author		Steffen Haase
 * Date			06.01.2012
 */

/**
 * PasswordGenrator
 * 
 * Diese Klasse dient zum generieren einen zuf�lligen Passworts.
 *
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 */
class PasswordGenerator
{
	private $_alpha_upper;
	private $_alpha_lower;
	private $_numbers;
	private $_specials;
	private $_length = 8;
	private $_include_upper = true;
	private $_include_lower = true;
	private $_include_numbers = true;
	private $_include_specials = true;
	private static $_instance;
	
	/** 
	 * Gibt eine Instanz dieser Klasse zur�ck.
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @return Object Instanz dieser Klasse
	 */
	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	private function __construct()
	{
		$this->_alpha_upper = range('A','Z');
		$this->_alpha_lower = range('a','z');
		$this->_numbers = range(0,9);
		$this->_specials = array(".","$","!","%","&","@","=");
	}
	
	public function getPassword(
		$length = 8, $include_upper = true, 
		$include_lower = true, $include_numbers = true, 
		$include_specials = true
		)
	{
		$this->setDefault(func_get_args());
		return $this->generatePassword();
	}
	
	private function generatePassword()
	{
		$password = array();
		$signrange = array();
		
		if ($this->_include_upper === true) {
			$alphaUpper = $this->_alpha_upper;
			$signrange[] = 1;
		}
		if ($this->_include_lower === true) {
			$alphaLower = $this->_alpha_lower;
			$signrange[] = 2;
		}
		if ($this->_include_numbers === true) {
			$numbers = $this->_numbers;
			$signrange[] = 3;
		}
		if ($this->_include_specials === true) {
			$specials = $this->_specials;
			$signrange[] = 4;
		}
		$i = count($signrange)-1;
		if ($i < 1) return null;
		($i < 4) ? $k = $this->getRandom($i) : $k = 0;
		for ($x = 0; $x < $this->getLength(); $x++) {
			switch($signrange[$k]) {
				case 1:
					$password[] = $alphaUpper[shuffle($alphaUpper)];
					break;
				case 2:
					$password[] = $alphaLower[shuffle($alphaLower)];
					break; 
				case 3:
					$password[] = $numbers[shuffle($numbers)];
					break;
				case 4:
					$password[] = $specials[shuffle($specials)];
			}
			($k < $i) ? $k++ : $k = 0;
		}
		shuffle($password);
		return implode($password);
	}
	
	private function setDefault($args = array()) {
		(isset($args[0])) ? $this->setLength($args[0]) : $this->setLength(8);
		(isset($args[1])) ? $this->setUpperFlag($args[1]) : $this->setUpperFlag(true);
		(isset($args[2])) ? $this->setLowerFlag($args[2]) : $this->setLowerFlag(true);
		(isset($args[3])) ? $this->setNumberFlag($args[3]) : $this->setNumberFlag(true);
		(isset($args[4])) ? $this->setSpecialFlag($args[4]) : $this->setSpecialFlag(true);
	}
	
	private function setUpperFlag($flag)
	{
		if (is_bool($flag)) {
			$this->_include_upper = $flag;
		}
	}
	
	private function setLowerFlag($flag)
	{
		if (is_bool($flag)) {
			$this->_include_lower = $flag;
		}
	}
	
	private function setNumberFlag($flag)
	{
		if (is_bool($flag)) {
			$this->_include_numbers = $flag;
		}
	}
	
	private function setSpecialFlag($flag)
	{
		if (is_bool($flag)) {
			$this->_include_specials = $flag;
		}
	}
	
	private function setLength($length)
	{
		if (is_int($length)) {
			$this->_length = $length;
		}
	}
	
	private function getRandom($max) {
		srand($this->make_seed());
		return rand(1,$max);
	}
	
	private function make_seed()
	{
		list ($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	
	private function getDefaults() {
		$ar = array(
			'length' => $this->getLength(),
			'include_lower' => $this->getLowerFlag(),
			'include_upper' => $this->getUpperFlag(),
			'include_numbers' => $this->getNumberFlag(),
			'include_specials' => $this->getSpecialFlag()
		);
		return $ar;
	}
	
	private function getLength() {
		return $this->_length;
	}
	
	private function getLowerFlag() {
		return $this->_include_lower;
	}
	
	private function getUpperFlag() {
		return $this->_include_upper;
	}
	
	private function getNumberFlag() {
		return $this->_include_numbers;
	}
	
	private function getSpecialFlag() {
		return $this->_include_specials;
	}
}

?>