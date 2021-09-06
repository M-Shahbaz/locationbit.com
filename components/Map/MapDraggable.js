import React from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import MapDraggableMarker from './MapDraggableMarker';

const MapDraggable = props => {

  const center = {
    lat: props.lat,
    lon: props.lon,
  }
  return (
    <MapContainer center={center} zoom={20} scrollWheelZoom={false} style={{height: "512px"}}>
      <TileLayer
        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      />
      <MapDraggableMarker
        popup={props.popup}
        lat={props.lat}
        lon={props.lon} />
    </MapContainer>
  );

};

export default MapDraggable;
