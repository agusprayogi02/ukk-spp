<?php
include "./function.php";
$user  = $_POST['username'];
$pass  = md5($_POST['password']);
$sql  = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$user' AND password='$pass'");
//query berfungsi untuk mengeksekusi query
$ketemu  = mysqli_num_rows($sql);
if ($ketemu > 0) {
  $rest = mysqli_fetch_assoc($sql); //memecah data menjadi perkolom di dlm array.
  $_SESSION['id'] = $rest['id'];
  $_SESSION['username'] = $rest['username'];
  $_SESSION['level'] = $rest['level'];
  $_SESSION['login'] = true;
  if ($rest['level'] === "admin") {
    header("location:admin/");
  } else if ($rest['level'] === "petugas") {
    header("location:petugas/");
  } else {
    header("location:siswa/");
  }
} else {
?>
  <script>
    alert('Maaf, Username atau Password salah.');
    window.location.href = 'index.php';
  </script>
<?php
}
?>