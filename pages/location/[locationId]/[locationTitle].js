import React, { useState } from "react";
import { useSelector, useDispatch } from 'react-redux'
import { useRouter } from 'next/router';
import { signIn, signOut, useSession, getSession } from 'next-auth/client';
import { getLocationUrl, getLocationCommaTrimName } from 'utility/LocationService.js';
import { leafletLibrary } from 'utility/Libraries.js';

import NoSsr from '@material-ui/core/NoSsr';
import Head from "next/head";
import { NextSeo } from 'next-seo';

// nodejs library that concatenates classes
import classNames from "classnames";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import Footer from "components/Footer/Footer.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import LocationAndMapSection from "pages-sections/Location-Sections/LocationAndMapSection.js";
import WorkSection from "pages-sections/LandingPage-Sections/WorkSection.js";
import HeaderLayout from 'components/Header/HeaderLayout';

const useStyles = makeStyles(styles);



const locationTitle = (props) => {
  const router = useRouter()
  const { locationId, locationTitle } = router.query;
  const [session, loading] = useSession();
  const classes = useStyles();
  const [location, setLocation] = useState(props.location);
  const dispatch = useDispatch();
  const locationDispatch = () =>
    dispatch({
      type: 'LOCATION', location: location
    });
  locationDispatch();

  const headTitle = getLocationCommaTrimName([location.name , location.address , location.city , location.state , location.country]);

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  // return <p>locationTitle: {locationId} {urlslug} {locationTitle} {props.locationId}</p>;

  return (
    <>
      <Head>
        <link rel="stylesheet" href={leafletLibrary}
          crossOrigin="" />
      </Head>
      <NextSeo
        title={headTitle}
        openGraph={{
          title: headTitle
        }}
        twitter={{
          handle: '@LocationBit',
        }}
      />
      <HeaderLayout />
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <LocationAndMapSection
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
  return await getLocationUrl('/api/server/location/' + Buffer.from(locationId).toString('base64'), encodeURIComponent(locationId), locationTitle).then(response => {
    return response;
  });

}


export default locationTitle;
