document.addEventListener("DOMContentLoaded", function () {
    var loginPopup = document.getElementById("login-popup");
    var registerPopup = document.getElementById("register-popup");

    var closeLogin = document.getElementById("close-login-popup");
    var closeRegister = document.getElementById("close-register-popup");

    var openLoginPopupBtn = document.querySelector(".login");
    var openRegisterPopupBtn = document.querySelector(".register");

    var openRegisterFromLogin = document.getElementById("open-register-from-login");
    var openLoginFromRegister = document.getElementById("open-login-from-register");

    function openPopup(popup) {
        loginPopup.style.display = "none";
        registerPopup.style.display = "none";
        popup.style.display = "flex";
    }

    openLoginPopupBtn.onclick = function () {
        openPopup(loginPopup);
    };

    openRegisterPopupBtn.onclick = function () {
        openPopup(registerPopup);
    };

    closeLogin.onclick = function () {
        loginPopup.style.display = "none";
    };

    closeRegister.onclick = function () {
        registerPopup.style.display = "none";
    };

    openRegisterFromLogin.onclick = function () {
        openPopup(registerPopup);
    };

    openLoginFromRegister.onclick = function () {
        openPopup(loginPopup);
    };

    window.onclick = function (event) {
        if (event.target === loginPopup) {
            loginPopup.style.display = "none";
        }
        if (event.target === registerPopup) {
            registerPopup.style.display = "none";
        }
    };
});

function ouvrirFenetre(event) {
    event.preventDefault();  // Empêche le comportement par défaut de l'événement (suivre le lien)

    var url = event.currentTarget.href;  // Récupère l'URL du lien qui a été cliqué
    var width = 420;
    var height = 650;
    var left = (window.innerWidth - width) / 2;
    var top = (window.innerHeight - height) / 2;

    var options = "width=" + width + ",height=" + height +
        ",left=" + left + ",top=" + top +
        ",fullscreen=no,location=no,menubar=no,status=no,titlebar=no,toolbar=no";

    // Ouvre une nouvelle fenêtre avec l'URL spécifié, les options et la cible '_blank' (s'ouvre dans un nouvel onglet ou fenêtre)
    window.open(url, "_blank", options);
}
