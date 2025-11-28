showAlert(){
    alert("Your data was saved");
}
function showGifAlert(){
    alert("You rang the bell")
}
let name;
while(name == "" || name == null){
    name = prompt("Shenoni emrin tuaj:")
}
document.getElementById("emri").innerHTML = name;