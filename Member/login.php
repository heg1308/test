<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
html,
body {
    margin: 0px;
    padding: 0px;
    height: 100%;
}

.login {
    text-align: center;
    opacity: 0;
}

.main {
    margin-left: auto;
    margin-right: auto;
    width: 500px;
    height: 100%;
    background-color: gray;
    opacity: 0.9;
    margin-top: 50px;
    text-align: center;
    padding: 50px 50px;
    border-radius: 10px;

}

.helper {
    display: inline-block;
    vertical-align: middle;
    height: 100%;
}

.box {
    display: inline-block;
    vertical-align: middle;
}

.box .id {
    display: block;
    width: 200px;
    height: 60px;
    border-radius: 10px;
    padding: 0px;
    border: 0px;
    margin-top: 10px;
    font-size: 20px;
    padding-left: 10px;
    margin-bottom: 10px;

    margin-left: auto;
    margin-right: auto;

    transition: 0.25s;
}

.id:focus{
  width: 400px;
  border-color: #2ecc71;
}


.id:nth-child(3) {
    margin-bottom: 25px;
}

.button {
    font-size: 20px;
    padding: 10px 60px;
    border-radius: 10px;
    margin: 0px 10px 10px 10px;
    border: 0px;

}

h1 {
    padding: 0px;
    margin: 0px;
    color: white;
    margin-bottom: 15px;
    font-size: 50px;
}

.button:hover {
    background-color: white;
    cursor: pointer;
}
</style>

<body>
    <div class='login'>
        <div class='main'>
            <div class='helper'></div>
            <div class='box'>
                <form action="login_check.php" method="post" id="frm1">
                    <h1>HALLO!</h1>
                    <input type='text' name='id' class='id' placeholder="아이디" require=true>
                    <input type='text' name='password' class='id' placeholder="비밀번호" require=true>
                    <input type='button' class='button' id="login" value='로그인'>
                    <input type='button' class='button' id="join" value='회원가입'>
                </form>
            </div>
            <div>
            </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$('#login').on('click', function() {
    $('#frm1').submit();
});
$('#join').on('click', function() {
    location.href = 'join.php';
});
$(document).ready(function() {
    $('.login').animate({
        'opacity': '1'
    }, 1000);
});
</script>

</html>