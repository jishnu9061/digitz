@extends('layouts.admin-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tasks</h3>
                    <a href="{{ route('user.tasks.create') }}" class="btn btn-primary" style="float: right">Create</a>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="d-none"></th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="d-none">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $task->title }}</td>
                                    <td class="text-center">{{ $task->description }}</td>
                                    <td class="text-center">{{ $task->status }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <!-- Edit and Delete buttons -->
                                            <a href="{{ route('user.tasks.edit', $task->id) }}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a data-href="{{ route('user.tasks.destroy', $task->id) }}" class="btn btn-danger delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                            <!-- Mark as Completed button -->
                                            @if($task->status !== 'completed')
                                                <form action="{{ route('user.tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success" title="Mark as Completed"><i class="fas fa-check"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function() {
            var App = {
                initialize: function() {
                    var datatable = $('#dataTable1').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "order": [
                            [0, "asc"]
                        ]
                    });

                    $('#dataTable1').on('click', '.delete', function(e) {
                        e.preventDefault();
                        var row = datatable.row($(this).closest('tr'));
                        var url = $(this).data('href');
                        App.deleteItem(row, url);
                    });
                },
                deleteItem: function(row, url) {
                    if (confirm('Are you sure you want to remove this task?')) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            success: function() {
                                row.remove().draw();
                                toastr.success('Task deleted successfully.');
                            },
                            error: function() {
                                toastr.error('Failed to delete the task.');
                            }
                        });
                    }
                }
            };

            App.initialize();
        });
    </script>
@endpush
