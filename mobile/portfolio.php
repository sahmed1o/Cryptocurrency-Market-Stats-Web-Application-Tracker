<!DOCTYPE html>  
<html>
<head>
<title>Cryptocurrency Portfolio | StatsCryptoMarket.com</title>
<meta name="description" content="Track your crypto buys and sells. View market cap highs and lows, trends, charts, and graphs for cryptocurrency.">
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="300">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/scrollingText.css">
  <link rel="stylesheet" type="text/css" href="../css/tablemod.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="stylesheet" type="text/css" href="../css/portfolio.css">
  <link rel="stylesheet" type="text/css" href="../css/sort-table.css" title="">
  <link rel="stylesheet" type="text/css" href="../css/nv.d3.css">
  <link rel="stylesheet" type="text/css" href="../css/graphcustomportfolio.css">
  <link rel="stylesheet" type="text/css" href="../css/mobilec.css">
   <script type="text/javascript" src="../js/framework/d3.v3.min.js"></script>
   <script type="text/javascript" src="../js/framework/nv.d3.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	//sort table if not mobile or tablet view
	if ($(window).width() > 970) {
		//document.write('<script type="text/javascript" src="../js/sort-table.js"><\/script>');
	}
   </script>
  
</head>
<body>  

<!------ Confirmation menu  Deletion---------->
<div class="popup" >
  <span class="popuptext" id="myPopup">N/A removed</span>
</div>

<div id="popupty" class="popupt">
  <div class="container innerpopupt" >
    <div class="titlepopup"><p>Remove from Portfolio?</p></div>
	  <h3 id="nameprompt" style="color: white;">N/A</h3>
       <div class="center">
        <p id="priceprompt" style="color: white;">Current Price: $0</p>
        <p id="heldamt" style="color: white;">Amount Held: 0</p>
       
        
    <p></p>
  
   <button type="button" class="btn btn-primary  btnyes" onclick='removefromportfolio()' style="width: 100%;" ><span class="glyphicon glyphicon-ok"></span></button>
	
	 <p></p>
  </div>

    <button type="button" class="btn btn-primary col-xs-12 btnot" onclick='closeprompt()'><span class="glyphicon glyphicon-remove"></span></button>

  </div>
</div>
<!------ Confirmation menu Deletion---------->


<!------ Confirmation menu Modify ---------->
<div class="popup" onclick="myFunction()">
  <span class="popuptext" id="myPopup">N/A Modified</span>
</div>
<div id="popupty2" class="popupt2">

  <div class="container innerpopupt" >
    <div class="titlepopup"><p>Modify Value?</p></div>
	  <h3 id="nameprompt2" style="color: white;">N/A</h3>
       <div class="center">
        <p id="priceprompt2" style="color: white;">Current Price: $0</p>
        <p id="heldamt2" style="color: white;">Amount Held</p>
       
        
     <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger btn-number"  onclick='subcoin()' data-type="minus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-minus"></span>
                </button>
            </span>
            <input id="amntuser2" type="text" name="quant[2]" class="form-control input-number" value="0" min="1" max="100">
            <span class="input-group-btn">
                <button type="button" class="btn btn-success btn-number" onclick='addcoin()' data-type="plus" data-field="quant[2]">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </span>
        </div>
        
         <p></p>
		<div class="input-group" style="width: 100%;">
			<input id="amtcoin2" type="text" name="quant[2]" class="form-control input-number"  value="0 BTC" min="1" max="100" readonly style="text-align: center; ">
		</div>
        
    <p></p>
  
   <button type="button" class="btn btn-primary  btnyes" onclick='modifycoinportfolio()' style="width: 100%;" ><span class="glyphicon glyphicon-ok"></span></button>
	
	 <p></p>
  </div>

    <button type="button" class="btn btn-primary col-xs-12 btnot" onclick='closeprompt2()'><span class="glyphicon glyphicon-remove"></span></button>

  </div>
</div>
<!------ Confirmation menu Modify---------->

