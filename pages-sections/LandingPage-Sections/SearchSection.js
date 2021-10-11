import React from "react";
import Link from "next/link";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import TableContainer from '@material-ui/core/TableContainer';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/workStyle.js";
import { getLocationSlugUrl } from 'utility/LocationService.js';

const useStyles = makeStyles(styles);

export default function SearchSection(props) {
  const classes = useStyles();
  const locations = props.locations;
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={8}>
          <h2 className={classes.title}>{props.headTitle}</h2>
          <h4 className={classes.description}>
          </h4>
        </GridItem>
      </GridContainer>
      <GridContainer justify="flex-start">
        <GridItem cs={12} sm={12} md={12}>
          <TableContainer component={Paper}>
            <Table>
              <TableBody>
                {locations.results.map((location) => (
                  <TableRow key={location.id}>
                    <TableCell>
                      <Link href={getLocationSlugUrl(location.id,location)}>
                        <a>{location.name}, {location.address}, {location.city}, {location.state}, {location.country}</a>
                      </Link>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </GridItem>
      </GridContainer>
    </div>
  );
}
