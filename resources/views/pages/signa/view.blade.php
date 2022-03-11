@extends('pages.layout.header')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div id="table_signa"></div>
        </div>
    </div>
</div>
<script>

    $(function(){

        function isNotEmpty(value) {
            return value !== undefined && value !== null && value !== '';
        }

        const store = new DevExpress.data.CustomStore({
            key: 'signa_id',
            load(loadOptions) {
            const deferred = $.Deferred();
            const args = {};

            [
                'skip',
                'take',
                'requireTotalCount',
                'requireGroupCount',
                'sort',
                'filter',
                'totalSummary',
                'group',
                'groupSummary',
            ].forEach((i) => {
                if (i in loadOptions && isNotEmpty(loadOptions[i])) {
                args[i] = JSON.stringify(loadOptions[i]);
                }
            });
            $.ajax({
                url: "{{route('DataSigna')}}",
                dataType: 'json',
                data: args,
                success(result) {
                    deferred.resolve(result.data, {
                        totalCount: result.count,
                    });
                },
                error() {
                    deferred.reject('Data Loading Error');
                },
                timeout: 5000,
            });

            return deferred.promise();
            },
        });

        const gridView = $('#table_signa').dxDataGrid({
            dataSource: store,
            showBorders: true,
            remoteOperations: true,
            paging: {
                pageSize: 12,
            },
            editing: {
                allowEditing: true,
                allowDeleting: true,
                allowUpdating: true,
                allowAdding: true,
                useIcons: true,
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [8, 12, 20],
                showInfo: true,
            },
            width: "100%",
            columns: [
                {
                    dataField: 'signa_id',
                    caption: 'number',
                    visible: false,
                }, 
                {
                    dataField: 'signa_kode',
                    caption: 'Kode Obat',
                    width: 300,
                }, 
                {
                    dataField: 'signa_nama',
                    caption: 'Nama Obat',
                    width: 400,
                },
                {
                    dataField: 'created_date',
                    caption: "Tanggal dibuat",
                    width: 200,
                }
            
            ],
        }).dxDataGrid('instance');
    })

</script>

@endsection