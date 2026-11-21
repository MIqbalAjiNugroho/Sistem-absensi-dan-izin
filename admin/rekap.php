<?php include '../config/koneksi.php'; ?>
<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// 1. Ambil data dari database (sesuaikan nama database, tabel, dan kolom)
$pdo = new PDO("mysql:host=$host;dbname=$db", 'root', '');
$data = $pdo->query("SELECT 'nama', 'tanggal', 'jam_masuk', 'jam_pulang', 'status' FROM absensi")
            ->fetchAll(PDO::FETCH_ASSOC);

// 2. Buat spreadsheet dan isi header
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Rekap Absensi');

$sheet->setCellValue('A1', 'Nama');
$sheet->setCellValue('B1', 'Tanggal');
$sheet->setCellValue('C1', 'Jam Masuk');
$sheet->setCellValue('D1', 'Jam Pulang');
$sheet->setCellValue('E1', 'Status');

// 3. Isi data mulai baris 2
$baris = 2;
foreach ($data as $row) {
    $sheet->setCellValue('A' . $baris, $row['nama']);
    $sheet->setCellValue('B' . $baris, $row['tanggal']);
    $sheet->setCellValue('C' . $baris, $row['jam_masuk']);
    $sheet->setCellValue('D' . $baris, $row['jam_pulang']);
    $sheet->setCellValue('E' . $baris, $row['status']);
    $baris++;
}

// 4. Kirim sebagai file unduhan
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="rekap_absensi.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>

