<!DOCTYPE html>  
<html>
<head>
<title>StatsCryptoMarket - Cryptocurrency Market Data</title>
<meta name="description" content="Multi-Platform site that provides cryptocurrency market caps & prices through live charts & rankings.">
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="300">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/scrollingText.css">
  <link rel="stylesheet" type="text/css" href="css/tablemod.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/portfolio.css">
  <link rel="stylesheet" type="text/css" href="css/sort-table.css" title="">
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
<body>  
<!------ portfolio add ---------->
<div class="popup" >
  <span class="popuptext" id="myPopup">N/A Added</span>
</div>

<div id="popupty" class="popupt">
  <div class="container innerpopupt" >
    <div class="titlepopup"><p>Add to Portfolio</p></div>
	  <h3 id="nameprompt" style="color: white;">N/A</h3>
       <div class="center">
        <p id="priceprompt" style="color: white;">Current price: $0</p>
       <p style="color: white;"> Amount Held</p>
       
    <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger btn-number"  onclick='subcoin()' data-type="minus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-minus"></span>
                </button>
            </span>
            <input id="amntuser" type="text" name="quant[2]" class="form-control input-number" value="0" min="1" max="100">
            <span class="input-group-btn">
                <button type="button" class="btn btn-success btn-number" onclick='addcoin()' data-type="plus" data-field="quant[2]">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </span>
        </div>
        
         <p></p>
		<div class="input-group" style="width: 100%;">
			<input id="amtcoin" type="text" name="quant[2]" class="form-control input-number"  value="0 BTC" min="1" max="100" readonly style="text-align: center; ">
		</div>
        
    <p></p>
  
   <button type="button" class="btn btn-primary  btnyes" onclick='addtoportfolio()' style="width: 100%;" ><span class="glyphicon glyphicon-ok"></span></button>
	
	 <p></p>
  </div>

 


    <button type="button" class="btn btn-primary col-xs-12  btnot" onclick='closeprompt()'><span class="glyphicon glyphicon-remove"></span></button>

  </div>
</div>
<!------ portfolio add ---------->

<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<a href="javascript:" id="return-to-bottom"><i class="fa fa-chevron-down"></i></a>


<?php
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


//$page = 1;
	if(!isset($_GET['page'])){
		$page = 0;
	}
	else{
		if(is_numeric($_GET['page'])){
			$page = htmlspecialchars($_GET['page']);
		}
		else{
			$page = 0;
		}
	}
	

$data = getData($page);
$data2 = getData(0); //for scrolling text above to get data from page 1

$totalCoinCount3 = $data["metadata"]["num_cryptocurrencies"];
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
			  <li  class="active"><a href="market"  ><span class="glyphicon glyphicon glyphicon glyphicon-stats carty" aria-hidden="true"></span> Market</i></a></li>
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

<div id="indicatory" class="blink_me" style="width: 100%; position: fixed; margin-top: 100px; pointer-events:none;">
	<img id="tabpic" style="float:right; clear:right;" src="img/arrows.png" width="20" height="130">
</div>



<div id="imgtop">
	<img id="navpic" src="img/topimgbtext.png" width="1880" height="600">
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


 <div id="gads2" style="margin: 0 auto; text-align:center; background-color: #0e1116; width: 100%; height: 0;">

	<!-- Main Banner AD 1 -->
	
 </div>
	
<div id="tabletitle" style="border-bottom: 1px solid #2d3849; border-top: 1px solid #2d3849;">
	<div id="tabletitlexvg" style="width: 100%; height: 100px;  background: #0e1116; ">
		<p style=" font-size: 24px; font-style: italic; text-align: center; color: white; line-height: 100px; vertical-align: middle; ">Cryptocurrency Market Capitalizations</p>
	</div>
</div>

 <div id="gads" style="float:none;margin:0px 0 0px 0;text-align:center;  background-color: #0e1116;  width: 100%; height: 0;">
	
	<!-- Main Banner AD 1 -->
	
 </div>


 
