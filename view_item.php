<?
        session_start();
        include 'constants.php';
        $link = mysql_connect($dbHost,$dbUsername,$dbPass)
    or die("Could not connect: " . mysql_error());

    // select our database
    mysql_select_db("$dbName") or die(mysql_error());
    
    
    //determine item id from GET
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    	$item_id=$_GET['id'];
    	
    	//query db for item's attributes
    	$item_id_query = mysql_query("SELECT * FROM items_tbl WHERE `item_id` =".$item_id);
        $item_id_details = mysql_fetch_array($item_id_query);
        
        //parse tags and populate in array
        $arr_tags = explode(', ', $item_id_details['tags']);
        
    }
    
    
    // converting db fit attribute to numerical input 
    function fit2number($fit_string){
        switch ($fit_string){
                case 'loose':
                        return 1; break;
                case 'fit':
                        return 4; break;
                case 'tight':
                        return 5; break;
                case 'N/A':
                		return 3; break;
        }

    }

	// converting db formal attribute to numerical input
    function formal2number($formal_string){
        switch ($formal_string){
                case 'casual':
                        return 1; break;
                case 'business-casual':
                        return 2; break;
                case 'formal':
                        return 5; break;
                case 'semi-formal':
                		return 4; break;
                case 'N/A':
                		return 3; break;

    	}
    }
    
    // converting db weather attribute to numerical input
    function weather2number($weather_string){
        switch ($weather_string){
                case 'cold':
                        return 1; break;
                case 'warm':
                        return 3; break;
                case 'N/A':
                		return 2; break;

        }

    }
                                                
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	
	<head>
		
		
		<link rel="apple-touch-icon" href="custom_icon.png">
    	<meta name="apple-mobile-web-app-capable" content="yes">
    	<meta name="apple-mobile-web-app-status-bar-style" content="black">
    	<meta name= "viewport" content= "width=device-width, initial-scale=1">
    
    
    	<title>dresscode | closet | your items</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
		<link rel="stylesheet" href="themes/sandy.min.css" />
		
		<!-- dialog box libraries-->
		<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" />
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog2.min.js"></script>
		
		<!-- color picker libraries -->
		<script type="text/javascript" src="farbtastic12/farbtastic/farbtastic.js"></script>
		<link rel="stylesheet" href="farbtastic12/farbtastic/farbtastic.css" type="text/css" />
		
		<!-- name that color library-->
		<script type="text/javascript" src="http://chir.ag/projects/ntc/ntc.js"></script>
		
		<!-- hide the numeric input field of jquery mobil slider-->
		<style>
			.ui-mobile .ui-page .ui-slider-input,
			.ui-mobile .ui-dialog .ui-slider-input {
    			display : none;
			}
		</style>
		
		<!--custom theme from theme roller -->
		<style>
			.ui-bar-a{border:1px solid #fa3113 ;background:#fa3113 ;color:#ffffff ;font-weight:bold;text-shadow:0  0  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #fa3113 ),to( #fa3113 )); background-image:-webkit-linear-gradient( #fa3113,#fa3113 ); background-image:   -moz-linear-gradient( #fa3113,#fa3113 ); background-image:    -ms-linear-gradient( #fa3113,#fa3113 ); background-image:     -o-linear-gradient( #fa3113,#fa3113 ); background-image:        linear-gradient( #fa3113,#fa3113 );}.ui-bar-a .ui-link-inherit{color:#ffffff ;}.ui-bar-a a.ui-link{color:#7cc4e7 ;font-weight:bold;}.ui-bar-a a.ui-link:visited{   color:#2489ce ;}.ui-bar-a a.ui-link:hover{color:#2489ce ;}.ui-bar-a a.ui-link:active{color:#2489ce ;}.ui-bar-a,.ui-bar-a input,.ui-bar-a select,.ui-bar-a textarea,.ui-bar-a button{ font-family:Helvetica ;}.ui-body-a,.ui-overlay-a{border:1px solid #816f65 ;color:#000000 ;text-shadow:0  1px  0  #eeeeee ;background:#ebcab8 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #FFdeca ),to( #d3b5a5 )); background-image:-webkit-linear-gradient( #FFdeca,#d3b5a5 ); background-image:   -moz-linear-gradient( #FFdeca,#d3b5a5 ); background-image:    -ms-linear-gradient( #FFdeca,#d3b5a5 ); background-image:     -o-linear-gradient( #FFdeca,#d3b5a5 ); background-image:        linear-gradient( #FFdeca,#d3b5a5 );}.ui-overlay-a{background-image:none;border-width:0;}.ui-body-a,.ui-body-a input,.ui-body-a select,.ui-body-a textarea,.ui-body-a button{ font-family:Helvetica ;}.ui-body-a .ui-link-inherit{color:#000000 ;}.ui-body-a .ui-link{color:#2489ce ;font-weight:bold;}.ui-body-a .ui-link:visited{   color:#2489ce ;}.ui-body-a .ui-link:hover{color:#2489ce ;}.ui-body-a .ui-link:active{color:#2489ce ;}.ui-btn-up-a{border:1px solid #fbc485 ;background:#fbc485 ;font-weight:bold;color:#000000 ;text-shadow:0  1px  0  #eeeeee ;background-image:-webkit-gradient(linear,left top,left bottom,from( #FFd792 ),to( #e1b077 )); background-image:-webkit-linear-gradient( #FFd792,#e1b077 ); background-image:   -moz-linear-gradient( #FFd792,#e1b077 ); background-image:    -ms-linear-gradient( #FFd792,#e1b077 ); background-image:     -o-linear-gradient( #FFd792,#e1b077 ); background-image:        linear-gradient( #FFd792,#e1b077 );}.ui-btn-up-a:visited,.ui-btn-up-a a.ui-link-inherit{color:#000000 ;}.ui-btn-hover-a{border:1px solid #FFe198 ;background:#FFe198 ;font-weight:bold;color:#000000 ;text-shadow:0  1px  0  #eeeeee ;background-image:-webkit-gradient(linear,left top,left bottom,from( #FFf7a7 ),to( #e5ca88 )); background-image:-webkit-linear-gradient( #FFf7a7,#e5ca88 ); background-image:   -moz-linear-gradient( #FFf7a7,#e5ca88 ); background-image:    -ms-linear-gradient( #FFf7a7,#e5ca88 ); background-image:     -o-linear-gradient( #FFf7a7,#e5ca88 ); background-image:        linear-gradient( #FFf7a7,#e5ca88 );}.ui-btn-hover-a:visited,.ui-btn-hover-a:hover,.ui-btn-hover-a a.ui-link-inherit{color:#000000 ;}.ui-btn-down-a{border:1px solid #FFe198 ;background:#FFe198 ;font-weight:bold;color:#000000 ;text-shadow:0  1px  0  #eeeeee ;background-image:-webkit-gradient(linear,left top,left bottom,from( #e5ca88 ),to( #FFf7a7 )); background-image:-webkit-linear-gradient( #e5ca88,#FFf7a7 ); background-image:   -moz-linear-gradient( #e5ca88,#FFf7a7 ); background-image:    -ms-linear-gradient( #e5ca88,#FFf7a7 ); background-image:     -o-linear-gradient( #e5ca88,#FFf7a7 ); background-image:        linear-gradient( #e5ca88,#FFf7a7 );}.ui-btn-down-a:visited,.ui-btn-down-a:hover,.ui-btn-down-a a.ui-link-inherit{color:#000000 ;}.ui-btn-up-a,.ui-btn-hover-a,.ui-btn-down-a{ font-family:Helvetica ;text-decoration:none;}.ui-bar-b{border:1px solid #b3b3b3 ;background:#eeeeee ;color:#3e3e3e ;font-weight:bold;text-shadow:0  1px  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #f0f0f0 ),to( #dddddd )); background-image:-webkit-linear-gradient( #f0f0f0,#dddddd ); background-image:   -moz-linear-gradient( #f0f0f0,#dddddd ); background-image:    -ms-linear-gradient( #f0f0f0,#dddddd ); background-image:     -o-linear-gradient( #f0f0f0,#dddddd ); background-image:        linear-gradient( #f0f0f0,#dddddd );}.ui-bar-b .ui-link-inherit{color:#3e3e3e ;}.ui-bar-b a.ui-link{color:#7cc4e7 ;font-weight:bold;}.ui-bar-b a.ui-link:visited{   color:#2489ce ;}.ui-bar-b a.ui-link:hover{color:#2489ce ;}.ui-bar-b a.ui-link:active{color:#2489ce ;}.ui-bar-b,.ui-bar-b input,.ui-bar-b select,.ui-bar-b textarea,.ui-bar-b button{ font-family:Helvetica ;}.ui-body-b,.ui-overlay-b{border:1px solid #aaaaaa ;color:#333333 ;text-shadow:0  1px  0  #ffffff ;background:#f9f9f9 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #f9f9f9 ),to( #eeeeee )); background-image:-webkit-linear-gradient( #f9f9f9,#eeeeee ); background-image:   -moz-linear-gradient( #f9f9f9,#eeeeee ); background-image:    -ms-linear-gradient( #f9f9f9,#eeeeee ); background-image:     -o-linear-gradient( #f9f9f9,#eeeeee ); background-image:        linear-gradient( #f9f9f9,#eeeeee );}.ui-overlay-b{background-image:none;border-width:0;}.ui-body-b,.ui-body-b input,.ui-body-b select,.ui-body-b textarea,.ui-body-b button{ font-family:Helvetica ;}.ui-body-b .ui-link-inherit{color:#333333 ;}.ui-body-b .ui-link{color:#2489ce ;font-weight:bold;}.ui-body-b .ui-link:visited{   color:#2489ce ;}.ui-body-b .ui-link:hover{color:#2489ce ;}.ui-body-b .ui-link:active{color:#2489ce ;}.ui-btn-up-b{border:1px solid #fa3113 ;background:#fa3113 ;font-weight:bold;color:#ffffff ;text-shadow:0  0  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #fa3113 ),to( #fa3113 )); background-image:-webkit-linear-gradient( #fa3113,#fa3113 ); background-image:   -moz-linear-gradient( #fa3113,#fa3113 ); background-image:    -ms-linear-gradient( #fa3113,#fa3113 ); background-image:     -o-linear-gradient( #fa3113,#fa3113 ); background-image:        linear-gradient( #fa3113,#fa3113 );}.ui-btn-up-b:visited,.ui-btn-up-b a.ui-link-inherit{color:#ffffff ;}.ui-btn-hover-b{border:1px solid #bbbbbb ;background:#dfdfdf ;font-weight:bold;color:#2f3e46 ;text-shadow:0  1px  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #f6f6f6 ),to( #e0e0e0 )); background-image:-webkit-linear-gradient( #f6f6f6,#e0e0e0 ); background-image:   -moz-linear-gradient( #f6f6f6,#e0e0e0 ); background-image:    -ms-linear-gradient( #f6f6f6,#e0e0e0 ); background-image:     -o-linear-gradient( #f6f6f6,#e0e0e0 ); background-image:        linear-gradient( #f6f6f6,#e0e0e0 );}.ui-btn-hover-b:visited,.ui-btn-hover-b:hover,.ui-btn-hover-b a.ui-link-inherit{color:#2f3e46 ;}.ui-btn-down-b{border:1px solid #bbbbbb ;background:#d6d6d6 ;font-weight:bold;color:#2f3e46 ;text-shadow:0  1px  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #d0d0d0 ),to( #dfdfdf )); background-image:-webkit-linear-gradient( #d0d0d0,#dfdfdf ); background-image:   -moz-linear-gradient( #d0d0d0,#dfdfdf ); background-image:    -ms-linear-gradient( #d0d0d0,#dfdfdf ); background-image:     -o-linear-gradient( #d0d0d0,#dfdfdf ); background-image:        linear-gradient( #d0d0d0,#dfdfdf );}.ui-btn-down-b:visited,.ui-btn-down-b:hover,.ui-btn-down-b a.ui-link-inherit{color:#2f3e46 ;}.ui-btn-up-b,.ui-btn-hover-b,.ui-btn-down-b{ font-family:Helvetica ;text-decoration:none;}.ui-bar-c{border:1px solid #fa3113 ;background:#fa3113 ;color:#3e3e3e ;font-weight:bold;text-shadow:0  1px  0  #ffffff ;background-image:-webkit-gradient(linear,left top,left bottom,from( #fa3113 ),to( #fa3113 )); background-image:-webkit-linear-gradient( #fa3113,#fa3113 ); background-image:   -moz-linear-gradient( #fa3113,#fa3113 ); background-image:    -ms-linear-gradient( #fa3113,#fa3113 ); background-image:     -o-linear-gradient( #fa3113,#fa3113 ); background-image:        linear-gradient( #fa3113,#fa3113 );}.ui-bar-c .ui-link-inherit{color:#3e3e3e ;}.ui-bar-c a.ui-link{color:#7cc4e7 ;font-weight:bold;}.ui-bar-c a.ui-link:visited{   color:#2489ce ;}.ui-bar-c a.ui-link:hover{color:#2489ce ;}.ui-bar-c a.ui-link:active{color:#2489ce ;}.ui-bar-c,.ui-bar-c input,.ui-bar-c select,.ui-bar-c textarea,.ui-bar-c button{ font-family:Helvetica ;}.ui-body-c,.ui-overlay-c{border:1px solid #aaaaaa ;color:#333333 ;text-shadow:0  1px  0  #ffffff ;background:#f9f9f9 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #f9f9f9 ),to( #eeeeee )); background-image:-webkit-linear-gradient( #f9f9f9,#eeeeee ); background-image:   -moz-linear-gradient( #f9f9f9,#eeeeee ); background-image:    -ms-linear-gradient( #f9f9f9,#eeeeee ); background-image:     -o-linear-gradient( #f9f9f9,#eeeeee ); background-image:        linear-gradient( #f9f9f9,#eeeeee );}.ui-overlay-c{background-image:none;border-width:0;}.ui-body-c,.ui-body-c input,.ui-body-c select,.ui-body-c textarea,.ui-body-c button{ font-family:Helvetica ;}.ui-body-c .ui-link-inherit{color:#333333 ;}.ui-body-c .ui-link{color:#2489ce ;font-weight:bold;}.ui-body-c .ui-link:visited{   color:#2489ce ;}.ui-body-c .ui-link:hover{color:#2489ce ;}.ui-body-c .ui-link:active{color:#2489ce ;}.ui-btn-up-c{border:1px solid #ae6006 ;background:#ae6006 ;font-weight:bold;color:#ffffff ;text-shadow:0  1px  0  #444444 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #bf6906 ),to( #9c5605 )); background-image:-webkit-linear-gradient( #bf6906,#9c5605 ); background-image:   -moz-linear-gradient( #bf6906,#9c5605 ); background-image:    -ms-linear-gradient( #bf6906,#9c5605 ); background-image:     -o-linear-gradient( #bf6906,#9c5605 ); background-image:        linear-gradient( #bf6906,#9c5605 );}.ui-btn-up-c:visited,.ui-btn-up-c a.ui-link-inherit{color:#ffffff ;}.ui-btn-hover-c{border:1px solid #c86e06 ;background:#c86e06 ;font-weight:bold;color:#ffffff ;text-shadow:0  1px  0  #444444 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #dc7906 ),to( #b46305 )); background-image:-webkit-linear-gradient( #dc7906,#b46305 ); background-image:   -moz-linear-gradient( #dc7906,#b46305 ); background-image:    -ms-linear-gradient( #dc7906,#b46305 ); background-image:     -o-linear-gradient( #dc7906,#b46305 ); background-image:        linear-gradient( #dc7906,#b46305 );}.ui-btn-hover-c:visited,.ui-btn-hover-c:hover,.ui-btn-hover-c a.ui-link-inherit{color:#ffffff ;}.ui-btn-down-c{border:1px solid #c86e06 ;background:#c86e06 ;font-weight:bold;color:#ffffff ;text-shadow:0  1px  0  #444444 ;background-image:-webkit-gradient(linear,left top,left bottom,from( #b46305 ),to( #dc7906 )); background-image:-webkit-linear-gradient( #b46305,#dc7906 ); background-image:   -moz-linear-gradient( #b46305,#dc7906 ); background-image:    -ms-linear-gradient( #b46305,#dc7906 ); background-image:     -o-linear-gradient( #b46305,#dc7906 ); background-image:        linear-gradient( #b46305,#dc7906 );}.ui-btn-down-c:visited,.ui-btn-down-c:hover,.ui-btn-down-c a.ui-link-inherit{color:#ffffff ;}.ui-btn-up-c,.ui-btn-hover-c,.ui-btn-down-c{ font-family:Helvetica ;text-decoration:none;}a.ui-link-inherit{text-decoration:none !important;}.ui-btn-active{border:1px solid #04bf9d ;background:#04bf9d ;font-weight:bold;color:#ffffff ;cursor:pointer; text-shadow: 0px  0  #444444 ;text-decoration:none;background-image:-webkit-gradient(linear,left top,left bottom,from( #04d2ac ),to( #03ab8d )); background-image:-webkit-linear-gradient( #04d2ac,#03ab8d ); background-image:   -moz-linear-gradient( #04d2ac,#03ab8d ); background-image:    -ms-linear-gradient( #04d2ac,#03ab8d ); background-image:     -o-linear-gradient( #04d2ac,#03ab8d ); background-image:        linear-gradient( #04d2ac,#03ab8d );  font-family:Helvetica ;}.ui-btn-active:visited,.ui-btn-active:hover,.ui-btn-active a.ui-link-inherit{color:#ffffff ;}.ui-btn-inner{border-top:1px solid #fff;border-color:rgba(255,255,255,.3);}.ui-corner-all{-webkit-border-radius:1.8em ;border-radius:1.8em ;}.ui-br{border-color:rgb(130,130,130);border-color:rgba(130,130,130,.3);border-style:solid;}.ui-disabled{filter:Alpha(Opacity=30);opacity:.3;zoom:1;}.ui-disabled,.ui-disabled a{cursor:default !important;pointer-events:none;}.ui-icon,.ui-icon-searchfield:after{background-color:#af722c ;background-color:rgba(175,114,44,1) ;background-image:url(themes/images/icons-18-white.png) ;background-repeat:no-repeat;-webkit-border-radius:9px;border-radius:9px;}.ui-icon-alt .ui-icon,.ui-icon-alt .ui-icon-searchfield:after{background-color:#fff;background-color:rgba(255,255,255,.3);background-image:url(themes/images/icons-18-black.png);background-repeat:no-repeat;}.ui-icon-nodisc .ui-icon,.ui-icon-nodisc .ui-icon-searchfield:after,.ui-icon-nodisc .ui-icon-alt .ui-icon,.ui-icon-nodisc .ui-icon-alt .ui-icon-searchfield:after{background-color:transparent;}.ui-icon-plus{background-position:-1px -1px;}.ui-icon-minus{background-position:-37px -1px;}.ui-icon-delete{background-position:-73px -1px;}.ui-icon-arrow-r{background-position:-108px -1px;}.ui-icon-arrow-l{background-position:-144px -1px;}.ui-icon-arrow-u{background-position:-180px -1px;}.ui-icon-arrow-d{background-position:-216px -1px;}.ui-icon-check{background-position:-252px -1px;}.ui-icon-gear{background-position:-288px -1px;}.ui-icon-refresh{background-position:-323px -1px;}.ui-icon-forward{background-position:-360px -1px;}.ui-icon-back{background-position:-396px -1px;}.ui-icon-grid{background-position:-432px -1px;}.ui-icon-star{background-position:-467px -1px;}.ui-icon-alert{background-position:-503px -1px;}.ui-icon-info{background-position:-539px -1px;}.ui-icon-home{background-position:-575px -1px;}.ui-icon-search,.ui-icon-searchfield:after{background-position:-611px -1px;}.ui-icon-checkbox-on{background-position:-647px -1px;}.ui-icon-checkbox-off{background-position:-683px -1px;}.ui-icon-radio-on{background-position:-718px -1px;}.ui-icon-radio-off{background-position:-754px -1px;}.ui-icon-bars{background-position:-788px -1px;}.ui-icon-edit{background-position:-824px -1px;}@media only screen and (-webkit-min-device-pixel-ratio:1.3),      only screen and (min--moz-device-pixel-ratio:1.3),      only screen and (min-resolution:200dpi){.ui-icon-plus,.ui-icon-minus,.ui-icon-delete,.ui-icon-arrow-r,.ui-icon-arrow-l,.ui-icon-arrow-u,.ui-icon-arrow-d,.ui-icon-check,.ui-icon-gear,.ui-icon-refresh,.ui-icon-forward,.ui-icon-back,.ui-icon-grid,.ui-icon-star,.ui-icon-alert,.ui-icon-info,.ui-icon-home,.ui-icon-bars,.ui-icon-edit,.ui-icon-search,.ui-icon-searchfield:after,.ui-icon-checkbox-off,.ui-icon-checkbox-on,.ui-icon-radio-off,.ui-icon-radio-on{background-image:url(themes/images/icons-36-white.png);-moz-background-size:864px 18px;-o-background-size:864px 18px;-webkit-background-size:864px 18px;background-size:864px 18px;}.ui-icon-alt .ui-icon{background-image:url(themes/images/icons-36-black.png);}.ui-icon-plus{background-position:0 50%;}.ui-icon-minus{background-position:-36px 50%;}.ui-icon-delete{background-position:-72px 50%;}.ui-icon-arrow-r{background-position:-108px 50%;}.ui-icon-arrow-l{background-position:-144px 50%;}.ui-icon-arrow-u{background-position:-179px 50%;}.ui-icon-arrow-d{background-position:-215px 50%;}.ui-icon-check{background-position:-252px 50%;}.ui-icon-gear{background-position:-287px 50%;}.ui-icon-refresh{background-position:-323px 50%;}.ui-icon-forward{background-position:-360px 50%;}.ui-icon-back{background-position:-395px 50%;}.ui-icon-grid{background-position:-431px 50%;}.ui-icon-star{background-position:-467px 50%;}.ui-icon-alert{background-position:-503px 50%;}.ui-icon-info{background-position:-538px 50%;}.ui-icon-home{background-position:-575px 50%;}.ui-icon-search,.ui-icon-searchfield:after{background-position:-611px 50%;}.ui-icon-checkbox-on{background-position:-647px 50%;}.ui-icon-checkbox-off{background-position:-683px 50%;}.ui-icon-radio-on{background-position:-718px 50%;}.ui-icon-radio-off{background-position:-754px 50%;}.ui-icon-bars{background-position:-788px 50%;}.ui-icon-edit{background-position:-824px 50%;}}.ui-checkbox .ui-icon,.ui-selectmenu-list .ui-icon{-webkit-border-radius:3px;border-radius:3px;}.ui-icon-checkbox-off,.ui-icon-radio-off{background-color:transparent;}.ui-checkbox-on .ui-icon,.ui-radio-on .ui-icon{background-color:#04bf9d ; }.ui-icon-loading{background:url(themes/images/ajax-loader.gif);background-size:46px 46px;}.ui-btn-corner-all{-webkit-border-radius:0.2em ;border-radius:0.2em ;}.ui-corner-all,.ui-btn-corner-all{-webkit-background-clip:padding;background-clip:padding-box;}.ui-overlay{background:#666;filter:Alpha(Opacity=50);opacity:.5;position:absolute;width:100%;height:100%;}.ui-overlay-shadow{-moz-box-shadow:0 0 12px rgba(0,0,0,.6);-webkit-box-shadow:0 0 12px rgba(0,0,0,.6);box-shadow:0 0 12px rgba(0,0,0,.6);}.ui-shadow{-moz-box-shadow:0 1px 3px  rgba(166,191,43,0.2) ;-webkit-box-shadow:0 1px 3px  rgba(166,191,43,0.2) ;box-shadow:0 1px 3px  rgba(166,191,43,0.2) }.ui-bar-a .ui-shadow,.ui-bar-b .ui-shadow,.ui-bar-c .ui-shadow {-moz-box-shadow:0 1px 0 rgba(255,255,255,.3);-webkit-box-shadow:0 1px 0 rgba(255,255,255,.3);box-shadow:0 1px 0 rgba(255,255,255,.3);}.ui-shadow-inset{-moz-box-shadow:inset 0 1px 4px rgba(0,0,0,.2);-webkit-box-shadow:inset 0 1px 4px rgba(0,0,0,.2);box-shadow:inset 0 1px 4px rgba(0,0,0,.2);}.ui-icon-shadow{-moz-box-shadow:0 1px 0 rgba(255,255,255,.4) ;-webkit-box-shadow:0 1px 0 rgba(255,255,255,.4) ;box-shadow:0 1px 0 rgba(255,255,255,.4) ;}.ui-btn:focus,.ui-link-inherit:focus{outline:0;}.ui-btn.ui-focus{z-index:1;}.ui-focus,.ui-btn:focus{-moz-box-shadow:inset 0 0 3px #04bf9d,0 0 9px #04bf9d ;-webkit-box-shadow:inset 0 0 3px #04bf9d,0 0 9px #04bf9d ;box-shadow:inset 0 0 3px #04bf9d,0 0 9px #04bf9d ;}.ui-input-text.ui-focus,.ui-input-search.ui-focus{-moz-box-shadow:0 0 12px #04bf9d ;-webkit-box-shadow:0 0 12px #04bf9d ;box-shadow:0 0 12px #04bf9d ;}.ui-mobile-nosupport-boxshadow *{-moz-box-shadow:none !important;-webkit-box-shadow:none !important;box-shadow:none !important;}.ui-mobile-nosupport-boxshadow .ui-focus,.ui-mobile-nosupport-boxshadow .ui-btn:focus,.ui-mobile-nosupport-boxshadow .ui-link-inherit:focus{outline-width:1px;outline-style:auto;}
		</style>
		
		
		<!-- static update of tags based for client side - does not update db until 'submit updates' clicked -->
		<script type="text/javascript">
        
        	$(document).ready(function() {
				
				//link color picker with hidden colo_hex input field
				$('#colorpicker').farbtastic('#color_hex');
				
				//if there are no tags associated with the item, hide tags listview
				<?
					if ($arr_tags[0]==null) {
						echo "$('#tags_list_div').hide();";
					}
				?>
				
				// link change in color picker to update hidden input fields for name and hex values
				$.farbtastic('#colorpicker').linkTo(function(new_color_hex) {
					
					var new_color_name  = ntc.name(new_color_hex)[1];
					console.log("color changed to: "+new_color_name);
					
					$('#color_hex').val(new_color_hex);
					$('#color_name').val(new_color_name);
					
				});
				
				
				//create a variable to keep track of tags
				var dynamic_tags_array = "<? echo $item_id_details['tags']; ?>";
				
				//establish max tag id number
				var tag_no= document.getElementById('tag_list').getElementsByTagName('li').length-2;
				
				//remove existing tag	
				$('#tag_list').on('click', '.deleteMe', function () {
					
					
					//remove from tags list holder
					
					//if tag is not last, include comma at end of string
					if ($(this).attr('id')<tag_no) {
						var tag_string = $(this).attr('value')+", ";
					}
					
					//if tag is last and not first, include comma at beginning of string
					if ($(this).attr('id')==tag_no && dynamic_tags_array !='') {
						var tag_string = ", "+$(this).attr('value');
					}
					//tag is single, don't add comma
					else {
						var tag_string = $(this).attr('value')
					}


					dynamic_tags_array = dynamic_tags_array.replace(tag_string,'');
					
					
					//remove from tags view
					$(this).parent().remove();
					$('#tag_list').listview('refresh');
					
					//upadte hidden tags input field with new tags sting
					$('#tags_string').val(dynamic_tags_array);
					

				});


				//add new tag
				$('#add_tags_clientside').click(function() {
					var new_tag = $('#new_tag_field').val();

		    		if(new_tag != '') {
    					$('#tag_list').append("<li><a>" + new_tag.charAt(0).toUpperCase()+new_tag.slice(1) + "</a><a class='deleteMe'></a></li>").listview('refresh');
        
			        	$('#new_tag_field').val('');
        				
    	    			//if tag is first, just add; else add with comma at beginning
    	    			if (dynamic_tags_array==''){
    	    				dynamic_tags_array = new_tag;
    	    			}else {
    	    			
    	    				dynamic_tags_array = dynamic_tags_array+", "+new_tag;
    	    			}
        				
			        	//upadte hidden tags input field with new tags sting
						$('#tags_string').val(dynamic_tags_array);
						
						//if this is the first tag insert, show the tags div
						$('#tags_list_div').show();
							
			    	} else {
			    		alert('Nothing to add');
    				}
    				
				});
    			
    			
				//change type value according to radio buttons selection
				$("input[type='radio']").bind( "change", function(event, ui) {
					var new_type_val = $(this).val();
				    $('#item_type').val(new_type_val);
				});
    			
    			
			// error checking for ajax calls to server
			function onSuccess(data, status)
			{
				console.log(data, status);
			}
  
			function onError(data, status)
			{
				console.log(data, status);
			} 
    			
			// submit changes to db via ajax 
			$("#update_db_btn").click(function(){
  					
  					
				//create form data in url format
			    var formData = $("#item_attributes").serialize();
                	
				console.log(formData);
  
			    $.ajax({
    				type: "POST",
	        		url: "update_item.php",
		    	    cache: false,
    		    	data: formData,
		        	success: onSuccess,
	    		    error: onError
                    	
				});
                	
  
	    		return false;
			});
            	
			// pop box for delete dialog
			$(document).delegate('#opendialog', 'click', function() {
				$('<div>').simpledialog2({
	    		mode: 'blank',
    			headerText: 'Delete Item?',
    			headerClose: true,
    			blankContent : 
			      	"<a data-role='button' href='delete_item.php?id="+<?echo $item_id;?>+"'>Yes</a>"+
    			  	"<a rel='close' data-role='button' href='#'>Cancel</a>"
		  		});
			});
			
			
		});
		</script>

        <style type="text/css">
            div#colorpicker {
                position:relative;
                top:0px;
                left:100px;
            }
            div#update_db_btn {
               position:relative;
               bottom:0px; 
            }
        </style>
    </head>
    
    <body>
		<div data-role="page" id="view_item" data-theme="a">
			<div data-role="header" data-theme="a" data-add-back-btn="true" data-position="fixed">
				<a data-rel="back" data-role="button" data-icon="back" data-iconpos="notext"></a>
				<h1><img src="assets/icon-tshirt-white.png" class="ui-li-icon"> dresscode.</h1>
				<a href="index.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
			</div>
			<div data-role="content">
				<a href="#" id="opendialog" data-role="button" data-theme="a" align="right" data-icon="delete" data-iconpos="notext" style="float:right">Delete</a>
				<img style="transform:rotate(90deg); -mysql_select_db-transform:rotate(90deg); -webkit-transform:rotate(90deg);" src="img_display.php?id=<?echo ($item_id);?>" height="100%" width="100%">
				<br><br>
				<Form id="item_attributes">
					<p>
						<div id='colorpicker'></div>
            			<b>Item Attributes</b>

						<input type="hidden" name="item_id" id="item_id" value="<?echo $item_id; ?>"/>
						<fieldset data-role="controlgroup">
							<input type="radio" name="radio-choice" id="radio-choice-1" data-mini="true" value="accessories" <?if($item_id_details['type']=="accessories"){echo "checked='checked'";}?> />
     						<label for="radio-choice-1">Accesories</label>
     						<input type="radio" name="radio-choice" id="radio-choice-2" data-mini="true" value="dresses" <?if($item_id_details['type']=="dresses"){echo "checked='checked'";}?> />
     						<label for="radio-choice-2">Dresses</label>
     						<input type="radio" name="radio-choice" id="radio-choice-3" data-mini="true" value="pants" <?if($item_id_details['type']=="pants"){echo "checked='checked'";}?> />
     						<label for="radio-choice-3">Pants</label>
     						<input type="radio" name="radio-choice" id="radio-choice-4" data-mini="true" value="shoes" <?if($item_id_details['type']=="shoes"){echo "checked='checked'";}?> />
     						<label for="radio-choice-4">Shoes</label>
     						<input type="radio" name="radio-choice" id="radio-choice-5" data-mini="true" value="skirts" <?if($item_id_details['type']=="skirts"){echo "checked='checked'";}?> />
     						<label for="radio-choice-5">Skirts</label>
     						<input type="radio" name="radio-choice" id="radio-choice-6" data-mini="true" value="tops" <?if($item_id_details['type']=="tops"){echo "checked='checked'";}?> />
     						<label for="radio-choice-6">Tops</label>
						</fieldset>
                        
						<input type="hidden" name="item_type" id="item_type" value="<?echo $item_id_details['type']; ?>"/>
						<br>Casual<input type='range' name='casual' id='formal_attr' data-mini="true"  value='<? echo formal2number($item_id_details['formal']); ?>' min='1' max='5' data-highlight='true' />Formal
            			<br>Loose<input type='range' name='fit' id='fir_attr' data-mini="true"  value='<? echo fit2number($item_id_details['fit']); ?>' min='1' max='5' data-highlight='true' />Tight
						<br>Cold<input type='range' name='weather' id='weather_attr' data-mini="true"  value='<? echo weather2number($item_id_details['weather']); ?>' min='1' max='3' data-highlight='true' />Warm
						<input type="hidden" name="tags_string" id="tags_string" value="<? echo $item_id_details['tags']; ?>"/>
						<input type='hidden' id='color_name'name='color_name' value="<? echo $item_id_details['color_name']; ?>" hidden='yes'>
						<form><input type='hidden' id='color_hex' name='color_hex' value="<? echo $item_id_details['color_hex']; ?>" hidden='yes'/></form>
						
					</p>
					<br />


            	<?
            		
            			echo "<div id='tags_list_div' name='tags_list_div'>";
            			echo "<ul data-role='listview' id='tag_list' data-split-icon='delete' data-split-theme='a'>";
							echo "<li id='tags_list' data-theme='a'>Tags</li>";
            			
            			if ($arr_tags[0]!=null) {for ($i=0; $i<sizeof($arr_tags); $i++) {
                        	
                        	echo "       <li id='l1' value='".$arr_tags[$i]."'><a>".ucfirst($arr_tags[$i])."</a><a id='".$i."' class='deleteMe' value='".$arr_tags[$i]."'></a></li>";
                		}}
						echo "</ul>";
						echo "</div>";
				
					
				?>

					<br />
					<br />
					<fieldset class="ui-grid-a">
           				<div class="ui-block-a">
							<input type='text' placeholder='add new tag' id='new_tag_field'/>
						</div>
						<div class="ui-block-b">
							<input type='button' value='Add' id='add_tags_clientside'/>
						</div>
                        <br><br><br>
					</fieldset>
					<br />
					
				</form>

                      

                <input type='button' value='Submit Changes' id='update_db_btn' data-theme="b"/>

				<br><br><br><br><br><br>
			</div>
		</div>
	</body>
	
</html>