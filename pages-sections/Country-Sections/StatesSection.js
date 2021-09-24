import React, { useEffect, useRef, useState, useReducer, useCallback } from "react";
import { Country, State, City } from 'country-state-city';
import Link from "next/link";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";


const useStyles = makeStyles(styles);

export default function StatesSection(props) {
  const classes = useStyles();

  const states = State.getStatesOfCountry(props.countryCode);



  return (
    <>
      <div className={classes.section}>
        <GridContainer justify="center">
          <GridItem xs={12} sm={12} md={8}>
            <h2 className={classes.title}>{props.headTitle}</h2>
            <h5 className={classes.description}>
            </h5>
          </GridItem>
        </GridContainer>
        <div>
          <GridContainer spacing={3}>
              {states.map((state) => (
                <GridItem key={state.isoCode} xs={6} sm={4} md={3}>
                    <Link href={`/country/${props.countryCode}/${state.isoCode}`}>
                      <a>{state.name}</a>
                    </Link>
                </GridItem>
              ))}
          </GridContainer>
        </div >
      </div >
    </>
  );
}