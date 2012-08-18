$('#name').change(function () {
	var name = encodeURI($('#name').val());
	var id = $('#id').val();
	if (name == "") {
		alert("Bitte einen Aufruf-Namen angeben!");
	} else {
        $.ajax({
            type: "POST",
            url: "{DOMAIN}api.php",
            data: "module=emo&namecheck="+name+"&id="+id,
            success: function(data){
                var json = $.parseJSON(data);
                if (json.flag === true) {
                	$("#errors").html(
                			"<b>Fehler</b><br>Es exisitert schon ein Emoticon welches mit diesem Aufruf beginnt!<br>" +
                			"Bitte pass den Emoticon-Aufruf so an, dass er sich nicht mit dem Anfang eines " +
                			"anderen Emoticon-Aufrufes überschneidet.<br><br>");
                } else {
                	$("#errors").html("");
                }
            }
        });
	}
});
$('#url').keyup(function() {
    var url = encodeURI($("#url").val());
    if (url == ""){
        alert("Bitte eine URL angeben!");
    } else {
    	var extensions = [".gif", ".jpg", ".jpeg", ".png", ".GIF", ".JPG", ".JPEG", ".PNG"];
    	var flag = false;
    	for (var i=0;i<extensions.length;i++) {
    		if (url.indexOf(extensions[i]) != -1) {
    			flag = true;
    			break;
    		}
    	}
    	if (flag == true) {
            $.ajax({
                type: "POST",
                url: "{DOMAIN}api.php",
                data: "module=emo&url="+url,
                success: function(data){
                    var json = $.parseJSON(data);
                    $("#previewemo").attr("src",json.http);
                }
            });
    	}
    }
});