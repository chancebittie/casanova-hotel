<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\RestaurantBar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function pdf()
    {
            // $shows = User::all();

            return view('pdf.pdf');
    }

    public function downloadPDF($id) {
        $paiement = Paiement::find($id);
        $pdf = PDF::loadView('pdf.facture', compact('paiement'));

        // return $pdf->download('disney.pdf');
        return $pdf->stream();
    }
    public function downloadPdfRestau($id) {
        $paiement = RestaurantBar::find($id);
        $pdf = PDF::loadView('pdf.restauBar', compact('paiement'));
                    // ->setPaper('a5');

        // return $pdf->download('disney.pdf');
        return $pdf->stream();
    }
}
