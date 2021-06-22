import { signIn, signOut, useSession } from 'next-auth/client';
import Head from "next/head";

import React from "react";
// nodejs library that concatenates classes
import classNames from "classnames";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import Header from "components/Header/Header.js";
import Footer from "components/Footer/Footer.js";
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";
import HeaderLinks from "components/Header/HeaderLinks.js";
import Parallax from "components/Parallax/Parallax.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import ProductSection from "pages-sections/LandingPage-Sections/ProductSection.js";
import TeamSection from "pages-sections/LandingPage-Sections/TeamSection.js";
import WorkSection from "pages-sections/LandingPage-Sections/WorkSection.js";
import HeaderLinksUser from '../components/Header/HeaderLinksUser';
import HeaderLinksLeft from '../components/Header/HeaderLinksLeft';
import HeaderLayout from '../components/Header/HeaderLayout';

const dashboardRoutes = ["/dash"];

const useStyles = makeStyles(styles);



export default function domain(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const HeadTitle = "786/92";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return null;

  return (
    <>
      <Head>
        <title>{HeadTitle}</title>
        <meta property="og:title" content="HeadTitle" key="title" />
      </Head>
      <HeaderLayout/>
      <div className={classNames(classes.main)}>
        <div className={classes.container}>
          <ProductSection />
          <WorkSection />
        </div>
      </div>
      <Footer />
    </>
  );
}
