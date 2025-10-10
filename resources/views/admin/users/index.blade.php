<x-layout>
    <div class="container mw-100">
        <div class="row">
            <x-sidebar />
            <div class="col-12 col-md-10 mt-2 table-responsive">
                <h2>Lista Operatori</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ruolo</th>
                            <th>Tot.Ore</th>
                            <th>Range</th>
                            <th>€/Ore range</th>
                            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ $start }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ $end }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filtra</button>
                                    </div>
                                </div>
                            </form>
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
                                    {{ isset($rangeTotals[$user->id]) ? number_format($rangeTotals[$user->id] / 60, 1) : 0 }}
                                    h

                                </td>
                                <td>
                                    @if (isset($rangeTotalsInEuros[$user->id]))
                                        €{{ number_format($rangeTotalsInEuros[$user->id], 2) }}
                                        <small class="text-muted">
                                            ({{ $hourlyRate }}€/h)
                                        </small>
                                    @else
                                        €0.00
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                
            </div>
        </div>

    </div>
</x-layout>
