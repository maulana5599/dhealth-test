<div class="row">
    <div class="col-12 mt-4"  style="padding-left: 50px; padding-right: 50px">
        <div class="loadPanel"></div>
        <form id="form"></form>
    </div>
</div>
<script>
    $(function() {
        const loadPanel = $('.loadPanel').dxLoadPanel({
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


        const form = $('#form').dxForm({
            colCount: 1,
            formData: null,
            labelLocation: 'top',
            useMaskBehavior: true,
            showColonAfterLabel: true,
            showValidationSummary: true,
            items: [
                {
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
                    dataField: "nama_obat",
                    editorType:"dxSelectBox",
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

                    },
                    validationRules: [
                        {
                            type: 'required',
                            message: 'Obat wajib di isi!',
                        }, 
                    ],
                },
                {
                    dataField: "jumlah_obat",
                    caption: "Jumlah Obat",
                    editorOptions:{
                        placeholder:"Masukan jumlah obat..."
                    },
                    validationRules: [
                        {
                            type: 'required',
                            message: 'Quantity obat wajib di isi!',
                        }, 
                    ],
                    
                },
                {
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


        $("#form").submit(function(e){
            const formData = $("form").dxForm('instance');
            const data = formData.option('formData');
            const validate = formData.validate();
            if(validate.isValid === false){
                return false;
            }
            e.preventDefault();
            loadPanel.show();
            $.ajax({
                type: "POST",
                url: "{{route('SimpanResepNon')}}",
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

            
        })
       

    });
</script>