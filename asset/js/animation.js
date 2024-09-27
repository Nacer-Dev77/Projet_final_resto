//*******************************************************
//Animation du titre
//*******************************************************

const texte = document.querySelector('.title');
const voluteLeft = document.querySelector('.volute_left_write');
const voluteRight = document.querySelector('.volute_right_write');
const voluteLeftTexte = '<img src="asset/images/volute2.jpg" alt="" class="volute_left">';
const voluteRightTexte ='<img src="asset/images/volute2.jpg" alt="" class="volute_right">';



setTimeout(() => {
  texte.innerHTML="Nawel'S Naturalia food";
}, 1500)

setTimeout(() => {
  voluteLeft.innerHTML= voluteLeftTexte;
}, 1000)

setTimeout(() => {
  voluteRight.innerHTML= voluteRightTexte;
}, 1000)





