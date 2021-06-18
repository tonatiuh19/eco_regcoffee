function limitSlotsFunc() {
    var checkBox = document.querySelector(".checkSlots");
    var text = document.limitInput("text");

    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
}