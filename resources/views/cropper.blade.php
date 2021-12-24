<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop multiple images with cropper js</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .g-height-50 {
        height: 50px;
    }

    .g-width-50 {
        width: 50px !important;
    }

    @media (min-width: 0){
        .g-pa-30 {
            padding: 2.14286rem !important;
        }
    }

    .g-bg-secondary {
        background-color: #fafafa !important;
    }

    .u-shadow-v18 {
        box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
    }

    .g-color-gray-dark-v4 {
        color: #777 !important;
    }

    .g-font-size-12 {
        font-size: 0.85714rem !important;
    }

    .media-comment {
        margin-top:20px
    }
    .singleImageCanvasContainer{
        overflow: hidden;
        height: 200px;
        width: 30%;
        display: inline-block;
        position: relative;
        padding-right: 0px;
        margin-right: 15px;
        border: 2px solid #dfdfdf;
        margin-bottom: 10px;
        padding: 4px;
        border-radius: .25rem;
    }

    .singleImageCanvasContainer .singleImageCanvasCloseBtn{
        position: absolute;
        right: 0;
    }
    .singleImageCanvasContainer .singleImageCanvas{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
</head>
<body>


<!-- code by w3codegenerator.com -->
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <input type="file" name="file" id="file" accept="image/*" multiple />
        </div>

        @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show mt-5">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        @if(isset($data))
            @php $images = explode(",", $data->images)  @endphp
            @foreach($images as $image)
            <div class="col-md-4">
                <img src="{{ asset('storage/app/public/'.$image) }}" alt="..."/>
            </div>
            @endforeach
        @endif
    </div>
</div>

<div class="modal" id="cropperModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Images</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
            <div class="modal-body p-4">
                <div class="img-preview"></div>
                <div id="galleryImages"></div>
                <div id="cropper">
                    <canvas id="cropperImg" width="0" height="0"></canvas>
                    <button type="button" class="cropImageBtn btn btn-danger" style="display:none;" id="cropImageBtn">Crop</button>
                </div>
                <div id="imageValidate" class="text-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.js" integrity="sha512-E4KfIuQAc9ZX6zW1IUJROqxrBqJXPuEcDKP6XesMdu2OV4LW7pj8+gkkyx2y646xEV7yxocPbaTtk2LQIJewXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.css" integrity="sha512-Aix44jXZerxlqPbbSLJ03lEsUch9H/CmnNfWxShD6vJBbboR+rPdDXmKN+/QjISWT80D4wMjtM4Kx7+xkLVywQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    $(document).ready(function(){
        $("body").on("change", "#file", function(e){
            $('.singleImageCanvasContainer').remove();
            $('#post_img_data').val('');
        });
    })
