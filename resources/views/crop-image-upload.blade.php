<!DOCTYPE html>
<html>
<head>
<title>Laravel Cropper js - Crop Image Before Upload - Tutsmake.com</title>
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
img {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px; 
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
</style>
<body>
<div class="container mt-5">

<form action="crop-image-upload" method="post">
    @csrf
    <?php for ($i = 0; $i < 5; $i++) { ?>
        <label class="custom-file-upload">
            <input accept="image/*" type="file" class="image" name="photo[]" id="imgInp<?= $i ?>" />
            <input type="hidden" name="horee[]" class="asas<?=$i?>" >
            <img id="blah<?= $i ?>" width="100px" class='fa fa-photo asas' height="130px" src="#" alt="Photo" />
        </label>

        <div class="modal fade" id="modal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">
                            Laravel Cropper Js - Crop Image Before Upload - Tutsmake.com
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="cropperImg" width="0" height="0"></canvas>
                                <img id="image<?= $i ?>" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="preview">

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop<?= $i ?>">Crop</button>
            </div>
            </div>
          </div>
        </div>
        <script>
            
            var cropper,base64data,image,Keyu;

            $("#imgInp<?=$i ?>").on("change",function(e){
                image = document.getElementById('image<?= $i ?>');
             
                var files = e.target.files;
                var reader;
                var file;
                var url;
                var done = function (url) {
                    image.src = url;
                    $("#modal{{ $i }}").modal('show');
                };
            
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                    done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                        done(reader.result);
                    };
                        reader.readAsDataURL(file);
                    }
                }
            
   
        
  



            });


            $("#modal{{ $i }}").on('shown.bs.modal', function () {
                
                    cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    });
                }).on('hidden.bs.modal', function () {
                    cropper.destroy();
                    cropper = null;
            });


   
        
            $("#crop<?=$i?>").click(function(e){
                Keyu =  cropper.getCroppedCanvas().toDataURL('image/jpeg');
                $("#blah<?= $i ?>").attr('src', Keyu);
                $(".asas<?=$i?>").val(Keyu);
                $('#modal<?=$i?>').modal('hide');
            


            });
            
            </script>
    <?php } ?>


<button type="submit">Coba Bismillah</button>
</form>

</div>

</div>
</div>



</body>
</html> 