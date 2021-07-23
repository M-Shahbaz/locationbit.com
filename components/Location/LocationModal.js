import React, { useEffect, useRef } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import Slide from "@material-ui/core/Slide";
import IconButton from "@material-ui/core/IconButton";
import Dialog from "@material-ui/core/Dialog";
import DialogTitle from "@material-ui/core/DialogTitle";
import DialogContent from "@material-ui/core/DialogContent";
import DialogActions from "@material-ui/core/DialogActions";
import InputLabel from "@material-ui/core/InputLabel";
import FormControl from "@material-ui/core/FormControl";
import Tooltip from "@material-ui/core/Tooltip";
import Popover from "@material-ui/core/Popover";
// @material-ui/icons
import LibraryBooks from "@material-ui/icons/LibraryBooks";
import Close from "@material-ui/icons/Close";
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";

import CustomInput from "components/CustomInput/CustomInput.js";
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';

import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/javascriptStyles.js";

const useStyles = makeStyles(styles);

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="down" ref={ref} {...props} />;
});

Transition.displayName = "Transition";

const LocationModal = props => {
  const classes = useStyles();
  const [classicModal, setClassicModal] = React.useState(false);
  const inputRef = useRef('');

  const title = props.modalTitle;

  useEffect(
    () => {
      setClassicModal(props.classicModal);
    },
    [props.classicModal],
  );

  const classicModalHandler = (value) => {
    setClassicModal(value);
    props.classicModalHandler(value);
  }

  return (
    <GridContainer>
      <GridItem xs={12} sm={12} md={6} lg={4}>
        <Dialog
          classes={{
            root: classes.center,
            paper: classes.modal,
          }}
          open={classicModal}
          TransitionComponent={Transition}
          keepMounted
          onClose={() => classicModalHandler(false)}
          aria-labelledby={`${title}"-classic-modal-slide-title"`}
          aria-describedby={`${title}"-classic-modal-slide-description"`}
        >
          <DialogTitle
            id={`${title}"-classic-modal-slide-title"`}
            disableTypography
            className={classes.modalHeader}
          >
            <IconButton
              className={classes.modalCloseButton}
              key="close"
              aria-label="Close"
              color="inherit"
              onClick={() => classicModalHandler(false)}
            >
              <Close className={classes.modalClose} />
            </IconButton>
            <h4 className={classes.modalTitle}>{title}</h4>
          </DialogTitle>
          <DialogContent
            id={`${title}"-classic-modal-slide-description"`}
            className={classes.modalBody}
          >
            <div>
              <CustomInput
                labelText={title}
                variant="outlined"
                id={`"customInput-"${title.toLowerCase()}`}
                formControlProps={{
                  fullWidth: true,
                  style: { minWidth: "500px" }
                }}
                inputProps={{
                  name: title.toLowerCase(),
                  id: title.toLowerCase(),
                  defaultValue: props.modalValue,
                  required: true,
                }}
                ref={inputRef}
              />
            </div>
          </DialogContent>
          <DialogActions className={classes.modalFooter}>
            <Button variant="outlined" color="success" simple
              onClick={() => console.log(inputRef.current.value)}
            >
              Save
            </Button>
            <Button
              variant="outlined"
              onClick={() => classicModalHandler(false)}
              color="danger"
              simple
            >
              Close
            </Button>
          </DialogActions>
        </Dialog>
      </GridItem>
    </GridContainer>
  );
};

export default LocationModal;