</script>
<script>

    //Multiple image cropper and preview on creating post
    var c;
    var galleryImagesContainer = document.getElementById('galleryImages');
    var imageCropFileInput = document.getElementById('file');
    var cropperImageInitCanvas = document.getElementById('cropperImg');
    var cropImageButton = document.getElementById('cropImageBtn');
    // Crop Function On change
    function imagesPreview(input) {
        var cropper;
        //cropImageButton.className = 'show';
        var img = [];
        if (input.files.length) {
            var i = 0;
            var index = 0;
            for (let singleFile of input.files) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var blobUrl = event.target.result;
                    img.push(new Image());
                    img[i].onload = function(e) {
                        // Canvas Container
                        var singleCanvasImageContainer = document.createElement('div');
                        singleCanvasImageContainer.id = 'singleImageCanvasContainer'+index;
                        singleCanvasImageContainer.className = 'singleImageCanvasContainer';
                        // Canvas Close Btn
                        var singleCanvasImageCloseBtn = document.createElement('button');
                        var singleCanvasImageCloseBtnText = document.createTextNode('X');
                        // var singleCanvasImageCloseBtnText = document.createElement('i');
                        // singleCanvasImageCloseBtnText.className = 'fa fa-times';
                        singleCanvasImageCloseBtn.id = 'singleImageCanvasCloseBtn'+index;
                        singleCanvasImageCloseBtn.className = 'singleImageCanvasCloseBtn';
                        singleCanvasImageCloseBtn.classList.add("btn", "btn-sm");
                        singleCanvasImageCloseBtn.onclick = function() {
                            removeSingleCanvas(this)
                        };
                        singleCanvasImageCloseBtn.appendChild(singleCanvasImageCloseBtnText);
                        singleCanvasImageContainer.appendChild(singleCanvasImageCloseBtn);
                        // Image Canvas
                        var canvas = document.createElement('canvas');
                        canvas.id = 'imageCanvas'+index;
                        canvas.className = 'imageCanvas singleImageCanvas';
                        canvas.width = e.currentTarget.width;
                        canvas.height = e.currentTarget.height;
                        canvas.onclick = function() { cropInit(canvas.id); };
                        singleCanvasImageContainer.appendChild(canvas)
                        // Canvas Context
                        var ctx = canvas.getContext('2d');
                        ctx.drawImage(e.currentTarget,0,0);
                        // galleryImagesContainer.append(canvas);
                        galleryImagesContainer.appendChild(singleCanvasImageContainer);
                        // while (document.querySelectorAll('.singleImageCanvas').length == input.files.length) {
                        //     var allCanvasImages = document.querySelectorAll('.singleImageCanvas')[0].getAttribute('id');
                        //     console.log(allCanvasImages);
                        //     //commented by sam
                        //     //cropInit(allCanvasImages);
                        //     break;
                        // };
                        urlConversion();
                        index++;
                };
                    img[i].src = blobUrl;
                    i++;
                }
                reader.readAsDataURL(singleFile);
            }
        }
    }

    imageCropFileInput.addEventListener("change", function(event){

        $('#cropperModal').modal('show');
        var mediaValidation = validatePostMedia(event.target.files);
        if(!mediaValidation){
            var $el = $('#file');
            $el.wrap('<form>').closest('form').get(0).reset();
            $el.unwrap();
            return false;
        }

        $('#mediaPreview').empty();
        $('.singleImageCanvasContainer').remove();
        if(cropperImageInitCanvas.cropper){
            cropperImageInitCanvas.cropper.destroy();
            cropperImageInitCanvas.width = 0;
            cropperImageInitCanvas.height = 0;
            cropImageButton.style.display = 'none';
        }
        imagesPreview(event.target);
    });
    // Initialize Cropper
    function cropInit(selector) {
        c = document.getElementById(selector);

        if(cropperImageInitCanvas.cropper){
            cropperImageInitCanvas.cropper.destroy();
        }
        var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
        for (let element of allCloseButtons) {
            element.style.display = 'block';
        }
        c.previousSibling.style.display = 'none';
        // c.id = croppedImg;
        var ctx=c.getContext('2d');
        var imgData=ctx.getImageData(0, 0, c.width, c.height);
        var image = cropperImageInitCanvas;
        image.width = c.width;
        image.height = c.height;
        var ctx = image.getContext('2d');
        ctx.putImageData(imgData,0,0);

        cropper = new Cropper(image, {
            aspectRatio: 16/9,
			viewMode: 4,
            preview: '.img-preview',
            crop: function(event) {
                cropImageButton.style.display = 'block';
            }
        });

    }

    function image_crop() {
        if(cropperImageInitCanvas.cropper){
            var cropcanvas = cropperImageInitCanvas.cropper.getCroppedCanvas({
                    width: 250, height: 250
                });
            // document.getElementById('cropImages').appendChild(cropcanvas);
            var ctx=cropcanvas.getContext('2d');
            var imgData=ctx.getImageData(0, 0, cropcanvas.width, cropcanvas.height);
            // var image = document.getElementById(c);
            c.width = cropcanvas.width;
            c.height = cropcanvas.height;
            var ctx = c.getContext('2d');
            ctx.putImageData(imgData,0,0);
            cropperImageInitCanvas.cropper.destroy();
            cropperImageInitCanvas.width = 0;
            cropperImageInitCanvas.height = 0;
            cropImageButton.style.display = 'none';
            var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
            for (let element of allCloseButtons) {
                element.style.display = 'block';
            }
            urlConversion();
        } else {
            alert('Please select any Image you want to crop');
        }
    }
    cropImageButton.addEventListener("click", function(){
        image_crop();
    });
    // Image Close/Remove
    function removeSingleCanvas(selector) {
        selector.parentNode.remove();
        urlConversion();
    }

    function urlConversion() {
        var allImageCanvas = document.querySelectorAll('.singleImageCanvas');
        var convertedUrl = '';
        canvasLength = allImageCanvas.length;
        for (let element of allImageCanvas) {
            convertedUrl += element.toDataURL('image/jpeg');
            convertedUrl += 'img_url';
        }
        document.getElementById('post_img_data').value = convertedUrl;
    }
</script>
<script>
    function validatePostMedia(files){

        $('#imageValidate').empty();
        let err = 0;
        let ResponseTxt = '';
        if(files.length > 10){
            err += 1;
            ResponseTxt += '<p> You can select maximum 10 files. </p>';
        }
        $(files).each(function(index, file) {
            if(file.size > 1048576){
                err +=  1;
                ResponseTxt += 'File : '+file.name + ' is greater than 1MB';
            }
        });

        if(err > 0){
            $('#imageValidate').html(ResponseTxt);
            return false;
        }
        return true;

    }
</script>
</body>
</html>