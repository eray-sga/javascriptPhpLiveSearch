<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find</title>
</head>
<body>

<style>
    *{
        font-family: tahoma;
        font-size: 14px;
    }

    form{
        margin: auto;
        width: 300px;
        padding: 10px;
        margin-top: 30px;
        box-shadow: 0px 0px 10px #aaa;
        border-radius: 10px;
    }

    .search{
        width: 280px;
        padding: 10px;
        border-radius: 10px;
        border: solid thin #aaa;
        outline: none;
    }

    .results{
        width: 292px;
        padding-top: 4px;
        border-radius: 10px;
        border: solid thin #aaa;
        outline: none;
    }

    .results div:hover{
        background-color: #00cfff;
        color: white;
        cursor: pointer;
    }

    .hide{
        display: none;
    }
</style>

<form action="">
    <h3>Search</h3>
    <input type="text" class="search js-search" name="" oninput="get_data(this.value)" placeholder="Type something to find"><br>
    <div class="results js-results hide">

    </div><br><br>
</form>
    
</body>

<script type="text/javascript">
    function get_data(text)
    {
        if(text.trim() == "")
            return 
        if(text.trim().length < 2)
            return 
        var form = new FormData();
        form.append('text',text);
        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange',function(e){
            if(ajax.readyState == 4 && ajax.status == 200){
                handle_result(ajax.responseText);
            }
        });

        ajax.open('post','api.php','true');
        ajax.send(form);
    }

    function handle_result(result)
    {
        //console.log(result);
        var result_div = document.querySelector(".js-results");
        var str = "";

        var obj = JSON.parse(result);
        for(var i = obj.length - 1; i>=0; i--){
            str += `<a href='info.php?id=${obj[i].id}'><div>` + obj[i].name +  "</div></a>";
        }

        result_div.innerHTML = str;
        if(obj.length > 0)
        {
            show_results();
        } else{
            hide_results();
        }
    }

    function show_results()
    {
        var result_div = document.querySelector(".js-results");
        result_div.classList.remove("hide");

    }

    function hide_results()
    {
        var result_div = document.querySelector(".js-results");
        result_div.classList.add("hide");
        
    }
</script>
</html>