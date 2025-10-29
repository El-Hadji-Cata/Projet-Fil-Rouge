/* const form = document.querySelector('form');
form.addEventListener('submit', function (event) {
    // Empêcher le rechargement de la page
    event.preventDefault();
    // Code de traitement du formulaire
    console.log('Formulaire soumis!');
}); */


/* const openMenu = () => {
    const menu = document.querySelector('.links'); */
/* menu.style.display = "flex"; */
/* menu.classList.toggle('visible');
if (menu.classList.contains('visible')) {
    document.querySelector('header .material-icons').innerHTML = "close";
    document.querySelector('.logo a').style.color = "#ffffff";

    menu.animate(
        [
            { transform: "translateX(100%)" },
            { transform: "initial" },
        ], { duration: 300, },
    ); */
/* document.querySelector('#img-logo').setAttribute('src', 'pictures/association2.png'); */
/*  } else {
     document.querySelector('header .material-icons').innerHTML = "menu";
     document.querySelector('.logo a').style.color = "#224631"; */
/* menu.animate(
    [
        { transform: "initial" },
        { transform: "translateX(100%)" },
    ], { duration: 1000, },

); */

/* }

} */

const burger = document.querySelector('.burger');
const menu = document.querySelector('.links');

burger.addEventListener('click', () => {

    //menu.style.display = "flex";
    //document.querySelector('.logo a').style.color = "#ffffff";
    burger.classList.toggle('active');
    menu.classList.toggle('visible');
    if (menu.classList.contains('visible')) {
        document.querySelector('.logo a').style.color = "#ffffff";
    } else {
        document.querySelector('.logo a').style.color = "#224631";
    }

    document.querySelectorAll(".nav-iem").forEach(n => n.addEventListener("click", () => {
        burger.classList.remove('active');
        menu.classList.remove('visible');
    }))

});


const animation = lottie.loadAnimation({
    container: document.querySelector('.lottie-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: 'https://lottie.host/d987597c-7676-4424-8817-7fca6dc1a33e/BVrFXsaeui.json'
});

