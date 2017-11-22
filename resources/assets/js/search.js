APP.SEARCH = () => {
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

    $("#state").on('change', function(e){
        if(this.value !== 'Any'){
            let state_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/search/cities',
                data : {
                    id : state_id
                },
                success : function(res){
                    if(res.length){
                        renderDropDown('#city', res);
                    }else{
                        clearDropDown('#city');
                    }
                }
            });
        }else{
            clearDropDown('#city');
            clearDropDown('#town');
            clearDropDown('#block');
        }
    });

    $("#city").on('change', function(e){
        if(this.value !== 'Any'){
            let block_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/search/towns',
                data : {
                    id : block_id
                },
                success : function(res){
                    if(res.length){
                        renderDropDown('#town', res);
                    }else{
                        clearDropDown('#town');
                        clearDropDown('#block');
                    }
                }
            });
        }else{
            clearDropDown('#town');
            clearDropDown('#block');
        }
    });

    $("#town").on('change', function(e){
        if(this.value !== 'Any'){
            let  town_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/search/blocks',
                data : {
                    id : town_id
                },
                success : function(res){
                    if(res.length){
                        renderDropDown('#block', res);
                    }else{
                        clearDropDown('#block');
                    }
                }
            });
        }else{
            clearDropDown('#block');
        }
    });
    function renderSearchSubTypes(props, type){
        clearDropDown('#search-sub-type');
        if(type.length){
            $.map(props[type], function(type, index) {
                let $type = `<option value="${type}">${type}</option>`;
                $('#search-sub-type').append($type);
            });
        }
    }

    function renderDropDown($target, data){
        console.log(data);
        $($target).empty().append('<option value="Any">Any</option>');
        $.map(data, function(data, index) {
            let $option = `<option value="${data.id}">${data.name}</option>`;
            $($target).append($option);
        });
    }


    function clearDropDown($target){
        $($target).empty().append('<option value="Any">Any</option>');
    }

    $(document).ready(function(){
        let $search_inputs = [
            '#search-type',
            '#search-sub-type',
            '#state',
            '#city',
            '#town',
            '#block',
        ];

        $.each($search_inputs, function(index, $target){
            $($target).val('Any');
        });
    });
};