<!DOCTYPE html>  
<html ng-app="plunker">
<head>
<title>StatsCryptoMarket - Cryptocurrency Information</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="300">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/scrollingText.css">
  <link rel="stylesheet" type="text/css" href="css/graphmod.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/sort-table.css" title="">
  
  <link rel="stylesheet" type="text/css" href="css/nv.d3.css">
  <link rel="stylesheet" type="text/css" href="css/graphCustom.css">
   <script type="text/javascript" src="js/framework/d3.v3.min.js"></script>
   <script type="text/javascript" src="js/framework/nv.d3.min.js"></script>
	
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	//sort table if not mobile or tablet view
	if ($(window).width() > 970) {
		document.write('<\/script type="text/javascript" src="js/sort-table.js"><\/script>');
	}
   </script>
</head>

<body >  
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<a href="javascript:" id="return-to-bottom"><i class="fa fa-chevron-down"></i></a>

<?php
ini_set('memory_limit','512M');


$totalCoinCount = 0;



// Function which saves the data if you didn't do a request in the past 60 seconds
function cache($page)
{	
    return json_decode(file_get_contents('./json/coinlist' . $page . '.json'), true)['data'];
}

// Function to get the data and use it whenever you need it
function getData ($page)
{
    return cache($page);
}


	


$data2 = getData(0); //for scrolling text above to get data from page 1

$totalCoinCount3 = $data2["metadata"]["num_cryptocurrencies"];
$totalpages2 = (($totalCoinCount3 - ($totalCoinCount3 % 100))/100)-1; //15 pages
			
	if($totalpages2 > 18){
		$totalpages2 = 18;
	}

//$coinCount  = count($data);
$message = "";


?>

<div class="sticky">
  <div id="txtitle" style="background-color:#0b1116; padding: 4px;" >
		<a href="market"><img  src="img/banner.png" width="280" height="45"></a>
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
			  <li><a href="portfolio" ><span class="glyphicon glyphicon glyphicon-level-up carty" aria-hidden="true"></span> Portfolio</a></li>
			  <li><a href="about"  ><span class="glyphicon glyphicon glyphicon glyphicon-question-sign carty" aria-hidden="true"></span> About</a></li>
			</ul>
	

	
</div>
	

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
					$message =  $message . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "<img class=\"ico_img\" src=\"coins/32x32/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">" . $rank . "." . $name . " <span class='positive_growth4'>$" . number_format($usdpricetop,2) . "<i class='glyphicon glyphicon-chevron-up' ></i></span> ";
				}
				else{
					$message =  $message . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "<img class=\"ico_img\" src=\"coins/32x32/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">" . $rank . "." . $name . " <span class='negative_growth4'>$" . number_format($usdpricetop,2) . "<i class='glyphicon glyphicon-chevron-down' ></i></span> ";
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
    return json_decode(file_get_contents('./json/btcinflue.json'), true)['data'];
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

<?php

// Function which saves the data if you didn't do a request in the past 60 seconds
function searchcoinbyid($ids)
{
		global $results;
		//global $data2;
		//$getNumCoins = $data2;
		$getNumCoins =	json_decode(file_get_contents('./json/coinlist0.json'), true)['data'];
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
				$tempdata = json_decode(file_get_contents('./json/coinlist' . $i . '.json'), true)['data'];
				foreach($tempdata['data'] as $value) {
					if (($value["id"] == $ids)){
						$results["rank"] =  $value["rank"];
						$results["name"] =  $value["name"];
						$results["symbol"] =  $value["symbol"];
						$results["website_slug"] =  $value["website_slug"];
						$results["priceusd"] =  $value["quotes"]["USD"]["price"];
						$results["percentchange1h"] =  $value["quotes"]["USD"]["percent_change_1h"];
						$results["volume24h"] =  $value["quotes"]["USD"]["volume_24h"];
						$results["marketcap"] =  $value["quotes"]["USD"]["market_cap"];
						$results["circulatingsupply"] =  $value["circulating_supply"];
						$results["totalsupply"] =  $value["total_supply"];
						$results["percentchange1h"] =  $value["quotes"]["USD"]["percent_change_1h"];
						$results["percentchange24h"] =  $value["quotes"]["USD"]["percent_change_24h"];
						$results["percentchange7d"] =  $value["quotes"]["USD"]["percent_change_7d"];
					}						
				}
			}
			
}

//$getid = 1;
	if(!isset($_GET['id'])){
		$getid = 1;
	}
	else{
		if(is_numeric($_GET['id'])){
			$getid = htmlspecialchars($_GET['id']);
		}
		else{
			$getid = 1;
		}
	}
	
$results = array();

