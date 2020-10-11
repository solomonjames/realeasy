require('./bootstrap');

const ignoreButtons = document.getElementsByClassName('ignore-button');

ignoreButtons.addEventListener('click', () => console.log('I WAS CLICKED'));
