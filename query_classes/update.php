<?php
require_once('connect.php');
require_once('select_all.php');
require_once('insert.php');
require_once('delete.php');
class Update extends Connect{
	private $valueArray;
	//private $s;
	//overloaded constructor, used to set the name of the table with which we are working
	//and the array of new elements to insert
	function __construct($array, $tabName){
		$this->valueArray = $array;
		parent::setTableName($tabName);
		parent::executeQuery();
		//$this->s = new SelectAll($tabName);
		//print "printing the select all string thing: " . $this->s.buildQuery() . "<br/><br/>";
		
		//parent::executeQuery();
		//parent::displayResults($this->s.getAllQuery());*/
		/**$i = new Delete($this->valueArray[0], $this->tableName);
		$i = new Insert($this->valueArray, $this->tableName);*/
	}
	
	//building the string that will become the ultimate query
	function buildQuery(){
		//print "executing ::" . $this::constructValueString() . "<br/><br/>";
		return $this::constructValueString();
	}
	
	//constructing a string for the values of each column in the array
	function constructValueString(){
		$update = "update " . $this->tableName . " ";
		$columnNames = parent::getColumnNames();
		if(count($this->valueArray) != count($columnNames)){
			die("the number of specified elements, do not match the number of elements in the table");}else{
			for($c = 0; $c < count($columnNames); $c++) {
				if($c == 0) {
					$update = $update . " set " . $columnNames[$c] . " = " . $this->valueArray[$c];
				}else{
					$update = $update . $columnNames[$c] . " = " . $this->valueArray[$c];
				}

				if($columnNames[$c] != $columnNames[count($columnNames) - 1]){
					$update = $update . ", ";
				}
			}
		}
		$update = $update . " where " . strtolower($this->tableName) . "_id = " . $this->valueArray[0] . ";";
		
		return $update;//$this->update;
	}
	
	function __toString(){
		return "update";
	}
}
?>
