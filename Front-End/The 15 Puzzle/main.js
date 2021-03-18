const mapGame = document.querySelector("#mapGame");
const solution = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 0];
let valeurs = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];

let valeurHTML = '';

function map(valuers){
    mapGame.innerHTML = null;
    valeurHTML = '';
    for(var i = 0; i < 16; i++){
        if(valeurs[i] === 0){
            valeurHTML += `
                <div class = "numberCard" id = "Zero" data-numb="${0}">
                    <a>${0}</a>
                </div> 
            `
        }else{
            valeurHTML += `
                <div class = "numberCard" data-numb="${valeurs[i]}">
                    <a>${valeurs[i]}</a>
                </div> 
            `
        }
    }
    mapGame.innerHTML = valeurHTML;
}

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

function troca(valeurs, a, b){
    var aux;
    aux = valeurs[a];
    valeurs[a] = valeurs[b];
    valeurs[b] = aux;
}

function moveNumber(){
    for(var i = 0; i < 16; i++){
        if(valeurs[i] === 0){
            var zeroPosition = i;
        }
        if (valeurs[i] == this.dataset.numb){
            var numbPosition = i;
        }
    }
    var aux = zeroPosition - numbPosition;
    // Uper and Down .
    if(Math.abs(aux)%4 == 0){
        if ((aux) > 0){
            for (var i = 0; i < (Math.abs(aux)/4); i++){
                troca(valeurs, zeroPosition - (4 * i), zeroPosition - (4 * (i + 1)));
            }
        }else{
            for (var i = 0; i < (Math.abs(aux) / 4); i++) {
                troca(valeurs, zeroPosition + (4 * i), zeroPosition + (4 * (i + 1)));
            }
        }
    }
    
    // Extreme left.
    else if ((zeroPosition + 1)%4 == 0){
        if ((aux) < 4 && (aux) > 0){
            for (var i = 0; i < Math.abs(aux); i++) {
                troca(valeurs, zeroPosition - i, zeroPosition - (i + 1));
            }
        }
    }
    
    // Middle left.
    else if ((zeroPosition + 2) % 4 == 0) {
        if ((aux) === -1) {
            troca(valeurs, zeroPosition, zeroPosition + 1);
        } else if ((aux) > 0 && (aux) < 3) {
            for (var i = 0; i < Math.abs(aux); i++) {
                troca(valeurs, zeroPosition - i, zeroPosition - (i + 1));
            }
        }
    }

    // Middle right.
    else if ((zeroPosition + 3) % 4 == 0) {
        if ((aux) === 1) {
            troca(valeurs, zeroPosition, zeroPosition - 1);
        } else if ((aux) < 0 && (aux) > -3) {
            for (var i = 0; i < Math.abs(aux); i++) {
                troca(valeurs, zeroPosition + i, zeroPosition + (i + 1));
            }
        }
    }

    // Extreme right.
    else if ((zeroPosition + 4)%4 == 0) {
        if ((aux) > -4 && (aux) < 0){
            for (var i = 0; i < Math.abs(aux); i++) {
                troca(valeurs, zeroPosition + i, zeroPosition + (i + 1));
            }
        }
    }
    
    setMap();
    testMap();
    return false;
}

function testMap(){
    if(valeurs === solution){
        alert("YOU WIN !!");
    }
}

function setMap() {
    map(valeurs);
    const numbs = document.querySelectorAll('.numberCard');
    numbs.forEach(numb => numb.addEventListener("click", moveNumber));
}

shuffle(valeurs);
setMap();
