<?php
require_once APPPATH . 'third_party/dompdf/dompdf.php';

class Pdf extends TCPDF
{
	public function generatePDF($data)
	{
		// Pengaturan dan tata letak PDF
		$this->SetTitle('Laporan PDF dengan Filter');
		$this->SetHeaderData('', 0, 'Laporan PDF', 'Filter berdasarkan: ...'); // Atur judul dan header

		// Set orientasi lanskap
		$this->SetPageOrientation('L');

		// Add a page
		$this->AddPage();

		// Tambahkan konten PDF berdasarkan data yang diberikan
		$this->SetFont('times', 'N', 12);
		$this->Cell(0, 10, 'Data yang sesuai dengan filter:', 0, 1, 'L');

		foreach ($data['filteredData'] as $row) {
			// Tambahkan data ke dalam laporan
			$this->Cell(0, 10, 'Nama: ' . $row->nama, 0, 1, 'L');
			$this->Cell(0, 10, 'Alamat: ' . $row->alamat, 0, 1, 'L');
			// ... Tambahkan kolom data lainnya sesuai kebutuhan
		}

		// Output PDF ke browser atau simpan ke file
		$this->Output('output.pdf', 'I');
	}
}
