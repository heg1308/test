<?php
session_start();
$connect = mysqli_connect("l.bsks.ac.kr", "p201606010", "pp201606010", "p201606010") or die("fail");

//입력 받은 id와 password
$id = $_POST['id'];
$password = $_POST['password'];

//아이디가 있는지 검사
$query = "select * from up where id='$id'";
$result = $connect->query($query);


//아이디가 있다면 비밀번호 검사
if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);

    //비밀번호가 맞다면 세션 생성
    if ($row['password'] == $password) {
        $_SESSION['id'] = $id;
        if (isset($_SESSION['id'])) {
?> <script>
alert("로그인 되었습니다.");
location.replace("main.php");
</script>
<?php
        } else {
            echo "session fail";
        }
    } else {
        ?> <script>
alert("아이디 혹은 비밀번호가 잘못되었습니다.");
//history.back();
</script>
<?php
    }
} else {
    ?> <script>
alert("아이디가 잘못되었습니다.");
history.back();
</script>
<?php
}

?>