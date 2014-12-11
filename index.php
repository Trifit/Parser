<?php
$uri1 = "http://www.amazon.com/Toshiba-Satellite-C55-A5245-15-6-Inch-Horizon/dp/B00D78PZE8/ref=lp_9277875011_1_1?s=pc&ie=UTF8&qid=1400886357&sr=1-1";
$uri2 = "http://www.walmart.com/ip/HP-Charcoal-15.6-15-g019wm-Laptop-PC-with-AMD-E1-2100-Accelerated-Processor-4GB-Memory-500GB-Hard-Drive-and-Windows-8.1/34083867";
$uri3 = "http://www.target.com/p/gateway-15-6-laptop-pc-ne52224u-with-1tb-hard-drive-6gb-memory-silver/-/A-15134725#?lnk=sc_qi_detaillink";


echo "
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class='no-js lt-ie9 lt-ie8 lt-ie7'> <![endif]-->
<!--[if IE 7]>         <html class='no-js lt-ie9 lt-ie8'> <![endif]-->
<!--[if IE 8]>         <html class='no-js lt-ie9'> <![endif]-->
<!--[if gt IE 8]><!--> <html class='no-js'> <!--<![endif]-->
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <title></title>
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link rel='stylesheet' href='css/bootstrap.min.css'>
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel='stylesheet' href='css/bootstrap-theme.min.css'>
        <link rel='stylesheet' href='css/main.css'>

        <script src='js/vendor/modernizr-2.6.2-respond-1.1.0.min.js'></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class='browsehappy'>You are using an <strong>outdated</strong> browser. Please <a href='http://browsehappy.com/'>upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
      <div class='container'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='#'>Price searcher</a>
        </div>
        <div class='navbar-collapse collapse'>
          <form class='navbar-form navbar-right' role='form'>
            <div class='form-group'>
              <input type='text' placeholder='Email' class='form-control'>
            </div>
            <div class='form-group'>
              <input type='password' placeholder='Password' class='form-control'>
            </div>
            <button type='submit' class='btn btn-success'>Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class='jumbotron'>
      <div class='container'>
        <h1>Price searcher (pre-alpha ver)</h1>
        <p>First version for the price searcher</p>
        
      </div>
    </div>

    <div class='container'>
      <!-- Example row of columns -->
      <div class='row'>
        <div class='col-md-4'>
          <h2>Amazon price</h2>
          <p>";

          parser ($uri1,'h1','actualPriceValue',false);
          
          echo "</p>
          <p><a class='btn btn-default' href=";

          echo $uri1;

          echo " role='button'>View details &raquo;</a></p>
        </div>
        <div class='col-md-4'>
          <h2>Walmart price</h2>
          <p>";
          parser ($uri2,'h1','clearfix camelPrice ',true);
          echo "</p>
          <p><a class='btn btn-default' href=" ;

          echo $uri2;

          echo " role='button'>View details &raquo;</a></p>
       </div>
        <div class='col-md-4'>
          <h2>Target price</h2>
          <p>";
          parser ($uri3,'h2','offerPrice',true);          

          echo"</p>
          <p><a class='btn btn-default' href=";
          echo $uri3;
          echo " role='button'>View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Untoo 2014</p>
      </footer>
    </div> <!-- /container -->        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
        <script>window.jQuery || document.write('<script src='js/vendor/jquery-1.11.0.min.js'><\/script>')</script>

        <script src='js/vendor/bootstrap.min.js'></script>

        <script src='js/main.js'></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>";



function parser($url,$title_field,$price_field,$parse_tag){
  //if $parse_tag is set to true then we parse by tag name (span with the class equal to $price_field) otherwise parse by id equal to "$price_field"
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  
  $dom->loadHTMLFile($url);
  libxml_clear_errors();
  $price_value="";
  $titles=$dom->getElementsByTagName($title_field);
  foreach($titles as $title) {
    echo $title->nodeValue;
  }

  if ($parse_tag==true){
    $prices=$dom->getElementsByTagName('span');  
    foreach($prices as $price) {    
      if ($price->getAttribute('class')==$price_field)
        $price_value=substr($price->nodeValue,1);
    
        //echo "<div class='text-right'><strong>$".substr($price->nodeValue,1)."</strong></div>";        
    }  
  }else{
    $price_value=$dom->getElementById($price_field)->nodeValue;
    $price_value=substr($price_value, 1); 
    echo $price_value;

    //echo "<div class='text-right'><strong>$".$price_value."</strong></div>";   
  }
  return $price_value;
}

?>
