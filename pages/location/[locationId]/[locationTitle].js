import React from "react";
import { useRouter } from 'next/router';
import { signIn, signOut, useSession } from 'next-auth/client';


import slugify from 'react-slugify';
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



export default function locationPage(props) {
  const router = useRouter()
  const { locationId, locationTitle } = router.query;
  const [session, loading] = useSession();

  const urlslug = slugify("786 92");
  const classes = useStyles();
  const { ...rest } = props;
  const HeadTitle = "786/92, Location page";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  return <p>locationTitle: {locationId} {urlslug} {locationTitle} {props.locationId}</p>;
/* 
  return (
    <>
      <Head>
        <title>{HeadTitle}</title>
        <meta property="og:title" content={HeadTitle} key="title" />
      </Head>
      <HeaderLayout />
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <LocationMapSection />
        </div>
      </div>
      <Footer />
    </>
  );
 */

}
