"use strict";

const closeMessage = document.getElementsByClassName('closeMessenger');
const messenger = document.getElementsByClassName('messenger');

for (const closeButton of closeMessage) {
    closeButton.addEventListener('click', () => {
        getRidOfMessenger();
    });
}

setTimeout(function () {
    getRidOfMessenger();
}, 3000);

function getRidOfMessenger() {
    for (const messageArea of messenger) {
        messageArea.style.display = 'none';
    }
}

