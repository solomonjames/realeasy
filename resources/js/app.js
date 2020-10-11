require('./bootstrap');

const ignoreButtons = $('.ignore-button');

ignoreButtons.click(function () {
    const parent = $(this).parents('.single-top-properties');
    const listingId = parent.attr('id').replace('listing-', '');

    console.log(listingId);
});
