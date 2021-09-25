import { useSession } from 'next-auth/client';
import { useRouter } from 'next/router'
import CookieConsent from "react-cookie-consent";

import React from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import Header from "./Header.js";
import HeaderLinks from "./HeaderLinks.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPage.js";

// Sections for this page
import HeaderLinksUser from './HeaderLinksUser';
import HeaderLinksLeft from './HeaderLinksLeft';

const dashboardRoutes = ["/dash"];

const useStyles = makeStyles(styles);



export default function HeaderLayout(props) {
  const router = useRouter();
  const [session, loading] = useSession();
  const classes = useStyles();
  const { ...rest } = props;

  // When rendering client side don't display anything until loading is complete
  if (typeof window !== 'undefined' && loading) return null;

  return (
    <>
      <Header
        brand="locationbit"
        color={router.pathname === "/" ? "transparent" : "dark"}
        routes={dashboardRoutes}
        rightLinks={session ? <HeaderLinksUser /> : <HeaderLinks />}
        fixed
        changeColorOnScroll={{
          height: 400,
          color: "white",
        }}
        {...rest}
      />
      <CookieConsent>This website uses cookies to enhance the user experience.</CookieConsent>
    </>
  );
}
