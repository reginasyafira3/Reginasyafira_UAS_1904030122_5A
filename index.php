<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Toko Regina Pulau Seribu</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Clarence Taylor</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/kue-basah.jpeg" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Data Barang</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Komentar</a></li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        Toko Regina 
                        <span class="text-primary">Pulau Seribu</span>
                    </h1>
                    <div class="subheading mb-5">
                    Jl. Bugenvil, RT001/RW002, Kec. Kepulauan Seribu, Kab. Kepulauan Seribu Selatan, Provinsi DKI Jakarta 14510·
                        
                    </div>
                    <p class="lead mb-5">Kami menjual pastel, lempar, risol, kue talam, bika ambon, klepon, kue pandan, pukis, kue lumpur, putu ayu, dadar gulung, wajik, bikang, cucur.</p>
                    <div class="social-icons">
                        <a class="social-icon" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">Data Barang</h2>
                    <div class="card shadow mb-12">
                            <div class="card-body">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><a href="tambahbarang.php" class="btn btn-primary">Tambah Data</a></h6>
                            </div>
                            <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Barang</th>
                                                <th>Stok Barang</th>
                                                <th>Foto Barang</th>
                                                <th>Aksi</th> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            include "koneksi.php";

                                            $sql   ="SELECT * FROM tb_barang ";
                                            $hasil = mysqli_query($conn, $sql);

                                            $no=1; // deklarasi variable nomor otomatis
                                            while ($data = mysqli_fetch_array($hasil)){
                                            ?>

                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['nama_barang'];?></td>
                                                <td><?php echo $data['harga_barang'];?></td>
                                                <td><?php echo $data['stok_barang'];?></td> 
                                                <td><?php echo "<img src='gambar_brg/".$data['foto_barang']."' width='70px' height='70px'/>"; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="ubahbarang.php?id=<?php echo $data['kode_barang']; ?>" data-toggle="tooltip" title="Detail" class="btn btn-link btn-warning" data-original-title="Detail"><i class="fa fa-edit"></i></a>&nbsp;
                                                        <a href="javascript:confirmDelete('index.php?id=<?php echo $data['kode_barang']; ?>&aksi=hapus')" data-toggle="tooltip" title="" class="btn btn-link btn-warning" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  

                    <!-- Coding Hapus -->
	  <script>
        function confirmDelete(delUrl) {
          if (confirm("Yakin Akan Hapus Data ?")) {
           document.location = delUrl;
          }
        }
      </script>

        <?php
        
        	$aksi = $_GET['aksi'];
            if($aksi =='hapus'){     

            	$idnya = $_GET['id'];   
                
                //menampilan data
                $sql   ="SELECT * FROM tb_barang WHERE kode_barang ='$idnya'";
                $hasil = mysqli_query($conn, $sql);
                $row   = mysqli_fetch_array($hasil);

                unlink("gambar_brg/".$row['foto_barang']);  

                $sql = "DELETE FROM tb_barang WHERE kode_barang ='$idnya'";
                $qryDelete = mysqli_query($conn, $sql);

                if ($qryDelete){
                	?>
                    <script type="text/javascript">
                            alert("Data sukses dihapus");
                            window.location.href = "index.php";
                    </script>
                	<?php                    
                }else {
                	?>
                    <script type="text/javascript">
                            alert("Data Gagal dihapus");
                            window.location.href = "index.php";
                    </script>
                	<?php 
                }
               
            }
        ?>
                    
                </div>
            </section>
            <hr class="m-0" />
            <!-- Education-->
            <section class="resume-section" id="education">
                <div class="resume-section-content">
                    <h2 class="mb-5">Komentar</h2>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="tambahkomentar.php" class="btn btn-primary">Isi Komentar</a></h6>
                    </div>
                    <?php
                    include "koneksi.php";

                    $sql   ="SELECT * FROM tb_komentar ";
                    $hasil = mysqli_query($conn, $sql);

                    $no=1; // deklarasi variable nomor otomatis
                    while ($data = mysqli_fetch_array($hasil)){
                    ?>

                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0"><?php echo $data['nama_pengunjung'];?></h3> 
                            <div><?php echo $data['komentar'];?></div> 
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary"><?php echo date("d F Y", strtotime($data['tanggal']));?></span></div>
                    </div>
                    <?php } ?>
                </div>
            </section>
            <hr class="m-0" />
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="vendor/js/demo/datatables-demo.js"></script>

    </body>
</html>
