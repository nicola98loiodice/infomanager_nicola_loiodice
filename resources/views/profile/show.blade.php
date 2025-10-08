<x-layout>
    <div class="container mw-100 ">
        <div class="row justify-content-between flex-row  ">
            <x-sidebar />
            <div class="col-12 col-md-10 mt-2   ">
                <h2>Profilo Utente</h2>
                <div class="mt-4 p-3 ">
                    <p><strong>Nome:</strong> {{ $user->name }}</p>
                    <p><strong>Cognome:</strong> {{ $user->surname }}</p>
                    <p><strong>Ruolo:</strong> {{ $user->role }}</p>
                    {{-- <p><strong>Ruolo:</strong> {{ ucfirst($user->role) }}</p> --}}
                    <p><strong>Ore Totali Svolte:</strong> {{ $totaleOre }}</p>
                    <p><strong>Recap turni:</strong>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Durata (ore)</th>
                                <th>Fascia oraria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $shift)
                                <tr>
                                    <td>{{ $shift->date }}</td>
                                    <td>{{ $shift->ore }}</td> 
                                    <td>{{$shift->shift_type}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </p>
                    <hr>
                    
                </div>
            </div>
        </div>

    </div>
</x-layout>
