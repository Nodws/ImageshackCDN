<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
  body{font-family:sans-serif;background:#ddd}
  span{font-size:12px;color:#393939;}
  h3{font-size:14px;color:#5AAAF7;}
 .preview img{width: 200px }
 p{clear: both; }
</style>
</head>
<body>
<? 
// Mind the Post
if($_POST){

 $file=$_FILES['media'];
 
    require_once('commandline.php');
    require_once('imageshack.class.php');
  
    $key = "3RLOMPZAf46be771005b17a762cd583276ed9434";

    $uploader = new ImageShackUploader($key, param('cookie'));
    $public = 'yes';
    if (!$file)
    {        
      
        die();
    }
 
   $w=0;
 foreach($file[size] as $f){
    $ct = $file[type][$w];


    $re = $uploader->upload(
                   $file[tmp_name][$w], 
                   $file[size][$w], 
                   param('remove-bar') != 'no', 
                   $file[name][$w],
                   $public,
                   $ct);
    $im[] = array($re->links->image_link,$re->links->thumb_link);                             
    $w++;
   }
   
	if($im){
		foreach ($im as $v) {
			echo"<a href='$v[0]'><img src='$v[1]'></a>";
		}
	}
}

?>
 
  <form name="sd" id="upform" enctype="multipart/form-data" action="" method="post">
<div id="files" class="container-fluid">
	
<div class="row form-group">
 <div class="col-md-6">Upload image <input type="file" name="media[]" class="imgup"></div>
 <div class='col-md-6 preview'> </div>
</div>


</div>
 <input type="submit" class="btn btn-primary" name="subi" value="Upload &raquo;"> 
  </form>
  <div id="result"></div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{ 

        $("#files").on('change','input[type=file]',function(){        
            var reader = new FileReader(); 
            var file    = $(this);
          
            reader.addEventListener("load", function () {
           file.parent().parent().find('.preview').html('<img src="'+ reader.result+'">'); 
          }, false);

            reader.readAsDataURL(file[0].files[0]);  
   
        var html = '<div class=row><div class=col-md-6> <input type=file name=media[] class=imgup></div> <div class="col-md-6 preview"> </div></div>';
        $("#files").append(html);
    });

		$("#upform").submit(function(e){
		
			$('input').hide();			
		}); 
}); 
</script>