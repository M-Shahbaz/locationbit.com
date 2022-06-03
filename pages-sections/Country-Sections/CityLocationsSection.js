import React from "react";
import Link from "next/link";
import dynamic from 'next/dynamic';
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
import NavigateNextIcon from '@material-ui/icons/NavigateNext';
import NavigateBeforeIcon from '@material-ui/icons/NavigateBefore';

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/workStyle.js";
import { getLocationSlugUrl, getLocationCommaTrimName } from 'utility/LocationService.js';

const MapMultiple = dynamic(
  () => import('../../components/Map/MapMultiple'),
  { ssr: false }
);


const Ad728x90 = dynamic(
  () => import('../../components/Ad/Ad728x90'),
  { ssr: false }
);


const useStyles = makeStyles(styles);

export default function CityLocationsSection(props) {
  const classes = useStyles();
  const locations = props.locations;
  let nextPage = props.page && props.page > 0 ? props.page : 1;
  nextPage++;
  let previousPage = props.page && props.page > 0 ? props.page : 1;
  previousPage--;

  const mapZoom = 12;
  let mapLocations = [];
  let mapCenter = [];

  if (locations && locations.results) {
    locations.results.forEach(location => {
      if (location.lat && location.lon) {
        mapCenter = [location.lat, location.lon];
        mapLocations.push({
          position: [location.lat, location.lon],
          popup: getLocationCommaTrimName([location.name, location.address, location.city, location.state, location.country])
        });
      }
    });
  }

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={8}>
          <h2 className={classes.title}>{props.headTitle}</h2>
          <h4 className={classes.description}>
          </h4>
          <Ad728x90 />
        </GridItem>
      </GridContainer>
      {locations && locations.results && <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={12}>
          <MapMultiple
            locations={mapLocations}
            center={mapCenter}
            zoom={mapZoom}
            scrollWheelZoom={true}
          />
        </GridItem>
      </GridContainer>
      }
      <div>
        <GridContainer justify="center">
          <GridItem cs={12} sm={12} md={12}>
            <TableContainer component={Paper}>
              <Table>
                <TableBody>
                  {locations && locations.results && locations.results.map((location) => (
                    <TableRow key={location.id}>
                      <TableCell>
                        <Link href={getLocationSlugUrl(location.id, location)} passHref>
                          <a>{getLocationCommaTrimName([location.name, location.address, location.city, location.state, location.country])}</a>
                        </Link>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </TableContainer>
            {locations && locations.results &&
              <TableContainer component={Paper}>
                <Table>
                  <TableBody>
                    <TableRow>
                      <TableCell>
                        {previousPage > 0 && <Link href={props.cityPaginationUrl + previousPage} passHref>
                          <a><NavigateBeforeIcon /> Previous page</a>
                        </Link>
                        }
                      </TableCell>
                      <TableCell>
                        <Link href={props.cityPaginationUrl + nextPage} passHref>
                          <a>Next page <NavigateNextIcon /> </a>
                        </Link>
                      </TableCell>
                    </TableRow>
                  </TableBody>
                </Table>
              </TableContainer>
            }
          </GridItem>
        </GridContainer>
      </div>
    </div>
  );
}
