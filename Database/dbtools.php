<meta charset="utf-8"> 
<? 
ini_set('display_errors', '0');
include "dbi_conn_inc.php"; 
$userid="p201606010";
$txtquery= (!isset($_POST["txtquery"]))?"":$_POST["txtquery"];

$txtpassword=$_POST["txtpassword"]; 
$sql4=strtolower(substr(trim($txtquery), 0,4));

$sq14_x= ($sql4=="drop" or $sql4=="dele" or $sql4=="upde");
$pass_x= $txtpassword !=substr($dbpassword, -2);

if ($sq14_x and $pass_x) {
    $txtquery= "실행을 허용하지 않은 query입니다. $sq14_x$pass_x==>". $txtquery; 
}
?> 
    <html>
    <head><meta charset="utf-8"><title>PHP DB 테스트 V4</title></head>
    <body>
    <style type="text/css"> 
        body, td, table { font-size: 12px;}
    </style>

    <center> 
    <h3>데이터베이스 실습</h3>
    <script>
    function optionchange (opt, text)
        {text.value=opt.value;} 
//-->
</script>

===================================<br>
<?
// 명령어 저장 시작
    if(trim($txtquery)!=""){
        $command=addslashes($txtquery); 
        $ip=$_SERVER["REMOTE_ADDR"]; 
        $now=date("Y-m-d H:i:s"); 
        $sql ="insert into sql_command (username, dbcommand, indate, ip) values ('$userid', '$command', '$now', '$ip')"; 
        $result=mysqli_query($dbi_conn, $sql) or die("$sql 쿼리가 틀렸어요".mysqli_errno($dbi_conn).":". mysqli_error($dbi_conn));
    }
// 명령어 저장 끝
?>
======================================
<!-- // DB에 저장된 명령어 read하여 <select><option> tag에 명령어 설정 처리 시작-->
    <?  

        $ip=$_SERVER['REMOTE_ADDR']; 
        $sql ="select * from sql_command order by num desc";
        $result=mysqli_query($dbi_conn, $sql) or die("$sql 쿼리가 틀렸어요".mysqli_error($dbi_conn));
    ?>

    <form name="mainform" action=<? echo $_SERVER["PHP_SELF"]?>?mode=insert method="post">
    <table border="0" cellpadding="5" style="border:1px solid #666">
        <tr><td>
            <TEXTAREA id=idtxtquery NAME=txtquery ROWS=3 COLS="62"X?=$txtquery?></TEXTAREA> </td></tr> 
        <tr><td>
            <input type="submit" value="실행하기"> 
            <input name=txtpassword type="password" size=2 value='<?=$txtpassword?>'> 
        </form>
<!-- <SELECT id=bid name=bcate onChange="optionchange (this, txtquery, mainform);"--> 
    <SELECT id=bid name=bcate onChange="optionchange (this,txtquery);">
    <?      echo "<OPTION VALUE=''>명령어를 선택하세요</OPTION>";
            while($row=mysqli_fetch_array($result)) {
                    $strip_command=stripslashes ($row['dbcommand']); echo "<OPTION VALUE=\"" . $strip_command. "\">".$strip_command."</OPTION>";
            }
    ?>
                <OPTION VALUE='1'>하나</OPTION>";
                <OPTION VALUE='2'>둘</OPTION>";
                </SELECT>
            </td>
        <tr> 
    </table>
<!-- // DB에 저장된 명령어 read하여 <select> <option> tag에 명령어 설정 처리 종료 -->
<hr>
<!--//TEXT AREA 저장된 명령어 처리 시작-->
<?
if(trim($txtquery)!=""){
    $sql =$txtquery; 
    $result=mysqli_query($dbi_conn, $sql) or die("$sql 쿼리가 틀렸어요".mysqli_errno($dbi_conn).":". mysqli_error($dbi_conn)); 
    $cols= @mysqli_num_fields($result); 
    $rows= @mysqli_num_rows ($result); 
    $changes= @mysqli_affected_rows ($dbi_conn); 
    echo " 레코드수 = $rows 필드수 = $cols 변경수= $changes"; 
    if ($rows >0){
            echo "
            <table border=0 cellpadding=5 style=border:1px solid #666>
            <tr align=center bgcolor=#EFEFEF><td colspan = $cols> >> 데이터 베이스 실행결과 &nbsp;<< </td></tr> 
            <tr align=center bgcolor=#DCEAFA>";
                    while($field_item= mysqli_fetch_field($result)) echo "<td>".    $field_item->name."</td>"; 
                echo "</tr>"; 
                while($row=mysqli_fetch_array($result))
                {
                    echo " <tr align=center bgcolor=#FAFAFA> ";
                            for ($i=0; $i<$cols; $i++)
                            {
                                echo "<td>". $row[$i]."</td>";
                            }
                    echo "</tr>";
                    }
                    echo "</table>";
                        mysqli_close($dbi_conn);
                    }
                } 
?>
</body>
</html>