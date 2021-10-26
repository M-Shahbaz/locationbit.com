import { signIn, signOut, useSession } from 'next-auth/client';
import Head from "next/head";
import { useRouter } from 'next/router';

import React from "react";
// nodejs library that concatenates classes
import classNames from "classnames";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

import { leafletLibrary } from 'utility/Libraries.js';

// @material-ui/icons

// core components
import Footer from "components/Footer/Footer.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import SearchSection from "pages-sections/LandingPage-Sections/SearchSection.js";
import HeaderLayout from 'components/Header/HeaderLayout';
import { getLocationSearch } from 'utility/LocationService.js';

const useStyles = makeStyles(styles);



const search = (props) => {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const router = useRouter()
  const { q } = router.query
  const headTitle = q + " - Locationbit";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

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
      <HeaderLayout/>
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <SearchSection 
          headTitle={q}
          locations={props.locations}/>
        </div>
      </div>
      <Footer />
    </>
  );
}


export async function getServerSideProps(context) {
  const req = context.req;
  const res = context.res;
  const { q } = context.query;
  // fetch data from an api
  return await getLocationSearch('/api/server/locations/search', q).then( response => {
    return response;
  }); 

}

export default search;
