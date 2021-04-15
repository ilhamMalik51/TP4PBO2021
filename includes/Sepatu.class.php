<?php

class Sepatu extends DB{
    function getSepatu(){
        $query = "SELECT * FROM sepatu";

        return $this->execute($query);
    }

    function setSepatu($data){
        
        $nama = $data['tname'];
        $merk = $data['tmerk'];
        $jenis = $data['optradio'];
        $deskripsi = $data['tdeskripsi'];

        $tmp_file = $_FILES['file-upload']['tmp_name'];
        $nm_file = $_FILES['file-upload']['name'];
        $ukuran_file = $_FILES['file-upload']['size'];
        
        if($nm_file){
            $dir = "assets/$nm_file";
            move_uploaded_file($tmp_file, $dir);

            $query = "INSERT INTO sepatu (nama_sepatu, merk_sepatu, jenis_sepatu, deskripsi_sepatu, foto_sepatu, keadaan) 
            VALUES ('$nama', '$merk', '$jenis', '$deskripsi', '$dir', 'Baik')";

            return $this->execute($query);
        }
    }

    function deleteSepatu($data){
        $id_hapus = $data['id_hapus'];
		$query = "DELETE FROM sepatu WHERE id_sepatu = '$id_hapus'";

		return $this->execute($query);
    }

    function updateSepatu($data){
        $id_update = $data['id_edit'];
        $query = "UPDATE sepatu SET keadaan = 'Rusak' WHERE id_sepatu = '$id_update'";

        return $this->execute($query);
    }
}

?>