<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GuestsExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths
{
    protected $guests;

    public function __construct($guests)
    {
        $this->guests = $guests;
    }

    public function collection()
    {
        return $this->guests;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'No. Telepon',
            'Instansi',
            'Keperluan',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        return [
            $row->created_at->format('Y-m-d H:i'),
            $row->nama,
            $row->no_telepon,
            $row->instansi,
            $row->keperluan,
            $row->keterangan,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 22,
            'C' => 16,
            'D' => 28,
            'E' => 28,
            'F' => 35,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => [$this, 'afterSheet'],
        ];
    }

    public function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet->getDelegate();
        $highestRow = $sheet->getHighestRow();

        // ====== SECTION INFORMASI ======
        // Row 1: Judul
        $sheet->setCellValue('A1', 'LAPORAN DATA BUKU TAMU');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1e40af'], // Blue
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '1e3a8a'],
                ],
            ],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Row 2: Tanggal Export
        $sheet->setCellValue('A2', 'Tanggal Export:');
        $sheet->setCellValue('B2', now()->format('d F Y'));
        $sheet->setCellValue('D2', 'Jam Export:');
        $sheet->setCellValue('E2', now()->format('H:i:s'));

        $sheet->getStyle('A2:B2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1F2937']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '7DD3FC']]],
        ]);

        $sheet->getStyle('D2:E2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1F2937']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '7DD3FC']]],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(20);

        // Row 3: Empty spacing
        $sheet->getRowDimension(3)->setRowHeight(5);

        // Row 4: Header table
        $headerRow = 4;
        $sheet->getStyle("A{$headerRow}:F{$headerRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0369a1'], // Cyan-dark
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '164e63'],
                ],
            ],
        ]);
        $sheet->getRowDimension($headerRow)->setRowHeight(28);

        // Data rows styling (starting from row 5)
        if ($highestRow > 1) {
            $dataStartRow = 5;
            $actualDataRows = $highestRow - 1; // Karena headings di row 1

            // Alternate row colors untuk readability lebih baik
            for ($i = 0; $i < $actualDataRows; $i++) {
                $row = $dataStartRow + $i;
                // Blue & Light Blue alternating
                $bgColor = ($i % 2 == 0) ? 'F0F9FF' : 'E0F2FE';
                $borderColor = ($i % 2 == 0) ? 'BAE6FD' : '7DD3FC';

                $sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $bgColor],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => $borderColor],
                        ],
                    ],
                    'font' => [
                        'size' => 10,
                        'color' => ['rgb' => '1F2937'],
                    ],
                ]);

                $sheet->getRowDimension($row)->setRowHeight(24);
            }
        }

        // Summary section
        $summaryRow = $highestRow + 2;
        $totalData = $highestRow - 1;

        // Summary border box
        $sheet->setCellValue("A{$summaryRow}", 'RINGKASAN LAPORAN');
        $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
        $sheet->getStyle("A{$summaryRow}:F{$summaryRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '7c3aed']], // Purple
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['outline' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => '5b21b6']]],
        ]);
        $sheet->getRowDimension($summaryRow)->setRowHeight(24);

        // Summary items
        $summaryRow++;
        $sheet->setCellValue("A{$summaryRow}", 'Total Tamu:');
        $sheet->setCellValue("B{$summaryRow}", $totalData);
        $sheet->setCellValue("D{$summaryRow}", 'Periode:');
        $sheet->setCellValue("E{$summaryRow}", now()->format('d F Y'));

        $sheet->getStyle("A{$summaryRow}:B{$summaryRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1F2937']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EDE9FE']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D8B4FE']]],
        ]);

        $sheet->getStyle("D{$summaryRow}:E{$summaryRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1F2937']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EDE9FE']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D8B4FE']]],
        ]);
        $sheet->getRowDimension($summaryRow)->setRowHeight(22);

        // Footer
        $footerRow = $summaryRow + 2;
        $sheet->setCellValue("A{$footerRow}", 'Dokumen ini adalah hasil export dari Sistem Buku Tamu Digital');
        $sheet->mergeCells("A{$footerRow}:F{$footerRow}");
        $sheet->getStyle("A{$footerRow}:F{$footerRow}")->applyFromArray([
            'font' => ['italic' => true, 'size' => 9, 'color' => ['rgb' => '6B7280']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension($footerRow)->setRowHeight(18);

        // Freeze panes at header row (row 5 is data row 1, so freeze at 4)
        $sheet->freezePane('A5');

        // Set print options
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageMargins()->setLeft(0.5);
        $sheet->getPageMargins()->setRight(0.5);
        $sheet->getPageMargins()->setTop(0.5);
        $sheet->getPageMargins()->setBottom(0.5);

        // Remove gridlines untuk tampilan lebih bersih
        $sheet->setShowGridlines(false);

        // Set print area
        $sheet->getPageSetup()->setPrintArea("A1:F{$highestRow}");
    }
}
