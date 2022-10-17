<!-- MODAL SIGN OUT -->
<div class="modal fade" id="modal-signout">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-sign-out-alt"></i> Sign Out</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure to sign out?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth/Logout'); ?>'" class="btn btn-sm btn-success">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SIGN OUT -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-block">
        Developer Team
    </div> -->
    <!-- Default to the left -->
    <strong><a href="javascript:void(0)"> PT Betterlife Jaya Indonesia </a>. <i class="fas fa-copyright font-italic ml-2"> <?= date('Y'); ?> JAP</i></strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->

<script src="<?= base_url('assets'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets'); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>



<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap-input-spinner.js"></script>
<!-- Ekko Lightbox -->

<script src="<?= base_url('assets'); ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="<?= base_url('assets'); ?>/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->


<script src="<?= base_url('assets/'); ?>dist/js/sweetalert2.min.js"></script>
<!-- Page specific script -->
<!-- <script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script> -->
<script src="<?= base_url('assets'); ?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets'); ?>/dist/js/pages/dashboard.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<?php if ($title == "My Profile") : ?>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
<?php endif; ?>

<?php if ($title == "Menu") : ?>
    <script>
        $(function() {
            $("#tbmenu").DataTable();
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Sub Menu") : ?>
    <script>
        $(function() {
            $("#tbsubmenu").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "User Roles") : ?>
    <script>
        $(function() {
            $("#tbroles").DataTable();
        });

        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');
            $.ajax({
                url: "<?= base_url('User/ChangeAccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('User/AccessRole/'); ?>" + roleId;
                }
            });
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "User Management") : ?>
    <script>
        $(function() {
            $("#tbuser").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
    <script>
        function confResetPass(link) {
            var result = confirm("Want to reset it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Work Location") : ?>
    <script>
        $(function() {
            $("#tbworklocation").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Organization") : ?>
    <script>
        $(function() {
            $("#tborganization").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Ekspedisi") : ?>
    <script>
        $(function() {
            $("#tbekspedisi").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Chart Of Account") : ?>
    <script>
        $(function() {
            $("#tbcoa").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Supplier") : ?>
    <script>
        $(function() {
            $("#tbsupplier").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Voucher") : ?>
    <script>
        $(function() {
            $("#tbvoucher").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Fintech") : ?>
    <script>
        $(function() {
            $("#tbFintech").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Shipping Proses") : ?>
    <script>
        $(function() {
            $("#tbshipping").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Waiting Purchase Order & Delivery Order Proses") : ?>
    <script>
        $(function() {
            $("#tbWT").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Delivery Proses") : ?>
    <script>
        $(function() {
            $("#tbpickup").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Patner") : ?>
    <script>
        $(function() {
            $("#tbPatner").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "General Setting") : ?>
    <script>
        $(function() {
            $("#tbGeneralSet").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Data Kategori Product") : ?>
    <script>
        $(function() {
            $("#tbkategoriproduct").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "List Data Kontak") : ?>
    <script>
        $(function() {
            $("#tbkontakuser").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "User Activity") : ?>
    <script>
        $(function() {
            $("#tbuseractivity").DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
<?php endif; ?>

<?php if ($title == "List User Registrasi") : ?>
    <script>
        $(function() {
            $("#tbregistercustomer").DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "List User") : ?>
    <script>
        $(function() {
            $("#tblistuser").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "Data Product") : ?>
    <script>
        $(function() {
            $("#tbproduct").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>
<?php endif; ?>

<?php if ($title == "History Transaksi") : ?>
    <script>
        $(function() {
            $("#tbhisorser").DataTable();

        });
    </script>

<?php endif; ?>

<?php if ($title == "List Data Orders") : ?>
    <script>
        $(function() {
            $("#tborserscus").DataTable();

        });
    </script>

<?php endif; ?>

<?php if ($title == "Tenor Setting") : ?>
    <script>
        $(function() {
            $("#tbtnr").DataTable();
            $('.select2').select2()
        });
    </script>
    <script>
        function confDelete(link) {
            var result = confirm("Want to delete it?");
            if (result) window.location.href = link;
        }
    </script>

<?php endif; ?>

<?php if ($title == "Report Data Product") : ?>
    <script>
        $(function() {
            $("#tbrptproduct").DataTable({
                "order": [
                    [5, "asc"]
                ]
            });

        });
    </script>

<?php endif; ?>


<?php if ($title == "Report Data Pengiriman Barang") : ?>
    <script>
        $(function() {
            $("#tbrptshiping").DataTable({
                "order": [
                    [5, "asc"]
                ]
            });

        });
    </script>

<?php endif; ?>

<?php if ($title == "Report Data Transaksi") : ?>
    <script>
        $(function() {
            $("#tbrpttran").DataTable({
                "order": [
                    [0, "asc"]
                ]
            });

        });
    </script>

<?php endif; ?>

<script>




   


    $('.custom-file input').change(function(e) {
        if (e.target.files.length) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        }
    });

    $("#tblistfileuploadbill").DataTable({
        order: [
            [4, 'asc']
        ]
    });
    $("#tblpodoreview_d2").DataTable();
    $("#tblpodoreview_d1").DataTable();
    $("#tblistpodoreq").DataTable();
    $("#tblistpodoreqapv").DataTable();
    $("#tblistpodoapv").DataTable();
    $("#tblistpodo2").DataTable();
    $("#tbinstallmentss").DataTable();
    $("#tbpolistsupplier").DataTable();
    $("#tbhispodo").DataTable();



    $(function() {
        $("input[name='diskon']").click(function() {
            if ($("#diskon1").is(":checked")) {
                $("#diskon_label").show();
            } else {
                $("#diskon_label").hide();
            }
        });
    });








    $(document).ready(function() {
        $('#startdate').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $('#enddate').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $('#dateexpired_diskon').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    });



    function hanyaAngka(event) {
        var hargaproduct = event.which ? event.which : event.keyCode;
        if (
            hargaproduct != 46 &&
            hargaproduct > 31 &&
            (hargaproduct < 48 || hargaproduct > 57)
        )
            return false;
        return true;
    }
    



    function voucherget() {
        var kode_voucher = $("#kode_voucher").val();
        var totalharga = $("#totalharga").val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('Feature/VoucherCheck') ?>",
            dataType: "JSON",
            data: {
                kode_voucher: kode_voucher
            },
            // cache: false,
            success: function(data) {

                if (data == null) {

                    document.getElementById('nominal_voucher').innerHTML = "Voucher Tidak Valid "

                } else {
                    document.getElementById('nominal_voucher').innerHTML = "Voucher : " + rupiah(data);
                    document.getElementById('totalharga').value = totalharga - data;
                    document.getElementById('totalorders').innerHTML = rupiah(totalharga - data);
                    $("#btnbvoucherget").hide();
                    document.getElementById("kode_voucher").readOnly = true;
                    document.getElementById('kode_voucher_post').value = kode_voucher;


                }

            }
        });


    }


    function kalkulasi() {
        var tenor = parseFloat(document.orderscustomer.tenor.value);
        var totalharga = parseFloat(document.orderscustomer.totalharga.value);

        $.ajax({
            type: "POST",
            url: "<?= base_url('Feature/kalkulasi_angsuran') ?>",
            dataType: "JSON",
            data: {
                tenor: tenor,
                totalharga: totalharga
            },
            // cache: false,
            success: function(data) {

                document.getElementById('angsuran').value = Math.round(data);
                document.getElementById('angsuranshow').innerHTML = "Angsuran : " + rupiah(data);
                document.getElementById('infoangsuran').innerHTML = " <i class='fas fa-info-circle'></i>";

            }
        });

    }


    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })



    $("input[name='qtykeranjang']").inputSpinner({buttonsOnly: true, autoInterval: undefined})

    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(Math.round(number));

    }






    function qty_subtotal(id) {


        var qty = $("#qtykeranjang" + id).val();
        var hrgbrg = $("#hrgbrg" + id).val();
        var kodeprd = $("#kodeprd" + id).val();
        var datasubtotal = qty * hrgbrg;

        document.getElementById("datasubtotal" + id).innerHTML = rupiah(datasubtotal);


        $.ajax({
            type: "POST",
            url: "<?= base_url('Feature/Updatekeranjang') ?>",
            dataType: "JSON",
            data: {
                id: id,
                qty: qty,
                hrgbrg: hrgbrg,
                kodeprd: kodeprd,
                datasubtotal: datasubtotal
            },
            // cache: false,
            success: function(data) {


                document.getElementById('totalhargakeranjang').innerHTML = rupiah(data.totalharga);
                $("#totalreq").val(data);
                $("#countcontract").val(data);

            }
        });

    }

    $("[data-toggle=popover]").popover();




    function podoaddoder(event) {

        $(document).on('click', '#addorderspodo', function() {
            var kode_po_do = $(this).data('kode_po_do');
            var kode_parent = $(this).data('kode_parent');
            var price = $(this).data('price');



            $.ajax({
                type: "POST",
                url: "<?= base_url('PurchaseOrder_DeliveryOrder/AddPoDoPermohonanDana') ?>",
                dataType: "JSON",
                data: {
                    kode_po_do: kode_po_do,
                    kode_parent: kode_parent,
                    price: price
                },
                // cache: false,
                success: function(data) {

                    $('#listpodowaiting').modal('hide');




                    location.reload();
                }
            });

        })


    }



    function pododelorder(event) {


        $(document).on('click', '#delorderspodo', function() {
            var id = $(this).data('id');
            var kode_po_do = $(this).data('kode_po_do');



            $.ajax({
                type: "POST",
                url: "<?= base_url('PurchaseOrder_DeliveryOrder/DelPoDoPermohonanDana') ?>",
                dataType: "JSON",
                data: {
                    id: id,
                    kode_po_do: kode_po_do
                },
                // cache: false,
                success: function(data) {

                    location.reload();



                }
            });

        })


    }



    function suppliergetpodo() {
        var id_supplier = $("#podosuppliername").val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('PurchaseOrder_DeliveryOrder/Checksupplierdata') ?>",
            dataType: "JSON",
            data: {
                id_supplier: id_supplier
            },
            // cache: false,
            success: function(data) {


                $("#namakontaksup").val(data.nama_kontak_supplier);
                $("#kontaksup").val(data.kontak_supplier);
                $("#bankaccountsup").val(data.bank_supplier);
                $("#noreksup").val(data.norek_supplier);


            }
        });


    }





    function rejectpodo(event) {

        $(document).on('click', '#rejectpodoreq', function() {
            var kode_po_do = $("#kodepodo").val();
            var noteapv = $("#noteapv").val();



            $.ajax({
                type: "POST",
                url: "<?= base_url('BOD/PostPoDo_Review_Upd_rjt') ?>",
                dataType: "JSON",
                data: {
                    kode_po_do: kode_po_do,
                    noteapv: noteapv
                },
                // cache: false,
                success: function(data) {
                    window.location.href = data.redirect;

                }
            });


        })


    }





    function podoaddodersup(event) {


        $(document).on('click', '#addorderspodosup', function() {
            var kode_po_do = $("#kodepodo").val();
            var kode_parent = $("#podosuppliername").val();
            var price = $("#nominalsup").val();




            $.ajax({
                type: "POST",
                url: "<?= base_url('PurchaseOrder_DeliveryOrder/AddPoDoSupplier') ?>",
                dataType: "JSON",
                data: {
                    kode_po_do: kode_po_do,
                    kode_parent: kode_parent,
                    price: price
                },
                // cache: false,
                success: function(data) {

                    $('#listpodowaiting').modal('hide');




                    location.reload();
                }
            });

        })


    }


 


    function pododelordersup(event) {


        $(document).on('click', '#delorderspodosup', function() {
            var id = $(this).data('id');
            var kode_po_do = $(this).data('kode_po_do');



            $.ajax({
                type: "POST",
                url: "<?= base_url('PurchaseOrder_DeliveryOrder/DelPoDoSupplier') ?>",
                dataType: "JSON",
                data: {
                    id: id,
                    kode_po_do: kode_po_do
                },
                // cache: false,
                success: function(data) {

                    location.reload();



                }
            });

        })


    }
</script>




<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultInfo').click(function() {
            Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultError').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultWarning').click(function() {
            Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultQuestion').click(function() {
            Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.toastrDefaultSuccess').click(function() {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultInfo').click(function() {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultError').click(function() {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultWarning').click(function() {
            toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastsDefaultDefault').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultTopLeft').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'topLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomRight').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomRight',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomLeft').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultAutohide').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                autohide: true,
                delay: 750,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultNotFixed').click(function() {
            $(document).Toasts('create', {
                title: 'Toast Title',
                fixed: false,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultFull').click(function() {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                icon: 'fas fa-envelope fa-lg',
            })
        });
        $('.toastsDefaultFullImage').click(function() {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                image: '../../dist/img/user3-128x128.jpg',
                imageAlt: 'User Picture',
            })
        });
        $('.toastsDefaultSuccess').click(function() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultInfo').click(function() {
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultWarning').click(function() {
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultDanger').click(function() {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultMaroon').click(function() {
            $(document).Toasts('create', {
                class: 'bg-maroon',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
    });





    var ctx = document.getElementById("barchart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 23, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });





    var ctx = document.getElementById("piechart").getContext("2d");
    // tampilan chart
    var piechart = new Chart(ctx, {
        type: 'pie',
        data: {
            // label nama setiap Value
            labels: [
                'Data 1',
                'Data 2',
                'Data 3',
                'Data 4',
                'Data 5'
            ],
            datasets: [{
                // Jumlah Value yang ditampilkan
                data: [60, 60, 60, 80, 100],

                backgroundColor: [
                    'rgba(24, 220, 110, 0.5)',
                    'rgba(111, 80, 10, 0.5)',
                    'rgba(11, 120, 170, 0.5)',
                    'rgba(55, 20, 50, 0.5)',
                    'rgba(99, 230, 90, 0.5)'
                ]
            }],
        }
    });
</script>








</body>

</html>