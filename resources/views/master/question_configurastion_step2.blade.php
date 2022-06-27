@extends('layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Question Set</h1>
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

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        @php
      $cat_id=Session::get('cat_id'); echo "<br>";
       $profession_level=Session::get('profession_level');


       if(empty($cat_id)){
            return redirect("Question-Set")->with('error-message', 'ohh! Please Select Category first ');
          }
          if(empty($profession_level)){
            return redirect("Question-Set")->with('error-message', 'ohh! Please Select Profession Level first ');
          }

          $cat_id_session=  DB::table('category')->where('id',"=", $cat_id)->first();
          if($profession_level == 1){
                    $profession_level_name =  "Fresher";
                }elseif($profession_level == 2){
                    $profession_level_name =  "Intermediater";
                }elseif($profession_level == 3){
                    $profession_level_name =  "Experienced";
                }elseif($profession_level == 4){
                    $profession_level_name =  "Experte";
                }
      @endphp


        <div class="card-body">




 <!-- Main content -->
 <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Question Configurastion</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            <div class="form-group">
                <label for="inputSpentBudget">Category</label>
                 <input type="text" class="form-control" readonly="" name="cat_id" value="{{ $cat_id_session->category_name; }}"  >
            </div>


            <div class="form-group">
                <label for="inputSpentBudget">Profession Level</label>
                <input type="text" class="form-control"  readonly="" name="profession_level" value="{{ $profession_level_name }}">
            </div>
             <input type="submit" value="Question Configurastion"  data-toggle="modal" data-target="#addquestion" onclick="resetform()" class="btn btn-success float-left">


          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
    <div class="row">
      <div class="col-12">
        {{-- <a href="#" class="btn btn-secondary">Cancel</a> --}}
        <input type="submit" onclick="goback()" value="Reset" class="btn btn-success float-right">
      </div>
    </div>

  </section>


  <div id="addquestion" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; </button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    {{-- <form action="{{ route('category.post') }}" method="POST"> --}}
                    <form action="#" method="POST" id="addquestionform">
                        @csrf
                        <div class="modal-body">


                            <div class="form-group">
                                <label for="inputSpentBudget"> <span style="color: #007bff">Category:</span> {{ $cat_id_session->category_name; }} <span style="color: #007bff">Profession Level:</span>    {{ $profession_level_name }}</label>
                            </div>
                            <div class="form-group">
                                <label for="inputSpentBudget">Question</label>
                                <input type="text" id="question" name="question" placeholder="Question name"
                                    class="form-control">

                              {{-- Hidden feilds --}}
                                    <input type="hidden" id="FromAction" name="FromAction" >
                            <input type="hidden" id="cat_id" name="cat_id" value="{{ $cat_id }}">
                            <input type="hidden" id="profession_id" name="profession_id" value="{{ $profession_level }}">


                            </div>
                            @if ($errors->has('question'))
                           <span class="text-danger">{{ $errors->first('question') }}</span>
                        @endif

                        <div class="form-group">
                            <label for="inputSpentBudget">Option A</label>
                            <input type="text" id="option1" name="option1" placeholder="Option 1"
                                class="form-control">
                            </div>

                        <div class="form-group">
                            <label for="inputSpentBudget">Option B</label>
                            <input type="text" id="option2" name="option2" placeholder="Option 2"
                                class="form-control">
                            </div>
                        <div class="form-group">
                            <label for="inputSpentBudget">Option C</label>
                            <input type="text" id="option3" name="option3" placeholder="Option 3"
                                class="form-control">
                             </div>
                        <div class="form-group">
                            <label for="inputSpentBudget">Option D</label>
                            <input type="text" id="option4" name="option4" placeholder="Option 4"
                                class="form-control">


                        </div>


                        <div class="form-group">
                            <label for="inputSpentBudget">Answer</label>
                            <input type="text" id="answer" name="answer" placeholder="Correct Answer "
                                class="form-control">


                        </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="saveButton" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>






        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->





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
                        <th>Question</th>
                        <th>Option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ct=1; foreach ($question_info as $row):?>
                    <tr>
                        <td>{{ $ct }}</td>
                        <td> {{ $row->question }} </td>
                        <td> {{ $row->option1 }} </td>
                        <td> {{ $row->option2 }} </td>
                        <td> {{ $row->option3 }} </td>
                        <td> {{ $row->option4 }} </td>
                        <td> <button type="button" class="btn btn-primary" onclick="editproject('{{$row->id}}')">Edit</button>
                            <button type="button" onclick="del('{{$row->id}}')"    class="btn btn-danger">Delete</button> </td>
                    </tr>
                    <?php $ct++; endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr. No</th>
                        <th>Question</th>
                        <th>Option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Action</th>
                    </tr>

                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
