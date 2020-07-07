<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
</head>
<style>
#dtBasicExample_wrapper{
    margin: 0 auto;
    margin-top: 50px;
    width: 80%;
}
</style>
<body>
<?
    session_start(); // 세션
    $user_id = $_SESSION['id'];

    $connect = mysqli_connect("l.bsks.ac.kr", "p201606010", "pp201606010", "p201606010") or die("fail");
    $query = "select * from up";
    $result = $connect->query($query);
?>
<div id="dtBasicExample_wrapper" class="dataTables_wrapper dt-bootstrap4">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_length bs-select" id="dtBasicExample_length"></div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div id="dtBasicExample_filter" class="dataTables_filter"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <table id="dtBasicExample" class="table table-hover table-bordered" cellspacing="0">
            <caption> 회원정보 목록</caption>
            <thead>
                <tr role="row">
                <th >아이디</th>
                <th>주소</th>
                <th>상세주소</th>
                <th>전화번호</th>
                <th>성별</th>
                </tr>
            </thead>
            <tbody>
            <?
                while($info = mysqli_fetch_array($result))
                { 
                    echo "<tr role='row'>";
                    echo "<td>".$info['id']."</td>";
                    echo "<td>".$info['addr']."</td>";
                    echo "<td>".$info['addr_detail']."</td>";
                    echo "<td>".$info['phone']."</td>";
                    echo "<td>".$info['fix']."</td>";
                    echo "</tr>";
                }
            ?> 
            </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script>
$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});
</script>
</body>

</html>

