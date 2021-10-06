import React, { useState } from "react";
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
import CountriesSection from './../../pages-sections/Country-Sections/CountriesSection';

const useStyles = makeStyles(styles);



const country = (props) => {
  const router = useRouter()
  const { locationId, locationTitle } = router.query;
  const [session, loading] = useSession();
  const classes = useStyles();

  const headTitle = "Countries | Locationbit.com";

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
          <CountriesSection 
           headTitle={headTitle}
           />
        </div>
      </div>
      <Footer />
    </>
  );


};


export default country;
