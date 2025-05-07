const root = document.documentElement;
btnSwitchColor = document.getElementById("switchColor");

switchTheme = function(){
    if (root.style.getPropertyValue('--cor-texto') === "#fefefe") {
        //ativar modo claro
        root.style.setProperty('--cor-texto', 'rgb(51, 51, 51)');
        root.style.setProperty('--cor-fundoPadrao', '#fefefe');
        /*
        btnSwitchColor.children[0].src = "assets/icons/sun.svg";
        btnSwitchColorMobile.children[0].src = "assets/icons/sun.svg";
        */
    } else {
        //ativar modo escuro
        root.style.setProperty('--cor-texto', '#fefefe');
        root.style.setProperty('--cor-fundoPadrao', 'rgb(51, 51, 51)');
        
        /*
        btnSwitchColor.children[0].src = "assets/icons/moon.svg";
        btnSwitchColorMobile.children[0].src = "assets/icons/moon.svg";
        */
    }
} 
btnSwitchColor.addEventListener("click", switchTheme);