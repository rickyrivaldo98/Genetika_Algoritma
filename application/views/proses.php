<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/module/datatable/datatables.min.css' ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" />

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>

    </style>

</head>

<body>
    <header>
        <?php $this->load->view('_partial/navbar') ?>
    </header>

    <main>
        <div class="container">
            <h1>Algoritma Genetika</h1>
            <h6><?php echo $this->session->flashdata('error')  ?></h6>
            <div class="row">
                <div class="col s12">
                    <a class="waves-effect red lighten-2 waves-light btn" onclick="history.go(-1);"><i class="material-icons left">chevron_left</i>Back</a>
                    <br><br>

                    <!-- Map -->
                    <div class="row">
                        <div id="map">
                        </div>
                    </div>

                    <div class="row proses">
                        <!-- Form Parameter -->
                        <div class="col s6">
                            <form class="col s12" action="<?php echo site_url('Page/save'); ?>" method="post" enctype="multipart/form-data">
                                <div class="row test">
                                    <h6> Form For mutation rate, crossover rate, population size, max generation</h6>
                                    <br>
                                    <input type="text" name="id" hidden>
                                    <div class="input-field">
                                        <input placeholder="Silahkan isi Mutation Rate disini" name="mr" id="mr" type="text" class="validate">
                                        <label for="mr">Mutation Rate</label>
                                    </div>
                                    <div class="input-field">
                                        <input placeholder="Silahkan isi Crossover Rate disini" name="cr" id="cr" type="text" class="validate">
                                        <label for="cr">Crossover Rate</label>
                                    </div>
                                    <div class="input-field">
                                        <input placeholder="Silahkan isi Population Size disini" name="ps" id="ps" type="text" class="validate">
                                        <label for="mr">Population Size</label>
                                    </div>
                                    <div class="input-field">
                                        <input placeholder="Silahkan isi Max Generation disini" name="mg" id="mg" type="text" class="validate">
                                        <label for="cr">Max Generation</label>
                                    </div>

                                </div>
                                <button class="waves-effect blue lighten-2 waves-light btn right"><i class="material-icons left">check</i>Submit</button>
                            </form>
                        </div>
                        <!-- Log GA -->
                        <div class="col s6">
                            <h6>Log GA</h6>
                            <br><br>
                            <textarea name="log" id="log" style="resize:none;height: 300px;"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>


    <?php $this->load->view('_partial/footer') ?>
    <!--JavaScript at end of body for optimized loading-->
    <?php $this->load->view('_partial/js') ?>

</body>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYW5nZ2FkaGFybWE2MCIsImEiOiJja2Z3aWs1cGswY2p2MnFub3k3anZjaHRvIn0.1rstxyC5mH5Qfrpv92UAtg';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
        center: [110.42142, -7.0556], // starting position [lng, lat]
        zoom: 15 // starting zoom
    });
</script>

</html>