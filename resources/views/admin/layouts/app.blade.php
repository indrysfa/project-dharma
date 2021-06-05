<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="https://github.com/indrysfa">
    <meta name="author" content="Indry Sefviana">

    <title>@yield('title')</title>

    {{-- Datatables --}}
    <link href="{{ asset('assets/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sb-admin2/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.layouts.topbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rina Ristiawati 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Datatables --}}
    <script src="{{ asset('assets/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

    </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sb-admin2/js/sb-admin-2.min.js') }}"></script>

    {{-- Sweetalert2 --}}
    <script src="{{ asset('assets/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2.min.css') }}">
    <script>
        // function confirmDelete(item_id) {
        //     Swal.fire({
        //             title: 'Apakah Anda Yakin?',
        //             text: "Anda Tidak Akan Dapat Mengembalikannya!",
        //             type: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, delete it!'
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 $('#' + item_id).submit();
        //             } else {
        //                 swal("Cancelled Successfully");
        //             }
        //         });
        // }

    </script>

</body>

</html>
