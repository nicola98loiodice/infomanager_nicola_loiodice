<div class="col-12 col-md-2 bg-yellow sidebar  p-3  ">
    <a class="text-decoration-none" href="{{ route('profile.show') }}">
        <p>Profilo</p>
    </a>
    <hr>
    <a class="text-decoration-none" href="{{ route('shifts.create') }}">
        <p>Firma turno</p>
    </a>
    <hr>
    <a class="text-decoration-none" href="">
        <p>Inserisci affluenza</p>
    </a>
    <hr>
    <a class="text-decoration-none" href="">
        <p>Calendario generale</p>
    </a>
    <hr>
    @auth
        @if (Auth::user()->role === 'Admin')
        <a class="text-decoration-none" href="{{ route('admin.shifts.index') }}">
            <p>Inserisci turnazione</p>
        </a>
        <hr>
        <a class="text-decoration-none" href="">
            <p>Rivedi lista operatori</p>
        </a>
    @endif
@endauth
</div>
