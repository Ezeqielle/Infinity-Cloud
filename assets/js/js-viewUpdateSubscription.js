
window.onload = function () {
    
    for (var i = 1; i < 3; i++) {

        str = "btn0" + i;

        Tablestr = $('.' + str + '').attr('data-listPackage');
        userstr = $('.' + str + '').attr('data-userPackage');

        formatSTR = '.' + str;


        // console.log(str);
        // console.log(Tablestr);
        // console.log(userstr);
        // console.log(formatSTR);

        if (Tablestr == userstr) {
            $(".btn0" + i + "").text('current package');
            $(".btn0"+ i + "").toggleClass("btn-success btn-danger");
            $(".btn0" + i + "").attr("disabled", true);
        }
    }
};

$(".btnSUB").click(function(){

    var change_package = $(this).attr('data-listPackage');
    var userID = $(this).attr('data_userID');

    //console.log(userID, change_package);

    if(confirm('Change package')) {
        $(this).text('current package');
        $(this).toggleClass("btn-success btn-danger");
        $(this).attr("disabled", true);

        $.ajax({
            url: '/../../assets/functions/change_package.php',
            type: 'POST',
            data: {id: change_package, idUSER: userID},
            error: function () {
                alert('Failed');
            },
            success: function (data) {
                alert("change successfully");
            }
        });
    }

});