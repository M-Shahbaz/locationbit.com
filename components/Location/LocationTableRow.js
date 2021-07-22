import React, { useState } from 'react';
import GridItem from "components/Grid/GridItem.js";
import GridContainer from "components/Grid/GridContainer.js";
import EditLocationIcon from '@material-ui/icons/EditLocation';
import EditIcon from '@material-ui/icons/Edit';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';
import { withStyles } from "@material-ui/core/styles";
import CustomInput from "components/CustomInput/CustomInput.js";
import styles from './../../styles/jss/Location/LocationTableRowStyle';


// const useStyles = makeStyles(styles);


const LocationTableRow = props => {
  // const classes = useStyles();
  const { classes } = props;
  const [inputClass, setInputClass] = useState(classes.hide);
  const [valueClass, setValueClass] = useState(classes.showInlineBlock);
  const [editIconClass, setEditIconClass] = useState(classes.hide);

  return (
    <TableRow>
      <TableCell>{props.tableRowName}:</TableCell>
      <TableCell>
        {<div className={`${props.edit && classes.cursorPointer} ${valueClass}`}
          onMouseEnter={e => {
            if (props.edit)
              setEditIconClass(classes.showInlineBlock);
          }}
          onMouseLeave={e => {
            if (props.edit)
              setEditIconClass(classes.hide)
          }}
          onClick={e => {
            if (props.edit) {
              setValueClass(classes.hide);
              setInputClass(classes.showInlineBlock);
            }
          }}>
          {props.tableRowValue && props.tableRowValue}
          {!props.tableRowValue && <a href="#" onClick={e => {
            e.preventDefault();
          }}>Add {props.tableRowName}</a>}
          <a href="#" onClick={e => {
            e.preventDefault();
          }} className={editIconClass} >{props.edit && <EditLocationIcon fontSize="inherit" />}</a>
        </div>}
        {props.edit && <div className={inputClass}>
          <CustomInput
            formControlProps={{
              className: classes.paddingTopZero,
            }}
            id={props.tableRowName}
          />
          <a href="#" onClick={e => {
            e.preventDefault();
          }}><CheckCircleIcon fontSize="default" /></a>
          <a href="#"
            onClick={e => {
              e.preventDefault();
              setValueClass(classes.showInlineBlock);
              setInputClass(classes.hide);
            }}
          ><CancelIcon fontSize="default" /></a>
        </div>}
      </TableCell>
    </TableRow>
  );
};

export default withStyles(styles)(LocationTableRow)
