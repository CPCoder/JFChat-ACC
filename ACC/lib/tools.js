/* German initialisation for the jQuery UI date picker plugin. */
/* Written by Milian Wolff (mail@milianw.de). */
jQuery(function($){
	$.datepicker.regional['de'] = {
		closeText: 'schliessen',
		prevText: '&#x3c; Zur&uuml;ck',
		nextText: 'Vor &#x3e;',
		currentText: 'Heute',
		monthNames: ['Januar','Februar','M&auml;rz','April','Mai','Juni',
		'Juli','August','September','Oktober','November','Dezember'],
		monthNamesShort: ['Januar','Februar','M&auml;rz','April','Mai','Juni',
   		'Juli','August','September','Oktober','November','Dezember'],
//		monthNamesShort: ['Jan','Feb','M&auml;r','Apr','Mai','Jun',
//		'Jul','Aug','Sep','Okt','Nov','Dez'],
		dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
		dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
		dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
		weekHeader: 'Wo',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['de']);
});

$('#switcher').click(function(event) {
	var value = $('#pwd').attr('type');
	if (value == 'password') {
		$('input[name="password"]').each (function() {
			this.type='text';
		});
		$('#switcher').attr('src', 'style/gfx/eye_show.png');
		$('#switcher').attr('title', 'Passwort ausblenden');
		$('#switcher').attr('alt', 'Passwort ausblenden');
	} else {
		$('input[name="password"]').each (function() {
			this.type='password';
		});
		$('#switcher').attr('src', 'style/gfx/eye_hide.png');
		$('#switcher').attr('title', 'Passwort anzeigen');
		$('#switcher').attr('alt', 'Passwort anzeigen');
	}
});
$('#generatePWD').click(function(event) {
	var password = generatePWD(8);
	$('input[name="password"]').val(password);
});
$('input[name="username"]').keyup(function() {
	var signature = $(this).val();
	signature = '~ '+signature;
	$('textarea[name="signatur"]').text(signature);
});
$('input[name="geburtsdatum"]').datepicker({ changeMonth:true, changeYear: true, yearRange: '1970:2000' });
$('#colpicker').colorPicker( {
	defaultColor:14,
	columns:15,
	click:function(c) {
		$('input[name="farbcode"]').val(c.substring(1,7));
	}
});
