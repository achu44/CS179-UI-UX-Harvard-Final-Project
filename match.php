<?
        session_start(); //starting php session
        include 'constants.php';

        $link = mysql_connect($dbHost,$dbUsername,$dbPass)
    	or die("Could not connect: " . mysql_error());

    	// select our database
    	mysql_select_db("$dbName") or die(mysql_error());


        // SAVING THE ITEMS INTO A PHP ARRAY BY TYPE
        
        //init arrays
        $accessories = array();
        $dresses = array();
        $pants = array();
        $shoes = array();
        $skirts = array();
        $tops = array();
        

		// populate accessories
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='accessories'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$accessories[$i] = $row;
            $i=$i+1;
		}
		
		// populate dresses
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='dresses'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$dresses[$i] = $row;
            $i=$i+1;
		}
		
		// populate pants
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='pants'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$pants[$i] = $row;
            $i=$i+1;
		}
		
		// populate shoes
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='shoes'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$shoes[$i] = $row;
            $i=$i+1;
		}

        // populate skirts
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='skirts'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$skirts[$i] = $row;
            $i=$i+1;
		}
		
		// populate tops
		$sql = "SELECT `item_id`,`type` FROM `items_tbl` WHERE type='tops'";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());

        $i = 1;
        while ($row = mysql_fetch_array($result))
        {
        	$tops[$i] = $row;
            $i=$i+1;
		}

?>

<!DOCTYPE html>

<html>

