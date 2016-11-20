function imageRandom(){

var randomize = Math.round(Math.random()*5)+1
if (randomize == 1){
document.body.style.backgroundImage="url(../imagenes/fondo4.jpg)";
}else if (randomize == 2){
document.body.style.backgroundImage="url(../imagenes/fondo5.jpg)";
}else if (randomize ==3){
document.body.style.backgroundImage="url(../imagenes/fondo6.jpg)";
}else if (randomize ==4){
document.body.style.backgroundImage="url(../imagenes/fondo7.jpg)";
}else if (randomize ==5){
document.body.style.backgroundImage="url(../imagenes/fondo9.jpg)";
}else{
document.body.style.backgroundImage="url(../imagenes/fondo8.jpg)";
}

} 