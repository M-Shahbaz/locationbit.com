import React, { useContext, useState, useCallback } from "react";
import EditLocationIcon from '@material-ui/icons/EditLocation';
import { makeStyles } from "@material-ui/core/styles";
import styles from './../../styles/jss/Location/LocationTableRowStyle';
import LocationMapContext from './../../store/LocationMapContext';
import Button from "components/CustomButtons/Button.js";

const useStyles = makeStyles(styles);

const LocationMapEdit = props => {
  const classes = useStyles();
  const ctx = useContext(LocationMapContext);
  console.log(ctx);
  const [editIconClass, setEditIconClass] = useState(classes.hide);

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
      ctx.onMapChange({ type: 'DRAGGABLE', value: true })
    }
  }, [])

  const onCancelHandler = useCallback((e) => {
    if (props.edit) {
      ctx.onMapChange({ type: 'DRAGGABLE', value: false })
    }
  }, [])

  const onSaveHandler = (e) => {
    if (props.edit) {
      ctx.onMapSave();
    }
  }

  return (
    <>
      {props.edit &&
        <>
          <div className={`${props.edit && classes.cursorPointer}`}
            onMouseEnter={onMouseEnterHandler}
            onMouseLeave={onMouseLeaveHandler}
            onClick={onClickHandler}>
            {!ctx.draggable && <a href="#" onClick={preventDefault}>Edit location marker</a>}
            {!ctx.draggable && <a href="#" onClick={preventDefault} className={editIconClass} >{props.edit && <EditLocationIcon fontSize="inherit" />}</a>}
          </div>
          {ctx.draggable && <>
            <Button variant="outlined" color="success" simple
              onClick={onSaveHandler}
            >
              Save
            </Button>
            <Button
              variant="outlined"
              onClick={onCancelHandler}
              color="danger"
              simple
            >
              Cancel
            </Button>
          </>
          }
        </>
      }
    </>
  )


};

export default LocationMapEdit;
