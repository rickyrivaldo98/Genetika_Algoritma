<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/module/datatable/datatables.min.css' ?>">

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        #map {

            width: 100%;
            height: 800px;
        }
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

                    <!-- Map -->
                    <div class="row">
                        <div id="map">
                        </div>
                    </div>

                    <!-- Form Parameter -->
                    <div class="row">
                        <form id="parameter" name="parameter" action="">
                            for untuk mutation rate, crossover rate, population size, max generation
                        </form>
                    </div>



                    <!-- Log GA -->
                    <div class="row">
                        <textarea name="log" id="log" style="resize:none;height: 300px;"></textarea>
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