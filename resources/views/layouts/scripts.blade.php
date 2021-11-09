{{-- Footer blade --}}
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset("assets/js/jquery-3.1.1.min.js") }}"></script>
    <script src="{{ asset("assets/js/popper.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("assets/js/perfect-scrollbar.min.js") }}"></script>
    <script src="{{ asset("assets/js/app.js") }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });


    </script>
    <script src="{{ asset("assets/js/custom.js") }}"></script>
    
    <script src="{{ asset("assets/js/sweetalert2.min.js") }}"></script>
    <script src="{{ asset("assets/js/custom-sweetalert.js") }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script>
        @if (session("success"))
            swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                type: 'success',
                showCloseButton: true,
                @if (session('link'))
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:"{{ session('link_text') }}",
                    confirmButtonAriaLabel: 'Generate Invoice!',
                    cancelButtonText:'Close',
                    cancelButtonAriaLabel: 'Close Button',
                @endif
                padding: '2em',
            }).then(function(result) {
                if (result.value) {
                  window.location = "{{ session('link') }}" 
                }
            })
        @endif

        @if (session("error"))
            swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                type: 'error',
                padding: '2em'
            })
        @endif


        // $('.dropdown-item .warning.confirm').on('click', function (e) {
        //     e.preventDefault();
        //     swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Delete',
        //         padding: '2em'
        //     }).then(function(result) {
        //         if (result.value) {
        //             swal(
        //             'Deleted!',
        //             'Your file has been deleted.',
        //             'success'
        //             )
        //         }
        //     });
        // })

    </script>

    @yield('pageScripts')
    
    @livewireScripts
</body>
</html>