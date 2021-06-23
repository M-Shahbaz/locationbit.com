import React from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import Chat from "@material-ui/icons/Chat";
import VerifiedUser from "@material-ui/icons/VerifiedUser";
import Fingerprint from "@material-ui/icons/Fingerprint";
import AddLocationIcon from '@material-ui/icons/AddLocation';
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import InfoArea from "components/InfoArea/InfoArea.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";
import AutocompleteCountry from "../../components/Autocomplete/AutocompleteCountry";

const useStyles = makeStyles(styles);

export default function LocationAddSection() {
  const classes = useStyles();
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}><AddLocationIcon /> Add location</h2>
          <h5 className={classes.description}>
            Add a location to get tickets and shares to get a chance to earn money and prizes.
          </h5>
        </GridItem>
      </GridContainer>
      <div>
        <GridContainer>
          <GridItem xs={12} sm={12} md={6}>
            <form>
              <GridContainer>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location name"
                    id="name"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location address"
                    id="address"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location zip"
                    id="zip"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <AutocompleteCountry />
                </GridItem>
                <GridItem xs={12} sm={12} md={4} className={classes.textCenter}>
                  <Button color="success"><AddLocationIcon /> Submit</Button>
                </GridItem>
              </GridContainer>
            </form>
          </GridItem>
          <GridItem xs={12} sm={12} md={6}>
            <InfoArea
              title="Verified Users"
              description="Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough."
              icon={VerifiedUser}
              iconColor="success"
              vertical
            />
          </GridItem>
        </GridContainer>
      </div>
    </div>
  );
}
