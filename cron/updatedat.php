<?php
//update data using coinmarketcaps api, this includes coinlist, run as cron job every 3 mins

// Function to check if you already did a request in the past 60 seconds
function checkState ()
{
    $array = json_decode(file_get_contents("../json/coinlist0.json"),true);
    if ((time() - $array['lastCheck']) > 240){ //prevent users from running the script
       	return true;
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Restricted Access")';
		echo '</script>';
		return false;
	}
}

// Function which saves the data if you didn't do a request in the past 60 seconds
function cache()
{
    if (checkState()) {
        $array['lastCheck'] = time();
        $array['data'] = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/?start=0&limit=100'), true);
		if ($array['data'] === null && json_last_error() !== JSON_ERROR_NONE) {
			echo "json data cache1 cmmk is incorrect";
		}
		else{
			//dont include this in for loop, we need can issue 1 less request with this segment
			file_put_contents("../json/coinlist0.json", json_encode($array));
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
				for($i = 1; $i < $totalpages; $i++){
					$numcoins = $numcoins + 100;
					$tempArray['data'] = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/?start='. $numcoins . '&limit=100'), true);

					if ($tempArray['data'] === null && json_last_error() !== JSON_ERROR_NONE) {
						echo "json cache2 cmmk is incorrect";
					}
					else{					
						file_put_contents("../json/coinlist" . $i . ".json", json_encode($tempArray));
					}
				}
		}
		
	}
	else{
		echo "failed to retrieve data";
	}
    //return json_decode(file_get_contents('./json/coinlist' . $page . '.json'), true)['data'];
}

// Function to get the data and use it whenever you need it
function getData ()
{
    return cache();
}
	

// Function to check if you already did a request in the past 60 seconds
function checkStateGetBTCDat ()
{
    $array2 = json_decode(file_get_contents("../json/btcinflue.json"),true);
    if ((time() - $array2['lastCheck']) > 300)
        return true;
    return false;
}

// Function which saves the data if you didn't do a request in the past 60 seconds
function cacheGetBTCDat()
{
    if (checkStateGetBTCDat()) {
        $array2['lastCheck'] = time();
        $array2['data'] = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/global/'), true);
		if ($array2['data'] === null && json_last_error() !== JSON_ERROR_NONE) {
						echo "json cacheGetBTCDat cmmk is incorrect";
		}
		else{					
			file_put_contents("../json/btcinflue.json", json_encode($array2));
		}
	}
    //return json_decode(file_get_contents('./json/btcinflue.json'), true)['data'];
}

// Function to get the data and use it whenever you need it
function getBTCDat ()
{
    return cacheGetBTCDat();
}

getBTCDat();
getData();

echo "finished";

?>