import React, { useState, useEffect } from 'react';
import listingsApi from "./lib/listings";

function ListingActions() {
    const makeIgnored = () => {
        const parent = $(this).parents('.col-md-4');
        const listingId = parent.attr('id').replace('listing-', '');

        listingsApi.ignore(listingId)
            .then(function (response) {
                if (response.status !== 200) {
                    return alert('Shit, something went wrong');
                }

                parent.remove();
            });
    };

    const makeSaved = () => {
        const parent = $(this).parents('.col-md-4');
        const listingId = parent.attr('id').replace('listing-', '');

        listingsApi.save(listingId).then(function (response) {
            if (response.status !== 200) {
                return alert('Shit, something went wrong');
            }

            parent.remove();
        });
    };

    return (
        <div className="btn-group">
            <button type="button"
                    onClick={makeIgnored}
                    className="btn btn-sm btn-outline-secondary bg-danger text-white">Ignore</button>
            <button type="button"
                    onClick={makeSaved}
                    className="btn btn-sm btn-outline-secondary bg-primary text-white">Save</button>
        </div>
    );
}

export default ListingActions;
