<?php
//get historic data of all coins from https://coinmarketcap.northpole.ro/history.json?coin='

function cache()
{
	//--------------------- used to get total coins -------------------
		$getNumCoins =	json_decode(file_get_contents('./json/coinlist0.json'), true)['data'];
		$totalCoinCount2 = $getNumCoins["metadata"]["num_cryptocurrencies"];
		
			//page = (1530 - (1530 mod 100))/100 = 1530 - 30 = 1500/100 = 15 pages 
			$totalpages = ($totalCoinCount2 - ($totalCoinCount2 % 100))/100; //15 pages
			
			if($totalpages > 18){
				$totalpages = 18;
			}
			//--------------------- used to get total coins -------------------
			
			$gethistoricdat;
			$results = array();
			$is_skip = 1;
			$first_year = 2000;
			//for($i = 1; $i < $totalpages; $i++){
				//$tempdata = json_decode(file_get_contents('./json/coinlist' . $i . '.json'), true)['data'];
				$tempdata = json_decode(file_get_contents('./json/coinlist2.json'), true)['data'];
					foreach($tempdata['data'] as $value) {
						//for($yeart = 2012; $yeart < 2019; $yeart++){	
						for($yeart = 2016; $yeart < 2019; $yeart++){	
		
								$checkLink = @file_get_contents('https://coinmarketcap.northpole.ro/history.json?coin='. $value['website_slug'] . '&period=' . $yeart . '&format=array');
								if ( $checkLink !== false ){
									$gethistoricdat['data'] = json_decode($checkLink, true);	
									
									if($is_skip == 1){
										$is_skip = 0;
										$first_year = $yeart;
									}
									if($is_skip == 0){
										if($yeart == $first_year){
												$results = $gethistoricdat;
										}
										else{
											$results = array_merge_recursive($results,$gethistoricdat);
										}
									}
									
								}

								
						}
								file_put_contents("./historicaldat/" . $value['website_slug'] . "histdata.json", json_encode($results));
									$is_skip = 0;
									$first_year = 2000;
									$results = array(); 
								sleep(5);
					}
			//}
		
}

// Function to get the data and use it whenever you need it
function getData ()
{
    return cache();
}
	

getData();

echo "finished";

?>