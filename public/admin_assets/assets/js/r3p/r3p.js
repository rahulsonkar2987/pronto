

    $('.upload_file').change(function(event){
        $('#image').removeClass('d-none');
        $('#image').attr('src', URL.createObjectURL(event.target.files[0]));

        // $("#image").css("width", maxWidth); // Set new width
        // $("#image").css("height", maxHeight);   // Set new height
   
    });

    $('.upload_file2').change(function(event){
        $('#image2').removeClass('d-none');
        $('#image2').attr('src', URL.createObjectURL(event.target.files[0]));

        // $("#image").css("width", maxWidth); // Set new width
        // $("#image").css("height", maxHeight);   // Set new height
   
    });


    // show password start here 
    $(".show_pass_btn").on("click",function(e){
        e.preventDefault();
        var show_pass=$(".show_pass").attr('type');
            if(show_pass === "password"){
                $(".show_pass").attr('type','text');  
            }else{
                $(".show_pass").attr('type','password');  
            }
    });


    function getError(jqXHR,get_error){
        $(".dis_btn").prop('disabled',false);
        if (jqXHR.status === 0) {
            alert('Not connect! please Verify Network.');
        } else if (jqXHR.status == 404) {
            alert('Requested page not found. [404]');
        } else if (jqXHR.status == 500) {
            alert('Internal Server Error [500]');
        } else if (get_error === 'parsererror') {
            alert('Requested JSON parse failed');
        } else if (get_error === 'timeout') {
            alert('Time out error');
        } else if (get_error === 'abort') {
            alert('Ajax request aborted.');
        }else{
            $.each(jqXHR.responseJSON.errors,function(field_name,error){
                $(document).find('[name='+field_name+']').after('<span class="text-strong d-block text-danger error">' +error+ '</span>');
            });
        }
    }


