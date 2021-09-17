import React, { useEffect, useRef, useState, useReducer, useCallback } from "react";
import { useSelector, useDispatch } from 'react-redux';
import dynamic from 'next/dynamic';
import Router from 'next/router'

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

// @material-ui/icons
import LocationOnIcon from '@material-ui/icons/LocationOn';
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";

import InfoArea from "components/InfoArea/InfoArea.js";
import Chat from "@material-ui/icons/Chat";
import LocationGridItem from "../../components/Location/LocationGridItem";
import LocationGridItemWebsite from "../../components/Location/LocationGridItemWebsite";
import LocationTableRow from "../../components/Location/LocationTableRow";
import LocationMapContext from './../../store/LocationMapContext'
import LocationMapEdit from './../../components/Location/LocationMapEdit';

const MapDraggable = dynamic(
  () => import('../../components/Map/MapDraggable'),
  { ssr: false }
);

import axios from 'axios';
import Loading from '../../components/Loading/Loading';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { ucfirst } from './../../utility/FunctionsService';

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
        console.log(res);
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
        console.log(error);
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
                      edit={true}
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
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="website"
                      tableRowValue={location.website}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="email"
                      tableRowValue={location.email}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="phone"
                      tableRowValue={location.phone}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="facebook"
                      tableRowValue={location.facebook}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="twitter"
                      tableRowValue={location.twitter}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="instagram"
                      tableRowValue={location.instagram}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="youtube"
                      tableRowValue={location.youtube}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="linkedin"
                      tableRowValue={location.linkedin}
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="telegram"
                      tableRowValue={location.telegram}
                      edit={true}
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
                      edit={true}
                    />
                    <LocationTableRow
                      locationId={location.id}
                      tableRowName="hours"
                      tableRowValue={location.hours}
                      edit={true}
                    />
                  </TableBody>
                </Table>
              </TableContainer>
            </GridItem>
            <GridItem xs={12} sm={12} md={6}>
              <LocationMapContext.Provider value={{
                draggable: mapState.draggable,
                position: mapState.position,
                onMapChange: onMapChangeHandler,
                onMapSave: onMapSaveHandler
              }}>
                <MapDraggable
                  lat={location.lat}
                  lon={location.lon}
                  popup={props.headTitle}
                />
                <LocationMapEdit edit={true} />
              </LocationMapContext.Provider>
            </GridItem>
          </GridContainer>
        </div >
      </div >
      <ToastContainer />
      <Loading loadingModal={loadingModal} />
    </>
  );
}
