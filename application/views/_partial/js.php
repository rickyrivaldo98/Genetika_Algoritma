<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="<?php echo base_url() . 'assets/module/datatable/datatables.min.js' ?>"></script>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $('#sidenav-1').sidenav({
            edge: 'left'
        });
    });
</script>

<script>
    $(function() {
        $("#example1").DataTable();
        $('#table-artikel').DataTable({
            "paging": true,
            // "pageLength": 10,
            // "ajax":           '/api/data',
            // "scrollY":        500,
            "scrollX": true,
            // "deferRender":    true,
            "scrollCollapse": true,
            // "responsive": true,
            // "lengthMenu": [10],
            "searching": false,

            "info": true,
            "autoWidth": true
        });
    });
</script>