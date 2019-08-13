<?php

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
				$array['lastCheck'] = time();
				file_put_contents("../json/dailycoincheck.json", json_encode($array));
					//for($i = 1; $i < $totalpages; $i++){
						//$tempdata = json_decode(file_get_contents('./json/coinlist' . $i . '.json'), true)['data'];
						$tempdata = json_decode(file_get_contents('../json/coinlist0.json'), true)['data'];
							foreach($tempdata['data'] as $value) {				
										$gethistoricdat = @json_decode(file_get_contents('../historicaldat/' . $value['website_slug'] . 'histdata.json'), true);	
										
										echo(json_encode($gethistoricdat["data"]["Message"] ));
										
										
					}
}

function getData ()
{
    return cache();
}
	

getData();

echo "finished";

?>