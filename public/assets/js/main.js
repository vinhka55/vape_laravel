function getOffset( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
          _x += el.offsetLeft - el.scrollLeft;
          _y += el.offsetTop - el.scrollTop;
          el = el.offsetParent;
    }
    return { top: _y, left: _x };
}
var nav= document.getElementsByClassName('navigation')[0]
var yNav = getOffset(nav).top
window.addEventListener("scroll", (event) => {
    var scroll = this.scrollY;
    if(scroll>yNav){
        nav.classList.add('scroll-nav')
    }
    else{
        nav.classList.remove('scroll-nav')
    }
});