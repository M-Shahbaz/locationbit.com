import React from 'react';

const LocationMapContext = React.createContext({
  draggable: false,
  position: {
    lat: null,
    lon: null,
  }
});

export default LocationMapContext;
