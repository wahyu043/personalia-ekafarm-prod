<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Barryvdh\DomPDF\Facade\Pdf;

class CutiPdfController extends Controller
{
    public function export($id)
    {
        $cuti = Cuti::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.cuti', compact('cuti'))
                  ->setPaper('A4', 'portrait');

        $filename = 'Surat_Cuti_' . $cuti->user->name . '.pdf';
        return $pdf->download($filename);
    }
}
