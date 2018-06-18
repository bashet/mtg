$(function () {

    $('#cart_holder').on('click', '.plus', function () {
        let data = $(this).data();
        let card_id = data.id;

        axios.post('/mtg/update-cart', {
            card_id : card_id, quantity: 'plus'
        }).then((result) => {
            $('#cart_indicator').html(result.data.items);
            $('#cart_holder').html(result.data.cart);
        });

    });

    $('#cart_holder').on('click', '.minus', function () {
        let data = $(this).data();
        let card_id = data.id;

        axios.post('/mtg/update-cart', {
            card_id : card_id, quantity: 'minus'
        }).then((result) => {
            $('#cart_indicator').html(result.data.items);
            $('#cart_holder').html(result.data.cart);
        });

    });


});