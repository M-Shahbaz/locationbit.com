import { signIn, signOut, useSession } from 'next-auth/client';
import { NextSeo } from 'next-seo';
import { useRouter } from 'next/router';

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
import SettingsSection from "pages-sections/LandingPage-Sections/SettingsSection.js";
import HeaderLayout from 'components/Header/HeaderLayout';

const useStyles = makeStyles(styles);



export default function settings(props) {
  const [session, loading] = useSession();
  const router = useRouter();
  const classes = useStyles();
  const { ...rest } = props;
  const headTitle = "Settings";

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
          <SettingsSection />
        </div>
      </div>
      <Footer />
    </>
  );
}
