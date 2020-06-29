<?
 function dbi_conn()
 { global $dbpassword; $dbid="p1234"; $dbpassword="tnrl3849";   
  $dbi_conn=mysqli_connect("localhost","p201606010","pp201606010","p201606010");
  if(!$dbi_conn) die('DB연결실패==>>>(' . mysqli_connect_errno() . ') '.mysqli_connect_error()); 
    return $dbi_conn; 
  }  
  $dbi_conn=dbi_conn();
?>