<div id="outtertable" class="table-responsive gdgadg">
<table id="customers3" class="js-sort-table table borderless table-hover table-condensed">
		<thead > 
		  <tr id="myHeader" class="tablecellttun" style="z-index: 99;   display: none;">
			<th class="js-sort-number pinned lockx" style="cursor: pointer;" >#</th>
			<th class="js-sort-string headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			
		  </tr>
		  </thead>
		  <tbody>
		  </tbody>
</table>
</div>

<div id="outtertable" class="table-responsive gdgadg">
<table id="customers3" class="js-sort-table table borderless table-hover table-condensed adfadfa">
		<thead > 
		  <tr id="myHeader" class="fixorder" style="z-index: 999999;   display: none;">
			<th   onclick="sortrank()" class=" pinned lockx" style="cursor: pointer;" >#</th>
			<th   onclick="sortname()" class=" headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			<th   onclick="sortprice()" class="js-sort-number" style="cursor: pointer; ">USD</th>
			<th   onclick="sortchange()" class="js-sort-number" style="cursor: pointer; ">%</th>
			<th   style="cursor: pointer; "><span class="glyphicon glyphicon glyphicon-level-up" style='font-size:16px;' aria-hidden="true"></span></th>
			<th   onclick="sortvol()" class="js-sort-number" style="cursor: pointer; ">Volume (24hr) USD</th>
			<th   onclick="sortmkcap()" class="js-sort-number" style="cursor: pointer; ">Market Cap USD</th>
			<th   onclick="sortavsuppl()" class="js-sort-number" style="cursor: pointer; ">Available Supply</th>
			<th   onclick="sorttotsup()" class="js-sort-number" style="cursor: pointer; ">Total Supply</th>
			<th   onclick="sortchangehr()" class="js-sort-number" style="cursor: pointer; ">Change (1h)</th>
			<th   onclick="sortchangehrtwent()" class="js-sort-number" style="cursor: pointer; ">Change (24h)</th>
			<th   onclick="sortchangeday()" class="js-sort-number" style="cursor: pointer; ">Change (7d)</th>
			
		  </tr>
		  </thead>
		  <tbody>
		  </tbody>
</table>
</div>


