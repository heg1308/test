<!DOCTYPE html>
<head><meta charset="utf-8"><title>PHP 성적입력</title></head>
<body>
   <style type="text/css">
       a:link { color: white; text-decoration: none;}
   </style>
   <center>
   <h3>성적 입력하기</h3>
   <form action=<?echo $_SERVER["PHP_SELF"]?>?mode=insert method="post">
   <table border="0" cellpadding="5" style="border:1px solid white">
      <tr>
         <td>
            이름 : <input type="text" maxlength="4" name="name">&nbsp;
            국어 : <input type="text" maxlength="3" name="kor">&nbsp;
            영어 : <input type="text" maxlength="3" name="eng">&nbsp;
            수학 : <input type="text" maxlength="3" name="mat">&nbsp;
            <input type="submit" name="" value="확인">
         </td>
      </tr>
   </table>
   </center>
   </form>
   <br><br><br><br>
   <hr>
   <center>
   <h3>성적 리스트</h3>
   <p>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub1">국어 오름차순 /</a>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub2">영어 오름차순 /</a>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub3">수학 오름차순 /</a>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub4">총점 내림차순 /</a>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub5">평균 오름차순 /</a>
   <a href="<?echo $_SERVER["PHP_SELF"]?>?mode=sub6">평균 내림차순 /</a>
   </p>

      <?
      ini_set('display_errors', '0');
      $mode=$_GET["mode"];
      $name=$_POST["name"];
      $kor=$_POST["kor"];
      $eng=$_POST["eng"];
      $mat=$_POST["mat"];

      include "dbi_conn_inc.php";
      if($mode=="insert"){
        $sql ="insert into rc1 (name, kor, eng, mat) values ('$name', '$kor', '$eng', '$mat')";
        mysqli_query($dbi_conn, $sql) or die("$sql 쿼리가 틀렸어요".mysqli_error($dbi_conn));
         }
      echo "$sql
         <table border=0 cellpadding=5 style=border:1px solid #666>
            <tr align=center bgcolor=#EFEFEF>
               <td COLSPAN = 7>
                  >>데이터 베이스 출력 &nbsp;<<
               </td>
            </tr>
            <tr align=center bgcolor=#F6F6F6>
               <td>이름</td>
               <td>국어</td>
               <td>영어</td>
               <td>수학</td>
               <td>총점</td>
               <td>평균</td>
            </tr>";
            $sql = "select *, kor + eng + mat tot, round(kor+eng+mat)/3,0 avr from rc1";
      
      if ($mode=="sub1") $sql=$sql . " order by kor asc ";
      if ($mode=="sub2") $sql=$sql . " order by eng asc ";
      if ($mode=="sub3") $sql=$sql . " order by mat asc ";
      if ($mode=="sub4") $sql=$sql . " order by tot desc ";
      if ($mode=="sub5") $sql=$sql . " order by avr desc ";
      if ($mode=="sub6") $sql=$sql . " order by avr asc ";

      $result=mysqli_query($dbi_conn,$sql) or die("$sql 쿼리가 틀렸어요.".mysqli_error($dbi_conn));
      while($row=mysqli_fetch_array($result))
      {
         echo "<tr align=center bgcolor=#F6F6F6><td>$row[name]</td> <td>$row[kor]</td> <td>$row[eng]</td> <td>$row[mat]</td> <td>$row[tot]</td> <td>$row[avr]</td>";
      }
      mysql_close($db_conn);
      ?>
   </center>
   </table>
</body>
</html>