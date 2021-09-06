import React, { useState, useRef, useMemo, useCallback, useContext, useEffect } from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import LocationMapContext from './../../store/LocationMapContext';

const MapDraggableMarker = props => {

  const center = {
    lat: props.lat,
    lon: props.lon,
  };
  const ctx = useContext(LocationMapContext);
  console.log(ctx);
  console.log(ctx.draggable);

  const [draggable, setDraggable] = useState(ctx.draggable);
  const [position, setPosition] = useState(center)
  const markerRef = useRef(null);

  useEffect(() => {
    setDraggable(ctx.draggable)
  }, [ctx.draggable]);

  const eventHandlers = useMemo(
    () => ({
      dragend() {
        const marker = markerRef.current
        if (marker != null) {
          console.log(marker.getLatLng());
          console.log(marker);
          setPosition(marker.getLatLng());
          ctx.onMapChange({
            type: 'POSITION', value: {
              lat: marker.getLatLng().lat,
              lon: marker.getLatLng().lng
            }
          })
        }
      },
    }),
    [],
  )

  const toggleDraggable = useCallback(() => {
    setDraggable((d) => !d)
  }, [])
  console.log(draggable);
  return (
    <Marker
      draggable={draggable}
      eventHandlers={eventHandlers}
      position={position}
      ref={markerRef}>
      <Popup minWidth={90}>
        {props.popup}
      </Popup>
    </Marker>
  );
};

export default MapDraggableMarker;
