import React, { useState } from 'react';
import GridItem from "components/Grid/GridItem.js";
import GridContainer from "components/Grid/GridContainer.js";
import EditLocationIcon from '@material-ui/icons/EditLocation';
import EditIcon from '@material-ui/icons/Edit';
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';
import { withStyles } from "@material-ui/core/styles";
import CustomInput from "components/CustomInput/CustomInput.js";
import styles from './../../styles/jss/Location/LocationGridItemWebsiteStyle';


// const useStyles = makeStyles(styles);


const LocationGridItemWebsite = props => {
  // const classes = useStyles();
  const { classes } = props;
  const [inputClass, setInputClass] = useState(classes.hide);
  const [valueClass, setValueClass] = useState(classes.show);
  const [editIconClass, setEditIconClass] = useState(classes.hide);

  return (
    <GridItem xs={12} sm={12} md={12} className={props.topClasses.textLeft}>
      <GridContainer>
        <GridItem xs={4} sm={4} md={3}>
          <p className={props.topClasses.description}>{props.gridItemName}:</p>
        </GridItem>
        <GridItem xs={8} sm={8} md={9}>
          {<p className={`${props.topClasses.description} ${valueClass}`}
            onMouseEnter={e => {
              setEditIconClass(classes.show);
            }}
            onMouseLeave={e => {
              setEditIconClass(classes.hide)
            }}
            onClick={e => {
              setValueClass(classes.hide);
              setInputClass(classes.show);
            }}>
            {props.gridItemValue && props.gridItemValue}
            {!props.gridItemValue && <a href="#" onClick={e => {
                e.preventDefault();
              }}>Add {props.gridItemName}</a>}
            <a href="#" onClick={e => {
                e.preventDefault();
              }} className={editIconClass} ><EditLocationIcon fontSize="inherit" /></a>
          </p>}
          <div className={inputClass}>
            <CustomInput
              formControlProps={{
                className: classes.paddingTopZero,
              }}
              id={props.gridItemName}
            />
            <a href="#" onClick={e => {
                e.preventDefault();
              }}><CheckCircleIcon fontSize="default" /></a>
            <a href="#"
              onClick={e => {
                e.preventDefault();
                setValueClass(classes.show);
                setInputClass(classes.hide);
              }}
            ><CancelIcon fontSize="default" /></a>
          </div>
        </GridItem>
      </GridContainer>
    </GridItem>
  );
};

export default withStyles(styles)(LocationGridItemWebsite)
