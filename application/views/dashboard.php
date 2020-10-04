<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/module/datatable/datatables.min.css' ?>">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
    <header>
        <?php $this->load->view('_partial/navbar') ?>
    </header>

    <main>
        <div class="container">
            <h1>Data CSV</h1>
            <h6><?php echo $this->session->flashdata('error')  ?></h6>
            <div class="row">
                <div class="col s12">
                    <a class="waves-effect red lighten-2 waves-light btn" href="<?php echo base_url() . "Page/tambahinput" ?>"><i class="material-icons left">add</i>Tambah Data</a>
                    <br><br>
                    <div class="card-panel white">
                        <table style="width: 100%;" id="table-artikel" class="table table-bordered table-striped">
                            <thead style="background-color: white;">

                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <style>
                                tbody.belang tr:nth-child(even) {
                                    background-color: white;
                                }
                            </style>
                            <div>
                                <tbody class="belang">
                                    <?php $j = 1 ?>

                                    <?php foreach ($input as $i) { ?>
                                        <tr>
                                            <td><?php echo $j; ?></td>
                                            <td><?php echo $i->nama; ?></td>
                                            <td>
                                                <a class="waves-effect yellow lighten-2 waves-light btn-small black-text" href="<?php echo base_url() . "Page/editinput/" . $i->id ?>">Edit</a>
                                                <a class="waves-effect green lighten-2 waves-light btn-small" href="#">Detail</a>
                                                <a class="waves-effect red lighten-2 waves-light btn-small" href="<?php echo base_url() . "Page/delete/" . $i->id ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $j++ ?>
                                    <?php } ?>
                                </tbody>
                            </div>
                            <tfoot style="background-color: white;">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <?php $this->load->view('_partial/footer') ?>
    <!--JavaScript at end of body for optimized loading-->
    <?php $this->load->view('_partial/js') ?>

</body>

</html>