<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<a href="javascript:" id="return-to-bottom"><i class="fa fa-chevron-down"></i></a>



<?php
$totalCoinCount = 0;
$results = array();
$chartarray = array();
$portfoliodata = "";
$none_found = 0;
$localdata = array();
		
//$page = 1;
if(!isset($_GET['local'])){
	$portfoliodata = "";
	
}
else{
	if(is_numeric($_GET['local'])){
		$portfoliodata = htmlspecialchars($_GET['local']);
		$serialized = json_encode($portfoliodata);
		$myNewArray = json_decode($serialized, true);
		   $string = str_replace('[', '', $myNewArray); // Replaces all spaces with hyphens.
		   $string = str_replace(']', '', $string); // Replaces all spaces with hyphens.
		   $string = str_replace('&quot;', '', $string); // Replaces all spaces with hyphens.

		$localdata = explode(',', $string);
	}
	else{
		$portfoliodata = htmlspecialchars($_GET['local']);
		$serialized = json_encode($portfoliodata);
		$myNewArray = json_decode($serialized, true);
		   $string = str_replace('[', '', $myNewArray); // Replaces all spaces with hyphens.
		   $string = str_replace(']', '', $string); // Replaces all spaces with hyphens.
		   $string = str_replace('&quot;', '', $string); // Replaces all spaces with hyphens.

		$localdata = explode(',', $string);
	}
}

    //echo $localdata[4];
//print_r( $localdata);


// Function which saves the data if you didn't do a request in the past 60 seconds
function searchcoin($localdata)
{
		global $results;
		global $chartarray;
		global $none_found;
		$getNumCoins =	json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
		$totalCoinCount2 = $getNumCoins["metadata"]["num_cryptocurrencies"];
		$numcoins = 0;
		
			//page = (1530 - (1530 mod 100))/100 = 1530 - 30 = 1500/100 = 15 pages 
			$totalpages = ($totalCoinCount2 - ($totalCoinCount2 % 100))/100; //15 pages
			
			if($totalpages > 18){
				$totalpages = 18;
			}
			
			//for loop, get total coins, and get all coins. start at 1 since we already stored 0
			//replace 3 with totalcoins/100 = total pages or something
			$num = 0;
			for($i = 0; $i < $totalpages; $i++){
				$tempdata = json_decode(file_get_contents('../json/coinlist' . $i . '.json'), true)['data'];
				foreach($tempdata['data'] as $value) {
					for($y = 0; $y < (sizeof($localdata)-1); $y++){
						if ($value["name"] === $localdata[$y]){
							//echo "<script>console.log( 'Debug Objects: " . $value["name"] . "' );</script>";
							//echo "<script>console.log( 'Debug Objects: " . $localdata[0] . "' );</script>";
							$results[$num]["rank"] =  $value["rank"];
							$results[$num]["name"] =  $value["name"];
							$results[$num]["id"] =  $value["id"];
							$results[$num]["symbol"] =  $value["symbol"];
							$results[$num]["website_slug"] =  $value["website_slug"];
							$results[$num]["priceusd"] =  $value["quotes"]["USD"]["price"];
							$results[$num]["percentchange1h"] =  $value["quotes"]["USD"]["percent_change_1h"];
							$results[$num]["volume24h"] =  $value["quotes"]["USD"]["volume_24h"];
							$results[$num]["marketcap"] =  $value["quotes"]["USD"]["market_cap"];
							$results[$num]["circulatingsupply"] =  $value["circulating_supply"];
							$results[$num]["totalsupply"] =  $value["total_supply"];
							$results[$num]["percentchange1h"] =  $value["quotes"]["USD"]["percent_change_1h"];
							$results[$num]["percentchange24h"] =  $value["quotes"]["USD"]["percent_change_24h"];
							$results[$num]["percentchange7d"] =  $value["quotes"]["USD"]["percent_change_7d"];
							$results[$num]["amountuserhas"] =  $localdata[$y+1];
							
							$chartarray[$num]["percentchange1h"] = $value["quotes"]["USD"]["percent_change_1h"];
							$chartarray[$num]["name"] = $value["name"];
							$num = $num + 1;
						}						
					}
				}
			}
			
			if($num == 0){
				$none_found = 1;
			}
			else{
				$none_found = 0;
			}
			
}




	

