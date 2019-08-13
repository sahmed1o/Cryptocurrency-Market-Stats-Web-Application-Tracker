<?php
//Run cron job every day 5mins after 12
//remove break after graph generation is finished

// Function to check if you already did a request in the past 60 seconds
function checkState ()
{
    $array = json_decode(file_get_contents("../json/deletedailycoincheck.json"),true);
    //86400 = 24 hours
    if ((time() - $array['lastCheck']) > 70000){ //prevent users from running the script
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
	//--------------------- used to get total coins -------------------
		$getNumCoins =	json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
		$totalCoinCount2 = $getNumCoins["metadata"]["num_cryptocurrencies"];
		
			//page = (1530 - (1530 mod 100))/100 = 1530 - 30 = 1500/100 = 15 pages 
			$totalpages = ($totalCoinCount2 - ($totalCoinCount2 % 100))/100; //15 pages
			
			if($totalpages > 18){
				$totalpages = 18;
			}
			
	//--------------------- used to get total coins -------------------
			$gethistoricdat;
			$results = array();
			$newdat = array();
			 if (checkState()) {
				$array['lastCheck'] = time();
				file_put_contents("../json/deletedailycoincheck.json", json_encode($array));
					for($i = 0; $i < $totalpages; $i++){
						$tempdata = json_decode(file_get_contents('../json/coinlist' . $i . '.json'), true)['data'];
						//$tempdata = json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
							foreach($tempdata['data'] as $value) {				
									//empty file
									file_put_contents("../historicaldatdaily/" . $value['website_slug'] . "dailyhistdata.json", "");
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