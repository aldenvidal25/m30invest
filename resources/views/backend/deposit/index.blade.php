@extends('backend.layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ Auth::user()->role }} Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">M30 Investments</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Investments</h4>
                            <!--description here -->
                            <p class="card-title-desc">
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>USER</th>
                                        <th>TRANSACTION ID</th>
                                        <th>AMOUNT</th>
                                        <th>GATEWAY</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($transactdata as $transact)
                                        <tr>
                                            <td>{{ $transact->user->created_at->format('m-d-Y') }}</td>
                                            <td>{{ $transact->user->name }}</td>
                                            <td>{{ $transact->tnx }}</td>
                                            <td>{{ $transact->invest_amount }}</td>
                                            <td>{{ $transact->method }}</td>
                                            <td>
                                                <div class="font-size-13">
                                                    <i
                                                        class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2">{{ $transact->status }}</i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>

    </div>
@endsection
