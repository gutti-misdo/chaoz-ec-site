/*拡大鏡のjsです*/ 

document.addEventListener('mousemove', function(e) {
    var magnifier = document.querySelector('.magnifier');
    var img = document.querySelector('.image-container img');
    var rect = img.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    if (x > 0 && y > 0 && x < rect.width && y < rect.height) {
        magnifier.style.display = 'block';
        magnifier.style.left = e.clientX - magnifier.offsetWidth / 2 + 'px';
        magnifier.style.top = e.clientY - magnifier.offsetHeight / 2 + 'px';
        magnifier.style.backgroundImage = 'url(' + img.src + ')';
        magnifier.style.backgroundRepeat = 'no-repeat';
        magnifier.style.backgroundSize = img.width * 2 + 'px ' + img.height * 2 + 'px';
        magnifier.style.backgroundPosition = '-' + x * 2 + 'px -' + y * 2 + 'px';
    } else {
        magnifier.style.display = 'none';
    }
});