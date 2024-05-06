<?php include "fungsi/fungsi.php"; 
                /* 
                -- keterangan Masing Masing Fungsi yang dipake dari Library gmp --

                gmp_div_qr = Bagi;
                gmp_add    = Tambah;
                gmp_mul    = Kali;
                gmp_sub    = Kurang;
                gmp_gcd    = Menghitung Nilai phi;
                gmp_strval = Convert Nomer ke String;

                */

                // Inisialisasi P = 113 & Q = 157 (Masing Masing adalah Bilangan Prima) <--- Lebih Besar Lebih Bagus
                // Menghitung N = P*Q
                $n = gmp_mul(113, 157);
                $valn = gmp_strval($n);

                // Menghitung Nilai M =(p-1)*(q-1)
                $m = gmp_mul(gmp_sub(113, 1),gmp_sub(157, 1));
                
                // Mencari E (Kunci Public --> (e,n))
                // Inisialisasi E = 5
                // Membuktikan E = FPB (Faktor Persekutuan Terbesar) dari E dan M = 1
                for($e = 5; $e < 1000; $e++){  // Mencoba dengan Perulangan 1000 Kali 
                    $fpb = gmp_gcd($e, $m);
                    if(gmp_strval($fpb)=='1') // Jika Benar E adalah FPB dari E dan M = 1 <-- Hentikan Proses
                    break;
                }

                // Menghitung D (Kunci Private --> (d,n))
                // D = (($m * $i) + 1) / e = $key[1] <-- Perulangan Do While
                $i=1;
                do {      
                    $key = gmp_div_qr(gmp_add(gmp_mul($m,$i),1), $e);
                    $i++;
                    if($i==1000) // Dengan Perulangan 1000 Kali
                        break;
                } 
                // Sampai $key[1]=0
                while(gmp_strval($key[1])!='0');
                // Hasil D = $key[0] 
                $d = $key[0];
                $vald =gmp_strval($d); 


                // Jika Button Enkripsi ditekan
                if ((isset($_POST['enkrip'])) && (!empty($_POST['plain']))){
                $plain = $_POST['plain']; 
                $hasilenkripsi = enkripsi($plain, $n, $e);
                } else {
                $hasilenkripsi = 'Maaf, Sepertinya Plain Teks Masih Kosong';
                }

                // Jika Button Deskripsi ditekan
                if ((isset($_POST['dekrip'])) && (!empty($_POST['chiper'])) && ($_POST['chiper'] != 'Ups, Sepertinya Plain Teks Masih Kosong')){
                $chiper = $_POST['chiper'];
                $hasildeskripsi = deskripsi($chiper, $d, $n);
                } else {
                $hasildeskripsi[0] = 'Null';
                $hasildeskripsi[1] = 'Maaf, Anda Harus Melakukan Proses Enkripsi Terlebih Dahulu';
                }
                ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- My CSS -->
    <style>
      section{
        min-height: 610px;
        font-family: Arial, san-serif;
      }

      .navbar-brand {
        text-transform: uppercase;
      }
    </style>

    <title>Tugas Keamanan Digital</title>
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" style="background-color : #8FBC8F">
      <div class="container">
      <a class="navbar-brand" href="index.php">KRITOGRAFI MODERN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="#kriptografi1">Algoritma RSA <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="#kriptografi2">Algoritma AES-256 bit</a>
        </div>
      </div>
      </div>
    </nav>
    
    <section id="home" class="home mt-5" style="background-color: #96B6C5;">
        <div class="container">
            <div class="row">
              <div class="col" style="margin-top: 100px;">
                <h2 align="center"><b>KRIPTOGRAFI MODERN</b></h2> <br><br>
              </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
              <div class="col">
                
                <p align="center">Kriptografi modern adalah era kriptografi setelah penemuan komputer digital. Perkembangan teknologi komputer digital membuat ilmu kriptografi berkembang dengan pesat. Komputer digital merepresentasikan data dan informasi dalam biner. Algoritma kriptografi modern beroperasi dalam mode bit atau byte (bandingkan dengan algoritma kriptografi klasik beroperasi dalam mode karakter). Meskipun disebut kriptografi modern, namun algoritmanya tetap menggunakan dua teknik dasar dasar di dalam kriptografi klasik: teknik substitusi dan teknik transposisi, tetapi operasinya dibuat lebih kompleks, tidak sesederhana cipher klasik. Tujuannya: agar cipher modern lebih sulit dikriptanalisis. Kriptografi modern melahirkan konsep-konsep baru seperti algoritma kriptografi kunci-publik, fungsi hash, protokol kriptografi, tanda-tangan digital, pembangkit bilangan acak, skema pembagian kunci, dsb.
 </p>
                <p align="center">Adapun Algoritma yang digunakan adalah : <br><br>
                 <b>1. Algoritma RSA <br><br> 2. Algoritma AES-256 bit</b> </p>
              </div>
            </div>
        </div>
      </section>

    <section id="kriptografi1" class="kriptografi1" style="background-color: #ADC4CE;">
    <div class="container" style=">
        <div class="row">
          <div class="col text-center"><br>
            <h2 style="margin-top: 70px;"> <b>KRIPTOGRAFI ALGORITMA RSA</b></h2> <br><br><br>
            <form method="post">
                <center>
                <table>
                  <tr>
                  <td><b>Plain Teks</b> </td><td><b>Chipper Teks</b> </td><td><b>Plain Teks</b></td>
                  </tr>
                  <tr>
                  <td><textarea name="plain" cols="30" rows="5" placeholder=" Teks Sebelum Enkripsi"></textarea></td>
                  <td>
                  <textarea name="chiper" cols="30" rows="5" placeholder=" Teks Hasil Enkripsi"><?php if (isset($_POST['enkrip'])){echo $hasilenkripsi; }?></textarea>
                  </td>
                  <td>
                  <textarea name="hasilplain" cols="30" rows="5" placeholder=" Teks Hasil Deskripsi"><?php if (isset($_POST['dekrip'])){ echo $hasildeskripsi[1]; } ?></textarea>
                  </td>
                  </tr>
                  <tr>
                  <td><b>Public Key</b></td><td><b>Private Key</b></td><td><b>Waktu Eksekusi</b></td>
                  </tr>
                  <tr>
                  <td><input type="text" name="keypublic" placeholder=" Kunci Public" Value="<?php if (isset($_POST['enkrip'])){ echo ' '.$e.' & '.$valn.' -> (e,n)';} ?>"></td>
                  <td><input type="text" name="keyprivate" placeholder=" Kunci Private" Value="<?php if (isset($_POST['dekrip'])){ echo ' '.$vald.' & '.$valn.' -> (d,n)';} ?>"></td>
                  <td><?php if (isset($_POST['dekrip'])){ echo $hasildeskripsi[0]; } ?></td>
                  </tr>
                  <tr>
                  <td><input name="enkrip" type="submit" value="Enkripsi" class="tombol medium gray"></td>
                  <td><input name="dekrip" type="submit" value="Dekripsi" class="tombol medium gray"></td>
                  </tr>
                  </table>
                </center>
                </form>

                
          </div>
        </div>
    </div>
  </section>

  <section id="kriptografi2" class="kriptografi2" style="background-color: #EEE0C9;">
      <div class="container">
          <div class="row">
            <div class="col text-center">
              <h2 style="margin-top: 70px;"><b>KRIPTOGRAFI ALGORITMA AES-256</b></h2>
               <br><br>
                <!-- This is encryption using AES-256-CBC algorithm-->
                  <form action="#kriptografi2" method="post" enctype="multipart/form-data">
                  <fieldset>
                  <p><b>Masukkan Text :</b> <input type="text" name="plaintext" size="20" maxlength="50" required ></p>
                  <p><b>Masukkan Kunci :</b> <input type="text" name="secret_key" size="20" maxlength="50" required ></p>
                  <p><b>Masukkan Inisialisasi Vektor:</b> <input type="text" name="secret_iv" size="20" maxlength="50" required ></p>
                  <input type="submit" name="submitE" value="Enkripsi" /><input type="submit" name="submitD" value="Dekripsi" />
                  </fieldset>
                </form>
                <?php
                if (isset($_POST['submitE'])) {
                  function crypto($action, $plaintext) {
                    $output = false;
                    $algorithm = "AES-256-CBC";
                    $secret_key = $_POST["secret_key"];
                    $secret_iv = $_POST["secret_iv"];
                    // hash
                    $key = hash('sha256', $secret_key);
                    
                    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                    $iv = substr(hash('sha256', $secret_iv), 0, 16);
                    if ( $action == 'encrypt' ) {
                      $output = openssl_encrypt($plaintext, $algorithm, $key, 0, $iv);
                      $output = base64_encode($output);
                    } else if( $action == 'decrypt' ) {
                      $output = openssl_decrypt(base64_decode($plaintext), $algorithm, $key, 0, $iv);
                    }
                    return $output;
                  }
                  
                  //plaintext
                  echo "<br><fieldset><legend><b><span'>RESULT</span></b></legend>";
                  $plaintext = $_POST["plaintext"];
                  echo "Plain Text =" .$plaintext. "<br>";
                  
                  //secret key
                  $secret_key = $_POST["secret_key"];
                  echo "Kunci =" .$secret_key. "<br>";

                  //initialization vector
                  $secret_iv = $_POST["secret_iv"];
                  echo "Inisialisasi Vektor =" .$secret_iv. "<br><br>";
                  
                  //ciphertext
                  $ciphertext = crypto('encrypt', $plaintext);
                  echo "Enkripsi Text = " .$ciphertext. "<br>";
                  
                  echo "</fieldset>";
                  }
                ?>

                <?php
                if (isset($_POST['submitD'])) {
                  function crypto($action, $plaintext) {
                    $output = false;
                    $algorithm = "AES-256-CBC";
                    $secret_key = $_POST["secret_key"];
                    $secret_iv = $_POST["secret_iv"];
                    // hash
                    $key = hash('sha256', $secret_key);
                    
                    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                    $iv = substr(hash('sha256', $secret_iv), 0, 16);
                    $output = openssl_decrypt(base64_decode($plaintext), $algorithm, $key, 0, $iv);
                    return $output;
                  }
                  
                  //plaintext
                  echo "<br><fieldset><legend><b><span>RESULT</span></b></legend>";
                  $plaintext = $_POST["plaintext"];
                  echo "Cipher Text =" .$plaintext. "<br>";
                  
                  //secret key
                  $secret_key = $_POST["secret_key"];
                  echo "Kunci =" .$secret_key. "<br>";

                  //initialization vector
                  $secret_iv = $_POST["secret_iv"];
                  echo "Inisialisasi Vektor =" .$secret_iv. "<br><br>";
                  
                  //decrypted text
                  $decrypted_txt = crypto('decrypt', $plaintext);
                  echo "Dekripsi Text =" .$decrypted_txt. "<br>";
                  
                  echo "</fieldset>";
                  }
                ?>
            </div>
          </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
