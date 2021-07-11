import React from "react";
import { useRouter } from 'next/router';
import { signIn, signOut, useSession, getSession } from 'next-auth/client';
import { getLocationUrl } from 'utility/LocationService.js';
import { leafletLibrary } from 'utility/Libraries.js';

import NoSsr from '@material-ui/core/NoSsr';
import Head from "next/head";


// nodejs library that concatenates classes
import classNames from "classnames";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import Footer from "components/Footer/Footer.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import LocationMapSection from "pages-sections/Location-Sections/LocationMapSection.js";
import WorkSection from "pages-sections/LandingPage-Sections/WorkSection.js";
import HeaderLayout from 'components/Header/HeaderLayout';

const useStyles = makeStyles(styles);



const locationTitle = (props) => {
  const router = useRouter()
  const { locationId, locationTitle } = router.query;
  const [session, loading] = useSession();
  const classes = useStyles();
  const { location } = props;

  const headTitle = location.name + ", " + location.address + ", " + location.city + ", " + location.state + ", " + location.country;

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  // return <p>locationTitle: {locationId} {urlslug} {locationTitle} {props.locationId}</p>;

  return (
    <>
      <Head>
        <title>{headTitle}</title>
        <meta property="og:title" content={headTitle} key="title" />
        <link rel="stylesheet" href={leafletLibrary}
          crossOrigin="" />
      </Head>
      <HeaderLayout />
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <LocationMapSection 
           lat={location.lat} lon={location.lon}
           headTitle={headTitle}
           />
        </div>
      </div>
      <Footer />
    </>
  );


};


export async function getServerSideProps(context) {
  const req = context.req;
  const res = context.res;
  const { params } = context;
  const locationId = params.locationId;
  const locationTitle = params.locationTitle;
  // fetch data from an api
  // fetch data from an api
  return await getLocationUrl('/api/server/location/' + locationId, locationId, locationTitle).then( response => {
    return response;
  }); 

}


export default locationTitle;