searchcoinbyid($getid);

	$name = $results["name"]; //get price usd from crypto coin at data[0]
		$symbol = $results["symbol"]; //get price usd from crypto coin at data[0]
		$logo = $results["website_slug"];
		$str = strtolower($logo);
		$ifExists = "coins/64x64/" . $str . ".png";
		echo "<div style=\"border-bottom: 1px solid #2d3849;\">";
		echo "<div  style=\"width: 100%; height: 50px;  background: #0e1116; \">";
		echo "<p style=\" font-size: 16px; font-style: italic; text-align: center; color: white; line-height: 50px; vertical-align: middle; \">";
				
		if (@getimagesize($ifExists)) {
			echo "<img class=\"ico_img\" src=\"coins/64x64/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">";
		}
		else{	
			echo "<img class=\"ico_img\" src=\"coins/64x64/NA.png\" class=\"logo-sprite\" style=\"width:24px; height:20px;\">";
		}
		echo $name . " (" . $symbol . ")";
		echo "</p>";
		echo	"</div>";
		echo "</div>";
		
?>

      
                  <div class="row coininfo">
                      <div class="panel panel-default">
                      <div class="panel-heading">  <h4>Market Information</h4></div>
                       <div class="panel-body">
                      <div class="col-md-2 col-xs-6 col-sm-3 col-lg-2">
					      <div class="text-center">
								<img alt="ranking" src="img/medal2.png" id="profile-image1" class="img-responsive"> 
								 <div class="caption">
									<p class="text_over_image">Rank</p>
									<p class="text_over_image2"><?php echo "#" . $results["rank"]; ?></p>
								</div>
							</div>
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                          <div class="" >
                            <h2><?php echo $results["name"]; ?></h2>
                            <p>symbol:   <b> (<?php echo $results["symbol"];?>)</b></p>
                          
                           
                          </div>
                           <hr>
                          <ul class=" details" >
                            <li > <?php echo "Price (USD): <span class=\"blue_text\"> $" . number_format($results["priceusd"],4) . "</span>"; ?> </li>
                            <li><?php echo "Volume 24hr (USD) : <span class=\"blue_text\"> $" . number_format($results["volume24h"]) . "</span>"; ?> </li>
                            <li> <?php echo "Market Cap (USD): <span class=\"blue_text\"> $" . number_format($results["marketcap"]) . "</span>"; ?> </li>
                            <li> <?php echo "Circulating_Supply: <span class=\"blue_text\"> " . number_format($results["circulatingsupply"]) . "</span>"; ?> </li>
                            <li> <?php echo "Total Supply: <span class=\"blue_text\"> " . number_format($results["totalsupply"]) . "</span>"; ?> </li>
							<li>
							<?php
									echo "Change (1h): ";
									$percentchange = $results["percentchange1h"]; //get price usd from crypto coin at data[0]
									if((float)$percentchange > 0){
										echo "<span class=\"positive_growth3\">";
											echo "+" . number_format($percentchange,2) . "% ";
													echo "<i class='fa fa-chevron-up'></i>";
										echo "</span>";
									}
									else{
										echo "<span class=\"negative_growth3\">";
											echo number_format($percentchange,2) . "% " . " ";
													echo "<i class='fa fa-chevron-down'></i>";
										echo "</span>";
									}
							?>
							</li>
							<li>
							<?php
									echo "Change (24h): ";
									$percentchange24 = $results["percentchange24h"]; //get price usd from crypto coin at data[0]
									if((float)$percentchange24 > 0){
										echo "<span class=\"positive_growth3\">";
											echo "+" . number_format($percentchange24,2) . "% ";
													echo "<i class='fa fa-chevron-up'></i>";
										echo "</span>";
									}
									else{
										echo "<span class=\"negative_growth3\">";
											echo number_format($percentchange24,2) . "% " . " ";
													echo "<i class='fa fa-chevron-down'></i>";
										echo "</span>";
									}
							?>
							</li>
							<li>
							<?php
									echo "Change (7d): ";
									$percentchange7d = $results["percentchange7d"]; //get price usd from crypto coin at data[0]
									if((float)$percentchange7d > 0){
										echo "<span class=\"positive_growth3\">";
											echo "+" . number_format($percentchange,2) . "% ";
													echo "<i class='fa fa-chevron-up'></i>";
										echo "</span>";
									}
									else{
										echo "<span class=\"negative_growth3\">";
											echo number_format($percentchange7d,2) . "% " . " ";
													echo "<i class='fa fa-chevron-down'></i>";
										echo "</span>";
									}
							?>
							</li>
                          </ul>
                          <hr>
                          <div class="col-sm-5 col-xs-6 tital " >Date: <?php echo "<span class=\"blue_text\">" . date("F j, Y") . "</span>"; ?></div>
                      </div>
                </div>
            </div>
            </div>



