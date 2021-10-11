/*eslint-disable*/
import React from "react";
import Link from "next/link";
import SearchField from 'react-search-field';
import { useRouter } from 'next/router'

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import Tooltip from "@material-ui/core/Tooltip";
import Icon from "@material-ui/core/Icon";

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

const useStyles = makeStyles(styles);

export default function HeaderSearchBar(props) {
  const [session, loading] = useSession();
  const classes = useStyles();
  const router = useRouter()
  
  const handleSearchBar = (searchValue) => {
    console.log(searchValue);
    if(searchValue){
      router.push("/search?q="+searchValue);
    }
    
  }

  return (
    <SearchField
      placeholder='Search locations'
      classNames={classes.headerSearchBar}
      onEnter={handleSearchBar}
      onSearchClick={handleSearchBar}
    />
  );
}
