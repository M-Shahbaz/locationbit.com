import React, { useEffect, useRef, useState, useReducer, useCallback } from "react";
import { Country, State, City } from 'country-state-city';
import Link from "next/link";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";

const Ad728x90 = dynamic(
  () => import('../../components/Ad/Ad728x90'),
  { ssr: false }
);

const useStyles = makeStyles(styles);

export default function CitySection(props) {
  const classes = useStyles();

  const cities = City.getCitiesOfState(props.countryCode, props.stateCode);



  return (
    <>
      <div className={classes.section}>
        <GridContainer justify="center">
          <GridItem xs={12} sm={12} md={8}>
            <h2 className={classes.title}>{props.headTitle}</h2>
            <h5 className={classes.description}>
            </h5>
            <Ad728x90 />
          </GridItem>
        </GridContainer>
        <div>
          <GridContainer spacing={3}>
              {cities.map((city, index) => (
                <GridItem key={index} xs={6} sm={4} md={3}>
                    <Link href={`/country/${props.countryCode}/${props.stateCode}/${city.name}`} passHref>
                      <a>{city.name}</a>
                    </Link>
                </GridItem>
              ))}
          </GridContainer>
        </div >
      </div >
    </>
  );
}
