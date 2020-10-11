require('./bootstrap');

const ignoreButtons = $('.ignore-button');

ignoreButtons.click(function (e) {
    const parent = $(e).parent('.single-top-properties');

    console.log(parent.attr('id'));
});
