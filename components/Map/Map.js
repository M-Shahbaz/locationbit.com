import React from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';

const Map = props => {
  const latitude = props.lat;
  const longitude = props.lon;

  return (
    <MapContainer center={[latitude, longitude]} zoom={20} scrollWheelZoom={false} style={{height: "512px"}}>
      <TileLayer
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      />
      <Marker position={[latitude, longitude]}>
        <Popup>
          {props.popup}
        </Popup>
      </Marker>
    </MapContainer>
  );
};

export default Map;
