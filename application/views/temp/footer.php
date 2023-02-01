
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
    <!-- END: Footer-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
    <script src="<?= base_url() ?>assets/js/scripts/datatables/datatable.js"></script>

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url() ?>assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.noConflict();
            $('#table-pricelist').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url' : 'get_data_pricelist',
                },
                'columns': [
                    // { data: 'nomor' },
                    { data: 'maskapai_id' },
                    { data: 'origin' },
                    { data: 'destinasi' },
                    { data: 'all_in' },
                    { data: 'action' },
                ]
            });     
            $('#table-booking').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url' : 'booking/get_data_booking',
                },
                'columns': [
                    // { data: 'nomor' },
                    { data: 'origin' },
                    { data: 'destinasi' },
                    { data: 'price' },
                    { data: 'weight' },
                    { data: 'total' },
                    { data: 'tanggal' },
                    { data: 'action' },
                ]
            });     

        });
 
    </script>

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="<?= base_url() ?>assets/vendors/js/charts/apexcharts.min.js"></script> -->
    <script src="<?= base_url() ?>assets/vendors/js/extensions/tether.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/vendors/js/extensions/shepherd.min.js"></script> -->
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="<?= base_url() ?>assets/js/core/app-menu.js"></script>
    <script src="<?= base_url() ?>assets/js/core/app.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url() ?>assets/js/scripts/pages/dashboard-analytics.js"></script>
    <!-- END: Page JS-->
    <script src="<?= base_url()?>assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?= base_url()?>assets/js/scripts/forms/select/form-select2.js"></script>

    <script src="<?= base_url() ?>assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts/extensions/sweet-alerts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>

    <script src="<?= base_url() ?>assets/js/scripts/charts/chart-apex.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</body>
<!-- END: Body-->

</html>