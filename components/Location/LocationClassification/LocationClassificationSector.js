import React, { useEffect, useContext } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FiberManualRecord from "@material-ui/icons/FiberManualRecord";
import Radio from "@material-ui/core/Radio";
import GridItem from "components/Grid/GridItem.js";
import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/basicsStyle.js";
// @ts-ignore
import naics from "naics";
import LocationClassificationSubSector from './LocationClassificationSubSector';
import classesCss from './LocationClassificationSector.module.css';
import LocationModalContext from '../../../store/LocationModalContext';
const useStyles = makeStyles(styles);


const LocationClassificationSector = props => {
  const ctx = useContext(LocationModalContext);
  console.log(ctx);
  const classes = useStyles();
  const [selectedEnabled, setSelectedEnabled] = React.useState(null);
  const sectors = naics.Industry.sectors();
  const sectorsArray = [...sectors];

  useEffect( ()=> {
    setSelectedEnabled(props.sector);
  }, [props.sector]);

  return (
    <>    
      <div className={classes.title}>
        <h3>North american industry classification system (NAICS-2017) sectors</h3>
      </div>
      {sectorsArray.map((value, key) => {
        console.log(value._code);
        const industry = naics.Industry.from(value._code);

        console.log(industry.title); // Software Publishers
        return (
          <div
            key={key}
            className={
              classes.checkboxAndRadio +
              " " +
              classes.checkboxAndRadioHorizontal
            }
          >
            <FormControlLabel
              control={
                <Radio
                  checked={selectedEnabled === value._code}
                  onChange={() => setSelectedEnabled(value._code)}
                  value={value._code}
                  name="sector"
                  aria-label={industry.title}
                  icon={
                    <FiberManualRecord className={classes.radioUnchecked} />
                  }
                  checkedIcon={
                    <FiberManualRecord className={classes.radioChecked} />
                  }
                  classes={{
                    checked: classes.radio,
                    root: classes.radioRoot,
                  }}
                />
              }
              classes={{
                label: `${classesCss.labelColorBlack} ${classes.label}`,
                root: classes.labelRoot,
              }}
              label={industry.title}
            />
          </div>
        )
      })}
      <LocationClassificationSubSector sector={selectedEnabled}/>
    </>
  );
};

export default LocationClassificationSector;
