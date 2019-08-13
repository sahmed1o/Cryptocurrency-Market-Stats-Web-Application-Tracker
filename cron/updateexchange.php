<?php


function checkState ()
{
    $array = json_decode(file_get_contents("../json/exchangecheck.json"),true);
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

function cache()
{
    if (checkState()) {
        $array['lastCheck'] = time();
        file_put_contents("../json/exchangecheck.json", json_encode($array));
		   $feedurl = "https://min-api.cryptocompare.com/data/all/exchanges";
			$feedme = file_get_contents($feedurl);
			if($feedme):
			  $fh = fopen('../marketinfo/exchanges.json', 'w+'); //create new file if not exists
			  fwrite($fh, $feedme) or die("Failed to write contents to new file"); //write contents to new XML file
			  fclose($fh) or die("failed to close stream resource"); //close resource stream
			else:
			  die("Failed to read contents of feed at $feedurl");
			endif;
	}
}

// Function to get the data and use it whenever you need it
function getExchangeData()
{
    return cache();
}

getExchangeData();

?>