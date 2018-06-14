$(function () {
    $(function () {
        $('.chosen-select').chosen();

        $('#carouselchoose').change(function (e) {
            $.LoadingOverlay('show');
            axios.get('/mtg/get-card-set/' + this.value)
                .then((result) => {
                    $('#carouselExampleControls').html(result.data.carousel);
                    $('#seticon').html(result.data.icon);
                    $('#acards').html(result.data.available_cards);
                    $('#tcards').html(result.data.total_cards);
                    $.LoadingOverlay('hide');
                });
        });

        $('#acards').click(function (e) {
            e.preventDefault();
        });
    });
});