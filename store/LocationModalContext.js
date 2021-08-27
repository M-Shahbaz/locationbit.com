import React from 'react';

const LocationModalContext = React.createContext({
    sector: null,
    subSector: null,
    industryGroup: null,
    naicsIndustry: null,
    nationalIndustry:null
});

export default LocationModalContext;
