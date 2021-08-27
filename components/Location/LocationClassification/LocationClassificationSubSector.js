import React, { useEffect, useContext } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FiberManualRecord from "@material-ui/icons/FiberManualRecord";
import Radio from "@material-ui/core/Radio";
import GridItem from "components/Grid/GridItem.js";
import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/basicsStyle.js";
import classesCss from './LocationClassificationSector.module.css';
// @ts-ignore
import naics from "naics";
import LocationClassificationIndustryGroup from './LocationClassificationIndustryGroup';
import LocationModalContext from '../../../store/LocationModalContext';
const useStyles = makeStyles(styles);


const LocationClassificationSubSector = props => {
  const ctx = useContext(LocationModalContext);
  const classes = useStyles();
  const [selectedEnabled, setSelectedEnabled] = React.useState(null);

  const industryDesc = new naics.Industry( props.sector && props.sector);
  const subSectors = industryDesc.children();

  useEffect( ()=> {
    setSelectedEnabled(ctx.subSector);
  }, [ctx.subSector]);

  if(!props.sector){
    return <></>;
  }
  return (
    <GridItem xs={12} sm={12} md={12}>
      <div className={classes.title}>
        <h3>Sub sectors</h3>
      </div>
      {subSectors.map((value, key) => {
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
                  onChange={() => ctx.onNaicsChange({type:'SUBSECTOR', value: value._code})}
                  value={value._code}
                  name="SUBSECTOR"
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
      <LocationClassificationIndustryGroup subSector={selectedEnabled}/>
    </GridItem>
  );
};

export default LocationClassificationSubSector;