<div id="outtertable" class="table-responsive thistablu">
	<table id="customers" class="js-sort-table table tabulart borderless table-hover table-condensed">
		<thead > 
		  	<!-- Fixes X width for table header -->
		 <tr  id="myHeader2" class="afas" style="z-index: 999; ">
			<th  id="startclk"  class="js-sort-number  pinned lockx" style="cursor: pointer;" >#</th>
			<th  id="startclkname" class="js-sort-string headercellClass pinned lockx2" style="cursor: pointer;">Name</th>
			<th  id="startclkprice" class="js-sort-number" style="cursor: pointer; ">USD</th>
			<th  id="startclkchange" class="js-sort-number" style="cursor: pointer; ">%</th>
			<th  class="js-sort-number" style="cursor: pointer; "><span class="glyphicon glyphicon glyphicon-level-up" style='font-size:16px;' aria-hidden="true"></span></th>
			<th  id="startclkvol" class="js-sort-number" style="cursor: pointer; ">Volume (24hr) USD</th>
			<th  id="startclkmkcap" class="js-sort-number" style="cursor: pointer; ">Market Cap USD</th>
			<th  id="startclkavsupply" class="js-sort-number" style="cursor: pointer; ">Available Supply</th>
			<th  id="startclktotsupply" class="js-sort-number" style="cursor: pointer; ">Total Supply</th>
			<th  id="startclkchangehr" class="js-sort-number" style="cursor: pointer; ">Change (1h)</th>
			<th  id="startclkchangehrtwent" class="js-sort-number" style="cursor: pointer; ">Change (24h)</th>
			<th  id="startclkchangeday" class="js-sort-number" style="cursor: pointer; ">Change (7d)</th>
			
		  </tr>
		</thead>
		
		<tbody > 
	
		<?php
		
		foreach ($data['data'] as $value) {
			
			echo "<tr>";
			
			$rank = $value["rank"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"pinned\">";
			echo $rank;
			echo "</td>";
			
			$name = $value["name"]; //get price usd from crypto coin at data[0]
			$symbol = $value["symbol"]; //get price usd from crypto coin at data[0]
			$logo = $value["website_slug"];
			$str = strtolower($logo);
			$ifExists = "coins/16x16/" . $str . ".png";
			echo "<td class=\"cellClass pinned\">";
			if (@getimagesize($ifExists)) {
				echo "<img class=\"ico_img\" src=\"coins/16x16/" . $str . ".png\" class=\"logo-sprite\" style=\"width:20px; height:16px;\">";
			}
			else{	
				echo "<img class=\"ico_img\" src=\"coins/16x16/NA.png\" class=\"logo-sprite\" style=\"width:24px; height:20px;\">";
			}
			
			echo "<a href=\"coininfo?id=" .  $value["id"] . "\">";
			echo $name . " (" . $symbol . ")";
			echo "</a>";
			echo "</td>";


			$price_usd = $value["quotes"]["USD"]["price"]; //get price usd from crypto coin at data[0]
			echo "<td>";
			echo "$" . number_format($price_usd,4);
			echo "</td>";
			
			$percentchange2 = $value["quotes"]["USD"]["percent_change_1h"]; //get price usd from crypto coin at data[0]
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
			echo "<td onclick=\"openprompt('" . $name . "','" . $price_usd . "','" . $rank . "','" . $symbol . "')\">";
			//echo $price_btc;
			echo "<i class='fa fa-plus-circle' style='font-size:20px; cursor: pointer;'></i>";
			echo "</td>";

			$voltwent = $value["quotes"]["USD"]["volume_24h"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo "$" . number_format($voltwent);
			echo "</td>";

			$marketcap = $value["quotes"]["USD"]["market_cap"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo "$" . number_format($marketcap);
			echo "</td>";

			$availsupply = $value["circulating_supply"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo number_format($availsupply);
			echo "</td>";

			$totsupply = $value["total_supply"]; //get price usd from crypto coin at data[0]
			echo "<td class=\"yellow_text\">";
			echo number_format($totsupply);
			echo "</td>";

			$percentchange = $value["quotes"]["USD"]["percent_change_1h"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange > 0){
				echo "<td class=\"positive_growth\">";
					echo "+" . number_format($percentchange,2) . "%";
			}
			else{
				echo "<td class=\"negative_growth\">";
					echo number_format($percentchange,2) . "%";
			}
			echo "</td>";

			$percentchange24 = $value["quotes"]["USD"]["percent_change_24h"]; //get price usd from crypto coin at data[0]
			if((float)$percentchange24 > 0){
				echo "<td class=\"positive_growth\">";
					echo "+" . number_format($percentchange24,2) . "%";
			}
			else{
				echo "<td class=\"negative_growth\">";
					echo number_format($percentchange24,2) . "%";
			}
			echo "</td>";
			
			$percentchange7 = $value["quotes"]["USD"]["percent_change_7d"]; //get price usd from crypto coin at data[0]
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
		} 

		?>
		</tbody> 
	</table>
		<div id="navtabbtn" style="margin-top: 20px !important;">
			<button id="backbtn" class="navbuttontable" >Back 100</button>
			<button id="nextbtn" class="navbuttontable" >Next 100</button>
		</div>

</div>




<script> var totalpaget = <?php echo $totalpages2; ?>; var ok = <?php echo intval(isset($_GET['page'])); ?>; </script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/popupport.js" type="text/javascript"></script>

<div id="slidebottommenu" class="bottomNav turnback">
<button id="" onclick="bottombarslideup()"  class="slideupmenu" ><span class="glyphicon glyphicon-triangle-top"></span></button>
  <div  style="display: table; margin: 0 auto;">
			<button id="backbtn2" class="navbuttontable2" ><span class="glyphicon glyphicon-align-left"></span> Back 100</button>
			<button id="nextbtn2" class="navbuttontable2" >Next 100 <span class="glyphicon glyphicon-align-right"></span></button>
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
