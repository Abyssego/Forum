function accepterCookies() {
	// Définir un cookie de session
	document.cookie = "cookiesAccepte=true; path=/";

	// Fermer la popup
	window.close();
}

	// Ajouter un événement de clic sur le bouton "Accepter"
document.getElementById("accepter").addEventListener("click", function(event) {
	event.preventDefault();
	accepterCookies();
});


function switchContent(contentNumber) {
  var content1 = document.getElementById("popup-content-1");
  var content2 = document.getElementById("popup-content-2");
  var btn1 = document.getElementById("btn1");
  var btn2 = document.getElementById("btn2");

  if (contentNumber == 1) {
    content1.style.display = "block";
    content2.style.display = "none";
    btn1.classList.add("active");
    btn2.classList.remove("active");
  } else if (contentNumber == 2) {
    content1.style.display = "none";
    content2.style.display = "block";
    btn1.classList.remove("active");
    btn2.classList.add("active");
  }
}