<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    // Afficher la liste des PDF
    public function index()
    {
        $pdfs = Pdf::all();
        return view('admin.pdf.index', compact('pdfs'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('admin.pdf.create');
    }

    // Stocker un nouveau PDF
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:20480', // Maximum 20MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('pdf_files', 'public');

        Pdf::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
        ]);

        return redirect()->route('pdfs.index')->with('success', 'PDF uploaded successfully.');
    }

    // Afficher le formulaire d'édition
    public function edit(Pdf $pdf)
    {
        return view('admin.pdfs.edit', compact('pdf'));
    }

    // Mettre à jour un PDF existant
    public function update(Request $request, Pdf $pdf)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:20480',
        ]);

        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier
            Storage::disk('public')->delete($pdf->file_path);
            // Stocker le nouveau fichier
            $filePath = $request->file('file')->store('pdf_files', 'public');
            $pdf->file_path = $filePath;
        }

        $pdf->title = $request->input('title');
        $pdf->save();

        return redirect()->route('pdfs.index')->with('success', 'PDF updated successfully.');
    }

    // Supprimer un PDF
    public function destroy(Pdf $pdf)
    {
        // Supprimer le fichier associé
        Storage::disk('public')->delete($pdf->file_path);
        $pdf->delete();

        return redirect()->route('pdfs.index')->with('success', 'PDF deleted successfully.');
    }


    // Afficher tous les PDFs disponibles pour un utilisateur spécifique
    public function indexForUser($hashed_user_id)
    {

        $pdfs = Pdf::all(); // Récupérer tous les PDFs depuis la base de données
        return view('pdf.index', compact('pdfs', 'hashed_user_id')); // Passer les PDFs à la vue
    }

    // Afficher un PDF spécifique
    public function show($hashed_user_id, Pdf $pdf)
    {
        $filePath = storage_path('app/public/' . $pdf->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'PDF not found');
        }

        return response()->file($filePath);
    }
}
