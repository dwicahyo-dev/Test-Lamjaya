<x-app>
    <div class="container mt-3" x-data>
        <div class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-5" @click.prevent="$store.kecamatan.onModalClick()">
                        Tambah
                    </button>

                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="kecamatan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kecamatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-kecamatan" @submit.prevent="$store.kecamatan.store()">
                        @csrf

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Kecamatan</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    x-model="$store.kecamatan.keca.name">
                            </div>

                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi_id" id="provinsi_id"
                                    x-model="$store.kecamatan.keca.provinsi_id">
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
            Alpine.store('kecamatan', {
                keca: {
                    id: '',
                    name: '',
                    provinsi_id: '',
                },
                tableName: 'kecamatan',
                moduleName: 'Kecamatan',
                _method: 'POST',
                onModalClick(){
                    resetFormFields('form-kecamatan');
                    this.resetForm();
                    $('#kecamatan-modal').modal('show');
                },
                delete(id){
                    const url = route('kecamatan.destroy', { kecamatan: id });

                    axiosDelete(url, 'kecamatan', 'kecamatan');
                },
                store(){
                    const url = this._method == 'POST' ? route('kecamatan.store') : route('kecamatan.update', { kecamatan: this.keca.id });
                    let data = {
                        name: this.keca.name,
                        provinsi_id: this.keca.provinsi_id,
                        method: this._method,
                    };

                    axiosModalPost(url, data, 'kecamatan')
                },
                resetForm(){
                    this.keca.id = '';
                    this.keca.name = '';

                    this._method = 'POST';
                },
                edit(keca){
                    resetFormErrorsFields('form-kecamatan');
                    this._method = 'PUT';
                    this.setKecamatan(keca);

                    $('#kecamatan-modal').modal('show');
                },
                setKecamatan(keca){
                    this.keca.id = keca.id;
                    this.keca.name = keca.name;
                    this.keca.provinsi_id = keca.provinsi_id;
                }
    
            })
        })


    </script>
    @endpush

</x-app>