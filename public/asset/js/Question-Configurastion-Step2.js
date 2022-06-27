$(document).ready(function(){

    $('#addquestionform').on('submit', function (evt) {
        evt.preventDefault();
        var data=$('#addquestionform').serialize();

        console.log(data);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'Question_Post',
            data: data,
            dataType : 'json',
            success: function(response) {
                if(response.status=="200")
               {

                swal.fire("Done!", response.message, "success");
                $('#addquestion').modal('toggle');
                location.reload();
               }

            }

        });
    });

    });
function goback()
{
    swal.fire("Back...!", "success");
    // return redirect('Question-Set');
    window.location = "/Question-Set"
}
