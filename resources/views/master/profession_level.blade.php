@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category </h1>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">

                        <input type="button" data-toggle="modal" data-target="#Category" onclick="resetform()" value="Add Category"
                            class="btn btn-success float-right">
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <div id="Category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; </button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    {{-- <form action="{{ route('category.post') }}" method="POST"> --}}
                    <form action="#" method="POST" id="addcategory">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputSpentBudget">Category</label>
                                <input type="text" id="category_name" name="category_name" placeholder="Category name"
                                    class="form-control">
                                <input type="hidden" id="FromAction" name="FromAction" >
                                <input type="hidden" name="cat_id" id="cat_id">
                            </div>

                            @if ($errors->has('category_name'))
                            <span class="text-danger">{{ $errors->first('category_name') }}</span>
                        @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="saveButton" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $ct=1; foreach ($category_info as $row):?>
                    <tr>
                        <td>{{ $ct }}</td>
                        <td> {{ $row->category_name }} </td>
                        <td> <button type="button" class="btn btn-primary" onclick="editproject('{{$row->id}}')">Edit</button>
                            <button type="button" onclick="del('{{$row->id}}')"    class="btn btn-danger">Delete</button> </td>
                    </tr>
                    <?php $ct++; endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr. No</th>
                        <th>Category</th>
                        <th>Action</th>

                    </tr>

                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    </div>
@endsection


<!-- /.content -->
