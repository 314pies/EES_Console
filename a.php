<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script>
         var Submit=function(){
            var URLs="EES_login.php";
           
            $.ajax({
                url: URLs,
                data: $('#sentToBack').serialize(),
                type:"POST",
                dataType:'text',

                success: function(msg){
                    alert(msg);
                },

                 error:function(xhr, ajaxOptions, thrownError){ 
                    alert(xhr.status); 
                    alert(thrownError); 
                 }
            });
            
        }
        </script>
    </head>
    <body>
        <form id="sentToBack">
            <input type="text" name="Text"/> 
            <input type="button"  value="送出" onClick="Submit()"/>
        </form>
    </body>
</html>