<?php

require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/db_access.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $query = "SELECT p.name, p.description, p.condition, t.balance_paid AS price, t.purchase_date, u.username AS seller_username
              FROM transactions t
              JOIN products p ON t.product_id = p.id
              JOIN users u ON t.seller_id = u.id
              WHERE t.buyer_id = :user_id
              ORDER BY t.purchase_date DESC";
              
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $achats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Mes Achats Switch');

    $sheet->setCellValue('A1', 'Nom du Produit');
    $sheet->setCellValue('B1', 'Description');
    $sheet->setCellValue('C1', 'État / Condition');
    $sheet->setCellValue('D1', 'Prix Payé');
    $sheet->setCellValue('E1', 'Date d\'Achat');
    $sheet->setCellValue('F1', 'Vendeur');

    $sheet->getStyle('A1:F1')->getFont()->setBold(true);

    $row = 2; 
    foreach ($achats as $achat) {
        $sheet->setCellValue('A' . $row, $achat['name']);
        $sheet->setCellValue('B' . $row, $achat['description']);
        $sheet->setCellValue('C' . $row, $achat['condition']);
        $sheet->setCellValue('D' . $row, $achat['price'] . ' Switchs');
        $sheet->setCellValue('E' . $row, $achat['purchase_date']);
        $sheet->setCellValue('F' . $row, $achat['seller_username']);
        $row++;
    }

    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Mes_Achats_Switch_' . date('Y-m-d') . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Erreur lors de la génération de l'export : " . $e->getMessage();
}