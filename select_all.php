<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('connect.php');
class SelectAll extends Connect{
	private $s;
	private $fieldName = "";
	private $fieldValue = "";
	//overloaded constructor, used to set the name of the table with which we are working
	//and the array of new elements to insert
	function __construct($tabName){
		if(count($tabName) == 1){
			parent::setTableName($tabName);
			/**$this->s = */parent::executeQuery();
			//parent::displayResults($this->s);
		}else{
			$this->fieldName = $tabName["fieldName"];
			$this->fieldValue = $tabName["fieldValue"];
			parent::setTableName($tabName["tabName"]);
			$this->s = parent::executeQuery();
			//parent::displayResults($this->s);
			}
	}
	
	//building the string that will become the ultimate query
	function buildQuery(){
		$r = ($this->fieldName == "") ? "SELECT * FROM " . $this->tableName . ";" : "SELECT * FROM " . $this->tableName . " WHERE " . $this->fieldName . " = " . $this->fieldValue . ";";
		//print "executing $r <br/>";
		return $r;
	}
	
	function getResults(){
		$results = parent::getResults();
		$editedResults = array();
		//print "attempting to print first hidden: " . $results[0][count(parent::getColumnNames()) - 1] . "<br/>";
		$y = 0;
		foreach($results as $row){
			/**if($row[count(parent::getColumnNames()) - 1] == ""){
				continue;}*/
			//print "printing: " . $row[count(parent::getColumnNames()) - 1] . "<br/>";
			if($row[count(parent::getColumnNames()) - 1] == 1){continue;}else{
				$editedResults[$y] = $row;
				$y++;}
		}
		
		//truncating the hidden fields of each row
		$c = 0;
		foreach($editedResults as $row){
			$editedResults[$c] = array_slice($row, 0, -1);
			$c++;
		}
		return $editedResults;
	}
	
	function getAllResults(){
		 return parent::getResults();
	}
	
	/**public function getResults($fieldName, $fieldValue){
		$this->fieldName = $fieldName;
		$this->fieldValue = $fieldValue;
		return parent::getResults();
	}*///fic this operator overloading kak!!
	
	function setFieldName($newFieldName){
		$this->fieldName = $newFieldName;
	}
	
	function setFieldValue($newFieldValue){
		$this->fieldValue = $newFieldValue;
	}
	
	function getFieldValue(){
		return $this->fieldValue;
	}
	
	function getFieldName(){
		return $this->fieldName;
	}
	
	function getColumnNames(){
		return array_slice(parent::getColumnNames(), 0, -1);
	}
	
	function getAllColumnNames(){
		return parent::getColumnNames();
	}
	
	function getColumnTypes(){
		return parent::getColumnTypes();
	}
	
	function __toString(){
		return "selct_all";
	}
}
?>
