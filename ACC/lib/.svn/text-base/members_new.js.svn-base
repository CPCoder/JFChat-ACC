$('input[name="username"]').focus();
var flag = false;	
function check() {
	if (flag == false) {
		$("input[type=submit]").attr("disabled", "disabled");
	} else {
		$("input[type=submit]").removeAttr("disabled");
	}
}
function nameCheck() {
	var name = $('#username').val();
	if (name.length >= {NAME_MIN_LENGTH} && name.length <= {NAME_MAX_LENGTH}) {
		var checkurl = "{CHECKURL}&name=" + name;
		$.ajax({
			url: checkurl,
			success:function(data) {
				var message = data.substring(7, data.indexOf("<end>"));
				if (message == "OK") {
					flag = true;
					switchImg(1);
					$('#namecheck').html("");
					$('#signatur').text("~"+name);
					check();
				} else {
					switchImg(2);
					$('#namecheck').html(message+"<br>");
					check();
				}
			}
		});
	} else {
		$('#namecheck').html("{ERROR_NAME_LENGTH}<br>");
		switchImg(2);
		check();
	}
}
function switchImg(flag) {
	if (flag == 1) {
		$('#checknameimg').attr('src', 'style/gfx/tick.png');
		$('#checknameimg').attr('title', 'Username ist verf&uuml;gbar');
		$('#checknameimg').attr('alt', 'Username ist verf&uuml;gbar');
	} else if (flag == 2) {
		$('#checknameimg').attr('src', 'style/gfx/cross.png');
		$('#checknameimg').attr('title', 'Username ist schon vergeben');
		$('#checknameimg').attr('alt', 'Username ist schon vergeben');
	} else {
		$('#checknameimg').attr('src', 'style/gfx/transparent.png');
		$('#checknameimg').attr('title', 'Transparent');
		$('#checknameimg').attr('alt', 'Transparent');
	}
}
check();
$("#username").focusout(function () {
	nameCheck();
});