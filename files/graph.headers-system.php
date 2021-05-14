<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Chart Page</title>
  </head>
  <body>
  <a href='/admin-page.php'>Previous Page</a>
  <a href='/logout-system.php'>Log out</a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <canvas id="chartContainer" width="1200" height="400"></canvas>
  
  <button  id="TTL">TTL analysis</button>
  <button  id="Pub">Public percentage</button>
  <button  id="Pri">Private percentage</button>
  <button  id="Noc">No cache percentage</button>
  <button  id="Nos">No store percentage</button>
  
  <script>
  var info=new Array();
  var contres=new Array();
  var cachres=new Array();
  var cachres1=new Array();
  var expres=new Array();
  var lares=new Array();
  var pro=new Array();
  var contreq=new Array();
  var cachreq=new Array();
  var found=new Array();
  var edate=new Array();
  var ldate=new Array();
  var etime=new Array();
  var ltime=new Array();
  var diff=new Array();
  var maxage=new Array();
  
  
  const nod=new Array();
  const nod1=new Array();
  const prova=new Array();
  var counter=0;
  var counter1=0;
  var counter2=0;
  var counter3=0;
  var counter4=0;
  var counter5=0;
  var counter6=0;
  var counter7=0;
  var counter8=0;
  var counter9=0;
  
  var count=0;
  var count1=0;
  var count2=0;
  var count3=0;
  var count4=0;
  var count5=0;
  var count6=0;
  var count7=0;
  var count8=0;
  var count9=0;
  var count10=0;
  var count11=0;
  var count12=0;
  var count13=0;
  var count14=0;
  var count15=0;
  
  var coun=0;
  var coun1=0;
  var coun2=0;
  var coun3=0;
  var coun4=0;
  var coun5=0;
  var coun6=0;
  var coun7=0;
  var coun8=0;
  var coun9=0;
  var coun10=0;
  var coun11=0;
  var coun12=0;
  var coun13=0;
  var coun14=0;
  var coun15=0;
  
  var pubhtml=0;
    var pubhtmlote=0;
    var pubhtmlfor=0;
    var pubhtmlwin=0;
    var prihtml=0;
    var prihtmlote=0;
    var prihtmlfor=0;
    var prihtmlwin=0;
    var nochtml=0;
    var nochtmlote=0;
    var nochtmlfor=0;
    var nochtmlwin=0;
    var noshtml=0;
    var noshtmlote=0;
    var noshtmlfor=0;
    var noshtmlwin=0;
var pubcss=0;
    var pubcssote=0;
    var pubcssfor=0;
    var pubcsswin=0;
    var pricss=0;
    var pricssote=0;
    var pricssfor=0;
    var pricsswin=0;
    var noccss=0;
    var noccssote=0;
    var noccssfor=0;
    var noccsswin=0;
    var noscss=0;
    var noscssote=0;
    var noscssfor=0;
    var noscsswin=0;
var pubplain=0;
    var pubplainote=0;
    var pubplainfor=0;
    var pubplainwin=0;
    var priplain=0;
    var priplainote=0;
    var priplainfor=0;
    var priplainwin=0;
    var nocplain=0;
    var nocplainote=0;
    var nocplainfor=0;
    var nocplainwin=0;
    var nosplain=0;
    var nosplainote=0;
    var nosplainfor=0;
    var nosplainwin=0;
var pubtjs=0;
    var pubtjsote=0;
    var pubtjsfor=0;
    var pubtjswin=0;
    var pritjs=0;
    var pritjsote=0;
    var pritjsfor=0;
    var pritjswin=0;
    var noctjs=0;
    var noctjsote=0;
    var noctjsfor=0;
    var noctjswin=0;
    var nostjs=0;
    var nostjsote=0;
    var nostjsfor=0;
    var nostjswin=0;
var pubfont=0;
    var pubfontote=0;
    var pubfontfor=0;
    var pubfontwin=0;
    var prifont=0;
    var prifontote=0;
    var prifontfor=0;
    var prifontwin=0;
    var nocfont=0;
    var nocfontote=0;
    var nocfontfor=0;
    var nocfontwin=0;
    var nosfont=0;
    var nosfontote=0;
    var nosfontfor=0;
    var nosfontwin=0;
var pubajs=0;
    var pubajsote=0;
    var pubajsfor=0;
    var pubajswin=0;
    var priajs=0;
    var priajsote=0;
    var priajsfor=0;
    var priajswin=0;
    var nocajs=0;
    var nocajsote=0;
    var nocajsfor=0;
    var nocajswin=0;
    var nosajs=0;
    var nosajsote=0;
    var nosajsfor=0;
    var nosajswin=0;
var pubjson=0;
    var pubjsonote=0;
    var pubjsonfor=0;
    var pubjsonwin=0;
    var prijson=0;
    var prijsonote=0;
    var prijsonfor=0;
    var prijsonwin=0;
    var nocjson=0;
    var nocjsonote=0;
    var nocjsonfor=0;
    var nocjsonwin=0;
    var nosjson=0;
    var nosjsonote=0;
    var nosjsonfor=0;
    var nosjsonwin=0;
var pubim=0;
    var pubimote=0;
    var pubimfor=0;
    var pubimwin=0;
    var priim=0;
    var priimote=0;
    var priimfor=0;
    var priimwin=0;
    var nocim=0;
    var nocimote=0;
    var nocimfor=0;
    var nocimwin=0;
    var nosim=0;
    var nosimote=0;
    var nosimfor=0;
    var nosimwin=0;
var pubn=0;
    var pubnote=0;
    var pubnfor=0;
    var pubnwin=0;
    var prin=0;
    var prinote=0;
    var prinfor=0;
    var prinwin=0;
    var nocn=0;
    var nocnote=0;
    var nocnfor=0;
    var nocnwin=0;
    var nosn=0;
    var nosnote=0;
    var nosnfor=0;
    var nosnwin=0;
