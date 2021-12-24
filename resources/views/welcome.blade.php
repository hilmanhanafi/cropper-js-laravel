<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Laravel Image Resize Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            Error occured.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>Primary Image:</h3>
                <img src="/images/{{ Session::get('fileName') }}" />
            </div>
            <div class="col-md-4">
                <h3>Thumbnail:</h3>
                <img src="/thumbnails/{{ Session::get('fileName') }}" />
            </div>
        </div>
        @endif

        <form action="{{ route('img-resize') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="file" name="imgFile" class="imgFile">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>

</body>

</html>
{{-- <script>


var cropper;
$("#imgInp<?=$i ?>").on("change",function(e){
    var $modal = $('#modal<?= $i ?>');

// console.log($modal);
var image = document.getElementById('image<?= $i ?>');
    var files = e.target.files;
    var reader;
    var file;
    var url;
    var done = function (url) {
        image.src = url;
        $modal.modal('show');
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

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

});


$("#crop<?=$i?>").click(function(){
    var canvas = cropper.getCroppedCanvas({
        width: 160,
        height: 160,
    });
    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob); 
        reader.onloadend = function() {
            var base64data = reader.result; 
            $(".asas<?= $i ?>").val(base64data);
            console.log(base64data);
            $("#blah<?= $i ?>").attr('src', base64data);
            $(".image").val(base64data);
            no++;

        }
    });
});






// $("body").on("change", ".image", function(e){
//     var files = e.target.files;
//     var done = function (url) {
//     image.src = url;
//     $modal.modal('show');
//     };
//     var reader;
//     var file;
//     var url;
//     if (files && files.length > 0) {
//         file = files[0];
//         if (URL) {
//         done(URL.createObjectURL(file));
//     } else if (FileReader) {
//         reader = new FileReader();
//         reader.onload = function (e) {
//         done(reader.result);
//     };
//         reader.readAsDataURL(file);
//     }
//     }
// });
// $modal.on('shown.bs.modal', function () {
// cropper = new Cropper(image, {
// aspectRatio: 1,
// viewMode: 3,
// preview: '.preview'
// });
// }).on('hidden.bs.modal', function () {
// cropper.destroy();
// cropper = null;
// });

function del(uk) {
            $("#single" + uk).remove();
}

// $("#crop").click(function(){
//     canvas = cropper.getCroppedCanvas({
//         width: 160,
//         height: 160,
//     });
//     canvas.toBlob(function(blob) {

// url = URL.createObjectURL(blob);
// var reader = new FileReader();
// reader.readAsDataURL(blob); 
// reader.onloadend = function() {
// var base64data = reader.result; 
// var no = 0;

//             var olk =  '<div><a onclick="del('+no+')" id="single'+no+'" class="singleImageCanvasCloseBtn btn btn-sm">X<img src="' + base64data + '" /></a></div>';
//             console.log(olk);
//             $("#isi").append(olk);
//             $(".asas").attr('src', base64data);
//             $(".image").val(base64data);
//             // focus_ad_id('uk' + nouk);
//             no++;
// // });
// // $.ajax({
// // type: "POST",
// // dataType: "json",
// // url: "crop-image-upload",
// // data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
// // success: function(data){
// // console.log(data);
// // $modal.modal('hide');
// // alert("Crop image successfully uploaded");
// // }
// // });
// }
// });
// });
</script> --}}
{{-- <input type="file" name="image[]" class="image">
<input type="file" name="image[]" class="image">
<input type="file" name="image[]" class="image">
<input type="file" name="image[]" class="image"> --}}
<p id="isi"></p>