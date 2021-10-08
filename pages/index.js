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
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";
import Parallax from "components/Parallax/Parallax.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import ProductSection from "pages-sections/LandingPage-Sections/ProductSection.js";
import TimelineSection from "pages-sections/LandingPage-Sections/TimelineSection.js";
import TeamSection from "pages-sections/LandingPage-Sections/TeamSection.js";
import WorkSection from "pages-sections/LandingPage-Sections/WorkSection.js";
import HeaderLayout from "components/Header/HeaderLayout";


const useStyles = makeStyles(styles);

export default function domain(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;
  const HeadTitle = "Location profiles in one place. | Locationbit.com";

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return <></>;

  return (
    <>
      <Head>
        <title>{HeadTitle}</title>
        <meta property="og:title" content={HeadTitle} key="title" />
      </Head>
      <HeaderLayout/>
      <Parallax filter responsive image="/img/landing-bg.jpg">
        <div className={classes.container}>
          <GridContainer>
            <GridItem xs={12} sm={12} md={6}>
              <h1 className={classes.title}>Location profiles in one place.</h1>
              <h4>
                Locationbit is to build the "global ENCYCLOPEDIA for location data"
                e.g: Wikipedia for locations. 
                With a chance of earning money
              </h4>
              <br />
              <Button
                color="success"
                size="lg"
                href={`/api/auth/signin`}
                target="_blank"
                rel="noopener noreferrer"
                onClick={(e) => {
                  e.preventDefault()
                  signIn()
                }}
              >
                <i className="fas fa-sign-in-alt" />
                Get started!
              </Button>
            </GridItem>
          </GridContainer>
        </div>
      </Parallax>
      <div className={classNames(classes.main, classes.mainRaised)}>
        <div className={classes.container}>
          <ProductSection />
          <TimelineSection />
          <WorkSection />
        </div>
      </div>
      <Footer />
    </>
  );
}