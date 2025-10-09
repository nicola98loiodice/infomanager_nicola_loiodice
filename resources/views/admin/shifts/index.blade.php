<x-layout>
    <div class="container  mw-100">

        <div class="row">
            <x-sidebar />
            <div class="col-12 col-md-10 mt-2">
                <h2>Gestione turni mensili</h2>
                {{-- Form per creare un turno --}}
                <form action="{{ route('admin.shifts.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-3">
                            <select name="user_id" class="form-select">
                                <option value="">-- Seleziona Operatore --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <input type="date" name="date" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <select name="minutes" class="form-select">
                                <option value="150">2h 30m</option>
                                <option value="180">3h</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="shift_type" class="form-select">
                                <option value="Mattina">Mattina</option>
                                <option value="Pomeriggio">Pomeriggio</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Aggiungi</button>
                        </div>
                    </div>
                </form>

                {{-- Tabella turni --}}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Operatore</th>
                            <th>Data</th>
                            <th>Fascia</th>
                            <th>Durata</th>
                            <th>Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $shift)
                            <tr class="{{ $shift->is_signed ? 'table-success' : '' }}">
                                <td>{{ $shift->user->name }} {{ $shift->user->surname }}</td>
                                <td>{{ $shift->date }}</td>
                                <td>{{ $shift->shift_type }}</td>
                                <td>{{ $shift->minutes / 60 }} ore</td>
                                <td>
                                    {{ $shift->is_signed ? '✅ Firmato' : '❌ In attesa' }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.shifts.destroy', $shift->id) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare questo turno?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm " title="Elimina">
                                            <i class="fa-solid fa-trash fa-lg"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</x-layout>
