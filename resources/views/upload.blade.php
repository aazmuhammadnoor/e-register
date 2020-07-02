<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="{{ asset('new_layout/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('new_layout/plugins/dropzone/dist/dropzone.js') }}"></script>
</head>
<body>
	<form action="/file-upload" class="dropzone" id="upload">
	  <div class="fallback">
	    <input name="file" type="file" multiple />
	  </div>
	</form>
</body>
</html>