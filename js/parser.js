//alert(httpGet("http://www.amazon.com/Godzilla-Vs-Gigan-Blu-ray/dp/B00I462XLG/ref=sr_1_34?s=movies-tv&ie=UTF8&qid=1400714243&sr=1-34"));


/*document.write(httpGet("http://www.amazon.com/Godzilla-Vs-Gigan-Blu-ray/dp/B00I462XLG/ref=sr_1_34?s=movies-tv&ie=UTF8&qid=1400714243&sr=1-34"));

function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, true );
    xmlHttp.send();
    return xmlHttp.responseText;
}*/

window.onload = function(){ 
    $.ajax({
          type: 'GET', 
          url: 'http://www.google.com',
          dataType: 'html',
          success: function(data) {

			$.support.CORS = true;
			crossDomain:'true';
            //cross platform xml object creation from w3schools
            try //Internet Explorer
              {
              xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
              xmlDoc.async="false";
              xmlDoc.loadXML(data);
              }
            catch(e)
              {
              try // Firefox, Mozilla, Opera, etc.
                {
                parser=new DOMParser();
                xmlDoc=parser.parseFromString(data,"text/xml");
                }
              catch(e)
                {
                alert(e.message);
                return;
                }
              }

            alert(xmlDoc.getElementsByTagName("title")[0].childNodes[0].nodeValue);
          }
    });
  }