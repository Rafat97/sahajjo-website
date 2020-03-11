<?php
    $path = $_GET['file'];
    $type = $_GET['type'];
    $path = base64_decode($path);
    $value_html = file_get_contents('../../'.$path);
    if ($type == 'save' ) {
        
        if(!empty($_POST['code_html'])){
            
            $file = '../../../views/'.$path;
            $current = $_POST['code_html'];
            $add = file_put_contents($file, $current);
            echo $add  ;
        }
        
    }
    else if ($type == 'preview') {
        if(!empty($_GET['code_html'])){
            $file = '../../../views/'.$path;
            $current = $_POST['code_html'];
            $add = file_put_contents($file, $current);
            echo $add  ;
            echo $_GET['code_html']  ;

        }
    }
    else if ($type == 'edit') {

    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>


<title> Editor </title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/mode-php.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/mode-html.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/mode-ini.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ext-language_tools.js" ></script>


<style type="text/css" media="screen">
    
    #my_ace_editor { 
        position: absolute;
        top: 30px;
        right: 0;
        bottom: 0;
        left: 0;
    }

</style>
</head>
<body >
<div>
<!-- <button class="btn Preview" id="PreviewButton">Preview</button> -->
<button class="btn Preview" id="SaveButton">Save</button>
</div>



<div  id="my_ace_editor" ></div>
<div  id="my_ace_editor_preview" ></div>

<textarea name="editorText" id="editorText" cols="30" rows="10" disabled hidden><?php echo $value_html; ?></textarea>


<script>
var fileLength  = 0;


$(document).ready(function() {
    var editor = ace.edit("my_ace_editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/php");

    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
    });
    document.getElementById('my_ace_editor').style.fontSize='14px';
    editor.session.setUseWrapMode(true);
    editor.setHighlightActiveLine(true);
    editor.setShowPrintMargin(true);

    var get  = $("#editorText").val();
    fileLength = get.length;
    editor.setValue(get);
    
    editor.commands.addCommand({
    name: 'myCommand',
    bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
    exec: function(editor) {
        $("#SaveButton").click();
    },
    readOnly: true // false if this command should not apply in readOnly mode
    });


    editor.session.on('change', function(delta) {
        $("#editorText").val(editor.getValue())
    });

    $("#PreviewButton").click(function(data) {
        var html = $("#editorText").val()
        //window.open("?file=<?php echo $_GET['file']; ?>&type=preview&code_html="+escape(html), '_blank');
        console.log(   );
        
    });
    $("#SaveButton").click(function(data) {
        editor.setReadOnly(true);
        var html = $("#editorText").val()
        var postData = {
            'code_html': html
        };
        
        if(html.length != fileLength ){
            $.post("?file=<?php echo $_GET['file']; ?>&type=save",postData,
                function(data, status){
                    console.log(data);
                    fileLength = data;
                    editor.setReadOnly(false);
                    alert("Save file succefully");
            });
           
        }else{
            alert("Please change something into file .");
            editor.setReadOnly(false);
        }
    });
});

</script>
</body>
</html>

<?php
    }
?>