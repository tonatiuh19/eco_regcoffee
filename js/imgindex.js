$( document ).ready(function() {
    var arra = ["imgBorder", "imgBorderBlue", "imgBorderGreen", "imgBorderPink"];
    var x = Math.floor(Math.random() * 3);
    $("#imgChangeBorder").addClass(arra[x]);
    $("#img-phone").addClass(arra[x]);
});