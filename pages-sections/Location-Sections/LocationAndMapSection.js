import React, { useEffect, useRef, useState, useReducer, useCallback } from "react";
import { useSelector, useDispatch } from 'react-redux';
import dynamic from 'next/dynamic';
import Router from 'next/router';
import Link from "next/link";
import { signIn, signOut, useSession, getSession } from 'next-auth/client';

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import RoomIcon from '@material-ui/icons/Room';

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";


import LocationTableRow from "../../components/Location/LocationTableRow";
import LocationMapContext from './../../store/LocationMapContext'
import LocationMapEdit from './../../components/Location/LocationMapEdit';

const MapDraggable = dynamic(
  () => import('../../components/Map/MapDraggable'),
  { ssr: false }
);

const AdsenseInArticle = dynamic(
  () => import('../../components/Ad/AdsenseInArticle'),
  { ssr: false }
);

const AdsenseBanner = dynamic(
  () => import('../../components/Ad/AdsenseBanner'),
  { ssr: false }
);

const AdsenseSquare = dynamic(
  () => import('../../components/Ad/AdsenseSquare'),
  { ssr: false }
);

const AdsenseVertical = dynamic(
  () => import('../../components/Ad/AdsenseVertical'),
  { ssr: false }
);

import axios from 'axios';
import Loading from '../../components/Loading/Loading';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

import { getLocationSlugUrl, getLocationCommaTrimName } from 'utility/LocationService.js';

const useStyles = makeStyles(styles);
function createData(name, calories, fat, carbs, protein) {
  return { name, calories, fat, carbs, protein };
}

const rows = [
  createData('Frozen yoghurt', 159, 6.0, 24, 4.0),
  createData('Ice cream sandwich', 237, 9.0, 37, 4.3),
  createData('Eclair', 262, 16.0, 24, 6.0),
];

const mapReducer = (state, action) => {
  switch (action.type) {
    case 'DRAGGABLE':
      return {
        draggable: action.value,
        position: state.position
      }
      break;

    case 'POSITION':
      return {
        draggable: state.draggable,
        position: action.value
      }
      break;

    default:
      break;
  }

  return {
    draggable: false,
    position: {
      lat: null,
      lon: null,
    }
  };
};

