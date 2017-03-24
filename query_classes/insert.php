<?php
require_once('connect.php');
class Insert extends Connect{
	private $valueArray;
	
	//overloaded constructor, used to set the name of the table with which we are working
	//and the array of new elements to insert
	function __construct($array, $tabName){
		//print_r($array);
		//print "constr<br/>";
		$this->valueArray = $array;
		parent::setTableName($tabName);
		parent::executeQuery();
		//parent::displayResults();
	}
	
	//building the string that will become the ultimate query
	function buildQuery(){
		//print "executing ::" . "INSERT INTO " . $this->tableName . "( " . $this::getTableStructure() . ") VALUES( " . $this::constructValueString() . ");<br/><br/>";
		return "INSERT INTO " . $this->tableName . "( " . $this::getTableStructure() . ") VALUES( " . $this::constructValueString() . ");";
		//return $this::constructValueString();
	}
	
	//constrcuting a string for the values of each column in the array
	function constructValueString(){
		$tmpstr = "";
		//print_r($this->valueArray);
		$this->tmpstr = $this->valueArray[0];
		$cnt = 0;
		foreach ($this->valueArray as $c){
			if($cnt == 0){
				$cnt++;
				continue;
			}
			$this->tmpstr = $this->tmpstr . ", $c";
			//print "we're now: " . $this->tmpstr . "<br/>";
		}
		//print "here: " . $this->tmpstr . "<----";
		//print "method<br/>";
		return $this->tmpstr;
	}
	
	function getTableStructure(){
		$columnNames = parent::getColumnNames();
		$tabStruct = "";
		foreach($columnNames as $c){
			if($c != $columnNames[0]){
				if($c == $columnNames[1]){
					$this->tabStruct = $c;
				}else/**if($c != $this->columnNames[count($this->columnNames) - 1])*/{
					$this->tabStruct = $this->tabStruct . ", " . $c;}
			}
		}
		return $this->tabStruct;
	}
	
	function __toString(){
		return "insert";
	}
}
?>
