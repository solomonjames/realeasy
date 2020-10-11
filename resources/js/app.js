require('./bootstrap');

const ignoreButtons = $('.ignore-button');

ignoreButtons.click(function () {
    const parent = $(this).parent('.single-top-properties');

    console.log(parent.attr('id'));
});
