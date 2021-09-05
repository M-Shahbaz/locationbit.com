import React, { useEffect, useRef, useState } from "react";
import { useSelector, useDispatch } from 'react-redux';
import dynamic from 'next/dynamic';

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


const Map = dynamic(
  () => import('../../components/Map/Map'),
  { ssr: false }
);

const useStyles = makeStyles(styles);
function createData(name, calories, fat, carbs, protein) {
  return { name, calories, fat, carbs, protein };
}

const rows = [
  createData('Frozen yoghurt', 159, 6.0, 24, 4.0),
  createData('Ice cream sandwich', 237, 9.0, 37, 4.3),
  createData('Eclair', 262, 16.0, 24, 6.0),
];
export default function LocationAndMapSection(props) {
  const classes = useStyles();
  // const { location } = props;
  const location = useSelector((state) => state.location);

  return (
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
            <Map
              lat={location.lat}
              lon={location.lon}
              popup={props.headTitle}
            />
          </GridItem>
        </GridContainer>
      </div >
    </div >
  );
}
