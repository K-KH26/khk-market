<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form>
    <input type="text" name="quick_search">
</form>
<button onclick="searchQuick()">검색</button>

<table>
    <thead>
        <tr>
            <td>이미지</td>
            <td>이름</td>
            <td>가격</td>
            <td>찜</td>
        </tr>
    </thead>
    <tbody id="tt">

    </tbody>
</table>
</body>
</html>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    function searchQuick(){
            $.ajax({
                url: '/action/action_search.php',
                type : 'get',
                data : $('form').serialize()
            }).done(function(data){
                $('#tt').empty();
                $("#tt").append(data);
            })
        }
</script>