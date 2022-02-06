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
            
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">Ubah Data Barang</h2>
                    <div class="card shadow mb-12">
                            <div class="card-body">

                            <?php

                                include "koneksi.php";
                                
                                if(isset($_POST['btnSimpan'])) {
            
                                    $nama_barang  = $_POST['nama_barang']; 
                                    $harga_barang = $_POST['harga_barang']; 
                                    $stok_barang  = $_POST['stok_barang'];  

                                     // Ambil Data Foto 
                                    $nama_file    = $_FILES['foto_barang']['name'];
                                    $ukuran_file  = $_FILES['foto_barang']['size'];
                                    $tipe_file    = $_FILES['foto_barang']['type'];
                                    $tmp_file     = $_FILES['foto_barang']['tmp_name'];
                                    // Set path folder tempat menyimpan gambarnya
                                    $path         = "gambar_brg/"."fotobrg.".date('His', time()).".png"; 
                                    

                                    if(!empty($tmp_file)){ // jika upload foto

                                        $sql   ="SELECT * FROM tb_barang WHERE kode_barang='$_GET[id]'";
                                        $hasil = mysqli_query($conn, $sql);
                                        $row   = mysqli_fetch_array($hasil);
                        
                                        unlink("gambar_brg/".$row['foto_barang']);  

                                        move_uploaded_file($tmp_file, $path); 
                                        $foto_barang  = "fotobrg.".date('His', time()).".png"; 
                                        $sql = "UPDATE tb_barang SET nama_barang='$nama_barang', harga_barang='$harga_barang', stok_barang='$stok_barang', foto_barang='$foto_barang' WHERE kode_barang='$_GET[id]'";
                                    }else {
                                        $sql = "UPDATE tb_barang SET nama_barang='$nama_barang', harga_barang='$harga_barang', stok_barang='$stok_barang'  WHERE kode_barang='$_GET[id]'";
                                    }

                                   
                                        $qryInsert = mysqli_query($conn, $sql);

                                        if($qryInsert){
                                            ?>
                                            <script>
                                                alert("Berhasil Ubah Data");
                                            </script>
                                            <?php
                                            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
                                        }else {
                                            ?>
                                            <script>
                                                alert("Gagal Ubah Data");
                                            </script>
                                            <?php
                                            echo "<meta http-equiv='refresh' content='0; url=ubahbarang.php'>";
                                        } 

                                }

                                    //menampilan data
                                    $sql   ="SELECT * FROM tb_barang WHERE kode_barang ='$_GET[id]'";
                                    $hasil = mysqli_query($conn, $sql);
                                    $row   = mysqli_fetch_array($hasil);

                                ?>
                             
                                <div class="table-responsive">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="card">
                                        <div class="card-body text-dark">

                                            <div class="form-group col-md-12">
                                                <label>Nama Barang:</label>
                                                <input type="text" class="form-control" value="<?php echo $row['nama_barang'];?>" placeholder="Nama Barang" name="nama_barang" required="">
                                            </div>
                                           

                                            <div class="form-group col-md-12">
                                                <label>Harga Barang :</label>
                                                <input type="number" class="form-control" value="<?php echo $row['harga_barang'];?>" placeholder="Harga Barang" name="harga_barang" required="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Stok Barang :</label>
                                                <input type="number" class="form-control" placeholder="Stok Barang" value="<?php echo $row['stok_barang'];?>" name="stok_barang" required="">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Foto Barang :</label><br>
                                                <?php echo "<img src='gambar_brg/".$row['foto_barang']."' width='70px' height='70px'/>"; ?><br>
                                                <label>*Jika tidak Merubah Foto Barang, kosongkan saja</label><br>
                                                <input type="file" class="form-control" placeholder="Foto Barang" name="foto_barang" required="">
                                            </div>
 
                                            <br>
                                            <input type="submit" class="btn btn-success btn-sm" value="Simpan" name="btnSimpan"> 
                                            <a href="index.php" class="btn btn-primary btn-sm">Kembali</a>
                                        </div>
                                    </div>   
                                </form>  
                                </div>
                            </div>
                        </div>  

                   
	  
                    
                </div>
            </section>
            <hr class="m-0" />
            
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
