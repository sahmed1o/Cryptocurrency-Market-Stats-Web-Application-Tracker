<!DOCTYPE html>  
<html>
<head>
<title>StatsCryptoMarket.com - About Us</title>
<meta name="description" content="Our website is dedicated to providing live cryptocurrency market data. For more information see our about page.">
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


<div class="jumbotron main-jumbotron" >
      <div class="container">
        <div class="content">
          <h1>About</h1>
          <p class="margin-bottom">Multi-Platform site providing stats for cryptocurrency on both desktop &amp; mobile browsers. View market data, prices, charts, rankings, and more.</a></p>
          <p><a class="btn btn-white" href="market">Market</a></p>
        </div>
      </div>
    </div>
    <section>
      <div id="txtcolor" class="container">
        <h2>Why StatsCryptoMarket?</h2>
        <p class="lead">Our website is dedicated to providing live cryptocurrency market data. We provide users with the latest news in the cryptocurrency world along with the latest cryptocurrency prices, market capitalizations, historical pricing, supported crypto exchanges, &amp; more.</p>
       <p class="lead">StatsCryptoMarket.com allows users to create their own cryptocurrency portfolio without creating an account. The data is stored via local storage and can be accessed only by the user. Users may view our Crypto website on both mobile and desktop browsers.</p> 
		<p>For any questions / comments / bug reports, please contact us via our contact us page, or send us a message using the stated email.</p>
        <p><a href="contact" class="btn btn-ghost">Contact</a></p>
      </div>
    </section>
    <section style="background: #222222 !important; border-top: 2px solid #ddd !important;">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="post" >
              <div class="image"><a href=""><img src="img/blog1.jpg" alt="" class="img-responsive"></a></div>
              <h3 ><a href="" style="color: #f1cb05 !important;">Locus ANS</a></h3>
              <p class="post__intro" style="color: white !important;">View other apps by our publisher here, including StatsCryptoMarket's app</p>
              <p class="read-more"><a href="" class="btn btn-ghost">Read More</a></p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="post">
              <div class="image"><a href="privacypolicy"><img src="img/privacypoli.jpg" alt="" class="img-responsive"></a></div>
              <h3><a href="privacypolicy" style="color: #f1cb05 !important;">Privacy Policy</a></h3>
              <p class="post__intro" style="color: white !important;">View what information we collect &amp; more via our privacy policy page</p>
              <p class="read-more"><a href="privacypolicy" class="btn btn-ghost">Read More</a></p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="post">
              <div class="image"><a href="contact"><img src="img/contactus.jpg" alt="" class="img-responsive"></a></div>
              <h3><a href="contact" style="color: #f1cb05 !important;">Contact US</a></h3>
              <p class="post__intro" style="color: white !important;">Get a hold of us via contact page for any questions/comments/bug reports</p>
              <p class="read-more"><a href="contact" class="btn btn-ghost">Contact</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>


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
