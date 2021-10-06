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

const useStyles = makeStyles(styles);

export default function AboutSection() {
  const classes = useStyles();
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={8}>
          <h2 className={classes.title}>About us</h2>
          <h4 className={classes.description}>
            Inspired by LOCATIONARY which was acquired by Apple Inc. in 2013. 
            During our under graduation, we were looking online to earn. 
            Locationary (the original idea behind locationbit.com) was the only platform through which we was able to earn without investing any money or without any advanced skills.
            Locationbit is to build the "global decentralized ENCYCLOPEDIA for locations data" on Blockchain e.g: Wikipedia for Locations.
            With fair compensation to contributors.
          </h4>
        </GridItem>
      </GridContainer>
    </div>
  );
}
