$(".FolderClass").click(function () {

    $('.contextMenu').removeClass("show").hide()
    var getNameFolder = $(this).attr('id')

    $("."+getNameFolder).css({
        display: "block",
        float: "right",
        position : "relative",
        // top: "2em",
        left: "-2em"
    }).addClass("show");

})

//rename Folder
$(".renameFolder").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    var newName = prompt("Please enter new folder name:", "new name")
    if(newName == null || newName == "" || newName == "new name"){
        alert("User cancelled the prompt.")
    }else if(confirm('Rename folder ? ')){
        $.ajax({
            url: '/../../assets/functions/renameFolder.php',
            type: 'POST',
            data: {new: newName, name: GetName, path: GetPath},
            error: function(){
                alert('Failed')
            },
            succes: function(data){
                //location.reload()
                alert('Renamed successfully')
            }
        })
    }
})

//delete Folder
$(".DeleteFolder").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    console.log(GetName,GetPath)
    if(confirm('Delete folder ? ')){
        $.ajax({
            url: '/../../assets/functions/deleteFolder.php',
            type: 'POST',
            data: {name: GetName, path: GetPath},
            error: function(){
                alert('Failed')
            },
            succes: function(data){
                //location.reload()
                alert('Deleted successfully')
            }
        })
    }
})

//create Folder
$(".CreateFolder").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    var newName = prompt("Please enter new folder name:", "new name")
    if(newName == null || newName == "" || newName == "new name"){
        alert("User cancelled the prompt.")
    }else if(confirm('Create folder ? ')){
        $.ajax({
            url: '/../../assets/functions/createFolder.php',
            type: 'POST',
            data: {new: newName, name: GetName, path: GetPath},
            error: function(){
                alert('Failed')
            },
            succes: function(data){
                //location.reload()
                alert('Created successfully')
            }
        })
    }
})

//move Folder
$(".MoveFolder").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    //var newPath = "../../src/users/21/noobman"

    $(".modal-title").empty()
    $("#target_folder").empty()
    $(".modal-title").append("move : "+GetName)


    $(".Target").on('click',function () {
        $("#target_folder").empty()
        var TargetFolder = $(this).attr("data-position")
        var TargetName = $(this).attr("data-name")

        $("#target_folder").append("Folder : " + TargetName)

        $("#modal_confirm").on('click',function () {

            $.ajax({
                url: '/../../assets/functions/moveFolder.php',
                type: 'POST',
                data: {newpath: TargetFolder, name: GetName, path: GetPath},
                error: function(){
                    alert('Failed')
                },
                succes: function(data){
                    alert('Moved successfully')
                }
            })
        })
    })
})


///////////////////////////////////////////////////////////////////////////////

//rename File
$(".renameFile").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    var GetType = $(this).parent("div").attr("data-type")
    var newName = prompt("Please enter new file name:", "new name")
    if(newName == null || newName == "" || newName == "new name"){
        alert("User cancelled the prompt.")
    }else if(confirm('Rename file ? ')){
        $.ajax({
            url: '/../../assets/functions/renameFile.php',
            type: 'POST',
            data: {new: newName, name: GetName, path: GetPath, type: GetType},
            error: function(){
                alert('Failed')
            },
            succes: function(data){
                //location.reload()
                alert('Rename successfully')
            }
        })
    }
})

//delete File
$(".DeleteFile").click(function () {

    var GetPath = $(this).parent("div").attr("data-position")
    var GetName = $(this).parent("div").attr("data-name")
    if(confirm('Delete file ? ')){
        $.ajax({
            url: '/../../assets/functions/deleteFile.php',
            type: 'POST',
            data: {name: GetName, path: GetPath},
            error: function(){
                alert('Failed')
            },
            succes: function(data){
                //location.reload();
                alert('Deleted successfully')
            }
        })
    }
})

//download file
$(".DownloadFile").click(function () {

    var GetPath = $(this).parent("div").attr("data-position");
    var GetName = $(this).parent("div").attr("data-name");
    var urlLink = GetPath+'/'+GetName;

    // console.log(GetPath);

    // FirstPath distant
    var FirstPath = "http://ezeqielle.ovh/src/users/";
    // FirstPath local
    // var FirstPath = "http://noobsite/src/users/";


    var SecondPath = GetPath.substring(16);
    var FinalPath = FirstPath+SecondPath+'/'+GetName;

    // console.log(SecondPath)
    console.log(FinalPath);

    var link = $(".DownloadFile");
    link.attr("href", FinalPath);
    link.attr("download", GetName);

})

$(".MoveFile").click(function () {

    var GetPath = $(this).parent("div").attr("data-position");
    var GetName = $(this).parent("div").attr("data-name");

    $(".modal-title").empty()
    $("#target_folder").empty()
    $(".modal-title").append("move : "+GetName)

    $(".Target").on('click',function () {
        $("#target_folder").empty()
        var TargetFolder = $(this).attr("data-position")
        var TargetName = $(this).attr("data-name")

        $("#target_folder").append("Folder : "+TargetName)

        $("#modal_confirm").on('click',function () {
            $.ajax({
                 url: '/../../assets/functions/moveFile.php',
                 type: 'POST',
                 data: {newpath: TargetFolder, name: GetName, path: GetPath},
                 error: function(){
                     alert('Failed')
                 },
                 succes: function(data){
                     alert('Moved successfully')
                 }
             })


        })
    })

})