searchcoin($localdata);
$data2 = json_decode(file_get_contents('../json/coinlist0.json'), true)['data']; //for scrolling text above to get data from page 1

$totalCoinCount3 = $data2["metadata"]["num_cryptocurrencies"];
$totalpages2 = (($totalCoinCount3 - ($totalCoinCount3 % 100))/100)-1; //15 pages
			
	if($totalpages2 > 18){
		$totalpages2 = 18;
	}

$message = "";


?>

<div class="sticky">
  <div id="txtitle" style="background-color:#0b1116; padding: 4px;" >
	 <div id="seachboxy" class="navbar-form navbar-right" style="margin-top: 5px !important;">
            <div class="input-group">
                <input id="getinput" type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button id="searchbtn" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
  </div>

	<ul class="nav nav-tabs nav-justified" id="myTab" style="border-bottom:0px">
			  <li ><a href="market"  ><span class="glyphicon glyphicon glyphicon glyphicon-stats carty" aria-hidden="true"></span> Market</i></a></li>
			  <li><a href="news"  ><span class="glyphicon glyphicon glyphicon-globe carty" aria-hidden="true"></span> News</a></li>
			  <li class="active"><a href="portfolio" ><span class="glyphicon glyphicon glyphicon-level-up carty" aria-hidden="true"></span> Portfolio</a></li>
			  <li><a href="about"  ><span class="glyphicon glyphicon glyphicon glyphicon-question-sign carty" aria-hidden="true"></span> About</a></li>
			</ul>
	

	
</div>
	

<!------ Black Screen ---------->
<div id="blockdesk">
	
</div>
<!------ Black Screen ---------->

	<div id="fillertop">
	</div>


<?php


echo "<div class=\"wrapper\">";
$max_10 = 0;

	foreach($data2['data'] as $value) {
		if($max_10 < 10){
			$rank = $value["rank"]; //get price usd from crypto coin at data[0]
			$name = $value["name"]; //get price usd from crypto coin at data[0]
			$usdpricetop = $value["quotes"]["USD"]["price"]; //get price usd from crypto coin at data[0]
			$percentchangetop = $value["quotes"]["USD"]["percent_change_1h"]; //get price usd from crypto coin at data[0]
			$logo = $value["website_slug"]; //get price usd from crypto coin at data[0]
			$str = strtolower($logo);
				if((float)$percentchangetop > 0){
					$message =  $message . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "<img class=\"ico_img\" src=\"../coins/32x32/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">" . $rank . "." . $name . " <span class='positive_growth4'>$" . number_format($usdpricetop,2) . "<i class='glyphicon glyphicon-chevron-up' ></i></span> ";
				}
				else{
					$message =  $message . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "<img class=\"ico_img\" src=\"../coins/32x32/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">" . $rank . "." . $name . " <span class='negative_growth4'>$" . number_format($usdpricetop,2) . "<i class='glyphicon glyphicon-chevron-down' ></i></span> ";
				}
			$max_10 = $max_10 + 1;
		}
		else{
			break;
		}
	}

	echo "<p>" . $message . "</p>";
echo "</div>";


// Function which saves the data if you didn't do a request in the past 60 seconds
function cacheGetBTCDat()
{
    return json_decode(file_get_contents('../json/btcinflue.json'), true)['data'];
}

// Function to get the data and use it whenever you need it
function getBTCDat ()
{
    return cacheGetBTCDat();
}


$getbtcinflue = getBTCDat();
$mkcapdom = $getbtcinflue["data"]["quotes"]["USD"]["total_market_cap"];
$mkvol = $getbtcinflue["data"]["quotes"]["USD"]["total_volume_24h"];
$btcinflue = $getbtcinflue["data"]["bitcoin_percentage_of_market_cap"];
$activemarkts = $getbtcinflue["data"]["active_markets"];
$totcrypto = $getbtcinflue["data"]["active_cryptocurrencies"];
?>



