<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('/resources/views/admin/style/css/ch-ui.admin.css')}}">
        <link rel="stylesheet" href="{{asset('/resources/views/admin/style/font/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/resources/org/uploadify/uploadify.css')}}">   
        <script type="text/javascript" src="{{asset('/resources/views/admin/style/js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('/resources/views/admin/style/js/ch-ui.admin.js')}}"></script>
        <script type="text/javascript" src="{{asset('/resources/org/layer/layer.js')}}"></script>
        
        <script src="{{asset('/resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    </head>
    <body>


        @yield('content')
        <script>
    tinymce.init({
        selector: '.editer',
        language: "zh_TW",
        height: 360,
        file_browser_callback: elFinderBrowser,
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
    });

    function elFinderBrowser(field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            file: '/admin/resources/files/tinymce4', // use an absolute path!
            title: 'elFinder 2.0',
            width: 900,
            height: 450,
            resizable: 'yes'
        }, {
            setUrl: function(url) {
                win.document.getElementById(field_name).value = url;
            }
        });
        return false;
    }
        </script>    
     
    
     <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
                                'buttonText':'上傳圖片',
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'_token'     : '{{csrf_token()}}'
				},
				'swf'      : '{{asset('/resources/org/uploadify/uploadify.swf')}}',
				'uploader' : '{{url('admin/upload')}}',
                                'onUploadSuccess' : function(file, data, response) {
                                    $('input[name=art_thumb]').val(data);
                                    $('#art_thumb_img').attr('src','/'+data);
                                }
			});
		});
	</script>
        <style>
            .uploadify{display: inline-block;}
            .uploadify-button{border: none;border-radius: 5px;margin-top: 8px;}
            table.add_tab tr td span.uploadify-button-text{color: #FFF;margin: 0;}
        </style>    
    </body>
</html>