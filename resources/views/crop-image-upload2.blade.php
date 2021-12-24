<!DOCTYPE html>
<html>
<head>
<title>Laravel Cropper js - Crop Image Before Upload - Tutsmake.com</title>
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/cropper.min.css">
<script src="/cropper.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script> --}}
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
  
    <label class="custom-file-upload">
        <input accept="image/*" type="file" class="image" name="photo[]" id="imgInp" />
        <input type="hidden" name="horee" class="asas" >
        <img id="blah" width="100px" class='fa fa-photo asas' height="130px" src="#" alt="Photo" />
    </label>

    <label class="custom-file-upload">
        <input accept="image/*" type="file" class="image" name="photo[]" id="imgInp2" />
        <input type="hidden" name="horee2" class="asas" >
        <img id="blah2" width="100px" class='fa fa-photo asas' height="130px" src="#" alt="Photo" />
    </label>

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <input type="hidden" id="mid">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        Crop Image 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="">
                        </div>
                        <div class="col-md-4">
                            <div class="preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
        </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <input type="hidden" id="mid">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        Crop Image 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image2" src="">
                        </div>
                        <div class="col-md-4">
                            <div class="preview2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop2">Crop</button>
        </div>
        </div>
      </div>
    </div>



   
    

 



    <button type="submit">Coba BIsmillah</button>
</form>

</div>

</div>
</div>


<script>

    var cropper;
    var base64data;
    var $modal1 = $('#modal1');
    var $modal2 = $("#modal2");
    var image = document.getElementById('image');
    var image2 = document.getElementById('image2');


    /* 1 */
    $("#imgInp").on("change",function(e){
        var files = e.target.files;
        console.log(files);
        var reader;
        var file;
        var url;
        var done = function (url) {
            image.src = url;
            $modal1.modal('show');
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

    /* 2 */
    $("#imgInp2").on("change",function(e){
        var files = e.target.files;
        var reader;
        var file;
        var url;
        var done = function (url) {
            image2.src = url;
            $modal2.modal('show');
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



    /* 1 */
    $("#crop").click(function(e){
        var isinya = cropper.getCroppedCanvas().toDataURL('image/jpeg');
        $("#blah").attr('src',isinya);
        $(".asas").val(isinya);
        $modal1.modal('hide');
    });

    /* 2 */
    $("#crop2").click(function(e){
        var isinya = cropper.getCroppedCanvas().toDataURL('image/jpeg');
        $("#blah2").attr('src',isinya);
        $(".asas2").val(isinya);
        $modal2.modal('hide');
    });


    /* m1 */
    $modal1.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null; 
    });

    /* m2 */
    $modal2.on('shown.bs.modal', function () {
        cropper = new Cropper(image2, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview2'
        });
    }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null; 
    });




   
    
    
    
  
    
</script>
</body>
</html>