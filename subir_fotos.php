<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
		<script src="http://bp.yahooapis.com/2.4.21/browserplus-min.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(function() {
				var uploader = new plupload.Uploader({
					runtimes : 'gears,html5,flash,silverlight,browserplus',
					browse_button : 'pickfiles',
					max_file_size : '10mb',
					url : 'upload.php',
					flash_swf_url : '/plupload/js/plupload.flash.swf',
					silverlight_xap_url : '/plupload/js/plupload.silverlight.xap',
					filters : [
						{title : "Image files", extensions : "jpg,gif,png"},
						{title : "Zip files", extensions : "zip"}
					]/*,
					resize : {width : 320, height : 240, quality : 90}*/
				});

				uploader.bind('Init', function(up, params) {
					$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
				});

				uploader.bind('FilesAdded', function(up, files) {
					$.each(files, function(i, file) {
						$('#filelist').append(
							'<div id="' + file.id + '">' +
							'File: ' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
							'</div>'
						);
					});
				});

				uploader.bind('UploadProgress', function(up, file) {
					$('#' + file.id + " b").html(file.percent + "%");
				});

				$('#uploadfiles').click(function(e) {
					uploader.start();
					e.preventDefault();
				});

				uploader.init();
			});
		</script>
	</head>
	<body>
		<h3>Custom example</h3>
		<div>
			<div id="filelist">No runtime found.</div>
			<br />
			<a id="pickfiles" href="#"> [Select files] </a>
			<a id="uploadfiles" href="#"> [Upload files] </a>
		</div>
	</body>
</html>