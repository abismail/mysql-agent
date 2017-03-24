<?php
	//use the POST method to test the functionality of this at a later stage
	//with fields [in a form] with the action calling this file
	require_once('insert.php');
	require_once('update.php');
	/**require_once('delete.php');
	require_once('select_all.php');*/
	
	
	print "<br/><br/>now done executing select_all, doing insert. . . . <br/><br/>";
	//when inserting, specify the value of all fields (including 'hidden') other than the '~_id' field
    //NB: when specifying string values, enclose them in quotes within the quotation
    //try{
    	$subclass = new Insert(array("985.40", "'fake tan'", "0"), "AMENITY");
    /**}catch(Exception){
        print "an error has occured: " . Exception;
    }  */
	
	/**print "<br/><br/>now done executing insert, doing delete. . . . <br/><br/>";
    //NB: when performing a delete, only the record_is value and the table name need to be specified
	$subclass = new Delete('4', "COMPANY");*/
	print "<br/><br/>now done executing delete, doing update. . . . <br/><br/>";
    //NB: when performing an update, ALL field values need to be specified
	$subclass = new Update(array('1', "405.21", "'massage'", "0"), "AMENITY");
	/**print "<br/><br/>now done executing update. . . .magwerk!<br/><br/>";
	$subclass = new SelectAll(array("tabName" => "COMPANY", "fieldName" => "email", "fieldValue" => "'shu@mymag.wilwerk'"));
	print_r($subclass->getResults());
	$ar = $subclass->getResults();
	print "prnt array outside connect: " . $ar . "<br/><br/>";
	foreach ($ar as $values){
		foreach($values as $value){
		    print $value . "    ";}
		print "<br/>";
	}
	$ar = $subclass->getColumnNames();
	$ar = $subclass->getColumnTypes();
	foreach ($ar as $value){
		    print $value . "    ";
		print "<br/>";
	}
	//print "rec1: $ar <br/><br/>";
	print "declaring array<br/>";
	$d = array(array(0, 1, 2, 3, 4, 5), array(0, 1, 3, 2, 5));
	print "printing count : " . count($d) . "<br/>";
	print "printing a quote: \" ";
	/**if(array_key_exists('s', $d)){
		print "s exists";
	}else{
		print "you can check for an element, it doesn't bomb out";
	}*/
 
	/**require_once('select_all.php');
	$db = new SelectAll(array("tabName" => "USER", "fieldName" => "user_name", "fieldValue" => "'haksdfjgh'"));
	$data = $db->getResults();
	print "data len: " . count($data);
	foreach($data as $row){
		print_r($row);
	}*/
?>
