<div class="row">
    {{-- <div class="col-12 mt-4"  style="padding-left: 50px; padding-right: 50px">
        <form id="form-confirm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-10">
                    <div class="form-group mb-3">
                        <label for="username">Nama Resep</label>
                        <input type="text" required class="form-control" name="metavalue[]"
                        placeholder="Username" autofocus id="username">
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="row after-add-more control-group">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="username">Jenis Obat</label>
                                <select name="jenis_obat[]" id="metakey" class="form-control">
                                    <option value="username">USERNAME</option>
                                    <option value="password">PASSWORD</option>
                                    <option value="link_a">LINK ADMIN</option>
                                    <option value="link_p">LINK PESERTA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="username">Jumlah Obat</label>
                                <input type="text" required class="form-control" name="metavalue[]"
                                placeholder="Username" autofocus id="username">
                            </div>
                        </div>
                         <div class="col-md-2 col-12">
                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-primary add-more"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" id="kirimbutton">
                <div class="d-flex justify-content-between">
                    <div class="spinner-border spinner-border-sm mt-1 me-1" id="spinbutton" role="status" aria-hidden="true"></div>
                    <div class="ml-5">Simpan</div>
                    {{-- <i class="ri-save-line ml-1"></i> --}}
                {{-- </div>
            </button>
        </form>
    </div>
    <div class="copy invisible mt-3">
        <div class="row control-group">
            <div class="col-md-5 col-12">
                <div class="form-group">
                    <label for="username">Meta Title</label>
                    <select name="metakey[]" id="metakey" class="form-control">
                        <option value="username">USERNAME</option>
                        <option value="password">PASSWORD</option>
                        <option value="link_a">LINK ADMIN</option>
                        <option value="link_p">LINK PESERTA</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="form-group">
                    <label for="username">Meta Value</label>
                    <input type="text" required class="form-control" name="metavalue[]"
                    placeholder="Username" autofocus id="username">
                </div>
            </div>
            <div class="col-md-2 col-12 mt-3 p-1 pl-3">
                <div class="form-group">
                    <button type="button" class="btn btn-danger remove"><i class="fas fa-trash"></i></button> 
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="col-12 mt-4"  style="padding-left: 50px; padding-right: 50px">
        <div class="loadPanel2"></div>
        <form id="form2"></form>
    </div>
</div>
<script>
    $(function() {

        const Spinner = $('#spinbutton');
        Spinner.hide();
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });

        const employee = [''];
        const JumlahObat = [''];
        const loadPanel = $('.loadPanel2').dxLoadPanel({
            shadingColor: 'rgba(0,0,0,0.4)',
            position: {
                my: 'middle center',
                at: 'middle center',
                of: "#barcode",
                offset: '0 0'
            },
            visible: false,
            showIndicator: true,
            showPane: true,
            shading: true,
            closeOnOutsideClick: false
        }).dxLoadPanel('instance');

        const selectBox2 = $('')


        const dataObat = new DevExpress.data.CustomStore({
            key: 'obatalkes_id',
            loadMode:"raw",
            load(loadOptions) {
                const deferred = $.Deferred();
                loadPanel.show();
                $.ajax({
                    url: "{{route('AllObat')}}",
                    dataType: 'json',
                    success(result) {
                        loadPanel.hide();
                        deferred.resolve(result.data);
                    },
                    error() {
                        deferred.reject('Data Loading Error');
                    },
                    timeout: 5000,
                });
                return deferred.promise();
            },
        });

        const dataSigna = new DevExpress.data.CustomStore({
            key: 'signa_kode',
            loadMode:"raw",
            load(loadOptions) {
                const deferred = $.Deferred();
                loadPanel.show();
                $.ajax({
                    url: "{{route('AllSigna')}}",
                    dataType: 'json',
                    success(result) {
                        loadPanel.hide();
                        deferred.resolve(result.data);
                    },
                    error() {
                        deferred.reject('Data Loading Error');
                    },
                    timeout: 5000,
                });
                return deferred.promise();
            },
        });


        const form2 = $('#form2').dxForm({
            colCount: 1,
            formData: null,
            labelLocation: 'top',
            useMaskBehavior: true,
            showColonAfterLabel: true,
            showValidationSummary: true,
            items: [
                {
                    colSpan: 2,
                    dataField: "nama_resep",
                    caption: "Nama Resep",
                    editorOptions:{
                        placeholder: "Masukan nama resep...",
                        elementAttr:{
                            class:"mt-2"
                        },
                    },
                    validationRules: [
                        {
                            type: 'required',
                            message: 'Nama resep wajib di isi!',
                        }, 
                    ],
                },
                {
                    colCount: 1,
                    itemType: 'group',
                    caption: 'Racikan Obat',
                    name: 'nama-obat',
                    items: [
                    {
                        colCount: 2,
                        itemType: 'group',
                        name: 'obat',
                        items: getPhonesOptions(employee),
                    },
                    {
                        itemType: 'button',
                        horizontalAlignment: 'left',
                        cssClass: 'add-phone-button',
                        buttonOptions: {
                        icon: 'add',
                        text: 'Add Nama Obat',
                        onClick() {
                            employee.push('');
                            form2.itemOption('nama-obat.obat', 'items', getPhonesOptions(employee));
                        },
                        },
                    },
                    ],
                },
                {
                    colCount: 1,
                    itemType: 'group',
                    caption: 'Jumlah Obat',
                    name: 'obat-container',
                    items: [
                    {
                        colCount: 2,
                        itemType: 'group',
                        name: 'jumlah',
                        items: getJumlahObat(JumlahObat),
                    },
                    {
                        itemType: 'button',
                        horizontalAlignment: 'left',
                        cssClass: 'add-phone-button',
                        buttonOptions: {
                                icon: 'add',
                                text: 'Add Jumlah Obat',
                                onClick() {
                                    JumlahObat.push('');
                                    form2.itemOption('obat-container.jumlah', 'items', getJumlahObat(JumlahObat));
                                },
                            },
                        },
                    ],
                },
                {
                    colSpan: 2,
                    dataField: "signa",
                    editorType:"dxSelectBox",
                    caption:"Signa/Keterangan Obat",
                    editorOptions:{
                        placeholder:"-- Pilih Signa --",
                        dataSource: dataSigna,
                        displayExpr: 'signa_nama',
                        valueExpr: 'signa_kode',
                        searchEnabled: true,

                    },
                    validationRules: [
                        {
                            type: 'required',
                            message: 'Signa obat wajib di isi!',
                        }, 
                    ],
                },
                {
                    colSpan: 1,
                    editorType:"dxButton",
                    editorOptions:{
                        type:"default",
                        icon: "fas fa-save",
                        text:"Simpan Resep",
                        useSubmitBehavior: true,
                    }  
                },
            ]
        }).dxForm('instance');


        $("#form2").submit(function(e){
            const formData = $("#form2").dxForm('instance');
            const data = formData.option('formData');
            const validate = formData.validate();
            if(validate.isValid === false){
                return false;
            }
            e.preventDefault();
            loadPanel.show();
            $.ajax({
                type: "POST",
                url: "{{route('SimpanResep')}}",
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                    loadPanel.hide();
                    
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert(jqXHR.responseText);
                }
            });
        });


        function getPhonesOptions(phones) {
            const options = [];
            for (let i = 0; i < phones.length; i += 1) {
                options.push(generateNewPhoneOptions(i));
            }
            return options;
        }

        function generateNewPhoneOptions(index) {
            return {
                    dataField: `nama_obat[${index}]`,
                    editorType: "dxSelectBox",
                    editorOptions:{
                        placeholder:"-- Pilih Obat --",
                        dataSource: dataObat,
                        displayExpr: 'obatalkes_nama',
                        valueExpr: 'obatalkes_id',
                        searchEnabled: true,
                        showClearButton: true,
                        itemTemplate(data) {
                            return `<div class='custom-item'>${
                                data.obatalkes_nama}<div class='product-name'>Stok ${
                                data.stok}</div></div>`;
                        },
                        buttons: [{
                            name: 'trash',
                            location: 'after',
                            options: {
                                stylingMode: 'text',
                                icon: 'trash',
                                onClick() {
                                employee.splice(index, 1);
                                form2.itemOption('nama-obat.obat', 'items', getPhonesOptions(employee));
                                },
                            },
                        }],
                    },
                    validationRules: [
                        {
                            type: 'required',
                            message: 'Obat wajib di isi!',
                        }, 
                    ],
            };
            
        }

        function getJumlahObat(jml) {
            const option = [];
            for (let i = 0; i < jml.length; i += 1) {
                option.push(generateJumlahObat(i));
            }
            return option;
        } 


        function generateJumlahObat(index){

            return{
                dataField: `jumlah_obat[${index}]`,
                caption: "Jumlah Obat",
                editorOptions:{
                    placeholder:"Masukan jumlah obat...",
                    buttons: [{
                    name: 'trash',
                    location: 'after',
                    options: {
                        stylingMode: 'text',
                        icon: 'trash',
                        onClick() {
                            JumlahObat.splice(index, 1);
                            form2.itemOption('obat-container.jumlah', 'items', getJumlahObat(JumlahObat));
                        },
                    },
                }],
                },
                validationRules: [
                    {
                        type: 'required',
                        message: 'Quantity obat wajib di isi!',
                    }, 
                ],
            };
        }
    });
</script>