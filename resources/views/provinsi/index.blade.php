<x-app>
    <div class="container mt-3" x-data>
        <div class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-5" @click.prevent="$store.provinsi.onModalClick()">
                        Tambah
                    </button>

                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="provinsi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Provinsi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-provinsi" @submit.prevent="$store.provinsi.store()">
                        @csrf

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Provinsi</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    x-model="$store.provinsi.prov.name">
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
            Alpine.store('provinsi', {
                prov: {
                    id: '',
                    name: '',
                },
                tableName: 'provinsi',
                moduleName: 'Provinsi',
                _method: 'POST',
                onModalClick(){
                    resetFormFields('form-provinsi');
                    this.resetForm();
                    $('#provinsi-modal').modal('show');
                },
                delete(id){
                    const url = route('provinsi.destroy', { provinsi: id });

                    axiosDelete(url, 'provinsi', 'Provinsi');
                },
                store(){
                    const url = this._method == 'POST' ? route('provinsi.store') : route('provinsi.update', { provinsi: this.prov.id });
                    let data = {
                        name: this.prov.name,
                        method: this._method,
                    };

                    axiosModalPost(url, data, 'provinsi')
                },
                resetForm(){
                    this.prov.id = '';
                    this.prov.name = '';

                    this._method = 'POST';
                },
                edit(prov){
                    resetFormErrorsFields('form-provinsi');
                    this._method = 'PUT';
                    this.setProvinsi(prov);

                    $('#provinsi-modal').modal('show');
                },
                setProvinsi(prov){
                    this.prov.id = prov.id;
                    this.prov.name = prov.name;
                }
    
            })
        })


    </script>
    @endpush

</x-app>