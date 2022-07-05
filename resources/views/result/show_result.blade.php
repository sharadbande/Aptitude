@extends('layouts.master');
@section('content');
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Result</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Add Question</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


<section class="content">

    <!-- Default box -->

        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title">DataTable with default features</h3> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Technologies</th>
                            <th>Experienced Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ct=1; foreach ($result_Info as $row):?>
                        <tr>
                            <td>{{ $ct }}</td>
                            <td>{{ $row->candidate_name  }}</td>
                            <td> {{ $row->candidate_email }} </td>
                            <td> {{ $row->category_name }} </td>
                            {{-- <td> {{ if($row->candidate_level == 1) { echo "Fresher"; } elseif($row->candidate_level == 2) { echo "Intermediater";}
                                elseif($row->candidate_level == 3) { echo "Experienced"; } elseif ($row->candidate_level == 4) { echo "Experte"; }
                            }} </td> --}}

                            <td> @if ($row->candidate_level == 1) <p>Fresher</p>
                                @elseif ($row->candidate_level == 2) <p>Intermediater</p>
                                @elseif ($row->candidate_level == 3) <p>Experienced</p>
                                @elseif ($row->candidate_level == 4) <p>Experte</p>
                            @endif   </td>
                  <td>   <button type="button" id="sb"   onclick="resultAjax('{{$row->candidate_email}}')"   class="btn btn-info center btn-lg" > <i class="fas fa-eye" ></i> </button>             </td>
                        </tr>
                        <?php $ct++; endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr. No</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Technologies</th>
                            <th>Experienced Level</th>
                            <th>Action</th>
                        </tr>

                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

       <!-- Modal -->
<div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="result">Result</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>

        </div>
        <div class="modal-body">

            Candidate Email:  <span id="candidate_email"> </span>
            Submited Qustion :  <span class="modal-title" id="question_count"> </span><br>
            Correct Answer :  <span class="modal-title" id="correct_answer" > </span><br>
            percentage :  <span class="modal-title" id="total_percentage" > </span>

     @php


     @endphp
        </div>

<input type="hidden" name="candidate_email_sess" id="candidate_email_sess" >
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" id="email-btn" data-myval=''><i class="fa fa-download" aria-hidden="true"></i> Download</button>
        </div>
      </div>
    </div>
  </div>


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</div>
@endsection
