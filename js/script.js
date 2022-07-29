const closeNotif = () => {
    let close = document.getElementsByClassName("close_notif");
    let i;

    for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        let div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){
            div.style.display = "none"; 
        }, 600);
    }
    }
}

const menuSub = () => {
    let x = document.getElementById("menu_profile");

    if (x.className === "submenu_profile") {
        x.className += " responsive";
    } else {
        x.className = "submenu_profile";
    }
}

const openMenu = () => {
    document.getElementById("menu_kategori").style.width = "220px";
    document.getElementById("container_kanan").style.marginLeft = "200px";
    document.getElementById("container_kanan").style.width = "1080px";
}

const closeMenu = () => {
    document.getElementById("menu_kategori").style.width = "0";
    document.getElementById("container_kanan").style.marginLeft = "0";
    document.getElementById("container_kanan").style.width = "100%";
}