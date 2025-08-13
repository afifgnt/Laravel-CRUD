@extends('tabel')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <h3 class="card-header">Halaman Data Santri</h3>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Data</button>
                <table id="siswas" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                data-id="{{ $item->id }}" 
                                data-namasiswa="{{ $item->name }}"
                                data-alamat="{{ $item->alamat }}"
                                data-kelas="{{ $item->kelas }}"
                                data-nisn="{{ $item->nisn }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                {!! Form::open(['route' => [$routePrefix . '.destroy', $item->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Ingin hapus data ini?")', 'style' => 'display:inline-block;']) !!}
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Data Tidak Ada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route($routePrefix . '.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="createNamaSiswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="createNamaSiswa" name="name" placeholder="Nama Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="createNamaAlamat">Alamat</label>
                        <input type="text" class="form-control" id="createNamaAlamat" name="alamat" placeholder="Alamat Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="createNamaKelas">Kelas</label>
                        <input type="text" class="form-control" id="createNamaKelas" name="kelas" placeholder="Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="createNamaNisn">NISN</label>
                        <input type="text" class="form-control" id="createNamaNisn" name="nisn" placeholder="NISN" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">
                    <div class="form-group">
                        <label for="editNamaSiswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="editNamaSiswa" name="name" placeholder="Nama Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="editNamaAlamat">Alamat</label>
                        <input type="text" class="form-control" id="editNamaAlamat" name="alamat" placeholder="Alamat Siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="editNamaKelas">Kelas</label>
                        <input type="text" class="form-control" id="editNamaKelas" name="kelas" placeholder="Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="editNamaNisn">NISN</label>
                        <input type="text" class="form-control" id="editNamaNisn" name="nisn" placeholder="NISN" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#siswas').DataTable();

    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id'); 
        var namasiswa = button.data('namasiswa');
        var alamat = button.data('alamat');
        var kelas = button.data('kelas');
        var nisn = button.data('nisn');

        console.log("ID:", id); 
       
        var modal = $(this);
        modal.find('#editId').val(id);
        modal.find('#editNamaSiswa').val(namasiswa);
        modal.find('#editNamaAlamat').val(alamat);
        modal.find('#editNamaKelas').val(kelas);
        modal.find('#editNamaNisn').val(nisn);
                
        var formAction = "{{ route($routePrefix . '.update', '') }}/" + id;
        $('#editForm').attr('action', formAction);
    });

    $('#createModal').on('show.bs.modal', function () {
        $('#createForm').trigger("reset");
    });
});
</script>
@endpush