<head>
	<link rel="apple-touch-icon" href="custom_icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name= "viewport" content= "width=device-width, initial-scale=1">

    <title>dresscode. match</title>
	

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" />
    <link rel="stylesheet" href="themes/sandy.min.css" />

	<script type="text/javascript" src = "iosslider/jquery-1.4.min.js"></script>
    <script type="text/javascript" src = "iosslider/jquery.easing-1.3.js"></script>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>

    <script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog2.min.js"></script>
	<script type="text/javascript" src = "iosslider/jquery.iosslider.js"></script>

	<!-- META -->
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, minimum-scale=1, maximum-scale=1">
    <meta name = "apple-mobile-web-app-capable" content = "yes" />

    <style type="text/css">
    	.fluidHeight {
    		position: relative;
        	width: 100%;
        	height: 300px;
		}

        /*
        * below 900px, switch to percentage based responsive height.
        * padding of 33.333% is calculated by using the
        * image ratio 300px/900px = .333 * 100% = 33.333%
        */
        @media screen and (max-width: 900px) {

        	.fluidHeight {
            	height: 0;
                padding: 0 0 33.333% 0;
			}

		}

        .sliderContainer {
        	position: absolute;
            width: 100%;
            height: 100%;
		}

        .iosSlider {
        	width: 100%;
            height: 100%;
            background: #aaa;
		}

        .iosSlider .slider {
        	width: 100%;
            height: 100%;
		}

        .iosSlider .slider .item {
        	position: relative;
            top: 0;
            left: 0;
			max-width: 120px;
            width: 100%;
            height: 100%;
            background: #ebcab8;
		}

        .iosSlider .slider .item img {
        	position: relative;
            top: 0;
            left: 0;
            max-width: 120px;
            width: 100%;
            margin: 0 auto;
            opacity: 0.4;
		}
	</style>

	
	

    <script type="text/javascript">

    $(document).ready(function() {
    
    	// ACCESSORIES SLIDER
	    $('#iosSliderAccessories').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionAccessories,
	        onSliderLoaded: changeSlideFunctionAccessories
		});
                                
        //on initial load change item id value to 0
        document.getElementById("accessories_item_id").value=0;


		function changeSlideFunctionAccessories(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
			document.getElementById("accessories_item_id").value=arrAccessories[slideNumber].item_id;
                        
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^accessory/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}			

			}	

            var currentAccessoryElementId = "accessory"+arrAccessories[slideNumber].item_id;
            var currentAccessory = document.getElementById(currentAccessoryElementId);
            currentAccessory.style.opacity = 1;
            currentAccessory.style.border="3px solid #fa3113"; 
		}
    	
    	
    	
    	// DRESSES SLIDER
	    $('#iosSliderDresses').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionDresses,
	        onSliderLoaded: changeSlideFunctionDresses
		});
                                
        //on initial load change item id value to 0
        document.getElementById("dresses_item_id").value=0;


		function changeSlideFunctionDresses(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
			document.getElementById("dresses_item_id").value=arrDresses[slideNumber].item_id;
            
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^dress/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}		

			}	

            var currentDressElementId = "dress"+arrDresses[slideNumber].item_id;
            var currentDress = document.getElementById(currentDressElementId);
            currentDress.style.opacity = 1;
            currentDress.style.border="3px solid #fa3113";
		}
    	
    	
    	
    	// PANTS SLIDER
	    $('#iosSliderPants').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionPants,
	        onSliderLoaded: changeSlideFunctionPants
		});
                                
        //on initial load change item id value to 0
        document.getElementById("pants_item_id").value=0;


		function changeSlideFunctionPants(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
            document.getElementById("pants_item_id").value=arrPants[slideNumber].item_id;
            
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^pant/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}		

			}	

            var currentPantElementId = "pant"+arrPants[slideNumber].item_id;
            var currentPant = document.getElementById(currentPantElementId);
            currentPant.style.opacity = 1;
            currentPant.style.border="3px solid #fa3113";
            
		}
    	
    	
    	
    	// SHOES SLIDER
	    $('#iosSliderShoes').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionShoes,
	        onSliderLoaded: changeSlideFunctionShoes
		});
                                
        //on initial load change item id value to 0
        document.getElementById("shoes_item_id").value=0;


		function changeSlideFunctionShoes(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
            document.getElementById("shoes_item_id").value=arrShoes[slideNumber].item_id;
            
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^shoe/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}		

			}	

            var currentShoeElementId = "shoe"+arrShoes[slideNumber].item_id;
            var currentShoe = document.getElementById(currentShoeElementId);
            currentShoe.style.opacity = 1;
            currentShoe.style.border="3px solid #fa3113";
		}
		
		
		// SKIRTS SLIDER
	    $('#iosSliderSkirts').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionSkirts,
	        onSliderLoaded: changeSlideFunctionSkirts
		});
                                
        //on initial load change item id value to 0
        document.getElementById("skirts_item_id").value=0;


		function changeSlideFunctionSkirts(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
			//document.getElementById("changetxtSkirts").innerHTML= "skirts slide: "+ slideNumber + " item_id: " + arrSkirts[slideNumber].item_id ;
            document.getElementById("skirts_item_id").value=arrSkirts[slideNumber].item_id;
            
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^skirt/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}			

			}	

            var currentSkirtElementId = "skirt"+arrSkirts[slideNumber].item_id;
            var currentSkirt = document.getElementById(currentSkirtElementId);
            currentSkirt.style.opacity = 1;
            currentSkirt.style.border="3px solid #fa3113";
		}
		
		
		
		// TOPS SLIDER
	    $('#iosSliderTops').iosSlider({
    		snapToChildren: true,
        	desktopClickDrag: true,
	        infiniteSlider: true,
    	    snapSlideCenter: true,
        	onSlideChange: changeSlideFunctionTops,
	        onSliderLoaded: changeSlideFunctionTops
		});
                                
        //on initial load change item id value to 0
        document.getElementById("tops_item_id").value=0;


		function changeSlideFunctionTops(args) 
        {
        	var slideNumber = (args.currentSlideNumber);
			//document.getElementById("changetxtTops").innerHTML= "tops slide: "+ slideNumber + " item_id: " + arrTops[slideNumber].item_id ;
            document.getElementById("tops_item_id").value=arrTops[slideNumber].item_id;
            
            // update CSS of images			
			var images = document.getElementsByTagName('img');
			for (i = 0; i < images.length;i++ ) {
    			if (/^top/.test(images[i].id)) {
    				images[i].style.opacity = 0.4;
    				images[i].style.border="none";	
    			}	
			}
				

            var currentTopElementId = "top"+arrTops[slideNumber].item_id;
            var currentTop = document.getElementById(currentTopElementId);
            currentTop.style.opacity = 1;
            currentTop.style.border="6px solid #fa3113";	
            	
		}
		

		// CLOSE ALL SLIDERS ON LOAD
        jQuery('#accessories').toggle('show');
        jQuery('#dresses').toggle('show');
        jQuery('#pants').toggle('show');
        jQuery('#shoes').toggle('show');
        jQuery('#skirts').toggle('show');
        jQuery('#tops').toggle('show');
                

	});
        $(document).delegate('#opendialog', 'click', function(){
        
        		var htmlString = "<center>";
        		
        		if (document.getElementById("tops_item_id").value+document.getElementById("dresses_item_id").value+document.getElementById("skirts_item_id").value+document.getElementById("pants_item_id").value+document.getElementById("shoes_item_id").value+document.getElementById("accessories_item_id").value>0)
        		{
        		
        		
        			if (document.getElementById("tops_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("tops_item_id").value+"' height='50'>";
        		
        			if (document.getElementById("dresses_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("dresses_item_id").value+"' height='50'>";
        		
        			if (document.getElementById("skirts_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("skirts_item_id").value+"' height='50'>";
        		
        			if (document.getElementById("pants_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("pants_item_id").value+"' height='50'>";
        		
        			if (document.getElementById("shoes_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("shoes_item_id").value+"' height='50'>";
        		
        			if (document.getElementById("accessories_item_id").value>0)
        				htmlString = htmlString+"<br><img style='transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);' src='img_display.php?id="+document.getElementById("accessories_item_id").value+"' height='50'>";
        		}
        		else
        			htmlString = htmlString+"<p>No items chosen.</p>";
        		
				$('<div>').simpledialog2({
	    			mode: 'blank',
    				headerText: 'Preview',
    				width: 200,
    				headerClose: true,
    				blankContent : htmlString+"<br><br><br></center>"
					
		  		});
			});

	jQuery(document).ready(function(){
    	
    	jQuery('#hideshowAccessories').live('click', function(event) {
        	jQuery('#accessories').toggle('show');
                                
            if (document.getElementById("accessories_item_id").value!=0) {
            	document.getElementById("accessories_item_id").value=0;
            	document.getElementById("hideshowAccessories").style.background="none";

            }else {                	
				var  currentSlide = $('#iosSliderShoes').data('args').currentSlideNumber;
                document.getElementById("accessories_item_id").value=arrAccessories[currentSlide].item_id;

			}
		});
    	
    	jQuery('#hideshowDresses').live('click', function(event) {
        	jQuery('#dresses').toggle('show');
                                
            if (document.getElementById("dresses_item_id").value!=0) {
            	document.getElementById("dresses_item_id").value=0;
            	document.getElementById("hideshowDresses").style.background="none";

            }else {                	
				var  currentSlide = $('#iosSliderDresses').data('args').currentSlideNumber;
                document.getElementById("dresses_item_id").value=arrDresses[currentSlide].item_id;
			    document.getElementById("hideshowDresses").style.background="#EE82EE";

			}
		});
        
        jQuery('#hideshowPants').live('click', function(event) {
        	jQuery('#pants').toggle('show');
                                
            if (document.getElementById("pants_item_id").value!=0) {
            	document.getElementById("pants_item_id").value=0;
            	document.getElementById("hideshowPants").style.background="none";

            }else {                	
				var  currentSlide = $('#iosSliderPants').data('args').currentSlideNumber;
                document.getElementById("pants_item_id").value=arrPants[currentSlide].item_id;
			    document.getElementById("hideshowPants").style.background="#EE82EE";
			}
		});
        
        jQuery('#hideshowShoes').live('click', function(event) {
        	jQuery('#shoes').toggle('show');
                     
            if (document.getElementById("shoes_item_id").value!=0) {
            	document.getElementById("shoes_item_id").value=0;
            	document.getElementById("hideshowShoes").style.background="none";

            }else {                	
				var  currentSlide = $('#iosSliderShoes').data('args').currentSlideNumber;    
                document.getElementById("shoes_item_id").value=arrShoes[currentSlide].item_id;
			    document.getElementById("hideshowShoes").style.background="#EE82EE";

			}
		});
        
        jQuery('#hideshowSkirts').live('click', function(event) {
        	jQuery('#skirts').toggle('show');
                                
            if (document.getElementById("skirts_item_id").value!=0) {
            	document.getElementById("skirts_item_id").value=0;
            	document.getElementById("hideshowSkirts").style.background="none";

            }else {                	
				var  currentSlide = $('#iosSliderSkirts').data('args').currentSlideNumber;
                document.getElementById("skirts_item_id").value=arrSkirts[currentSlide].item_id;
            	document.getElementById("hideshowSkirts").style.background="#EE82EE";
			
			}
		});
		
		
         jQuery('#hideshowTops').live('click', function(event) {
        	jQuery('#tops').toggle('show');
                                
            if (document.getElementById("tops_item_id").value!=0) {
            	document.getElementById("tops_item_id").value=0;
            	document.getElementById("hideshowTops").style.background="none";
            }else {                	
				var  currentSlide = $('#iosSliderTops').data('args').currentSlideNumber;
                document.getElementById("tops_item_id").value=arrTops[currentSlide].item_id;

			}
		});
        
	});
         
    </script>
</head>

<body>

        <div data-role="page" id="match" data-theme="a">

        <script>
        	var arrAccessories = eval('(<?php echo json_encode($accessories); ?>)');
			var arrDresses = eval('(<?php echo json_encode($dresses); ?>)');
			var arrPants = eval('(<?php echo json_encode($pants); ?>)');
        	var arrShoes = eval('(<?php echo json_encode($shoes); ?>)');
        	var arrSkirts = eval('(<?php echo json_encode($skirts); ?>)');
        	var arrTops = eval('(<?php echo json_encode($tops); ?>)');
        </script>

                <div data-role="header" data-theme="a" data-add-back-btn="true" data-position="fixed">
                	<a data-rel="back" data-role="button" data-icon="back" data-iconpos="notext"></a>
                    <h1><img src="assets/icon-hanger-white.png" class="ui-li-icon"> dresscode.</h1>
                    <a href="#" id="opendialog" data-role="button" data-theme="a" align="right" style="float:right">Preview</a>
                </div>
                

                <div data-role="content">
                </div>
                <!--
                <div id="changetxtTops"> </div>
                <div id="changetxtShoes"> </div>
					
                <br>
                -->


                <!--tops-->
                <input type='button' id='hideshowTops' value='Tops'  data-theme="a" />

                <div class = 'fluidHeight' id='tops''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderTops'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($tops as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="top'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- tops -->
                
                
                <!--dresses-->
                <input type='button' id='hideshowDresses' value='Dresses' data-theme="a">

                <div class = 'fluidHeight' id='dresses''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderDresses'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($dresses as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="dress'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- dresses -->
                
                 <!--skirts-->
                <input type='button' id='hideshowSkirts' value='Skirts' data-theme="a">

                <div class = 'fluidHeight' id='skirts''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderSkirts'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($skirts as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="skirt'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- skirts -->
                
                 <!--pants-->
                <input type='button' id='hideshowPants' value='Pants' data-theme="a">

                <div class = 'fluidHeight' id='pants''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderPants'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($pants as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="pant'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- pants -->

                <!--shoes-->
                <input type='button' id='hideshowShoes' value='Shoes' data-theme="a">

                <div class = 'fluidHeight' id='shoes''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderShoes'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($shoes as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="shoe'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- shoes -->
                
                <!--accessories-->
                <input type='button' id='hideshowAccessories' value='Accessories' data-theme="a">

                <div class = 'fluidHeight' id='accessories''>

                        <div class = 'sliderContainer'>

                                <div class = 'iosSlider' id='iosSliderAccessories'>

                                        <div class = 'slider'>

                                        <?
                                                foreach ($accessories as $i => $row)
                                                {
                                                        echo "<div class = 'item'>";
                                                        echo "<a href='view_item.php?id=".$row['item_id']."'>";
                                                        echo ('<img style="transform:rotate(90deg); -ms-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id='.$row['item_id'].'" height="100%" id="accessory'.$row['item_id'].'">');
                                                        echo "</a>";
                                                        echo "</div>";
                                                }
                                        ?>

                                        </div>

                                </div>

                        </div>

                </div> <!-- accessories -->
                                
                <!-- input form-->
                <form id='match-input' action='save_outfit.php' method='post' data-ajax='false' data-theme="a">
                	<input type='hidden' id='accessories_item_id' name='accessories_item_id' value='0'/>
                	<input type='hidden' id='dresses_item_id' name='dresses_item_id' value='0'/>
                	<input type='hidden' id='pants_item_id' name='pants_item_id' value='0'/>
                	<input type='hidden' id='shoes_item_id' name='shoes_item_id' value='0'/>
                	<input type='hidden' id='skirts_item_id' name='skirts_item_id' value='0'/>
                	<input type='hidden' id='tops_item_id' name='tops_item_id' value='0'/>
                	<input type='text' id='outfit_name' name='outfit_name' value='' placeholder='Name your outfit'/>
                	<input type='submit' value='Match outfit' data-theme="b"/>
                </form>

        </body>

        </div>
</body>
</html>