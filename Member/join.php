<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
    html,
    body {
        margin: 0px;
        padding: 0px;
        height: 100%;
    }
    table {
        text-align: center;
        margin: 0 auto;
        margin-top: 50px;
        border-radius: 10px;
        padding: 30px 40px;
        background-color: gray;
        opacity: 0;
    }

    tbody tr td{
        display: block;
        width: 500px;
        margin: 0 auto;
    }
    tbody tr td input:not([type="button"]):not([type="submit"]):not([type="radio"]){
        width: 400px;
        height: 60px;
        border-radius: 10px;
        padding: 0px;
        border: 0px;
        margin-top: 10px;
        font-size: 20px;
        padding-left: 10px;
        margin-bottom: 10px;
    }

    span{
        font-size: 20px;
        font-weight: 600;
        color: white;
        position: relative;
        bottom: 4px;
    }

    input[type="radio"]{
        width: 25px;
        height: 25px;
    }

    tr:first-child td{
        font-size: 25px;
    }

    td{
        border: 0px solid black;
        font-size: 15px;
    }

    #search{
        position: relative;
        top: 2px;
        margin-left: 10px;
        height: 60px;
        padding: 0px;
        width: 70px;
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
        border: 0px;
        font-size: 20px;
    }
    h1 {
        padding: 0px;
        margin: 0px;
        color: white;
        margin-bottom: 15px;
        font-size: 50px;
    }

    .g-recaptcha{
        display: inline;
        position: relative;
        left: 100px;
        margin-top: 50px;
    }

    </style>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>

<body>
    <form action="./join_action.php" method="post">
        <table border="0">
   
            <tr>
                <td>
                    <h1>WELCOME!</h1>
                </td>
            </tr>
            <Tr>
                <td><input type="text" calss="text" name="id" id="id" placeholder="아이디"></td>
            </Tr>
            <Tr>
                <td><input type="password" name="password" id="password" placeholder="비밀번호"></td>
            </Tr>
            <Tr>
                <td><input type="radio" value="남" name="fix"><span>남</span>
                    <input type="radio" value="여" name="fix" style="margin-left: 50px"><span>여</span></td>
            </Tr>
            <Tr>
                <td><input type="text" name="phone" placeholder="전화번호"></td>
            </Tr>
            <Tr>
                <td><input type="text" id="zip_i" style="width:150px" placeholder="우편번호">
                    <input type="button" value="검색" id="search" onclick="sample6_execDaumPostcode()" name="zip_s" id="zip_s" ></td>
                    <input type="text" id="zip" name="zip" hidden="hidden">
            <Tr>
                <td><input type="text" id="addr" name="addr" placeholder="주소"></td>
            </Tr>
            <td><input type="text" id="addr_detail" name="addr_detail" placeholder="상세주소"></td>
            </Tr>
            <tr>
                <td><div class="g-recaptcha" data-sitekey="6Lf9ga4ZAAAAAE4nhIhJLpLyoix1dzV9IYXF4j-N"></div></td>
            </tr>
            <tr>
                <td colspan="5" ><input type="submit" id="search" style="width: 100px">
                <input type="button" id="search" style="width: 100px" value="취소" class="cancel"></td>
            </tr>
    </form>
    </table>
    <script>
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수
                var ext = '';

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                //사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if (data.userSelectedType === 'R') {
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.`
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraAddr !== '') {
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    ext = extraAddr;

                } else {
                    ext = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("zip_i").value = data.zonecode;
                document.getElementById("zip").value = data.zonecode;
                document.getElementById("addr").value = addr + ' ' + ext;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("addr_detail").focus();
            }
        }).open();
    }
    </script>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('table').animate({
        'opacity': '1'
    }, 1000);
});
$(".cancel").on("click", function(){
    location.href="login.php";
});
</script>
</html>