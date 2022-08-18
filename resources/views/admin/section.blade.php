@extends('admin.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
          $(document).ready(function() {

            $('.delete-section').on('submit', function(e) {
              e.preventDefault();
              var button = $(this);

              Swal.fire({
                icon: 'warning',
                  title: 'Are you sure you want to delete this section?',
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
                        window.location='/admin/section'
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
              <h3 class="box-title">Section List</h3>
              <a href="" class="btn bg-maroon btn-flat margin" style="float:right" data-toggle="modal" data-target="#modalc">
             Add Section </a>
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
                <h4 class="modal-title">Add Section</h4>
              </div>
              <div class="modal-body">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif --}}
               <form role="form" method="POST" action="{{ route('section-submit') }}">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Enter Section</label>
                  <input type="text" name="section" class="form-control" placeholder="Enter Section">
                  {{-- @if ($errors->any())
                    <div class="alert alert-danger">

                            <p>{{ $errors }}</p>

                    </div>
                  @endif --}}
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
                  <th>Section</th>
                  <th>Edit</th>
                  <th>Delete</th>

                </tr>
                </thead>
                <tbody>

                    @foreach ($section as $key => $sec)

                        <tr>
                        <td> {{ $key + 1 }}</td>
                        <td>{{ $sec->section }}</td>
                        <td>
                            <a class="btn bg-purple btn-flat margin" data-toggle="modal"
                             data-target="#modalu{{ $sec->id }}">
                                <i class="fa fa-edit"></i></a>
                            </td>
                        <td>
                     <form class="delete-section" data-route="{{ route('delete-section', $sec->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn bg-orange btn-flat margin" type="submit">
                            <i class="fa fa-trash"></i></button>
                        </form>
                        {{-- <button class="btn bg-orange btn-flat margin"
                         onclick="deleteConfirmation({{ $class_list->id }})"><i class="fa fa-trash"></i></button> --}}
                            </td>
                        </tr>

                        <div class="modal fade" id="modalu{{ $sec->id }}">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Update Section</h4>
                            </div>
                        <div class="modal-body">
                           <form role="form" method="POST" action="{{ route('section-update', $sec->id) }}">
                                @csrf
                                <div class="box-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Update Section</label>
                                <input type="text" name="section" class="form-control" value="{{ $sec->section }}">

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
