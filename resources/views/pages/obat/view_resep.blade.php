@extends('pages.layout.header')
@section('content')
<div class="row">
    <div class="col-12">
        <div id="load_html"></div>
        <div class="loadPanel"></div>
        <div id="tabpanel"></div>
    </div>
    <div class="col-12">
        <div id="gridResep" class="mt-2 mb-5"></div>
    </div>    
</div>
<script>
    $(function(){

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

        var tabs = [
            {
                title: 'RESEP NON RACIKAN',
                id: 'tab1',
                icon: "fa fa-capsules",
                template: function(itemData, itemIndex, itemElement) {
                    const dom = '1';
                    $(`<div id='load_html${dom}'>`).appendTo(itemElement)
                    loadPage('tab1', dom);
                    return false;
                },
            },
            {
                title: 'RESEP RACIKAN',
                id: 'tab1',
                icon: "fa fa-pills",
                template: function(itemData, itemIndex, itemElement) {
                    const dom = '2';
                    $(`<div id='load_html${dom}'>`).appendTo(itemElement)
                    loadPage('tab2', dom);
                    return false;
                },
            },
        ];
        const tabPanel = $('#tabpanel').dxTabPanel({
            height: "100%",
            items: tabs,
            selectedIndex: 0,
            loop: false,
            animationEnabled: true,
            swipeEnabled: true,
            elementAttr: {
                class:"mb-2"
            }
        }).dxTabPanel('instance');


        function isNotEmpty(value) {
            return value !== undefined && value !== null && value !== '';
        }

        const store = new DevExpress.data.CustomStore({
            key: 'id',
            loadMode:'raw',
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
                url: "{{route('DataResep')}}",
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

        const gridView = $('#gridResep').dxDataGrid({
            dataSource: store,
            showBorders: true,
            remoteOperations: true,
            paging: {
                pageSize: 12,
            },
            editing: {
                allowEditing: false,
                allowDeleting: false,
                allowUpdating: false,
                allowAdding: false,
                useIcons: false,
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [8, 12, 20],
                showInfo: true,
            },
            width: "100%",
            height: "500px",
            columns: [
                {
                    dataField: 'id',
                    caption: 'number',
                    visible: false,
                }, 
                {
                    dataField: 'nama_obat',
                    caption: 'Nama Obat',
                    width: 300,
                }, 
                {
                    dataField: 'jumlah',
                    caption: 'Jumlah Obat',
                    width: 400,
                },
                {
                    dataField: 'nama_signa',
                    caption: 'Nama Obat',
                    width: 400,
                },
                {
                    dataField: 'created',
                    caption: "Tanggal dibuat",
                    width: 200,
                }
            
            ],
        }).dxDataGrid('instance');


        function loadPage(tab, dom) {
            var page = "{{ route('ViewPage', ':page') }}";
            page = page.replace(":page", tab);
            loadPanel.show();
            $.ajax({
                type: "get",
                url: page,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    const element = $(`#load_html${dom}`);
                    console.log(`load_html${dom}`);
                    loadPanel.hide();
                    element.empty();
                    $(response.data).appendTo(element);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                }
            });
        }
    });
</script>
@endsection