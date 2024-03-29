import React, { useState, useEffect } from 'react';

function makeBoolFromString(value) {
    return value === 'true';
}

function Search() {
    const urlParams = new URLSearchParams(window.location.search.slice(1));
    const [orderBy, setOrderBy] = useState(urlParams.get('orderBy') || 'price');
    const [saved, setSaved] = useState(makeBoolFromString(urlParams.get('saved')));

    const updateSaved = () => {
        setSaved(! saved);
    };

    const updateOrderBy = (event) => {
        setOrderBy(event.target.value);
    };

    useEffect(() => {
        const updateQueryString = (orderBy, saved, urlParams) => {
            const newUrlParams = new URLSearchParams(window.location.search.slice(1));

            if (orderBy !== newUrlParams.get('orderBy')) {
                newUrlParams.set('orderBy', orderBy);
            }

            if (`${saved}` !== newUrlParams.get('saved')) {
                newUrlParams.set('saved', saved);
            }

            if (urlParams.toString() !== newUrlParams.toString()) {
                window.location.search = newUrlParams.toString();
            }
        };

        updateQueryString(orderBy, saved, urlParams);
    }, [orderBy, saved, urlParams]);

    return (
        <form className="form-inline filters-form">
            <label className="mr-sm-2" htmlFor="selectOrderBy">Order by</label>
            <select id="selectOrderBy" value={orderBy} onChange={updateOrderBy} className="custom-select my-1 mr-sm-2">
                <option value="price">Price</option>
                <option value="listed_on">Listed On</option>
                <option value="created_at">Date added</option>
            </select>

            <div className="form-check form-check-inline">
                <input className="form-check-input" type="checkbox" id="saved" checked={saved} onChange={updateSaved} />
                <label className="form-check-label" htmlFor="saved">Saved</label>
            </div>
        </form>
    );
}

export default Search;