<?php
//generate graph
$js_array = array();


// Function which saves the data if you didn't do a request in the past 60 seconds
function generateGraph()
{
			
			$gethistoricdat;
			global $getid;
			global $results;
			
			$array = array();
			$num = 0;
	
						$gethistoricdat['data'] = json_decode(file_get_contents('./historicaldat/' . $results["website_slug"] . 'histdata.json'), true)['data'];	
								
						foreach($gethistoricdat['data']["history"] as $stats) {						
								$array[$num]["price"] = $stats["price"]["usd"];
								$array[$num]["marketCap"] = $stats["marketCap"]["usd"];
								$array[$num]["availableSupply"] = $stats["availableSupply"];
								$array[$num]["volume24"] = $stats["volume24"]["usd"];
								$array[$num]["change1h"] = $stats["change1h"];
								$array[$num]["change24h"] = $stats["change24h"];
								$array[$num]["change7d"] = $stats["change7d"];
								$array[$num]["timestamp"] = $stats["timestamp"];
								$array[$num]["date"] = $stats["date"];
								$num = $num + 1;
						}

		return $array;

}


function generateGraph2()
{
			
			$gethistoricdat;
			global $getid;
			global $results;
			
			$array2 = array();
			$num = 0;
	
						$gethistoricdat['data'] = @json_decode(file_get_contents('./historicaldatdaily/' . $results["website_slug"] . 'dailyhistdata.json'), true)['data'];	
							
						foreach($gethistoricdat['data']["history"] as $stats) {						
								$array2[$num]["marketCap"] = $stats["marketCap"]["usd"];
								$array2[$num]["price"] = $stats["price"]["usd"];
								$array2[$num]["availableSupply"] = $stats["availableSupply"];
								$array2[$num]["volume24"] = $stats["volume24"]["usd"];
								$array[$num]["change1h"] = $stats["change1h"];
								$array[$num]["change7d"] = $stats["change7d"];
								$array[$num]["change24h"] = $stats["change24h"];
								$array2[$num]["timestamp"] = $stats["timestamp"];
								$array2[$num]["date"] = $stats["date"];
								$num = $num + 1;
						}
						

		return $array2;

}

?>

  <div id="gads" style="margin: 10px auto 10px auto; display: flex; justify-content: center; align-items: center; text-align:center; background-color: #161d24; width: 100%; height: 0;">
	
 </div>
 
 
 <div  id="searchtitle2" style="border-bottom: 1px solid #2d3849;">
	<div  style="width: 100%; height: 50px;  background: #0e1116;">
		<p style=" font-size: 16px; font-style: italic; text-align: center; color: white; line-height: 50px; vertical-align: middle; ">OHLC Historical Pricing Data (USD) </p>
	</div>
</div>
 
<div id="chart">
	<svg></svg>
</div>
 
 <div class="graphbutton">
	
	<div class="btngraph" >
		<div class="btn-group">
		  <button type="button" class="gr1 btn btn-primary graphbtn" onclick="dailydat()">1d</button>
		  <button type="button" class="gr2 btn btn-primary graphbtn" onclick="day7dat()">7d</button>
		  <button type="button" class="gr3 btn btn-primary graphbtn" onclick="month1()">1m</button>
		  <button type="button" class="gr4 btn btn-primary graphbtn" onclick="month3()">3m</button>
		  <button type="button" class="gr5 btn btn-primary graphbtn" onclick="month12year()">1y</button>
		  <button type="button" class="gr6 btn btn-primary graphbtn" onclick="alldat()">All</button>
		  
		   <button type="button" class="graphchoice btn btn-primary graphbtn" style="margin-left: 20px;" onclick="changegraphtype()">Volume</button>
		  <button type="button" class="graphchoice2 btn btn-primary graphbtn" onclick="changegraphtype2()">MkCap</button>
		</div>
	</div>
	
	<div class="btngraph2">
		<div class="btn-group">
		   <button type="button" class="gr1 btn btn-primary graphbtn" onclick="dailydat()">1d</button>
		  <button type="button" class="gr2 btn btn-primary graphbtn" onclick="day7dat()">7d</button>
		  <button type="button" class="gr3 btn btn-primary graphbtn" onclick="month1()">1m</button>
		  <button type="button" class="gr4 btn btn-primary graphbtn" onclick="month3()">3m</button>
		  <button type="button" class="gr5 btn btn-primary graphbtn" onclick="month12year()">1y</button>
		  <button type="button" class="gr6 btn btn-primary graphbtn" onclick="alldat()">All</button>
		</div>
		
		<div class="btn-group">
			<button type="button" class="graphchoice btn btn-primary graphbtn" style="margin-top: 10px;" onclick="changegraphtype()">Volume</button>
			<button type="button" class="graphchoice2 btn btn-primary graphbtn" style="margin-top: 10px;" onclick="changegraphtype2()">MkCap</button>
		 </div>
	</div>
	 
