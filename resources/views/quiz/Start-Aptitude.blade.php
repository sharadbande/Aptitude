<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aptitude | Walstar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 </head>
<body>

<div class="container-fluid">



{{-- *******************************************IMP : Prevent Question select and copy as well as prevent option click ********************** --}}
<style>
    .form-check-label{
        pointer-events: none;
    }
    body {
            user-select: none; /* supported by Chrome and Opera */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
        }
</style>
{{-- *******************************************IMP : Prevent Question select and copy as well as prevent option click ********************** --}}




{{-- *******************************************IMP : Next button and validation********************** --}}
<style>
   /* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
{{-- *******************************************IMP : Next button and validation********************** --}}



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


    </div>

    <br>
    <form action="#" method="post"  id="addaptitude">
        @csrf
        <input type="hidden" name="candidate_name" id="candidate_name" value="{{ $candidate_session['candidate_name'] }}">
        <input type="hidden" name="candidate_email" id="candidate_email" value="{{ $candidate_session['candidate_email'] }}">
        <input type="hidden" name="candidate_id" id="candidate_id"  value="{{ $candidate_session['candidate_id'] }}">

{{-- *******************************************IMP : Show validation Error**************************************************************--}}

        <h3><p id="errorptag" style="display:none" ></p></h3>
{{-- *******************************************IMP : Show validation Error **************************************************************--}}

@php
    $ct=1;
    $total_qustion_count= count($question_info);
    foreach($question_info as $key):
@endphp
<div class="tab">
<div class="card border-info mb-4">

            <div class="d-flex justify-content-between align-items-center card-header bg-info text-white" id="h1">
            <span>Question {{$ct }}/{{ $total_qustion_count}}     </span>
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

                    <input class="form-check-input" type="radio"   name="qustion-{{ $key->id }}" id="qustion-{{ $key->id }}" value="A" required/>
                    <label class="form-check-label" for="q1_r1"> {{ $key->option1 }}</label>

                    </div>

                    {{-- Option 2 --}}
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="qustion-{{ $key->id }}" value="B" required/>
                    <label class="form-check-label" for="q1_r2">{{ $key->option2 }}</label>
                    </div>

                    {{-- Option 3 --}}
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="qustion-{{ $key->id }}" value="C" required/>
                    <label class="form-check-label" for="q1_r3">{{ $key->option3 }}</label>
                    </div>

                    {{-- Option 4 --}}
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="qustion-{{ $key->id }}" value="D" required/>
                    <label class="form-check-label" for="q1_r4">{{ $key->option4 }}</label>
                    </div>

                </div>

            </div>

        </div>

    </div>


        @php
        $ct++;
        endforeach;
        @endphp

       {{-- <h3>Result</h3> --}}

       <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
            {{-- <button type="submit" class="btn btn-success center">submit</button> --}}
            <div class="container" id="finalbutton">
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" class="btn btn-info center btn-lg" >Finish Aptitude</button>
                  </div>
                </div>
              </div>


    </form>

    <div style="text-align:center;margin-top:40px;">
@php
    foreach($question_info as $key2):
    @endphp
    <span class="step"></span>

 @php
endforeach;
@endphp
</div>

{{-- *******************************************IMP : after exam submited back not allowed**************************************************************--}}
<div id="loader" class="lds-dual-ring hidden overlay"></div>
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
{{-- *******************************************IMP : after exam submited back not allowed**************************************************************--}}



{{-- *******************************************IMP: multistep logic here **************************************************************--}}

 <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {

      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
        // console.log(x)

      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:


      var store = new Array();
      for (i = 0; i < y.length; i++) {
        // If a field is empty...

        store[i]=y[i].checked;
        //  console.log(store);

      }
        if(store.includes(true)){
            console.log("selected");
        document.getElementById("errorptag").style.display = "none";

            valid = true;
        }
        else{
        // sweetAlert("Error", "You have not selected any option", "error");
        // sweetAlert('You have not selected any option');

        var seterromsg = document.getElementById("errorptag");
        document.getElementById("errorptag").style.display = "inline";
        $("#errorptag").css("color", "red");
        // $("#errorptag").fadeIn(6000);

        seterromsg.innerText= "You have not selected any option....!";



        // swal({
        //             title: "You have not selected any option ",
        //             text: "Validation",
        //             type: "error",
        //              timer: 1000
        //           });
                  valid = false;
            console.log("not selected");
        }


      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>
{{-- *******************************************IMP: multistep logic here **************************************************************--}}


{{-- *******************************************IMP: Exam Submite **************************************************************--}}

    <script>
        $(document).ready(function(){

    $('#addaptitude').on('submit',function (evt){

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
{{-- *******************************************IMP: Exam Submite **************************************************************--}}



{{-- *******************************************IMP: Countdown counter logic and after time Expired exax will be auto submited***************--}}

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
{{-- *******************************************IMP: Countdown counter logic and after time Expired exax will be auto submited***************--}}



{{-- *******************************************IMP: F5 not allowed in page **************************************************************--}}
<script type="text/javascript">
  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 116) {
        event.preventDefault();
        return false;
      }
    });
  });
</script>
{{-- *******************************************IMP: F5 not allowed in page **************************************************************--}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </div>
</body>
</html>

