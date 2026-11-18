'use strict';
// Menú lateral desplegable dinámico para estructuras de carpetas
const menuids = ["sidebarmenu1"];

function initsidebarmenu() {
    for (let i = 0; i < menuids.length; i++) {
        const menuEl = document.getElementById(menuids[i]);
        if (!menuEl) continue;

        const ultags = menuEl.getElementsByTagName("ul");
        for (let j = 0; j < ultags.length; j++) {
            const anchor = ultags[j].parentNode.getElementsByTagName("a")[0];
            if (anchor) {
                anchor.className += " subfolderstyle";
            }
            if (ultags[j].parentNode.parentNode.id === menuids[i]) {
                ultags[j].style.left = ultags[j].parentNode.offsetWidth + "px";
            } else if (ultags[j - 1]) {
                const prevAnchor = ultags[j - 1].getElementsByTagName("a")[0];
                if (prevAnchor) {
                    ultags[j].style.left = prevAnchor.offsetWidth + "px";
                }
            }
            ultags[j].parentNode.onmouseover = function () {
                const subUl = this.getElementsByTagName("ul")[0];
                if (subUl) subUl.style.display = "block";
            };
            ultags[j].parentNode.onmouseout = function () {
                const subUl = this.getElementsByTagName("ul")[0];
                if (subUl) subUl.style.display = "none";
            };
        }
        for (let j = ultags.length - 1; j > -1; j--) {
            ultags[j].style.visibility = "visible";
            ultags[j].style.display = "none";
        }
    }
}
window.addEventListener("load", initsidebarmenu);
