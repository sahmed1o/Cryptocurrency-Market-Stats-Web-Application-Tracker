<?php
/*
ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
ini_set("max_execution_time", 0);
ini_set("memory_limit", "10000M");
*/
$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);

function checkState ()
{
    $array = json_decode(file_get_contents("../json/newscheck.json"),true);
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
        file_put_contents("../json/newscheck.json", json_encode($array));
		   $feedurl = "https://cointelegraph.com/rss/tag/altcoin";
			$feedme = file_get_contents($feedurl);
			if($feedme):
			  $fh = fopen('../json/coinnews.xml', 'w+'); //create new file if not exists
			  fwrite($fh, $feedme) or die("Failed to write contents to new file"); //write contents to new XML file
			  fclose($fh) or die("failed to close stream resource"); //close resource stream
			else:
			  die("Failed to read contents of feed at $feedurl");
			endif;
	}
}

// Function to get the data and use it whenever you need it
function getNewsData ()
{
    return cache();
}

getNewsData();

?>