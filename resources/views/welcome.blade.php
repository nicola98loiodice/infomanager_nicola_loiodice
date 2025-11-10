<x-layout>
    <div class="container-fluid text-center bg-body-tertiary">
        <div class="row vh-100 justify-content-center align-items-center bg-image ">
            <div class="col-12">
                <h1 class="display-4">InfoPoint-Shiftsmanager</h1>
            </div>
            @auth
            <div class="col-12  ">
                <a href="{{route('profile.show')}}"><button type="button" class="btn btn-light">Inizia</button></a>
            </div>
            @else
             <div class="col-12">
                <a href="{{route('login')}}"><button type="submit" class="btn btn-light">Accedi</button></a>
            </div>
            @endauth
        </div>
    </div>
</x-layout>