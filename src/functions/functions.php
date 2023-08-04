<?php

$conn = mysqli_connect("localhost", "root", "", "eccomerce_app_db");


// menampilkan seluruh product
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Delete data
function delete($id) {

    global $conn;

    mysqli_query($conn, "DELETE FROM products_db WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Upload data 
function upload($data) {

    global $conn;

    $title = htmlspecialchars($data["title"]);
    $category = htmlspecialchars($data["category"]);
    $description = htmlspecialchars($data["description"]);
    $price = htmlspecialchars($data["price"]);
    $stock = htmlspecialchars($data["stock"]);

    $image = uploadImg();
    if(!$image) {
        return false;
    }

    $query = "INSERT INTO products_db
            VALUES (
                '', '$title', '$category', '$description', '$price', '$image', '$stock'
            )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadImg() {

    $nameFile = $_FILES["image"]["name"];
    $sizeFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // cek apakah ada gambar yang di upload
    if($error === 4) {
        echo "
        <script>
            alert('pilih gambar terlebih dahulu');
        </script>
        ";
        return false;
    }

     // cek apakah gambar yang di upload atau bukan
     $ekstensiImgValid = ['jpg', 'jpeg', 'png'];
     $ekstensiImg = explode('.' , $nameFile);
     $ekstensiImg = strtolower(end($ekstensiImg));
     if( !in_array($ekstensiImg, $ekstensiImgValid)) {
         echo "
         <script>
             alert('yang anda upload bukan gambar');
         </script>
         ";
         return false;
     }
 
     // cek jika ukuran nya terlalu besar 
     if($sizeFile > 1000000 ) {
         echo "
         <script>
             alert('ukuran terlalu besar');
         </script>
         ";
         return false;
     }
 
     // memberikan nama gambar baru
 
     $nameNewFile = uniqid();
     $nameNewFile .= $ekstensiImg;
 
     move_uploaded_file($tmpName, '../../public/img/' . $nameNewFile);
 
     return $nameNewFile;
}

// Update data
function update($data) {

    global $conn;
    
    $id = $data["id"];
    $title = htmlspecialchars($data["title"]);
    $category = htmlspecialchars($data["category"]);
    $description = htmlspecialchars($data["description"]);
    $price = htmlspecialchars($data["price"]);
    $imageOld = htmlspecialchars($data["imageOld"]);
    $stock = htmlspecialchars($data["stock"]);

        // cek apa user pilih gambar baru
    if($_FILES['image']['error'] === 4 ) {
        $image = $imageOld;
    } else {
        $image = uploadImg();
    }
    
    $query = "UPDATE products_db SET 
                title = '$title',
                category = '$category',
                description = '$description',
                price = '$price',
                image = '$image',
                stock = '$stock'
                WHERE id = $id
            ";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

// Search data
function search($keyword) {
    $query = "SELECT * FROM products_db WHERE 
                title LIKE '%$keyword%' OR
                category LIKE  '%$keyword%'
            ";

    return  query($query);
}

// Seacrh das
function searchDas($keyword) {
    $query = "SELECT * FROM products_db WHERE 
                title LIKE '%$keyword%' OR
                category LIKE  '%$keyword%'OR
                price LIKE '%$keyword%'OR
                stock LIKE '%$keyword%'
            ";

    return  query($query);
}

// registrasi user
function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm = mysqli_real_escape_string($conn, $data["confirm"]);


    $result = mysqli_query($conn, "SELECT username FROM user_db WHERE username = '$username' ");

    if(mysqli_fetch_assoc($result)) {
        echo "<script> 
                 alert('username sudah ada');
            </script>";
        return false;
    }

    if( $password !== $confirm ) {
        echo "<script> 
                 alert('konfrmasi password nya kembali');
            </script>";
    return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan ke data base
    mysqli_query($conn, "INSERT INTO user_db VALUES('', '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}



?>