<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aptitude | Walstar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- CSS only -->
<link rel="icon" href="{{ asset('asset/img/WT-fev-logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>
<body>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact us</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
      <h1 class="text-center" style="padding: 10px;">Aptitude</h1>
      @if(session()->has('success-message'))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
         <h5><p style="color: green ;  text-align: right;">  {{ session()->get('success-message') }} </p></h5>
     </div>
   @endif

   @if(session()->has('error-message'))
    <div class="alert alert-error" id="error-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
         <h5><p style="color: red; text-align: right;">  {{ session()->get('error-message') }} </p></h5>
     </div>
   @endif
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
                <div class="login-logo">
                    {{-- <a href="/login"><b>Admin</b>LTE</a> --}}
                    <img  src="{{ asset('asset/img/walstarLogo.png') }}" style="margin-left: -8%;" height="150" alt="Walstar"   >

                  </div>
              <p class="lead mb-5">1242 E, First Floor, Shahu Soot Kapad Kamgar Sangh, Bagal Chowk, opp. Shahu Mill, Kolhapur, Maharashtra 416008
              </p>
            </div>
          </div>
          <div class="col-7">
            <form action="/Validate-from" method="post">
                @csrf
            <div class="form-group">
              <label for="inputName"> Name</label>
              <input type="text" id="candidate_name" name="candidate_name" placeholder="Enter Full Name" class="form-control" />
            </div>
            @if ($errors->has('candidate_name'))
            <span class="text-danger">{{ $errors->first('candidate_name') }}</span>
        @endif

            <div class="form-group">
              <label for="inputEmail">E-Mail</label>
              <input type="email" id="candidate_email" name="candidate_email" placeholder="Enter Valid Email" class="form-control" />
            </div>
            @if ($errors->has('candidate_email'))
            <span class="text-danger">{{ $errors->first('candidate_email') }}</span>
        @endif


            <div class="form-group">
              <label for="inputSubject">Mobile</label>
              <input type="text" id="candidate_mobile" name="candidate_mobile" placeholder="Enter Current Mobile Number" class="form-control" />
            </div>
            @if ($errors->has('candidate_mobile'))
            <span class="text-danger">{{ $errors->first('candidate_mobile') }}</span>
        @endif



            <div class="form-group" style="margin-top: 10px;">
                <label style="margin-bottom: 10px;">Select Technologies</label>
                <select class="form-control" id="candidate_category" name="candidate_category">
                    <option value="#">Select Your Technologies</option>
                    @php
                        foreach($categoryInfo as $row):
                        @endphp
                        <option class="form-control" value="{{ $row->id }}"> {{ $row->category_name }}</option>
                        @php

                endforeach;
                    @endphp
                </select>
                <br>
              </div>
              @if ($errors->has('candidate_category'))
              <span class="text-danger">{{ $errors->first('candidate_category') }}</span>
          @endif



              <div class="form-group">
                <label for="inputSubject">Your Experienced</label>
                <select class="form-control" id="candidate_level" name="candidate_level">

                    <option value="#">Select Your Experienced</option>
                    <option value="1" class="form-control">0 To 1 Years</option>
                    <option value="2" class="form-control" >2 To 3 Years</option>
                    <option value="3" class="form-control">4 To 5 Years</option>
                    <option value="4" class="form-control">6+ Years</option>

                </select>
              </div>
              @if ($errors->has('candidate_level'))
              <span class="text-danger">{{ $errors->first('candidate_level') }}</span>
          @endif



<br>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Apply To Aptitude">
             {{-- <p> <a href="/Email-validate">If you have already Fill form Click here</a></p> --}}
            </div>
        </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
</body>
</html>
