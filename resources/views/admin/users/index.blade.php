<x-layout>
    <div class="container mw-100">
        <div class="row">
            <x-sidebar />
            <div class="col-12 col-md-10 mt-2">
                <h2>Lista Operatori</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ruolo</th>
                            <th>Ore totali</th>
                            <th>Ore Mensili</th>
                            <th>Ore Trimestrali</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    {{-- Se non ci sono turni firmati mostra 0 --}}
                                    {{ isset($totals[$user->id]) ? number_format($totals[$user->id] / 60, 1) : 0 }} h
                                </td>
                                <td>
                                    {{-- Se non ci sono turni firmati mostra 0 --}}
                                    {{ isset($totals[$user->id]) ? number_format($totals[$user->id] / 60, 1) : 0 }} h
                                </td>
                                <td>
                                    {{-- Se non ci sono turni firmati mostra 0 --}}
                                    {{ isset($totals[$user->id]) ? number_format($totals[$user->id] / 60, 1) : 0 }} h
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layout>
