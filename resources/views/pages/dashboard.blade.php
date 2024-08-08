@extends('layouts.admin-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            @include('pages.includes.side-nav')
        </div>
    </aside>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>1</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('user.product.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
@endsection
@push('scripts')
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
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
                        var row = datatable.rows($(this).parents('tr'));
                        var url = $(this).data('href');
                        App.deleteItem(row, url);
                    })
                },
                deleteItem: function(row, url) {
                    if (confirm('Are you sure you want to remove this categories?')) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            success: function(data) {
                                row.remove().draw();
                                toastr.success(data.success);
                            }
                        });
                    }
                }

            };
            App.initialize();
        })
    </script>
@endpush
