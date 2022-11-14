
// OBSOLETO
var navItemsID = [
    "navbarHome",
    "navbarPerfil",
    "navbarConteudo",
    "navbarChat",
    "navbarCalendario",
    "navbarUpload"
];

var navItems = [];

window.addEventListener('load', function () {
    
    for (var i = 0; i < navItemsID.length; i++){
        navItems[i] = document.getElementById(navItemsID[i]);
    }
    
    selectMenu = function(pagina){
        for (var i = 0; i < navItemsID.length; i++){
            navItems[i].className = "";
        }
        navItems[pagina].className = "active"
    }
})

