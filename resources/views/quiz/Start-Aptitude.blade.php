<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}


<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <span> {{ $question_info[0]->category_name }} </span>

                        <div class="px-4 mt-1">
                            <p class="fonts">  </p>

                        </div>


                        <div class="buttons">

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

                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r1" value="A">  a
                <label class="form-check-label" for="q1_r1"> {{ $key->option1 }}</label>

                </div>

                {{-- Option 2 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r2" value="B">b
                <label class="form-check-label" for="q1_r2">{{ $key->option2 }}</label>
                </div>

                {{-- Option 3 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r3" value="C">c
                <label class="form-check-label" for="q1_r3">{{ $key->option3 }}</label>
                </div>

                {{-- Option 4 --}}
                <div class="form-check">
                <input class="form-check-input" type="radio" name="qustion-{{ $key->id }}" id="q1_r4" value="D">d
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

        <div class="card">
        <div class="card-body">
            {{-- <p id="result">No result.</p> --}}

            <div class="progress mb-2">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <button type="submit" class="btn btn-success center">submit</button>
        </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){

    $('#addaptitude').on('submit', function (evt) {

        evt.preventDefault();
        var data=$('#addaptitude').serialize();
        console.log(data);
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
                window.location=response.url;
               }

            }

        });
    });

    });
      </script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </div>

{{-- @php
 echo "<pre>";
    print_r($candidate_session);
     echo "now Question Set<br>";
     echo "<pre>";
    dd($question_info);

@endphp --}}
