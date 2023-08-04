<?php

require './functions.php';

$id = $_GET["id"];

if (delete($id) > 0 ){
    echo "
        <script>
            alert('data berhasil di hapus');
            document.location.href = '../../public/page/dasboard.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('data gagal di hapus');
            document.location.href = '../../public/page/dasboard.php';
        </script>
        ";
}

?>