<?php

class Template{
    var $filename = '';
    var $content = '';

    function Template($filename = ''){
        //konstruktor
        $this->filename = $filename;
        //membaca file ke tampilan
        $this->content = implode('', @file($filename));
    }

    function clear(){
    //membersihkan isi kode yang seharusnya diganti
        //menggantik tulisa DATA_.... dengan kosong jika ada tulisan yang diganti
        //jika tidak ingin menggunakan kode DATA_.... dapat diganti di bagian ekspresi reguler
        $this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
    }

    function write(){
    //menuliskan isi file pada layar
        //menghapus DATA_.... yang belum diganti
        $this->clear();
        //menampilkan tampilan ke dalam layar
        print $this->content;
    }

    function getContent(){
    //mengambil isi file ke dalam layar
        //menghapus DATA_.... yang belum diganti
        $this->clear();
        //menampilkan isi konten
        return $this->content;
    }

    function replace($old='', $new=''){
    // mengganti kode dalam file (DATA_...)
		// pemrosesan nilai yang akan menggantikan
		if(is_int($new)){
			// jika penggantinya bilangan bulat (diubah ke formatnya ke teks)
			$value = sprintf("%d", $new);
		}elseif(is_float($new)){
			// jika penggantinya bilangan real *diubah formatnya ke teks
			$value = sprintf("%f", $new);
		}elseif(is_array($new)){
			// jika penggantinya bilangan array/tabel *diubah formatnya ke teks
			$value = '';
			// pemrosesan setiap elemen array/tabel
			foreach( $new as $item){
				$value .= $item. '';
			}
		}else{
			// jika selain tipe yang ada diatas maka langsung diisikan untuk menggantikan
			$value = $new;
		}
		// menggantikan suatu teks dengan teks baru (misal DATA_... diganti dengan <table> </table>)
		$this->content = preg_replace("/$old/",  $value, $this->content);
    }
}

?>