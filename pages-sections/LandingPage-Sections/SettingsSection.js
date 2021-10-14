import React from "react";
import { signIn, signOut, useSession } from 'next-auth/client';
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

export default function SettingsSection() {
  const classes = useStyles();
  const [session, loading] = useSession();
  const name = session && session.user.name;
  const email = session && session.user.email;

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={12}>
          <h2 className={classes.title}>Settings</h2>
          <h4 className={classes.description}>
          </h4>
        </GridItem>
      </GridContainer>
      <GridContainer>
        <GridItem xs={12} sm={12} md={6}>
          <GridItem xs={12} sm={12} md={12}>
            <CustomInput
              id="name"
              success
              formControlProps={{
                fullWidth: true,
              }}
              inputProps={{
                disabled: true,
                value: name,
              }}
            />
          </GridItem>
        </GridItem>
        <GridItem xs={12} sm={12} md={6}>
          <GridItem xs={12} sm={12} md={12}>
            <CustomInput
              id="email"
              success
              formControlProps={{
                fullWidth: true,
              }}
              inputProps={{
                disabled: true,
                value: email
              }}
            />
          </GridItem>
        </GridItem>
      </GridContainer>
    </div >
  );
}
