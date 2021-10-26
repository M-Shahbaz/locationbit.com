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
import HeaderSearchBar from './HeaderSearchBar';

const useStyles = makeStyles(styles);
const useNavbarsStyleStyles = makeStyles(navbarsStyle);


export default function HeaderLinksUser(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const classesNavbars = useNavbarsStyleStyles();

  return (
    <List className={classes.list}>
      <ListItem className={classes.listItem}>
        <HeaderSearchBar />
      </ListItem>
      <ListItem className={classes.listItem}>
        <Link href="/location" passHref>
          <a className={classes.navLink}><AddLocationIcon /> Add location</a>
        </Link>
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
            <Link href="/me" passHref>
              <a className={classesNavbars.dropdownLink}>Me</a>
            </Link>,
            <Link href="/settings" passHref>
              <a className={classesNavbars.dropdownLink}>Settings</a>
            </Link>,
            <Link href="/api/auth/signout" passHref>
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
