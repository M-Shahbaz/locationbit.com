import React, { useEffect, useRef, useState } from "react";
import dynamic from 'next/dynamic';

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import AddLocationIcon from '@material-ui/icons/AddLocation';
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";


const Map = dynamic(
  () => import('../../components/Map/Map'),
  { ssr: false }
);

const useStyles = makeStyles(styles);

export default function LocationMapSection() {
  const classes = useStyles();

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}><AddLocationIcon /> Add location</h2>
          <h5 className={classes.description}>
            Add a location to get tickets and shares to get a chance to earn money and prizes.
          </h5>
          <Map />
        </GridItem>
      </GridContainer>
    </div>
  );
}
