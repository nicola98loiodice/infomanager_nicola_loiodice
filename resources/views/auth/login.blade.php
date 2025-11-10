<x-layout>
    <div class="container mt-5">
        <div class="row justify-content">
            <div class="col-12 text-center">
                <h1 class="display-4 pt-5">
                    Accedi
                </h1>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center align-items-center height-custom">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('login') }}" class="bg-yellow shadow rounded p-5">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Indirizzo Email</label>
                        <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp"
                            name="email">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('register') }}">Non ho un account</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Accedi</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
