<?php
	require_once('connect.php');
	require_once('select_all.php');
	class HideRecord extends Connect{
		/**$tabName = null;
		$hide = null;
		$recordId = null;*/
		function __construct(){
			$this->tabName = 0;
			$this->hide = 0;
			$this->recordId = 0;	
		}
		
		function hide($tabName, $recordId){
			$this->hide = 1;
			$this::setAll($tabName, $recordId);
			parent::executeQuery();
		}
		
		function unhide($tabName, $recordId){
			$this->hide = 0;
			$this::setAll($tabName, $recordId);
			parent::executeQuery();
		}
		
		function buildQuery(){
			$query = "update " . $this->tabName . " set hidden = " . $this->hide . " where " . $this->tabName . "_id = " . $this->recordId . ";";
			//print "$query<br/>";
			return $query;
		}
		
		function setAll($tabName, $recordId){
			$this->tabName = $tabName;
			$this->recordId = $recordId;
			parent::setTableName($this->tabName);
		}
	}
?>
