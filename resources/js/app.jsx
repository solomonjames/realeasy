import React from 'react';
import ReactDOM from 'react-dom';
import Search from './Search';

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

ReactDOM.render(
    <React.StrictMode>
        <Search />
    </React.StrictMode>,
    document.getElementById('searcher')
);
