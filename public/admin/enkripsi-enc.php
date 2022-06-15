<?php
//---- Enkripsi Chipper Key
function enkripsi($plainText, $key)
{
    $plainText = strtoupper($plainText);
    $plainText = preg_replace('/[^A-Z]+/', '', $plainText);

    $string = '';

    $key = strtoupper($key);
    $key = preg_replace('/[^A-Z]+/', '', $key);

    $alfabetSatu    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alfabetDua     = ' ' . $key;
    $alfabetDuaString = '';

    for ($h = 0; $h < strlen($alfabetDua); $h++) {
        $huruf = substr($alfabetDua, $h, 1);

        if (!strpos($alfabetDuaString, $huruf)) {
            $alfabetDuaString .= $huruf;
        }
    }

    $alfabetDua = $alfabetDuaString;

    for ($i = 0; $i < strlen($alfabetSatu); $i++) {
        $huruf = substr($alfabetSatu, $i, 1);

        if (!strpos($alfabetDua, $huruf)) {
            $alfabetDua .= $huruf;
        }
    }

    $alfabetDua = trim($alfabetDua);

    for ($j = 0; $j < strlen($plainText); $j++) {
        $huruf = substr($plainText, $j, 1);
        $posisi = strpos($alfabetSatu, $huruf);

        $string .= substr($alfabetDua, $posisi, 1);
    }

    return $string;
}

//---- Dekripsi Chipper Key
function dekripsi($chiperText, $key)
{
    $string = '';

    $key = strtoupper($key);
    $key = preg_replace('/[^A-Z]+/', '', $key);

    $alfabetSatu    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alfabetDua     = ' ' . $key;
    $alfabetDuaString = '';

    for ($h = 0; $h < strlen($alfabetDua); $h++) {
        $huruf = substr($alfabetDua, $h, 1);

        if (!strpos($alfabetDuaString, $huruf)) {
            $alfabetDuaString .= $huruf;
        }
    }

    $alfabetDua = $alfabetDuaString;

    for ($i = 0; $i < strlen($alfabetSatu); $i++) {
        $huruf = substr($alfabetSatu, $i, 1);

        if (!strpos($alfabetDua, $huruf)) {
            $alfabetDua .= $huruf;
        }
    }

    $alfabetDua = trim($alfabetDua);

    for ($j = 0; $j < strlen($chiperText); $j++) {
        $huruf = substr($chiperText, $j, 1);
        $posisi = strpos($alfabetDua, $huruf);

        $string .= substr($alfabetSatu, $posisi, 1);
    }

    return $string;
}

//---- Enkripsi Caesar Chipper
// ini untuk convert string menjadi uppercase
function cltn($char)
{
    $char = strtoupper($char);
    $ord = ord($char);
    return ($ord > 64 && $ord < 91) ? ($ord - 64) : false;
}

// Fungsi Enkripsi
// Ambil Value Inputan
function encrypt_cipher($str, $plus)
{
    // Validasi Input Jika Benar Numeric dan String
    if (is_numeric($plus) && $plus <= 26 && is_string($str)) {
        // Membuat Variabel $al dengan Nilai Array (a-z)
        $al = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w',
            'x', 'y', 'z'
        );
        $nstr = '';
        // Convert Inputan String Ke Array Pake str_split
        foreach (str_split($str) as $i => $v) {
            //convert string menjadi uppercase
            if (cltn($v)) {
                $ltn = cltn($v) - 1;
                if (($ltn + $plus) > 25) {
                    $nstr .= $al[($ltn + $plus) - 25];
                } else {
                    $nstr .= $al[$ltn + $plus];
                }
            } else {
                $nstr .= $v;
            }
        }
        return $nstr;
    } else {
        return false;
    }
}
?>
<!-- Page Loader -->
<?php
function Cipher($ch, $key)
{
    if (!ctype_alpha($ch))
        return $ch;
    $offset = ord(ctype_upper($ch) ? 'A' : 'a');
    return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
}
//--------------------------------------------------------

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
function Encipher($input, $key)
{
    $output = "";

    $inputArr = str_split($input);
    foreach ($inputArr as $ch)
        $output .= Cipher($ch, $key);

    return $output;
}


error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

function Decipher($input, $key)
{
    return Encipher($input, 26 - $key);
}
?>
<div class='content'>
    <button onclick="goBack()" class="btn btn-default"><i class="fa fa-caret-left"></i> back</button>
    <div class="banner">
        <div class="bg-color">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" style="max-width: 900px; float: none; margin: 0 auto; margin-top: 40px; margin-bottom: 0px; color: #4b4b4b;">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Enkripsi</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-5" style="padding: 10px; color: #4b4b4b;">
                                        <!-- start Form Enkripsi -->
                                        <form action="" method="post" style="padding: 0px; margin: 0 auto;">
                                            <input class="form-control smooth text-center" placeholder="Kunci" name="kunci" type="text" style="width: 100%; height:50px; margin-bottom:15px;" />
                                            <textarea class="form-control smooth text-center" rows="3" name="pesan" id="pesan" placeholder="Ketikan Pesan.."></textarea>
                                            <input type="submit" name="klik" value="Run" class="smooth cari btn btn-info btn-circle btn-lg" style="background-color: #4b4b4b; border-color: #383838; margin-top:15px;">
                                        </form>
                                        <!-- End Form Enkripsi -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 15px;margin-bottom: 50px;">
                            <div class="col-md-6">
                                <h5>Detail Proses</h5>

                                <?php
                                if (isset($_POST['klik'])) {
                                    $kunci = $_POST['kunci'];
                                    $pesan = $_POST['pesan'];
                                    //Input
                                    $plainText = $pesan;
                                    $chiperkeyText = enkripsi($plainText, $kunci); ?>
                                    <p style="padding:0px; margin:0 auto;"> Kunci : <?php echo $kunci; ?></p>
                                    <p>Pesan Teks : <?php echo $plainText; ?></p>
                                <?php } else { ?>
                                    <p style="padding:0px; margin:0 auto;">
                                        Menunggu Proses Masukan..</p>
                                <?php }; ?>
                            </div>
                            <div class="col-md-6" style="padding-top: 15px;">
                                <h5>Hasil Pesan Enkripsi</h5>

                                <?php
                                if (isset($_POST['klik'])) {
                                    $kunci = $_POST['kunci'];
                                    $pesan = $_POST['pesan'];
                                    //Input
                                    $plainText = $pesan;
                                    $chiperkeyText = enkripsi($plainText, $kunci); ?>
                                    <p><?php echo $cipherText = Encipher($chiperkeyText, 3); ?></p>
                                    <button class="btn btn-primary"><a href="?enkripsi=add&hasil=<?php echo $cipherText = Encipher($chiperkeyText, 3);?>&kunci=<?php echo $kunci; ?>"><i class="fa fa-plus"></i>&nbsp;Simpan Data</a></button>
                                <?php } else { ?>
                                    <p style="padding:0px; margin:0 auto;">
                                        Menunggu Proses Masukan..</p>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>