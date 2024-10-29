@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message)
            <div class="alert alert-info">{{ $message }}</div>
        @endif
        @isset($totalNotes)
            <div>Total des notes obtenues : {{ $totalNotes }}</div>
            @isset($errors)
                <h4>Erreurs :</h4>
                <ul>
                    @foreach ($errors as $error)
                        <li>Question : {{ $error['question'] }} - Votre réponse : {{ $error['user_answer'] }} - Bonne réponse : {{ $error['correct_answer'] }}</li>
                    @endforeach
                </ul>
            @endisset
        @endisset
        <a href="{{ route('user.home', ['hashed_user_id' => $hashed_user_id]) }}" class="btn btn-primary">Retour à l'accueil</a>
    </div>
@endsection
