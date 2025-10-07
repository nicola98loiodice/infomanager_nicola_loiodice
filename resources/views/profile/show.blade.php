<x-layout>
    <div class="container mt-5">

        <div class="row justify-content-evenly flex-row">
            <x-sidebar /> 
            <div class="col-12 col-md-10">
                <h2>Profilo Utente</h2>
                <div class="mt-4 p-3">
                    <p><strong>Nome:</strong> {{ $user->name }}</p>
                    <p><strong>Cognome:</strong> {{ $user->surname }}</p>
                    <p><strong>Ruolo:</strong> #</p>
                    {{-- <p><strong>Ruolo:</strong> {{ ucfirst($user->role) }}</p> --}}
                    <p><strong>Ore Totali Svolte:</strong> #</p>
                    <p><strong>Ore Mensili Svolte:</strong> #</p>
                    <hr>
                    <a href="#" class="btn btn-primary">Firma un turno</a>
                </div>
            </div>
        </div>

    </div>
</x-layout>
