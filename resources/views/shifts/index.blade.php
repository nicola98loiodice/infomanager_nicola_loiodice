<x-layout>
    <div class="container  mw-100">

        <div class="row">
            <x-sidebar />
            <div class="col-12 col-md-10 mt-2">
                <h2>Calendario Mensile</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Giorno</th>
                            <th>Mattina</th>
                            <th>Pomeriggio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shiftsByDate as $date => $data)
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $data['dayName'] }}</td>
                                <td>
                                    @foreach ($data['shifts']->where('shift_type', 'Mattina') as $shift)
                                        {{ $shift->user->name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data['shifts']->where('shift_type', 'Pomeriggio') as $shift)
                                        {{ $shift->user->name }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>



    </div>
</x-layout>
