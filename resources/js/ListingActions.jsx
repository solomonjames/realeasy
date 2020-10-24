import React from 'react';
import listingsApi from './lib/listings';

function ListingActions(props) {
    const removeCard = () => document.getElementById(`listing-${props.listingId}`).remove();

    const makeIgnored = () => {
        listingsApi.ignore(props.listingId)
            .then(function (response) {
                if (response.status !== 200) {
                    return alert('Shit, something went wrong');
                }

                removeCard();
            });
    };

    const makeSaved = () => {
        listingsApi.save(props.listingId)
            .then(function (response) {
                if (response.status !== 200) {
                    return alert('Shit, something went wrong');
                }

                removeCard();
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
