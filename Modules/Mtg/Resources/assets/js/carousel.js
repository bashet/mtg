$(function () {
    $(function () {
        $('.chosen-select').chosen();

        $('#carouselchoose').change(function (e) {
            $.LoadingOverlay('show');
            axios.get('/mtg/get-card-set/' + this.value)
                .then((result) => {
                    $('#carouselExampleControls').html(result.data.carousel);

                    $('#seticon').html('<i class="ss ss-'+ result.data.icon +' ss-grad ss-3x"></i>');
                    $('#acards').html('<em class="h4 text-lt">'+ result.data.available_cards +'</em>');
                    $('#tcards').html('<em class="h4 text-lt">' + result.data.total_cards +'</em>');

                    $('#btn_info').text(1 + ' of ' + result.data.total_cards);
                    $.LoadingOverlay('hide');
                });
        });

        $('#carouselExampleControls').on('slide.bs.carousel', function (e) {
            let target = e.relatedTarget;
            let img = target.getElementsByTagName('img');
            let data = $(img).data();
            $(img).prop('src', data.src);
            let total_cards = $('#tcards').text();
            $('#btn_info').text((e.to + +1) + ' of ' + total_cards);
        });

        $("#carousel_prev").click(function(){
            $("#carouselExampleControls").carousel("prev");
        });
        $("#carousel_next").click(function(){
            $("#carouselExampleControls").carousel("next");
        });


        $('#acards').click(function (e) {
            e.preventDefault();
        });
    });
});