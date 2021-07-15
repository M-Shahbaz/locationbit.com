import React, { useEffect, useRef, useState } from "react";
import dynamic from 'next/dynamic';

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import LocationOnIcon from '@material-ui/icons/LocationOn';
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";

import InfoArea from "components/InfoArea/InfoArea.js";
import Chat from "@material-ui/icons/Chat";
import LocationGridItem from "../../components/Location/LocationGridItem";

const Map = dynamic(
  () => import('../../components/Map/Map'),
  { ssr: false }
);

const useStyles = makeStyles(styles);

export default function LocationAndMapSection(props) {
  const classes = useStyles();
  const { location } = props;

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
            <LocationGridItem
              classes={classes}
              gridItemName="Name"
              gridItemValue={location.name}
            />
            <LocationGridItem
              classes={classes}
              gridItemName="Address"
              gridItemValue={location.address}
            />
            <LocationGridItem
              classes={classes}
              gridItemName="City"
              gridItemValue={location.city}
            />
            <LocationGridItem
              classes={classes}
              gridItemName="State"
              gridItemValue={location.state}
            />
            <LocationGridItem
              classes={classes}
              gridItemName="Country"
              gridItemValue={location.country}
            />
            <LocationGridItem
              classes={classes}
              gridItemName="Postcode"
              gridItemValue={location.postcode}
            />
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
