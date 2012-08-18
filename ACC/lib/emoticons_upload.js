var progress_key = '{FILEID}';
$(document).ready(function() {
	$("#uploadprogressbar").progressBar();
});
function beginUpload() {
    $("#uploadprogressbar").fadeIn();
    var i = setInterval(function() { 
        $.getJSON("api.php?module=upload&fileid=" + progress_key, function(data) {
            if (data == null) {
                clearInterval(i);
                location.reload(true);
                return;
            }
 
            var percentage = Math.floor(100 * parseInt(data.bytes_uploaded) / parseInt(data.bytes_total));
            $("#uploadprogressbar").progressBar(percentage);
        });
    }, 1500);
}