</div>

 <div id="gads2" style="margin: 10px auto 10px auto; text-align:center;  display: flex; justify-content: center; align-items: center; background-color: #161d24; width: 100%; height: 0;">

 </div>

 <div  id="searchtitle2" style="border-bottom: 1px solid #2d3849;">
	<div  style="width: 100%; height: 50px;  background: #0e1116;">
		<p style=" font-size: 16px; font-style: italic; text-align: center; color: white; line-height: 50px; vertical-align: middle; "> <?php echo $name . " (" . $symbol . ")"; ?> Markets </p>
	</div>
</div>

<div id="outtertable" class="table-responsive" >
	<table id="customers" class=" table borderless table-hover table-condensed">
		<thead > 
		  <tr id="myHeader" class="fixorder" style="z-index: 999999;">
			<th id="startclk" class=" pinned lockx" style="cursor: pointer;" >#</th>
			<th  style="cursor: pointer; ">Exchanges</th>
			<th   style="cursor: pointer; ">Available Pairs</th>
		  </tr>
		</thead>
		
		<tbody > 

 <?php


function getexchangedat()
{
			
			$gethistoricdat;
			//global $getid;
			
			$array2 = array();
			$num = 0;
	
			$gethistoricdat['data'] = @json_decode(file_get_contents('./marketinfo/exchanges.json'), true);	
			
			if(!empty($gethistoricdat['data'])){
				return $gethistoricdat;
			}
			else{
				return false;
			}


}

$exchangedat = getexchangedat();
	$coinname = $symbol;
	$exchangearray = array();
	$numexh = 1;
	
if($exchangedat){
	$exchangest = ($exchangedat['data']);
	
	foreach($exchangest  as $key => $exchangename) {
		foreach($exchangename  as $coinkey => $coins) {
						if($coinname === $coinkey){
							if($numexh > 30){
								echo "<tr class='hidetr' style='display: none;'>";
								
									echo "<td>";
										echo $numexh;
									echo "</td>";
									
									echo "<td>";
										$keytemp =  json_encode($key);
										$keytemp2 =  str_replace('"', "",$keytemp);
										echo $keytemp2;
									echo "</td>";
										
									echo "<td>";
										$temp = json_encode($coins);
										$temp2 = str_replace(',', " , ",str_replace(']', "",str_replace('[', "",str_replace('"', "",$temp))));
										echo $temp2;
									echo "</td>";
								
								echo "</tr>";
							}
							else{
								echo "<tr>";
								
									echo "<td>";
										echo $numexh;
									echo "</td>";
									
									echo "<td>";
										$keytemp =  json_encode($key);
										$keytemp2 =  str_replace('"', "",$keytemp);
										echo $keytemp2;
									echo "</td>";
										
									echo "<td>";
										$temp = json_encode($coins);
										$temp2 = str_replace(',', " , ",str_replace(']', "",str_replace('[', "",str_replace('"', "",$temp))));
										echo $temp2;
									echo "</td>";
								
								echo "</tr>";
							}
							$numexh = $numexh + 1;
							
						}
		}

	}
}

?>
 </tbody> 
	</table>
<?php
if($numexh > 30){
	echo "<div class='btn-group' style='margin-top: 20px;'>";
	 echo "<button id='showall' type='button' class='btn btn-primary graphbtn' style='width:200px;' onclick='showall()'><span id='shall' style='font-size: 16px;'>Show All</span></button>";
	echo "</div>";
}
?>
</div>

	
   
<script>var jArray = <?php echo json_encode(generateGraph()); ?>; var jdailyArray = <?php echo json_encode(generateGraph2());?>;  var coinnamie = "<?php echo $symbol; ?>";</script>
 <script src="js/graphicaldatnw.js" type="text/javascript"></script>
<script src="js/graphscroll.js" type="text/javascript"></script>
<script src="js/searchgforgraphs.js" type="text/javascript"></script>



<hr class="liner">
<div id="navtabbtn">
		<button  id="homebtn" class="navbuttontable" >Back</button>
</div>

<div id="slidebottommenu" class="bottomNav turnback">
<button id="" onclick="bottombarslideup()"  class="slideupmenu" ><span class="glyphicon glyphicon-triangle-top"></span></button>
  <div  style="display: table; margin: 0 auto;">
			<button  id="homebtn2" class="navbuttontable2" ><span class="glyphicon glyphicon-align-left"></span> Home </button>
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
