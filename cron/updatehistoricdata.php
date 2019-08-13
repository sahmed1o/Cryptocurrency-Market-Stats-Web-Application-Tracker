<?php
//get historic data of all coins from https://coinmarketcap.northpole.ro/history.json?coin='


function checkState (){
    $array = json_decode(file_get_contents("../json/historiccoincheck.json"),true);
	//86400 = 24 hours, round to 90000
    if ((time() - $array['lastCheck']) > 46400){ //prevent users from running the script
        return true;
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Restricted Access")';
		echo '</script>';
		return false;
	}
}

function cache()
{
	if (checkState()) {
				$array['lastCheck'] = time();
				file_put_contents("../json/historiccoincheck.json", json_encode($array));
				
	//--------------------- used to get total coins -------------------
		$getNumCoins =	json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
		$totalCoinCount2 = $getNumCoins["metadata"]["num_cryptocurrencies"];
		
			//page = (1530 - (1530 mod 100))/100 = 1530 - 30 = 1500/100 = 15 pages 
			$totalpages = ($totalCoinCount2 - ($totalCoinCount2 % 100))/100; //15 pages
			
			if($totalpages > 18){
				$totalpages = 18;
			}
			//--------------------- used to get total coins -------------------
			
			$breaklimit = 0;
			
			$gethistoricdat;
			$results = array();
			$newdat = array();
			for($i = 0; $i < $totalpages; $i++){
				$tempdata = json_decode(file_get_contents('../json/coinlist' . $i . '.json'), true)['data'];
				//$tempdata = json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
					foreach($tempdata['data'] as $value) {			
								$gethistoricdat['data'] = json_decode(@file_get_contents('../historicaldat/' . $value['website_slug'] . 'histdata.json'), true)['data'];	
								$idData = strval(sizeOf($gethistoricdat)+1);
								$newdat['data']['symbol'] = $value["symbol"];
								$newdat['data']['history'][$idData]["position"] = $value["rank"];	
								$newdat['data']['history'][$idData]["name"] = $value["name"];
								$newdat['data']['history'][$idData]["symbol"] = $value["symbol"];
								$newdat['data']['history'][$idData]["identifier"] = $value['website_slug'];
								$newdat['data']['history'][$idData]["category"] = "currency"; //fix this
								
								$newdat['data']['history'][$idData]["marketCap"]["usd"] = $value["quotes"]["USD"]["market_cap"];
								$newdat['data']['history'][$idData]["marketCap"]["btc"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["eur"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["cny"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["gbp"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["cad"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["rub"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["hkd"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["jpy"] = 0;
								$newdat['data']['history'][$idData]["marketCap"]["aud"] = 0;
								
								
								$newdat['data']['history'][$idData]["price"]["usd"] = $value["quotes"]["USD"]["price"];
								$newdat['data']['history'][$idData]["price"]["btc"] = 0;
								$newdat['data']['history'][$idData]["price"]["eur"] = 0;
								$newdat['data']['history'][$idData]["price"]["cny"] = 0;
								$newdat['data']['history'[$idData]]["price"]["gbp"] = 0;
								$newdat['data']['history'][$idData]["price"]["cad"] = 0;
								$newdat['data']['history'][$idData]["price"]["rub"] = 0;
								$newdat['data']['history'][$idData]["price"]["hkd"] = 0;
								$newdat['data']['history'][$idData]["price"]["jpy"] = 0;
								$newdat['data']['history'][$idData]["price"]["aud"] = 0;
								
								$newdat['data']['history'][$idData]["availableSupply"] = $value["circulating_supply"];
								
								$newdat['data']['history'][$idData]["volume24"]["usd"] = $value["quotes"]["USD"]["volume_24h"];
								$newdat['data']['history'][$idData]["volume24"]["btc"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["eur"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["cny"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["gbp"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["cad"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["rub"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["hkd"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["jpy"] = 0;
								$newdat['data']['history'][$idData]["volume24"]["aud"] = 0;
								
								
								$newdat['data']['history'][$idData]["change1h"] =  $value["quotes"]["USD"]["percent_change_1h"];
								$newdat['data']['history'][$idData]["change24h"] =  $value["quotes"]["USD"]["percent_change_24h"];
								$newdat['data']['history'][$idData]["change7d"] =  $value["quotes"]["USD"]["percent_change_7d"];
										$newdat['data']['history'][$idData]["timestamp"] =  time();
										$newdat['data']['history'][$idData]["date"] =  date('d-m-Y', time());
								
								$results = array_merge_recursive($gethistoricdat,$newdat);

								file_put_contents("../historicaldat/" . $value['website_slug'] . "histdata.json", json_encode($results));
								//break;
					}
			}
		
	}
		
}

// Function to get the data and use it whenever you need it
function getData ()
{
    return cache();
}
	

getData();

echo "finished";

?>