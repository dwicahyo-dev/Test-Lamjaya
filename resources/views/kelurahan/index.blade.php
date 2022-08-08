<x-app>
    <div class="container mt-3" x-data>
        <div class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-5" @click.prevent="$store.kelurahan.onModalClick()">
                        Tambah
                    </button>

                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="kelurahan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kelurahan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-kelurahan" @submit.prevent="$store.kelurahan.store()">
                        @csrf

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Kelurahan</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    x-model="$store.kelurahan.kelu.name">
                            </div>

                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="kecamatan_id" id="kecamatan_id"
                                    x-model="$store.kelurahan.kelu.kecamatan_id">
                                    <option value="">-- Please Select --</option>

                                    @forelse ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
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
            Alpine.store('kelurahan', {
                kelu: {
                    id: '',
                    name: '',
                    kecamatan_id: '',
                },
                tableName: 'kelurahan',
                moduleName: 'Kelurahan',
                _method: 'POST',
                onModalClick(){
                    resetFormFields('form-kelurahan');
                    this.resetForm();
                    $('#kelurahan-modal').modal('show');
                },
                delete(id){
                    const url = route('kelurahan.destroy', { kelurahan: id });

                    axiosDelete(url, 'kelurahan', 'kelurahan');
                },
                store(){
                    const url = this._method == 'POST' ? route('kelurahan.store') : route('kelurahan.update', { kelurahan: this.kelu.id });
                    let data = {
                        name: this.kelu.name,
                        kecamatan_id: this.kelu.kecamatan_id,
                        method: this._method,
                    };

                    axiosModalPost(url, data, 'kelurahan')
                },
                resetForm(){
                    this.kelu.id = '';
                    this.kelu.name = '';

                    this._method = 'POST';
                },
                edit(kelu){
                    resetFormErrorsFields('form-kelurahan');
                    this._method = 'PUT';
                    this.setkelurahan(kelu);

                    $('#kelurahan-modal').modal('show');
                },
                setkelurahan(kelu){
                    this.kelu.id = kelu.id;
                    this.kelu.name = kelu.name;
                    this.kelu.kecamatan_id = kelu.kecamatan_id;
                }
    
            })
        })


    </script>
    @endpush

</x-app>