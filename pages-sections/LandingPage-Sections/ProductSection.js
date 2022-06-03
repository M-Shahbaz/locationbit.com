import React from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import Chat from "@material-ui/icons/Chat";
import LocationOnIcon from '@material-ui/icons/LocationOn';
import MonetizationOnIcon from '@material-ui/icons/MonetizationOn';
import BuildIcon from '@material-ui/icons/Build';
import VerifiedUser from "@material-ui/icons/VerifiedUser";
import Fingerprint from "@material-ui/icons/Fingerprint";
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import InfoArea from "components/InfoArea/InfoArea.js";
import dynamic from 'next/dynamic';

const Ad728x90 = dynamic(
  () => import('../../components/Ad/Ad728x90'),
  { ssr: false }
);

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";

const useStyles = makeStyles(styles);

export default function ProductSection() {
  const classes = useStyles();
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <Ad728x90 />
          <h2 className={classes.title}>Let{"'"}s talk locationbit</h2>
          <h5 className={classes.description}>
            Locationbit is to build the "global decentralized ENCYCLOPEDIA for locations data" on Blockchain e.g: Wikipedia for Locations.
            With fair compensation to contributors.
          </h5>
        </GridItem>
      </GridContainer>
      <div>
        <GridContainer>
          <GridItem xs={12} sm={12} md={4}>
            <InfoArea
              title="Free Location Data"
              description="Locationbit will have a meaningful data of local businesses and locations on blockchain while any third party get a free way to access the world's location data."
              icon={LocationOnIcon}
              iconColor="info"
              vertical
            />
          </GridItem>
          <GridItem xs={12} sm={12} md={4}>
            <InfoArea
              title="Incentivization"
              description="Users will get incentives in a fair way for their  contributions."
              icon={MonetizationOnIcon}
              iconColor="success"
              vertical
            />
          </GridItem>
          <GridItem xs={12} sm={12} md={4}>
            <InfoArea
              title="Applications"
              description="Businesses can access data for free and integrate in their services like ride hailing or access data for research purposes."
              icon={BuildIcon}
              iconColor="danger"
              vertical
            />
          </GridItem>
        </GridContainer>
      </div>
    </div>
  );
}
