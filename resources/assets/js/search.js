
if($('.prop-search').length){
    console.log('Searching');
    let propTypes = {
        Home : [
            'House',
            'Flat',
            'Upper Portion',
            'Lower Portion',
            'Farm House',
            'Room',
            'Penthouse'
        ],
        Plots : [
            'Residential Plot',
            'Commercial Plot',
            'Agricultural Land',
            'Industrial Land',
            'Plot File',
            'Plot Form'
        ],
        Commercial : [
            'Office',
            'Shop',
            'Warehouse',
            'Factory',
            'Building',
            'Other'
        ]
    };
    $('#search-type').on('change', function(e){
        renderSearchSubTypes(propTypes, this.value);
    });

    $("#city").on('change', function(e){
        if(this.value.length){
            let city_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/city/locations',
                data : {
                    id : city_id
                },
                success : function(res){
                    if(res.length){
                        renderTowns(res);
                    }else{
                        clearTowns();
                    }
                }
            });
        }
    });
}

function renderSearchSubTypes(props, type){
    clearSearchSubTypes();
    if(type.length){
        $.map(props[type], function(type, index) {
            let $type = `<option value="${type}">${type}</option>`;
            $('#search-sub-type').append($type);
        });
    }
}
function renderTowns(towns) {
    clearTowns();
    $.map(towns, function(town, index) {
        let $town = `<option value="${town.id}">${town.name}</option>`;
        $('#town').append($town);
    });
}

function clearSearchSubTypes() {
    $('#search-sub-type').empty().append('<option value="ANY">ANY</option>');
}

function clearTowns() {
    $('#town').empty().append('<option value="ANY">ANY</option>');
}