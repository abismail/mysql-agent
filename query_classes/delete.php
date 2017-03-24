<?php
require_once('connect.php');
class Delete extends Connect{
	private $id;
	
	//overloaded constructor, used to set the name of the table with which we are working
	//and the array of new elements to insert
	function __construct($id, $tabName){
		$this->id = $id;
		parent::setTableName($tabName);
		parent::executeQuery();
		//parent::displayResults();
	}
	
	//building the string that will become the ultimate query
	function buildQuery(){
		print "executing ::" . "DELETE FROM " . $this->tableName . " WHERE " . $this->tableName . "_id = " . $this->id . ";<br/><br/>";
		return "DELETE FROM " . $this->tableName . " WHERE " . strtolower($this->tableName) . "_id = " . $this->id . ";";
	}
	
	function __toString(){
		return "delete";
	}
}
?>
