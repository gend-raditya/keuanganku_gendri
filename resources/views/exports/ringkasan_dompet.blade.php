<table>
    <thead>
        <tr>
            <th>Nama Dompet</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ringkasanDompet as $dompet)
            <tr>
                <td>{{ $dompet['nama'] }}</td>
                <td>{{ $dompet['pemasukan'] }}</td>
                <td>{{ $dompet['pengeluaran'] }}</td>
                <td>{{ $dompet['saldo'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
