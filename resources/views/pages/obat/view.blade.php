@extends('pages.layout.header')
@section('content')
<div class="col-12">
    <h5 class="text-nunito">MASTER OBAT</h5>
    <div class="card">
        <div class="card-body">
            <div id="myTable"></div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== '';
    }

    const store = new DevExpress.data.CustomStore({
        key: 'obatalkes_id',
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
            url: "{{route('DataObat')}}",
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

    const gridView =  $('#myTable').dxDataGrid({
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
                    dataField: 'obatalkes_id',
                    caption: 'number',
                    visible: false,
                }, 
                {
                    dataField: 'obatalkes_kode',
                    caption: 'Kode Obat',
                    width: 300,
                }, 
                {
                    dataField: 'obatalkes_nama',
                    caption: 'Nama Obat',
                    width: 400,
                },
                {
                    dataField: 'stok',
                    caption: "Stok Obat",
                    width: 200,
                },
                {
                    dataField: 'created_date',
                    caption: "Tanggal dibuat",
                    width: 200,
                }
            
            ],
        }).dxDataGrid('instance');
    });
</script>
@endsection