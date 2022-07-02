import React from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/workStyle.js";
import dynamic from 'next/dynamic';

const Ad300x600 = dynamic(
  () => import('../../components/Ad/Ad300x600'),
  { ssr: false }
);

const useStyles = makeStyles(styles);

export default function AboutSection() {
  const classes = useStyles();
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={8}>
          <h2 className={classes.title}>About us</h2>
          <h4 className={classes.description}>
            Locationbit is inspired by LOCATIONARY which was acquired by Apple Inc. in 2013. 
            Locationary (the original idea behind locationbit.com) provided the only platform through which we were able to earn money without investing any money or without any advanced skills.
            Locationbit is to build the "global ENCYCLOPEDIA for locations data" e.g: Wikipedia for Locations.
            With fair compensation to contributors.
          </h4>
        </GridItem>
      </GridContainer>
    </div>
  );
}