export default function LocationAndMapSection(props) {
  const classes = useStyles();
  // const { location } = props;
  const location = useSelector((state) => state.location);
  const [session, loading] = useSession();
  const editTrue = session ? true : false;
  const googleMapsPlaceLink = "https://www.google.com/maps/place/" + location.lat + "," + location.lon;

  const [loadingModal, setLoadingModal] = React.useState(false);
  const [mapState, dispatchMap] = useReducer(mapReducer, {
    draggable: false,
    position: {
      lat: location.lat,
      lon: location.lon,
    }
  });

  const onMapChangeHandler = (obj) => {
    // dispatchNaics({type: "DRAGGABLE", value: 786});
    console.log(mapState);
    dispatchMap(obj);
  }

  const onMapSaveHandler = () => {

    let locationUpdateData;
    setLoadingModal(true);
    locationUpdateData = mapState.position;
    axios.post(`/api/location/${location.id}/update`, locationUpdateData)
      .then(res => {
        // console.log(res);
        // console.log(res.data);
        if (res.data.success === "updated") {
          toast.success("updated!", {
            position: "bottom-center",
          });
          Router.reload();
        } else {
          toast.error("Oops! something went wrong... error message: " + res.data.success, {
            position: "bottom-center",
          });
          setLoadingModal(false);
        }
      }).catch(error => {
        // console.log(error);
        toast.error("Oops! something went wrong..." + (error.response.data && error.response.data.error && error.response.data.error), {
          position: "bottom-center",
        });
        setLoadingModal(false);
      });

  }

  // useEffect( () => {
  //   console.log(mapState);
  //   if (mapState.save) {
  //     console.log("save: "+mapState.save);
  //     onMapSaveHandler();
  //   }
  // }, [mapState.save])


  return (
    <>
      <div className={classes.section}>
        <GridContainer justify="center">
          <GridItem xs={12} sm={12} md={8}>
            <h2 className={classes.title}></h2>
            <h5 className={classes.description}>
            </h5>
            <AdsenseBanner />
          </GridItem>
        </GridContainer>
        <div>
          <GridContainer>
            <GridItem xs={12} sm={12} md={6}>
              <TableContainer component={Paper}>
                <Table>
                  <TableHead>
                    <TableRow>
                      <TableCell>Name:</TableCell>
                      <TableCell>{location.name}</TableCell>
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="description"
                      tableRowValue={location.description}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="address"
                      tableRowValue={location.address}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="city"
                      tableRowValue={location.city}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="state"
                      tableRowValue={location.state}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="country"
                      tableRowValue={location.country}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="postcode"
                      tableRowValue={location.postcode}
                      edit={editTrue}
                    />
                    <AdsenseInArticle />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="latitude"
                      tableRowValue={location.lat}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="longitude"
                      tableRowValue={location.lon}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="website"
                      tableRowValue={location.website}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="email"
                      tableRowValue={location.email}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="phone"
                      tableRowValue={location.phone}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="googleMaps"
                      tableRowValue={location.googleMaps}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="googleStreetView"
                      tableRowValue={location.googleStreetView}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="facebook"
                      tableRowValue={location.facebook}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="twitter"
                      tableRowValue={location.twitter}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="instagram"
                      tableRowValue={location.instagram}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="youtube"
                      tableRowValue={location.youtube}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="linkedin"
                      tableRowValue={location.linkedin}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="telegram"
                      tableRowValue={location.telegram}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowValue="timezones"
                      tableRowName="timezones"
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="classification"
                      tableRowValue={location.sector}
                      edit={editTrue}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="hours"
                      tableRowValue={location.hours}
                      edit={editTrue}
                    />
                  </TableBody>
                </Table>
              </TableContainer>
              <AdsenseVertical />
            </GridItem>
            <GridItem xs={12} sm={12} md={6}>
              <LocationMapContext.Provider value={{
                draggable: mapState.draggable,
                position: mapState.position,
                onMapChange: onMapChangeHandler,
                onMapSave: onMapSaveHandler
              }}>
                <AdsenseSquare />
                <div>
                  <a href={googleMapsPlaceLink} target="_blank"><RoomIcon />Goto google maps</a>
                </div>
                <MapDraggable
                  lat={location.lat}
                  lon={location.lon}
                  popup={props.headTitle}
                />
                <LocationMapEdit edit={editTrue} />
                <AdsenseSquare />
              </LocationMapContext.Provider>
              {location.similarLocations && location.similarLocations.results &&
                <TableContainer component={Paper}>
                  <Table>
                    <TableBody>
                      <TableRow>
                        <TableCell>
                          <h3>Similar locations:</h3>
                        </TableCell>
                      </TableRow>
                      {location.similarLocations.results.map((similarLocation) => (
                        <TableRow key={similarLocation.id}>
                          <TableCell>
                            <Link href={getLocationSlugUrl(similarLocation.id, similarLocation)} passHref>
                              <a>{getLocationCommaTrimName([similarLocation.name, similarLocation.address, similarLocation.city, similarLocation.state, similarLocation.country])}</a>
                            </Link>
                          </TableCell>
                        </TableRow>
                      ))}
                    </TableBody>
                  </Table>
                </TableContainer>
              }
              {location.nearbyLocations && location.nearbyLocations.results &&
                <TableContainer component={Paper}>
                  <Table>
                    <TableBody>
                      <TableRow>
                        <TableCell>
                          <h3>Nearby locations:</h3>
                        </TableCell>
                      </TableRow>
                      {location.nearbyLocations.results.map((nearbyLocation) => (
                        <TableRow key={nearbyLocation.id}>
                          <TableCell>
                            <Link href={getLocationSlugUrl(nearbyLocation.id, nearbyLocation)} passHref>
                              <a>{getLocationCommaTrimName([nearbyLocation.name, nearbyLocation.address, nearbyLocation.city, nearbyLocation.state, nearbyLocation.country])}</a>
                            </Link>
                          </TableCell>
                        </TableRow>
                      ))}
                    </TableBody>
                  </Table>
                </TableContainer>
              }
            </GridItem>
          </GridContainer>
        </div >
      </div >
      <ToastContainer />
      <Loading loadingModal={loadingModal} />
    </>
  );
}
