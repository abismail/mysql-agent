<?php
abstract class Connect{
	//private $pwd = "";
	protected $unm = "root";
	protected $tableName;
	private $result;
	private $columnTypes = array();
	function setTableName($str){
		$this->tableName = $str;
	}
	
	protected function displayResults($result){//done
		//$rows = ;
		$cnames = $this::getColumnNames();
		$display = "";
		while($row = mysql_fetch_array($result)){
			$display = "";
			print "this is the value of row, while fetching a real array $row";
			foreach($cnames as $c){
				$display = $display . $row[$c] . "    ";
			}
			$display = $display . "<br/>";
			print "row: " . $display;
		}
	}
	
	function executeQuery(){
		/**if(@mysql_connect("localhost"))
		{*/
			//print "connexion is possible<br/><br/>";
			//attempting to establish a connection
			$con = mysql_connect("localhost:3306", $this->unm, "");
			if (!$con){
			  die('Could not connect: ' . mysql_error() . "<br/><br/>");
			}else{
				//print "connection established successfully<br/><br/>";
				if(mysql_select_db("my_db", $con)){
				//selecting db in which to execute query
					//print "DB successfully selected <br/><br/>";
				}else{
					print "something went wrong selecting the db in which to execute the query: " . mysql_error() . "<br/><br/>";
				}
			
			//print "executing query from class: " . $this . "<br/><br/>";
			//retrieving the query from the querybuilder
			$sql = $this->buildQuery();
			//print "printing substr: " . substr($sql, 0, 6);
			if(substr($sql, 0, 6) == "update" or substr($sql, 0, 6) == "INSERT"){
				$con = mysql_connect("localhost:3306", $this->unm, "");
				mysql_select_db("my_db", $con);}
			//print "$sql<br/><br/>";*/
			//executingQuery
			if(mysql_query($sql,$con)){
				(substr($sql, 0, 6) == "select") ? $this->result = mysql_query($sql,$con) : $this->result = mysql_query("SELECT * FROM COMPANY",$con);}
			else{ echo "Error executing query: " . mysql_error() . "<br/><br/>";}
			//closing the DB connection*/
			//print "connexion: <b>". $con . "</b>";
			mysql_close($con);
			}
		/**}else{
			print "a connexion is not possible @the moment<br/><br/>" . mysql_error() . "<br/><br/>";
		}*/
		return $this->result;
	}
	
	function getColumnNames(){
		$con1 = mysql_connect("localhost:3306", $this->unm, "");
		mysql_select_db("my_db");
		$qColumnNames = mysql_query("SHOW COLUMNS FROM " . $this->tableName);
		$numColumns = mysql_num_rows($qColumnNames);
		$x = 0;
		while ($x < $numColumns)
		{
		    $colname = mysql_fetch_row($qColumnNames);
		    $col[$x] = $colname[0];
	   	    $x++;
		}
		mysql_free_result($qColumnNames);
		$result = mysql_query("select * from " . $this->tableName);
		for($c = 0; $c < count($col); $c++){
			$this->columnTypes[$c] = mysql_field_type($result, $c);
		}
		mysql_close($con1);
		return $col;
	}
	
	function getColumnTypes(){//returns an array with the columnTypes of the last query for which the columnNames was requested
		return $this->columnTypes;
	}
	
	protected function getResults(){
		$cnames = $this::getColumnNames();
		$returnArray = array(array(0), array(0));
		$record[0] = array(0);
		$y = 0;
		$con = mysql_connect("localhost:3306", $this->unm, "");
		mysql_select_db("my_db");
		//print "inside getResults, b4 while";
		$this->result = mysql_query($this::buildQuery());
		while($row = mysql_fetch_array($this->result)){
		//print $row; //problem here with t_string kak
		for($c = 0; $c < count($row) / 2; $c++){
			//print "printing indexes: " . $c . "<br/>";
			$record[$c] = $row[$c];
		}
			//testing something
			/**for($c = 0; $c < count($record); $c++){
				"$record[0]";}*/
			$returnArray[$y] = $record;
			$y++;
			$record[0] = array(0);
		}
		//print "error is: " . mysql_error() . "<br/>";
		mysql_close($con);
		//print "printing first element of multidim array: " . $returnArray[2] . "<br/><br/>";
		//print_r($returnArray);
		//print "prnt array inside connect: " . $returnArray . "<br/>";
		return $returnArray;
	}
	
	
		
		
		/**$cnames = $this::getColumnNames();
		$display = "";
		while($row = mysql_fetch_array($result)){
			$display = "";
			foreach($cnames as $c){
				$display = $display . $row[$c] . "    ";
			}
			$display = $display . "<br/>";
			print "row: " . $display;
		}*/
	
	protected abstract function buildQuery();//done
	/**{
		return "INSERT INTO COMPANY VALUES(00001, 'company1_dot_name', 0215896541, 'null1');";
	}*/

}
?>
