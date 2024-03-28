function refreshCaptcha() {
  var captchaImage = document.getElementById('captcha');
  captchaImage.src = 'catcha.php?' + Date.now();
}

function ouvrePopup(page) {
	window.open(page,"nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=2000, height=1000, resizable=no");
}