<div id="imgtop">
<img id="navpic" src="../img/blueblur.jpg" width="1880" height="300">
</div>

<div id="cryptinflun">
	<div id="innercrypt">
		<div id="marg">
			<p style="display:inline; color:#b7b7b7;">Cryptocurrencies: <strong><a class="infcolor"><?php echo number_format($totcrypto) ?></a></strong></p>
			<p style="display:inline;  color:#b7b7b7;">/ Markets: <strong><a class="infcolor"><?php echo number_format($activemarkts) ?></a></strong></p>
			<p style="display:inline;  color:#b7b7b7;">Market Cap: <strong><a class="infcolor"><?php echo '$' . number_format($mkcapdom) ?></a></strong></p>
			<p style="display:inline;  color:#b7b7b7;"> / 24h Vol: <strong><a class="infcolor"><?php echo '$' . number_format($mkvol) ?></a></strong> / BTC Dominance: <strong><a class="infcolor"><?php echo number_format($btcinflue,1) . '%' ?></a></strong></p>
		</div>
	</div>
</div>

 <div id="gads2" style="margin: 0 auto; text-align:center; background-color: #161d24; width: 100%;">

 </div>

<div  id="searchtitle2" style="border-bottom: 1px solid #2d3849;">
	<div  style="width: 100%; height: 50px;  background: #0e1116;">
		<p style=" font-size: 16px; font-style: italic; text-align: center; color: white; line-height: 50px; vertical-align: middle; ">Biggest ROI (Within 1hr)</p>
	</div>
</div>

		<div id="chart2" >
			<svg></svg>
		</div>


	
 
 
<div  id="searchtitle" style="border-bottom: 1px solid #2d3849;">
	<div  style="width: 100%; height: 50px;  background: #0e1116;">
		<p style=" font-size: 16px; font-style: italic; text-align: center; color: white; line-height: 50px; vertical-align: middle; ">Portfolio</p>
	</div>
</div>



<div id="outtertable" class="table-responsive gdgadg">
<table id="customers3" class="js-sort-table table borderless table-hover table-condensed">
		<thead > 
		  <tr id="myHeader" class="tablecellttun" style="z-index: 99;   display: none;">
			<th id="startclk" class="js-sort-number pinned lockx" style="cursor: pointer;" >#</th>
			<th  class="js-sort-string headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			
		  </tr>
		  </thead>
</table>
</div>

<div id="outtertable" class="table-responsive gdgadg">
<table id="customers3" class="js-sort-table table borderless table-hover table-condensed adfadfa">
		<thead > 
		  <tr id="myHeader" class="fixorder" style="z-index: 999999;   display: none;">
			<th id="startclk" class="js-sort-number pinned lockx" style="cursor: pointer;" >#</th>
			<th  class="js-sort-string headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			<th  class="js-sort-number" style="cursor: pointer; ">USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">%</th>
			<th  class="js-sort-number" style="cursor: pointer; "><span class="glyphicon glyphicon glyphicon-level-up" style='font-size:16px;' aria-hidden="true"></span></th>
			<th  class="js-sort-number" style="cursor: pointer; ">Volume (24hr) USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Market Cap USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Available Supply</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Total Supply</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (1h)</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (24h)</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (7d)</th>
			
		  </tr>
		  </thead>
</table>
</div>


