import { signIn, signOut, useSession } from 'next-auth/client';
import { NextSeo } from 'next-seo';

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
import HeaderLayout from 'components/Header/HeaderLayout';

const useStyles = makeStyles(styles);

export default function location(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const headTitle = "Add Location | Locationbit.com";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  return (
    <>
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
          <LocationAddSection />
        </div>
      </div>
      <Footer />
    </>
  );
}
