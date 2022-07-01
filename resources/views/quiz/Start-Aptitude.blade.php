<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aptitude | Walstar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 </head>
<body>


@php

@endphp



<div class="container-fluid">
<style>
    .form-check-label{
        pointer-events: none;
    }
</style>
    {{-- <div class="jumbotron">
      <h3>The big knowledge test!</h3>
      <p>How good is your general knowledge?</p>
    </div> --}}

    <div class="container mt-5">

        <div class="row d-flex justify-content-center">

            <div class="col-md-7">

                <div class="card p-3 py-4">
                    {{-- <div class="text-center">
                        <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
                    </div> --}}


                    <div class="text-center mt-3">
                        {{-- <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span> --}}
                        <h5 class="mt-2 mb-0"> {{ $candidate_session['candidate_name'] }}</h5>
                        <p>{{ $candidate_session['candidate_email'] }}</p>
                        <span> Your Aptitude Test Based On : <strong>{{ $question_info[0]->category_name }}</strong> </span>

                        <div class="px-4 mt-1">
                            <p class="fonts">  </p>

                        </div>


                        <div class="buttons">
                            <div class="d-flex justify-content-center border border-success"><h3>Remaning Time : <span  id="counter-sb" > </span>  </h3> </div>
                            {{-- <button class="btn btn-outline-primary px-4">Message</button>
                            <button class="btn btn-primary px-4 ms-3">Contact</button> --}}
                        </div>


                    </div>

                </div>

            </div>

        </div>




    </div><br>
    <form action="#" method="post"  id="addaptitude">
        @csrf
        <input type="hidden" name="candidate_name" id="candidate_name" value="{{ $candidate_session['candidate_name'] }}">
        <input type="hidden" name="candidate_email" id="candidate_email" value="{{ $candidate_session['candidate_email'] }}">
        <input type="hidden" name="candidate_id" id="candidate_id"  value="{{ $candidate_session['candidate_id'] }}">

@php
    $ct=1;
    foreach($question_info as $key):
@endphp

<div class="card border-info mb-4 ">

            <div class="d-flex justify-content-between align-items-center card-header bg-info text-white" id="h1">
            <span>Question {{$ct}}</span>
            <button type="button" data-toggle="collapse" data-target="#q1" aria-expanded="false" aria-controls="q1" class="btn btn-outline-light">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>
            </div>


            <div id="q1{{ $key->id }}" class="collapse show" aria-labelledby="h1">
            <div class="card-body">
                <p> {{ $key->question }}</p>

                {{-- Option 1 --}}
                <div class="form-check">

                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r1" value="A">
                <label class="form-check-label" for="q1_r1"> {{ $key->option1 }}</label>

                </div>

                {{-- Option 2 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r2" value="B">
                <label class="form-check-label" for="q1_r2">{{ $key->option2 }}</label>
                </div>

                {{-- Option 3 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r3" value="C">
                <label class="form-check-label" for="q1_r3">{{ $key->option3 }}</label>
                </div>

                {{-- Option 4 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r4" value="D">
                <label class="form-check-label" for="q1_r4">{{ $key->option4 }}</label>
                </div>

            </div>

            </div>
        </div>



        @php
        $ct++;
        endforeach;
        @endphp


       {{-- <h3>Result</h3> --}}


            {{-- <button type="submit" class="btn btn-success center">submit</button> --}}
            <div class="container">
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" class="btn btn-info center btn-lg" >Finish Aptitude</button>
                  </div>
                </div>
              </div>


    </form>
<style>
    body {
  /* background: #ececec; */
}
.lds-dual-ring.hidden {
display: none;
}
.lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 5% auto;
  border-radius: 50%;
  border: 6px solid #fff;
  border-color: #fff transparent #fff transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,.8);
    z-index: 999;
    opacity: 1;
    transition: all 1.50s;
}
</style>
    <div id="loader" class="lds-dual-ring hidden overlay"></div>


{{-- <script>
    $(document).ready(function(){

        if(window.location.href.substr(-2) !== "?r")
        {
           window.location = window.location.href + "?r";
         }
        var session_cat_id =  {{  Session::get('candidate_id');}}
    // alert(session_cat_id)
           if (session_cat_id == null){
    alert("as nahi exam deta yet dadyaaa, ekda submit kel ki..!")
}
    });
</script> --}}

<script>
    window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    //alert('refresh');
    window.location.reload();
  }
});
</script>

    <script>
        $(document).ready(function(){

    $('#addaptitude').on('submit',function (evt) {

        evt.preventDefault();
        var data=$('#addaptitude').serialize();
        // console.log(data);
        if (confirm('Are you sure you want to submit your test')) {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'Aptitude-Store',
            data: data,
            dataType : 'json',
            beforeSend: function() {
        $('#loader').removeClass('hidden')
    },
            success: function(response) {
                if(response.status=="200")
               {
                // alert("Success madhe yetey")
                window.location=response.url;

               }

            },
            complete: function(){
        $('#loader').addClass('hidden')
    },

        });
    }
    });

    });
      </script>

      <script>
        // Set the date we're counting down to
        var settingEndTimeID = @json($settingEndTime);
        // var countDownDate1 = new Date("Sep 22, 2022 15:37:25").getTime();
        var countDownDate = new Date(settingEndTimeID).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

              // Get today's date and time
          var now = new Date().getTime();

          // Find the distance between now and the count down date
          var distance = countDownDate - now;
// console.log(distance);

          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Output the result in an element with id="demo"
        //   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        //   + minutes + "m " + seconds + "s ";
        document.getElementById("counter-sb").innerHTML = hours + "h "
          + minutes + "m " + seconds + "s ";

          // If the count down is over, write some text
          if (distance < 0) {
            clearInterval(x);
            alert("Your Time Has Ended");
            document.getElementById("counter-sb").innerHTML = "EXPIRED";
            alert("Your Exam Will Auto Submit...!");

            var data=$('#addaptitude').serialize();
            // console.log(data)
            $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'Aptitude-Store',
            data: data,
            dataType : 'json',
            success: function(response) {
                if(response.status=="200")
               {
                document.getElementById("addaptitude").reset();
                window.location=response.url;
               }

            }

        });
          }
        }, 1000);
        </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </div>
</body>
</html>

