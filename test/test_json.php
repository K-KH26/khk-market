<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name="AjaxForm" id="AjaxForm">
    <label for="name">이름</label> 
        <input type="text" name="name" id="name" /> <br />
    <label for="age">나이</label> 
        <input type="number" name="age" id="age" /> 
    </form> 
    <input type="button" value="GET" onclick="AjaxCall('GET');" />
    <input type="button" value="POST" onclick="AjaxCall('POST');" />

    <div class="board">
    <p id="result">안녕하세요! 배진오입니다.</p>
    <button onclick="next()" class="block-button">다음</button>
</div>

</body>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">

    // 객체형태로 전달 하기위한 객체
    // var person = {
    // name : "광현",
    // age : 25
    // };

function createData() {
    // 1. 자바스크립트 객체 형태로 전달
    var sendData = {
        name : $('#name').val(),
        age : $('#age').val()
    };
    
    // 2. jQuery serialize함수를 사용해서 전달
    //var sendData = $('#AjaxForm').serialize();
    
    console.log(sendData);
    return sendData;
    
    // 3. 객체를 json 문자열로 만들어서 전달
    // var sendData = JSON.stringify({name:$('#name').val(), email:$('#email').val()});
    // var sendData = JSON.stringify(person);

    // console.log(sendData);
    // return {"data" : sendData};
}

function AjaxCall(method) {
    $.ajax({
        type: method,
        url : 'test_server_json.php?mode=' + method,
        data: createData(),
        // data : person,
        dataType: "json", // 데이터타입을 jason으로 지정하면 알아서 파싱해준다. JSON.parse()함수가 필요없음. parse를 시도할 시 에러가 난다.
        success : function(data, status, xhr) {
            console.log(data);
            // data = JSON.parse(data);
            alert(data.age);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("에러"+ jqXHR.responseText);
        }
    });
}
</script>
<script>
    var index = 0;
    function next() {
        $.ajax({
            url: "test_server_json.php",
            type: "get",
            data: {index: index++}
        }).done(function(data) {

            $('#result').text('저의' + data.desc + '은 ' + data.name + '입니다!');
            if(index > 2) index = 0;
        });
    }
</script>

</html>



