<?php
require_once('select_all.php');
require_once('insert.php');
require_once('update.php');
require_once('delete.php');
	class DatabaseAccessor{
		private $tableName;
		private $columnNames = array();
		private $columnTypes = array();
		
		function __construct($tableName){
			$this->tableName = $tableName;
		}
		
		function getCurrentTableName(){
			return $this->tableName;
		}
		
		function changeCurrentTable($tableName){
			$this->tableName = $tableName;
		}
		
		function deleteRecord($currentRecordArray){
			$currentRecordArray[count($currentRecordArray)] = "1";
			$exec = new Update( $currentRecordArray, $tableName);
		}
		
		function unDeleteRecord($currentRecordArray){
			$currentRecordArray[count($currentRecordArray)] = "0";
			$exec = new Update( $currentRecordArray, $tableName);
		}
		
		function getAllRecords(){
			$data = new SelectAll(array("tabName" => $this->tableName, "fieldName" => "1", "fieldValue" => "1"));
			//get multi-dimensional array of contents from "$this->tableName"
			return $data->getResults();
		}
		
		//the parameter should be declared as: array("columnName" => "?") or array("columnName" => "?", "parameter" => "value that should be satisfied")
		//or array("parameter" => "value that should be satisfied by the data in the existing field")
		//yielding:
		/**
			parameter: all records that satisfy this parameter
			columnName: all data within the table, that falls under this column
			columnName and parameter: all data in the column, from records satisfying the parameter
		*/
		function getRecords($columnParameterArray){
			
		}
		
		function getColumnNames(){
			$table = new SelectAll(array($this->tableName));
			$this->columnNames = $table->getColumnNames();
			$this->columnTypes = $table->getColumnTypes();
			return $this->columnNames;
		}
		
		function getColumnType($columnName){
			private $columnType = "";
			for($c = 0; $c < count($this->columnNames); $c++){
				if($this->columnNames[$c] == $columnName){
					$columnType = $this->columnTypes[$c];
					break;
				}
			}
			if($columnType == ""){
				die("the columnName for which you are requesting a type, does not exist in this table<br/>please supply a valid column name");
			}
			return $columnType;
		}
		
		function getColumnTypes(){
			return $this->columnTypes;
		}
		
		/**
		 * [description]
		 */
		function insertRecord($data) {}
	}
?>
