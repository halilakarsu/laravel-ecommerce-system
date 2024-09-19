<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
</head>
<body>
<h3>Drag And Drop</h3>
<div></div>
<form action="{{ route('dropzone.store') }}" method="POST" enctype="multipart/form-data" id="image-upload" class="dropzone">
    @csrf
</form>

<script type="text/javascript">
    $(document).ready(function() {
         var dropzone = new Dropzone("#image-upload", {
            thumbnailWidth: 200,
            maxFilesize: 2, // MB
            acceptedFiles: ".jpg,.jpeg,.png,.gif",
            success: function(file, response) {
                console.log("Dosya yüklendi:", response);
            },
            error: function(file, response) {
                console.error("Hata:", response);
                alert("Yükleme hatası: " + response);
            }
        });
    });
</script>
</body>
</html>
