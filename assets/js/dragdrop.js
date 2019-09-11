
jQuery(document).ready(function(){

    $.fn.ZoneDeDrop = function(item) {

            $(this).bind({

                dragover : function(data) {
                    // annuler evenement par defaut
                    data.preventDefault();
                    $(this).addClass('hover');
                    // console.log('dragover');
                },
                dragleave : function(data) {
                    // annuler evenement par defaut
                    data.preventDefault();
                    $(this).removeClass('hover');
                    // console.log('dragleave');
                }
                ,
                drop : function(data) {
                    // annuler evenement par defaut
                    data.preventDefault();

                    var fileobj;
                    var fileobj = data.target.files;

                    //voir https://stackoverflow.com/questions/10813494/javascript-html5-jquery-drag-and-drop-upload-uncaught-typeerror-cannot-read
                    if (!fileobj || fileobj.length === 0)
                        fileobj = (data.dataTransfer ? data.dataTransfer.files : data.originalEvent.dataTransfer.files);

                    upload_process(fileobj[0]);
                    console.log(fileobj[0]);

                    $(this).removeClass('hover');


                }//end drop function

            });
    }

    function upload_process(file_obj) {
        if(file_obj != undefined) {
            var form_data = new FormData();
            form_data.append('file', file_obj);
            $.ajax({
                type: 'POST',
                url: '../../assets/functions/dragdrop.php',
                contentType: false,
                processData: false,
                data: form_data,
                error: function(){
                    alert('Failed')
                },
                success:function(response) {
                    alert('File Uploaded');
                }
            });
        }
    }


});



