import React, { useEffect, useContext } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FiberManualRecord from "@material-ui/icons/FiberManualRecord";
import Radio from "@material-ui/core/Radio";
import GridItem from "components/Grid/GridItem.js";
import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/basicsStyle.js";
import classesCss from './LocationClassificationSector.module.css';
import LocationModalContext from '../../../store/LocationModalContext';
// @ts-ignore
import naics from "naics";
const useStyles = makeStyles(styles);


const LocationClassificationNationalIndustry = props => {
  const ctx = useContext(LocationModalContext);
  const classes = useStyles();
  const [selectedEnabled, setSelectedEnabled] = React.useState(null);
  
  const industryDesc = new naics.Industry( props.naicsIndustry && props.naicsIndustry);
  const NationalIndustries = industryDesc.children();

  useEffect( ()=> {
    setSelectedEnabled(props.NationalIndustry);
  }, [props.NationalIndustry]);

  if(!props.naicsIndustry){
    return <></>;
  }
  return (
    <GridItem xs={12} sm={12} md={12}>
      <div className={classes.title}>
        <h3>National industry</h3>
      </div>
      {NationalIndustries.map((value, key) => {
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
    </GridItem>
  );
};

export default LocationClassificationNationalIndustry;
