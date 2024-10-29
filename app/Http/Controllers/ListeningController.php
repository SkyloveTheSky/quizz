<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Listening;
use Illuminate\Support\Facades\Storage;

class ListeningController extends Controller
{
    // Afficher la liste des écoutes
    public function index()
    {
        $listenings = Listening::all();
        return view('admin.listenings.index', compact('listenings'));
    }

    // Afficher le formulaire pour créer une nouvelle écoute
    public function create()
    {
        // Lister les fichiers audio dans le répertoire 'public/audio_files'
        $audioFiles = Storage::disk('public')->files('audio_files');

        // Récupérer les niveaux
        $levels = Level::all();

        return view('admin.listenings.create', compact('audioFiles', 'levels'));
    }

    // Stocker une nouvelle écoute
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id',
            'new_file' => 'nullable|mimes:mp3,wav|max:20480', // Maximum 20MB pour les nouveaux fichiers
            'existing_file' => 'nullable|string', // Option pour fichier existant
            'translation' => 'nullable|string', // Traduction optionnelle
        ]);

        if ($request->hasFile('new_file')) {
            // Renommer le fichier téléversé
            $file = $request->file('new_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('audio_files', $fileName, 'public');
        } else {
            // Utiliser le fichier existant sélectionné
            $filePath = $request->input('existing_file');
        }

        // Créer une nouvelle entrée dans la table 'listenings'
        Listening::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
            'level_id' => $request->input('level_id'),
            'translation' => $request->input('translation'), // Ajouter la traduction
        ]);

        return redirect()->route('listenings.index')->with('success', 'Listening created successfully.');
    }

    // Afficher le formulaire pour éditer une écoute existante
    public function edit(Listening $listening)
    {
        // Récupérer tous les niveaux
        $levels = Level::all();

        // Lister les fichiers audio dans le répertoire 'public/audio_files'
        $audioFiles = Storage::disk('public')->files('audio_files');

        return view('admin.listenings.edit', compact('listening', 'levels', 'audioFiles'));
    }

    // Mettre à jour une écoute existante
    public function update(Request $request, Listening $listening)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:mp3,wav|max:20480', // Maximum 20MB pour les nouveaux fichiers
            'level_id' => 'required|exists:levels,id',
            'translation' => 'nullable|string', // Traduction optionnelle
        ]);

        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier
            Storage::disk('public')->delete($listening->file_path);
            // Stocker le nouveau fichier
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('audio_files', $fileName, 'public');
            $listening->file_path = $filePath;
        } elseif ($request->input('existing_file')) {
            $listening->file_path = $request->input('existing_file');
        }

        $listening->title = $request->input('title');
        $listening->level_id = $request->input('level_id');
        $listening->translation = $request->input('translation');
        $listening->save();

        return redirect()->route('listenings.index')->with('success', 'Listening updated successfully.');
    }

    // Supprimer une écoute
    public function destroy(Listening $listening)
    {
        // Supprimer le fichier associé
        Storage::disk('public')->delete($listening->file_path);
        $listening->delete();

        return redirect()->route('listenings.index')->with('success', 'Listening deleted successfully.');
    }
}
