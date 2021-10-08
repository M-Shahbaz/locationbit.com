import React, { useState } from "react";
import { Country, State, City } from 'country-state-city';
import { useRouter } from 'next/router';
import { signIn, signOut, useSession, getSession } from 'next-auth/client';
import { leafletLibrary } from 'utility/Libraries.js';

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
import HeaderLayout from 'components/Header/HeaderLayout';
import StatesSection from './../../../pages-sections/Country-Sections/StatesSection';

const useStyles = makeStyles(styles);



const state = (props) => {
  const router = useRouter()
  const { countryCode } = router.query;
  const [session, loading] = useSession();
  const classes = useStyles();
  const country = Country.getCountryByCode(countryCode);
  const headTitle = "States of " + country.name;

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
          <StatesSection 
           headTitle={headTitle}
           countryCode={countryCode}
           />
        </div>
      </div>
      <Footer />
    </>
  );


};


export default state;