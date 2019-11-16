<!DOCTYPE html>  
<html>
<head>
<title>StatsCryptoMarket.com - Contact Us</title>
<meta name="description" content="Need help with our crypto tools? Found a bug? Or just need some questions answered? Reach us here.">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/scrollingText.css">
  <link rel="stylesheet" type="text/css" href="css/graphmod.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/sort-table.css" title="">
  <link rel="stylesheet" type="text/css" href="css/nv.d3.css">
  <link rel="stylesheet" type="text/css" href="css/newsc.css">
    <!-- lightbox-->
    <link rel="stylesheet" href="css/lightbox.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
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

<body>  
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
			  <li  ><a href="market"  ><span class="glyphicon glyphicon glyphicon glyphicon-stats carty" aria-hidden="true"></span> Market</i></a></li>
			  <li><a href="news"  ><span class="glyphicon glyphicon glyphicon-globe carty" aria-hidden="true"></span> News</a></li>
			  <li><a href="portfolio" ><span class="glyphicon glyphicon glyphicon-level-up carty" aria-hidden="true"></span> Portfolio</a></li>
			  <li class="active"><a href="about"  ><span class="glyphicon glyphicon glyphicon glyphicon-question-sign carty" aria-hidden="true"></span> About</a></li>
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


<div class="jumbotron main-jumbotron3" >
      <div class="container">
        <div class="content">
          <h1>Contact</h1>
        </div>
      </div>
    </div>
    
	<!-- Contact and Location Section-->
    <div class="container" id="contactContain" style="margin-bottom: 40px;">
		<!-- Form Action Section-->
        <form action="contactform" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div id="successfail"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="message">
                    <fieldset class="skip2">
                        <legend style="color: #f1cb05 !important;"><i class="fa fa-envelope"></i> Contact Us</legend>
                    </fieldset>
					  <div class="form-group has-feedback">
                        <label style="color: white !important;" class="control-label" for="from_subject">Subject</label>
                        <input class="form-control" type="text" name="from_subject" required="" placeholder="Subject" id="from_subject" tabindex="-1">
                    </div>
                    <div class="form-group has-feedback">
                        <label style="color: white !important;" class="control-label" for="from_name">Name</label>
                        <input class="form-control" type="text" name="from_name" required="" placeholder="Full Name" id="from_name" tabindex="-1">
                    </div>
                    <div class="form-group has-feedback">
                        <label style="color: white !important;" class="control-label" for="from_email">Email</label>
                        <input class="form-control" type="email" name="from_email" required="" placeholder="Email Address" id="from_email">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <label style="color: white !important;" class="control-label" for="from_phone">Phone (optional)</label>
                                <input class="form-control" type="text" name="from_phone" placeholder="Primary Phone" id="from_phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label style="color: white !important;" class="control-label" for="calltime">Best Time to Call</label>
                                <select class="form-control" name="Call_Time" id="calltime">
                                    <option value="Morning" selected="">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="color: white !important;" class="control-label" for="comments">Comments</label>
                        <textarea class="form-control" rows="5" name="comments" placeholder="Enter comments here" id="comments"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" value="Send">Send <i class="fa fa-chevron-circle-right"></i></button>
                    </div>
                    <hr class="visible-xs-block visible-sm-block">
                </div>
			
				
                <div class="col-md-6">
                    <fieldset>
                        <legend style="color: #f1cb05 !important;"> <i class="fa fa-location-arrow"></i>Information</legend>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="static-map">
									<img src="img/emailcont.jpg" style="width:100%;height:auto;" alt="map of location">
							  </div>
                        </div>
                        <div class="col-sm-6">
                            <fieldset>
                                <legend style="color: #f1cb05 !important;"><i class="fa fa-envelope"></i> Contact Us</legend>
                            </fieldset>
                            <div><span style="color: white !important;"><strong>Direct Contact:</strong></span></div>
                            <div><span style="color: white !important;">statscryptomarket@gmail.com</span></div>
                            <div><span style="color: white !important;">www.statscryptomarket.com</span></div>
                            <hr class="visible-xs-block">
                        </div>
                        <div class="col-sm-6">
                            <fieldset>
                                <legend style="color: #f1cb05 !important;"><i class="fa fa-location-arrow"></i>Location</legend>
                            </fieldset>
                            <div><span style="color: white !important;"><strong>Canada</strong></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
		<!-- End of Form Action Section-->
    </div>
	<!-- End of Contact and Location Section-->
    


	<script> var totalpaget = 0;  var ok = <?php echo intval(isset($_GET['page'])); ?>;</script>
 <script src="js/newsjs.js" type="text/javascript"></script>

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
			<li><a href="https://www.facebook.com/statscryptomarket/" title=""><i class="fa fa-facebook"></i></a></li>
			<li><a href="https://twitter.com/StatsCryptoMKT" title=""><i class="fa fa-twitter"></i></a></li>
			<li><a href="https://plus.google.com/communities/100249174162049985644" title=""><i class="fa fa-google-plus"></i></a></li>
			<li><a href="https://www.instagram.com/statscryptomarket/" title=""><i class="fa fa-instagram"></i></a></li>
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
		<li><a href="https://play.google.com/store/apps/dev?id=7712251101255662062" title=""><i class="fa fa-angle-double-right"></i> App Publisher</a></li>
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
