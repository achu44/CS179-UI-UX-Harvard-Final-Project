<?
        session_start(); //starting php session
        include 'constants.php';
        
        $link = mysql_connect($dbHost,$dbUsername,$dbPass)
   		or die("Could not connect: " . mysql_error());

    	// select our database
	    mysql_select_db("$dbName") or die(mysql_error());
    
    	//connect to the db
	    $link = mysql_connect($dbHost,$dbUsername,$dbPass)
    	or die("Could not connect: " . mysql_error());
    	
    	
    	// get variables from POST
		$outfit_name = $_POST['outfit_name'];
		$accessories_id = $_POST['accessories_item_id'];
		$dresses_id = $_POST['dresses_item_id'];
		$pants_id = $_POST['pants_item_id'];
		$shoes_id = $_POST['shoes_item_id'];
		$skirts_id = $_POST['skirts_item_id'];
		$tops_id = $_POST['tops_item_id'];
		
		
		$sql = "INSERT INTO `outfits_tbl` (`outfit_name`, `accessories_item_id`, `dresses_item_id`, `pants_item_id`, `shoes_item_id`, `skirts_item_id`, `tops_item_id`) VALUES ('".$outfit_name."', '".$accessories_id."', '".$dresses_id."', '".$pants_id."', '".$shoes_id."', '".$skirts_id."', '".$tops_id."')";
		mysql_query("$sql");
		
		//get the last saved outfit (this outfit)'s id
		$last_query = mysql_query("SELECT MAX(outfit_id) AS max FROM outfits_tbl");
        $last_row = mysql_fetch_array($last_query);
        $last_outfit_id = $last_row['max'];
		
		//redirect to outfit view
     	header("Location: view_outfit.php?id=".$last_outfit_id);
?>

