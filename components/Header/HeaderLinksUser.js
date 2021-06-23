import { signIn, signOut, useSession } from 'next-auth/client';

/*eslint-disable*/
import React from "react";
import Link from "next/link";

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import Tooltip from "@material-ui/core/Tooltip";
import Icon from "@material-ui/core/Icon";
import AddLocationIcon from '@material-ui/icons/AddLocation';

// @material-ui/icons
import { Apps, CloudDownload } from "@material-ui/icons";
import ExitToAppIcon from '@material-ui/icons/ExitToApp';
import DeleteIcon from "@material-ui/icons/Delete";
import IconButton from "@material-ui/core/IconButton";

// core components
import CustomDropdown from "components/CustomDropdown/CustomDropdown.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/components/headerLinksStyle.js";
import navbarsStyle from "styles/jss/nextjs-material-kit/pages/componentsSections/navbarsStyle.js";

const useStyles = makeStyles(styles);
const useNavbarsStyleStyles = makeStyles(navbarsStyle);


export default function HeaderLinksUser(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const classesNavbars = useNavbarsStyleStyles();

  return (
    <List className={classes.list}>
      <ListItem className={classes.listItem}>
        <Link href="/location">
          <a className={classes.navLink}><AddLocationIcon /> Add location</a>
        </Link>
      </ListItem>
      <ListItem className={classes.listItem}>
        <Link href="/domain">
          <a className={classes.navLink}>Domain</a>
        </Link>
      </ListItem>
      <ListItem className={classes.listItem}>
        <CustomDropdown
          noLiPadding
          navDropdown
          buttonText="Components"
          buttonProps={{
            className: classes.navLink,
            color: "transparent",
          }}
          buttonIcon={Apps}
          dropdownList={[
            <Link href="/components">
              <a className={classes.dropdownLink}>All components</a>
            </Link>,
            <a
              href="https://creativetimofficial.github.io/nextjs-material-kit/#/documentation?ref=njsmk-navbar"
              target="_blank"
              className={classes.dropdownLink}
            >
              Documentation
            </a>,
          ]}
        />
      </ListItem>
      <ListItem className={classes.listItem}>
        <Button
          href="https://www.creative-tim.com/product/nextjs-material-kit-pro?ref=njsmk-navbar"
          color="transparent"
          target="_blank"
          className={classes.navLink}
        >
          <Icon className={classes.icons}>unarchive</Icon> Upgrade to PRO
        </Button>
      </ListItem>
      <ListItem className={classes.listItem}>
        <CustomDropdown
          noLiPadding
          navDropdown
          left
          caret={false}
          hoverColor="black"
          dropdownHeader={session && session.user.name}
          buttonText={
            <img
              src={session && session.user.image}
              className={classesNavbars.img}
              alt="profile"
            />
          }
          buttonProps={{
            className: classes.navLink + " " + classesNavbars.imageDropdownButton,
            color: "transparent",
          }}
          dropdownList={[
            <Link href="/me">
              <a className={classesNavbars.dropdownLink}>Me</a>
            </Link>,
            <Link href="/settings">
              <a className={classesNavbars.dropdownLink}>Settings</a>
            </Link>,
            <Link href="/api/auth/signout">
              <a
                className={classesNavbars.dropdownLink}
                onClick={(e) => {
                  e.preventDefault()
                  signOut()
                }}
              >
                Sign out
              </a>
            </Link>
          ]}
        />
      </ListItem>
    </List>
  );
}
