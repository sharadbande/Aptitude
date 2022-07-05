function resultAjax(candidate_email){

    // for download click and function functionlity
    // sessionStorage.removeItem('candidate_email');
    // sessionStorage.setItem('candidate_email',candidate_email);

//    var candidate_email_sess =  sessionStorage.getItem('candidate_email');
//    console.log(sessionStorage.getItem(candidate_email));

//    $("#candidate_email_sess").val(candidate_email_sess);


           $.ajax({
            method:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/Show-Result-from-id',
            dataType:'json',
            data:{'candidate_email':candidate_email},
            success: function(response){
            console.log(response);

            //   swal.fire("Done!", response.massage, response.alerttype, 5000,);
              // location.reload();
            //   document.getElementById("demo").innerHTML = xhttp.responseText;
            $("#candidate_email").text(response.email.candidate_email);
            $("#question_count").text(response.question_count.question_count);
            $("#correct_answer").html(response.correct_answer.correct_answer);
            $("#total_percentage").html(response.total_percentage.total_percentage);

            $('#candidate_email_sess').val(response.email.candidate_email);
            // $('#email-btn').attr("data-myval",response.email.candidate_email);

              $("#bsModal3").modal('show');
            },
           });
        }

$(document).ready(function(){
    $('#email-btn').click(function(){

       var canEmailfordownload=  $('#candidate_email_sess').html('input:text').val();

       $.ajax({
        method:'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/Download-Result-from-email',
        dataType:'json',
        data:{'candidate_email':canEmailfordownload},
        success: function(response){
            alert(response);

        },
       });

    });
});
