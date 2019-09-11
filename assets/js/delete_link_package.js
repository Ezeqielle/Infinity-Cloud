

window.onload = function () {

    var test = $(".linkPackage").attr('data_packages');

    retour = (test == "Gold package" ? $(".linkPackage").remove() : "");
    console.log(test, retour);

}