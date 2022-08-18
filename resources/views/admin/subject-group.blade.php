@extends('admin.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
          $(document).ready(function() {

            $('.delete-subject-group').on('submit', function(e) {
              e.preventDefault();
              var button = $(this);

              Swal.fire({
                icon: 'warning',
                  title: 'Are you sure you want to delete this subject group?',
                  showDenyButton: false,
                  showCancelButton: true,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: button.data('route'),
                    data: {
                      '_method': 'delete'
                    },
                    success: function (response, textStatus, xhr) {
                      Swal.fire({
                        icon: 'success',
                          title: response,
                          showDenyButton: false,
                          showCancelButton: false,
                          confirmButtonText: 'Yes'
                      }).then((result) => {
                        window.location='/admin/subject-group'
                      });
                    }
                  });
                }
              });

            })
          });
        </script>
@section('contents')


<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subject List</h3>
              <a href="" class="btn bg-maroon btn-flat margin" style="float:right" data-toggle="modal" data-target="#modalc">
             Add Subject Group</a>
        </div>
         @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>{{ $errors }}</p>
                    </div>
         @endif
        <div class="modal fade" id="modalc">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Subject Group</h4>
              </div>
              <div class="modal-body">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif --}}
               <form role="form" method="POST" action="{{ route('group-submit') }}">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Enter Group Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Group Name">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Class</label><br>
                  <select class="form-control" name="class">
                    <option value="">Choose Class</option>
                    @foreach ($sets as $set)
                    <option value="{{ $set->class_name }}">{{ $set->class_name }}</option>
                    @endforeach
                  </select>
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Section</label><br>
                    @foreach ($sections as $section)
                    <input type="checkbox" name="section[]" value="{{ $section->section }}">
                    &nbsp;{{ $section->section }}&nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label><br>
                    @foreach ($subjects as $subject)
                    <input type="checkbox" name="subject[]" value="{{ $subject->subject_name }}">
                    &nbsp;{{ $subject->subject_name }}&nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Enter Description</label>
                  <textarea class="form-control" name="desc" rows="3"></textarea>

                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
              <div class="modal-footer">

                 <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Sub Group Name</th>
                  <th>Class Section</th>
                  <th>Subject</th>
                  <th>Desc</th>
                  <th>Edit</th>
                  <th>Delete</th>

                </tr>
                </thead>
                <tbody>

                    @foreach ($subjectGroups as $key => $subjectGroup)

                        <tr>
                        <td> {{ $key + 1 }}</td>
                        <td>{{ $subjectGroup->name }}</td>
                        <td>{{ $subjectGroup->class }}</td>
                        {{-- <td>{{ $subjectGroup->section }}</td> --}}
                        <td>{{ $subjectGroup->subject }}</td>
                        <td>{{ $subjectGroup->desc }}</td>
                        <td>
                            <a class="btn bg-purple btn-flat margin" data-toggle="modal"
                             data-target="#modalu{{ $subjectGroup->id }}">
                                <i class="fa fa-edit"></i></a>
                            </td>
                        <td>
                     <form class="delete-subject-group" data-route="{{ route('delete-subjectGroup', $subjectGroup->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn bg-orange btn-flat margin" type="submit">
                            <i class="fa fa-trash"></i></button>
                        </form>
                        {{-- <button class="btn bg-orange btn-flat margin"
                         onclick="deleteConfirmation({{ $class_list->id }})"><i class="fa fa-trash"></i></button> --}}
                            </td>
                        </tr>

                        <div class="modal fade" id="modalu{{ $subjectGroup->id }}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Update Subject</h4>
                            </div>
                        <div class="modal-body">
                           <form role="form" method="POST" action="">
                                @csrf
                                <div class="box-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Update Subject</label>
                                <input type="text" name="subject_name" class="form-control" value="{{ $subjectGroup->subject_name }}">

                                </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Update Subject Type</label><br>
                                <input type="radio" name="subject_type" value="Theory">&nbsp;Theory
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="subject_type" value="Practical">&nbsp;Practical
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Update Subject Code</label>
                                <input type="text" name="subject_code" class="form-control" value="">
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                    </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    </div>

                    @endforeach

                </tbody>

              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>



@endsection
