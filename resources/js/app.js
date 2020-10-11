require('./bootstrap');

const ignoreButtons = $('.ignore-button');

ignoreButtons.click(function () {
    const parent = $(this).parents('.single-top-properties');
    const listingId = parent.attr('id').replace('listing-', '');

    window.axios.patch(`/listing/${listingId}`, {
        ignore: true,
    }).then(function (response) {
        if (response.status !== 200) {
            return alert('Shit, something went wrong');
        }

        parent.remove();
    });
});
