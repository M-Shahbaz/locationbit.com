import React, { useState } from "react";
import { Country, State, City } from 'country-state-city';
import { useRouter } from 'next/router';
import { signIn, signOut, useSession, getSession } from 'next-auth/client';
import { leafletLibrary } from 'utility/Libraries.js';

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
import HeaderLayout from 'components/Header/HeaderLayout';
import CitiesSection from './../../../../pages-sections/Country-Sections/CitiesSection';

const useStyles = makeStyles(styles);



const state = (props) => {
  const router = useRouter()
  const { countryCode, stateCode } = router.query;
  const [session, loading] = useSession();
  const classes = useStyles();

  const country = Country.getCountryByCode(countryCode);
  const state = State.getStateByCodeAndCountry(stateCode, countryCode);

  const headTitle = "Cities of " + state.name + ", " + country.name;

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
          <CitiesSection
            headTitle={headTitle}
            countryCode={countryCode}
            stateCode={stateCode}
          />
        </div>
      </div>
      <Footer />
    </>
  );


};


export default state;