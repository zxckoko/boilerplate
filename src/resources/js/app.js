import './bootstrap';

import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/all';

import 'flowbite'; // flowbite, a tailwind component/ui library

/*
* - "nest", instead of complete replace, on.DOMContentLoaded messes up with 'hidden' class toggles
* - "nest" did not fix it, enclosed fa element in a div instead and gave that the ID attr... better
* - enclosing the fa element in a div is not a 100% fix
* */
FontAwesome.config.autoReplaceSvg = "nest";

// set HTML display to 'none' to avoid Flash Of Unstyled Content (FOUC) (note of FOUT too (FOUText))
// IF FOUC is experienced, Tailwind suggests to place this piece of code inline, inside <head> tag
document.addEventListener("DOMContentLoaded", () => {
    let darkToggleId = 'theme-toggle-dark-icon';
    let lightToggleId = 'theme-toggle-light-icon';

    if (! ('theme' in localStorage)) {
        localStorage.theme = 'dark';
    }

    if ('theme' in localStorage && localStorage.theme === 'dark') {
        document.getElementById(lightToggleId).classList.add('hidden');
        document.getElementById(darkToggleId).classList.remove('hidden');
    }

    if ('theme' in localStorage && localStorage.theme === 'light') {
        document.getElementById(darkToggleId).classList.add('hidden');
        document.getElementById(lightToggleId).classList.remove('hidden');
    }

    document.documentElement.classList.toggle('dark', localStorage.theme === 'dark');

    window.onload = function () {
        document.documentElement.style.display = '';
    }
});

document.getElementById("theme-toggle").addEventListener('click', () => {
    document.getElementById("theme-toggle-dark-icon").classList.toggle("hidden");
    document.getElementById("theme-toggle-light-icon").classList.toggle("hidden");

    localStorage.theme = ('theme' in localStorage && localStorage.theme === 'dark') ? 'light' : 'dark';

    document.documentElement.classList.toggle(
        'dark',
        localStorage.theme === 'dark'
    );
});
