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
  <script>
  
 /*Αρχικοποίηση των πινάκων που θα χρησιμοποιηθούν για την αποθήκευση των στοιχείων απο τη βάση*/
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
  
  /*Αρχικοποίηση όλων των counters ου θα χρησιμοποιήσουμε και αρχικοποίηση των πινάκων χωρίς διπλότυπα*/
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
		/*Αρχικοποίηση πινάκων για το Bar Chart: TTL Analysis*/
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
			//Ομάδα text-html όλων και κάθε παρόχου ξεχωριστά
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
			
			//Ομάδα text-css  όλων και κάθε παρόχου ξεχωριστά
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
			//Ομάδα text-plain  όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα text-javascript  όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα font  όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα app-javascript όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα app-json όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα image όλων και κάθε παρόχου ξεχωριστά	
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
			//Ομάδα null όλων και κάθε παρόχου ξεχωριστά	
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
			//Τα υπόλοιπα(other) βρίσκονται στις θέσεις του πίνακα contres:6, 22, 36, 37, 38, 45, 50, 51, 55, 58.
			//Ομάδα other όλων και κάθε παρόχου ξεχωριστά
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
		// Εύρεση μέσων όρων
		texthtml=texthtml/counter;
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
        textcsswin=textcsswin/count5;
		
		/*Δημιουργία Βασικού Γραφήματος TTL Analysis per Content Type*/
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
	
	
	
  
  </script>
  </body>
</html>