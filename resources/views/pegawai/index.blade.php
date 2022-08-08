<x-app>
    <div class="container mt-3" x-data>
        <div class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-5" @click.prevent="$store.pegawai.onModalClick()">
                        Tambah
                    </button>

                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="pegawai-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-pegawai" @submit.prevent="$store.pegawai.store()">
                        @csrf

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama pegawai</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    x-model="$store.pegawai.pega.name">
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    x-model="$store.pegawai.pega.tempat_lahir">
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    x-model="$store.pegawai.pega.tanggal_lahir">
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                    x-model="$store.pegawai.pega.jenis_kelamin">
                            </div>

                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama"
                                    x-model="$store.pegawai.pega.agama">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    x-model="$store.pegawai.pega.alamat">
                            </div>

                            <div class="form-group">
                                <label>Kelurahan</label>
                                <select class="form-control" name="kelurahan_id" id="kelurahan_id"
                                    x-model="$store.pegawai.pega.kelurahan_id">
                                    <option value="">-- Please Select --</option>

                                    @forelse ($kelurahans as $kelurahan)
                                    <option value="{{ $kelurahan->id }}">{{ $kelurahan->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="kecamatan_id" id="kecamatan_id"
                                    x-model="$store.pegawai.pega.kecamatan_id">
                                    <option value="">-- Please Select --</option>

                                    @forelse ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi_id" id="provinsi_id"
                                    x-model="$store.pegawai.pega.provinsi_id">
                                    <option value="">-- Please Select --</option>

                                    @forelse ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi_id" id="provinsi_id"
                                    x-model="$store.pegawai.pega.provinsi_id">
                                    <option value="">-- Please Select --</option>

                                    @forelse ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('extraScripts')

    {!! $dataTable->scripts() !!}

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('pegawai', {
                pega: {
                    id: '',
                    name: '',
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    jenis_kelamin: '',
                    agama: '',
                    alamat: '',
                    kelurahan_id: '',
                    kecamatan_id: '',
                    provinsi_id: '',
                },
                tableName: 'pegawai',
                moduleName: 'Pegawai',
                _method: 'POST',
                onModalClick(){
                    resetFormFields('form-pegawai');
                    this.resetForm();
                    $('#pegawai-modal').modal('show');
                },
                delete(id){
                    const url = route('pegawai.destroy', { pegawai: id });

                    axiosDelete(url, 'pegawai', 'pegawai');
                },
                store(){
                    const url = this._method == 'POST' ? route('pegawai.store') : route('pegawai.update', { pegawai: this.pega.id });
                    let data = {
                        name: this.pega.name,
                        tempat_lahir: this.pega.tempat_lahir,
                        tanggal_lahir: this.pega.tanggal_lahir,
                        jenis_kelamin: this.pega.jenis_kelamin,
                        agama: this.pega.agama,
                        alamat: this.pega.alamat,
                        kelurahan_id: this.pega.kelurahan_id,
                        kecamatan_id: this.pega.kecamatan_id,
                        provinsi_id: this.pega.provinsi_id,
                        method: this._method,
                    };

                    axiosModalPost(url, data, 'pegawai')
                },
                resetForm(){
                    this.pega.id = '';
                    this.pega.name = '';
                    this.pega.tempat_lahir = '';
                    this.pega.tanggal_lahir = '';
                    this.pega.jenis_kelamin = '';
                    this.pega.agama = '';
                    this.pega.alamat = '';
                    this.pega.kelurahan_id = '';
                    this.pega.kecamatan_id = '';
                    this.pega.provinsi_id = '';

                    this._method = 'POST';
                },
                edit(pega){
                    resetFormErrorsFields('form-pegawai');
                    this._method = 'PUT';
                    this.setPegawai(pega);

                    $('#pegawai-modal').modal('show');
                },
                setPegawai(pega){
                    this.pega.id = pega.id;
                    this.pega.name = pega.name;
                    this.pega.tempat_lahir = pega.tempat_lahir;
                    this.pega.tanggal_lahir = pega.tanggal_lahir;
                    this.pega.jenis_kelamin = pega.jenis_kelamin;
                    this.pega.agama = pega.agama;
                    this.pega.alamat = pega.alamat;
                    this.pega.kelurahan_id = pega.kelurahan_id;
                    this.pega.kecamatan_id = pega.kecamatan_id;
                    this.pega.provinsi_id = pega.provinsi_id;
                }
    
            })
        })


    </script>
    @endpush

</x-app>