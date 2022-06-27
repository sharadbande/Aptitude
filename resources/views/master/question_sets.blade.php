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
        {{-- <div class="card-header">
          <h3 class="card-title">Add Question Sets</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> --}}
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
          <form action="/Question-Configurastion-Step2" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
                <label for="inputSpentBudget">Category</label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="0">Select From Drop down</option>
                @php
                    foreach ($categoryInfo as $row):
                    @endphp

           <option value="{{ $row->id }}">{{ $row->category_name }}</option>
               @php

                    endforeach;
                @endphp
                 </select>
            </div>


            <div class="form-group">
                <label for="inputSpentBudget">Profession Level</label>
                <select name="profession_level" id="profession_level" class="form-control">
                    <option value="0">Select From Drop down</option>
                    <option value="1">Fresher</option>
                    <option value="2">Intermediater</option>
                    <option value="3">Experienced</option>
                    <option value="4">Experte</option>



                 </select>
            </div>


          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Question Configurastion" class="btn btn-success float-right">
      </div>
    </div>
</form>
  </section>






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
                    <?php $ct=1; foreach ($questionInfo as $row):?>
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
