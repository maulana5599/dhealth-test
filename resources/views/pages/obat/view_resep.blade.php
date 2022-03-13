@extends('pages.layout.header')
@section('content')
<div class="col-12">
    <div id="load_html"></div>
    <div class="loadPanel"></div>
    <div id="tabpanel"></div>
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
            elementAttr: {
                class: "mb-5"
            },
            items: tabs,
            selectedIndex: 0,
            loop: false,
            animationEnabled: true,
            swipeEnabled: true,
        }).dxTabPanel('instance');


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