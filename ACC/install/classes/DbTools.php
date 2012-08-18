<?php
/*
 * Project		ACC
 * Filename		DbTools.php
 * Author		Steffen Haase
 * Date			22.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';

class DbTools
{
	private $_create_tables;
	private $_add_columns;
	private $_table_data;
	private $_db;
	private static $_instance;
	
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
		
	private function __construct() {
		include ACC_PATH_SERVER.'install/include/querys.php';
		$this->setTableArray($sql_tables);
		$this->setColumnArray($sql_columns);
		$this->setDataArray($sql_table_data);
		$this->_db = DBConnect::getInstance();
	}
	
	public function createTables() {
		$tables = $this->getTableArray();
		foreach ($tables as $key) {
			$query = str_replace(
				'{PREFIX}', 
				ACC_DB_PREF, 
				$key
			);
			$dummy = $this->_db->executeQuery($query, 'DbTools.php');
		}
	}
	
	public function addColumns() {
		$columns = $this->getColumnArray();
		foreach ($columns as $key) {
			$query = str_replace(
				'{PREFIX}', 
				ACC_DB_PREF, 
				$key
			);
			$dummy = $this->_db->executeQuery($query, 'DbTools.php');
		}
	}
	
	public function insertData () {
		$data = $this->getDataArray();
		foreach ($data as $key) {
			$query = str_replace(
						'{PREFIX}', 
			ACC_DB_PREF,
			$key
			);
			$dummy = $this->_db->executeQuery($query, 'DbTools.php');
		}
	}
	
	private function getTableArray() {
		return $this->_create_tables;
	}
	
	private function getColumnArray() {
		return $this->_add_columns;
	}
	
	private function getDataArray() {
		return $this->_table_data;
	}
	
	private function setTableArray($ar) {
		$this->_create_tables = $ar;
	}
	
	private function setColumnArray($ar) {
		$this->_add_columns = $ar;
	}
	
	private function setDataArray($ar) {
		$this->_table_data = $ar;
	}
}

?>