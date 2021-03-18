 const cardBoard = document.querySelector("#cardboard");
 const images = [
     'angular.svg',
     'aurelia.svg',
     'backbone.svg',
     'ember.svg',
     'react.svg',
     'vue.svg'
 ];

 let cardHTML = '';

 images.forEach(img => {
    cardHTML += `
        <div class = "memory-card" data-card="${img}">
            <img class = "front-face" src="images/${img}">
            <img class = "back-face" src="images/js-badge.svg">
        </div> 
    `
 });

 cardBoard.innerHTML = cardHTML + cardHTML;

 /** Fim Renderização HTML */

const cards = document.querySelectorAll('.memory-card');
let firstCard, secondCard;
let lockCard = false;
let trys = 0;
let pares = 0;


function flipCard(){
    //console.log(this);
    if(lockCard){
        return false;
    }
    this.classList.add('flip');
    if(!firstCard){
        firstCard = this;
        return false;
    }
    secondCard = this;
    trys++;
    checkForMatch();
}

function checkForMatch(){
    let isMatch = firstCard.dataset.card === secondCard.dataset.card;
    !isMatch ? disableCards() : resetCards(isMatch);
}

function disableCards(){
    lockCard = true;
    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');
        resetCards();   
    }, 1000);
}

(function shuffle(){
    cards.forEach(card => {
        let rand = Math.floor(Math.random()*12);
        card.style.order = rand;
    })
})()

function resetCards(isMatch = false){
    if(isMatch){
        firstCard.removeEventListener("click", flipCard);
        secondCard.removeEventListener("click", flipCard);
        pares++;
    }
    [firstCard, secondCard, lockCard] = [null, null, false];
}
console.log(cards);
cards.forEach(card => card.addEventListener("click", flipCard));
