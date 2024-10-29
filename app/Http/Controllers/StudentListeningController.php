<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listening;

class StudentListeningController extends Controller
{
    // Afficher la liste des écoutes pour l'étudiant
    public function index($hashed_user_id)
    {
        // Vous pouvez ajouter une logique ici pour récupérer les écoutes disponibles pour l'étudiant
        $listenings = Listening::all(); // Par exemple, récupère toutes les écoutes
        return view('listenings.index', compact('listenings', 'hashed_user_id'));
    }

    // Afficher les détails d'une écoute
    public function show($hashed_user_id, Listening $listening)
    {
        return view('listenings.show', compact('listening', 'hashed_user_id'));
    }

    public function showListeningMain($hashed_user_id)
    {
        return view('listenings.main', compact('hashed_user_id'));
    }

    public function indexByLevel($hashed_user_id, $levelName)
    {
    // Récupérer les écoutes filtrées par niveau
    $listenings = Listening::whereHas('level', function($query) use ($levelName) {
        $query->where('name', $levelName);
    })->get();

    return view('listenings.index', compact('listenings', 'hashed_user_id', 'levelName'));
    }

}
