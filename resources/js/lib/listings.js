import axios from 'axios';

const exports = {};

function updateListing(listingId, data) {
    return axios.patch(`/listing/${listingId}`, data);
}

exports.ignore = function (listingId) {
    return updateListing(listingId, { ignore: true });
}

exports.save = function (listingId) {
    return updateListing(listingId, { saved: true });
}

export default exports;
