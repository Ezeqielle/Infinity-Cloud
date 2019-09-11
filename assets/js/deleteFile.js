$(".delete").click(function(){
    var getLNB = $(this).attr("data-delete")
    var getFileName = $(".fileName"+getLNB+"").text()

    if(confirm('Delete file ?'+getFileName)){
        $.ajax({
            url: '/../../assets/functions/deleteFile.php',
            type: 'POST',
            data: {propFileName: getFileName},
            error: function(){
                alert('Failed')
            },
            success: function(data){
                $("#"+getLNB).remove()
                alert("Deleted successfully")
            }
        })
    }
});


