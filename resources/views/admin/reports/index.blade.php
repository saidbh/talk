@extends('admin.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title w-100">
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                        <h4 class="card-title m-0">Liste des utilisateurs</h4>
                                        <div class="d-flex flex-row">
{{--                                             <a href="#" class="btn mx-1 btn-success" data-toggle="modal" data-target="#adduser">Ajouter</a>
 --}}                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                                <table id="reports-table" class="table table-sm table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Genre</th>
                                        <th>Date naissance</th>
                                        <th>Adresse</th>
                                        <th>City</th>
                                        <th>Region</th>
                                        <th>Code postal</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style rel="stylesheet">

        .custom-select {
            width: auto;
            display: inline-block;
            padding: 0 5px;
            height: 20px;
            line-height: 20px;
        }

        .dropdown-menu .inner ul li {
            position: relative;
            font-size: 14px;
            height: 30px;
            display: flex;
            align-items: center;
            padding: 0 10px;
        }

    </style>

    <script>
        $(document).ready(function() {
            $('#reports-table').DataTable({
                "columnDefs": [{
                    "targets": 9,
                    "orderable": false
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
            $('#gender').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            });
        });
    </script>
@endsection
