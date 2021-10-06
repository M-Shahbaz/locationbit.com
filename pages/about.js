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
import AboutSection from "pages-sections/LandingPage-Sections/AboutSection.js";
import HeaderLayout from '../components/Header/HeaderLayout';

const useStyles = makeStyles(styles);



export default function about(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const HeadTitle = "About";

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
          <AboutSection />
        </div>
      </div>
      <Footer />
    </>
  );
}