<div id="outtertable" class="table-responsive thistablu">
	<table id="customers" class="js-sort-table table tabulart borderless table-hover table-condensed">
		<thead > 
		  	<!-- Fixes X width for table header -->
		 <tr  id="myHeader2" class="afas" style="z-index: 999; ">
			<th  class="js-sort-number  pinned lockx" style="cursor: pointer;" >#</th>
			<th  class="js-sort-string headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			<th  class="js-sort-number" style="cursor: pointer; ">USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">%</th>
			<th  class="js-sort-number" style="cursor: pointer; "><span class="glyphicon glyphicon glyphicon-level-up" style='font-size:16px;' aria-hidden="true"></span></th>
			<th  class="js-sort-number" style="cursor: pointer; ">Volume (24hr) USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Market Cap USD</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Available Supply</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Total Supply</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (1h)</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (24h)</th>
			<th  class="js-sort-number" style="cursor: pointer; ">Change (7d)</th>
			
		  </tr>
		</thead>
		
		<tbody > 
		<?php
		$totrows = 0;
		
		for ($i = 0; $i < count($results); $i++) {
			
			echo "<tr class='mainrowcoin" . $i . "'  >";
			
			$rank = $results[$i]["rank"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"pinned\">";
			echo $rank;
			echo "</td>";

			$name = $results[$i]["name"]; //get price usd from crypto coin at data[0]
			$symbol = $results[$i]["symbol"]; //get price usd from crypto coin at data[0]
			$logo = $results[$i]["website_slug"];
			$str = strtolower($logo);
			$ifExists = "../coins/16x16/" . $str . ".png";
			echo "<td class=\"cellClass pinned\">";
			if (@getimagesize($ifExists)) {
				echo "<img class=\"ico_img\" src=\"../coins/16x16/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">";
			}
			else{	
				echo "<img class=\"ico_img\" src=\"../coins/16x16/NA.png\" class=\"logo-sprite\" style=\"width:24px; height:20px;\">";
			}
			echo "<a href=\"coininfo?id=" .  $results[$i]["id"] . "\">";
			echo $name . " (" . $symbol . ")";
			echo "</a>";
			echo "</td>";


			$price_usd = $results[$i]["priceusd"]; //get price usd from crypto coin at data[0]
			echo "<td>";
			echo "$" . number_format($price_usd,4);
			echo "</td>";
			
			$percentchange2 = $results[$i]["percentchange1h"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange2 > 0){
				echo "<td class=\"positive_growth3\">";
					echo "+" . number_format($percentchange2,2) . "% ";
							echo "<i class='fa fa-chevron-up'></i>";
			}
			else{
				echo "<td class=\"negative_growth3\">";
					echo number_format($percentchange2,2) . "% " . " ";
							echo "<i class='fa fa-chevron-down'></i>";
			}
			echo "</td>";

			//$price_btc = $value["quotes"]["USD"]["percent_change_1h"]; //btc price
			echo "<td>";
			//echo $price_btc;
			echo "<button class='btn btn-default btnclose' value=" . $i . " style='padding: 4px 4px; background-color: #226a96;   border-color: #1e4a66; color: white;'>";
						echo "<i class='fa fa-chevron-down'></i>";
						echo "</button>";
			echo "</td>";

			$voltwent = $results[$i]["volume24h"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo "$" . number_format($voltwent);
			echo "</td>";

			$marketcap = $results[$i]["marketcap"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo "$" . number_format($marketcap);
			echo "</td>";

			$availsupply = $results[$i]["circulatingsupply"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo number_format($availsupply);
			echo "</td>";

			$totsupply = $results[$i]["totalsupply"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo number_format($totsupply);
			echo "</td>";

			$percentchange = $results[$i]["percentchange1h"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange > 0){
				echo "<td class=\"positive_growth\">";
					echo "+" . number_format($percentchange,2) . "%";
			}
			else{
				echo "<td class=\"negative_growth\">";
					echo number_format($percentchange,2) . "%";
			}
			echo "</td>";

			$percentchange24 = $results[$i]["percentchange24h"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange24 > 0){
				echo "<td class=\"positive_growth\">";
					echo "+" . number_format($percentchange24,2) . "%";
			}
			else{
				echo "<td class=\"negative_growth\">";
					echo number_format($percentchange24,2) . "%";
			}
			echo "</td>";
			
			$percentchange7 = $results[$i]["percentchange7d"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange7 > 0){
				echo "<td class=\"positive_growth\">";
					echo "+" . number_format($percentchange7,2) . "%";
			}
			else{
				echo "<td class=\"negative_growth\">";
					echo number_format($percentchange7,2) . "%";
			}
			echo "</td>";

			
				echo "</tr>";
				
				//user amounts from localstorage
				echo"<tr  class='portrow" . $i . "'  >";
							
					echo "<td class=\"cellClass pinned\">";
					echo "</td>";
					
					echo "<td class=\"pinned\">";
						echo "<button  class='btn btn-default btnclose'  value=" . $i . " style='background-color: #226a96;   border-color: #1e4a66; color: white;'>";
						echo "<i class='fa fa-chevron-up'></i>";
						echo "</button>";
					echo "</td>";
				
					echo "<td >";
						echo "Amount owned:";
					echo "</td>";
					echo "<td >";
						echo $results[$i]["amountuserhas"] . " " . $results[$i]["symbol"];
					echo "</td>";
					
					echo "<td >";
						echo "Total Profit (USD):";
					echo "</td>";
							if((float)$percentchange2 > 0){
								echo "<td >";
									echo "$" . $results[$i]["amountuserhas"]*$results[$i]["priceusd"];
											echo "<i class='fa fa-chevron-up positive_growth2' ></i>";
							}
							else if ((float)$percentchange2 < 0){
								echo "<td >";
									echo "$" . $results[$i]["amountuserhas"]*$results[$i]["priceusd"];
											echo "<i class='fa fa-chevron-down negative_growth2'></i>";
							}
							else if (((float)$percentchange2 == 0)){
								echo "<td >";
									echo "$" . $results[$i]["amountuserhas"]*$results[$i]["priceusd"];
							}
					echo "</td>";
					
					echo "<td >";
						echo "Options:";
					echo "</td>";
					
					echo "<td>";
						echo "<button  type='submit' class='btn btn-default btnmodify'  data-value =" . $name . " data-value2 =" . $symbol . " data-value3 =" . $price_usd . " data-value4 =" . $results[$i]["amountuserhas"] . " value=" . $i . " style='padding: 4px 20px; background-color: #4CAF50;  border-color: #3d6d3f; color: white; '>";
						echo "<i class='fa fa-pencil' style='font-size: 15px;'></i>";
						echo "</button>";
					echo "</td>";
					
					
					echo "<td>";
						echo "<button type='submit' class='btn btn-default btndelete' data-value =" . $name . " data-value2 =" . $symbol . " data-value3 =" . $price_usd . " data-value4 =" . $results[$i]["amountuserhas"] . " value=" . $i . " style='padding: 4px 20px; background-color: #f44336;   border-color: #9b3e37; color: white; '>";
						echo "<i class='fa fa-close' style='font-size: 15px;'></i>";
						echo "</button>";
					echo "</td>";
					
					
				echo "<td>";
				echo "<td>";
				
				
				echo "</tr>";
				
				$totrows = $i;
				
		} 
		
		if($none_found == 1){
			echo "<tr class='nocoin1' >";
				echo "<td colspan='12' height='50px'>";
					echo "";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='nocoin2' >";
				echo "<td id='notfound' align='left' colspan='12' height='100px' style='padding-top: 40px !important; '>";
					echo "No coins added to portfolio.";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='nocoin3' >";
				echo "<td colspan='12' height='50px'>";
					echo "";
				echo "</td>";
			echo "</tr>";
		}
		
		else{
			echo "<tr class='nocoin1 hiddent' >";
				echo "<td colspan='12' height='50px'>";
					echo "";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='nocoin2 hiddent' >";
				echo "<td id='notfound' align='left' colspan='12' height='100px' style='padding-top: 40px !important; '>";
					echo "No coins added to portfolio.";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='nocoin3 hiddent' >";
				echo "<td colspan='12' height='50px'>";
					echo "";
				echo "</td>";
			echo "</tr>";
		}
		
		?>
			<!-- destroy all button -->
			<tfoot id="desktopremoveall">
				<tr  style="background-color: #222222 !important; ">
					<td  align="left" colspan="12" height="50px" style="padding-top: 20px !important; ">
						<button type="button"  onclick="destroyallco()" style="padding: 4px 20px; background-color: #f44336;   border-color: #9b3e37; color: white; ">Remove All</button>
					</td>
				</tr>
			</tfoot>
			
		</tbody> 
	</table>
	
	
 

</div>

  <div id="gads" style="margin: 0 auto; text-align:center; background-color: #161d24; width: 100%;">

 </div>
 
<script> var totalpaget = <?php echo $totalpages2; ?>; var totalrows = <?php echo $totrows; ?>; var ok = <?php echo intval(isset($_GET['page'])); ?>; var none_found = <?php echo $none_found;?>; var getnameurl = <?php echo strval(isset($_GET['coinname'])) ? 0 : 1; ?>; var getnameurl2 = <?php echo strval(isset($_GET['coinname2'])) ? 0 : 1; ?>; var gainchartdat = <?php echo json_encode($chartarray); ?>;</script>
<script src="../js/portfoliog.js" type="text/javascript"></script>
<script src="../js/graphportfolio.js" type="text/javascript"></script>

<div id="slidebottommenu" class="bottomNav turnback">
<button id="" onclick="bottombarslideup()"  class="slideupmenu" ><span class="glyphicon glyphicon-triangle-top"></span></button>
  <div  style="display: table; margin: 0 auto;">
			<button  id="homebtn2" class="navbuttontable2" ><span class="glyphicon glyphicon-align-left"></span> Home </button>
		<button type="button"  onclick="destroyallco()" style="padding: 4px 20px; background-color: #f44336;   border-color: #9b3e37; color: white; ">Remove All</button>
			<div id="" class="navbar-form navbar-right">
            <div class="input-group">
                <input id="getinput2" type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button id="searchbtn2" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
		</div>
</div>

<footer id="feett" class="nb-footer">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="about">

	<div class="social-media">
		<ul class="list-inline">
			<li><a href="" title=""><i class="fa fa-facebook"></i></a></li>
			<li><a href="" title=""><i class="fa fa-twitter"></i></a></li>
			<li><a href="" title=""><i class="fa fa-google-plus"></i></a></li>
			<li><a href="" title=""><i class="fa fa-instagram"></i></a></li>
		</ul>
	</div>
</div>
</div>

<div class="col-md-3 col-sm-6">
<div class="footer-info-single">
	<h2 class="title">Navigation</h2>
	<ul class="list-unstyled">
		<li><a href="market" title=""><i class="fa fa-angle-double-right"></i> Market</a></li>
		<li><a href="news" title=""><i class="fa fa-angle-double-right"></i> News</a></li>
		<li><a href="portfolio" title=""><i class="fa fa-angle-double-right"></i> Portfolio</a></li>
		<li><a href="about" title=""><i class="fa fa-angle-double-right"></i> About</a></li>
	</ul>
</div>
</div>

<div class="col-md-3 col-sm-6">
<div class="footer-info-single">
	<h2 class="title">Information</h2>
	<ul class="list-unstyled">
		<li><a href="contact" title=""><i class="fa fa-angle-double-right"></i> Contact</a></li>
		<li><a href="" title=""><i class="fa fa-angle-double-right"></i> App Publisher</a></li>
	</ul>
</div>
</div>

<div class="col-md-3 col-sm-6">
<div class="footer-info-single">
	<h2 class="title">Security & privacy</h2>
	<ul class="list-unstyled">
		<li><a href="privacypolicy" title=""><i class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
	</ul>
</div>
</div>

<div class="col-md-3 col-sm-6">
<div class="footer-info-single">
	<h2 class="title">Downloads &amp; Tools</h2>
	<p>Coming soon...</p>
	
</div>
</div>
</div>
</div>

<section class="copyright">
<p>Copyright © 2018. StatsCryptoMarket.</p>
</section>
</footer>

</body>
</html>