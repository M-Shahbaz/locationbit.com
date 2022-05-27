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
import CityLocationsSection from './../../../../pages-sections/Country-Sections/CityLocationsSection';
import { getLocationSearch } from 'utility/LocationService.js';

const useStyles = makeStyles(styles);



const cityPage = (props) => {
  const router = useRouter()
  const { countryCode, stateCode, cityparams } = router.query;
  const cityPaginationUrl = "/country/" + countryCode + "/" + stateCode + "/" + cityparams[0] + "/";
  const [session, loading] = useSession();
  const classes = useStyles();
  console.log(cityparams);
  const country = Country.getCountryByCode(countryCode);
  const state = State.getStateByCodeAndCountry(stateCode, countryCode);

  const headTitle = cityparams[0] + ", " + state.name + ", " + country.name;

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
          <CityLocationsSection
            headTitle={headTitle}
            locations={props.locations}
            page={cityparams[1] && cityparams[1]}
            cityPaginationUrl={cityPaginationUrl}
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
  const cityparams = params.cityparams;
  // console.log(cityparams);
  let urlCity = cityparams[0];
  if (cityparams[1]) {
    urlCity = urlCity + "/" + cityparams[1];
  }

  // fetch data from an api
  return await getLocationSearch('/api/server/locations/search/city/' + urlCity, '').then(response => {
    return response;
  });

}

export default cityPage;