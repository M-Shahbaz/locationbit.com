import React, { useEffect, useRef, useState, useCallback } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import Slide from "@material-ui/core/Slide";
import Dialog from "@material-ui/core/Dialog";
import Close from "@material-ui/icons/Close";
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/javascriptStyles.js";

import ReactLoading from 'react-loading';

const useStyles = makeStyles(styles);

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="down" ref={ref} {...props} />;
});

Transition.displayName = "Transition";

const LocationModal = props => {

  const classes = useStyles();
  const [loadingModal, setLoadingModal] = React.useState(false);
  // console.log(location);

  const title = "loading";

  useEffect(
    () => {
      setLoadingModal(props.loadingModal);
    },
    [props.loadingModal],
  );

  return (
    <GridContainer>
      <GridItem xs={12} sm={12} md={6} lg={4}>
        <Dialog
          classes={{
            root: classes.center
          }}
          PaperProps={{
            style: {
              backgroundColor: 'transparent',
              boxShadow: 'none',
            }
          }}
          open={loadingModal}
          TransitionComponent={Transition}
          keepMounted
          aria-labelledby={`${title}"-classic-modal-slide-title-loader"`}
          aria-describedby={`${title}"-classic-modal-slide-description-loader"`}
        >
          <ReactLoading type="spin" color="#4caf50" height={50} width={50} margin="auto" />
        </Dialog>
      </GridItem>
    </GridContainer>
  );
}

export default React.memo(LocationModal);;
