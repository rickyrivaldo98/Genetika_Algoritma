<nav>
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="#" class="brand-logo " style="padding-left: 30px;">Tugas Besar Algoritma Evolusioner</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo base_url() . 'Auth/logout' ?>">Logout</a></li>
            </ul>
            <a href="#" data-target="sidenav-1" class="left sidenav-trigger hide-on-medium-and-up"><i class="material-icons">menu</i></a>
        </div>
    </div>
</nav>
<ul class="sidenav sidenav-fixed" id="sidenav-1">
    <li>
        <div class="user-view">
            <div class="background">
            </div>
            <a href="#user"><img class="circle" src="<?php echo base_url() . 'assets/img/avatar1.jpg'  ?>"></a>
            <h6>Selamat Datang</h6>
            <a href="#name"><span class="black-text name"><?php echo $this->session->userdata('name'); ?></span></a>
        </div>
    </li>
    <!-- <li><a href="#!"><i class="material-icons">person</i>Profil</a></li> -->
    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Menu</a></li>
    <li><a class="waves-effect" href="<?php echo base_url() . 'Page'  ?>"><i class="material-icons">home</i>Home</a></li>
    <!-- <li><a class="waves-effect" href="#!"><i class="material-icons">people</i>User</a></li> -->
</ul>
<!-- <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->