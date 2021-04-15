<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Sepatu.class.php");
//menyatukan kelas template

//memproses data
$sepatu = new Sepatu($db_host, $db_user, $db_password, $db_name);
$sepatu->open();  //membuat koneksi terhadap database
$sepatu->getSepatu(); //ambil sepatu

$data = NULL;

while(list($id, $nama, $merk, $jenis, $deskripsi, $foto, $keadaan) = $sepatu->getResult()){
    
    if($keadaan == 'Rusak'){
        $data .= "<tr>
        <td>
            <div class='img-container'>
                <img src='".$foto."' class='img-rounded' alt='Foto Sepatu'>
            </div>
        </td>
        <td>
            <p><strong>Nama :</strong> ".$nama."</p>
            <p><strong>Merk :</strong> ".$merk."</p>
            <p><strong>Jenis:</strong> ".$jenis."</p>
            <dl>
                <dt>Deskripsi Singkat:</dt>
                <dd>".$deskripsi."</dd>
            </dl>
            <h1 class='text-center text-danger bg-danger'>Rusak</h1>
        </td>
        <td>
            <button class='btn btn-danger btn-block'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
        </td>
        </tr>";
    }else if($keadaan == 'Baik'){
        $data .= "<tr>
        <td>
            <div class='img-container'>
                <img src='".$foto."' class='img-rounded' alt='Foto Sepatu'>
            </div>
        </td>
        <td>
            <p><strong>Nama :</strong> ".$nama."</p>
            <p><strong>Merk :</strong> ".$merk."</p>
            <p><strong>Jenis:</strong> ".$jenis."</p>
            <dl>
                <dt>Deskripsi Singkat:</dt>
                <dd>".$deskripsi."</dd>
            </dl>
        </td>
        <td>
            <button class='btn btn-warning btn-block'><a href='index.php?id_edit=" . $id . "' style='color: white; font-weight: bold;'>Rusak</a></button>
            <button class='btn btn-danger btn-block'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
        </td>
        </tr>";
    }
    
    
}

if(isset($_POST['insert'])){
    $sepatu->setSepatu($_POST);
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_GET['id_hapus'])){
    $sepatu->deleteSepatu($_GET);
    header('Location:index.php');
}

if(isset($_GET['id_edit'])){
    $sepatu->updateSepatu($_GET);
    header('Location:index.php');
}

$sepatu->close();

$tpl = new Template("templates/skin.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
?>