<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">Firma Turno</h2>

                {{-- Messaggi di stato --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Errori di validazione --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('shifts.store') }}" class="p-4 shadow rounded bg-yellow">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cognome</label>
                        <input type="text" class="form-control" value="{{ $user->surname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <input type="text" class="form-control" value="{{ $today }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo di turno</label>
                        <select name="minutes" class="form-select @error('minutes') is-invalid @enderror" required>
                            <option value="">-- Seleziona --</option>
                            <option value="150" {{ old('minutes') == 150 ? 'selected' : '' }}>
                                Semplice — 2 ore e 30 (150 min)
                            </option>
                            <option value="180" {{ old('minutes') == 180 ? 'selected' : '' }}>
                                Festivo — 3 ore (180 min)
                            </option>
                        </select>
                        @error('minutes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Inserisci</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
