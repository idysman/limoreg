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
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    @yield('pageScripts')

</body>
</html>