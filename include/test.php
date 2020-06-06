<html>
    <head>
        <link rel="stylesheet" href="../css/emojionearea.min.css">
        <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <script src="../js/emojionearea.min.js"></script>
        
        
        <style>
            *{
                margin: 0px;
                padding: 0px;
            }
            .emojionearea > .emojionearea-editor {
            min-height: 100px;
            max-height: 100px;
            }
/*
            #txt-box{
                height: 300px;
                width: 600px;
            }
*/
            .mydiv{
                border: 1px black ridge;
                height: 100px;
                width: 500px;
            }
        </style>
        
    </head>
    <body>
        <div class="mydiv">
            <textarea id="txt-box" ></textarea>
        </div>
        
        
        <script>
//            $('.emojionearea-editor').height($('#txt-box').outerHeight());
            $(document).ready(function(){
                $("#txt-box").emojioneArea({
                    pickerPosition:"bottom"
                });
            })
        </script>
    </body>
</html>