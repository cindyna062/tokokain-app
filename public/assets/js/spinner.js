var pre = document.createElement("div");
pre.innerHTML = '<div class="loader-wrapper"><div class="spinner-grow"></div></div>';
document.body.insertBefore(pre, document.body.firstChild);

document.addEventListener("DOMContentLoaded", function(event) {
    document.body.className += " loaded"
});
