require('./bootstrap');

const ignoreButtons = $('.ignore-button');

ignoreButtons.click(function () {
    const parent = $(this).parents('.col-md-4');
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

const saveButtons = $('.save-button');

saveButtons.click(function () {
    const parent = $(this).parents('.col-md-4');
    const listingId = parent.attr('id').replace('listing-', '');

    console.log(`saved: ${listingId}`);

    window.axios.patch(`/listing/${listingId}`, {
        saved: true,
    }).then(function (response) {
        if (response.status !== 200) {
            return alert('Shit, something went wrong');
        }

        parent.remove();
    });
});

const filtersForm = $('.filters-form');

filtersForm.on('submit', function (e) {
    e.preventDefault();

    const $this = $(this);

    window.location.search = $this.serialize();
});
