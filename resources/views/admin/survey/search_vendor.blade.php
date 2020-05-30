<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemilik</th>
                <th>Vendor</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($company as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->user->phone }}</td>
                    <td>{{ $item->address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning" role="alert">
                            Tidak Ada Vendor Yang Sesuai Dengan Survey Anda!
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>