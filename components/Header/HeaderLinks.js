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

import { signIn, signOut, useSession } from 'next-auth/client';
import HeaderSearchBar from "./HeaderSearchBar";

const useStyles = makeStyles(styles);

export default function HeaderLinks(props) {
  const [ session, loading ] = useSession();
  const classes = useStyles();
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
        <Button
          href={`/api/auth/signin`}
          color="success"
          target="_blank"
          className={classes.navLink}
          onClick={(e) => {
            e.preventDefault()
            signIn()
          }}
        >
          <ExitToAppIcon className={classes.icons} /> Sign in
        </Button>
      </ListItem>
    </List>
  );
}
