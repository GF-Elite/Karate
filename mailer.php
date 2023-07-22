<?php
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/SMTP.php';
require 'phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];

  // Konfigurasi email
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Ganti dengan alamat SMTP provider Anda
    $mail->SMTPAuth = true;
    $mail->Username = 'andikapratama12124123@gmail.com'; // Ganti dengan email pengirim
    $mail->Password = 'bxdiazlqdumcltys'; // Ganti dengan password email pengirim
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Alamat pengirim dan penerima
    $mail->setFrom($email, $name);
    $mail->addAddress('andika2548@smk.belajar.id'); // Ganti dengan alamat email penerima yang valid

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = 'Pesan dari Formulir Kontak';

    // Membuat tabel dengan data pengguna
    $table = '<table>';
    $table .= '<tr><th>Nama</th><td>' . $name . '</td></tr>';
    $table .= '<tr><th>Email</th><td>' . $email . '</td></tr>';
    $table .= '<tr><th>Telepon</th><td>' . $phone . '</td></tr>';
    $table .= '<tr><th>Pesan</th><td>' . $message . '</td></tr>';
    $table .= '</table>';

    $mail->Body = <<<EOT
    <html>
    <body>
      <h2>Pesan dari Formulir Kontak</h2>
      <p>Berikut adalah rincian pesan dari pengguna:</p>
      $table
    </body>
    </html>
    EOT;

    $mail->AltBody = "Nama: $name\nEmail: $email\nTelepon: $phone\nPesan:\n$message";

    $mail->send();
    echo 'Pesan berhasil dikirim.';
  } catch (Exception $e) {
    echo "Maaf, terjadi kesalahan dalam mengirim pesan: {$mail->ErrorInfo}";
  }
}
?>
