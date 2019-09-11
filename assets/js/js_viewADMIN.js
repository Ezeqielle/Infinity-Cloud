

window.onload = function () {

    $('button[data-stat="1"]').text("unban");
    $('button[data-stat="1"]').toggleClass( "btn-success btn-dark");

}

$(".delete").click(function(){
    var id = $(this).parents("tr").attr("id");


    if(confirm('Delete customer ?'))
    {
        $.ajax({
            url: '/../../assets/functions/delete.php',
            type: 'GET',
            data: {id: id},
            error: function() {
                alert('Failed');
            },
            success: function(data) {
                $("#"+id).remove();
                alert("Deleted successfully");
            }
        });
    }
});


$(".statut").click(function(){

    //get statut
    var getSTATUT = $(this).attr('data-stat');
    var stat = (getSTATUT == '0' ? '1' : '0');

    //get user_id
    var id = $(this).parents("tr").attr("id");

    $.ajax({
        url: '/../../assets/functions/ban.php',
        type: 'POST',
        data: {id: id, status: stat},
        error: function() {
            alert('Failed');
        },
        success: function(data) {
            $(".stat"+id).attr("data-stat", stat);
            $(".stat"+id).toggleClass( "btn-success btn-dark");
            $(".stat"+id).text( $(".stat"+id).text() == 'unban' ? 'ban' : 'unban');
        }
    });
});