import React from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';

const MapMultiple = props => {
  const locations = props.locations;
  const center = props.center;
  const zoom = props.zoom ? props.zoom : 20;
  const scrollWheelZoom = props.scrollWheelZoom ? props.scrollWheelZoom : false;
  const height = props.height ? props.height : "512px";

  return (
    <MapContainer center={center} zoom={zoom} scrollWheelZoom={scrollWheelZoom} style={{ height: height }}>
      <TileLayer
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      />
      {locations.map((location) => (
        <Marker position={location.position}>
          <Popup>
            {location.popup}
          </Popup>
        </Marker>
      ))}
    </MapContainer>
  );
};

export default MapMultiple;
