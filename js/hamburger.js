function toggleMenu() {
    document.getElementsByClassName('navigation')[0].classList.toggle('responsive')
    
    if (document.getElementsByClassName('responsive')[0]) {
        document.querySelector('nav > button').innerHTML = `&#9776; Menu`;
    } else {
        document.querySelector('nav > button').innerHTML = `&#10006; Close`;
    }
}