import React, { useState, useCallback } from 'react';
import GridItem from "components/Grid/GridItem.js";
import GridContainer from "components/Grid/GridContainer.js";
import EditLocationIcon from '@material-ui/icons/EditLocation';
import EditIcon from '@material-ui/icons/Edit';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';
//import { withStyles } from "@material-ui/core/styles";
import { makeStyles } from "@material-ui/core/styles";
import CustomInput from "components/CustomInput/CustomInput.js";
import styles from './../../styles/jss/Location/LocationTableRowStyle';
import LocationModal from './LocationModal';
import { ucfirst } from './../../utility/FunctionsService';
import classesModule from './LocationTableRow.module.css';
import sanitizeHtml from 'sanitize-html';


const useStyles = makeStyles(styles);


const LocationTableRow = props => {
  const classes = useStyles();
  // const { classes } = props;
  const [inputClass, setInputClass] = useState(classes.hide);
  const [valueClass, setValueClass] = useState(classes.showInlineBlock);
  const [editIconClass, setEditIconClass] = useState(classes.hide);
  const [classicModal, setClassicModal] = useState(false);

  const classicModalHandler = useCallback((value) => {
    console.log(value);
    setClassicModal(value);
  }, [])

  const preventDefault = useCallback((e) => {
    e.preventDefault();
  }, [])

  const onMouseEnterHandler = useCallback((e) => {
    if (props.edit)
      setEditIconClass(classes.showInlineBlock);
  }, [])

  const onMouseLeaveHandler = useCallback((e) => {
    if (props.edit)
    setEditIconClass(classes.hide);
  }, [])

  const onClickHandler = useCallback((e) => {
    if (props.edit) {
      setClassicModal(true);
    }
  }, [])

  return (
    <TableRow>
      <TableCell>{ucfirst(props.tableRowName)}:</TableCell>
      <TableCell>
        {<div className={`${props.edit && classes.cursorPointer} ${valueClass} ${classesModule.width100}`}
          onMouseEnter={onMouseEnterHandler}
          onMouseLeave={onMouseLeaveHandler}
          onClick={onClickHandler}>
          {props.tableRowName == 'description' && props.tableRowValue ? <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(props.tableRowValue).replace(/(<? *script)/gi, 'illegalscript') }} >
          </div> : props.tableRowValue}
          {!props.tableRowValue && <a href="#" onClick={preventDefault}>Add {props.tableRowName}</a>}
          <a href="#" onClick={preventDefault} className={editIconClass} >{props.edit && <EditLocationIcon fontSize="inherit" />}</a>
        </div>}
        {props.edit && <LocationModal
          locationId={props.locationId}
          classicModal={classicModal}
          classicModalHandler={classicModalHandler.bind(this)}
          modalTitle={props.tableRowName}
          modalValue={props.tableRowValue}
        />
        }
      </TableCell>
    </TableRow>
  );
}

// export default withStyles(styles)(LocationTableRow)
export default React.memo(LocationTableRow);
