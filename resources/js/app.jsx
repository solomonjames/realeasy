import React from 'react';
import ReactDOM from 'react-dom';
import Search from './Search';
import ListingActions from "./ListingActions";

require('./bootstrap');

ReactDOM.render(
    <React.StrictMode>
        <Search />
    </React.StrictMode>,
    document.getElementById('searcher')
);

const listingActions = document.getElementsByClassName('listing_actions');
for (let i in listingActions) {
    ReactDOM.render(
        <React.StrictMode>
            <ListingActions />
        </React.StrictMode>,
        listingActions[i]
    );
}