var pubo=0;
    var puboote=0;
    var pubofor=0;
    var pubowin=0;
    var prio=0;
    var prioote=0;
    var priofor=0;
    var priowin=0;
    var noco=0;
    var nocoote=0;
    var nocofor=0;
    var nocowin=0;
    var noso=0;
    var nosoote=0;
    var nosofor=0;
    var nosowin=0;

  
  
  /*Συλλογή δεδομένων*/
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "headers.php");
	xhr.send();
	xhr.onload = function(){
		result = this.response;//data from php
		var edit=result.split("]");
		analysis(edit);
	};
  
  /*Βασική Συνάρτηση επεξεργασίας δεδομένων και δημιουργίας γραφημάτων*/
	function analysis (edit) {
		for (var i=0;i<edit.length-1;i++){
			info[i]=edit[i].slice(1);
			info[i]=info[i].split(",");
			contres[i]=info[i][0];//the contentType from response
			cachres[i]=info[i][1].slice(1,-1);//the cacheControl from response
			expres[i]=info[i][2].slice(6,-5);//the expires from response
			edate[i]=expres[i].slice(0,-9);
			etime[i]=expres[i].slice(-8);
			cachres[i]=cachres[i].split(" ");
			cachres1[i]=info[i][1].slice(1,-1);
			cachres1[i]=cachres1[i].split(" ");
			lares[i]=info[i][3].slice(6,-5);//the lastModified from response
			ldate[i]=lares[i].slice(0,-9);
			ltime[i]=lares[i].slice(-8);
			pro[i]=info[i][4];//the providers 
			contreq[i]=info[i][5];//the contentType from request
			cachreq[i]=info[i][6].slice(1,-1);//the cacheControl from request
		}
		
		for (var i=0;i<cachres1.length-1;i++){
			found[i]=false;
			for (var j=0;j<cachres1[i].length;j++){
				cachres1[i][j]=cachres1[i][j].slice(8);
				cachres1[i][j]=cachres1[i][j]*1;
				if(cachres1[i][j]>0){
					found[i]=true;
					maxage[i]=cachres1[i][j];
				}	
			}
		}
		
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τα content-type του response*/
		for (var i=0;i<contres.length;i++){
			let exists=false;
			for (var j=0;j<nod.length;j++){
				if (contres[i]===nod[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nod.push(contres[i]);
			}
		}
		
		
			
		/*Διαδικασία αφαίρεσης διπλότυπων από τα content-type του request*/
		for (var i=0;i<contreq.length;i++){
			let exists=false;
			for (var j=0;j<nod1.length;j++){
				if (contreq[i]===nod1[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nod1.push(contreq[i]);
			}
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τους providers*/
		for (var i=0;i<pro.length;i++){
			let exists=false;
			for (var j=0;j<prova.length;j++){
				if (pro[i]===prova[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				prova.push(pro[i]);
			}
		}
				
		for(var i=0;i<edate.length-1;i++){
			if(!found[i]){
				var d1=new Date(expres[i]);
				var d2=new Date(lares[i]);
				var d=d1.getTime()-d2.getTime();
				d=d/1000;
                if(d>0){
					diff[i]=d;
				}else{
					diff[i]=0;
			    }
			}
		}
		var texthtml=0;
		var textcss=0;
		var textplain=0;
		var textjs=0;
		var font=0;
		var appjs=0;
		var appjson=0;
		var image=0;
		var keno=0;
		var other=0;
		var texthtmlote=0;
		var texthtmlfor=0;
		var texthtmlwin=0;
		var textcssote=0;
		var textcssfor=0;
		var textcsswin=0;
		var textplainote=0;
        var textplainfor=0;
        var textplainwin=0;
        var textjsote=0;
        var textjswin=0;
        var textjsfor=0;
        var fontote=0;
        var fontwin=0;
        var fontfor=0;
		var appjsote=0;
        var appjswin=0;
        var appjsfor=0;
        var imagefor=0;
        var imageote=0;
        var imagewin=0;
        var kenoote=0;
        var kenofor=0;
        var kenowin=0;
        var otherote=0;
        var otherwin=0;
        var otherfor=0;
		var appjsonote=0;
        var appjsonwin=0;
        var appjsonfor=0;
		
		for (var i=0;i<cachres.length-1;i++){
			//text html
			if(contres[i]===nod[0] || contres[i]===nod[2] || contres[i]===nod[20] || contres[i]===nod[35] || contres[i]===nod[48] || contres[i]===nod[49] || contres[i]===nod[54] || contres[i]===nod[56]){
				if(found[i]){
					texthtml=texthtml+maxage[i];
					counter++;
				}else if(diff[i]>0){
					texthtml=texthtml+diff[i];
					counter++;
				}
				if(prova[2]===pro[i]){
					if(found[i]){
						texthtmlote=texthtmlote+maxage[i];
						count++;
					}else if(diff[i]>0){
						texthtmlote=texthtmlote+diff[i];
						count++;
					}
				}else if(prova[0]===pro[i]){
					if(found[i]){
						texthtmlfor=texthtmlfor+maxage[i];
						count1++;
					}else if(diff[i]>0){
						texthtmlfor=texthtmlfor+diff[i];
						count1++;
					}
				}else if(prova[1]===pro[i]) {
					if(found[i]){
						texthtmlwin=texthtmlwin+maxage[i];
						count2++;
					}else if(diff[i]>0){
						texthtmlwin=texthtmlwin+diff[i];
						count2++;
					}
				}
			
			//text css	
			}else if(contres[i]==nod[1] || contres[i]==nod[25] || contres[i]==nod[30] || contres[i]==nod[43]){
				if(found[i]){
					textcss=textcss+maxage[i];
					counter1++;
				}else if(diff[i]>0){
					textcss=textcss+diff[i];
					counter1++;
				}
				if(prova[2]===pro[i]){
                    if(found[i]){
						textcssote=textcssote+maxage[i];
						count3++;
                    }else if(diff[i]>0){
						textcssote=textcssote+diff[i];
						count3++;
                    }
                }else if(prova[0]===pro[i]){
                    if(found[i]){
						texcssfor=textcssfor+maxage[i];
						count4++;
                    }else if(diff[i]>0){
						textcssfor=textcssfor+diff[i];
						count4++;
                    }
                }else if (prova[1]===pro[i]){
                    if(found[i]){
						textcsswin=textcsswin+maxage[i];
						count5++;
                    }else if(diff[i]>0){
						textcsswin=textcsswin+diff[i];
						count5++;
                    }
				}
			//text plain	
			}else if(contres[i]==nod[19] || contres[i]==nod[26] || contres[i]==nod[40] || contres[i]==nod[42] || contres[i]==nod[46]){
				if(found[i]){
					textplain=textplain+maxage[i];
					counter2++;
				}else if(diff[i]>0){
					textplain=textplain+diff[i];
					counter2++;
				}
				if(prova[2]===pro[i]){
                    if(found[i]){
						textplainote=textplainote+maxage[i];
						count6++;
                    }else if(diff[i]>0){
						textplainote=textplainote+diff[i];
						count6++;
                    }
                }else if(prova[0]===pro[i]){
                    if(found[i]){
						textplainfor=textplainfor+maxage[i];
						count7++;
                    }else if(diff[i]>0){
						textplainfor=textplainfor+diff[i];
						count7++;
                    }
                }else if (prova[1]===pro[i]){
                    if(found[i]){
						textplainwin=textplainwin+maxage[i];
						count8++;
                    }else if(diff[i]>0){
						textplainwin=textplainwin+diff[i];
						count8++;
                    }
				}
			//text javascript	
			}else if(contres[i]==nod[8] || contres[i]==nod[9] || contres[i]==nod[18] || contres[i]==nod[33] || contres[i]==nod[52] || contres[i]==nod[57]){
				if(found[i]){
					textjs=textjs+maxage[i];
					counter3++;
				}else if(diff[i]>0){
					textjs=textjs+diff[i];
					counter3++;
				}
				if(prova[2]===pro[i]){
                    if(found[i]){
						textjsote=textjsote+maxage[i];
						count9++;
                    }else if(diff[i]>0){
						textjsote=textjsote+diff[i];
						count9++;
                    }
                }else if(prova[0]===pro[i]){
                    if(found[i]){
						textjsfor=textjsfor+maxage[i];
						count10++;
                    }else if(diff[i]>0){
						textjsfor=textjsfor+diff[i];
						count10++;
                    }
                }else if (prova[1]===pro[i]){
                    if(found[i]){
						textjswin=textjswin+maxage[i];
						count11++;
                    }else if(diff[i]>0){
						textjswin=textjswin+diff[i];
						count11++;
                    }
				}
			//font	
			}else if(contres[i]==nod[16] || contres[i]==nod[27] || contres[i]==nod[41]){
				if(found[i]){
					font=font+maxage[i];
					counter4++;
				}else if(diff[i]>0){
					font=font+diff[i];
					counter4++;
				}
				if(prova[2]===pro[i]){
                    if(found[i]){
						fontote=fontote+maxage[i];
						count12++;
                    }else if(diff[i]>0){
						fontote=fontote+diff[i];
						count12++;
                    }
                }else if(prova[0]===pro[i]){
                    if(found[i]){
						fontfor=fontfor+maxage[i];
						count13++;
                    }else if(diff[i]>0){
						fontfor=fontfor+diff[i];
						count13++;
                    }
                }else if (prova[1]===pro[i]){
                    if(found[i]){
						fontwin=fontwin+maxage[i];
						count14++;
                    }else if(diff[i]>0){
						fontwin=fontwin+diff[i];
						count14++;
                    }
				}
			//app javascript	
			}else if(contres[i]==nod[4] || contres[i]==nod[7] || contres[i]==nod[11] || contres[i]==nod[29] || contres[i]==nod[31] || contres[i]==nod[32] || contres[i]==nod[34] || contres[i]==nod[53]){
				if(found[i]){
					appjs=appjs+maxage[i];
					counter5++;
				}else if(diff[i]>0){
					appjs=appjs+diff[i];
					counter5++;
				}
				if(prova[2]===pro[i]){
                    if(found[i]){
						appjsote=appjsote+maxage[i];
						count15++;
                    }else if(diff[i]>0){
						appjsote=appjsote+diff[i];
						count15++;
                    }
                }else if(prova[0]===pro[i]){
                    if(found[i]){
						appjsfor=appjsfor+maxage[i];
						coun++;
                    }else if(diff[i]>0){
						appjsfor=appjsfor+diff[i];
						coun++;
                    }
                }else if (prova[1]===pro[i]){
                    if(found[i]){
						appjswin=appjswin+maxage[i];
						coun1++;
                    }else if(diff[i]>0){
						appjswin=appjswin+diff[i];
						coun1++;
                    }
				}
			//app json	
			}else if(contres[i]==nod[10] || contres[i]==nod[12] || contres[i]==nod[39]){
				if(found[i]){
					appjson=appjson+maxage[i];
					counter6++;
				}else if(diff[i]>0){
					appjson=appjson+diff[i];
					counter6++;
				}
				if(prova[2]===pro[i]){
					if(found[i]){
						appjsonote=appjsonote+maxage[i];
						coun2++;
					}else if(diff[i]>0){
						appjsonote=appjsonote+diff[i];
						coun2++;
					}
				}else if(prova[0]===pro[i]){
					if(found[i]){
						appjsonfor=appjsonfor+maxage[i];
						coun3++;
					}else if(diff[i]>0){
						appjsonfor=appjsonfor+diff[i];
						coun3++;
					}
				}else if(prova[1]===pro[i]){
					if(found[i]){
						appjsonwin=appjsonwin+maxage[i];
						coun4++;
					}else if(diff[i]>0){
						appjsonwin=appjsonwin+diff[i];
						coun4++;
					}
				}
			//image	
			}else if(contres[i]==nod[3] || contres[i]==nod[5] || contres[i]==nod[14] || contres[i]==nod[15] || contres[i]==nod[17] || contres[i]==nod[21] || contres[i]==nod[23] || contres[i]==nod[28] || contres[i]==nod[44] || contres[i]==nod[47]){
				if(found[i]){
					image=image+maxage[i];
					counter7++;
				}else if(diff[i]>0){
					image=image+diff[i];
					counter7++;
				}
				if(prova[2]===pro[i]){
					if(found[i]){
						imageote=imageote+maxage[i];
						coun5++;
					}else if(diff[i]>0){
						imageote=imageote+diff[i];
						coun5++;
					}
				}else if(prova[0]===pro[i]){
					if(found[i]){
						imagefor=imagefor+maxage[i];
						coun6++;
					}else if(diff[i]>0){
						imagefor=imagefor+diff[i];
						coun6++;
					}
				}else if(prova[1]===pro[i]){
					if(found[i]){
						imagewin=imagewin+maxage[i];
						coun7++;
					}else if(diff[i]>0){
						imagewin=imagewin+diff[i];
						coun7++;
					}
				}
			//null	
			}else if(contres[i]==nod[13] || contres[i]==nod[24]){
				if(found[i]){
					keno=keno+maxage[i];
					counter8++;
				}else if(diff[i]>0){
					keno=keno+diff[i];
					counter8++;
				}
				if(prova[2]===pro[i]){
					if(found[i]){
						kenoote=kenoote+maxage[i];
						coun8++;
					}else if(diff[i]>0){
						kenoote=kenoote+diff[i];
						coun8++;
					}
				}else if(prova[0]===pro[i]){
					if(found[i]){
						kenofor=kenofor+maxage[i];
						coun9++;
					}else if(diff[i]>0){
						kenofor=kenofor+diff[i];
						coun9++;
					}
				}else if(prova[1]===pro[i]){
					if(found[i]){
						kenowin=kenowin+maxage[i];
						coun10++;
					}else if(diff[i]>0){
						kenowin=kenowin+diff[i];
						coun10++;
					}
				}
			//other	6 22 36 37 38 45 50 51 55 58
			}else{
				if(found[i]){
					other=other+maxage[i];
					counter9++;
				}else if(diff[i]>0){
					other=other+diff[i];
					counter9++;
				}
					if(prova[2]===pro[i]){
						if(found[i]){
							otherote=otherote+maxage[i];
							coun11++;
						}else if(diff[i]>0){
							otherote=otherote+diff[i];
							coun11++;
						}
					}else if(prova[0]===pro[i]){
						if(found[i]){
							otherfor=otherfor+maxage[i];
							coun12++;
						}else if(diff[i]>0){
							otherfor=otherfor+diff[i];
							coun12++;
						}
					}else if(prova[1]===pro[i]){
						if(found[i]){
							otherwin=otherwin+maxage[i];
							coun13++;
						}else if(diff[i]>0){
							otherwin=otherwin+diff[i];
							coun13++;
						}
					}
			}
			
			
		
		}
		
		/*texthtml=texthtml/counter;
		textcss=textcss/counter1;
		textplain=textplain/counter2;
		textjs=textjs/counter3;
		font=font/counter4;
		appjs=appjs/counter5;
		appjson=appjson/counter6;
		image=image/counter7;
		keno=keno/counter8;
		other=other/counter9;
		
		appjsonote=appjsonote/coun2;
        appjsonwin=appjsonwin/coun4;
        appjsonfor=appjsonfor/coun3;
        appjsote=appjsote/count15;
        appjswin=appjswin/coun1;
        appjsfor=appjsfor/coun;
        imagefor=imagefor/coun6;
        imageote=imageote/coun5;
        imagewin=imagewin/coun7;
        kenoote=kenoote/coun8;
        kenofor=kenofor/coun9;
        kenowin=kenowin/coun10;
        otherote=otherote/coun11;
        otherwin=otherwin/coun13;
        otherfor=otherfor/coun12;
        textplainote=textplainote/count6;
        textplainfor=textplainfor/coun7;
        textplainwin=textplainwin/coun8;
        textjsote=textjsote/count9;
        textjswin=textjswin/count11;
        textjsfor=textjsfor/count10;
        fontote=fontote/coun12;
        fontwin=fontwin/coun14;
        fontfor=fontfor/coun13;
        texthtmlote=texthtmlote/count;
        texthtmlfor=texthtmlfor/count1;
        texthtmalwin=texthtmlwin/count2;
        textcssote=textcssote/count3;
        textcssfor=textcssfor/count4;
        textcsswin=textcsswin/count5;*/
		
		
				var ctx=document.getElementById('chartContainer');
		window.chart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
				datasets: [{
					label: 'All providers',
					data: [texthtml,textcss,textplain,textjs,font,appjs,appjson,image,keno,other],
					backgroundColor: "rgba(255, 99, 132, 1)",
					borderColor: "rgba(255, 99, 132, 1)",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'COSMOTE',
					data: [texthtmlote,textcssote,textplainote,textjsote,fontote,appjsote,appjsonote,imageote,kenoote,otherote],
					backgroundColor: "#8e5ea2",
					borderColor: "#8e5ea2",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'FORTHNET',
					data: [texthtmlfor,textcssfor,textplainfor,textjsfor,fontfor,appjsfor,appjsonfor,imagefor,kenofor,otherfor],
					backgroundColor: "#3e95cd",
					borderColor: "#3e95cd",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'WIND',
					data: [texthtmlwin,textcsswin,textplainwin,textjswin,fontwin,appjswin,appjsonwin,imagewin,kenowin,otherwin],
					backgroundColor: "#FFA500",
					borderColor: "#FFA500",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				}]
				
			},
			
			options: {
				plugins: {
					title: {
						display: true,
						text: 'TTL Analysis per Content Type'
					}
				}
			}
		});
		
		/*Δημιουργία Βασικού Γραφήματος*/
		var button=document.getElementById("TTL");
		button.onclick = function (){
			deschart(window.chart);
		var ctx=document.getElementById('chartContainer');
		window.chart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
				datasets: [{
					label: 'All providers',
					data: [texthtml,textcss,textplain,textjs,font,appjs,appjson,image,keno,other],
					backgroundColor: "rgba(255, 99, 132, 1)",
					borderColor: "rgba(255, 99, 132, 1)",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'COSMOTE',
					data: [texthtmlote,textcssote,textplainote,textjsote,fontote,appjsote,appjsonote,imageote,kenoote,otherote],
					backgroundColor: "#8e5ea2",
					borderColor: "#8e5ea2",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'FORTHNET',
					data: [texthtmlfor,textcssfor,textplainfor,textjsfor,fontfor,appjsfor,appjsonfor,imagefor,kenofor,otherfor],
					backgroundColor: "#3e95cd",
					borderColor: "#3e95cd",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				},
				{
					label: 'WIND',
					data: [texthtmlwin,textcsswin,textplainwin,textjswin,fontwin,appjswin,appjsonwin,imagewin,kenowin,otherwin],
					backgroundColor: "#FFA500",
					borderColor: "#FFA500",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				}]
				
			},
			
			options: {
				plugins: {
					title: {
						display: true,
						text: 'TTL Analysis per Content Type'
					}
				}
			}
		});
		}
		
		for (var i=0;i<cachres.length-1;i++){
			for (var j=0;j<cachres[i].length-1;j++){		
			//text html
			if(contres[i]===nod[0] || contres[i]===nod[2] || contres[i]===nod[20] || contres[i]===nod[35] || contres[i]===nod[48] || contres[i]===nod[49] || contres[i]===nod[54] || contres[i]===nod[56]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubhtml++;
					if(prova[2]===pro[i]){
						pubhtmlote++;	
					}else if(prova[0]===pro[i]){
						pubhtmlfor++;
					}else if(prova[1]===pro[i]) {
						pubhtmlwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					prihtml++;
					if(prova[2]===pro[i]){
						prihtmlote++;	
					}else if(prova[0]===pro[i]){
						prihtmlfor++;
					}else if(prova[1]===pro[i]) {
						prihtmlwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nochtml++;
					if(prova[2]===pro[i]){
						nochtmlote++;	
					}else if(prova[0]===pro[i]){
						nochtmlfor++;
					}else if(prova[1]===pro[i]) {
						nochtmlwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					noshtml++;
					if(prova[2]===pro[i]){
						noshtmlote++;	
					}else if(prova[0]===pro[i]){
						noshtmlfor++;
					}else if(prova[1]===pro[i]) {
						noshtmlwin++;
					}
				}
			//text css	
			}else if(contres[i]==nod[1] || contres[i]==nod[25] || contres[i]==nod[30] || contres[i]==nod[43]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubcss++;
					if(prova[2]===pro[i]){
						pubcssote++;	
					}else if(prova[0]===pro[i]){
						pubcssfor++;
					}else if(prova[1]===pro[i]) {
						pubcsswin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					pricss++;
					if(prova[2]===pro[i]){
						pricssote++;	
					}else if(prova[0]===pro[i]){
						pricssfor++;
					}else if(prova[1]===pro[i]) {
						pricsswin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					noccss++;
					if(prova[2]===pro[i]){
						noccssote++;	
					}else if(prova[0]===pro[i]){
						noccssfor++;
					}else if(prova[1]===pro[i]) {
						noccsswin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					noscss++;
					if(prova[2]===pro[i]){
						noscssote++;	
					}else if(prova[0]===pro[i]){
						noscssfor++;
					}else if(prova[1]===pro[i]) {
						noscsswin++;
					}
				}
			//text plain	
			}else if(contres[i]==nod[19] || contres[i]==nod[26] || contres[i]==nod[40] || contres[i]==nod[42] || contres[i]==nod[46]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubplain++;
					if(prova[2]===pro[i]){
						pubplainote++;	
					}else if(prova[0]===pro[i]){
						pubplainfor++;
					}else if(prova[1]===pro[i]) {
						pubplainwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					priplain++;
					if(prova[2]===pro[i]){
						priplainote++;	
					}else if(prova[0]===pro[i]){
						priplainfor++;
					}else if(prova[1]===pro[i]) {
						priplainwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocplain++;
					if(prova[2]===pro[i]){
						nocplainote++;	
					}else if(prova[0]===pro[i]){
						nocplainfor++;
					}else if(prova[1]===pro[i]) {
						nocplainwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosplain++;
					if(prova[2]===pro[i]){
						nosplainote++;	
					}else if(prova[0]===pro[i]){
						nosplainfor++;
					}else if(prova[1]===pro[i]) {
						nosplainwin++;
					}
				}
			//text javascript	
			}else if(contres[i]==nod[8] || contres[i]==nod[9] || contres[i]==nod[18] || contres[i]==nod[33] || contres[i]==nod[52] || contres[i]==nod[57]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubtjs++;
					if(prova[2]===pro[i]){
						pubtjsote++;	
					}else if(prova[0]===pro[i]){
						pubtjsfor++;
					}else if(prova[1]===pro[i]) {
						pubtjswin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					pritjs++;
					if(prova[2]===pro[i]){
						pritjsote++;	
					}else if(prova[0]===pro[i]){
						pritjsfor++;
					}else if(prova[1]===pro[i]) {
						pritjswin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					noctjs++;
					if(prova[2]===pro[i]){
						noctjsote++;	
					}else if(prova[0]===pro[i]){
						noctjsfor++;
					}else if(prova[1]===pro[i]) {
						noctjswin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nostjs++;
					if(prova[2]===pro[i]){
						nostjsote++;	
					}else if(prova[0]===pro[i]){
						nostjsfor++;
					}else if(prova[1]===pro[i]) {
						nostjswin++;
					}
				}
			//font	
			}else if(contres[i]==nod[16] || contres[i]==nod[27] || contres[i]==nod[41]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubfont++;
					if(prova[2]===pro[i]){
						pubfontote++;	
					}else if(prova[0]===pro[i]){
						pubfontfor++;
					}else if(prova[1]===pro[i]) {
						pubfontwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					prifont++;
					if(prova[2]===pro[i]){
						prifontote++;	
					}else if(prova[0]===pro[i]){
						prifontfor++;
					}else if(prova[1]===pro[i]) {
						prifontwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocfont++;
					if(prova[2]===pro[i]){
						nocfontote++;	
					}else if(prova[0]===pro[i]){
						nocfontfor++;
					}else if(prova[1]===pro[i]) {
						nocfontwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosfont++;
					if(prova[2]===pro[i]){
						nosfontote++;	
					}else if(prova[0]===pro[i]){
						nosfontfor++;
					}else if(prova[1]===pro[i]) {
						nosfontwin++;
					}
				}
			//app javascript	
			}else if(contres[i]==nod[4] || contres[i]==nod[7] || contres[i]==nod[11] || contres[i]==nod[29] || contres[i]==nod[31] || contres[i]==nod[32] || contres[i]==nod[34] || contres[i]==nod[53]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubajs++;
					if(prova[2]===pro[i]){
						pubajsote++;	
					}else if(prova[0]===pro[i]){
						pubajsfor++;
					}else if(prova[1]===pro[i]) {
						pubajswin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					priajs++;
					if(prova[2]===pro[i]){
						priajsote++;	
					}else if(prova[0]===pro[i]){
						priajsfor++;
					}else if(prova[1]===pro[i]) {
						priajswin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocajs++;
					if(prova[2]===pro[i]){
						nocajsote++;	
					}else if(prova[0]===pro[i]){
						nocajsfor++;
					}else if(prova[1]===pro[i]) {
						nocajswin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosajs++;
					if(prova[2]===pro[i]){
						nosajsote++;	
					}else if(prova[0]===pro[i]){
						nosajsfor++;
					}else if(prova[1]===pro[i]) {
						nosajswin++;
					}
				}
			//app json	
			}else if(contres[i]==nod[10] || contres[i]==nod[12] || contres[i]==nod[39]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubjson++;
					if(prova[2]===pro[i]){
						pubjsonote++;	
					}else if(prova[0]===pro[i]){
						pubjsonfor++;
					}else if(prova[1]===pro[i]) {
						pubjsonwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					prijson++;
					if(prova[2]===pro[i]){
						prijsonote++;	
					}else if(prova[0]===pro[i]){
						prijsonfor++;
					}else if(prova[1]===pro[i]) {
						prijsonwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocjson++;
					if(prova[2]===pro[i]){
						nocjsonote++;	
					}else if(prova[0]===pro[i]){
						nocjsonfor++;
					}else if(prova[1]===pro[i]) {
						nocjsonwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosjson++;
					if(prova[2]===pro[i]){
						nosjsonote++;	
					}else if(prova[0]===pro[i]){
						nosjsonfor++;
					}else if(prova[1]===pro[i]) {
						nosjsonwin++;
					}
				}
			//image	
			}else if(contres[i]==nod[3] || contres[i]==nod[5] || contres[i]==nod[14] || contres[i]==nod[15] || contres[i]==nod[17] || contres[i]==nod[21] || contres[i]==nod[23] || contres[i]==nod[28] || contres[i]==nod[44] || contres[i]==nod[47]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubim++;
					if(prova[2]===pro[i]){
						pubimote++;	
					}else if(prova[0]===pro[i]){
						pubimfor++;
					}else if(prova[1]===pro[i]) {
						pubimwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					priim++;
					if(prova[2]===pro[i]){
						priimote++;	
					}else if(prova[0]===pro[i]){
						priimfor++;
					}else if(prova[1]===pro[i]) {
						priimwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocim++;
					if(prova[2]===pro[i]){
						nocimote++;	
					}else if(prova[0]===pro[i]){
						nocimfor++;
					}else if(prova[1]===pro[i]) {
						nocimwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosim++;
					if(prova[2]===pro[i]){
						nosimote++;	
					}else if(prova[0]===pro[i]){
						nosimfor++;
					}else if(prova[1]===pro[i]) {
						nosimwin++;
					}
				}
			//null	
			}else if(contres[i]==nod[13] || contres[i]==nod[24]){
				if(cachres[i][j]==cachres[5][0]){ //public
					pubn++;
					if(prova[2]===pro[i]){
						pubnote++;	
					}else if(prova[0]===pro[i]){
						pubnfor++;
					}else if(prova[1]===pro[i]) {
						pubnwin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					prin++;
					if(prova[2]===pro[i]){
						prinote++;	
					}else if(prova[0]===pro[i]){
						prinfor++;
					}else if(prova[1]===pro[i]) {
						prinwin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					nocn++;
					if(prova[2]===pro[i]){
						nocnote++;	
					}else if(prova[0]===pro[i]){
						nocnfor++;
					}else if(prova[1]===pro[i]) {
						nocnwin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					nosn++;
					if(prova[2]===pro[i]){
						nosnote++;	
					}else if(prova[0]===pro[i]){
						nosnfor++;
					}else if(prova[1]===pro[i]) {
						nosnwin++;
					}
				}
			//other	6 22 36 37 38 45 50 51 55 58
			}else{
				if(cachres[i][j]==cachres[5][0]){ //public
					pubo++;
					if(prova[2]===pro[i]){
						puboote++;	
					}else if(prova[0]===pro[i]){
						pubofor++;
					}else if(prova[1]===pro[i]) {
						pubowin++;
					}
				}else if(cachres[i][j]==cachres[160][0]){ //private
					prio++;
					if(prova[2]===pro[i]){
						prioote++;	
					}else if(prova[0]===pro[i]){
						priofor++;
					}else if(prova[1]===pro[i]) {
						priowin++;
					}
				}
				if (cachres[i][j]==cachres[173][0]){ //no cache
					noco++;
					if(prova[2]===pro[i]){
						nocoote++;	
					}else if(prova[0]===pro[i]){
						nocofor++;
					}else if(prova[1]===pro[i]) {
						nocowin++;
					}
				}
				if (cachres[i][j]==cachres[228][2]){ //no store
					noso++;
					if(prova[2]===pro[i]){
						nosoote++;	
					}else if(prova[0]===pro[i]){
						nosofor++;
					}else if(prova[1]===pro[i]) {
						nosowin++;
					}
				}
			}
			}
		}	
		
		pubhtml=(pubhtml/(count+count1+count2))*100;
		pubhtmlote=(pubhtmlote/count)*100;
		pubhtmlfor=(pubhtmlfor/count1)*100;
		pubhtmlwin=(pubhtmlwin/count2)*100;
		prihtml=(prihtml/(count+count1+count2))*100;
		prihtmlote=(prihtmlote/count)*100;
		prihtmlfor=(prihtmlfor/count1)*100;
		prihtmlwin=(prihtmlwin/count2)*100;
		nochtml=(nochtml/(count+count1+count2))*100;
		nochtmlote=(nochtmlote/count)*100;
		nochtmlfor=(nochtmlfor/count1)*100;
		nochtmlwin=(nochtmlwin/count2)*100;
		noshtml=(noshtml/(count+count1+count2))*100; 
		noshtmlote=(noshtmlote/count)*100;
		noshtmlfor=(noshtmlfor/count1)*100;
		noshtmlwin=(noshtmlwin/count2)*100;
		
		pubcss=(pubcss/(count3+count4+count5))*100;
		pubcssote=(pubcssote/count3)*100;
		pubcssfor=(pubcssfor/count4)*100;
		pubcsswin=(pubcsswin/count5)*100;
		pricss=(pricss/(count3+count4+count5))*100;
		pricssote=(pricssote/count3)*100;
		pricssfor=(pricssfor/count4)*100;
		pricsswin=(pricsswin/count5)*100;
		noccss=(noccss/(count3+count4+count5))*100;
		noccssote=(noccssote/count3)*100;
		noccssfor=(noccssfor/count4)*100;
		noccsswin=(noccsswin/count5)*100;
		noscss=(noscss/(count3+count4+count5))*100;
		noscssote=(noscssote/count3)*100;
		noscssfor=(noscssfor/count4)*100;
		noscsswin=(noscsswin/count5)*100;
		
		pubplain=(pubplain/(count6+count7+count8))*100;
		pubplainote=(pubplainote/count6)*100;
		pubplainfor=(pubplainfor/count7)*100;
		pubplainwin=(pubplainwin/count8)*100;
		priplain=(priplain/(count6+count7+count8))*100;
		priplainote=(priplainote/count6)*100;
		priplainfor=(priplainfor/count7)*100;
		priplainwin=(priplainwin/count8)*100;
		nocplain=(nocplain/(count6+count7+count8))*100;
		nocplainote=(nocplainote/count6)*100;
		nocplainfor=(nocplainfor/count7)*100;
		nocplainwin=(nocplainwin/count8)*100;
		nosplain=(nosplain/(count6+count7+count8))*100;
		nosplainote=(nosplainote/count6)*100;
		nosplainfor=(nosplainfor/count7)*100;
		nosplainwin=(nosplainwin/count8)*100;
		
		pubtjs=(pubtjs/(count9+count10+count11))*100;
		pubtjsote=(pubtjsote/count9)*100;
		pubtjsfor=(pubtjsfor/count10)*100;
		pubtjswin=(pubtjswin/count11)*100;
		pritjs=(pritjs/(count9+count10+count11))*100;
		pritjsote=(pritjsote/count9)*100;
		pritjsfor=(pritjsfor/count10)*100;
		pritjswin=(pritjswin/count11)*100;
		noctjs=(noctjs/(count9+count10+count11))*100;
		noctjsote=(noctjsote/count9)*100;
		noctjsfor=(noctjsfor/count10)*100;
		noctjswin=(noctjswin/count11)*100;
		nostjs=(nostjs/(count9+count10+count11))*100;
		nostjsote=(nostjsote/count9)*100;
		nostjsfor=(nostjsfor/count10)*100;
		nostjswin=(nostjswin/count11)*100;
		
		pubfont=(pubfont/(count12+count13+count14))*100;
		pubfontote=(pubfontote/count12)*100;
		pubfontfor=(pubfontfor/count13)*100;
		pubfontwin=(pubfontwin/count14)*100;
		prifont=(prifont/(count12+count13+count14))*100;
		prifontote=(prifontote/count12)*100;
		prifontfor=(prifontfor/count13)*100;
		prifontwin=(prifontwin/count14)*100;
		nocfont=(nocfont/(count12+count13+count14))*100;
		nocfontote=(nocfontote/count12)*100;
		nocfontfor=(nocfontfor/count13)*100;
		nocfontwin=(nocfontwin/count14)*100;
		nosfont=(nosfont/(count12+count13+count14))*100;
		nosfontote=(nosfontote/count12)*100;
		nosfontfor=(nosfontfor/count13)*100;
		nosfontwin=(nosfontwin/count14)*100;
		
		pubajs=(pubajs/(count15+coun+coun1))*100;
		pubajsote=(pubajsote/count15)*100;
		pubajsfor=(pubajsfor/coun)*100;
		pubajswin=(pubajswin/coun1)*100;
		priajs=(priajs/(count15+coun+coun1))*100;
		priajsote=(priajsote/count15)*100;
		priajsfor=(priajsfor/coun)*100;
		priajswin=(priajswin/coun1)*100;
		nocajs=(nocajs/(count15+coun+coun1))*100;
		nocajsote=(nocajsote/count15)*100;
		nocajsfor=(nocajsfor/coun)*100;
		nocajswin=(nocajswin/coun1)*100;
		nosajs=(nosajs/(count15+coun+coun1))*100;
		nosajsote=(nosajsote/count15)*100;
		nosajsfor=(nosajsfor/coun)*100;
		nosajswin=(nosajswin/coun1)*100;
		
		pubjson=(pubjson/(coun2+coun3+coun4))*100;
		pubjsonote=(pubjsonote/coun2)*100;
		pubjsonfor=(pubjsonfor/coun3)*100;
		pubjsonwin=(pubjsonwin/coun4)*100;
		prijson=(prijson/(coun2+coun3+coun4))*100;
		prijsonote=(prijsonote/coun2)*100;
		prijsonfor=(prijsonfor/coun3)*100;
		prijsonwin=(prijsonwin/coun4)*100;
		nocjson=(nocjson/(coun2+coun3+coun4))*100;
		nocjsonote=(nocjsonote/coun2)*100;
		nocjsonfor=(nocjsonfor/coun3)*100;
		nocjsonwin=(nocjsonwin/coun4)*100;
		nosjson=(nosjson/(coun2+coun3+coun4))*100;
		nosjsonote=(nosjsonote/coun2)*100;
		nosjsonfor=(nosjsonfor/coun3)*100;
		nosjsonwin=(nosjsonwin/coun4)*100;
		
		pubim=(pubim/(coun5+coun6+coun7))*100;
		pubimote=(pubimote/coun5)*100;
		pubimfor=(pubimfor/coun6)*100;
		pubimwin=(pubimwin/coun7)*100;
		priim=(priim/(coun5+coun6+coun7))*100;
		priimote=(priimote/coun5)*100;
		priimfor=(priimfor/coun6)*100;
		priimwin=(priimwin/coun7)*100;
		nocim=(nocim/(coun5+coun6+coun7))*100;
		nocimote=(nocimote/coun5)*100;
		nocimfor=(nocimfor/coun6)*100;
		nocimwin=(nocimwin/coun7)*100;
		nosim=(nosim/(coun5+coun6+coun7))*100;
		nosimote=(nosimote/coun5)*100;
		nosimfor=(nosimfor/coun6)*100;
		nosimwin=(nosimwin/coun7)*100;
		
		pubn=(pubn/(coun8+coun9+coun10))*100;
		pubnote=(pubnote/coun8)*100;
        pubnfor=(pubnfor/coun9)*100;
        pubnwin=(pubnwin/coun10)*100;
        prin=(prin/(coun8+coun9+coun10))*100;
        prinote=(prinote/coun8)*100;
        prinfor=(prinfor/coun9)*100;
        prinwin=(prinwin/coun10)*100;
        nocn=(nocn/(coun8+coun9+coun10))*100;
        nocnote=(nocnote/coun8)*100;
        nocnfor=(nocnfor/coun9)*100;
        nocnwin=(nocnwin/coun10)*100;
        nosn=(nosn/(coun8+coun9+coun10))*100;
        nosnote=(nosnote/coun8)*100;
        nosnfor=(nosnfor/coun9)*100;
        nosnwin=(nosnwin/coun10)*100;
		
		pubo=(pubo/(coun11+coun12+coun13))*100;
        puboote=(puboote/coun11)*100;
        pubofor=(pubofor/coun12)*100;
        pubowin=(pubowin/coun13)*100;
        prio=(prio/(coun11+coun12+coun13))*100;
        prioote=(prioote/coun11)*100;
        priofor=(priofor/coun12)*100;
        priowin=(priowin/coun13)*100;
        noco=(noco/(coun11+coun12+coun13))*100;
        nocoote=(nocoote/coun11)*100;
        nocofor=(nocofor/coun12)*100;
        nocowin=(nocowin/count13)*100;
        noso=(noso/(coun11+coun12+coun13))*100;
        nosoote=(nosoote/coun11)*100;
        nosofor=(nosofor/coun12)*100;
        nosowin=(nosowin/coun13)*100;
		
		var button=document.getElementById("Pub");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
					datasets: [{
						label: 'All providers',
						data: [pubhtml,pubcss,pubplain,pubtjs,pubfont,pubajs,pubjson,pubim,pubn,pubo],
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'COSMOTE',
						data: [pubhtmlote,pubcssote,pubplainote,pubtjsote,pubfontote,pubajsote,pubjsonote,pubimote,pubnote,puboote],
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'FORTHNET',
						data: [pubhtmlfor,pubcssfor,pubplainfor,pubtjsfor,pubfontfor,pubajsfor,pubjsonfor,pubimfor,pubnfor,pubofor],
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'WIND',
						data: [pubhtmlwin,pubcsswin,pubplainwin,pubtjswin,pubfontwin,pubajswin,pubjsonwin,pubimwin,pubnwin,pubowin],
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
			
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Public percentage'
						}
					}
				}
			});
		}
		
		var button=document.getElementById("Pri");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
					datasets: [{
						label: 'All providers',
						data: [prihtml,pricss,priplain,pritjs,prifont,priajs,prijson,priim,prin,prio],
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'COSMOTE',
						data: [prihtmlote,pricssote,priplainote,pritjsote,prifontote,priajsote,prijsonote,priimote,prinote,prioote],
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'FORTHNET',
						data: [prihtmlfor,pricssfor,priplainfor,pritjsfor,prifontfor,priajsfor,prijsonfor,priimfor,prinfor,priofor],
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'WIND',
						data: [prihtmlwin,pricsswin,priplainwin,pritjswin,prifontwin,priajswin,prijsonwin,priimwin,prinwin,priowin],
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
			
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Private percentage'
						}
					}
				}
			});
		}
		
		var button=document.getElementById("Noc");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
					datasets: [{
						label: 'All providers',
						data: [nochtml,noccss,nocplain,noctjs,nocfont,nocajs,nocjson,nocim,nocn,noco],
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'COSMOTE',
						data: [nochtmlote,noccssote,nocplainote,noctjsote,nocfontote,nocajsote,nocjsonote,nocimote,nocnote,nocoote],
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'FORTHNET',
						data: [nochtmlfor,noccssfor,nocplainfor,noctjsfor,nocfontfor,nocajsfor,nocjsonfor,nocimfor,nocnfor,nocofor],
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'WIND',
						data: [nochtmlwin,noccsswin,nocplainwin,noctjswin,nocfontwin,nocajswin,nocjsonwin,nocimwin,nocnwin,nocowin],
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
			
				options: {
					plugins: {
						title: {
							display: true,
							text: 'No cache percentage'
						}
					}
				}
			});
		}
		
		var button=document.getElementById("Nos");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["text\/html","text\/css","text\/plain","text\/javascript","font","appication\/javascript","application\/json","image","null","other"],
					datasets: [{
						label: 'All providers',
						data: [noshtml,noscss,nosplain,nostjs,nosfont,nosajs,nosjson,nosim,nosn,noso],
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'COSMOTE',
						data: [noshtmlote,noscssote,nosplainote,nostjsote,nosfontote,nosajsote,nosjsonote,nosimote,nosnote,nosoote],
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'FORTHNET',
						data: [noshtmlfor,noscssfor,nosplainfor,nostjsfor,nosfontfor,nosajsfor,nosjsonfor,nosimfor,nosnfor,nosofor],
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'WIND',
						data: [noshtmlwin,noscsswin,nosplainwin,nostjswin,nosfontwin,nosajswin,nosjsonwin,nosimwin,nosnwin,nosowin],
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
			
				options: {
					plugins: {
						title: {
							display: true,
							text: 'No store percentage'
						}
					}
				}
			});
		}
	}
	
	function deschart(chart){ //συνάρτηση για καταστροφή προηγούμενου chart με το πάτημα του κουμπιού
		chart.destroy();
	}
  
  </script>
  </body>
</html>