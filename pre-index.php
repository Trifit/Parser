<?php


$uri1 = "http://www.amazon.com/Toshiba-Satellite-C55-A5245-15-6-Inch-Horizon/dp/B00D78PZE8/ref=lp_9277875011_1_1?s=pc&ie=UTF8&qid=1400886357&sr=1-1";
$uri2 = "http://www.walmart.com/ip/HP-Charcoal-15.6-15-g019wm-Laptop-PC-with-AMD-E1-2100-Accelerated-Processor-4GB-Memory-500GB-Hard-Drive-and-Windows-8.1/34083867";
$uri3 = "http://www.target.com/p/gateway-15-6-laptop-pc-ne52224u-with-1tb-hard-drive-6gb-memory-silver/-/A-15134725#?lnk=sc_qi_detaillink";

parseAma ($uri1,'h1','actualPriceValue');
parseWal ($uri2,'h1','clearfix camelPrice ');
parseTar ($uri3,'product-name item','offerPrice');

function parseAma($url,$title_field,$price_field){
	Echo "<h1>Amazon Price:</h1><br>";
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	
	$dom->loadHTMLFile($url);
	libxml_clear_errors();

	$titles=$dom->getElementsByTagName($title_field);
	foreach($titles as $title) {
		echo $title->nodeValue;
	}
	echo "-> <b>".$dom->getElementById($price_field)->nodeValue."</b><br>";
}

function parseWal($url,$title_field,$price_field){
	Echo "<h1>Walmart Price:</h1><br>";
	$dom = new DOMDocument();
	libxml_use_internal_errors(TRUE);
	$dom->loadHTMLFile($url);
	libxml_clear_errors();

	$titles=$dom->getElementsByTagName($title_field);
	foreach($titles as $title) {
		echo $title->nodeValue;
	}

	$prices=$dom->getElementsByTagName('span');
	foreach($prices as $price) {
		//echo "<br>".$price->getAttribute('class') ."->".$price->nodeValue."<br>";
		if ($price->getAttribute('class')==$price_field)	
			echo "-><b> ". $price->nodeValue."</b><br>";
	}
	
}

function parseTar($url,$title_field,$price_field){
	Echo "<h1>Target Price:</h1><br>";
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	
	$dom->loadHTMLFile($url);
	libxml_clear_errors();

	$titles=$dom->getElementsByTagName('span');

	foreach($titles as $title) {
		if ($title->getAttribute('class')==$title_field)
			echo $title->nodeValue;
	}

	$prices=$dom->getElementsByTagName('span');
	
	foreach($prices as $price) {
		//echo "<br>".$price->getAttribute('class') ."->".$price->nodeValue."<br>";
		if ($price->getAttribute('class')==$price_field)	
			echo "-><b> ". $price->nodeValue."</b><br>";
	}
}

?>