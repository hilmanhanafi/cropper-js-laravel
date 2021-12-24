<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="{{ asset('ijaboCropTool-master/ijaboCropTool.min.css') }}">
    <script src="{{ asset('ijaboCropTool-master/ijaboCropTool.min.js') }}"></script> 


</head>
<body>

  <input type="file" name="file" id="file">
  <input type="file" name="file" id="file1">
  <input type="file" name="file" id="file2">
  <input type="file" name="file" id="file3">

  <script>
    $('#file').ijaboCropTool({
       preview : '.image-previewer',
       setRatio:1,
       allowedExtensions: ['jpg', 'jpeg','png'],
       buttonsText:['CROP','QUIT'],
       buttonsColor:['#30bf7d','#ee5155', -15],
       processUrl:'{{ route("crop") }}',
       withCSRF:['_token','{{ csrf_token() }}'],
       onSuccess:function(message, element, status){
         console.log(element);
          // alert(message);
       },
       onError:function(message, element, status){
        //  alert(message);
       }
    });
    $('#file1').ijaboCropTool({
       preview : '.image-previewer',
       setRatio:1,
       allowedExtensions: ['jpg', 'jpeg','png'],
       buttonsText:['CROP','QUIT'],
       buttonsColor:['#30bf7d','#ee5155', -15],
       processUrl:'{{ route("crop") }}',
       withCSRF:['_token','{{ csrf_token() }}'],
       onSuccess:function(message, element, status){
         console.log(element);
          // alert(message);
       },
       onError:function(message, element, status){
        //  alert(message);
       }
    });
    $('#file2').ijaboCropTool({
       preview : '.image-previewer',
       setRatio:1,
       allowedExtensions: ['jpg', 'jpeg','png'],
       buttonsText:['CROP','QUIT'],
       buttonsColor:['#30bf7d','#ee5155', -15],
       processUrl:'{{ route("crop") }}',
       withCSRF:['_token','{{ csrf_token() }}'],
       onSuccess:function(message, element, status){
         console.log(element);
          // alert(message);
       },
       onError:function(message, element, status){
        //  alert(message);
       }
    });
    $('#file3').ijaboCropTool({
       preview : '.image-previewer',
       setRatio:1,
       allowedExtensions: ['jpg', 'jpeg','png'],
       buttonsText:['CROP','QUIT'],
       buttonsColor:['#30bf7d','#ee5155', -15],
       processUrl:'{{ route("crop") }}',
       withCSRF:['_token','{{ csrf_token() }}'],
       onSuccess:function(message, element, status){
         console.log(element);
          // alert(message);
       },
       onError:function(message, element, status){
        //  alert(message);
       }
    });
</script>
    
</body>
</html>