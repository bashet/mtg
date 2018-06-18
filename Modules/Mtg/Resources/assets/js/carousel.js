$(function () {
    $(function () {
        $('.chosen-select').chosen();

        $('#carouselchoose').change(function (e) {
            $.LoadingOverlay('show');
            axios.get('/mtg/get-card-set/' + this.value)
                .then((result) => {
                    $('#carouselExampleControls').html(result.data.carousel);

                    $('#seticon').html('<i class="ss ss-'+ result.data.icon +' ss-grad ss-3x"></i>');
                    // $('#acards').html('<em class="h4 text-lt">'+ result.data.available_cards +'</em>');
                    // $('#tcards').html('<em class="h4 text-lt">' + result.data.total_cards +'</em>');

                    $('#btn_info').text(1 + ' of ' + result.data.total_cards);
                    $.LoadingOverlay('hide');
                });
        });

        $('#carouselExampleControls').on('slide.bs.carousel', function (e) {
            let target = e.relatedTarget;
            let img = target.getElementsByTagName('img');
            let data = $(img).data();
            $(img).prop('src', data.src);
            let total_cards = $('#total_cards').val();
            $('#btn_info').text((e.to + +1) + ' of ' + total_cards);
        });

        $("#carousel_prev").click(function(){
            $("#carouselExampleControls").carousel("prev");
        });
        $("#carousel_next").click(function(){
            $("#carouselExampleControls").carousel("next");
        });


        $('#carouselExampleControls').on('click', '.add_to_cart', function (e) {
            e.preventDefault();
            let data = $(this).data();
            axios.post('/mtg/add-to-cart',{
               card_id : data.id
            }).then((result) => {
                if( ! result.data.error){
                    $('#cart_indicator').html(result.data.items);
                    swal('One item has been added to cart!', '', 'success');
                }else{
                    swal('Something went wrong, please try again later!', '', 'error');
                }
            });

        });
    });
});