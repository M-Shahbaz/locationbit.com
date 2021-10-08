import { signIn, signOut, useSession } from 'next-auth/client';
import Head from "next/head";

import React from "react";
// nodejs library that concatenates classes
import classNames from "classnames";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import Footer from "components/Footer/Footer.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import LocationAddSection from "pages-sections/LocationAdd-Sections/LocationAddSection.js";
import WorkSection from "pages-sections/LandingPage-Sections/WorkSection.js";
import HeaderLayout from 'components/Header/HeaderLayout';

const useStyles = makeStyles(styles);

export default function location(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const HeadTitle = "Add Location | Locationbit.com";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  return (
    <>
      <Head>
        <title>{HeadTitle}</title>
        <meta property="og:title" content={HeadTitle} key="title" />
      </Head>
      <HeaderLayout/>
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <LocationAddSection />
        </div>
      </div>
      <Footer />
    </>
  );
}
