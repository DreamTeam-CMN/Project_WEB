<?php

 $var1=0;
 $var2=0;
 $var3=0;
 $var4=0;
 $var5=0;
  if (isset($_POST["submit"])){
	  $user=$_POST['user'];
	  
	  session_start();
	  $_SESSION['user']=$user;
	  $oldpass=$_POST['oldpass'];
      $pass=$_POST['pass'];
      $conpass=$_POST['conpass'];
	  if (!empty($_POST["user"])){
		   if (!empty($_POST["pass"])){
				  if (!empty($_POST["conpass"])){
					   $var1=name1($var1 , $pass);
				       $var2=name2($var2 , $pass);
				       $var3=name3($var3 , $pass);
				       $var4=name4($var4 , $pass);
					   $var5=name5($var5 , $pass , $conpass);
			        } else{
					   echo "vale ksana to kwdiko";
				    }
			    } else{
				    echo "vale to kwdiko";
			    }
        } else{
			echo "vale to username";
		}
}

  if ($var1==1){
	   if ($var2==1){
		    if ($var3==1){
			    if ($var4==1){
				     if ($var5==1){
					       header('Location: upload-system.php');
				        }
			        } 
		        }
	        }
        }
function name1($var1 , $pass){
    if (strlen($pass)<8){
	  echo "prepei na einai toul 8 xarakthres"; 
	  echo "<br>";
	} else{
		 $var1=$var1+1;
		 return $var1;
	}
}
 function name2($var2 , $pass){
	 if (preg_match('#[0-9]#',$pass)){
         $var2=$var2+1;
		 return $var2;
    }else{
        echo "not valid";
		echo "<br>";
    }  
}
 function name3($var3 , $pass){
	 if(preg_match('/[A-Z]/', $pass)){
		 $var3=$var3+1;
		 return $var3;
	 }else{
		 echo "not valid";
		 echo "<br>";
	 }
}
 function name4($var4 , $pass){
	 if (preg_match('/[\'^$%&#*@~!?><>=+]/', $pass)){
		 $var4=$var4+1;
		 return $var4;
	  }else{
		  echo "not valid";
		  echo "<br>";
        }
}
 function name5($var5 , $pass , $conpass){
	 if ($pass==$conpass){
		 $var5=$var5+1;
		 return $var5;
	 }else{
		 echo "prepei na einai idia";
		 echo "<br>";
	 }
}

?>